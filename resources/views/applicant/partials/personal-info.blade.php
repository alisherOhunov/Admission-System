<form hx-post="{{ route('applicant.application.update',  ['applicationId' => $application->id]) }}" hx-swap="outerHTML" hx-trigger="submit">
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
                                <input type="text" id="last_name" name="last_name" required
                                    x-model="form.last_name"
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
                                <label for="gender"
                                    class="block text-sm font-medium text-gray-700">Gender</label>
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
                                <label for="nationality"
                                    class="block text-sm font-medium text-gray-700">Nationality
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
                                <label for="passport_number"
                                    class="block text-sm font-medium text-gray-700">Passport Number <span
                                        class="text-red-500">*</span></label>
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
                            <label for="native_language"
                                class="block text-sm font-medium text-gray-700">Native
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
                                    <svg class="h-5 w-5 text-university-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <span>Personal Documents</span>
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Upload documents related to this step</p>
                            </div>

                            <div class="p-6 space-y-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900 mb-3">Required Documents</h4>

                                    <div class="border rounded-lg p-4">
                                        <div class="mb-3">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <svg class="h-4 w-4 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <span class="text-sm font-medium">Passport (Scanned)</span>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Required</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-2">Clear scan of your passport
                                                information page</p>
                                            <div class="text-xs text-gray-400">Formats: PDF, JPG, PNG • Max:
                                                5MB
                                            </div>
                                        </div>

                                        <div
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                                            <svg class="mx-auto h-6 w-6 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <label for="passport-file" class="cursor-pointer">
                                                <span class="text-sm font-medium text-gray-900">Click to
                                                    upload</span>
                                                <span class="text-sm text-gray-500">or drag and drop</span>
                                                <input id="passport-file" name="passport_file" type="file"
                                                    class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                            </label>
                                        </div>
                                    </div>
                                </div>

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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5l7 7-7 7" />
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
    </script>
</form>