<div x-show="currentStep === {{ $step }}" x-transition>
    <!-- Main Container -->
    <div class="max-w-4xl mx-auto bg-white">
        <div class="bg-white px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            <path d="M12 8.5l.95 1.93 2.13.31-1.54 1.5.36 2.1-1.9-1-1.9 1 .36-2.1-1.54-1.5 2.13-.31L12 8.5z"/>
                        </svg>
                    </span>

                    <span class="text-2xl font-medium">{{ __('applicant/review-and-submit.page_title') }}</span>
                </div>
            </div>
            <p class="text-gray-600 text-md mt-1">
                {{ __('applicant/review-and-submit.page_description') }}
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
                                    {{ __('applicant/review-and-submit.resubmission_title') }}
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
                        <h4 class="font-semibold mb-1">{{ __('applicant/review-and-submit.error_title') }}</h4>
                        <ul class="list-disc list-inside space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if (session('success'))
                <div class="p-4 rounded-lg border flex items-start space-x-3 bg-green-50 border-green-200 text-green-800 mb-4">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <div class="text-left">
                        <h4 class="font-semibold mb-1">Success!</h4>
                        <p class="text-sm">{{ session('success') }}</p>
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
                                {{ __('applicant/review-and-submit.personal_information') }}
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.first_name') }}
                                </p>
                                <p class="text-gray-900">{{ Auth::user()->first_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.last_name') }}</p>
                                <p class="text-gray-900">{{ Auth::user()->last_name }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.date_of_birth') }}
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->date_of_birth ? $application->date_of_birth->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.gender') }}</p>
                                <p class="text-gray-900 capitalize">
                                    {{ $application->gender == 1 ? __('applicant/review-and-submit.male') : ($application->gender == 2 ? __('applicant/review-and-submit.female') : __('applicant/review-and-submit.not_specified')) }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.nationality') }}
                                </p>
                                <p class="text-gray-900">
                                    @if ($application->nationality)
                                        @foreach (config('countries') as $code => $name)
                                            <p class="text-gray-900">{{ $application->nationality == $code ? $name : '' }}
                                            </p>
                                        @endforeach
                                    @else
                                    {{ __('applicant/review-and-submit.not_specified') }}</p>
                                    @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.passport_number') }}
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->passport_number ? $application->passport_number : __('applicant/review-and-submit.not_specified') }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                {{ __('applicant/review-and-submit.native_language') }}
                            </p>
                            <p class="text-gray-900">
                                {{ $application->native_language ? $application->native_language : __('applicant/review-and-submit.not_specified') }}
                            </p>
                        </div>
                        @if (isset($documents['passport']))
                            <div>
                                <p class="text-md font-semibold text-gray-800 mb-2">
                                    Uploaded documents
                                </p>
                                
                                <div class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                            Passport
                                        </p>
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $documents['passport']['original_name'] }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="/applicant/application/{{ $application->id }}/download-document/{{ $documents['passport']['id'] }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                        title="{{ __('Download') }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                {{ __('applicant/review-and-submit.contact_information') }}
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.email') }}</p>
                                <p class="text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.phone') }}</p>
                                <p class="text-gray-900">
                                    {{ $application->phone ? $application->phone : __('applicant/review-and-submit.not_specified') }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-2">{{ __('applicant/review-and-submit.permanent_address') }}</p>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.street') }}</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_street ? $application->permanent_street : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.city') }}</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_city ? $application->permanent_city : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.state') }}</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_state ? $application->permanent_state : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.country') }}</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_country ? config('countries')[$application->permanent_country] ?? __('applicant/review-and-submit.not_specified') : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.postcode') }}</p>
                                    <p class="text-gray-900">
                                        {{ $application->permanent_postcode ? $application->permanent_postcode : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if (isset($documents['address_proof']))
                            <div>
                                <p class="text-md font-semibold text-gray-800 mb-2">
                                    Uploaded documents
                                </p>
                                
                                <div class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                            Address Proof
                                        </p>
                                        <p class="text-sm font-medium text-gray-800">
                                            {{ $documents['address_proof']['original_name'] }}
                                        </p>
                                    </div>
                                    <div>
                                        <a href="/applicant/application/{{ $application->id }}/download-document/{{ $documents['address_proof']['id'] }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                        title="{{ __('Download') }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Academic Background Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                {{ __('applicant/review-and-submit.academic_background') }}
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                {{ __('applicant/review-and-submit.previous_institution') }}
                            </p>
                            <p class="text-gray-900">
                                {{ $application->previous_institution ? $application->previous_institution : __('applicant/review-and-submit.not_specified') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.degree_earned') }}
                                </p>
                                <p class="text-gray-900">
                                    {{ $application->degree_earned ? $application->degree_earned : __('applicant/review-and-submit.not_specified') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">{{ __('applicant/review-and-submit.gpa_grade') }}</p>
                                <p class="text-gray-900">
                                    {{ $application->previous_gpa ? $application->previous_gpa : __('applicant/review-and-submit.not_specified') }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">
                                {{ __('applicant/review-and-submit.graduation_date') }}
                            </p>
                            <p class="text-gray-900">
                                {{ $application->graduation_date ? $application->graduation_date->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                            </p>
                        </div>

                        <div class="space-y-2">
                            <p class="text-sm font-medium text-gray-700">
                                {{ __('applicant/review-and-submit.english_proficiency') }}
                            </p>
                            <div class="flex items-center space-x-4 text-sm">
                                <span class="text-gray-900">{{ $application->english_test_type }}</span>
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-900">{{ __('applicant/review-and-submit.score') }}: {{ $application->english_test_score }}</span>
                                <span class="text-gray-500">•</span>
                                <span class="text-gray-700">
                                    {{ optional($application->english_test_date)->format('Y/m/d') ?? __('applicant/review-and-submit.not_submitted_yet') }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-2">
                                Uploaded Documents
                            </p>

                            @foreach (['transcript' => 'Transcript', 'diploma' => 'Diploma', 'english_score' => 'English Score'] as $key => $label)
                                @if (isset($documents[$key]))
                                    <div class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm mb-2">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                {{ $label }}
                                            </p>
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $documents[$key]['original_name'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <a href="/applicant/application/{{ $application->id }}/download-document/{{ $documents[$key]['id'] }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Download">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Program Selection Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                    <div class="p-6 pb-4">
                        <div class="flex items-center space-x-3">
                            <h4 class="text-lg font-semibold text-gray-900">
                                {{ __('applicant/review-and-submit.program_selection') }}
                            </h4>
                        </div>
                    </div>
                    <div class="p-6 pt-2 space-y-4">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.selected_program') }}
                                </p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.program_name') }}
                                </p>
                                <p class="text-gray-600">{{ __('applicant/review-and-submit.school_name') }}</p>
                            </div>

                            <div class="flex items-center space-x-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ __('applicant/review-and-submit.masters_badge') }}</span>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.start_term') }}
                                </p>
                                <p class="text-gray-900">{{ __('applicant/review-and-submit.fall_2024') }}</p>
                            </div>

                            <div class="flex items-center space-x-2">
                              <input type="checkbox" disabled 
                                    {{ $application->funding_interest ? 'checked' : '' }} 
                                    readonly
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                                <span class="text-sm text-gray-700">
                                    {{ __('applicant/review-and-submit.scholarship_interest') }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800 mb-2">
                                Uploaded Documents
                            </p>

                            @foreach (['sop' => 'Statement of Purpose', 'cv' => 'Curriculum Vitae (CV)', 'portfolio' => 'Portfolio'] as $key => $label)
                                @if (isset($documents[$key]))
                                    <div class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm mb-2">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                {{ $label }}
                                            </p>
                                            <p class="text-sm font-medium text-gray-800">
                                                {{ $documents[$key]['original_name'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <a href="/applicant/application/{{ $application->id }}/download-document/{{ $documents[$key]['id'] }}"
                                            class="text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Download">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statement of Purpose -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-6 pb-4">
                    <div class="flex items-center space-x-3">
                        <h4 class="text-lg font-semibold text-gray-900">
                            {{ __('applicant/review-and-submit.motivation_letter') }}
                        </h4>
                    </div>
                </div>
                <div class="p-6 pt-2">
                    <div class="max-w-none">
                        <p class="text-gray-700 leading-relaxed">
                            {{ $application->motivation_letter ? $application->motivation_letter : __('applicant/review-and-submit.not_specified') }}
                        </p>
                    </div>
                    <div class="mt-4 text-sm text-gray-500">
                        {{ $application->motivation_letter ? strlen($application->motivation_letter) : 0 }}
                        {{ __('applicant/review-and-submit.characters') }}
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="p-4 rounded-lg border flex items-start space-x-3 bg-blue-50 border-blue-200 text-blue-800">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-triangle" class="h-5 w-5"></i>
                </div>
                <div class="text-left">
                    <h4 class="font-semibold mb-2">{{ __('applicant/review-and-submit.before_submitting') }}</h4>
                    <ul class="text-sm space-y-1">
                        <li>• {{ __('applicant/review-and-submit.review_notice_1') }}</li>
                        <li>• {{ __('applicant/review-and-submit.review_notice_2') }}</li>
                        <li>• {{ __('applicant/review-and-submit.review_notice_3') }}</li>
                        <li>• {{ __('applicant/review-and-submit.review_notice_4') }}</li>
                        <li>• {{ __('applicant/review-and-submit.review_notice_5') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-between">
                <button type="button" @click="currentStep = 4"
                    class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Previous
                </button>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                            @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected']))>
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <span>{{ __('applicant/review-and-submit.save_progress') }}</span>
                    </button>
                    <button type="button" 
                        hx-post="{{ route('applicant.application.submit', ['application_id' => $application->id]) }}"
                        hx-target="#form-content"
                        hx-select="#form-content"
                        hx-indicator="#loading-overlay"
                        @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected']))
                        class="bg-blue-600 hover:enabled:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-200 disabled:hover:bg-gray-400">
                        @if ($application->status === 'require_resubmit')
                            {{ __('applicant/review-and-submit.submit_application') }}
                        @else
                            {{ __('applicant/review-and-submit.submit_application') }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
