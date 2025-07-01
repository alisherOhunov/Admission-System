<form hx-post="{{ route('applicant.application.update', ['applicationId' => $application->id]) }}" hx-swap="outerHTML"
    hx-trigger="submit">
    <div x-data="personalForm()">
        @csrf
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-university-600 text-sm font-medium">1</span>
                    <span class="text-lg font-medium">Personal Information</span>
                </div>
                <p class="text-gray-600 mt-1">Basic personal details and identification</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                        <p class="text-sm text-gray-600 mb-6">Please provide your basic personal information as
                            it
                            appears on your passport.</p>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First
                                    Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="first_name" name="first_name" required
                                    x-model="form.first_name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                    :class="hasError('first_name') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'">
                                <template x-if="hasError('first_name')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('first_name')"></p>
                                </template>
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="last_name" name="last_name" required x-model="form.last_name"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                    :class="hasError('last_name') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'">
                                <template x-if="hasError('last_name')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('last_name')"></p>
                                </template>
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            @php
                                $dateOfBirth = old('date_of_birth', $application->date_of_birth ?? '');
                                if ($dateOfBirth instanceof \Carbon\Carbon) {
                                    $dateOfBirth = $dateOfBirth->format('Y-m-d');
                                } elseif (!empty($dateOfBirth) && strtotime($dateOfBirth)) {
                                    $dateOfBirth = date('Y-m-d', strtotime($dateOfBirth));
                                }
                            @endphp
                            <div x-data="{ form: { date_of_birth: '{{ $dateOfBirth }}' } }">
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    x-model="form.date_of_birth"
                                    :class="hasError('phone') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'"
                                    required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">

                                <template x-if="hasError('date_of_birth')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('date_of_birth')"></p>
                                </template>
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select id="gender" name="gender" x-model="form.gender"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                    :class="hasError('gender') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'"
                                    @change="clearError('gender')">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    <option value="prefer-not-to-say">Prefer not to say</option>
                                </select>
                                <template x-if="hasError('gender')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('gender')"></p>
                                </template>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality
                                    <span class="text-red-500">*</span></label>
                                <select id="nationality" name="nationality" x-model="form.nationality" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm"
                                    :class="hasError('nationality') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'"
                                    @change="clearError('nationality')">
                                    <option value="">Select your nationality</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="US">United States</option>
                                    <option value="UK">United Kingdom</option>
                                    <option value="CA">Canada</option>
                                    <option value="DE">Germany</option>
                                    <option value="FR">France</option>
                                </select>
                                <template x-if="hasError('nationality')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('nationality')"></p>
                                </template>

                                @error('nationality')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="passport_number" class="block text-sm font-medium text-gray-700">Passport
                                    Number <span class="text-red-500">*</span></label>
                                <input type="text" id="passport_number" name="passport_number"
                                    x-model="form.passport_number" required
                                    :class="hasError('passport_number') ? 'border-red-500 bg-red-50' :
                                        'border-input bg-background'"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">
                                <!-- Dynamic error message -->
                                <template x-if="hasError('passport_number')">
                                    <p class="mt-1 text-sm text-red-600" x-text="getError('passport_number')">
                                    </p>
                                </template>
                                @error('passport_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="native_language" class="block text-sm font-medium text-gray-700">Native
                                Language <span class="text-red-500">*</span></label>
                            <input type="text" id="native_language" name="native_language"
                                x-model="form.native_language" required
                                :class="hasError('native_language') ? 'border-red-500 bg-red-50' :
                                    'border-input bg-background'"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-university-500 focus:border-university-500 sm:text-sm">
                            <!-- Dynamic error message -->
                            <template x-if="hasError('native_language')">
                                <p class="mt-1 text-sm text-red-600" x-text="getError('native_language')"></p>
                            </template>
                            @error('native_language')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                            <h4 class="text-sm font-medium text-blue-900 mb-2">Important Notes:</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Ensure all information matches your passport exactly</li>
                                <li>• Your passport must be valid for at least 6 months</li>
                                <li>• Upload a clear scan of your passport on the right</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium flex items-center space-x-2">
                                    <svg class="h-5 w-5 text-university-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span>Personal Documents</span>
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Upload documents related to this step</p>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="p-6 space-y-4">
                                    <div>
                                        <div x-data="documentUpload('passport')" class="border rounded-lg p-4">
                                            <div class="mb-3">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    <span class="text-sm font-medium">Passport</span>
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                        :class="uploaded ? 'bg-green-100 text-green-800' :
                                                            'bg-red-100 text-red-800'"
                                                        x-text="uploaded ? 'Uploaded' : 'Required'">
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-500 mb-2">Clear scan of your passport photo
                                                    page</p>
                                                <div class="text-xs text-gray-400">Formats: PDF, JPG, PNG • Max size:
                                                    5MB</div>
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
                                                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                            <span class="text-md font-medium text-gray-900">Click to
                                                                upload</span>
                                                            <span class="text-sm text-gray-500">or drag and drop</span>
                                                            <span class="text-md text-gray-500">PDF, JPG, PNG up to 5MB</span>
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
                                                    <span class="text-sm text-gray-600">Uploading...</span>
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
                                                                x-text="fileName"></p>
                                                            <p class="text-sm text-green-700">
                                                                <span x-text="fileSize"></span> •
                                                                <span class="text-green-600">Uploaded
                                                                    successfully</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <!-- Download Button -->
                                                        <a 
                                                            href="{{ route('applicant.application.downloadDocument', ['applicationId' => $application->id, 'filename' => '1751272972_photo_2025-06-16_16-37-28.jpg']) }}" 
                                                            class="text-green-600 hover:text-green-800 transition-colors"
                                                        >
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                                </path>
                                                            </svg>
                                                        </a>
                                                        <!-- Remove Button -->
                                                        <a href="{{ route('applicant.application.removeDocument', ['applicationId' => $application->id, 'filename' => '1751272972_photo_2025-06-16_16-37-28.jpg']) }}" @click="removeFile()"
                                                            class="text-red-500 hover:text-red-700 transition-colors">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                                                </path>
                                                            </svg>
                                                        </a>
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
                                </div>
                                <!-- Tips Section -->
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
                                    <h4 class="text-xs font-medium text-blue-900 mb-1">Upload Tips:</h4>
                                    <ul class="text-xs text-blue-800 space-y-1">
                                        <li>• Use high-resolution scans (300 DPI recommended)</li>
                                        <li>• Ensure documents are clear and legible</li>
                                        <li>• Files are automatically saved when uploaded</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between pt-8 border-t mt-8">
                    <button type="button" disabled
                        class="flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>

                    <button type="submit"
                        class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Next
                        <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function personalForm() {
            return {
                form: {
                    first_name: '{{ old('first_name', Auth::user()->first_name ?? '') }}',
                    last_name: '{{ old('last_name', Auth::user()->last_name ?? '') }}',
                    nationality: '{{ old('nationality', $application->nationality ?? '') }}',
                    passport_number: '{{ old('passport_number', $application->passport_number ?? '') }}',
                    date_of_birth: '',
                    gender: '{{ old('gender', $application->gender ?? '') }}',
                    native_language: '{{ old('native_language', $application->native_language ?? '') }}',
                },
                errors: {},
                clearError(field) {
                    if (this.errors[field]) {
                        delete this.errors[field];
                    }
                },

                hasError(field) {
                    return this.errors[field] && this.errors[field].length > 0;
                },

                getError(field) {
                    return this.errors[field] ? this.errors[field][0] : '';
                }
            }
        }

        document.body.addEventListener('htmx:afterRequest', function(event) {
            if (event.detail.xhr.status === 422) {
                const response = JSON.parse(event.detail.xhr.response);
                const component = event.target.closest('[x-data]');

                if (component && component._x_dataStack && response.errors) {
                    const alpineData = component._x_dataStack[0];
                    alpineData.errors = response.errors;
                }
            } else if (event.detail.xhr.status >= 200 && event.detail.xhr.status < 300) {
                const component = event.target.closest('[x-data]');
                if (component && component._x_dataStack) {
                    const alpineData = component._x_dataStack[0];
                    alpineData.errors = {};
                }
            }
        });

        document.addEventListener('input', function(event) {
            const component = event.target.closest('[x-data]');
            if (component && component._x_dataStack) {
                const fieldName = event.target.name;
                const alpineData = component._x_dataStack[0];

                if (alpineData.errors && alpineData.errors[fieldName]) {
                    delete alpineData.errors[fieldName];
                }
            }
        });

        function documentUpload(documentType) {
            return {
                documentType: documentType,
                uploaded: false,
                uploading: false,
                isDragging: false,
                error: false,
                errorMessage: '',
                fileName: '',
                fileSize: '',

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    this.uploadFile(file);
                },

                handleDrop(event) {
                    this.isDragging = false;
                    const files = event.dataTransfer.files;
                    if (files.length > 0) {
                        const file = files[0];
                        this.uploadFile(file);
                    }
                },

                uploadFile(file) {
                    // Reset states
                    this.error = false;
                    this.errorMessage = '';
                    this.uploading = true;
                    this.fileName = file.name;
                    this.fileSize = this.formatFileSize(file.size);

                    // Create FormData
                    const formData = new FormData();
                    formData.append('document', file);
                    formData.append('type', this.documentType);

                    // Add CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');
                    if (csrfToken) {
                        formData.append('_token', csrfToken.getAttribute('content'));
                    }

                    fetch(`/applicant/application/upload-document/{{$application->id}}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(data => {
                                    throw new Error(data.error || 'Upload failed');
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.uploading = false;
                            this.uploaded = true;
                        })
                        .catch(error => {
                            this.uploading = false;
                            this.error = true;
                            this.errorMessage = error.message || 'Upload failed. Please try again.';
                        });
                },


                formatFileSize(bytes) {
                    if (bytes === 0) return '0 B';
                    const k = 1024;
                    const sizes = ['B', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                },

                removeFile() {
                    this.uploaded = false;
                    this.fileName = '';
                    this.fileSize = '';
                    this.error = false;
                    this.errorMessage = '';

                    const fileInput = document.getElementById(`${this.documentType}-file`);
                    if (fileInput) {
                        fileInput.value = '';
                    }
                }
            }
        }
    </script>
</form>
