@extends('layouts.app')

@section('title', 'Manage Applications - EduAdmit')

@section('content')
<div class="py-8 text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Applications</h1>
            <p class="mt-2 text-gray-600">Manage and Review student applications</p>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white rounded-2xl shadow-sm border mb-6">
            <div class="p-6">
                <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                    <div class="flex flex-1 items-center space-x-4 mr-4">
                        <!-- Search -->
                        <div class="relative flex-1 max-w-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search applications..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                   hx-get="{{ route('admin.applications.index') }}"
                                   hx-trigger="keyup changed delay:300ms, search"
                                   hx-target="#applications-container"
                                   hx-include="[name='status'], [name='level']"
                                   hx-indicator="#loading-indicator"
                                   hx-swap="innerHTML">
                        </div>

                        <!-- Status Filter -->
                        <select name="status" 
                                class="block w-36 px-3 py-2 border border-gray-300 bg-white rounded-lg shadow-sm focus:ring-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                hx-get="{{ route('admin.applications.index') }}"
                                hx-trigger="change"
                                hx-target="#applications-container"
                                hx-include="[name='search'], [name='level']"
                                hx-indicator="#loading-indicator"
                                hx-swap="innerHTML">
                            <option value="">All Status</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>

                        <!-- Level Filter -->
                        <select name="level" 
                                class="block w-36 px-3 py-2 border border-gray-300 bg-white rounded-lg shadow-sm focus:ring-1 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                hx-get="{{ route('admin.applications.index') }}"
                                hx-trigger="change"
                                hx-target="#applications-container"
                                hx-include="[name='search'], [name='status']"
                                hx-indicator="#loading-indicator"
                                hx-swap="innerHTML">
                            <option value="">All Levels</option>
                            <option value="undergraduate" {{ request('level') == 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                            <option value="graduate" {{ request('level') == 'graduate' ? 'selected' : '' }}>Graduate</option>
                        </select>

                        <!-- Loading Indicator -->
                        <div id="loading-indicator" class="htmx-indicator">
                            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter h-4 w-4 mr-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            More Filters
                        </button>
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download h-4 w-4 mr-2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" x2="12" y1="15" y2="3"></line>
                            </svg>
                            Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Container -->
        <div id="applications-container">
            @include('admin.applications.partials.table', ['applications' => $applications])
        </div>
    </div>
</div>

<style>
.htmx-indicator {
    display: none;
}
.htmx-request .htmx-indicator {
    display: block;
}
.htmx-request.htmx-indicator {
    display: block;
}
</style>
@endsection