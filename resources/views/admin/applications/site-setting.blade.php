@extends('layouts.app')

@section('title', 'Site Settings - ' . config('app.name'))

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ showToast: false }">
        <!-- Success Toast Notification -->
        <div 
            x-show="showToast"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed top-4 right-4 z-50 bg-white rounded-xl shadow-2xl border border-gray-200 p-4 flex items-start space-x-3 max-w-md"
            style="display: none;"
        >
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <h3 class="text-sm font-semibold text-gray-900">Success!</h3>
                <p class="mt-1 text-sm text-gray-600">Site settings updated successfully</p>
            </div>
            <button @click="showToast = false" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Site Settings</h1>
            <p class="mt-2 text-gray-600">Manage your site logo, favicon, university name, and help links</p>
        </div>

        <!-- Single Form for All Settings -->
        <form 
            hx-post="{{ route('admin.applications.settings.update') }}" 
            hx-encoding="multipart/form-data"
            hx-swap="none"
            hx-indicator="#settings-spinner"
            x-data="{ 
                logoFileName: '', 
                faviconFileName: '',
                universityName: '{{ $universityName }}',
                contactSupportLink: '{{ $contactSupportLink ?? '' }}',
                studentAccommodationLink: '{{ $studentAccommodationLink ?? '' }}',
                previewLogo(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.logoFileName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = document.getElementById('logo-img');
                            img.src = e.target.result;
                            img.classList.remove('hidden');
                            const placeholder = document.getElementById('logo-placeholder');
                            if (placeholder) placeholder.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    }
                },
                previewFavicon(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.faviconFileName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = document.getElementById('favicon-img');
                            img.src = e.target.result;
                            img.classList.remove('hidden');
                            const placeholder = document.getElementById('favicon-placeholder');
                            if (placeholder) placeholder.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }"
            @htmx:after-request.window="
                if($event.detail.successful) { 
                    showToast = true;
                    setTimeout(() => { 
                        showToast = false;
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    }, 2000); 
                }
            "
            class="space-y-6"
        >
            @csrf

            <!-- University Name -->
            <div class="bg-white shadow-sm rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">University Information</h2>
                    
                    <div>
                        <label for="university_name" class="block text-sm font-medium text-gray-700 mb-2">
                            University Name
                        </label>
                        <input 
                            type="text" 
                            id="university_name"
                            name="university_name" 
                            x-model="universityName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter university name"
                            required
                        >
                        <p class="mt-2 text-sm text-gray-500">
                            This name is displayed on the welcome page
                        </p>
                    </div>
                </div>
            </div>

            <!-- Help Links Section -->
            <div class="bg-white shadow-sm rounded-2xl">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Help Links</h2>
                    <p class="text-sm text-gray-600 mb-6">These links appear in the "Need Help?" section for applicants and in the Dormitory area. They open in a new tab.</p>
                    
                    <div class="space-y-4">
                        <!-- Contact Support Link -->
                        <div>
                            <label for="contact_support_link" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Support Link
                            </label>
                            <input 
                                type="url" 
                                id="contact_support_link"
                                name="contact_support_link" 
                                x-model="contactSupportLink"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://example.com/support"
                            >
                            <p class="mt-2 text-sm text-gray-500">
                                Link for "Contact Support" button
                            </p>
                        </div>

                        <!-- Student Accommodation Link -->
                        <div>
                            <label for="student_accommodation_link" class="block text-sm font-medium text-gray-700 mb-2">
                                Information about Student Accommodation Link
                            </label>
                            <input 
                                type="url" 
                                id="student_accommodation_link"
                                name="student_accommodation_link" 
                                x-model="studentAccommodationLink"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://example.com/accommodation"
                            >
                            <p class="mt-2 text-sm text-gray-500">
                                Link for "Information about student accommodation" button
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Logo Upload -->
                <div class="bg-white shadow-sm rounded-2xl">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Project Logo</h2>
                        
                        <!-- Current Logo Preview -->
                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-700 mb-2">Current Logo:</p>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 flex items-center justify-center" style="min-height: 200px;">
                                @if(file_exists(public_path('images/logo.png')))
                                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Current Logo" class="max-h-48 max-w-full object-contain" id="logo-img">
                                @else
                                    <img src="" alt="Logo Preview" class="max-h-48 max-w-full object-contain hidden" id="logo-img">
                                    <p class="text-gray-400" id="logo-placeholder">No logo uploaded</p>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload New Logo (PNG only)
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <div class="border-2 border-gray-300 border-dashed rounded-xl p-4 text-center hover:border-blue-500 transition">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600" x-text="logoFileName || 'Click to upload or drag and drop'"></p>
                                    <p class="mt-1 text-xs text-gray-500">PNG only (Max 5MB) - Optional</p>
                                </div>
                                <input 
                                    type="file" 
                                    name="logo" 
                                    accept=".png,image/png"
                                    class="hidden"
                                    @change="previewLogo($event)"
                                >
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Favicon Upload -->
                <div class="bg-white shadow-sm rounded-2xl">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Favicon</h2>
                        
                        <!-- Current Favicon Preview -->
                        <div class="mb-6">
                            <p class="text-sm font-medium text-gray-700 mb-2">Current Favicon:</p>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 bg-gray-50 flex items-center justify-center" style="min-height: 200px;">
                                @if(file_exists(public_path('favicon.ico')))
                                    <img src="{{ asset('favicon.ico') }}?v={{ time() }}" alt="Current Favicon" class="h-32 w-32 object-contain" id="favicon-img">
                                @else
                                    <img src="" alt="Favicon Preview" class="h-32 w-32 object-contain hidden" id="favicon-img">
                                    <p class="text-gray-400" id="favicon-placeholder">No favicon uploaded</p>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload New Favicon (PNG only)
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <div class="border-2 border-gray-300 border-dashed rounded-xl p-4 text-center hover:border-blue-500 transition">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600" x-text="faviconFileName || 'Click to upload or drag and drop'"></p>
                                    <p class="mt-1 text-xs text-gray-500">PNG only (Max 5MB, 32x32px) - Optional</p>
                                </div>
                                <input 
                                    type="file" 
                                    name="favicon" 
                                    accept=".png,image/png"
                                    class="hidden"
                                    @change="previewFavicon($event)"
                                >
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button 
                    type="submit" 
                    class="inline-flex items-center justify-center px-6 py-3 text-base font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span id="settings-spinner" class="htmx-indicator">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="htmx-indicator">Updating...</span>
                    <span class="htmx-indicator-not">Update All Settings</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.htmx-indicator {
    display: none;
}
.htmx-indicator-not {
    display: inline;
}
.htmx-request .htmx-indicator {
    display: inline-flex;
}
.htmx-request .htmx-indicator-not {
    display: none;
}
.htmx-request button {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>
@endsection