@extends('layouts.app')

@section('title', 'Admin Dashboard - EduAdmit')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6">
                <a href="{{ route('admin.applications.index') }}">
                    <button
                        class="justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background 
                        transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring 
                        focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none 
                        [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-blue-50 h-10 px-4 py-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-left h-4 w-4 mr-2">
                            <path d="m12 19-7-7 7-7"></path>
                            <path d="M19 12H5"></path>
                        </svg>
                        {{ __('admin/show.back_to_applications') }}
                    </button>
                </a>
            </div>
            <div>
                <div class="mb-8">
                    <div class="flex items-center justify-between py-4">
                        <div class="flex flex-col">
                            <h1 class="text-3xl font-bold text-gray-900">{{ __('admin/show.application_details') }}</h1>
                            <p class="mt-2 text-gray-600">{{ __('admin/show.application_id') }} {{ $application->id }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            @php
                                $statusData = $application->getStatusData();
                                $status = strtolower($application->status);
                            @endphp

                            <div id="status-badge"
                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $statusData['color'] }} {{ $statusData['bg'] }}">
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                            </div>

                            <div class="relative" x-data="{ open: false }">
                                <div x-data="{ showModal: false, newStatus: 'under_review', showNotesField: false, errorMessage: '' }">
                                    <button @click="showModal = true"
                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2
                                        @if ($status === 'require_resubmit' || $status === 'accepted') bg-gray-100 text-gray-400 cursor-not-allowed @endif"
                                        id="update-status-button">
                                        @if ($status === 'accepted' || $status === 'require_resubmit')
                                            {{ __('admin/show.status_locked') }}
                                        @else
                                            {{ __('admin/show.update_status') }}
                                        @endif
                                    </button>

                                    @if ($status !== 'accepted' && $status !== 'require_resubmit')
                                        <div x-show="showModal" x-transition
                                            class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50">
                                            <div @click.away="showModal = false"
                                                class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md z-50">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h2 class="text-xl font-semibold text-gray-900">
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

                                                    <div class="flex justify-end space-x-3">
                                                        <button type="button" @click="showModal = false"
                                                            class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                            {{ __('admin/show.cancel') }}
                                                        </button>
                                                        <button type="submit"
                                                            class="px-4 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">
                                                            {{ __('admin/show.submit') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <button
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-download h-4 w-4 mr-2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" x2="12" y1="15" y2="3"></line>
                                </svg>
                                {{ __('admin/show.export_pdf') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Applicant Information Cards - Takes 2 columns -->
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-8">
                        <!-- Personal Information Card -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-6 pb-4">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-user h-6 w-6">
                                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </span>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ __('applicant/review-and-submit.personal_information') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="p-6 pt-2 space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.first_name') }}
                                        </p>
                                        <p class="text-gray-900">{{ $application->user->first_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.last_name') }}</p>
                                        <p class="text-gray-900">{{ $application->user->last_name }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.date_of_birth') }}
                                        </p>
                                        <p class="text-gray-900">
                                            {{ $application->date_of_birth ? $application->date_of_birth->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.gender') }}</p>
                                        <p class="text-gray-900">
                                            {{ $application->gender == 1 ? __('applicant/review-and-submit.male') : ($application->gender == 2 ? __('applicant/review-and-submit.female') : __('applicant/review-and-submit.not_specified')) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.nationality') }}
                                        </p>
                                        <p class="text-gray-900">
                                            @if ($application->nationality)
                                                @foreach (config('countries') as $code => $name)
                                                    <p class="text-gray-900">
                                                        {{ $application->nationality == $code ? $name : '' }}
                                                    </p>
                                                @endforeach
                                            @else
                                                {{ __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.passport_number') }}
                                        </p>
                                        <p class="text-gray-900">
                                            {{ $application->passport_number ? $application->passport_number : __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.native_language') }}
                                    </p>
                                    <p class="text-gray-900">
                                        {{ $application->native_language ? $application->native_language : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>
                                @if (isset($documents['passport']))
                                    <div>
                                        <p class="text-md font-semibold text-gray-800 mb-2">
                                            Uploaded documents
                                        </p>

                                        <div
                                            class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm">
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                    Passport
                                                </p>
                                                <p class="text-sm font-medium text-gray-800">
                                                    {{ $documents['passport']['original_name'] }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <!-- View Button -->
                                                <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents['passport']['id'] }}"
                                                    target="_blank"
                                                    class="text-green-600 hover:text-green-800 transition-colors"
                                                    title="View">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="/admin/applications/{{ $application->id }}/document/{{ $documents['passport']['id'] }}"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors"
                                                    title="{{ __('Download') }}">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                            <div class="p-6 pb-4">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-mail h-6 w-6">
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                        </svg>
                                    </span>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ __('applicant/review-and-submit.contact_information') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="p-6 pt-2 space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.email') }}</p>
                                        <p class="text-gray-900">{{ $application->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.phone') }}</p>
                                        <p class="text-gray-900">
                                            {{ $application->phone ? $application->phone : __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-2">
                                        {{ __('applicant/review-and-submit.permanent_address') }}</p>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.street') }}</p>
                                            <p class="text-gray-900">
                                                {{ $application->permanent_street ? $application->permanent_street : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.city') }}</p>
                                            <p class="text-gray-900">
                                                {{ $application->permanent_city ? $application->permanent_city : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.state') }}</p>
                                            <p class="text-gray-900">
                                                {{ $application->permanent_state ? $application->permanent_state : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.country') }}</p>
                                            <p class="text-gray-900">
                                                {{ $application->permanent_country ? config('countries')[$application->permanent_country] ?? __('applicant/review-and-submit.not_specified') : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 mb-1">
                                                {{ __('applicant/review-and-submit.postcode') }}</p>
                                            <p class="text-gray-900">
                                                {{ $application->permanent_postcode ? $application->permanent_postcode : __('applicant/review-and-submit.not_specified') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($documents['address_proof']))
                                    <div>
                                        <p class="text-md font-semibold text-gray-800 mb-2">
                                            Uploaded documents
                                        </p>

                                        <div
                                            class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm">
                                            <div>
                                                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                    Address Proof
                                                </p>
                                                <p class="text-sm font-medium text-gray-800">
                                                    {{ $documents['address_proof']['original_name'] }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <!-- View Button -->
                                                <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents['address_proof']['id'] }}"
                                                    target="_blank"
                                                    class="text-green-600 hover:text-green-800 transition-colors"
                                                    title="View">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="/admin/applications/{{ $application->id }}/document/{{ $documents['address_proof']['id'] }}"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors"
                                                    title="{{ __('Download') }}">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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
                            <div class="p-6 pb-4">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-graduation-cap h-6 w-6">
                                            <path
                                                d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z">
                                            </path>
                                            <path d="M22 10v6"></path>
                                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                        </svg>
                                    </span>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ __('applicant/review-and-submit.academic_background') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="p-6 pt-2 space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.previous_institution') }}
                                    </p>
                                    <p class="text-gray-900">
                                        {{ $application->previous_institution ? $application->previous_institution : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.degree_earned') }}
                                        </p>
                                        <p class="text-gray-900">
                                            {{ $application->degree_earned ? $application->degree_earned : __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.gpa_grade') }}</p>
                                        <p class="text-gray-900">
                                            {{ $application->previous_gpa ? $application->previous_gpa : __('applicant/review-and-submit.not_specified') }}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1">
                                        {{ __('applicant/review-and-submit.graduation_date') }}
                                    </p>
                                    <p class="text-gray-900">
                                        {{ $application->graduation_date ? $application->graduation_date->format('Y/m/d') : __('applicant/review-and-submit.not_specified') }}
                                    </p>
                                </div>

                                <div class="space-y-2">
                                    <p class="text-sm font-medium text-gray-700">
                                        {{ __('applicant/review-and-submit.english_proficiency') }}
                                    </p>
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="text-gray-900">{{ $application->english_test_type }}</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="text-gray-900">{{ __('applicant/review-and-submit.score') }}:
                                            {{ $application->english_test_score }}</span>
                                        <span class="text-gray-500">•</span>
                                        <span class="text-gray-700">
                                            {{ optional($application->english_test_date)->format('Y/m/d') ?? __('applicant/review-and-submit.not_submitted_yet') }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 mb-2">
                                        Uploaded Documents
                                    </p>

                                    @foreach (['transcript' => 'Transcript', 'diploma' => 'Diploma', 'english_score' => 'English Score'] as $key => $label)
                                        @if (isset($documents[$key]))
                                            <div
                                                class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm mb-2">
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                        {{ $label }}
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ $documents[$key]['original_name'] }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-3">
                                                    <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents[$key]['id'] }}"
                                                        target="_blank"
                                                        class="text-green-600 hover:text-green-800 transition-colors"
                                                        title="View">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="/admin/applications/{{ $application->id }}/document/{{ $documents[$key]['id'] }}"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                                        title="Download">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Program Selection Card -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                            <div class="p-6 pb-4">
                                <div class="flex items-center space-x-3">
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-target h-6 w-6">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <circle cx="12" cy="12" r="6"></circle>
                                            <circle cx="12" cy="12" r="2"></circle>
                                        </svg>
                                    </span>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ __('applicant/review-and-submit.program_selection') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="p-6 pt-2 space-y-4">
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.selected_program') }}
                                        </p>
                                        <p class="text-lg font-semibold text-gray-900">
                                            {{ __('applicant/review-and-submit.program_name') }}
                                        </p>
                                        <p class="text-gray-600">{{ __('applicant/review-and-submit.school_name') }}</p>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ __('applicant/review-and-submit.masters_badge') }}</span>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-1">
                                            {{ __('applicant/review-and-submit.start_term') }}
                                        </p>
                                        <p class="text-gray-900">{{ __('applicant/review-and-submit.fall_2024') }}</p>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" disabled
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            @checked($application->needs_dormitory) />
                                        <span class="text-sm text-gray-700">
                                            {{ __('applicant/review-and-submit.scholarship_interest') }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-800 mb-2">
                                        Uploaded Documents
                                    </p>

                                    @foreach (['sop' => 'Statement of Purpose', 'cv' => 'Curriculum Vitae (CV)', 'portfolio' => 'Portfolio'] as $key => $label)
                                        @if (isset($documents[$key]))
                                            <div
                                                class="flex items-center justify-between border border-gray-200 rounded-lg bg-gray-50 px-4 py-3 shadow-sm mb-2">
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">
                                                        {{ $label }}
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ $documents[$key]['original_name'] }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-3">
                                                    <a href="/admin/applications/{{ $application->id }}/view-document/{{ $documents[$key]['id'] }}"
                                                        target="_blank"
                                                        class="text-green-600 hover:text-green-800 transition-colors"
                                                        title="View">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    <a href="/admin/applications/{{ $application->id }}/document/{{ $documents[$key]['id'] }}"
                                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                                        title="Download">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
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

                <!-- Timeline Card - Takes 1 column -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border sticky top-4">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <span
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-calendar h-5 w-5">
                                        <path d="M8 2v4"></path>
                                        <path d="M16 2v4"></path>
                                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                        <path d="M3 10h18"></path>
                                    </svg>
                                </span>
                                <span>{{ __('admin/show.timeline') }}</span>
                            </h3>
                        </div>
                        <div class="px-6 pb-6">
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="mr-3 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-check-big h-5 w-5 text-green-500">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ __('admin/show.application_submitted') }}</p>
                                        <p class="text-xs text-gray-500">
                                            @if ($application->submitted_at)
                                                {{ $application->submitted_at->format('Y/m/d') }}
                                            @else
                                                {{ __('admin/show.not_submitted_yet') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-check-big h-5 w-5 text-yellow-500">
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
                                <div class="flex" id="timeline-status-display" x-data="{ applicationStatus: '{{ $application->status }}' }"
                                    x-show="applicationStatus !== 'under_review' && applicationStatus !== 'draft' && applicationStatus !== 'submitted'"
                                    x-transition>
                                    <div class="mr-3 mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-check-big h-5 w-5 {{ $statusData['svg_color'] }}">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 mt-2">
                                        <p class="text-sm font-medium text-gray-900">
                                            <span>{{ __('admin/show.application') }} </span>
                                            <span
                                                id="timeline-status-badge">{{ ucwords(str_replace('_', ' ', $status)) }}
                                            </span>
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