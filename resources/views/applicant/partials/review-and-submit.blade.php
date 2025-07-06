<div x-show="currentStep === {{ $step }}" x-transition>
    <!-- Main Container -->
    <div class="max-w-4xl mx-auto bg-white">
        <div class="bg-white px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">5</span>
                    <span class="text-2xl font-medium">Review Your Application</span>
                </div>
            </div>
            <p class="text-gray-600 text-md mt-1">
                Please review all the information below before submitting your
                application. Make sure everything is accurate and complete.
            </p>
        </div>
        <div class="bg-white shadow-sm space-y-8 p-6">
            @if ($application->status === 'require_resubmit')
                <div class="bg-red-50 border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900 flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="orange"
                                    viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10
                          10-4.48 10-10S17.52 2 12 2zm0 15c-.83
                          0-1.5-.67-1.5-1.5S11.17 14 12
                          14s1.5.67 1.5 1.5S12.83 17 12
                          17zm1-4h-2V7h2v6z" />
                                </svg>
                                <span class="ml-1">
                                    Application Resubmission Comment
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2">
                        <div class="max-w-none">
                            <p class="text-gray-700 leading-relaxed">
                                {{ $application->admin_resubmission_comment }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div
                    class="p-4 rounded-lg border flex items-start space-x-3 bg-red-50 border-red-200 text-red-800 mb-4">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="text-left">
                        <h4 class="font-semibold mb-1">Please Complete all fields with valid inputs</h4>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Review Sections Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Personal Information Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                Personal Information
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    First Name
                                </p>
                                <p class="text-gray-900">{{ Auth::user()->first_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">Last Name</p>
                                <p class="text-gray-900">{{ Auth::user()->last_name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Date of Birth
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->date_of_birth ? $application->date_of_birth->format('d F Y') : 'not specified' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">Gender</p>
                                <p class="text-gray-900 capitalize">
                                    {{ $application->gender == 1 ? 'male' : ($application->gender == 2 ? 'female' : 'not specified') }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Nationality
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->nationality ? $application->nationality : 'not specified' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Passport Number
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->passport_number ? $application->passport_number : 'not specified' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                Native Language
                            </p>
                            <p class="text-gray-900">
                                {{ $application->native_language ? $application->native_language : 'not specified' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                Contact Information
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">Email</p>
                                <p class="text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">Phone</p>
                                <p class="text-gray-900">
                                    {{ $application->phone ? $application->phone : 'not specified' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">Permanent Address</p>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">Street</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_street ? $application->permanent_street : 'not specified' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">City</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_city ? $application->permanent_city : 'not specified' }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">State</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_state ? $application->permanent_state : 'not specified' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">Country</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_country ? config('countries')[$application->permanent_country] ?? 'not specified' : 'not specified' }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">Postcode</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_postcode ? $application->permanent_postcode : 'not specified' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Background Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                Academic Background
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                Previous Institution
                            </p>
                            <p class="text-gray-900">
                                {{ $application->previous_institution ? $application->previous_institution : 'not specified' }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Degree Earned
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->degree_earned ? $application->degree_earned : 'not specified' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">GPA/Grade</p>
                                <p class="text-gray-900">
                                    {{ $application->previous_gpa ? $application->previous_gpa : 'not specified' }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                Graduation Date
                            </p>
                            <p class="text-gray-900">
                                {{ $application->graduation_date ? $application->graduation_date->format('d F Y') : 'not specified' }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700">
                                English Proficiency
                            </p>
                            <div class="flex items-center space-x-4 text-sm">
                                <span class="text-gray-900">{{ $application->english_test_type }}</span>
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-900">Score: {{ $application->english_test_score }}</span>
                                <span class="text-gray-500">•</span>
                                <span
                                    class="text-gray-700">{{ $application->english_test_date->format('d F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Program Selection Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                Program Selection
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Selected Program
                                </p>
                                <p class="text-lg font-semibold text-gray-900">
                                    Master of Science in Computer Science
                                </p>
                                <p class="text-gray-600">School of Engineering</p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Masters</span>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    Start Term
                                </p>
                                <p class="text-gray-900">Fall 2024</p>
                            </div>

                            <div class="flex items-center space-x-2">
                              <input type="checkbox" disabled 
                                    {{ $application->funding_interest ? 'checked' : '' }} 
                                    readonly
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                              <span class="text-sm text-gray-700">
                                  Interested in scholarships and financial aid
                              </span>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statement of Purpose -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-6 pb-4">
                    <div class="flex items-center space-x-3">
                        <h4 class="text-lg font-semibold text-gray-900">
                            Statement of Purpose
                        </h4>
                    </div>
                </div>
                <div class="p-6 pt-2">
                    <div class="max-w-none">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $application->statement_of_purpose ? $application->statement_of_purpose : 'not specified' }}
                        </p>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        {{ $application->statement_of_purpose ? strlen($application->statement_of_purpose) : 0 }}
                        characters
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="p-4 rounded-lg border flex items-start space-x-3 bg-blue-50 border-blue-200 text-blue-800">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-triangle" class="h-5 w-5"></i>
                </div>
                <div class="text-left">
                    <h4 class="font-semibold mb-2">Before Submitting</h4>
                    <ul class="text-sm space-y-1">
                        <li>• Review all information carefully for accuracy</li>
                        <li>• Ensure all required documents have been uploaded</li>
                        <li>
                            • Double-check contact information for communication purposes
                        </li>
                        <li>
                            • Once submitted, you cannot make changes without contacting
                            admissions
                        </li>
                        <li>• You will receive a confirmation email after submission</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between">
                <button type="button" @click="currentStep = 4"
                    class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                    Back to Program Selection
                </button>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button
                        class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                        Save Progress
                    </button>
                    <button type="button" id="submit-btn"
                        hx-post="{{ route('applicant.application.update', ['application_id' => $application->id]) }}"
                        hx-target="#form-content" hx-headers='{"X-Submit-Action": "true"}'
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
                        Submit Application
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
