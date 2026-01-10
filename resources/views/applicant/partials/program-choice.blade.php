<div x-show="currentStep === {{ $step }}" x-transition>
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white shadow-sm rounded-lg">
            <!-- Header Section -->
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2 sm:space-x-3 mb-3 sm:mb-4">
                    <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-target h-5 w-5 sm:h-6 sm:w-6">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </span>
                    <h1 class="text-xl sm:text-2xl font-medium text-gray-900">
                        {{ __('applicant/program-choice.program_selection') }}
                    </h1>
                </div>
                <p class="text-sm sm:text-base text-gray-600 mt-1">
                    {{ __('applicant/program-choice.program_description') }}
                </p>
            </div>

            <!-- Main Content -->
            <div class="p-4 sm:p-6">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-4 sm:space-y-6">
                        <div class="space-y-4 sm:space-y-6 pb-6 sm:pb-10 border-b border-gray-200">
                            <!-- Section Title -->
                            <div>
                                <p class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/program-choice.academic_program') }}
                                </p>
                            </div>

                            <!-- Program Selector -->
                            <div x-data="programSelector()">
                                <!-- Level Selection -->
                                <div class="mb-4">
                                    <label for="level" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/program-choice.level') }}
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="level" name="level" x-model="level" @change="onLevelChange()"
                                        class="block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">{{ __('applicant/program-choice.select_degree_level') }}</option>
                                        <option value="masters" @selected(old('level', $application->level ?? '') == 'masters')>
                                            {{ __('applicant/program-choice.graduate') }}
                                        </option>
                                        <option value="bachelors" @selected(old('level', $application->level ?? '') == 'bachelors')>
                                            {{ __('applicant/program-choice.undergraduate') }}
                                        </option>
                                    </select>
                                    <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                        {{ __('applicant/program-choice.level_placeholder') }}
                                    </p>
                                </div>

                                <!-- Program Selection -->
                                <div>
                                    <label for="program_of_study" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/program-choice.program_of_study') }}
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select id="program_of_study" name="program_id" x-model="programId"
                                        :disabled="!level"
                                        class="block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed">
                                        <option value="">{{ __('applicant/program-choice.select_program') }}</option>
                                        <template x-for="program in availablePrograms" :key="program.id">
                                            <option :value="program.id" x-text="program.name" :selected="programId == program.id"></option>
                                        </template>
                                    </select>
                                    <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                        {{ __('applicant/program-choice.program_of_study_placeholder') }}
                                    </p>
                                    @error('program_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Start Term -->
                            <div>
                                <label for="start_term" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/program-choice.start_term') }}
                                    <span class="text-red-500">*</span>
                                </label>
                                <select id="start_term" name="start_term"
                                    class="block w-full px-3 py-2 text-sm sm:text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">{{ __('applicant/program-choice.select_start_term') }}</option>
                                    <option value="fall2025" @selected(old('start_term', $application->start_term ?? '') == 'fall2025')>
                                        Fall 2025
                                    </option>
                                </select>
                                <p class="mt-2 text-xs sm:text-sm text-gray-500">
                                    {{ __('applicant/program-choice.start_term_placeholder') }}
                                </p>
                                @error('start_term')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dormitory Checkbox -->
                            <div>
                                <div class="flex items-start">
                                    <input id="needs_dormitory" name="needs_dormitory" type="checkbox" value="1"
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer mt-0.5"
                                        @checked(old('needs_dormitory', $application->needs_dormitory ?? false))>
                                    <label for="needs_dormitory" class="ml-2 block text-sm text-gray-700">
                                        {{ __('applicant/program-choice.needs_dormitory') }}
                                    </label>
                                </div>
                                @error('needs_dormitory')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Accommodation Link -->
                            <div>
                                <a href="https://tsuos.uz/en/talabalar-turar-joylari/" target="_blank" 
                                   class="text-sm sm:text-base text-blue-600 underline hover:text-blue-800 break-words">
                                    Information about student accommodation
                                </a>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span>{{ __('applicant/program-choice.documents_title') }}</span>
                                </h2>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">
                                    {{ __('applicant/program-choice.documents_description') }}
                                </p>
                            </div>

                            <!-- Upload Section -->
                            <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                                <!-- Motivation Letter Upload -->
                                <div x-data="documentUpload('motivation_letter', @js($documents->get('motivation_letter')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">
                                                {{ __('applicant/program-choice.document_motivation_letter') }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                                x-text="uploaded ? '{{ __('applicant/program-choice.uploaded') }}' : '{{ __('applicant/program-choice.optional') }}'">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">
                                            {{ __('applicant/program-choice.document_motivation_letter_hint') }}
                                        </p>
                                        <div class="text-xs text-gray-500">
                                            {{ __('applicant/program-choice.file_upload_formats_5mb') }}
                                        </div>
                                    </div>

                                    @error('document_motivation_letter')
                                        <div class="mb-2 sm:mb-3 p-2 sm:p-3 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-center">
                                                <svg class="h-4 w-4 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                                <p class="text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror

                                    <!-- Upload Area -->
                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-3 sm:p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center py-4 sm:py-6">
                                                <label for="motivation-letter-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">
                                                        {{ __('applicant/program-choice.upload_click') }}
                                                    </span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">
                                                        {{ __('applicant/program-choice.upload_drag') }}
                                                    </span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">
                                                        {{ __('applicant/program-choice.upload_file_formats_5mb') }}
                                                    </span>
                                                    <input id="motivation-letter-file" name="motivation_letter" type="file"
                                                        class="hidden" accept=".pdf,.doc,.docx"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">
                                                {{ __('applicant/program-choice.uploading') }}
                                            </span>
                                        </div>
                                    </div>

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
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate"
                                                        x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName">
                                                    </p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>
                                                @if (!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
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

                                <!-- CV Upload (same structure as motivation letter, keeping concise) -->
                                <div x-data="documentUpload('cv', @js($documents->get('cv')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">
                                                {{ __('applicant/program-choice.document_cv') }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                                x-text="uploaded ? '{{ __('applicant/program-choice.uploaded') }}' : '{{ __('applicant/program-choice.optional') }}'">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">
                                            {{ __('applicant/program-choice.document_cv_hint') }}
                                        </p>
                                        <div class="text-xs text-gray-500">
                                            {{ __('applicant/program-choice.file_upload_formats_5mb') }}
                                        </div>
                                    </div>

                                    <div x-show="!uploaded" x-transition
                                        class="border-2 border-dashed rounded-lg p-3 sm:p-4 text-center transition-colors"
                                        :class="isDragging ? 'border-blue-400 bg-blue-50' : 'border-gray-300 hover:border-gray-400'"
                                        @dragover.prevent="isDragging = true"
                                        @dragleave.prevent="isDragging = false"
                                        @drop.prevent="handleDrop($event)">

                                        <div x-show="!uploading">
                                            <div class="flex flex-col items-center justify-center py-4 sm:py-6">
                                                <label for="cv-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">
                                                        {{ __('applicant/program-choice.upload_click') }}
                                                    </span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">
                                                        {{ __('applicant/program-choice.upload_drag') }}
                                                    </span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">
                                                        {{ __('applicant/program-choice.upload_file_formats_5mb') }}
                                                    </span>
                                                    <input id="cv-file" name="cv" type="file" class="hidden" accept=".pdf,.doc,.docx"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">
                                                {{ __('applicant/program-choice.uploading') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div x-show="uploaded" x-transition class="bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-6 w-6 sm:h-8 sm:w-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate"
                                                        x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName">
                                                    </p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <template x-if="fileId">
                                                    <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                        class="text-green-600 hover:text-green-800 transition-colors" aria-label="Download document">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </template>
                                                @if (!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
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

                                <!-- Document Tips -->
                                <div class="flex items-start space-x-2 sm:space-x-3 rounded-lg border border-blue-200 bg-blue-50 p-3 sm:p-4 text-blue-700">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>
                                    <div class="text-left flex-1">
                                        <p class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">
                                            {{ __('applicant/program-choice.document_requirements_title') }}
                                        </p>
                                        <ul class="text-xs sm:text-sm space-y-1">
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
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between pt-6 sm:pt-8 pb-4 sm:pb-6 px-4 sm:px-6 border-t mt-6 sm:mt-8 gap-3 sm:gap-0">
                <!-- Previous Button -->
                <button type="button" @click="currentStep = 3"
                    class="flex items-center justify-center sm:justify-start px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 order-2 sm:order-1">
                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    {{ __('applicant/program-choice.previous') }}
                </button>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 order-1 sm:order-2">
                    <!-- Save Progress Button -->
                    <button type="submit"
                        class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                        @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))>
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <span class="hidden sm:inline">{{ __('applicant/program-choice.save_progress') }}</span>
                        <span class="sm:hidden">{{ __('Save') }}</span>
                    </button>

                    <!-- Next Button -->
                    <button @click="currentStep = 5" type="button"
                        class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('applicant/program-choice.next') }}
                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
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