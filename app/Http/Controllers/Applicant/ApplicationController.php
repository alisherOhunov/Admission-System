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
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $application = $user->getCurrentApplication();
        $programs = Program::active()->get()->groupBy('degree_level');
        $settings = SiteSetting::getOrCreate();
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

        return view('applicant.application', compact('application', 'programs', 'currentPeriod', 'documents', 'settings'));
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

        $programs = Program::active()->get()->groupBy('degree_level');
        $currentPeriod = $application->applicationPeriod;
        $documents = $application ? $application->getImportantDocuments() : collect();

        return response()
            ->view('applicant.application', compact('application', 'programs', 'currentPeriod', 'documents'))
            ->header('X-Update-Success', 'true');
    }

    public function submit(SubmitApplicationRequest $request)
    {
        $application = $request->getApplication();
        $requiredFields = [
            'nationality'           => __('applicant/review-and-submit.nationality'),
            'country_of_birth'      => __('applicant/review-and-submit.country_of_birth'),
            'passport_number'       => __('applicant/review-and-submit.passport_number'),
            'date_of_birth'         => __('applicant/review-and-submit.date_of_birth'),
            'native_language'       => __('applicant/review-and-submit.native_language'),
            'phone'                 => __('applicant/review-and-submit.phone'),
            'permanent_street'      => __('applicant/review-and-submit.permanent_street'),
            'previous_institution'  => __('applicant/review-and-submit.previous_institution'),
            'previous_gpa'          => __('applicant/review-and-submit.previous_gpa'),
            'degree_earned'         => __('applicant/review-and-submit.degree_earned'),
            'language_test_score'   => __('applicant/review-and-submit.language_test_score'),
            'language_test_date'    => __('applicant/review-and-submit.language_test_date'),
            'program_id'            => __('applicant/review-and-submit.program'),
            'application_period_id' => __('applicant/review-and-submit.start_term'),
            'family_status'         => __('applicant/review-and-submit.family_status'),
        ];

        $validator = Validator::make([], []);

        // Validate required fields
        foreach ($requiredFields as $field => $label) {
            if (empty($application->$field)) {
                $validator->errors()->add($field, __('messages.field_required', ['field' => $label]));
            }
        }

        // Validate required documents
        $this->validateRequiredDocuments($application, $validator);

        if ($validator->errors()->count() > 0) {
            return back()->withErrors($validator)->withInput();
        }

        $application->update([
            'status' => $application->status === 'require_resubmit' ? 're_submitted' : 'submitted',
            'submitted_at' => now(),
        ]);

        return back()->with('success', __('messages.application_submitted'));
    }

    /**
     * Validate that all required documents are uploaded
     */
    private function validateRequiredDocuments(Application $application, $validator)
    {
        $documentTypes = Document::getDocumentTypes();
        $uploadedDocuments = $application->documents()->pluck('type')->toArray();

        foreach ($documentTypes as $type => $config) {
            $isRequired = $config['required'];

            // Make visa_proof required if has_visa is true
            if ($type === 'visa_proof' && $application->has_visa == 1) {
                $isRequired = true;
            }

            if ($isRequired && ! in_array($type, $uploadedDocuments)) {
                $validator->errors()->add(
                    "document_{$type}",
                    __('messages.document_required', ['document' => __('documents.' . $type)])
                );
            }
        }
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
                Storage::disk('public')->delete($existingDocument->path);
                $existingDocument->delete();
            }
            $filename = Str::ulid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('documents/'.$application->id, $filename, 'public');
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

            return response()->json([
                'message' => __('messages.document_uploaded'),
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

    public function downloadDocument(int $application_id, int $file_id)
    {
        try {
            $document = Document::where('application_id', $application_id)
                ->where('id', $file_id)
                ->whereHas('application', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->firstOrFail();

            $path = 'documents/'.$application_id.'/'.$document->filename;

            if (! Storage::disk('public')->exists($path)) {
                abort(404, 'File not found');
            }

            return Storage::disk('public')->download($path, $document->original_name);

        } catch (\Exception $e) {
            \Log::error('Failed to download document: '.$e->getMessage(), [
                'application_id' => $application_id,
                'file_id' => $file_id,
            ]);

            abort(404, 'Document not found');
        }
    }

    public function removeDocument(int $application_id, int $file_id)
    {
        try {
            $document = Document::where('application_id', $application_id)
                ->where('id', $file_id)
                ->whereHas('application', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->firstOrFail();

            $path = 'documents/'.$application_id.'/'.$document->filename;
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $document->delete();

            return response()->json([
                'success' => true,
                'message' => __('messages.document_removed'),
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Failed to remove document: '.$e->getMessage(), [
                'application_id' => $application_id,
                'file_id' => $file_id,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to remove document: '.$e->getMessage(),
            ], 500);
        }
    }

    public function viewDocument(int $application_id, int $file_id)
    {
        try {
            $document = Document::where('application_id', $application_id)
                ->where('id', $file_id)
                ->whereHas('application', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->firstOrFail();

            $path = 'documents/'.$application_id.'/'.$document->filename;

            if (! Storage::disk('public')->exists($path)) {
                abort(404, 'File not found');
            }

            $fileContents = Storage::disk('public')->get($path);

            return response($fileContents)
                ->header('Content-Type', $document->mime_type)
                ->header('Content-Disposition', 'inline; filename="'.$document->original_name.'"')
                ->header('X-Frame-Options', 'SAMEORIGIN');

        } catch (\Exception $e) {
            \Log::error('Failed to view document: '.$e->getMessage(), [
                'application_id' => $application_id,
                'file_id' => $file_id,
            ]);

            abort(404, 'Document not found');
        }
    }
}
