<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Requests\UploadDocumentRequest;
use App\Models\Application;
use App\Models\ApplicationPeriod;
use App\Models\Document;
use App\Models\Program;
use Illuminate\Http\Response;
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
        $documents = $application ? $application->getImportantDocuments() : collect();

        return view('applicant.application', compact('application', 'programs', 'currentPeriod', 'documents'));
    }

    public function updateApplication(UpdateApplicationRequest $request)
    {
        $user = Auth::user();
        $application = $request->getApplication();
        $validatedData = $request->validated();
        $application->update($validatedData);
        $user->update([
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
        ]);

        return back();
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

            // Remove existing document if it exists
            $existingDocument = $application->documents()->where('type', $type)->first();
            if ($existingDocument) {
                Storage::disk('public')->delete($existingDocument->path);
                $existingDocument->delete();
            }

            // Store the new file
            $filename = Str::ulid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('documents/'.$application->id, $filename, 'public');

            // Create document record
            $document = Document::create([
                'application_id' => $application->id,
                'type' => $type,
                'filename' => $filename,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'path' => $path,
            ]);

            DB::commit();

            // Return consistent response with document data
            return response()->json([
                'message' => 'Document uploaded successfully',
                'document' => [
                    'id' => $document->id,
                    'filename' => $document->filename,
                    'original_name' => $document->original_name,
                    'size' => $document->size,
                    'type' => $document->type,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Failed to upload document: '.$e->getMessage(), [
                'user_id' => auth()->id(),
                'application_id' => $application->id,
                'document_type' => $type,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Failed to upload document: '.$e->getMessage()], 500);
        }
    }

    public function downloadDocument(int $applicationId, int $file_id)
    {
        try {
            $document = Document::where('application_id', $applicationId)
                ->where('id', $file_id)
                ->firstOrFail();

            $path = 'documents/'.$applicationId.'/'.$document->filename;

            if (! Storage::disk('public')->exists($path)) {
                abort(404, 'File not found');
            }

            return Storage::disk('public')->download($path, $document->original_name);

        } catch (\Exception $e) {
            \Log::error('Failed to download document: '.$e->getMessage(), [
                'application_id' => $applicationId,
                'file_id' => $file_id,
            ]);

            abort(404, 'Document not found');
        }
    }

    public function removeDocument(int $applicationId, int $file_id)
    {
        try {
            $document = Document::where('application_id', $applicationId)
                ->where('id', $file_id)
                ->firstOrFail();

            $path = 'documents/'.$applicationId.'/'.$document->filename;

            // Delete file from storage
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Delete database record
            $document->delete();

            return response()->json([
                'success' => true,
                'message' => 'Document removed successfully',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Failed to remove document: '.$e->getMessage(), [
                'application_id' => $applicationId,
                'file_id' => $file_id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to remove document: '.$e->getMessage(),
            ], 500);
        }
    }
}
