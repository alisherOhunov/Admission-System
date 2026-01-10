<div x-show="currentStep === {{ $step }}" x-transition>
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white shadow-sm rounded-lg">
            <!-- Header Section -->
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2 sm:space-x-3 mb-3 sm:mb-4">
                    <span class="inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-100 text-blue-600 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-5 w-5 sm:h-6 sm:w-6">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                    </span>
                    <h1 class="text-xl sm:text-2xl font-medium text-gray-900">
                        {{ __('applicant/contact-info.contact_information') }}
                    </h1>
                </div>
                <p class="text-gray-600 text-sm sm:text-base mt-1">
                    {{ __('applicant/contact-info.contact_description') }}
                </p>
            </div>

            <!-- Main Content -->
            <div class="p-4 sm:p-6">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-4 sm:space-y-6">
                        <!-- Email & Phone Section -->
                        <div class="space-y-4 sm:space-y-6">
                            <!-- Email Field (Readonly) -->
                            <div class="relative">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.email_address') }}
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                    <input disabled type="email"
                                        class="flex h-10 w-full rounded-md border border-input bg-gray-50 px-3 py-2 pl-10 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                        name="email" value="{{ Auth::user()->email }}" readonly
                                        placeholder="{{ __('applicant/contact-info.email_placeholder') }}">
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="relative">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.phone_number') }} 
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                    <input id="phone"
                                        value="{{ old('phone', $application->phone ?? '') }}"
                                        class="flex h-10 w-full rounded-md border px-3 py-2 pl-10 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                        name="phone" placeholder="+(998)91 123-4567" autocomplete="phone">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Permanent Address Section -->
                        <div class="space-y-4 sm:space-y-6 pt-4 sm:pt-6 border-t border-slate-200">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <p class="text-base sm:text-lg font-semibold text-slate-900">
                                    {{ __('applicant/contact-info.permanent_address') }} 
                                    <span class="text-red-500 ml-1">*</span>
                                </p>
                            </div>

                            <!-- Street Address -->
                            <div>
                                <label for="permanent_street" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.street_address') }}
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input value="{{ old('permanent_street', $application->permanent_street ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="permanent_street" id="permanent_street" 
                                    placeholder="{{ __('applicant/contact-info.street_placeholder') }}">
                                @error('permanent_street')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label for="permanent_city" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.city') }}
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input value="{{ old('permanent_city', $application->permanent_city ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="permanent_city" id="permanent_city" 
                                    placeholder="{{ __('applicant/contact-info.city_placeholder') }}">
                                @error('permanent_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State/Province -->
                            <div>
                                <label for="permanent_state" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.state_province') }}
                                </label>
                                <input value="{{ old('permanent_state', $application->permanent_state ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="permanent_state" id="permanent_state" 
                                    placeholder="{{ __('applicant/contact-info.state_placeholder') }}">
                                @error('permanent_state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.country') }}
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="permanent_country" id="country" autocomplete="country"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                    <option value="" class="text-muted-foreground">
                                        {{ __('applicant/contact-info.country_placeholder') }}
                                    </option>
                                    @foreach (config('countries') as $code => $name)
                                        <option value="{{ $code }}" @selected(old('permanent_country', $application->permanent_country ?? '') == $code)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('permanent_country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label for="permanent_postcode" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/contact-info.postal_code') }} 
                                    <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input value="{{ old('permanent_postcode', $application->permanent_postcode ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                    name="permanent_postcode" id="permanent_postcode" 
                                    placeholder="{{ __('applicant/contact-info.postal_placeholder') }}">
                                @error('permanent_postcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Visa Status -->
                            <div>
                                <label for="has_visa" class="block text-sm font-medium text-gray-700 mb-1">
                                    Do you have a visa?
                                </label>
                                <select name="has_visa" id="has_visa"
                                    @change="collectAllFormData()"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-sm sm:text-base ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                    <option value="" @selected(old('has_visa', $application->has_visa ?? null) === null)>
                                        Select your visa status
                                    </option>
                                    <option value="1" @selected(old('has_visa', $application->has_visa ?? null) === true)>
                                        Yes
                                    </option>
                                    <option value="0" @selected(old('has_visa', $application->has_visa ?? null) === false)>
                                        No
                                    </option>
                                </select>
                                @error('has_visa')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Tips -->
                        <div class="flex items-start space-x-2 sm:space-x-3 bg-blue-50 border border-blue-200 rounded-md p-3 sm:p-4 text-blue-700">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                </svg>
                            </div>
                            <div class="text-left flex-1">
                                <p class="text-xs sm:text-sm font-medium mb-1 sm:mb-2">
                                    {{ __('applicant/contact-info.contact_tips_title') }}
                                </p>
                                <ul class="text-xs sm:text-sm space-y-1">
                                    <li>• {{ __('applicant/contact-info.tip_email') }}</li>
                                    <li>• {{ __('applicant/contact-info.tip_phone') }}</li>
                                    <li>• {{ __('applicant/contact-info.tip_address') }}</li>
                                    <li>• {{ __('applicant/contact-info.tip_contact') }}</li>
                                </ul>
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
                                    <span>{{ __('applicant/contact-info.visa_verification') }}</span>
                                </h2>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">
                                    {{ __('applicant/contact-info.upload_description') }}
                                </p>
                            </div>

                            <!-- Upload Section -->
                            <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                                <!-- Visa Proof Upload -->
                                <div x-data="documentUpload('visa_proof', @js($documents->get('visa_proof')))" class="border rounded-lg p-3 sm:p-4">
                                    <div class="mb-3">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <span class="text-sm sm:text-base font-medium">Visa Proof</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                                :class="uploaded ? 'bg-green-100 text-green-800' : (getFieldValue('has_visa') === '1' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')"
                                                x-text="uploaded ? '{{ __('applicant/contact-info.uploaded') }}' : (getFieldValue('has_visa') === '1' ? 'Required' : '{{ __('applicant/contact-info.optional') }}')">
                                            </span>
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-500 mb-2">Upload information about your visa status</p>
                                        <div class="text-xs text-gray-500">{{ __('applicant/contact-info.file_formats') }}</div>
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
                                                <label for="visa-proof-file" class="cursor-pointer">
                                                    <svg class="mx-auto h-8 w-8 sm:h-10 sm:w-10 text-gray-400 mb-2"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm sm:text-base font-medium text-gray-900 block">
                                                        {{ __('applicant/contact-info.click_to_upload') }}
                                                    </span>
                                                    <span class="text-xs sm:text-sm text-gray-500 block mt-1">
                                                        {{ __('applicant/contact-info.drag_and_drop') }}
                                                    </span>
                                                    <span class="block text-xs sm:text-sm text-gray-500 mt-1">
                                                        {{ __('applicant/contact-info.file_size_limit') }}
                                                    </span>
                                                    <input id="visa-proof-file" name="visa-proof" type="file"
                                                        class="hidden" accept=".pdf,.jpg,.jpeg,.png"
                                                        @change="handleFileSelect($event)">
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Loading State -->
                                        <div x-show="uploading" class="flex flex-col items-center py-4">
                                            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2"></div>
                                            <span class="text-xs sm:text-sm text-gray-600">
                                                {{ __('applicant/contact-info.uploading') }}
                                            </span>
                                        </div>
                                    </div>

                                    @error('document_visa_proof')
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
                                                    <p class="text-xs sm:text-sm font-medium text-green-900 truncate"
                                                        x-text="fileName.length > 20 ? fileName.slice(0, 20) + '...' : fileName">
                                                    </p>
                                                    <p class="text-xs sm:text-sm text-green-700" x-text="fileSize"></p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <!-- Download Button -->
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

                                                <!-- Remove Button -->
                                                @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
                                                    <button @click="removeFile()" aria-label="Remove document"
                                                        class="text-red-500 hover:text-red-700 transition-colors" type="button">
                                                        <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-xs sm:text-sm text-red-800" x-text="errorMessage"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Tips -->
                                <div class="flex items-start space-x-2 sm:space-x-3 bg-blue-50 border border-blue-200 rounded-lg p-3 text-blue-700">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>
                                    <div class="text-left flex-1">
                                        <p class="text-xs sm:text-sm font-medium mb-1">
                                            {{ __('applicant/contact-info.document_requirements') }}
                                        </p>
                                        <ul class="text-xs sm:text-sm space-y-1">
                                            <li>{{ __('applicant/contact-info.req_clear') }}</li>
                                            <li>{{ __('applicant/contact-info.req_original') }}</li>
                                            <li>{{ __('applicant/contact-info.req_translation') }}</li>
                                            <li>{{ __('applicant/contact-info.req_filename') }}</li>
                                            <li>{{ __('applicant/contact-info.req_pages') }}</li>
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
                    <button type="button" @click="currentStep = 1"
                        class="flex items-center justify-center sm:justify-start px-4 py-2.5 sm:py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 order-2 sm:order-1">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('applicant/contact-info.previous') }}
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
                            <span class="hidden sm:inline">{{ __('applicant/contact-info.save_progress') }}</span>
                            <span class="sm:hidden">{{ __('Save') }}</span>
                        </button>

                        <!-- Next Button -->
                        <button @click="currentStep = 3" type="button"
                            class="flex items-center justify-center px-4 py-2.5 sm:py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('applicant/contact-info.next') }}
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