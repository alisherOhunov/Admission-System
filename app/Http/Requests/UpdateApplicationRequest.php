<?php

namespace App\Http\Requests;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    private ?Application $application = null;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $application_id = $this->route('application_id');
        $this->application = Application::with('applicationPeriod')->find($application_id);

        return $this->application &&
               auth()->id() === $this->application->user_id &&
               $this->application->canEdit();
    }

    /**
     * Prepare the data for validation.
     * This runs BEFORE validation, so we can ensure needs_dormitory is always present.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'needs_dormitory' => $this->has('needs_dormitory'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:128',
            'country_of_birth' => 'nullable|string|max:128',
            'passport_number' => 'nullable|string|max:20',
            'family_status' => 'sometimes|nullable|in:1,2',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'sometimes|nullable|in:1,2',
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
            'has_visa' => 'nullable|boolean',
            'previous_institution' => 'nullable|string|max:200',
            'previous_gpa' => 'nullable|string|max:10',
            'degree_earned' => 'nullable|string|max:64',
            'graduation_date' => 'sometimes|nullable|date|before_or_equal:today',
            'language_test_type' => 'sometimes|nullable|in:IELTS,TOEFL,Duolingo,Other',
            'language_test_score' => 'sometimes|nullable|string|max:20',
            'language_test_date' => 'sometimes|nullable|date|before_or_equal:today',
            'level' => 'nullable|in:bachelors,masters',
            'program_id' => 'nullable|exists:programs,id',
            'start_term' => 'nullable|string|max:50',
            'needs_dormitory' => 'boolean',
        ];
    }

    /**
     * Handle a failed authorization attempt.
     */
    protected function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Cannot edit this application');
    }

    public function getApplication(): ?Application
    {
        return $this->application;
    }
}
