<div x-show="currentStep === {{ $step }}" x-transition>
    <!-- Main Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white shadow-sm rounded-lg">
            <!-- Header -->
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:h-6 sm:w-6">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                <path d="M12 8.5l.95 1.93 2.13.31-1.54 1.5.36 2.1-1.9-1-1.9 1 .36-2.1-1.54-1.5 2.13-.31L12 8.5z"/>
                            </svg>
                        </span>
                        <span class="text-xl sm:text-2xl font-medium text-gray-900">
                            {{ __('applicant/review-and-submit.page_title') }}
                        </span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm sm:text-base mt-2 sm:mt-1">
                    {{ __('applicant/review-and-submit.page_description') }}
                </p>
            </div>

            <!-- Main Content -->
            <div class="shadow-sm space-y-6 sm:space-y-8 p-4 sm:p-6">
                <!-- Resubmission Notice -->
                @if ($application->status === 'require_resubmit')
                    <div class="bg-red-50 border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="orange" viewBox="0 0 24 24" class="flex-shrink-0 h-5 w-5 sm:h-6 sm:w-6">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 15c-.83 0-1.5-.67-1.5-1.5S11.17 14 12 14s1.5.67 1.5 1.5S12.83 17 12 17zm1-4h-2V7h2v6z" />
                                </svg>
                                <h1 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.resubmission_title') }}
                                </h1>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2">
                            <div class="max-w-none">
                                <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                                    {{ $application->admin_resubmission_comment }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="p-3 sm:p-4 rounded-lg border flex items-start space-x-2 sm:space-x-3 bg-red-50 border-red-200 text-red-800">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-left flex-1">
                            <p class="text-base sm:text-xl font-semibold mb-1">{{ __('applicant/review-and-submit.error_title') }}</p>
                            <ul class="list-disc list-inside space-y-1 text-xs sm:text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="p-3 sm:p-4 rounded-lg border flex items-start space-x-2 sm:space-x-3 bg-green-50 border-green-200 text-green-800">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-left flex-1">
                            <p class="font-semibold mb-1 text-sm sm:text-base">Success!</p>
                            <p class="text-xs sm:text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Review Sections Grid -->
                <div class="grid grid-cols-1 gap-6 sm:gap-8">
                    <!-- Personal Information Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:h-6 sm:w-6">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.personal_information') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.first_name') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('first_name')"></p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.last_name') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('last_name')"></p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.date_of_birth') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" 
                                        x-text="getFieldValue('date_of_birth') || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.gender') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" 
                                        x-text="getFieldValue('gender') == 1 
                                                ? '{{ __('applicant/review-and-submit.male') }}' 
                                                : (getFieldValue('gender') == 2 
                                                    ? '{{ __('applicant/review-and-submit.female') }}' 
                                                    : '{{ __('applicant/review-and-submit.not_specified') }}')">
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.family_status') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" 
                                        x-text="getFieldValue('family_status') == 1 
                                                ? '{{ __('applicant/review-and-submit.single') }}' 
                                                : (getFieldValue('family_status') == 2 
                                                    ? '{{ __('applicant/review-and-submit.married') }}' 
                                                    : '{{ __('applicant/review-and-submit.not_specified') }}')">
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.passport_number') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900 break-all" 
                                        x-text="getFieldValue('passport_number') || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.nationality') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" 
                                        x-text="getCountryName(getFieldValue('nationality')) || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.native_language') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900" 
                                        x-text="getFieldValue('native_language') || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700">Country of Birth</p>
                                <p class="text-sm sm:text-base text-gray-900" 
                                    x-text="getCountryName(getFieldValue('country_of_birth')) || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                </p>
                            </div>

                            <!-- Documents -->
                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                    {{ __('applicant/review-and-submit.uploaded_documents') }}
                                </p>
                                <div x-show="getDocuments()['passport']">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Passport</p>
                                            <p class="text-sm font-medium text-gray-800 truncate" x-text="getDocuments()['passport']?.original_name"></p>
                                        </div>
                                        <div class="flex items-center space-x-3 flex-shrink-0">
                                            <a :href="`/applicant/application/{{ $application->id }}/view-document/${getDocuments()['passport']?.id}`"
                                                target="_blank" class="text-green-600 hover:text-green-800 transition-colors" title="View">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a :href="`/applicant/application/{{ $application->id }}/download-document/${getDocuments()['passport']?.id}`"
                                                class="text-blue-600 hover:text-blue-800 transition-colors" title="Download">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="!getDocuments()['passport']" class="flex items-center justify-center py-4 text-gray-500">
                                    <span class="text-xs sm:text-sm">No documents uploaded yet!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Information Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:h-6 sm:w-6">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.contact_information') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.email') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900 break-all" x-text="getFieldValue('email')"></p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.phone') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('phone') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-2">{{ __('applicant/review-and-submit.permanent_address') }}</p>

                                <div class="space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.street') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('permanent_street') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.city') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('permanent_city') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.state') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('permanent_state') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.country') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900" x-text="getCountryName(getFieldValue('permanent_country')) || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.postcode') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('permanent_postcode') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700">Do you Have a visa?</p>
                                            <p class="text-sm sm:text-base text-gray-900" 
                                                x-text="getFieldValue('has_visa') == '1' ? 'Yes' : (getFieldValue('has_visa') == '0' ? 'No' : '{{ __('applicant/review-and-submit.not_specified') }}')"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Visa Document -->
                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">{{ __('applicant/review-and-submit.uploaded_documents') }}</p>
                                <div x-show="getDocuments()['visa_proof']">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Visa Proof</p>
                                            <p class="text-sm font-medium text-gray-800 truncate" x-text="getDocuments()['visa_proof']?.original_name"></p>
                                        </div>
                                        <div class="flex items-center space-x-3 flex-shrink-0">
                                            <a :href="`/applicant/application/{{ $application->id }}/view-document/${getDocuments()['visa_proof']?.id}`"
                                                target="_blank" class="text-green-600 hover:text-green-800 transition-colors" title="View">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a :href="`/applicant/application/{{ $application->id }}/download-document/${getDocuments()['visa_proof']?.id}`"
                                                class="text-blue-600 hover:text-blue-800 transition-colors" title="Download">
                                                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div x-show="!getDocuments()['visa_proof']" class="flex items-center justify-center py-4 text-gray-500">
                                    <span class="text-xs sm:text-sm">No documents uploaded yet!</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Background Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:h-6 sm:w-6">
                                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                                        <path d="M22 10v6"></path>
                                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.academic_background') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.previous_institution') }}</p>
                                <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('previous_institution') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.degree_earned') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('degree_earned') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.gpa_grade') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('previous_gpa') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.graduation_date') }}</p>
                                <p class="text-sm sm:text-base text-gray-900" x-text="getFieldValue('graduation_date') || '{{ __('applicant/review-and-submit.not_specified') }}'"></p>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs sm:text-sm font-medium text-gray-700">{{ __('applicant/review-and-submit.language_proficiency') }}</p>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 text-xs sm:text-sm space-y-1 sm:space-y-0">
                                    <span class="text-gray-900" x-text="getFieldValue('language_test_type')"></span>
                                    <span class="hidden sm:inline text-gray-500">•</span>
                                    <span class="text-gray-900" x-text="`{{ __('applicant/review-and-submit.score') }}: ${getFieldValue('language_test_score')}`"></span>
                                    <span class="hidden sm:inline text-gray-500">•</span>
                                    <span class="text-gray-700" x-text="getFieldValue('language_test_date') || '{{ __('applicant/review-and-submit.not_submitted_yet') }}'"></span>
                                </div>
                            </div>

                            <!-- Academic Documents -->
                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">{{ __('applicant/review-and-submit.uploaded_documents') }}</p>
                                <div class="space-y-2">
                                    <template x-for="[key, label] in [['transcript', 'Transcript'], ['diploma', 'Diploma'], ['language_certificate', 'Language Certificate']]" :key="key">
                                        <div x-show="getDocuments()[key]" class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1" x-text="label"></p>
                                                <p class="text-sm font-medium text-gray-800 truncate" x-text="getDocuments()[key]?.original_name"></p>
                                            </div>
                                            <div class="flex items-center space-x-3 flex-shrink-0">
                                                <a :href="`/applicant/application/{{ $application->id }}/view-document/${getDocuments()[key]?.id}`"
                                                    target="_blank" class="text-green-600 hover:text-green-800 transition-colors" title="View">
                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a :href="`/applicant/application/{{ $application->id }}/download-document/${getDocuments()[key]?.id}`"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors" title="Download">
                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div x-show="!['transcript', 'diploma', 'language_certificate'].some(key => getDocuments()[key])" class="flex items-center justify-center py-4 text-gray-500">
                                    <span class="text-xs sm:text-sm">No documents uploaded yet!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Program Selection Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 sm:h-6 sm:w-6">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.program_selection') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div class="space-y-3 sm:space-y-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.selected_program') }}
                                    </p>
                                    <p class="text-base sm:text-lg font-semibold text-gray-900 capitalize" 
                                        x-text="getProgramName(getFieldValue('program_id')) || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-600 capitalize" 
                                        x-text="getFieldValue('level') || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.start_term') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900 capitalize" 
                                        x-text="getFieldValue('start_term')?.replace(/([a-zA-Z]+)(\d+)/, '$1 $2') || '{{ __('applicant/review-and-submit.not_specified') }}'">
                                    </p>
                                </div>

                                <div class="flex items-start">
                                    <input type="checkbox" disabled id="needs_dormitory"
                                        :checked="getFieldValue('needs_dormitory')"
                                        readonly
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5" />
                                    <label for="needs_dormitory" class="ml-2 text-xs sm:text-sm text-gray-700" 
                                        x-text="'{{ __('applicant/program-choice.needs_dormitory') }}'">
                                    </label>
                                </div>
                            </div>

                            <!-- Program Documents -->
                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                    {{ __('applicant/review-and-submit.uploaded_documents') }}
                                </p>
                                <div class="space-y-2">
                                    <template x-for="[key, label] in [['motivation_letter', 'Motivation Letter'], ['cv', 'CV']]" :key="key">
                                        <div x-show="getDocuments()[key]" class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1" x-text="label"></p>
                                                <p class="text-sm font-medium text-gray-800 truncate" x-text="getDocuments()[key]?.original_name"></p>
                                            </div>
                                            <div class="flex items-center space-x-3 flex-shrink-0">
                                                <a :href="`/applicant/application/{{ $application->id }}/view-document/${getDocuments()[key]?.id}`"
                                                    target="_blank" class="text-green-600 hover:text-green-800 transition-colors" title="View">
                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a :href="`/applicant/application/{{ $application->id }}/download-document/${getDocuments()[key]?.id}`"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors" title="Download">
                                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div x-show="!['motivation_letter', 'cv'].some(key => getDocuments()[key])" class="flex items-center justify-center py-4 text-gray-500">
                                    <span class="text-xs sm:text-sm">No documents uploaded yet!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="p-3 sm:p-4 rounded-lg border flex items-start space-x-2 sm:space-x-3 bg-blue-50 border-blue-200 text-blue-800">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                        </svg>
                    </div>
                    <div class="text-left flex-1">
                        <h3 class="text-base sm:text-lg font-semibold mb-2">{{ __('applicant/review-and-submit.before_submitting') }}</h3>
                        <ul class="text-xs sm:text-sm space-y-1">
                            <li>• {{ __('applicant/review-and-submit.review_notice_1') }}</li>
                            <li>• {{ __('applicant/review-and-submit.review_notice_2') }}</li>
                            <li>• {{ __('applicant/review-and-submit.review_notice_3') }}</li>
                            <li>• {{ __('applicant/review-and-submit.review_notice_4') }}</li>
                            <li>• {{ __('applicant/review-and-submit.review_notice_5') }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-between">
                    <!-- Previous Button -->
                    <button type="button" @click="currentStep = 4"
                        class="flex items-center justify-center sm:justify-start px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 order-2 sm:order-1">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('applicant/review-and-submit.previous') }}
                    </button>

                    <!-- Save and Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 order-1 sm:order-2">
                        <!-- Save Progress Button -->
                        <button type="submit"
                            class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                            @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))>
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <span class="hidden sm:inline">{{ __('applicant/review-and-submit.save_progress') }}</span>
                            <span class="sm:hidden">{{ __('Save') }}</span>
                        </button>

                        <!-- Submit Application Button -->
                        <button type="submit" 
                            data-action="update-and-submit"
                            @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))
                            class="bg-blue-600 hover:enabled:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:text-gray-200 disabled:hover:bg-gray-400 text-sm">
                            @if ($application->status === 'require_resubmit')
                                <span class="hidden sm:inline">{{ __('applicant/review-and-submit.submit_application') }}</span>
                                <span class="sm:hidden">{{ __('Resubmit') }}</span>
                            @else
                                <span class="hidden sm:inline">{{ __('applicant/review-and-submit.submit_application') }}</span>
                                <span class="sm:hidden">{{ __('Submit') }}</span>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

