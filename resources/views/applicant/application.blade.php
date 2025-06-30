@extends('layouts.app')

@section('title', 'Dashboard - EduAdmit')

@section('content')

<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
            University Application
            </h1>
            <p class="mt-2 text-gray-600">
            Complete your application step by step
            </p>
        </div>
        <div class="flex items-center space-x-4">
            <span
            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
            >
            Step 1 of 5
            </span>
        </div>
        </div>
    </div>
    <form hx-post="{{ route('applicant.application.update',  ['applicationId' => $application->id]) }}">
        @csrf
        <div x-data="applicationForm()">
            <div class="mb-8">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 overflow-x-auto">
                        <button
                            @click="currentStep = 1"
                            :class="getButtonClass(1)"
                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                        >
                            <div class="flex flex-col items-center space-y-2">
                                <div class="relative">
                                    <div
                                        :class="getCircleClass(1)"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2"
                                    >
                                        <span 
                                            :class="getTextClass(1)"
                                            class="text-sm font-medium"
                                        >1</span>
                                    </div>
                                </div>
                                <div>
                                    <div 
                                        :class="getTextClass(1)"
                                        class="text-sm font-medium"
                                    >
                                        Personal Information
                                    </div>
                                    <div class="text-xs text-gray-400 hidden sm:block">
                                        Basic personal details
                                    </div>
                                </div>
                            </div>
                        </button>
    
                        <!-- Step 2 -->
                        <button
                            @click="currentStep = 2"
                            :class="getButtonClass(2)"
                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                        >
                            <div class="flex flex-col items-center space-y-2">
                                <div class="relative">
                                    <div
                                        :class="getCircleClass(2)"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2"
                                    >
                                        <span 
                                            :class="getTextClass(2)"
                                            class="text-sm font-medium"
                                        >2</span>
                                    </div>
                                </div>
                                <div>
                                    <div 
                                        :class="getTextClass(2)"
                                        class="text-sm font-medium"
                                    >
                                        Contact Information
                                    </div>
                                    <div class="text-xs text-gray-400 hidden sm:block">
                                        Address and contact details
                                    </div>
                                </div>
                            </div>
                        </button>
    
                        <!-- Step 3 -->
                        <button
                            @click="currentStep = 3"
                            :class="getButtonClass(3)"
                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                        >
                            <div class="flex flex-col items-center space-y-2">
                                <div class="relative">
                                    <div
                                        :class="getCircleClass(3)"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2"
                                    >
                                        <span 
                                            :class="getTextClass(3)"
                                            class="text-sm font-medium"
                                        >3</span>
                                    </div>
                                </div>
                                <div>
                                    <div 
                                        :class="getTextClass(3)"
                                        class="text-sm font-medium"
                                    >
                                        Academic Background
                                    </div>
                                    <div class="text-xs text-gray-400 hidden sm:block">
                                        Education background
                                    </div>
                                </div>
                            </div>
                        </button>
    
                        <!-- Step 4 -->
                        <button
                            @click="currentStep = 4"
                            :class="getButtonClass(4)"
                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                        >
                            <div class="flex flex-col items-center space-y-2">
                                <div class="relative">
                                    <div
                                        :class="getCircleClass(4)"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2"
                                    >
                                        <span 
                                            :class="getTextClass(4)"
                                            class="text-sm font-medium"
                                        >4</span>
                                    </div>
                                </div>
                                <div>
                                    <div 
                                        :class="getTextClass(4)"
                                        class="text-sm font-medium"
                                    >
                                        Program Choice
                                    </div>
                                    <div class="text-xs text-gray-400 hidden sm:block">
                                        Program selection
                                    </div>
                                </div>
                            </div>
                        </button>
    
                        <!-- Step 5 -->
                        <button
                            @click="currentStep = 5"
                            :class="getButtonClass(5)"
                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                        >
                            <div class="flex flex-col items-center space-y-2">
                                <div class="relative">
                                    <div
                                        :class="getCircleClass(5)"
                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2"
                                    >
                                        <span 
                                            :class="getTextClass(5)"
                                            class="text-sm font-medium"
                                        >5</span>
                                    </div>
                                </div>
                                <div>
                                    <div 
                                        :class="getTextClass(5)"
                                        class="text-sm font-medium"
                                    >
                                        Review & Submit
                                    </div>
                                    <div class="text-xs text-gray-400 hidden sm:block">
                                        Review & submit
                                    </div>
                                </div>
                            </div>
                        </button>
                    </nav>
                </div>
            </div>
    
    
            <!-- Main Form Content -->
            <div class="tab-content">
                <div x-show="currentStep === 1" x-transition>
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white shadow-sm rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">1</span>
                                    <span class="text-lg font-medium">Personal Information</span>
                                </div>
                                <p class="text-gray-600 mt-1">
                                    Basic personal details and identification
                                </p>
                            </div>
    
                            <div class="p-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <!-- Left Column -->
                                    <div class="space-y-6">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                        <p class="text-sm text-gray-600 mb-6">Please provide your basic personal information as it appears on your passport.</p>
    
                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                            <div>
                                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                                                <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                                                <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                        </div>
    
                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                            <div>
                                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">
                                                    Date of Birth <span class="text-red-500">*</span>
                                                </label>
                                                <input type="date" id="date_of_birth" name="date_of_birth" x-model="form.date_of_birth"
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                                <select id="gender" name="gender" x-model="form.gender" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                    <option value="">Select gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                    <option value="prefer-not-to-say">Prefer not to say</option>
                                                </select>
                                            </div>
                                        </div>
    
                                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                            <div>
                                                <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label>
                                                <select id="nationality" name="nationality" x-model="form.nationality" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                    <option value="">Select your nationality</option>
                                                    <option value="US">United States</option>
                                                    <option value="UK">United Kingdom</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="FR">France</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="passport_number" class="block text-sm font-medium text-gray-700">Passport Number <span class="text-red-500">*</span></label>
                                                <input type="text" id="passport_number" name="passport_number" x-model="form.passport_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            </div>
                                        </div>
    
                                        <div>
                                            <label for="native_language" class="block text-sm font-medium text-gray-700">Native Language <span class="text-red-500">*</span></label>
                                            <input type="text" id="native_language" name="native_language" x-model="form.native_language" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
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
                                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
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
                                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                </svg>
                                                                <span class="text-sm font-medium">Passport (Scanned)</span>
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Required</span>
                                                            </div>
                                                            <p class="text-xs text-gray-500 mb-2">Clear scan of your passport information page</p>
                                                            <div class="text-xs text-gray-400">Formats: PDF, JPG, PNG • Max: 5MB</div>
                                                        </div>
    
                                                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
                                                            <svg class="mx-auto h-6 w-6 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                            </svg>
                                                            <label for="passport-file" class="cursor-pointer">
                                                                <span class="text-sm font-medium text-gray-900">Click to upload</span>
                                                                <span class="text-sm text-gray-500">or drag and drop</span>
                                                                <input id="passport-file" name="passport_file" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
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
                                    <button type="button" disabled class="flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Previous
                                    </button>

                                    <div class="flex items-center space-x-4">
                                        <button
                                            type="submit"
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
    
                                        <button @click="currentStep = 2" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Next
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
                <div x-show="currentStep === 2" x-transition>
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white shadow-sm rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center space-x-2">
                                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">2</span>
                                    <span class="text-lg font-medium">Contact Info</span>
                                </div>
                                <p class="text-gray-600 mt-1">
                                    Address and contact details
                                </p>
                            </div>
                            <div class="p-6">
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
                                    <button @click="currentStep = 1" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Previous
                                    </button>
    
                                    <div class="flex items-center space-x-4">
                                        <button
                                        type="submit"
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
    
                                        <button @click="currentStep = 3" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Next
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
                <div x-show="currentStep === 3" x-transition>
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white shadow-sm rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span
                                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium"
                                        >3</span
                                        >
                                        <span class="text-lg font-medium">Academic</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 mt-1">
                                Education background
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <div class="space-y-6">
                                        <div class="border-b border-gray-200">
                                            <div class="flex items-center space-x-3 mb-4">
                                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                                Academic Background
                                                </h3>
                                            </div>
                                            <p class="text-lg text-gray-600 mb-6">
                                                Provide details about your previous education and English language proficiency to help us evaluate your academic readiness.
                                            </p>
                                        </div>
    
                                        <div class="grid grid-cols-1 gap-6">
                                            <div>
                                                <p class="text-lg font-semibold text-gray-900">Previous Education</p>
                                            </div>
                                            <div>
                                                <label
                                                for="previousInstitution"
                                                class="block text-sm font-medium text-gray-700"
                                                >Previous Institution <span class="text-red-500">*</span></label
                                                >
                                                <input
                                                x-model="form.previous_institution"
                                                type="text"
                                                id="previousInstitution"
                                                name="previous_institution"
                                                placeholder="e.g., University of California, Berkeley"
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                />
                                                <p class="mt-2 text-gray-500">Enter the full name of your most recent educational institution</p>
                                            </div>
    
                                            <div>
                                                <label
                                                for="degreeEarned"
                                                class="block text-sm font-medium text-gray-700"
                                                >Degree/Certificate Earned <span class="text-red-500">*</span></label
                                                >
                                                <input
                                                x-model="form.degree_earned"
                                                type="text"
                                                id="degreeEarned"
                                                name="degree_earned"
                                                placeholder="e.g., Bachelor of Science in Computer Science"
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                />
                                            </div>
                                        </div>
    
                                        <div class="grid grid-cols-1 gap-6 py-6 border-b border-gray-200">
                                            <div>
                                                <label
                                                for="gpa"
                                                class="block text-sm font-medium text-gray-700"
                                                >GPA/GRADE
                                                <span class="text-red-500">*</span></label
                                                >
                                                <input
                                                x-data="{ form: { previous_gpa: '{{ old('previous_gpa', $application->previous_gpa ?? '') }}' } }"
                                                x-model="form.previous_gpa"
                                                type="text"
                                                id="gpa"
                                                name="previous_gpa"
                                                placeholder="e.g., 3.8/4.0 or First Class"
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                />
                                                <p class="mt-2 text-gray-500">Use the grading system from your institution</p>
                                            </div>
    
                                            <div class="grid grid-cols-1 gap-6">
                                                <div>
                                                    <label
                                                    for="graduationDate"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Graduation Date (Optional)
                                                    </label
                                                    >
                                                    <input
                                                    x-model="form.graduation_date"
                                                    type="date"
                                                    id="graduationDate"
                                                    name="graduation_date"
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    />
                                                    <p class="mt-2 text-gray-500">When did you graduate or when do you expect to graduate?</p>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 gap-6">
                                                <div>
                                                    <p class="text-lg font-semibold text-gray-900">English Language Proficiency</p>
                                                </div>
                                                <div>
                                                    <label
                                                    for="english-test-type"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >English Test Type</label
                                                    >
                                                    <select
                                                    x-model="form.english_test_type"
                                                    id="english-test-type"
                                                    name="english_test_type"
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    >
                                                    <option value="IELTS">IELTS Academic</option>
                                                    <option value="TOEFL">TOEFL iBT</option>
                                                    <option value="DUOLINGO">Duolingo English Test</option>
                                                    <option value="CAMBRIDGE">Cambridge English</option>
                                                    <option value="PTE">PTE Academic</option>
                                                    <option value="OTHER">Other</option>
                                                    </select>
                                                    <p class="mt-2 text-gray-500">Select the English proficiency test you have taken or plan to take</p>
                                                </div>
                                                <div>
                                                    <label
                                                    for="testScore"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Test Score <span class="text-red-500">*</span></label
                                                    >
                                                    <input
                                                    x-model="form.english_test_score"
                                                    type="text"
                                                    id="testScore"
                                                    name="english_test_score"
                                                    placeholder="Enter your score"
                                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    />
                                                </div>
    
                                                <div class="grid grid-cols-1 gap-6">
                                                    <div>
                                                        <label
                                                            for="testDate"
                                                            class="block text-sm font-medium text-gray-700"
                                                            >Test Date <span class="text-red-500">*</span>
                                                        </label
                                                        >
                                                        <input
                                                            x-model="form.english_test_date"
                                                            type="date"
                                                            id="testDate"
                                                            name="english_test_date"
                                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                        />
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
                                                        <h4 class="font-semibold mb-2">IELTS Academic Score Information</h4>
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
                                                            Academic Requirements:
                                                        </h4>
                                                        <ul class="text-sm space-y-1">
                                                            <li>• Upload official transcripts from all institutions attended</li>
                                                            <li>• English test scores must be from the last 2 years</li>
                                                            <li>• Provide exact scores as they appear on official reports</li>
                                                            <li>• Graduate programs may have higher GPA and test score requirements</li>
                                                            <li>• All documents must be in English or include certified translations</li>
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
                                                <span>Academic Documents</span>
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">
                                                Upload required and optional documents for this step
                                                </p>
                                            </div>
    
                                            <div class="p-6 space-y-4">
                                                <!-- Transcripts Upload -->
                                                <div class="border rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-3">
                                                        <div class="flex-1">
                                                            <div class="flex items-center space-x-2 mb-1">
                                                                <span class="text-sm font-medium"
                                                                    >Official Transcripts</span
                                                                >
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                                    >Required</span
                                                                >
                                                            </div>
                                                            <p class="text-s text-gray-500 mb-2">
                                                                Complete academic transcripts from all institutions
                                                            </p>
                                                            <div class="text-xs text-gray-400">
                                                                Formats: PDF • Max size: 10MB
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
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
                                                        <label for="transcripsts-file" class="cursor-pointer">
                                                            <span class="text-sm font-medium text-gray-900"
                                                            >Click to upload</span
                                                            >
                                                            <span class="text-sm text-gray-500">
                                                            or drag and drop</span
                                                            >
                                                            <input
                                                            id="transcripsts-file"
                                                            type="file"
                                                            class="hidden"
                                                            accept=".pdf,.jpg,.jpeg,.png"
                                                            />
                                                        </label>
                                                    </div>
                                                </div>
    
                                                <!-- Diploma certificate Upload -->
                                                <div class="border rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-3">
                                                    <div class="flex-1">
                                                        <div class="flex items-center space-x-2 mb-1">
                                                        <span class="text-sm font-medium"
                                                            >Diploma/Certificate</span
                                                        >
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                            >Required</span
                                                        >
                                                        </div>
                                                        <p class="text-s text-gray-500 mb-2">
                                                        Your degree certificate or diploma
                                                        </p>
                                                        <div class="text-xs text-gray-400">
                                                        Formats: PDF, JPG, PNG • Max size: 5MB
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
                                                    <label for="diploma-file" class="cursor-pointer">
                                                        <span class="text-sm font-medium text-gray-900"
                                                        >Click to upload</span
                                                        >
                                                        <span class="text-sm text-gray-500">
                                                        or drag and drop</span
                                                        >
                                                        <input
                                                        id="diploma-file"
                                                        type="file"
                                                        class="hidden"
                                                        accept=".pdf,.jpg,.jpeg,.png"
                                                        />
                                                    </label>
                                                    </div>
                                                </div>
                                                <!-- Englis Test Score Upload -->
                                                <div class="border rounded-lg p-4">
                                                    <div class="flex items-start justify-between mb-3">
                                                        <div class="flex-1">
                                                            <div class="flex items-center space-x-2 mb-1">
                                                                <span class="text-sm font-medium"
                                                                    >English Test Score</span
                                                                >
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                                                    >Optional</span
                                                                >
                                                            </div>
                                                            <p class="text-s text-gray-500 mb-2">
                                                                Official IELTS, TOEFL, or other English test results
                                                            </p>
                                                            <div class="text-xs text-gray-400">
                                                                Formats: PDF • Max size: 5MB
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
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
                                                        <label for="english-score-file" class="cursor-pointer">
                                                            <span class="text-sm font-medium text-gray-900"
                                                            >Click to upload</span
                                                            >
                                                            <span class="text-sm text-gray-500">
                                                            or drag and drop</span
                                                            >
                                                            <input
                                                            id="english-score-file"
                                                            type="file"
                                                            class="hidden"
                                                            accept=".pdf,.jpg,.jpeg,.png"
                                                            />
                                                        </label>
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
                                                            Document Requirements:
                                                        </h4>
                                                        <ul class="text-sm space-y-1">
                                                            <li>• All documents must be clear and legible</li>
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
                                </div>
    
                                <!-- Navigation Buttons -->
                                <div class="flex items-center justify-between pt-8 border-t mt-8">
                                    <button @click="currentStep = 2" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Previous
                                    </button>
    
                                    <div class="flex items-center space-x-4">
                                        <button
                                        type="submit"
                                        class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
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
                                        Save Progress
                                        </button>
    
                                        <button @click="currentStep = 4" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Next
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
                <div x-show="currentStep === 4" x-transition>
                    <div class="max-w-4xl mx-auto">
                        <div class="bg-white shadow-sm rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium"
                                    >4</span
                                    >
                                    <span class="text-2xl font-medium">Program</span>
                                </div>
                                </div>
                                <p class="text-gray-600 text-lg mt-1">
                                Program selection
                                </p>
                            </div>
    
                            <div class="p-6">
                                <!-- Two Column Layout -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    <!-- Left Column - Form Fields -->
                                    <div class="space-y-6">
                                        <div class="border-b border-gray-200">
                                        <div class="flex items-center space-x-3 mb-4">
                                            <h3 class="text-2xl font-medium text-gray-900 mb-4">
                                                Program Selection
                                            </h3>
                                        </div>
                                        <p class="text-lg text-gray-600 mb-6">
                                            Choose your desired degree level and program of study. This will help us understand your academic goals and provide appropriate guidance.
                                        </p>
                                        </div>
    
                                        <div class="grid grid-cols-1 pb-10 gap-6 border-b border-gray-200">
                                        <div>
                                            <p class="text-lg font-semibold text-gray-900">Academic Program</p>
                                        </div>
                                        <div>
                                            <label
                                            for="degreeLevel"
                                            class="block text-sm font-medium text-gray-700"
                                            >Degree Level<span class="text-red-500">*</span></label
                                            >
                                            <select
                                            id="degreeLevel"
                                            name="degreeLevel"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            >
                                            <option value="masters">Graduate (Master's)</option>
                                            <option value="undergraduate">Undergraduate (Bachelor's)</option>
                                            </select>
                                            <p class="mt-2 text-gray-500">Select the level of degree you wish to pursue</p>
                                        </div>
    
                                        <div>
                                            <label
                                            for="programOfStudy"
                                            class="block text-sm font-medium text-gray-700"
                                            >Program of Study<span class="text-red-500">*</span></label
                                            >
                                            <select
                                            id="programOfStudy"
                                            name="programOfStudy"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            >
                                            <option value="mastersOfScience">Master of Science in Data Science</option>
                                            <option value="mastersOfBusiness">Master of Business Administration (MBA)</option>
                                            <option value="mastersOfScienceEngineering">Master of Science in Engineering Management</option>
                                            </select>
                                            <p class="mt-2 text-gray-500">Choose the specific program that aligns with your academic interests</p>
                                        </div>
    
                                        <div>
                                            <label
                                            for="startTerm"
                                            class="block text-sm font-medium text-gray-700"
                                            >Preferred Start Term<span class="text-red-500">*</span></label
                                            >
                                            <select
                                            id="startTerm"
                                            name="startTerm"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            >
                                                <option value="sprin2025">Spring 2025</option>
                                                <option value="fall2024">Fall 2024</option>
                                                <option value="fall2025">Fall 2025</option>
                                                <option value="sprin2026">Spring 2026</option>
                                            </select>
                                            <p class="mt-2 text-gray-500">When would you like to begin your studies?</p>
                                        </div>
                                        <div class="grid grid-cols-1 gap-6">
                                            <div class=" items-start rounded-md border border-blue-200 bg-blue-50 p-4 text-blue-black">
                                            <div class="flex items-center space-x-3 mb-10">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 text-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open h-5 w-5">
                                                        <path d="M12 7v14"></path>
                                                        <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h4 class="text-lg font-semibold text-slate-900">Master of Science in Data Science</h4>
                                                    <p class="text-slate-600">Computer Science</p>
                                                </div>
                                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-secondary/80 bg-blue-100 text-blue-800 capitalize">graduate</div>
                                            </div>
    
                                            <div class="ml-3 text-left">
                                                <h4 class="text-sm font-medium mb-2">
                                                    Program overview:
                                                </h4>
                                                <p class="mb-4">Advanced program in data analysis, machine learning, and statistical modeling.</p>
                                                <h4 class="text-sm font-medium mb-2">
                                                Program Requirements
                                                </h4>
                                                <ul class="text-sm space-y-1">
                                                    <li>• Bachelor's Degree</li>
                                                    <li>• Programming Experience</li>
                                                    <li>• Statistics Background</li>
                                                    <li>• English Proficiency</li>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div 
                                        x-data="{ text: '', min: 100 }" 
                                        class="grid grid-cols-1 gap-4 pb-10"
                                        >
                                        <div>
                                            <p class="text-lg font-semibold text-gray-900">
                                            Statement of Purpose <span class="text-red-500">*</span>
                                            </p>
                                        </div>
    
                                        <div>
                                            <label for="personalStatement" class="block font-medium text-gray-700">
                                            Personal Statement <span class="text-red-500">*</span>
                                            </label>
                                        </div>
    
                                        <div>
                                            <p class="text-center text-gray-600">
                                            Explain why you want to study this program, your academic and professional background, and your career goals.
                                            This is your opportunity to make a compelling case for your admission.
                                            </p>
                                        </div>
    
                                        <div>
                                            <textarea
                                            id="personalStatement"
                                            name="personalStatement"
                                            placeholder="Begin your statement of purpose here..."
                                            rows="6"
                                            maxlength="1000"
                                            x-model="text"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            ></textarea>
    
                                            <div class="mt-2 text-sm text-right">
                                            <span 
                                                :class="text.length < min ? 'text-orange-500' : 'text-green-600'"
                                                x-text="text.length < min 
                                                ? `${text.length} characters (${min - text.length} more needed)` 
                                                : `${text.length} characters`"
                                            ></span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="flex items-start rounded-md border border-green-200 bg-green-50 p-4 text-green-700">
                                        <div class="ml-3 text-left">
                                            <h4 class="font-medium text-lg mb-2">
                                            Statement of Purpose Tips
                                            </h4>
                                            <ul class="text-md space-y-1">
                                                <li>• Explain your academic and professional background</li>
                                                <li>• Describe why you chose this specific program</li>
                                                <li>• Outline your career goals and how this program fits</li>
                                                <li>• Mention any relevant experience or achievements</li>
                                                <li>• Keep it focused, clear, and well-structured</li>
                                                <li>• Proofread for grammar and spelling errors</li>
                                            </ul>
                                        </div>
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
                                            <span>Supporting Documents</span>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                            Upload required and optional documents for this step
                                            </p>
                                        </div>
    
                                        <div class="p-6 space-y-4">
                                            <div>
                                            <!-- Transcripts Upload -->
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                    <span class="text-md font-medium"
                                                        >Statement of Purpose</span
                                                    >
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                        >Required</span
                                                    >
                                                    </div>
                                                    <p class="text-s text-gray-500 mb-2">
                                                    Your personal statement (if separate file)
                                                    </p>
                                                    <div class="text-xs text-gray-400">
                                                    Formats: PDF, DOC, DOCX • Max size: 5MB
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
                                                <label for="transcripsts-file" class="cursor-pointer">
                                                    <span class="text-sm font-medium text-gray-900"
                                                    >Click to upload</span
                                                    >
                                                    <span class="text-sm text-gray-500">
                                                    or drag and drop</span
                                                    >
                                                    <input
                                                    id="transcripsts-file"
                                                    type="file"
                                                    class="hidden"
                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                    />
                                                </label>
                                                </div>
                                            </div>
                                            </div>
    
                                            <!-- Diploma certificate Upload -->
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                    <span class="text-sm font-medium"
                                                        >Curriculum Vitae/Resume</span
                                                    >
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                                        >Optional</span
                                                    >
                                                    </div>
                                                    <p class="text-s text-gray-500 mb-2">
                                                    Your updated CV or resume
                                                    </p>
                                                    <div class="text-xs text-gray-400">
                                                    Formats: PDF, DOC, DOCX • Max size: 5MB
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
                                                <label for="diploma-file" class="cursor-pointer">
                                                    <span class="text-sm font-medium text-gray-900"
                                                    >Click to upload</span
                                                    >
                                                    <span class="text-sm text-gray-500">
                                                    or drag and drop</span
                                                    >
                                                    <input
                                                    id="diploma-file"
                                                    type="file"
                                                    class="hidden"
                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                    />
                                                </label>
                                                </div>
                                            </div>
                                            <!-- Englis Test Score Upload -->
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                    <span class="text-sm font-medium"
                                                        >Portfolie</span
                                                    >
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                                        >Optional</span
                                                    >
                                                    </div>
                                                    <p class="text-s text-gray-500 mb-2">
                                                        Academic or professional portfolio (if applicable)
                                                    </p>
                                                    <div class="text-xs text-gray-400">
                                                    Formats: PDF, ZIP • Max size: 20MB
                                                    </div>
                                                </div>
                                                </div>
    
                                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
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
                                                <label for="english-score-file" class="cursor-pointer">
                                                    <span class="text-sm font-medium text-gray-900"
                                                    >Click to upload</span
                                                    >
                                                    <span class="text-sm text-gray-500">
                                                    or drag and drop</span
                                                    >
                                                    <input
                                                    id="english-score-file"
                                                    type="file"
                                                    class="hidden"
                                                    accept=".pdf,.jpg,.jpeg,.png"
                                                    />
                                                </label>
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
                                                        Document Requirements:
                                                    </h4>
                                                    <ul class="text-sm space-y-1">
                                                        <li>• All documents must be clear and legible</li>
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
                                    </div>
                                </div>
    
                                <!-- Navigation Buttons -->
                                <div class="flex items-center justify-between pt-8 pb-6 px-6 border-t mt-8">
                                    <button @click="currentStep = 3" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Previous
                                    </button>
    
                                    <div class="flex items-center space-x-4">
                                        <button
                                        type="submit"
                                        class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
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
                                        Save Progress
                                        </button>
    
                                        <button @click="currentStep = 5" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Next
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
            </div>
        </div>
    </form>
</div>
<script>
    function applicationForm() {
        return {
            currentStep: 1,

            buttonActive: 'border-blue-500 text-blue-600 border-b-2 opacity-100',
            buttonInactive: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50',
            circleActive: 'border-blue-600 bg-white',
            circleInactive: 'border-gray-300 bg-white',
            textActive: 'text-blue-600',
            textInactive: 'text-gray-500',
            
            getButtonClass(step) { return this.currentStep === step ? this.buttonActive : this.buttonInactive; },
            getCircleClass(step) { return this.currentStep === step ? this.circleActive : this.circleInactive; },
            getTextClass(step) { return this.currentStep === step ? this.textActive : this.textInactive; },

            form: {
                first_name: '{{ old('first_name', Auth::user()->first_name ?? '') }}',
                last_name: '{{ old('last_name', Auth::user()->last_name ?? '') }}',
                nationality: '{{ old('nationality', $application->nationality ?? '') }}',
                passport_number: '{{ old('passport_number', $application->passport_number ?? '') }}',
                date_of_birth: '{{ old('date_of_birth', optional(optional($application)->date_of_birth)->format('Y-m-d')) }}',
                gender: '{{ old('gender', $application->gender ?? '') }}',
                native_language: '{{ old('native_language', $application->native_language ?? '') }}',
                phone: '{{ old('phone', $application->phone ?? '') }}',
                permanent_address: {
                    street: '{{ old('permanent_address.street', $permanentAddress['street'] ?? '') }}',
                    city: '{{ old('permanent_address.city', $permanentAddress['city'] ?? '') }}',
                    state: '{{ old('permanent_address.state', $permanentAddress['state'] ?? '') }}',
                    country: '{{ old('permanent_address.country', $permanentAddress['country'] ?? '') }}',
                    postal_code: '{{ old('permanent_address.postal_code', $permanentAddress['postal_code'] ?? '') }}'
                },
                previous_institution: '{{ old('previous_institution', $application->previous_institution ?? '') }}',
                previous_gpa: '{{ old('previous_gpa', $application->previous_gpa ?? '') }}',
                degree_earned: '{{ old('degree_earned', $application->degree_earned ?? '') }}',
                graduation_date: '{{ old('graduation_date', optional(optional($application)->graduation_date)->format('Y-m-d')) }}',
                english_test_type: '{{ old('english_test_type', $application->english_test_type ?? '') }}',
                english_test_score: '{{ old('english_test_score', $application->english_test_score ?? '') }}',
                english_test_date: '{{ old('english_test_date', optional(optional($application)->english_test_date)->format('Y-m-d')) }}',
                degree_level: '{{ old('degree_level', $application->degree_level ?? '') }}',
                program_of_study: '{{ old('program_of_study', $application->program_of_study ?? '') }}',
                preferred_start_term: '{{ old('preferred_start_term', $application->preferred_start_term ?? '') }}',
                personal_statement: '{{ old('personal_statement', $application->personal_statement ?? '') }}'
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
</script>
@endsection