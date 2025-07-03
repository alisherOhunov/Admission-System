@extends('layouts.app')

@section('title', 'Admin Dashboard - EduAdmit')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}">
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
                        Back to Applications
                    </button>
                </a>
            </div>
            <div>
                <div class="mb-8">
                    <div class="flex items-center justify-between py-4">
                        <div class="flex flex-col">
                            <h1 class="text-3xl font-bold text-gray-900">Application Details</h1>
                            <p class="mt-2 text-gray-600">Application ID: {{ $application->id }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            @php
                                $statusClasses = [
                                    'rejected' => 'bg-red-100 text-red-800 hover:bg-red-200',
                                    'draft' => 'bg-gray-200 text-gray-800 hover:bg-gray-300',
                                    'under_review' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200',
                                    'submitted' => 'bg-blue-100 text-blue-800 hover:bg-blue-200',
                                    'accepted' => 'bg-green-100 text-green-800 hover:bg-green-200',
                                ];

                                $status = strtolower($application->status);
                            @endphp

                            <div id="status-badge"
                                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucwords(str_replace('_', ' ', $status)) }}
                            </div>

                            <div class="relative" x-data="{ open: false }">
                                <div x-data="{ showModal: false, newStatus: 'under_review' }">
                                    <button @click="showModal = true"
                                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2
                                        @if ($status === 'accepted') bg-gray-100 text-gray-400 cursor-not-allowed @endif"
                                        id="update-status-button">
                                        @if ($status === 'accepted')
                                            Status Locked
                                        @else
                                            Update Status
                                        @endif
                                    </button>

                                    @if ($status !== 'accepted')
                                        <div x-show="showModal" x-transition
                                            class="fixed inset-0 z-40 flex items-center justify-center bg-black bg-opacity-50">
                                            <div @click.away="showModal = false"
                                                class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-md z-50">
                                                <div class="flex items-center justify-between mb-4">
                                                    <h2 class="text-xl font-semibold text-gray-900">Update Application
                                                        Status</h2>
                                                    <button @click="showModal = false"
                                                        class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
                                                </div>
                                                <p class="text-sm text-gray-600 mb-6">
                                                    Change the status of this application. This action will be recorded and
                                                    may trigger notifications to
                                                    the applicant.
                                                </p>
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Current
                                                        Status</label>
                                                    <span id="current-status-display"
                                                        class="inline-block text-sm font-semibold px-3 py-1 rounded-full {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                                    </span>
                                                </div>
                                                <form
                                                    hx-post="{{ route('admin.applications.status', ['application_id' => $application->id]) }}"
                                                    hx-swap="none" hx-on::after-request="handleStatusUpdate(event)">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="newStatus"
                                                            class="block text-sm font-medium text-gray-700 mb-1">New
                                                            Status</label>
                                                        <select id="newStatus" name="status" x-model="newStatus"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                            required>
                                                            <option value="under_review">Under Review</option>
                                                            <option value="accepted">Accepted</option>
                                                            <option value="rejected">Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex justify-end space-x-3">
                                                        <button type="button" @click="showModal = false"
                                                            class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">
                                                            Cancel
                                                        </button>
                                                        <button type="submit" @click="showModal = false"
                                                            class="px-4 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">
                                                            Update Status
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
                                Export PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-user h-5 w-5">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Applicant Information</span>
                            </h3>
                        </div>
                        <div class="px-6 pb-6 ">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Full
                                        Name</label>
                                    <p class="text-gray-900">
                                        {{ $application->user->first_name . ' ' . $application->user->last_name }}</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">
                                        Email
                                    </label>
                                    <p>{{ $application->email }}</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">
                                        Phone
                                    </label>
                                    <p class="text-gray-900">{{ $application->phone ?? 'Not Specified' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Nationality</label>
                                    @if ($application->nationality)
                                        @foreach (config('countries') as $code => $name)
                                            <p class="text-gray-900">{{ $application->nationality == $code ? $name : '' }}
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-gray-900">Not specified</p>
                                    @endif
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">
                                        Date of Birth
                                    </label>
                                    @if ($application->date_of_birth)
                                        <p class="text-gray-900">{{ $application->date_of_birth->format('Y/m/d') }}</p>
                                    @else
                                        <p class="text-gray-900">Not Specified</p>
                                    @endif
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Passport
                                        Number</label>
                                    <p class="text-gray-900">{{ $application->passport_number ?? 'Not Specified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-graduation-cap h-5 w-5">
                                    <path
                                        d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z">
                                    </path>
                                    <path d="M22 10v6"></path>
                                    <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path>
                                </svg>
                                <span>Program Information</span>
                            </h3>
                        </div>
                        <div class="px-6 pb-6 ">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">
                                        Program
                                    </label>
                                    @if ($application->program)
                                        <p class="text-gray-900">{{ $application->program->name }}</p>
                                    @else
                                        <p class="text-gray-900">Not Specified</p>
                                    @endif
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Department</label>
                                    <p class="text-gray-900">Computer Science</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Degree
                                        Level</label>
                                    <span class="bg-white px-2 py-1 rounded-full border text-sm font-medium">
                                        @if ($application->program)
                                            {{ $application->program->degree_level }}
                                        @else
                                            Not Specified
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Start
                                        Term</label>
                                    <p class="text-gray-900">{{ $application->start_term ?? 'Not Specified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight">Academic Background</h3>
                        </div>
                        <div class="px-6 pb-6 ">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Previous
                                        Institution</label>
                                    <p class="text-gray-900">{{ $application->previous_institution ?? 'Not Specified' }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Degree
                                        Earned</label>
                                    <p class="text-gray-900">{{ $application->degree_earned ?? 'Not Specified' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">GPA</label>
                                    <p class="text-gray-900 font-semibold">{{ $application->gpa ?? 'Not Specified' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">English
                                        Test</label>
                                    <p class="text-gray-900">
                                        {{ ($application->english_test_type ?? 'Not Specified') . ': ' . ($application->english_test_score ?? 'Not Specified') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-file-text h-5 w-5">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                    <path d="M10 9H8"></path>
                                    <path d="M16 13H8"></path>
                                    <path d="M16 17H8"></path>
                                </svg>
                                <span>Statement of Purpose</span>
                            </h3>
                        </div>
                        <div class="px-6 pb-6 ">
                            <p class="text-gray-700 leading-relaxed text-center">
                                {{ $application->statement_of_purpose ?? 'No statement provided.' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar h-5 w-5">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <span>Timeline</span>
                            </h3>
                        </div>
                        <div class="px-6 pb-6 ">
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
                                    <div class="flex-1 text-center">
                                        <p class="text-sm font-medium text-gray-900">Application Submitted</p>
                                        <p class="text-xs text-gray-500">
                                            @if ($application->submitted_at)
                                                {{ $application->submitted_at->format('Y/m/d') }}</p>
                                            @else
                                                Not Submitted Yet
                                            @endif
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="mr-3 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-check-big h-5 w-5 text-yellow-500">
                                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                            <path d="m9 11 3 3L22 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 text-center">
                                        <p id="timeline-status-badge"
                                            class="current-status-display text-sm font-medium text-gray-900 uppercase">
                                            {{ $status }}
                                        </p>
                                        <p class="text-xs text-gray-500">Current Status</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-5 w-5">
                                    <path
                                        d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                    </path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>Address</span>
                            </h3>
                        </div>
                        <div class="p-6 text-center">
                            <div>
                                <label
                                    class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-sm font-medium text-gray-500">Permanent
                                    Address</label>
                                <p class="text-gray-900">{{ $application->permanent_street }}</p>
                                <p class="text-gray-900">
                                    {{ ($application->permanent_city ?? 'City Not Specified') . ', ' . ($application->permanent_state ?? 'State Not Specified') }}
                                </p>
                                <p class="text-gray-900">
                                    @if ($application->permanent_country)
                                        @foreach (config('countries') as $code => $name)
                                            <p class="text-gray-900">
                                                {{ $application->permanent_country == $code ? $name : '' }}</p>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm border">
                        <div class="px-6 py-6">
                            <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-message-square h-5 w-5">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <span>Staff Comments</span>
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div id="staff-notes">
                                @if ($staffNotes->isEmpty())
                                    <p class="text-sm text-gray-500 p-3">No comments yet. Add your comments below.</p>
                                @else
                                    @foreach ($staffNotes as $note)
                                        <div class="bg-gray-50 rounded-xl p-4 mb-4">
                                            <p class="text-sm text-gray-700 mb-2">{{ $note->note }}</p>
                                            <div class="flex justify-between text-xs text-gray-500">
                                                <p>{{ $application->user->first_name }}</p>
                                                <p>{{ $note->created_at->format('m/d/Y') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-4">
                                <form
                                    hx-post="{{ route('admin.applications.notes', ['application_id' => $application->id]) }}"
                                    hx-select="#staff-notes" hx-target="#staff-notes" hx-swap="innerHTML"
                                    hx-on::after-request="if(event.detail.successful) this.reset()">
                                    @csrf
                                    <textarea name="note" placeholder="Enter comment about this application..."
                                        class="w-full p-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        rows="3" required></textarea>

                                    <button type="submit"
                                        class="mt-2 inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background 
                                        transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring 
                                        focus-visible:ring-offset-2 disabled:pointer-events-none 
                                        disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 
                                        bg-blue-500 text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 w-full text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-save h-4 w-4 mr-2">
                                            <path
                                                d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z">
                                            </path>
                                            <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path>
                                            <path d="M7 3v4a1 1 0 0 0 1 1h7"></path>
                                        </svg>
                                        Add Comment
                                    </button>
                                </form>
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
                    const timelineStatus = document.getElementById('timeline-status-badge');
                    const newStatus = response.status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                    const statusClasses = {
                        'rejected': 'bg-red-100 text-red-800 hover:bg-red-200',
                        'under_review': 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200',
                        'accepted': 'bg-green-100 text-green-800 hover:bg-green-200'
                    };

                    Object.values(statusClasses).forEach(cls => {
                        statusBadge.classList.remove(...cls.split(' '));
                    });

                    const newStatusClass = statusClasses[response.status] || 'bg-gray-100 text-gray-800';
                    statusBadge.classList.add(...newStatusClass.split(' '));
                    statusBadge.textContent = newStatus;
                    timelineStatus.textContent = newStatus;

                    const currentStatusDisplay = document.getElementById('current-status-display');
                    if (currentStatusDisplay) {
                        currentStatusDisplay.classList.add(...newStatusClass.split(' '));
                        currentStatusDisplay.textContent = newStatus;
                    }

                    if (response.status === 'accepted') {
                        const updateButton = document.getElementById('update-status-button');
                        if (updateButton) {
                            updateButton.disabled = true;
                            updateButton.textContent = 'Status Locked';
                            updateButton.classList.add('bg-gray-100 text-gray-400 cursor-not-allowed');
                        }
                    }
                }
            }
        }
    </script>
@endsection
