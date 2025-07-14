<div x-show="currentStep === {{ $step }}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2 mb-4">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-100 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-6 w-6">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                    </span>

                    <h3 class="text-2xl font-medium">
                        {{ __('applicant/contact-info.contact_information') }}
                    </h3>
                </div>
                <p class="text-gray-600 text-md mt-1">
                    {{ __('applicant/contact-info.contact_description') }}
                </p>
            </div>
            <div class="p-6">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Email Field (Readonly) -->
                            <div class="relative">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">{{ __('applicant/contact-info.email_address') }}
                                    <span class="text-red-500 ml-1">*</span></label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="mt-3 lucide lucide-mail absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <input disabled type="email"
                                    class="flex h-10 w-full rounded-md border border-input bg-gray-50 px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input pl-10"
                                    name="email" value="{{ Auth::user()->email }}" readonly
                                    placeholder="{{ __('applicant/contact-info.email_placeholder') }}">
                            </div>

                            <div class="relative">
                                <label
                                    for="phone"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">
                                    {{ __('applicant/contact-info.phone_number') }} <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                    <input 
                                        id="phone"
                                        value="{{ old('phone', $application->phone ?? '') }}"
                                        class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input pl-10"
                                        name="phone" placeholder="+(998)91 123-4567" autocomplete="phone">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Permanent Address Section -->
                        <div class="space-y-6 py-6 border-t border-b border-slate-200">
                            <div class="flex items-center space-x-3">
                                <h4 class="text-lg font-semibold text-slate-900">
                                    {{ __('applicant/contact-info.permanent_address') }} <span class="text-red-500 ml-1">*</span>
                                </h4>
                            </div>

                            <!-- Street Address -->
                            <div class="form-field">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required"
                                    for="permanent_street">
                                    {{ __('applicant/contact-info.street_address') }}<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input 
                                    value="{{ old('permanent_street', $application->permanent_street ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                                    name="permanent_street" id="permanent_street" placeholder="{{ __('applicant/contact-info.street_placeholder') }}">
                                @error('permanent_street')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="form-field">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required"
                                    for="permanent_city">
                                    {{ __('applicant/contact-info.city') }}<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input 
                                    value="{{ old('permanent_city', $application->permanent_city ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                                    name="permanent_city" id="permanent_city" placeholder="{{ __('applicant/contact-info.city_placeholder') }}">
                                @error('permanent_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State/Province -->
                            <div class="form-field">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label"
                                    for="permanent_state">
                                    {{ __('applicant/contact-info.state_province') }}
                                </label>
                                <input 
                                    value="{{ old('permanent_state', $application->permanent_state ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                                    name="permanent_state" id="permanent_state" placeholder="{{ __('applicant/contact-info.state_placeholder') }}">
                                @error('permanent_state')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="form-field">
                                <label
                                    for="country"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">
                                    {{ __('applicant/contact-info.country') }}<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="permanent_country" id="country" autocomplete="country"
                                    class="mt-1 flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                                >
                                    <option value="" class="text-muted-foreground">{{ __('applicant/contact-info.country_placeholder') }}</option>
                                    @foreach (config('countries') as $code => $name)
                                        <option value="{{ $code }}" @selected(old('permanent_country', $application->permanent_country ?? '') == $code)>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('permanent_country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Postal Code -->
                            <div class="form-field">
                                <label
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required"
                                    for="permanent_postcode">
                                    {{ __('applicant/contact-info.postal_code') }} <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input 
                                    value="{{ old('permanent_postcode', $application->permanent_postcode ?? '') }}"
                                    class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                                    name="permanent_postcode" id="permanent_postcode" placeholder="{{ __('applicant/contact-info.postal_placeholder') }}">
                                @error('permanent_postcode')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <h4 class="text-sm font-medium text-blue-900 mb-2">
                                {{ __('applicant/contact-info.contact_tips_title') }}
                            </h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>
                                    • {{ __('applicant/contact-info.tip_email') }}
                                </li>
                                <li>
                                    • {{ __('applicant/contact-info.tip_phone') }}
                                </li>
                                <li>
                                    • {{ __('applicant/contact-info.tip_address') }}
                                </li>
                                <li>
                                    • {{ __('applicant/contact-info.tip_contact') }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column - Document Upload -->
                    <div>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium flex items-center space-x-2">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span>{{ __('applicant/contact-info.address_verification') }}</span>
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ __('applicant/contact-info.upload_description') }}
                                </p>
                            </div>

                            <div class="p-6 space-y-4">
                                <div>
                                    <!-- Address File Upload -->
                                    <div x-data="documentUpload('address_proof', @js($documents->get('address_proof')))" class="border rounded-lg p-4">
                                        <div class="mb-3">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="text-md font-medium">{{ __('applicant/contact-info.address_proof') }}</span>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                    :class="uploaded ? 'bg-green-100 text-green-800' :
                                                        'bg-gray-100 text-gray-800'"
                                                    x-text="uploaded ? '{{ __('applicant/contact-info.uploaded') }}' : '{{ __('applicant/contact-info.optional') }}'">
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-2">{{ __('applicant/contact-info.address_proof_description') }}</p>
                                            <div class="text-xs text-gray-400">{{ __('applicant/contact-info.file_formats') }}</div>
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
                                                    <label for="address_proof-file" class="cursor-pointer">
                                                        <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                            fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        <span class="text-md font-medium text-gray-900">{{ __('applicant/contact-info.click_to_upload') }}</span>
                                                        <span class="text-sm text-gray-500">{{ __('applicant/contact-info.drag_and_drop') }}</span>
                                                        <span class="block text-md text-gray-500">{{ __('applicant/contact-info.file_size_limit') }}</span>
                                                        <input id="address_proof-file" name="address_proof" type="file"
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
                                                <span class="text-sm text-gray-600">{{ __('applicant/contact-info.uploading') }}</span>
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
                                                    @if(!in_array($application->status, ['submitted', 'accepted', 're_submitted', 'rejected']))
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
                                </div>

                                <!-- Upload Tips -->
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
                                    <h4 class="text-sm font-medium text-blue-900 mb-1">
                                        {{ __('applicant/contact-info.document_requirements') }}
                                    </h4>
                                    <ul class="text-sm text-blue-800 space-y-1">
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

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between pt-8 border-t mt-8">
                    <button type="button" @click="currentStep = 1"
                        class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7"></path>
                        </svg>
                        {{ __('applicant/contact-info.previous') }}
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
                            <span>{{ __('applicant/contact-info.save_progress') }}</span>
                        </button>

                        <button @click="currentStep = 3" type="button"
                            class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            {{ __('applicant/contact-info.next') }}
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
