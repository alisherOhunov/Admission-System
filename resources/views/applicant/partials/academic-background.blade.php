<div x-show="currentStep === {{$step}}" x-transition>
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white shadow-sm rounded-lg">
            <!-- Header Section -->
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap h-5 w-5 sm:h-6 sm:w-6">
                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                            <path d="M22 10v6"></path>
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                        </svg>
                    </span>
                    <h1 class="text-xl sm:text-2xl font-medium text-gray-900">
                        {{ __('applicant/academic-background.academic_background') }}
                    </h1>
                </div>
                <p class="text-gray-600 text-sm sm:text-base mt-2 sm:mt-1">
                    {{ __('applicant/academic-background.academic_description') }}
                </p>
            </div>

            <!-- Main Content -->
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-4 sm:space-y-6">
                        <!-- Previous Education Section -->
                        <div class="space-y-4 sm:space-y-6">
                            <div>
                                <p class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/academic-background.previous_education') }}
                                </p>
                            </div>

                            <!-- Previous Institution -->
                            <div>
                                <label for="previousInstitution" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/academic-background.previous_institution') }} 
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    value="{{ old('previous_institution', $application->previous_institution ?? '') }}"
                                    type="text"
                                    id="previousInstitution"
                                    name="previous_institution"
                                    placeholder="{{ __('applicant/academic-background.previous_institution_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                />
                                <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                    {{ __('applicant/academic-background.previous_institution_help') }}
                                </p>
                                @error('previous_institution')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Degree Earned -->
                            <div>
                                <label for="degreeEarned" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/academic-background.degree_earned') }} 
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    value="{{ old('degree_earned', $application->degree_earned ?? '') }}"
                                    type="text"
                                    id="degreeEarned"
                                    name="degree_earned"
                                    placeholder="{{ __('applicant/academic-background.degree_earned_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                />
                                @error('degree_earned')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- GPA and Graduation Date Section -->
                        <div class="space-y-4 sm:space-y-6 pt-4 sm:pt-6 border-t border-gray-200">
                            <!-- GPA/Grade -->
                            <div>
                                <label for="gpa" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/academic-background.gpa_grade') }}
                                    <span class="text-red-500">*</span>
                                </label>
                                <input
                                    value="{{ old('previous_gpa', $application->previous_gpa ?? '') }}"
                                    type="text"
                                    id="gpa"
                                    name="previous_gpa"
                                    placeholder="{{ __('applicant/academic-background.gpa_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                />
                                <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                    {{ __('applicant/academic-background.gpa_help') }}
                                </p>
                                @error('previous_gpa')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Graduation Date -->
                            <div>
                                <label for="graduation_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/academic-background.graduation_date') }}
                                </label>
                                <input
                                    value="{{ old('graduation_date', isset($application->graduation_date) ? $application->graduation_date->format('Y-m-d') : '') }}"
                                    type="date"
                                    id="graduation_date"
                                    name="graduation_date"
                                    class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                />
                                <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                    {{ __('applicant/academic-background.graduation_date_help') }}
                                </p>
                                @error('graduation_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Language Proficiency Section -->
                            <div class="space-y-4 sm:space-y-6">
                                <div>
                                    <p class="text-base sm:text-lg font-semibold text-gray-900">
                                        {{ __('applicant/academic-background.language_proficiency') }}
                                    </p>
                                </div>

                                <!-- Language Test Type -->
                                <div>
                                    <label for="language-test-type" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/academic-background.language_test_type') }}
                                    </label>
                                    <select
                                        id="language-test-type"
                                        name="language_test_type"
                                        class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">{{ __('applicant/academic-background.select_test_type') }}</option>
                                        <option value="IELTS" @selected(old('language_test_type', $application->language_test_type ?? '') == 'IELTS')>{{ __('applicant/academic-background.ielts_academic') }}</option>
                                        <option value="TOEFL" @selected(old('language_test_type', $application->language_test_type ?? '') == 'TOEFL')>{{ __('applicant/academic-background.toefl_ibt') }}</option>
                                        <option value="Duolingo" @selected(old('language_test_type', $application->language_test_type ?? '') == 'Duolingo')>{{ __('applicant/academic-background.duolingo') }}</option>
                                        <option value="No Certificate" @selected(old('language_test_type', $application->language_test_type ?? '') == 'No Certificate')>{{ __('applicant/academic-background.no_certificate') }}</option>
                                        <option value="Other" @selected(old('language_test_type', $application->language_test_type ?? '') == 'OTHER')>{{ __('applicant/academic-background.other') }}</option>
                                    </select>
                                    <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                        {{ __('applicant/academic-background.language_test_type_help') }}
                                    </p>
                                    @error('language_test_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Test Score -->
                                <div>
                                    <label for="testScore" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/academic-background.test_score') }} 
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        value="{{ old('language_test_score', $application->language_test_score ?? '') }}"
                                        type="text"
                                        id="testScore"
                                        name="language_test_score"
                                        placeholder="{{ __('applicant/academic-background.test_score_placeholder') }}"
                                        class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    />
                                    @error('language_test_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Test Date -->
                                <div>
                                    <label for="language_test_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/academic-background.test_date') }} 
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        value="{{ old('language_test_date', isset($application->language_test_date) ? $application->language_test_date->format('Y-m-d') : '') }}"
                                        type="date"
                                        id="language_test_date"
                                        name="language_test_date"
                                        class="mt-1 block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    />
                                    @error('language_test_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Info Boxes -->
                                <div class="flex items-start space-x-2 sm:space-x-3 rounded-md border border-blue-200 bg-blue-50 p-3 sm:p-4 text-left text-blue-800">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe h-4 w-4 sm:h-5 sm:w-5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                            <path d="M2 12h20"></path>
                                        </svg>
                                    </div>
                                    <div class="text-left flex-1">
                                        <p class="font-semibold text-sm sm:text-base mb-1 sm:mb-2">
                                            {{ __('applicant/academic-background.ielts_info_title') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-2 sm:space-x-3 rounded-md border border-yellow-200 bg-yellow-50 p-3 sm:p-4 text-yellow-700">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>
                                    <div class="text-left flex-1">
                                        <p class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">
                                            {{ __('applicant/academic-background.requirements_title') }}
                                        </p>
                                        <ul class="text-xs sm:text-sm space-y-1">
                                            @foreach(__('applicant/academic-background.requirements') as $requirement)
                                                <li>• {{ $requirement }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column - Document Upload -->
                    <div>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit">
                            <!-- Header -->
                            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                                <h2 class="text-base sm:text-lg font-medium flex items-center space-x-2">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span>{{ __('applicant/academic-background.academic_documents') }}</span>
                                </h2>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">
                                    {{ __('applicant/academic-background.academic_documents_description') }}
                                </p>
                            </div>

                            <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                                <!-- Diploma Certificate Upload -->
                                <div x-data="documentUpload('diploma', @js($documents->get('diploma')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">{{ __('applicant/academic-background.diploma_certificate') }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                                x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.required') }}'">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ __('applicant/academic-background.diploma_description') }}</p>
                                        <div class="text-xs text-gray-500">{{ __('applicant/academic-background.diploma_formats') }}</div>
                                    </div>

                                    <!-- Upload Area -->
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-3 sm:p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center py-4 sm:py-6">
                                                <label for="diploma-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">{{ __('applicant/academic-background.drag_and_drop') }}</span>
                                                    <span class="block text-xs sm:text-sm text-gray-500 mt-1">{{ __('applicant/academic-background.diploma_format_text') }}</span>
                                                    <input id="diploma-file" name="diploma" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>

                                    @error('document_diploma')
                                        <div class="my-2 sm:my-3 p-2 sm:p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror

                                    <!-- Success State -->
                                    <div x-show="uploaded" x-transition class="bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate" x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName"></p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </a>
                                                </template>
                                                @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
                                                        class="text-red-500 hover:text-red-700 transition-colors" type="button">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="error" x-transition class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4 mt-2">
                                        <div class="flex items-start">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-red-400 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs sm:text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transcripts Upload (Similar structure, keeping it concise) -->
                                <div x-data="documentUpload('transcript', @js($documents->get('transcript')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">{{ __('applicant/academic-background.official_transcripts') }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                                                x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.required') }}'">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ __('applicant/academic-background.transcripts_description') }}</p>
                                        <div class="text-xs text-gray-500">{{ __('applicant/academic-background.file_formats') }}</div>
                                    </div>

                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-3 sm:p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center py-4 sm:py-6">
                                                <label for="transcript-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">{{ __('applicant/academic-background.drag_drop') }}</span>
                                                    <span class="block text-xs sm:text-sm text-gray-500 mt-1">{{ __('applicant/academic-background.pdf_max_size') }}</span>
                                                    <input id="transcript-file" name="transcript" type="file" class="hidden" accept=".pdf" @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>

                                    @error('document_transcript')
                                        <div class="my-2 sm:my-3 p-2 sm:p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror

                                    <div x-show="uploaded" x-transition class="bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate" x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName"></p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </a>
                                                </template>
                                                @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
                                                        class="text-red-500 hover:text-red-700 transition-colors" type="button">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="error" x-transition class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4 mt-2">
                                        <div class="flex items-start">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-red-400 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs sm:text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Language Certificate Upload -->
                                <div x-data="documentUpload('language_certificate', @js($documents->get('language_certificate')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">{{ __('applicant/academic-background.language_certificate') }}</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                                x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.optional') }}'">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">{{ __('applicant/academic-background.language_certificate_description') }}</p>
                                        <div class="text-xs text-gray-500">{{ __('applicant/academic-background.language_certificate_formats') }}</div>
                                    </div>

                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-3 sm:p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center py-4 sm:py-6">
                                                <label for="language_certificate-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">{{ __('applicant/academic-background.drag_and_drop') }}</span>
                                                    <span class="block text-xs sm:text-sm text-gray-500 mt-1">{{ __('applicant/academic-background.language_certificate_format_text') }}</span>
                                                    <input id="language_certificate-file" name="language_certificate" type="file" class="hidden" accept=".pdf" @change="handleFileSelect($event)">
                                                </label>
                                                @error('language_certificate')
                                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>

                                    @error('document_language_certificate')
                                        <div class="my-2 sm:my-3 p-2 sm:p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror

                                    <div x-show="uploaded" x-transition class="bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate" x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName"></p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </a>
                                                </template>
                                                @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
                                                        class="text-red-500 hover:text-red-700 transition-colors" type="button">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="error" x-transition class="bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4 mt-2">
                                        <div class="flex items-start">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-red-400 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs sm:text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Document Requirements Info Box -->
                                <div class="flex items-start space-x-2 sm:space-x-3 rounded-lg border border-blue-200 bg-blue-50 p-3 sm:p-4 text-blue-700">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>
                                    <div class="text-left flex-1">
                                        <p class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">
                                            {{ __('applicant/academic-background.document_requirements') }}
                                        </p>
                                        <ul class="text-xs sm:text-sm space-y-1">
                                            <li>{{ __('applicant/academic-background.requirement_clear') }}</li>
                                            <li>{{ __('applicant/academic-background.requirement_original') }}</li>
                                            <li>{{ __('applicant/academic-background.requirement_translation') }}</li>
                                            <li>{{ __('applicant/academic-background.requirement_filename') }}</li>
                                            <li>{{ __('applicant/academic-background.requirement_pages') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between pt-6 sm:pt-8 border-t mt-6 sm:mt-8 gap-3 sm:gap-0">
                    <!-- Previous Button -->
                    <button type="button" @click="currentStep = 2" 
                        class="flex items-center justify-center sm:justify-start px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 order-2 sm:order-1">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('applicant/academic-background.previous') }}
                    </button>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 order-1 sm:order-2">
                        <!-- Save Progress Button -->
                        <button type="submit"
                            class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                            @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))>
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <span class="hidden sm:inline">{{ __('applicant/academic-background.save_progress') }}</span>
                            <span class="sm:hidden">{{ __('Save') }}</span>
                        </button>

                        <!-- Next Button -->
                        <button type="button" @click="currentStep = 4" 
                            class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('applicant/academic-background.next') }}
                            <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>