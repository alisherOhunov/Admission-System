<?php

namespace App\Http\Requests;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;

class SubmitApplicationRequest extends FormRequest
{
    private ?Application $application = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $applicationId = $this->route('applicationId');
        $this->application = Application::find($applicationId);

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

        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $application = auth()->user()->getCurrentApplication();

        if (! $application) {
            return;
        }

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

        $missingFields = [];
        foreach ($requiredFields as $field) {
            if (empty($application->$field)) {
                $missingFields[] = $field;
            }
        }

        if (! empty($missingFields)) {
            // Add validation errors for missing fields
            $this->getValidatorInstance()->after(function ($validator) use ($missingFields) {
                $validator->errors()->add('required_fields', 'Please complete all required fields before submitting: '.implode(', ', $missingFields));
            });
        }
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'required_fields' => 'Please complete all required fields before submitting.',
        ];
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Cannot submit this application');
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }
}
