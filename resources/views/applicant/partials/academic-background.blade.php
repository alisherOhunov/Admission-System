<div x-show="currentStep === {{$step}}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap h-5 w-5 text-brand-600">
                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                            <path d="M22 10v6"></path><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                        </svg>
                        <span class="text-lg font-medium">{{ __('applicant/academic-background.step_title') }}</span>
                    </div>
                </div>
                <p class="text-gray-600 mt-1">
                {{ __('applicant/academic-background.step_description') }}
                </p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="border-b border-gray-200">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="flex  items-center space-x-2 mb-4">
                                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap h-6 w-6"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                                            <path d="M22 10v6"></path>
                                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                        </svg>
                                    </span>
                                    
                                    <h3 class="text-lg font-medium text-gray-900">
                                    {{ __('applicant/academic-background.academic_background') }}
                                    </h3>
                                </div>
                            </div>
                            <p class="text-lg text-gray-600 mb-6">
                                {{ __('applicant/academic-background.academic_description') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ __('applicant/academic-background.previous_education') }}</p>
                            </div>
                            <div>
                                <label
                                for="previousInstitution"
                                class="block text-sm font-medium text-gray-700"
                                >{{ __('applicant/academic-background.previous_institution') }} <span class="text-red-500">*</span></label
                                >
                                <input
                                    value="{{ old('previous_institution', $application->previous_institution ?? '') }}"
                                    type="text"
                                    id="previousInstitution"
                                    name="previous_institution"
                                    placeholder="{{ __('applicant/academic-background.previous_institution_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                <p class="mt-2 text-gray-500">{{ __('applicant/academic-background.previous_institution_help') }}</p>
                                @error('previous_institution')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="degreeEarned"
                                    class="block text-sm font-medium text-gray-700"
                                    >{{ __('applicant/academic-background.degree_earned') }} <span class="text-red-500">*</span>
                                </label
                                >
                                <input
                                    value="{{ old('degree_earned', $application->degree_earned ?? '') }}"
                                    type="text"
                                    id="degreeEarned"
                                    name="degree_earned"
                                    placeholder="{{ __('applicant/academic-background.degree_earned_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                @error('degree_earned')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 py-6 border-b border-gray-200">
                            <div>
                                <label
                                for="gpa"
                                class="block text-sm font-medium text-gray-700"
                                >{{ __('applicant/academic-background.gpa_grade') }}
                                <span class="text-red-500">*</span></label
                                >
                                <input
                                value="{{ old('previous_gpa', $application->previous_gpa ?? '') }}"
                                type="text"
                                id="gpa"
                                name="previous_gpa"
                                placeholder="{{ __('applicant/academic-background.gpa_placeholder') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                <p class="mt-2 text-gray-500">{{ __('applicant/academic-background.gpa_help') }}</p>
                                @error('previous_gpa')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label
                                    for="graduation_date"
                                    class="block text-sm font-medium text-gray-700"
                                    >{{ __('applicant/academic-background.graduation_date') }}
                                    </label
                                    >
                                    <input
                                    value="{{ old('graduation_date', isset($application->graduation_date) ? $application->graduation_date->format('Y-m-d') : '') }}"
                                    type="date"
                                    id="graduation_date"
                                    name="graduation_date"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    />
                                    <p class="mt-2 text-gray-500">{{ __('applicant/academic-background.graduation_date_help') }}</p>
                                    @error('graduation_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">{{ __('applicant/academic-background.english_proficiency') }}</p>
                                </div>
                                <div>
                                    <label
                                    for="english-test-type"
                                    class="block text-sm font-medium text-gray-700"
                                    >{{ __('applicant/academic-background.english_test_type') }}</label
                                    >
                                    <select
                                        id="english-test-type"
                                        name="english_test_type"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    >
                                        <option value="">{{ __('applicant/academic-background.select_test_type') }}</option>
                                        <option value="IELTS" @selected(old('english_test_type', $application->english_test_type ?? '') == 'IELTS')>{{ __('applicant/academic-background.ielts_academic') }}</option>
                                        <option value="TOEFL" @selected(old('english_test_type', $application->english_test_type ?? '') == 'TOEFL')>{{ __('applicant/academic-background.toefl_ibt') }}</option>
                                        <option value="DUOLINGO" @selected(old('english_test_type', $application->english_test_type ?? '') == 'DUOLINGO')>{{ __('applicant/academic-background.duolingo') }}</option>
                                        <option value="CAMBRIDGE" @selected(old('english_test_type', $application->english_test_type ?? '') == 'CAMBRIDGE')>{{ __('applicant/academic-background.cambridge') }}</option>
                                        <option value="PTE" @selected(old('english_test_type', $application->english_test_type ?? '') == 'PTE')>{{ __('applicant/academic-background.pte_academic') }}</option>
                                        <option value="OTHER" @selected(old('english_test_type', $application->english_test_type ?? '') == 'OTHER')>{{ __('applicant/academic-background.other') }}</option>
                                    </select>
                                    <p class="mt-2 text-gray-500">{{ __('applicant/academic-background.english_test_type_help') }}</p>
                                    @error('english_test_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                    for="testScore"
                                    class="block text-sm font-medium text-gray-700"
                                    >{{ __('applicant/academic-background.test_score') }} <span class="text-red-500">*</span></label
                                    >
                                    <input
                                    value="{{ old('english_test_score', $application->english_test_score ?? '') }}"
                                    type="text"
                                    id="testScore"
                                    name="english_test_score"
                                    placeholder="{{ __('applicant/academic-background.test_score_placeholder') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    />
                                    @error('english_test_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label
                                            for="english_test_date"
                                            class="block text-sm font-medium text-gray-700"
                                            >{{ __('applicant/academic-background.test_date') }} <span class="text-red-500">*</span>
                                        </label
                                        >
                                        <input
                                            value="{{ old('english_test_date', isset($application->english_test_date) ? $application->english_test_date->format('Y-m-d') : '') }}"
                                            type="date"
                                            id="english_test_date"
                                            name="english_test_date"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        />
                                        @error('english_test_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex items-start space-2 rounded-md border border-blue-200 bg-blue-50 p-4 text-left text-blue-800">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe h-5 w-5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                            <path d="M2 12h20"></path>
                                        </svg>
                                        </div>
                                        <div class="text-left ml-3">
                                        <h4 class="font-semibold mb-2">{{ __('applicant/academic-background.ielts_info_title') }}</h4>
                                        <p class="text-sm"></p>
                                    </div>
                                </div>
                                <div class="flex items-start rounded-md border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 mt-1"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>

                                    <div class="ml-3 text-left">
                                        <h4 class="text-sm font-medium mb-2">
                                            {{ __('applicant/academic-background.requirements_title') }}
                                        </h4>
                                        <ul class="text-sm space-y-1">
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
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3
                                class="text-lg font-medium flex items-center space-x-2"
                                >
                                <svg
                                    class="h-5 w-5 text-blue-600"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                    ></path>
                                </svg>
                                <span>{{ __('applicant/academic-background.academic_documents') }}</span>
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">
                                {{ __('applicant/academic-background.academic_documents_description') }}
                                </p>
                            </div>

                            <div class="p-6 space-y-4">
                                <!-- Transcripts Upload -->
                                <div x-data="documentUpload('transcript', @js($documents->get('transcript')))" class="border rounded-lg p-4">
                                    <div class="mb-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span class="text-md font-medium">{{ __('applicant/academic-background.official_transcripts') }}</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'"
                                                    x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.required') }}'">
                                            </span>
                                        </div>
                                        <p class="block text-xs text-gray-500 mb-2">{{ __('applicant/academic-background.transcripts_description') }}</p>
                                        <div class="text-xs text-gray-400">{{ __('applicant/academic-background.file_formats') }}</div>
                                    </div>
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                            'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <label for="transcript-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                        fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-md font-medium text-gray-900">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-sm text-gray-500">{{ __('applicant/academic-background.drag_drop') }}</span>
                                                    <span class="block text-md text-gray-500">{{ __('applicant/academic-background.pdf_max_size') }}</span>
                                                    <input id="transcript-file" name="transcript" type="file"
                                                        class="hidden" accept=".pdf"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center">
                                            <div
                                                class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                            </div>
                                            <span class="text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>
                                    @error('document_transcript')
                                        <div class="my-3 p-3 bg-red-50 border border-red-200 rounded-md">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                    <!-- Success State (shown after successful upload) -->
                                    <div x-show="uploaded" x-transition
                                        class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-green-900"
                                                        x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                    </p>
                                                    <p class="text-sm text-green-700">
                                                        <span x-text="fileSize"></span><br>
                                                        <span class="text-green-600">{{ __('applicant/academic-background.uploaded_successfully') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Download Button - only show when fileId exists -->
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors">
                                                        <svg class="h-5 w-5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>

                                                <!-- Remove Button -->
                                                @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                                    <button @click="removeFile()"
                                                        class="text-red-500 hover:text-red-700 transition-colors"
                                                        type="button">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="error" x-transition
                                        class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Diploma certificate Upload -->
                                 <div x-data="documentUpload('diploma', @js($documents->get('diploma')))" class="border rounded-lg p-4">
                                    <div class="mb-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span class="text-md font-medium">{{ __('applicant/academic-background.diploma_certificate') }}</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'"
                                                    x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.required') }}'">
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-2">{{ __('applicant/academic-background.diploma_description') }}</p>
                                        <div class="text-xs text-gray-400">{{ __('applicant/academic-background.diploma_formats') }}</div>
                                    </div>
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                            'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <label for="diploma-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                        fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-md font-medium text-gray-900">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-sm text-gray-500">{{ __('applicant/academic-background.drag_and_drop') }}</span>
                                                    <span class="block text-md text-gray-500">{{ __('applicant/academic-background.diploma_format_text') }}</span>
                                                    <input id="diploma-file" name="diploma" type="file"
                                                        class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center">
                                            <div
                                                class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                            </div>
                                            <span class="text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>
                                    @error('document_diploma')
                                        <div class="my-3 p-3 bg-red-50 border border-red-200 rounded-md">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                    <!-- Success State (shown after successful upload) -->
                                    <div x-show="uploaded" x-transition
                                        class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-green-900"
                                                        x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                    </p>
                                                    <p class="text-sm text-green-700">
                                                        <span x-text="fileSize"></span><br>
                                                        <span class="text-green-600">{{ __('applicant/academic-background.uploaded_successfully') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Download Button - only show when fileId exists -->
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors">
                                                        <svg class="h-5 w-5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>

                                                <!-- Remove Button -->
                                                @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                                    <button @click="removeFile()"
                                                        class="text-red-500 hover:text-red-700 transition-colors"
                                                        type="button">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="error" x-transition
                                        class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- English Test Score Upload -->
                                <div x-data="documentUpload('english_score', @js($documents->get('english_score')))" class="border rounded-lg p-4">
                                    <div class="mb-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span class="text-md font-medium">{{ __('applicant/academic-background.english_test_score') }}</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'"
                                                    x-text="uploaded ? '{{ __('applicant/academic-background.uploaded') }}' : '{{ __('applicant/academic-background.required') }}'">
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-2">{{ __('applicant/academic-background.english_score_description') }}</p>
                                        <div class="text-xs text-gray-400">{{ __('applicant/academic-background.english_score_formats') }}</div>
                                    </div>
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                            'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <label for="english_score-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                        fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-md font-medium text-gray-900">{{ __('applicant/academic-background.click_to_upload') }}</span>
                                                    <span class="text-sm text-gray-500">{{ __('applicant/academic-background.drag_and_drop') }}</span>
                                                    <span class="block text-md text-gray-500">{{ __('applicant/academic-background.english_score_format_text') }}</span>
                                                    <input id="english_score-file" name="english_score" type="file"
                                                        class="hidden" accept=".pdf"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                                @error('english_score')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center">
                                            <div
                                                class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                            </div>
                                            <span class="text-sm text-gray-600">{{ __('applicant/academic-background.uploading') }}</span>
                                        </div>
                                    </div>
                                    @error('document_english_score')
                                        <div class="my-3 p-3 bg-red-50 border border-red-200 rounded-md">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                    <!-- Success State (shown after successful upload) -->
                                    <div x-show="uploaded" x-transition
                                        class="bg-green-50 border border-green-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-green-900"
                                                        x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                    </p>
                                                    <p class="text-sm text-green-700">
                                                        <span x-text="fileSize"></span><br>
                                                        <span class="text-green-600">{{ __('applicant/academic-background.uploaded_successfully') }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Download Button - only show when fileId exists -->
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors">
                                                        <svg class="h-5 w-5" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>

                                                <!-- Remove Button -->
                                                @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                                    <button @click="removeFile()"
                                                        class="text-red-500 hover:text-red-700 transition-colors"
                                                        type="button">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="error" x-transition
                                        class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-start rounded-md border border-blue-200 bg-blue-50 p-4 text-blue-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 mt-1"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>

                                    <div class="ml-3 text-left">
                                        <h4 class="text-sm font-medium mb-2">
                                            {{ __('applicant/academic-background.document_requirements') }}
                                        </h4>
                                        <ul class="text-sm space-y-1">
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
                <div class="flex items-center justify-between pt-8 border-t mt-8">
                    <button type="button" @click="currentStep = 2" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('applicant/academic-background.previous') }}
                    </button>

                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                                @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected']))>
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <span>{{ __('applicant/academic-background.save_progress') }}</span>
                        </button>

                        <button type="button" @click="currentStep = 4" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
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