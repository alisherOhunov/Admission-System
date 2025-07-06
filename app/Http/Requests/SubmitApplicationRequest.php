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

        ];
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
