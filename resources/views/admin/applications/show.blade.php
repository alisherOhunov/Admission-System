@extends('layouts.app')

@section('title', 'Admin Dashboard - ' . config('app.name'))

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
            <!-- Back Button -->
            <div class="mb-4 sm:mb-6">
                <a href="{{ route('admin.applications.index') }}">
                    <button    
                        class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 text-sm font-medium text-gray-700 
                        bg-white border border-gray-300 rounded-lg hover:bg-gray-100 active:bg-gray-200 
                        focus:outline-none disabled:opacity-50 
                        disabled:pointer-events-none transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7M19 12H5"/>
                        </svg>
                        <span class="hidden sm:inline">{{ __('admin/show.back_to_applications') }}</span>
                        <span class="sm:hidden">{{ __('Back') }}</span>
                    </button>
                </a>
            </div>

            <!-- Page Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between py-4 space-y-4 sm:space-y-0">
                    <!-- Title Section -->
                    <div class="flex flex-col">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ __('admin/show.application_details') }}</h1>
                        <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">{{ __('admin/show.application_id') }} {{ $application->id }}</p>
                    </div>

                    <!-- Action Buttons Section -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-4 sm:space-x-0">
                        @php
                            $statusData = $application->getStatusData();
                            $status = strtolower($application->status);
                        @endphp

                        <!-- Status Badge -->
                        <div id="status-badge"
                            class="inline-flex items-center justify-center sm:justify-start rounded-full border px-3 py-1.5 sm:px-2.5 sm:py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $statusData['color'] }} {{ $statusData['bg'] }}">
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </div>

                        <!-- Update Status Button -->
                        <div class="relative" x-data="{ open: false }">
                            <div x-data="{ showModal: false, newStatus: 'under_review', showNotesField: false, errorMessage: '' }">
                                <button @click="showModal = true"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2
                                    @if ($status === 'require_resubmit' || $status === 'accepted') bg-gray-100 text-gray-400 cursor-not-allowed @endif"
                                    id="update-status-button">
                                    @if ($status === 'accepted' || $status === 'require_resubmit')
                                        {{ __('admin/show.status_locked') }}
                                    @else
                                        {{ __('admin/show.update_status') }}
                                    @endif
                                </button>

                                @if ($status !== 'accepted' && $status !== 'require_resubmit')
                                    <!-- Modal -->
                                    <div x-show="showModal" x-transition
                                        class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50 p-4">
                                        <div @click.away="showModal = false"
                                            class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 w-full max-w-md z-50 max-h-[90vh] overflow-y-auto">
                                            <div class="flex items-center justify-between mb-4">
                                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900">
                                                    {{ __('admin/show.update_status_title') }}
                                                </h2>
                                                <button @click="showModal = false"
                                                    class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-6">
                                                {{ __('admin/show.update_status_description') }}
                                            </p>
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    {{ __('admin/show.current_status_label') }}
                                                </label>
                                                <span id="current-status-display"
                                                    class="inline-block text-sm font-semibold px-3 py-1 rounded-full {{ $statusData['color'] . ' ' . $statusData['bg'] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucwords(str_replace('_', ' ', $status)) }}
                                                </span>
                                            </div>
                                            <form
                                                hx-post="{{ route('admin.applications.status', ['application_id' => $application->id]) }}"
                                                hx-swap="none" hx-on::after-request="handleStatusUpdate(event)">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="newStatus"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        {{ __('admin/show.new_status') }}
                                                    </label>
                                                    <select id="newStatus" name="status" x-model="newStatus"
                                                        @change="showNotesField = (newStatus === 'require_resubmit')"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                        required>
                                                        <option value="under_review">
                                                            {{ __('admin/show.status.under_review') }}</option>
                                                        <option value="accepted">{{ __('admin/show.status.accepted') }}
                                                        </option>
                                                        <option value="rejected">{{ __('admin/show.status.rejected') }}
                                                        </option>
                                                        <option value="require_resubmit">
                                                            {{ __('admin/show.status.require_resubmit') }}</option>
                                                    </select>
                                                </div>
                                                <div x-show="showNotesField" x-transition class="mb-4">
                                                    <label for="statusNote"
                                                        class="block text-sm font-medium text-gray-700 mb-1">
                                                        {{ __('admin/show.notes') }} <span
                                                            class="text-red-500">*</span>
                                                    </label>
                                                    <textarea id="statusNote" name="admin_resubmission_comment"
                                                        placeholder="Please provide reason for resubmission requirement..."
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                                        rows="3" :required="newStatus === 'require_resubmit'" @input="errorMessage = ''"></textarea>
                                                    <p class="text-xs text-gray-500 mt-1">
                                                        {{ __('admin/show.note_required') }}
                                                    </p>
                                                </div>

                                                <div x-show="errorMessage" x-transition class="mb-4">
                                                    <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                                        <p class="text-sm text-red-600" x-text="errorMessage"></p>
                                                    </div>
                                                </div>

                                                <div class="flex flex-col sm:flex-row justify-end gap-2 sm:space-x-3 sm:gap-0">
                                                    <button type="button" @click="showModal = false"
                                                        class="w-full sm:w-auto px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 order-2 sm:order-1">
                                                        {{ __('admin/show.cancel') }}
                                                    </button>
                                                    <button type="submit"
                                                        class="w-full sm:w-auto px-4 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600 order-1 sm:order-2">
                                                        {{ __('admin/show.submit') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Export PDF Button -->
                        <button
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-download h-4 w-4">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" x2="12" y1="15" y2="3"></line>
                            </svg>
                            <span class="hidden sm:inline">{{ __('admin/show.export_pdf') }}</span>
                            <span class="sm:hidden">{{ __('Export') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <!-- Left Column - Information Cards (Takes 2 columns on desktop) -->
                <div class="lg:col-span-2 space-y-4 sm:space-y-6 lg:space-y-8">
                    
                    <!-- Personal Information Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-5 w-5 sm:h-6 sm:w-6">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.personal_information') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.first_name') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">{{ $application->user->first_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.last_name') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900">{{ $application->user->last_name }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.date_of_birth') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->date_of_birth ? $application->date_of_birth->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.gender') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->gender == 1 ? __('applicant/review-and-submit.male') : ($application->gender == 2 ? __('applicant/review-and-submit.female') : __('applicant/review-and-submit.not_specified')) }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.family_status') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->family_status == 1 ? __('applicant/review-and-submit.single') : ($application->family_status == 2 ? __('applicant/review-and-submit.married') : __('applicant/review-and-submit.not_specified')) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.passport_number') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->passport_number ? $application->passport_number : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.nationality') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        @if ($application->nationality)
                                            @foreach (config('countries') as $code => $name)
                                                {{ $application->nationality == $code ? $name : '' }}
                                            @endforeach
                                        @else
                                            {{ __('applicant/review-and-submit.not_specified') }}
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.native_language') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->native_language ? $application->native_language : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                    Country of Birth
                                </p>
                                <p class="text-sm sm:text-base text-gray-900">
                                    @if ($application->country_of_birth)
                                        @foreach (config('countries') as $code => $name)
                                            {{ $application->country_of_birth == $code ? $name : '' }}
                                        @endforeach
                                    @else
                                        {{ __('applicant/review-and-submit.not_specified') }}
                                    @endif
                                </p>
                            </div>

                            @if (isset($documents['passport']))
                                <div>
                                    <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                        Uploaded documents
                                    </p>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                Passport
                                            </p>
                                            <p class="text-sm font-medium text-gray-800 truncate">
                                                {{ $documents['passport']['original_name'] }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-3 flex-shrink-0">
                                            <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents['passport']['id'] }}"
                                                target="_blank"
                                                class="text-green-600 hover:text-green-800 transition-colors"
                                                title="View">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="/admin/applications/{{ $application->id }}/document/{{ $documents['passport']['id'] }}"
                                                class="text-blue-600 hover:text-blue-800 transition-colors"
                                                title="Download">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-5 w-5 sm:h-6 sm:w-6">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.contact_information') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.email') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900 break-all">{{ $application->user->email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.phone') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->phone ? $application->phone : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-2">
                                    {{ __('applicant/review-and-submit.permanent_address') }}</p>

                                <div class="space-y-3">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.street') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->permanent_street ? $application->permanent_street : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.city') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->permanent_city ? $application->permanent_city : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.state') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->permanent_state ? $application->permanent_state : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.country') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->permanent_country ? config('countries')[$application->permanent_country] ?? __('applicant/review-and-submit.not_specified') : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.postcode') }}</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->permanent_postcode ? $application->permanent_postcode : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">Do you Have a visa?</p>
                                            <p class="text-sm sm:text-base text-gray-900">
                                                {{ $application->has_visa === true ? 'Yes' : ($application->has_visa === false ? 'No' : __('applicant/review-and-submit.not_specified')) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (isset($documents['visa_proof']))
                                <div>
                                    <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                        Uploaded documents
                                    </p>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                Visa proof
                                            </p>
                                            <p class="text-sm font-medium text-gray-800 truncate">
                                                {{ $documents['visa_proof']['original_name'] }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-3 flex-shrink-0">
                                            <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents['visa_proof']['id'] }}"
                                                target="_blank"
                                                class="text-green-600 hover:text-green-800 transition-colors"
                                                title="View">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="/admin/applications/{{ $application->id }}/document/{{ $documents['visa_proof']['id'] }}"
                                                class="text-blue-600 hover:text-blue-800 transition-colors"
                                                title="Download">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Academic Background Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap h-5 w-5 sm:h-6 sm:w-6">
                                        <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path>
                                        <path d="M22 10v6"></path>
                                        <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.academic_background') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.previous_institution') }}
                                </p>
                                <p class="text-sm sm:text-base text-gray-900">
                                    {{ $application->previous_institution ? $application->previous_institution : __('applicant/review-and-submit.not_specified') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.degree_earned') }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->degree_earned ? $application->degree_earned : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.gpa_grade') }}</p>
                                    <p class="text-sm sm:text-base text-gray-900">
                                        {{ $application->previous_gpa ? $application->previous_gpa : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.graduation_date') }}
                                </p>
                                <p class="text-sm sm:text-base text-gray-900">
                                    {{ $application->graduation_date ? $application->graduation_date->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                                </p>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs sm:text-sm font-medium text-gray-700">
                                    {{ __('applicant/review-and-submit.language_proficiency') }}
                                </p>
                                <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 text-xs sm:text-sm space-y-1 sm:space-y-0">
                                    <span class="text-gray-900">Type: {{ $application->language_test_type }}</span>
                                    <span class="hidden sm:inline text-gray-500">•</span>
                                    <span class="text-gray-900">{{ __('applicant/review-and-submit.score') }}: {{ $application->language_test_score }}</span>
                                    <span class="hidden sm:inline text-gray-500">•</span>
                                    <span class="text-gray-700">Date: {{ optional($application->language_test_date)->format('Y/m/d') }}</span>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                    Uploaded Documents
                                </p>
                                <div class="space-y-2">
                                    @foreach (['transcript' => 'Transcript', 'diploma' => 'Diploma', 'language_certificate' => 'Language Certificate'] as $key => $label)
                                        @if (isset($documents[$key]))
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                        {{ $label }}
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800 truncate">
                                                        {{ $documents[$key]['original_name'] }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-3 flex-shrink-0">
                                                    <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents[$key]['id'] }}"
                                                        target="_blank"
                                                        class="text-green-600 hover:text-green-800 transition-colors"
                                                        title="View">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="/admin/applications/{{ $application->id }}/document/{{ $documents[$key]['id'] }}"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                                        title="Download">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program Selection Card -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target h-5 w-5 sm:h-6 sm:w-6">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <circle cx="12" cy="12" r="6"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                    </svg>
                                </span>
                                <h2 class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ __('applicant/review-and-submit.program_selection') }}
                                </h2>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 pt-2 space-y-3 sm:space-y-4">
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.selected_program') }}
                                </p>
                                <p class="text-base sm:text-lg font-semibold text-gray-900">
                                    {{ $application->program?->name ?? __('applicant/review-and-submit.not_specified') }}
                                </p>
                                <p class="text-sm sm:text-base text-gray-600 capitalize">{{ $application->level ? $application->level : __('applicant/review-and-submit.not_specified') }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm font-medium text-gray-700 mb-1">
                                    {{ __('applicant/review-and-submit.start_term') }}
                                </p>
                                <p class="text-sm sm:text-base text-gray-900 capitalize">{{ $application->start_term ? preg_replace('/(\D+)(\d+)/', '$1 $2', $application->start_term) : __('applicant/review-and-submit.not_specified') }}</p>
                            </div>

                            <div class="flex items-center space-x-2">
                                <input type="checkbox" disabled id="needs_dormitory"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    @checked($application->needs_dormitory) />
                                <label for="needs_dormitory" class="text-xs sm:text-sm text-gray-700">
                                    {{ __('applicant/program-choice.needs_dormitory') }}
                                </label>
                            </div>

                            <div>
                                <p class="text-sm sm:text-base font-semibold text-gray-800 mb-2">
                                    Uploaded Documents
                                </p>
                                <div class="space-y-2">
                                    @foreach (['motivation_letter' => 'Motivation Letter', 'cv' => 'Curriculum Vitae (CV)'] as $key => $label)
                                        @if (isset($documents[$key]))
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border border-gray-200 rounded-lg bg-gray-50 p-3 sm:px-4 sm:py-3 shadow-sm space-y-2 sm:space-y-0">
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                        {{ $label }}
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800 truncate">
                                                        {{ $documents[$key]['original_name'] }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-3 flex-shrink-0">
                                                    <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents[$key]['id'] }}"
                                                        target="_blank"
                                                        class="text-green-600 hover:text-green-800 transition-colors"
                                                        title="View">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="/admin/applications/{{ $application->id }}/document/{{ $documents[$key]['id'] }}"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                                        title="Download">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Timeline Card (Takes 1 column on desktop) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border lg:sticky lg:top-4">
                        <div class="p-4 sm:p-6">
                            <h2 class="text-xl sm:text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <span class="inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-4 w-4 sm:h-5 sm:w-5">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                </span>
                                <span>{{ __('admin/show.timeline') }}</span>
                            </h2>
                        </div>
                        <div class="px-4 sm:px-6 pb-4 sm:pb-6">
                            <div class="space-y-4">
                                <!-- Application Submitted -->
                                <div class="flex">
                                    <div class="mr-3 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-5 w-5 text-green-500">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __('admin/show.application_submitted') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            @if ($application->submitted_at)
                                                {{ $application->submitted_at->format('Y/m/d') }}
                                            @else
                                                {{ __('admin/show.not_submitted_yet') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Under Review -->
                                <div class="flex">
                                    <div class="mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-5 w-5 text-yellow-500">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __('admin/show.application') . ' ' . __('admin/show.status.under_review') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Final Status -->
                                <div class="flex" id="timeline-status-display" 
                                    x-data="{ applicationStatus: '{{ $application->status }}' }"
                                    x-show="applicationStatus !== 'under_review' && applicationStatus !== 'draft' && applicationStatus !== 'submitted'"
                                    x-transition>
                                    <div class="mr-3 mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-5 w-5 {{ $statusData['svg_color'] }}">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 mt-2">
                                        <p class="text-sm font-medium text-gray-900">
                                            <span>{{ __('admin/show.application') }} </span>
                                            <span id="timeline-status-badge">{{ ucwords(str_replace('_', ' ', $status)) }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $application->updated_at->format('Y/m/d') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleStatusUpdate(event) {
            if (event.detail.successful) {
                let response = JSON.parse(event.detail.xhr.response);
                if (response.status) {
                    const statusBadge = document.getElementById('status-badge');
                    const timelineStatusBadge = document.getElementById('timeline-status-badge');
                    const responseStatus = response.status.replace('_', ' ');
                    const newStatus = responseStatus.charAt(0).toUpperCase() + responseStatus.slice(1).toLowerCase();
                    const currentStatusDisplay = document.getElementById('current-status-display');
                    const timelineStatusDisplay = document.getElementById('timeline-status-display');
                    const statusClasses = {
                        'rejected': 'bg-red-100 text-red-500 hover:bg-red-200',
                        'under_review': 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200',
                        'require_resubmit': 'bg-blue-100 text-blue-500 hover:bg-blue-200',
                        'accepted': 'bg-green-100 text-green-500 hover:bg-green-200'
                    };

                    Object.values(statusClasses).forEach(cls => {
                        statusBadge.classList.remove(...cls.split(' '));
                    });

                    const newStatusClass = statusClasses[response.status] || 'bg-gray-100 text-gray-800';
                    statusBadge.classList.add(...newStatusClass.split(' '));
                    statusBadge.textContent = newStatus;

                    if (timelineStatusBadge) {
                        timelineStatusBadge.textContent = newStatus;
                    }

                    currentStatusDisplay.classList.add(...newStatusClass.split(' '));
                    currentStatusDisplay.textContent = newStatus;

                    if (timelineStatusDisplay) {
                        const alpineComponent = Alpine.$data(timelineStatusDisplay);
                        if (alpineComponent) {
                            alpineComponent.applicationStatus = response.status;
                        }
                        const svgIcon = timelineStatusDisplay.querySelector('svg');
                        if (svgIcon) {
                            Object.values(statusClasses).forEach(cls => {
                                const colorClass = cls.split(' ').find(c => c.startsWith('text-'));
                                if (colorClass) svgIcon.classList.remove(colorClass);
                            });

                            const newStatusClass = statusClasses[response.status] || 'bg-gray-100 text-gray-800';
                            const newTextColor = newStatusClass.split(' ').find(c => c.startsWith('text-'));
                            if (newTextColor) svgIcon.classList.add(newTextColor);
                        }
                    }

                    if (response.status === 'accepted' || response.status === 'require_resubmit') {
                        const updateButton = document.getElementById('update-status-button');
                        if (updateButton) {
                            updateButton.disabled = true;
                            updateButton.textContent = 'Status Locked';
                        }
                    }

                    document.dispatchEvent(new CustomEvent('close-status-modal'));
                }
            }
        }

        document.addEventListener('close-status-modal', function() {
            const modalComponent = document.querySelector('[x-data*="showModal"]');
            if (modalComponent && modalComponent._x_dataStack) {
                modalComponent._x_dataStack[0].showModal = false;
                modalComponent._x_dataStack[0].errorMessage = '';
                modalComponent._x_dataStack[0].showNotesField = false;
            }
        });
    </script>
@endsection