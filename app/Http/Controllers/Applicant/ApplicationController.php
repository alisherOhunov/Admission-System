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
    public function index()
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

    public function updatePersonalInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'nationality' => 'required|string',
            'passport_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'nullable|in:male,female,other',
            'native_language' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $application = $user->getCurrentApplication();

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        $fields = ['nationality', 'passport_number', 'date_of_birth', 'gender', 'native_language'];
        $dataToUpdate = [];

        foreach ($fields as $field) {
            $newValue = $request->input($field);
            if ($newValue !== $application->$field) {
                $dataToUpdate[$field] = $newValue;
            }
        }

        if (! empty($dataToUpdate)) {
            $application->update($dataToUpdate);
        }

        $defaultAddress = [
            'street' => '',
            'city' => '',
            'state' => '',
            'country' => '',
            'postal_code' => '',
        ];

        $permanentAddress = array_merge($defaultAddress, $application->permanent_address ?? []);

        return view('applicant.partials.contact-info', compact('application', 'permanentAddress'));
    }

    public function updateContactInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string|max:20',
            'permanent_address' => 'required|array',
            'permanent_address.street' => 'required|string|max:255',
            'permanent_address.city' => 'required|string|max:100',
            'permanent_address.state' => 'nullable|string|max:100',
            'permanent_address.country' => 'required|string|max:100',
            'permanent_address.postal_code' => 'required|string|max:20',
            'current_address' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $application = $user->getCurrentApplication();

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        try {
            $currentAddress = $request->current_address ?: $request->permanent_address;

            $dataToUpdate = [];

            if ($application->phone !== $request->phone) {
                $dataToUpdate['phone'] = $request->phone;
            }

            if ($application->permanent_address !== $request->permanent_address) {
                $dataToUpdate['permanent_address'] = $request->permanent_address;
            }

            if ($application->current_address !== $currentAddress) {
                $dataToUpdate['current_address'] = $currentAddress;
            }

            if (! empty($dataToUpdate)) {
                $application->update($dataToUpdate);
            }

            return view('applicant.partials.personal-info', compact('application'));

        } catch (\Exception $e) {
            \Log::error('Failed to update contact info: '.$e->getMessage());

            return response()->json([
                'error' => 'Failed to update contact information. Please try again.',
            ], 500);
        }
    }

    public function updateAcademicInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'previous_institution' => 'required|string',
            'previous_gpa' => 'required|string',
            'degree_earned' => 'required|string',
            'graduation_date' => 'nullable|date',
            'english_test_type' => 'nullable|in:IELTS,TOEFL,Duolingo,Other',
            'english_test_score' => 'nullable|string',
            'english_test_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $application = $user->getCurrentApplication();

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        $application->update($request->only([
            'previous_institution',
            'previous_gpa',
            'degree_earned',
            'graduation_date',
            'english_test_type',
            'english_test_score',
            'english_test_date',
        ]));

        return response()->json(['message' => 'Academic information updated successfully']);
    }

    public function updateProgramChoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|in:undergraduate,graduate',
            'program_id' => 'required|exists:programs,id',
            'start_term' => 'required|string',
            'funding_interest' => 'boolean',
            'statement_of_purpose' => 'required|string|min:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $application = $user->getCurrentApplication();

        if (! $application || ! $application->canEdit()) {
            return response()->json(['error' => 'Cannot edit this application'], 403);
        }

        $application->update($request->only([
            'level',
            'program_id',
            'start_term',
            'funding_interest',
            'statement_of_purpose',
        ]));

        return response()->json(['message' => 'Program information updated successfully']);
    }

    public function uploadDocument(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document' => 'required|file|max:25600', // 25MB max
            'type' => 'required|in:passport,transcript,diploma,sop,cv,english_score,portfolio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $application = $user->getCurrentApplication();

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

            // Delete existing document of this type
            $existingDocument = $application->documents()->where('type', $type)->first();
            if ($existingDocument) {
                Storage::delete($existingDocument->path);
                $existingDocument->delete();
            }

            // Store the new file
            $filename = time().'_'.$file->getClientOriginalName(); //random name ulid
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
            'degree_earned',
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
