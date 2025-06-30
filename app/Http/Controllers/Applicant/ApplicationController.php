<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationPeriod;
use App\Models\Document;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $application = $user->getCurrentApplication();
        $programs = Program::active()->get()->groupBy('degree_level');
        $currentPeriod = ApplicationPeriod::where('is_active', true)->first();

        // Create new application if none exists
        if (! $application && $currentPeriod) {
            $application = Application::create([
                'user_id' => $user->id,
                'application_period_id' => $currentPeriod->id,
                'email' => $user->email,
                'status' => 'draft',
            ]);
        }

        return view('applicant.application', compact('application', 'programs', 'currentPeriod'));
    }

    public function updateApplication(Request $request, $applicationId)
    {
        $user = Auth::user();
        $application = Application::find($applicationId);

        if ($application->user_id !== $user->id || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:128',
            'passport_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'sometimes|nullable|in:1,2,3',
            'native_language' => 'nullable|string|max:64',
            'phone' => 'nullable|string|max:32|regex:/^[\+]?[0-9\s\-\(\)]+$/',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:100',
            'permanent_state' => 'sometimes|nullable|string|max:100',
            'permanent_country' => 'nullable|string|max:100',
            'permanent_postcode' => 'nullable|string|max:20',
            'current_street' => 'sometimes|nullable|string|max:255',
            'current_city' => 'sometimes|nullable|string|max:100',
            'current_state' => 'sometimes|nullable|string|max:100',
            'current_country' => 'sometimes|nullable|string|max:100',
            'current_postal_code' => 'sometimes|nullable|string|max:20',
            'previous_institution' => 'nullable|string|max:200',
            'previous_gpa' => 'nullable|string|max:10',
            'degree_earned' => 'nullable|string|max:64',
            'graduation_date' => 'sometimes|nullable|date|before_or_equal:today',
            'english_test_type' => 'sometimes|nullable|in:IELTS,TOEFL,Duolingo,Other',
            'english_test_score' => 'sometimes|nullable|string|max:20',
            'english_test_date' => 'sometimes|nullable|date|before_or_equal:today',
            'level' => 'nullable|in:undergraduate,graduate',
            'program_id' => 'nullable|exists:programs,id',
            'start_term' => 'nullable|string|max:50',
            'funding_interest' => 'sometimes|boolean',
            'statement_of_purpose' => 'nullable|string|min:100|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $validatedData = $validator->validated();

            $application->update($validatedData);

            $user->update([
                'first_name' => $request->input('first_name', $user->first_name),
                'last_name' => $request->input('last_name', $user->last_name),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application updated successfully',
                'updated_fields' => array_keys($validatedData),
                'data' => $application->fresh(),
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Failed to update application: '.$e->getMessage(), [
                'user_id' => $user->id,
                'application_id' => $application->id,
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update application. Please try again.',
            ], 500);
        }
    }

    public function uploadDocument(Request $request, $applicationId)
    {
        $application = Application::findOrFail($applicationId);
        $user = Auth::user();

        if ($user->id !== $application->user_id || ! $application->canEdit()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'document' => 'required|file|max:25600', // 25MB max
            'type' => 'required|in:passport,transcript,diploma,sop,cv,english_score,portfolio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        $file = $request->file('document');
        $type = $request->type;

        // Validate file type based on document type
        $allowedTypes = $this->getAllowedMimeTypes($type);
        if (! in_array($file->getMimeType(), $allowedTypes)) {
            return response()->json(['error' => 'Invalid file type for this document'], 422);
        }

        try {
            DB::beginTransaction();

            $existingDocument = $application->documents()->where('type', $type)->first();
            if ($existingDocument) {
                Storage::delete($existingDocument->path);
                $existingDocument->delete();
            }

            // Store the new file
            $filename = time().'_'.$file->getClientOriginalName(); // random name ulid
            $path = $file->storeAs('documents/'.$application->id, $filename, 'public');

            // Create document record
            Document::create([
                'application_id' => $application->id,
                'type' => $type,
                'filename' => $filename,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'path' => $path,
            ]);

            DB::commit();

            return response()->json(['message' => 'Document uploaded successfully']);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Failed to upload document'], 500);
        }
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $application = $user->getCurrentApplication();

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot submit this application'], 403);
        }

        // Validate that all required fields are completed
        $requiredFields = [
            'nationality',
            'passport_number',
            'date_of_birth',
            'native_language',
            'phone',
            'permanent_address',
            'previous_institution',
            'previous_gpa',
            'degree_earned',
            'english_test_score',
            'english_test_date',
            'program_id',
            'start_term',
            'statement_of_purpose',
        ];

        foreach ($requiredFields as $field) {
            if (empty($application->$field)) {
                return response()->json([
                    'error' => 'Please complete all required fields before submitting',
                ], 422);
            }
        }

        $application->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return response()->json(['message' => 'Application submitted successfully']);
    }

    private function getAllowedMimeTypes($type)
    {
        $mimeTypes = [
            'passport' => ['application/pdf', 'image/jpeg', 'image/png'],
            'transcript' => ['application/pdf'],
            'diploma' => ['application/pdf', 'image/jpeg', 'image/png'],
            'sop' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'cv' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'english_score' => ['application/pdf', 'image/jpeg', 'image/png'],
            'portfolio' => ['application/pdf', 'application/zip'],
        ];

        return $mimeTypes[$type] ?? [];
    }
}
