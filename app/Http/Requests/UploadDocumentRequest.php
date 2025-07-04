<?php

namespace App\Http\Requests;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    private ?Application $application = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $application_id = $this->route('application_id');
        $this->application = Application::find($application_id);

        return $this->application &&
               auth()->id() === $this->application->user_id &&
               $this->application->canEdit();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'document' => 'required|file|max:25600', // 25MB max
            'type' => 'required|in:passport,address_proof,transcript,diploma,sop,cv,english_score,portfolio',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasFile('document') && $this->has('type')) {
                $file = $this->file('document');
                $type = $this->input('type');

                $allowedTypes = $this->getAllowedMimeTypes($type);

                if (! in_array($file->getMimeType(), $allowedTypes)) {
                    $validator->errors()->add('document', 'Invalid file type for this document type.');
                }
            }
        });
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'document.required' => 'Please select a document to upload.',
            'document.file' => 'The uploaded file is invalid.',
            'document.max' => 'The document size cannot exceed 25MB.',
            'type.required' => 'Please specify the document type.',
            'type.in' => 'Invalid document type selected.',
        ];
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized to upload documents for this application');
    }

    /**
     * Get allowed MIME types for document type.
     */
    private function getAllowedMimeTypes($type): array
    {
        $mimeTypes = [
            'passport' => ['application/pdf', 'image/jpeg', 'image/png'],
            'address_proof' => ['application/pdf', 'image/jpeg', 'image/png'],
            'transcript' => ['application/pdf'],
            'diploma' => ['application/pdf', 'image/jpeg', 'image/png'],
            'sop' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'cv' => ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
            'english_score' => ['application/pdf'],
            'portfolio' => ['application/pdf', 'application/zip'],
        ];

        return $mimeTypes[$type] ?? [];
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }
}
