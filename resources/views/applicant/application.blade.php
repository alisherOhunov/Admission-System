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
                            type="button"
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
                            type="button"
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
                            type="button"
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
                            type="button"
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
                            type="button"
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
                @include('applicant.partials.personal-info', ['step' => 1])
                @include('applicant.partials.contact-info', ['step' => 2])
                @include('applicant.partials.academic-background', ['step' => 3])
                @include('applicant.partials.program-choice', ['step' => 4])
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
                permanent_street: '{{ old('permanent_street', $application->permanent_street ?? '') }}',
                permanent_city: '{{ old('permanent_city', $application->permanent_city ?? '') }}',
                permanent_state: '{{ old('permanent_state', $application->permanent_state ?? '') }}',
                permanent_country: '{{ old('permanent_country', $application->permanent_country ?? '') }}',
                permanent_postcode: '{{ old('permanent_postcode', $application->permanent_postcode ?? '') }}',
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
@endsection