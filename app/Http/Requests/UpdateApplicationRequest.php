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
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'date_of_birth.before' => 'Date of birth must be before today.',
            'graduation_date.before_or_equal' => 'Graduation date cannot be in the future.',
            'english_test_date.before_or_equal' => 'English test date cannot be in the future.',
            'statement_of_purpose.min' => 'Statement of purpose must be at least 100 characters.',
            'statement_of_purpose.max' => 'Statement of purpose cannot exceed 5000 characters.',
            'phone.regex' => 'Please enter a valid phone number.',
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
