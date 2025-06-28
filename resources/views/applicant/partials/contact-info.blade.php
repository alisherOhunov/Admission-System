    <!-- Main Form Content -->
    <div class="max-w-4xl mx-auto" x-data="contactForm()">
    <div class="bg-white shadow-sm rounded-lg">
        <div class="p-6">
        <form 
            hx-post="{{ route('applicant.application.contact') }}"
            hx-swap="innerHTML"
            hx-trigger="submit"
        >
            @csrf
            <div class="py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium"
                            >2</span
                        >
                        <span class="text-lg font-medium">Contact Info</span>
                    </div>
                </div>
                <p class="text-gray-600 mt-1">
                    Address and contact details
                </p>
            </div>
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Form Fields -->
            <div class="space-y-6">
                <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Contact Information
                </h3>
                <p class="text-sm text-gray-600 mb-6">
                    Provide your current contact details and address information. This will be used for all communication regarding your application.
                </p>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Email Field (Readonly) -->
                    <div class="relative">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">Email Address <span class="text-red-500 ml-1">*</span></label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-3 lucide lucide-mail absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <input 
                        disabled
                        type="email" 
                        class="flex h-10 w-full rounded-md border border-input bg-gray-50 px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input pl-10" 
                        name="email"
                        value="{{ Auth::user()->email }}"
                        readonly
                        placeholder="your.email@example.com">
                    </div>

                    <div class="relative">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">
                            Phone Number <span class="text-red-500 ml-1">*</span>
                        </label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-3 lucide lucide-phone absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-slate-400">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <input 
                            x-model="form.phone"
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input pl-10"
                            :class="hasError('phone') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            name="phone" 
                            required
                            placeholder="+(998)91 123-4567"
                            @input="clearError('phone')">
                        
                        <!-- Dynamic error message -->
                        <template x-if="hasError('phone')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('phone')"></p>
                        </template>
                    </div>
                </div>

                 <!-- Permanent Address Section -->
                <div class="space-y-6 py-6 border-t border-b border-slate-200">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house h-4 w-4">
                                <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path>
                                <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-slate-900">
                            Permanent Address <span class="text-red-500 ml-1">*</span>
                        </h4>
                    </div>

                    <!-- Street Address -->
                    <div class="form-field">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required" for="permanent_address_street">
                            Street Address<span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            x-model="form.permanent_address.street"
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                            :class="hasError('permanent_address.street') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            name="permanent_address[street]" 
                            id="permanent_address_street"
                            required
                            placeholder="123 Main Street, Apt 4B"
                            @input="clearError('permanent_address.street')">
                        
                        <template x-if="hasError('permanent_address.street')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('permanent_address.street')"></p>
                        </template>
                        
                        @error('permanent_address.street')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="form-field">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required" for="permanent_address_city">
                            City<span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            x-model="form.permanent_address.city"
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                            :class="hasError('permanent_address.city') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            name="permanent_address[city]" 
                            id="permanent_address_city"
                            required
                            placeholder="New York"
                            @input="clearError('permanent_address.city')">
                        
                        <template x-if="hasError('permanent_address.city')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('permanent_address.city')"></p>
                        </template>
                        
                        @error('permanent_address.city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State/Province -->
                    <div class="form-field">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label" for="permanent_address_state">
                            State/Province
                        </label>
                        <input 
                            x-model="form.permanent_address.state"
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                            :class="hasError('permanent_address.state') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            name="permanent_address[state]" 
                            id="permanent_address_state"
                            placeholder="New York"
                            @input="clearError('permanent_address.state')">
                        
                        <template x-if="hasError('permanent_address.state')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('permanent_address.state')"></p>
                        </template>
                        
                        @error('permanent_address.state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="form-field">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required">
                            Country<span class="text-red-500 ml-1">*</span>
                        </label>
                        <select
                            x-model="form.permanent_address.country"
                            name="permanent_address[country]"
                            required
                            class="mt-1 flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                            :class="hasError('permanent_address.country') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            @change="clearError('permanent_address.country')"
                        >
                            <option value="" class="text-muted-foreground">Select your country</option>
                            <option value="US">United States</option>
                            <option value="UK">United Kingdom</option>
                            <option value="CA">Canada</option>
                            <option value="DE">Germany</option>
                            <option value="FR">France</option>
                        </select>
                        
                        <template x-if="hasError('permanent_address.country')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('permanent_address.country')"></p>
                        </template>
                        
                        @error('permanent_address.country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div class="form-field">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 form-label form-label-required" for="permanent_address_postal_code">
                            Postal/ZIP Code <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input 
                            x-model="form.permanent_address.postal_code"
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm form-input"
                            :class="hasError('permanent_address.postal_code') ? 'border-red-500 bg-red-50' : 'border-input bg-background'"
                            name="permanent_address[postal_code]"
                            id="permanent_address_postal_code"
                            required
                            placeholder="10001"
                            @input="clearError('permanent_address.postal_code')">
                        
                        <template x-if="hasError('permanent_address.postal_code')">
                            <p class="mt-1 text-sm text-red-600" x-text="getError('permanent_address.postal_code')"></p>
                        </template>
                        
                        @error('permanent_address.postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                <h4 class="text-sm font-medium text-blue-900 mb-2">
                    Contact Information Tips
                </h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>
                    • Use an email address you check regularly
                    </li>
                    <li>
                    • Include country code for international phone numbers
                    </li>
                    <li>
                    • Ensure your address is correct for document delivery
                    </li>
                    <li>
                    • We may contact you via phone or email during the review process
                    </li>
                </ul>
                </div>
            </div>

            <!-- Right Column - Document Upload -->
            <div>
                <div
                class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit"
                >
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
                    <span>Address Verification (Optional)</span>
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                    Upload required and optional documents for this step
                    </p>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                    <!-- Address File Upload -->
                    <div class="border rounded-lg p-4">
                        <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                            <svg
                                class="h-4 w-4 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                ></path>
                            </svg>
                            <span class="text-sm font-medium"
                                >Address Proof</span
                            >
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                >Optional</span
                            >
                            </div>
                            <p class="text-xs text-gray-500 mb-2">
                            Utility bill, bank statement, or government document
                            </p>
                            <div class="text-xs text-gray-400">
                            Formats: PDF, JPG, PNG • Max: 5MB
                            </div>
                        </div>
                        </div>

                        <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors"
                        >
                        <svg
                            class="mx-auto h-6 w-6 text-gray-400 mb-2"
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
                        <label for="address-file" class="cursor-pointer">
                            <span class="text-sm font-medium text-gray-900"
                            >Click to upload</span
                            >
                            <span class="text-sm text-gray-500">
                            or drag and drop</span
                            >
                            <input
                            id="address-file"
                            type="file"
                            class="hidden"
                            accept=".pdf,.jpg,.jpeg,.png"
                            />
                        </label>
                        </div>
                    </div>
                    </div>

                    <!-- Upload Tips -->
                    <div
                    class="bg-blue-50 border border-blue-200 rounded-md p-3"
                    >
                    <h4 class="text-xs font-medium text-blue-900 mb-1">
                        Document Requirements
                    </h4>
                    <ul class="text-xs text-blue-800 space-y-1">
                        <li>
                        • All documents must be clear and legible
                        </li>
                        <li>• Official documents should be in original language</li>
                        <li>• Translations must be certified if documents are not in English</li>
                        <li>• File names should be descriptive and professional</li>
                        <li>• Ensure all pages are included for multi-page documents</li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex items-center justify-between pt-8 border-t mt-8">
            <button
                x-data
                @click="history.back()"
                type="button"
                class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-400 bg-gray-100"
            >
                <svg
                class="h-4 w-4 mr-2"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                ></path>
                </svg>
                Previous
            </button>

            <div class="flex items-center space-x-4">
                <button
                type="button"
                class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 disabled:opacity-50"
                >
                <svg
                    class="h-4 w-4 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"
                    ></path>
                </svg>
                <span>Save Progress</span>
                </button>

                <button
                type="submit"
                class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 disabled:opacity-50"
                >
                <span>Next</span>
                </button>
            </div>
            </div>
        </form>
        </div>
    </div>
    </div>

<script>
    function contactForm() {
    return {
        form: {
            phone: '{{ old('phone', $application->phone ?? '') }}',
            permanent_address: {
                street: '{{ old('permanent_address.street', $permanentAddress['street'] ?? '') }}',
                city: '{{ old('permanent_address.city', $permanentAddress['city'] ?? '') }}',
                state: '{{ old('permanent_address.state', $permanentAddress['state'] ?? '') }}',
                country: '{{ old('permanent_address.country', $permanentAddress['country'] ?? '') }}',
                postal_code: '{{ old('permanent_address.postal_code', $permanentAddress['postal_code'] ?? '') }}'
            }
        },
        errors: {}, // Add errors object to store validation errors
        
        // Method to clear specific error
        clearError(field) {
            if (this.errors[field]) {
                delete this.errors[field];
            }
        },
        
        // Method to check if field has error
        hasError(field) {
            return this.errors[field] && this.errors[field].length > 0;
        },
        
        // Method to get error message
        getError(field) {
            return this.errors[field] ? this.errors[field][0] : '';
        }
    }
}


// Alternative approach using htmx:afterRequest
document.body.addEventListener('htmx:afterRequest', function(event) {
    if (event.detail.xhr.status === 422) {
        const response = JSON.parse(event.detail.xhr.response);
        const component = event.target.closest('[x-data]');
        
        if (component && component._x_dataStack && response.errors) {
            const alpineData = component._x_dataStack[0];
            alpineData.errors = response.errors;
        }
    } else if (event.detail.xhr.status >= 200 && event.detail.xhr.status < 300) {
        // Clear errors on successful response
        const component = event.target.closest('[x-data]');
        if (component && component._x_dataStack) {
            const alpineData = component._x_dataStack[0];
            alpineData.errors = {};
        }
    }
});

// Clear individual field errors on input
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