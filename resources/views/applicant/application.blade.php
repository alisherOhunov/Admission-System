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
                            {{ __('applicant/application.heading') }}
                        </h1>
                        <p class="mt-2 text-gray-600">
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
                        <div class="mb-8">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-8 overflow-x-auto">
                                    @foreach(range(1,5) as $i)
                                        <button
                                            type="button"
                                            @click="currentStep = {{ $i }}"
                                            :class="getButtonClass({{ $i }})"
                                            class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium transition-all duration-200"
                                        >
                                            <div class="flex flex-col items-center space-y-2">
                                                <div class="relative">
                                                    <div
                                                        :class="getCircleClass({{ $i }})"
                                                        class="flex items-center justify-center w-8 h-8 rounded-full border-2 transition-all duration-200"
                                                    >
                                                        <span 
                                                            :class="getTextClass({{ $i }})"
                                                            class="text-sm font-medium"
                                                        >{{ $i }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div 
                                                        :class="getTextClass({{ $i }})"
                                                        class="text-sm font-medium"
                                                    >
                                                        {{ __('applicant/application.step_'.$i.'_title') }}
                                                    </div>
                                                    <div class="text-xs text-gray-400 hidden sm:block">
                                                        {{ __('applicant/application.step_'.$i.'_desc') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    @endforeach
                                </nav>
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
                        <div class="h-24 w-24 rounded-full border-t-8 border-b-8 border-gray-200"></div>
                        <div class="absolute top-0 left-0 h-24 w-24 rounded-full border-t-8 border-b-8 border-blue-500 animate-spin"></div>
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
    function tabStepper() {
        return {
            currentStep: parseInt(sessionStorage.getItem('currentStep')) || 1,

            buttonActive: 'border-blue-500 text-blue-600 border-b-2 opacity-100',
            buttonInactive: 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50',
            buttonError: 'border-red-500 text-red-600 border-b-2 opacity-100',
            circleActive: 'border-blue-600 bg-white',
            circleInactive: 'border-gray-300 bg-white',
            circleError: 'border-red-600 bg-red-50',
            textActive: 'text-blue-600',
            textInactive: 'text-gray-500',
            textError: 'text-red-600',
            
            init() {
                this.$watch('currentStep', value => {
                    sessionStorage.setItem('currentStep', value);
                });
            },
            
            hasErrors(step) {
                const stepElement = document.querySelector(`[data-step="${step}"]`);
                return stepElement ? stepElement.querySelector('.text-red-600') !== null : false;
            },
            
            getButtonClass(step) {
                if (this.hasErrors(step)) return this.buttonError;
                return this.currentStep === step ? this.buttonActive : this.buttonInactive;
            },
            
            getCircleClass(step) {
                if (this.hasErrors(step)) return this.circleError;
                return this.currentStep === step ? this.circleActive : this.circleInactive;
            },
            
            getTextClass(step) {
                if (this.hasErrors(step)) return this.textError;
                return this.currentStep === step ? this.textActive : this.textInactive;
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
            fileName: initialFile ? initialFile.filename : '',
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