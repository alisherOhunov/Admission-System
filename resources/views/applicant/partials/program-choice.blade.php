<div x-show="currentStep === {{ $step }}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-3 mb-4">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-target h-6 w-6">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </span>
                    <h1 class="text-2xl font-medium">
                        {{ __('applicant/program-choice.program_selection') }}
                    </h1>
                </div>
                <p class="text-md text-gray-600 mt-1">
                    {{ __('applicant/program-choice.program_description') }}
                </p>
            </div>

            <div class="p-6">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 pb-10 gap-6 border-b border-gray-200">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ __('applicant/program-choice.academic_program') }}</p>
                            </div>
                            <div x-data="programSelector()">
                                <div class="mb-4">
                                    <label for="level"
                                        class="block text-sm font-medium text-gray-700">{{ __('applicant/program-choice.level') }}<span
                                            class="text-red-500">*</span></label>
                                    <select id="level" name="level" x-model="level" @change="onLevelChange()"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="">{{ __('applicant/program-choice.select_degree_level') }}</option>
                                        <option value="masters" @selected(old('level', $application->level ?? '') == 'masters')>{{ __('applicant/program-choice.graduate') }}</option>
                                        <option value="bachelors" @selected(old('level', $application->level ?? '') == 'bachelors')>{{ __('applicant/program-choice.undergraduate') }}</option>
                                    </select>
                                    <p class="mt-2 text-gray-500">
                                        {{ __('applicant/program-choice.level_placeholder') }}</p>
                                </div>

                                <div>
                                    <label for="program_of_study"
                                        class="block text-sm font-medium text-gray-700">{{ __('applicant/program-choice.program_of_study') }}<span
                                            class="text-red-500">*</span></label>
                                    <select id="program_of_study" name="program_id" x-model="programId"
                                        :disabled="!level"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm disabled:bg-gray-100 disabled:cursor-not-allowed">
                                        <option value="">{{ __('applicant/program-choice.select_program') }}</option>
                                        
                                        <template x-for="program in availablePrograms" :key="program.id">
                                            <option :value="program.id" x-text="program.name"  :selected="programId == program.id"></option>
                                        </template>
                                    </select>
                                    <p class="mt-2 text-gray-500">
                                        {{ __('applicant/program-choice.program_of_study_placeholder') }}</p>
                                    @error('program_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="application_period_id"
                                    class="block text-sm font-medium text-gray-700">{{ __('applicant/program-choice.start_term') }}<span
                                        class="text-red-500">*</span></label>
                                <select id="application_period_id" name="application_period_id"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">{{ __('applicant/program-choice.select_start_term') }}</option>

                                    @if($application->application_period_id && $application->applicationPeriod && $application->application_period_id != $currentPeriod->id)
                                        <option value="{{ $application->application_period_id }}" selected disabled>
                                            {{ $application->applicationPeriod->name }} ({{ __('applicant/program-choice.closed') }})
                                        </option>
                                    @endif

                                    <option value="{{ $currentPeriod->id }}" @selected(old('application_period_id', $application->application_period_id ?? '') == $currentPeriod->id)>
                                        {{ $currentPeriod->name }}
                                    </option>
                                </select>
                                <p class="mt-2 text-gray-500">
                                    {{ __('applicant/program-choice.start_term_placeholder') }}</p>
                                @error('application_period_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <input id="needs_dormitory" name="needs_dormitory" type="checkbox" value="1"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer"
                                        @checked(old('needs_dormitory', $application->needs_dormitory ?? false))>
                                    <label for="needs_dormitory" class="ml-2 mt-4 block text-sm text-gray-700">
                                        {{ __('applicant/program-choice.needs_dormitory') }}
                                    </label>
                                </div>
                                @error('needs_dormitory')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <a href="{{ $settings->student_accommodation_link }}" target="_blank" class="text-blue-600 underline">
                                {{ __('admin/settings.student_accommodation_link') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Document Upload -->
                    <div>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-medium flex items-center space-x-2">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span>{{ __('applicant/program-choice.documents_title') }}</span>
                                </h2>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ __('applicant/program-choice.documents_description') }}
                                </p>
                            </div>

                            <div class="p-6 space-y-4">
                                <!-- Statement of Purpose Upload -->
                                <div x-data="documentUpload('motivation_letter', @js($documents->get('motivation_letter')))" class="border rounded-lg p-4">
                                    <div class="mb-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span
                                                class="text-md font-medium">{{ __('applicant/program-choice.document_motivation_letter') }}</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' :
                                                    'bg-gray-100 text-gray-800'"
                                                    x-text="uploaded ? '{{ __('applicant/program-choice.uploaded') }}' : '{{ __('applicant/program-choice.optional') }}'">
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-2">
                                            {{ __('applicant/program-choice.document_motivation_letter_hint') }}</p>
                                        <div class="text-xs text-gray-500">
                                            {{ __('applicant/program-choice.file_upload_formats_5mb') }}</div>
                                    </div>
                                    @error('document_motivation_letter')
                                        <div class="mb-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                            'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <label for="motivation-letter-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span
                                                        class="text-md font-medium text-gray-900">{{ __('applicant/program-choice.upload_click') }}</span>
                                                    <span
                                                        class="text-sm text-gray-500">{{ __('applicant/program-choice.upload_drag') }}</span>
                                                    <span
                                                        class="text-md text-gray-500">{{ __('applicant/program-choice.upload_file_formats_5mb') }}</span>
                                                    <input id="motivation-letter-file" name="motivation_letter" type="file"
                                                        class="hidden" accept=".pdf,.doc,.docx"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center">
                                            <div
                                                class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                            </div>
                                            <span
                                                class="text-sm text-gray-600">{{ __('applicant/program-choice.uploading') }}</span>
                                        </div>
                                    </div>

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
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Download Button - only show when fileId exists -->
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>

                                                <!-- Remove Button -->
                                                @if (!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
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

                                <!-- CV Upload -->
                                <div x-data="documentUpload('cv', @js($documents->get('cv')))" class="border rounded-lg p-4">
                                    <div class="mb-3">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span
                                                class="text-md font-medium">{{ __('applicant/program-choice.document_cv') }}</span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' :
                                                    'bg-gray-100 text-gray-800'"
                                                x-text="uploaded ? '{{ __('applicant/program-choice.uploaded') }}' : '{{ __('applicant/program-choice.optional') }}'">
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-2">
                                            {{ __('applicant/program-choice.document_cv_hint') }}</p>
                                        <div class="text-xs text-gray-500">
                                            {{ __('applicant/program-choice.file_upload_formats_5mb') }}</div>
                                    </div>

                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                            'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <label for="cv-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span
                                                        class="text-md font-medium text-gray-900">{{ __('applicant/program-choice.upload_click') }}</span>
                                                    <span
                                                        class="text-sm text-gray-500">{{ __('applicant/program-choice.upload_drag') }}</span>
                                                    <span
                                                        class="text-md text-gray-500">{{ __('applicant/program-choice.upload_file_formats_5mb') }}</span>
                                                    <input id="cv-file" name="cv" type="file"
                                                        class="hidden" accept=".pdf,.doc,.docx"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center">
                                            <div
                                                class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                            </div>
                                            <span
                                                class="text-sm text-gray-600">{{ __('applicant/program-choice.uploading') }}</span>
                                        </div>
                                    </div>

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
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <!-- Download Button - only show when fileId exists -->
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>

                                                <!-- Remove Button -->
                                                @if (!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
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

                                <div
                                    class="flex items-start rounded-lg border border-blue-200 bg-blue-50 p-4 text-blue-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>

                                    <div class="ml-3 text-left">
                                        <p class="text-sm font-medium mb-2">
                                            {{ __('applicant/program-choice.document_requirements_title') }}
                                        </p>
                                        <ul class="text-sm space-y-1">
                                            <li>{{ __('applicant/program-choice.doc_tip_1') }}</li>
                                            <li>{{ __('applicant/program-choice.doc_tip_2') }}</li>
                                            <li>{{ __('applicant/program-choice.doc_tip_3') }}</li>
                                            <li>{{ __('applicant/program-choice.doc_tip_4') }}</li>
                                            <li>{{ __('applicant/program-choice.doc_tip_5') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex items-center justify-between pt-8 pb-6 px-6 border-t mt-8">
                <button type="button" @click="currentStep = 3"
                    class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    {{ __('applicant/program-choice.previous') }}
                </button>

                <div class="flex items-center space-x-4">
                    <button type="submit"
                        class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                        @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))>
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <span>{{ __('applicant/program-choice.save_progress') }}</span>
                    </button>

                    <button @click="currentStep = 5" type="button"
                        class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        {{ __('applicant/program-choice.next') }}
                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function programSelector() {
    return {
        level: '{{ old('level', $application->level ?? '') }}',
        programId: '{{ old('program_id', $application->program_id ?? '') }}',
        programs: @json($programs),
        
        get availablePrograms() {
            if (!this.level) return [];
            return this.programs[this.level] || [];
        },
        
        onLevelChange() {
            this.programId = '';
        },
    };
}
</script>