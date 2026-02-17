<div x-show="currentStep === {{ $step }}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2 mb-4">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-6 w-6">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <h1 class="text-2xl font-medium">{{ __('applicant/personal-info.section_title')}}</h1>
                </div>
                <p class="text-gray-600 text-md mt-1">
                    {{ __('applicant/personal-info.section_subtitle')}}
                </p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">
                                    {{ __('applicant/personal-info.first_name')}}<span class="text-red-500">*</span>
                                </label>
                                <input
                                    autocomplete="first-name"
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    placeholder="{{ __('applicant/personal-info.first_name_placeholder') }}"
                                    value="{{ old('first_name', Auth::user()->first_name) }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                >
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">{{ __('applicant/personal-info.last_name')}}
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="last_name" name="last_name" placeholder="{{ __('applicant/personal-info.last_name_placeholder') }}" value="{{ old('last_name', Auth::user()->last_name) }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                >
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                    {{ __('applicant/personal-info.date_of_birth')}} <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth', isset($application->date_of_birth) ? $application->date_of_birth->format('Y-m-d') : '') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">{{ __('applicant/personal-info.gender')}}</label>
                                <select id="gender" name="gender"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                >
                                    <option value="">{{ __('applicant/personal-info.select_gender')}}</option>
                                    <option value="1" @selected(old('gender', $application->gender ?? '') == '1')>{{ __('applicant/personal-info.gender_male')}}</option>
                                    <option value="2" @selected(old('gender', $application->gender ?? '') == '2')>{{ __('applicant/personal-info.gender_female')}}</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="family_status" class="block text-sm font-medium text-gray-700">{{ __('applicant/personal-info.family_status')}}
                                <span class="text-red-500">*</span>
                                </label>
                                <select id="family_status" name="family_status"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                >
                                    <option value="">{{ __('applicant/personal-info.select_family_status')}}</option>
                                    <option value="1" @selected(old('family_status', $application->family_status ?? '') == '1')>{{ __('applicant/personal-info.family_status_single')}}</option>
                                    <option value="2" @selected(old('family_status', $application->family_status ?? '') == '2')>{{ __('applicant/personal-info.family_status_married')}}</option>
                                </select>
                                @error('family_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="passport_number" class="block text-sm font-medium text-gray-700">
                                    {{ __('applicant/personal-info.passport_number')}} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="passport_number" name="passport_number" placeholder="{{ __('applicant/personal-info.passport_number_placeholder') }}"
                                    value="{{ old('passport_number', $application->passport_number ?? '') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">
                                @error('passport_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="nationality" class="block text-sm font-medium text-gray-700">{{ __('applicant/personal-info.nationality')}}
                                    <span class="text-red-500">*</span></label>
                                    <select name="nationality" aria-label="{{ __('applicant/personal-info.select_nationality') }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                    >
                                    <option value="" class="text-muted-foreground">{{ __('applicant/personal-info.select_nationality') }}</option>
                                    @foreach (config('countries') as $code => $name)
                                        <option value="{{ $code }}" @selected(old('nationality', $application->nationality ?? '') == $code)>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('nationality')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="native_language" class="block text-sm font-medium text-gray-700">
                                    {{ __('applicant/personal-info.native_language')}} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="native_language" name="native_language" placeholder="{{ __('applicant/personal-info.native_language_placeholder') }}"
                                value="{{ old('native_language', $application->native_language ?? '') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">
                                @error('native_language')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="country_of_birth" class="block text-sm font-medium text-gray-700">{{ __('applicant/personal-info.country_of_birth') }}
                                <span class="text-red-500">*</span></label>
                                <select name="country_of_birth" aria-label="{{ __('applicant/personal-info.select_country_of_birth') }}"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                >
                                <option value="" class="text-muted-foreground">{{ __('applicant/personal-info.select_country_of_birth') }}</option>
                                @foreach (config('countries') as $code => $name)
                                    <option value="{{ $code }}" @selected(old('country_of_birth', $application->country_of_birth ?? '') == $code)>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('country_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-start bg-blue-50 border border-blue-200 rounded-md p-4 text-blue-700">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                </svg>
                            </div>
                            <div class="ml-3 text-left">
                                <p class="text-sm font-medium mb-2">{{ __('applicant/personal-info.note_title')}}</p>
                                <ul class="text-sm space-y-1">
                                    <li>{{ __('applicant/personal-info.note_1')}}</li>
                                    <li>{{ __('applicant/personal-info.note_2')}}</li>
                                    <li>{{ __('applicant/personal-info.note_3')}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
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
                                    <span>{{ __('applicant/personal-info.documents_section_title')}}</span>
                                </h2>
                                <p class="text-sm text-gray-600 mt-1">{{ __('applicant/personal-info.documents_section_description')}}</p>
                            </div>

                            <div class="p-6 space-y-4">
                                <div>
                                    <div x-data="documentUpload('passport', @js($documents->get('passport')))" class="border rounded-lg p-4">
                                        <div class="mb-3">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <svg class="h-4 w-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <span class="text-md font-medium">{{ __('applicant/personal-info.passport_label')}}</span>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                    :class="uploaded ? 'bg-green-100 text-green-800' :
                                                        'bg-red-100 text-red-800'"
                                                    x-text="uploaded ? '{{ __('applicant/personal-info.uploaded') }}' : '{{ __('applicant/personal-info.required') }}'">
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-2">
                                                {{ __('applicant/personal-info.passport_description')}}
                                            </p>
                                            <div class="text-xs text-gray-500">
                                                {{ __('applicant/personal-info.passport_formats')}}
                                            </div>
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
                                                    <label for="passport-file" class="cursor-pointer">
                                                        <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                            fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        <span class="text-md font-medium text-gray-900">
                                                            {{ __('applicant/personal-info.upload_click')}}
                                                        </span>
                                                        <span class="text-sm text-gray-500">{{ __('applicant/personal-info.upload_or_drag')}}</span>
                                                        <span class="text-md text-gray-500">
                                                            {{ __('applicant/personal-info.upload_formats')}}
                                                        </span>
                                                        <input id="passport-file" name="passport" type="file"
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
                                                <span class="text-sm text-gray-600">{{ __('applicant/personal-info.uploading')}}</span>
                                            </div>
                                        </div>
                                        @error('document_passport')
                                            <div class="my-3 p-3 bg-red-50 border border-red-200 rounded-lg">
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
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <!-- Download Button - only show when fileId exists -->
                                                    <template x-if="fileId">
                                                        <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                            class="text-green-600 hover:text-green-800 transition-colors"  aria-label="Download document">
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
                                                    @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
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
                                </div>

                                <div class="flex items-start bg-blue-50 border border-blue-200 rounded-lg p-3 text-blue-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>
                                    <div class="ml-3 text-left">
                                        <p class="text-sm font-medium mb-1">{{ __('applicant/personal-info.upload_tips_title')}}</p>
                                        <ul class="text-sm space-y-1">
                                            <li>{{ __('applicant/personal-info.upload_tip_1')}}</li>
                                            <li>{{ __('applicant/personal-info.upload_tip_2')}}</li>
                                            <li>{{ __('applicant/personal-info.upload_tip_3')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-end pt-8 border-t mt-8">
                    <div class="flex items-center space-x-4">
                        <button type="submit"
                                class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:enabled:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-100 disabled:text-gray-400 disabled:border-gray-200"
                                @disabled(in_array($application->status, ['submitted', 're_submitted', 'accepted', 'rejected', 'under_review']))>
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <span>{{ __('applicant/personal-info.save_progress')}}</span>
                        </button>

                        <button @click="currentStep = 2" type="button"
                            class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            {{ __('applicant/personal-info.next')}}
                            <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
