<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Requests\SubmitApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Requests\UploadDocumentRequest;
use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationPeriod;
use App\Models\Document;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $application = $user->getCurrentApplication();
        $programs = Program::active()->get()->groupBy('degree_level');
        $currentPeriod = ApplicationPeriod::where('is_active', true)->first();

        if (! $application && $currentPeriod) {
            $application = Application::create([
                'user_id' => $user->id,
                'application_period_id' => $currentPeriod->id,
                'email' => $user->email,
                'status' => 'draft',
            ]);
        }
        $documents = $application ? $application->documents : collect();

        return view('applicant.application', compact('application', 'programs', 'currentPeriod', 'documents'));
    }

    public function updateApplication(UpdateApplicationRequest $request)
    {
        $user = Auth::user();
        $application = $request->getApplication();

        try {
            $validatedData = $request->validated();
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

    public function submit(SubmitApplicationRequest $request)
    {
        $application = $request->getApplication();
        $application->update([
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return response()->json(['message' => 'Application submitted successfully']);
    }

    public function uploadDocument(UploadDocumentRequest $request)
    {
        $application = $request->getApplication();
        $file = $request->file('document');
        $type = $request->input('type');

        try {
            DB::beginTransaction();
            $existingDocument = $application->documents()->where('type', $type)->first();
            if ($existingDocument) {
                Storage::delete($existingDocument->path);
                $existingDocument->delete();
            }
            $filename = Str::ulid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('documents/'.$application->id, $filename, 'public');
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

            \Log::error('Failed to upload document: '.$e->getMessage(), [
                'user_id' => auth()->id(),
                'application_id' => $application->id,
                'document_type' => $type,
            ]);

            return response()->json(['error' => 'Failed to upload document'], 500);
        }
    }

    public function downloadDocument(int $applicationId, string $filename)
    {
        $path = 'documents/'.$applicationId.'/'.$filename;

        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($path);
    }

    public function removeDocument(int $applicationId, string $filename)
    {
        $path = 'documents/'.$applicationId.'/'.$filename;

        if (! Storage::disk('public')->exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found',
            ], 404);
        }

        Storage::disk('public')->delete($path);
    }
}
