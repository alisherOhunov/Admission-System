@extends('layouts.app')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')

<div class="min-h-screen bg-gray-50">
        <div id="form-wrapper" class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 sm:py-6 lg:py-8">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">
                            {{ __('applicant/application.heading') }}
                        </h1>
                        <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">
                            {{ __('applicant/application.subheading') }}
                        </p>
                    </div>
                </div>
            </div>

            <form 
                hx-post="{{ route('applicant.application.update', ['application_id' => $application->id]) }}"
                hx-select="#form-content"
                hx-indicator="#loading-overlay"
            >
                <div id="form-content">
                    @csrf
                    <div x-data="tabStepper()">
                        <div class="mb-6 sm:mb-8">
                            <div class="border-b border-gray-200 px-2 sm:px-4 lg:px-6 pt-2 sm:pt-3 items-center overflow-x-auto">
                                <div class="max-w-4xl mx-auto">
                                    <!-- Desktop Navigation (5 steps visible) -->
                                    <nav class="hidden md:flex justify-center">
                                        <button
                                            type="button"
                                            @click="currentStep = 1"
                                            :class="getButtonClass(1)"
                                            class="group relative flex flex-col items-center space-y-2 p-3 lg:p-4 flex-1">
                                            <div class="relative">
                                                <div
                                                    :class="getCircleClass(1)"
                                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex items-center justify-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-user w-4 h-4 lg:w-5 lg:h-5">
                                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-center min-w-0">
                                                <div :class="getTextClass(1)" class="text-xs lg:text-sm font-medium transition-colors duration-200">{{ __('applicant/application.step_1_title')}}</div>
                                            </div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 2"
                                            :class="getButtonClass(2)"
                                            class="group relative flex flex-col items-center space-y-2 p-3 lg:p-4 flex-1">
                                            
                                            <div class="relative">
                                                <div
                                                    :class="getCircleClass(2)"
                                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex items-center justify-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-map-pin w-4 h-4 lg:w-5 lg:h-5">
                                                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                                        <circle cx="12" cy="10" r="3"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-center min-w-0">
                                                <div :class="getTextClass(2)" class="text-xs lg:text-sm font-medium transition-colors duration-200">{{ __('applicant/application.step_2_title')}}</div>
                                            </div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 3"
                                            :class="getButtonClass(3)"
                                            class="group relative flex flex-col items-center space-y-2 p-3 lg:p-4 flex-1">
                                            
                                            <div class="relative">
                                                <div
                                                    :class="getCircleClass(3)"
                                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex items-center justify-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-graduation-cap w-4 h-4 lg:w-5 lg:h-5">
                                                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                                                        <path d="M22 10v6"></path>
                                                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-center min-w-0">
                                                <div :class="getTextClass(3)" class="text-xs lg:text-sm font-medium transition-colors duration-200">{{ __('applicant/application.step_3_title')}}</div>
                                            </div>
                                        </button>
    
                                        <button
                                            type="button"
                                            @click="currentStep = 4"
                                            :class="getButtonClass(4)"
                                            class="group relative flex flex-col items-center space-y-2 p-3 lg:p-4 flex-1">
                                            
                                            <div class="relative">
                                                <div
                                                    :class="getCircleClass(4)"
                                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex items-center justify-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-file-text w-4 h-4 lg:w-5 lg:h-5">
                                                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                        <path d="M10 9H8"></path>
                                                        <path d="M16 13H8"></path>
                                                        <path d="M16 17H8"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-center min-w-0">
                                                <div :class="getTextClass(4)" class="text-xs lg:text-sm font-medium transition-colors duration-200">{{ __('applicant/application.step_4_title')}}</div>
                                            </div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 5"
                                            :class="getButtonClass(5)"
                                            class="group relative flex flex-col items-center space-y-2 p-3 lg:p-4 flex-1">
                                            
                                            <div class="relative">
                                                <div
                                                    :class="getCircleClass(5)"
                                                    class="w-10 h-10 lg:w-12 lg:h-12 rounded-full flex items-center justify-center"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-eye w-4 h-4 lg:w-5 lg:h-5">
                                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="text-center min-w-0">
                                                <div :class="getTextClass(5)" class="text-xs lg:text-sm font-medium transition-colors duration-200">{{ __('applicant/application.step_5_title')}}</div>
                                            </div>
                                        </button>
                                    </nav>

                                    <!-- Mobile Navigation (horizontal scroll) -->
                                    <nav class="flex md:hidden gap-2 pb-2 min-w-max">
                                        <button
                                            type="button"
                                            @click="currentStep = 1"
                                            :class="getButtonClass(1)"
                                            class="group relative flex flex-col items-center space-y-1.5 p-2 min-w-[70px]">
                                            <div
                                                :class="getCircleClass(1)"
                                                class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <div :class="getTextClass(1)" class="text-xs font-medium text-center">Personal</div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 2"
                                            :class="getButtonClass(2)"
                                            class="group relative flex flex-col items-center space-y-1.5 p-2 min-w-[70px]">
                                            <div
                                                :class="getCircleClass(2)"
                                                class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </div>
                                            <div :class="getTextClass(2)" class="text-xs font-medium text-center">Contact</div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 3"
                                            :class="getButtonClass(3)"
                                            class="group relative flex flex-col items-center space-y-1.5 p-2 min-w-[70px]">
                                            <div
                                                :class="getCircleClass(3)"
                                                class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                                                    <path d="M22 10v6"></path>
                                                    <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                                </svg>
                                            </div>
                                            <div :class="getTextClass(3)" class="text-xs font-medium text-center">Academic</div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 4"
                                            :class="getButtonClass(4)"
                                            class="group relative flex flex-col items-center space-y-1.5 p-2 min-w-[70px]">
                                            <div
                                                :class="getCircleClass(4)"
                                                class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                    <path d="M10 9H8"></path>
                                                    <path d="M16 13H8"></path>
                                                    <path d="M16 17H8"></path>
                                                </svg>
                                            </div>
                                            <div :class="getTextClass(4)" class="text-xs font-medium text-center">Program</div>
                                        </button>
                                        <button
                                            type="button"
                                            @click="currentStep = 5"
                                            :class="getButtonClass(5)"
                                            class="group relative flex flex-col items-center space-y-1.5 p-2 min-w-[70px]">
                                            <div
                                                :class="getCircleClass(5)"
                                                class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </div>
                                            <div :class="getTextClass(5)" class="text-xs font-medium text-center">Review</div>
                                        </button>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <!-- Main Form Content -->
                        <div class="tab-content">
                            <div data-step="1">@include('applicant.partials.personal-info', ['step' => 1])</div>
                            <div data-step="2">@include('applicant.partials.contact-info', ['step' => 2])</div>
                            <div data-step="3">@include('applicant.partials.academic-background', ['step' => 3])</div>
                            <div data-step="4">@include('applicant.partials.program-choice', ['step' => 4])</div>
                            <div data-step="5">@include('applicant.partials.review-and-submit', ['step' => 5])</div>
                        </div>
                    </div>
                </div>
            </form>

            <div id="loading-overlay" class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center" style="z-index: 9999;">
                <div class="rounded p-6 flex flex-col items-center">
                    <div class="relative">
                        <div class="h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 rounded-full border-t-4 sm:border-t-6 lg:border-t-8 border-b-4 sm:border-b-6 lg:border-b-8 border-gray-200"></div>
                        <div class="absolute top-0 left-0 h-16 w-16 sm:h-20 sm:w-20 lg:h-24 lg:w-24 rounded-full border-t-4 sm:border-t-6 lg:border-t-8 border-b-4 sm:border-b-6 lg:border-b-8 border-blue-500 animate-spin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>

.htmx-request {
    display: flex;
}
</style>
<script>
    let shouldSubmitAfterUpdate = false;

    document.getElementById('form-wrapper').addEventListener('click', function(event) {
        if (event.target.hasAttribute('data-action') && event.target.getAttribute('data-action') === 'update-and-submit') {
            shouldSubmitAfterUpdate = true;
        }
    });

    document.getElementById('form-wrapper').addEventListener('htmx:afterRequest', function(event) {
        if (shouldSubmitAfterUpdate && event.detail.requestConfig.path.includes('update')) {

            const updateSuccess = event.detail.xhr.getResponseHeader('X-Update-Success');

            if (updateSuccess === 'true') {
                shouldSubmitAfterUpdate = false;

                const indicator = document.getElementById('loading-overlay');
                indicator.classList.remove('hidden');
                
                const form = document.querySelector('form');
                htmx.ajax('POST', '{{ route('applicant.application.submit', ['application_id' => $application->id]) }}', {
                    source: form,
                    target: '#form-content',
                    select: '#form-content'
                }).then(() => {
                    indicator.classList.add('hidden');
                }).catch(() => {
                    indicator.classList.add('hidden');
                });
            } else {
                shouldSubmitAfterUpdate = false;
            }
        }
    });
    function tabStepper() {
        return {
            currentStep: parseInt(sessionStorage.getItem('currentStep')) || 1,
            formData: {},
            documents: @json($documents),
            buttonError: 'border-b-2 border-red-600',
            buttonActive: 'border-b-2 border-blue-600',

            circleActive: 'bg-blue-600 text-white border-2 border-blue-600',
            circleInactive: 'bg-gray-100 text-gray-500 border-0',
            circleError: 'bg-gray-100 text-red-600 border-0',

            textActive: 'text-blue-600',
            textInactive: 'text-gray-500',
            textError: 'text-red-600',
            
            init() {
                this.$watch('currentStep', value => {
                    sessionStorage.setItem('currentStep', value);
                });
                
                this.$watch('currentStep', (newStep) => {
                    if (newStep === 5 || newStep === 2) {
                        this.collectAllFormData();
                    }
                });

                if (this.currentStep === 5 || this.currentStep === 2) {
                    // Add delay on page load to ensure programSelector component has finished
                    setTimeout(() => this.collectAllFormData(), 200);
                };

                window.addEventListener('document-changed', (event) => {
                    if (event.detail.action === 'upload') {
                        this.documents[event.detail.type] = event.detail.document;
                    } else if (event.detail.action === 'delete') {
                        delete this.documents[event.detail.type];
                    }
                });
            },
            
            hasErrors(step) {
                const stepElement = document.querySelector(`[data-step="${step}"]`);
                return stepElement ? stepElement.querySelector('.text-red-600') !== null : false;
            },
            
            getButtonClass(step) {
                if (this.hasErrors(step)) {
                    return this.buttonError;
                }
                
                if (this.currentStep === step) {
                    return this.buttonActive;
                }
                
                return 'border-b-2 border-transparent hover:border-gray-400 transition-all duration-200';
            },
            
            getCircleClass(step) {
                if (this.hasErrors(step)) return this.circleError;
                return this.currentStep === step ? this.circleActive : this.circleInactive;
            },
            
            getTextClass(step) {
                if (this.hasErrors(step)) return this.textError;
                return this.currentStep === step ? this.textActive : this.textInactive;
            },
            
            collectAllFormData() {
                const programSelect = document.querySelector('#program_of_study');
                const allInputs = document.querySelectorAll('#form-content input, #form-content select, #form-content textarea');
                const allData = {};
                
                allInputs.forEach(input => {
                    if (input.name) {
                        if (input.type === 'checkbox') {
                            allData[input.name] = input.checked;
                        } else {
                            allData[input.name] = input.value;
                        }
                    }
                });
                
                this.formData = allData;
            },
            
            getFieldValue(fieldName) {
                return this.formData[fieldName] || '';
            },

            getCountryName(countryCode) {
                const countries = @json(config('countries'));
                return countries[countryCode] || '';
            },

            getDocuments() {
                return this.documents;
            },

            getProgramName(programId) {
                const programs = @json($programs);
                for (const level in programs) {
                    const program = programs[level].find(p => p.id == programId);
                    if (program) {
                        return program.name;
                    }
                }
                return '';
            },
        }
    }

    function formatSize(bytes) {
        if (bytes === 0) return '0 B';
        const k = 1024, sizes = ['B', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function documentUpload(documentType, initialFile = null) {
        return {
            documentType,
            uploaded: initialFile !== null,
            uploading: false,
            isDragging: false,
            error: false,
            errorMessage: '',
            fileName: initialFile ? initialFile.original_name : '',
            fileSize: initialFile ? formatSize(initialFile.size) : '',
            fileId: initialFile ? initialFile.id : null,

            handleFileSelect(e) {
                const file = e.target.files[0];
                if (file) this.uploadFile(file);
            },

            handleDrop(e) {
                this.isDragging = false;
                const files = e.dataTransfer.files;
                if (files.length > 0) this.uploadFile(files[0]);
            },

            async uploadFile(file) {
                this.error = false;
                this.uploading = true;
                this.fileName = file.name;
                this.fileSize = formatSize(file.size);

                const formData = new FormData();
                formData.append('document', file);
                formData.append('type', this.documentType);
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) formData.append('_token', csrfToken.getAttribute('content'));

                try {
                    const response = await fetch(`/applicant/application/{{$application->id}}/upload-document`, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    if (!response.ok) {
                        const data = await response.json();
                        throw new Error(data.error || 'Upload failed');
                    }

                    const data = await response.json();
                    this.uploading = false;
                    this.uploaded = true;
                    this.fileId = data.document ? data.document.id : (data.file_id || data.id);
                    
                    if (data.document) {
                        this.fileName = data.document.original_name || data.document.filename;
                        this.fileSize = formatSize(data.document.size);
                    } else if (data.filename) {
                        this.fileName = data.filename;
                    }
                    if (data.size) this.fileSize = formatSize(data.size);
                    
                    window.dispatchEvent(new CustomEvent('document-changed', {
                        detail: { 
                            action: 'upload',
                            type: this.documentType, 
                            document: data.document
                        }
                    }));
                    
                } catch (error) {
                    this.uploading = false;
                    this.error = true;
                    this.errorMessage = error.message || 'Upload failed. Please try again.';
                }
            },

            async removeFile() {
                if (!this.fileId) {
                    this.resetFileState();
                    return;
                }

                this.uploading = true;
                this.error = false;

                const formData = new FormData();
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (csrfToken) formData.append('_token', csrfToken.getAttribute('content'));

                try {
                    const response = await fetch(`/applicant/application/{{$application->id}}/remove-document/${this.fileId}`, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    if (!response.ok) throw new Error('Failed to remove file');
                    
                    this.uploading = false;
                    this.resetFileState();
                    window.dispatchEvent(new CustomEvent('document-changed', {
                        detail: { 
                            action: 'delete',
                            type: this.documentType
                        }
                    }));
                    
                } catch (error) {
                    this.uploading = false;
                    this.error = true;
                    this.errorMessage = error.message || 'Failed to remove file. Please try again.';
                }
            },

            resetFileState() {
                this.uploaded = false;
                this.uploading = false;
                this.fileName = '';
                this.fileSize = '';
                this.fileId = null;
                this.error = false;
                this.errorMessage = '';
                this.isDragging = false;

                const fileInput = document.getElementById(`${this.documentType}-file`);
                if (fileInput) {
                    fileInput.value = '';
                    fileInput.dispatchEvent(new Event('change'));
                }
            }
        }
    }
</script>
@endsection