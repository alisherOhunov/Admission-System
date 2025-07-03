<div x-show="currentStep === {{ $step }}" x-transition>
    <!-- Main Container -->
    <div class="max-w-6xl mx-auto p-6 space-y-8">
      <!-- Header -->
      <div class="text-left">
        <div class="flex items-center space-x-3 mb-4">
          <h3 class="text-2xl font-bold text-gray-900">
            Review Your Application
          </h3>
        </div>
        <p class="text-gray-600 max-w-4xl">
          Please review all the information below before submitting your
          application. Make sure everything is accurate and complete.
        </p>
      </div>

      <!-- Completion Status Alert -->
      <div class="p-4 rounded-lg border flex items-start space-x-3 bg-green-50 border-green-200 text-green-800">
        <div class="text-left">
          <h4 class="font-semibold mb-1">Application Complete</h4>
          <p>
            Your application is ready for submission. Please review the details
            below.
          </p>
        </div>
      </div>

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
                <p class="text-gray-900">{{ $application->date_of_birth ? $application->date_of_birth->format('d F Y') : 'not specified' }}</p>
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
                <p class="text-gray-900">{{ $application->nationality ? $application->nationality : 'not specified' }}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-700 mb-1">
                  Passport Number
                </p>
                <p class="text-gray-900">{{$application->passport_number ? $application->passport_number : 'not specified'}}</p>
              </div>
            </div>

            <div>
              <p class="text-sm font-medium text-gray-700 mb-1">
                Native Language
              </p>
              <p class="text-gray-900">{{$application->native_language ? $application->native_language : 'not specified'}}</p>
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
                      <p class="text-gray-900">{{$application->phone ? $application->phone : 'not specified'}}</p>
                  </div>
              </div>

              <div>
                  <p class="text-sm font-medium text-gray-700 mb-2">Permanent Address</p>
                  
                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <p class="text-sm font-medium text-gray-700 mb-1">Street</p>
                          <p class="text-gray-900">{{$application->permanent_street ? $application->permanent_street : 'not specified'}}</p>
                      </div>
                      <div>
                          <p class="text-sm font-medium text-gray-700 mb-1">City</p>
                          <p class="text-gray-900">{{$application->permanent_city ? $application->permanent_city : 'not specified'}}</p>
                      </div>
                  </div>

                  <div class="grid grid-cols-2 gap-4 mt-3">
                      <div>
                          <p class="text-sm font-medium text-gray-700 mb-1">State</p>
                          <p class="text-gray-900">{{$application->permanent_state ? $application->permanent_state : 'not specified'}}</p>
                      </div>
                      <div>
                          <p class="text-sm font-medium text-gray-700 mb-1">Country</p>
                          <p class="text-gray-900">{{$application->permanent_country ? (config('countries')[$application->permanent_country] ?? 'not specified') : 'not specified'}}</p>
                      </div>
                  </div>

                  <div class="grid grid-cols-2 gap-4 mt-3">
                      <div>
                          <p class="text-sm font-medium text-gray-700 mb-1">Postcode</p>
                          <p class="text-gray-900">{{$application->permanent_postcode ? $application->permanent_postcode : 'not specified'}}</p>
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
              <p class="text-gray-900">{{$application->previous_institution ? $application->previous_institution : 'not specified'}}</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-700 mb-1">
                  Degree Earned
                </p>
                <p class="text-gray-900">{{$application->degree_earned ? $application->degree_earned : 'not specified'}}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-700 mb-1">GPA/Grade</p>
                <p class="text-gray-900">{{$application->previous_gpa ? $application->previous_gpa : 'not specified'}}</p>
              </div>
            </div>

            <div>
              <p class="text-sm font-medium text-gray-700 mb-1">
                Graduation Date
              </p>
              <p class="text-gray-900">{{ $application->graduation_date ? $application->graduation_date->format('d F Y') : 'not specified' }}</p>
            </div>

            <div class="space-y-2">
              <p class="text-sm font-medium text-gray-700">
                English Proficiency
              </p>
              <div class="flex items-center space-x-4 text-sm">
                <span class="text-gray-900">{{$application->english_test_type}}</span>
                <span class="text-gray-500">•</span>
                <span class="text-gray-900">Score: {{$application->english_test_score}}</span>
                <span class="text-gray-500">•</span>
                <span class="text-gray-700">{{ $application->english_test_date->format('d F Y')}}</span>
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
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Masters</span>
              </div>

              <div>
                <p class="text-sm font-medium text-gray-700 mb-1">
                  Start Term
                </p>
                <p class="text-gray-900">Fall 2024</p>
              </div>

              <div class="flex items-center space-x-2">
                <input
                  type="checkbox"
                  checked
                  readonly
                  class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                />
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
              {{$application->statement_of_purpose ? $application->statement_of_purpose : 'not specified'}}
            </p>
          </div>
          <div class="mt-4 text-sm text-gray-500">
            {{ $application->statement_of_purpose ? strlen($application->statement_of_purpose) : 0 }} characters
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
        <button type="button" @click="currentStep = 4" class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
          Back to Program Selection
        </button>

        <div class="flex flex-col sm:flex-row gap-3">
          <button class="bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2">
            Save Progress
          </button>
          <button 
                type="button"
                hx-post="{{ route('applicant.application.submit', ['applicationId' => $application->id]) }}"
                hx-include="form"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2"
            >
            Submit Application
          </button>
        </div>
      </div>
    </div>
</div>
  