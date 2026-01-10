@extends('layouts.app')

@section('title', 'Manage Applications - ' . config('app.name'))

@section('content')
<div class="py-4 sm:py-6 lg:py-8">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ __('admin/index.heading')}}</h1>
            <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">{{ __('admin/index.subheading')}}</p>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white rounded-2xl shadow-sm border mb-6">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

                    <!-- LEFT SIDE -->
                    <div class="flex flex-col lg:flex-row flex-1 gap-3 lg:gap-4 lg:items-center lg:mr-4">

                        <!-- Search -->
                        <div class="relative w-full lg:flex-1 lg:max-w-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="{{ __('admin/index.search_placeholder') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-500 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                hx-get="{{ route('admin.applications.index') }}"
                                hx-trigger="keyup changed delay:300ms, search"
                                hx-target="#applications-container"
                                hx-include="[name='status'], [name='level']"
                                hx-indicator="#loading-indicator"
                                hx-swap="innerHTML">
                        </div>

                        <!-- Status -->
                        <select name="status"
                                class="block w-full lg:w-36 px-3 py-2 border border-gray-300 bg-white rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                hx-get="{{ route('admin.applications.index') }}"
                                hx-trigger="change"
                                hx-target="#applications-container"
                                hx-include="[name='search'], [name='level']"
                                hx-indicator="#loading-indicator"
                                hx-swap="innerHTML">
                            <option value="">{{ __('admin/index.status_all')}}</option>
                            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>{{ __('admin/index.status_submitted')}}</option>
                            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>{{ __('admin/index.status_under_review')}}</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>{{ __('admin/index.status_accepted')}}</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('admin/index.status_rejected')}}</option>
                            <option value="require_resubmit" {{ request('status') == 'require_resubmit' ? 'selected' : '' }}>{{ __('admin/index.status_require_resubmit')}}</option>
                            <option value="re_submitted" {{ request('status') == 're_submitted' ? 'selected' : '' }}>{{ __('admin/index.status_re_submitted')}}</option>
                        </select>

                        <!-- Level -->
                        <select name="level"
                                class="block w-full lg:w-36 px-3 py-2 border border-gray-300 bg-white rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                hx-get="{{ route('admin.applications.index') }}"
                                hx-trigger="change"
                                hx-target="#applications-container"
                                hx-include="[name='search'], [name='status']"
                                hx-indicator="#loading-indicator"
                                hx-swap="innerHTML">
                            <option value="">{{ __('admin/index.level_all')}}</option>
                            <option value="masters" {{ request('level') == 'masters' ? 'selected' : '' }}>{{ __('admin/index.level_masters')}}</option>
                            <option value="bachelors" {{ request('level') == 'bachelors' ? 'selected' : '' }}>{{ __('admin/index.level_bachelors')}}</option>
                        </select>

                        <!-- Loader -->
                        <div id="loading-indicator" class="htmx-indicator hidden lg:block">
                            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                        <button type="button"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            {{ __('admin/index.filter_more')}}
                        </button>

                        <button type="button"
                                onclick="exportApplications()"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            {{ __('admin/index.export')}}
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

/* Custom breakpoint for extra small devices */
@media (min-width: 475px) {
    .xs\:flex-row {
        flex-direction: row;
    }
    .xs\:inline {
        display: inline;
    }
    .xs\:hidden {
        display: none;
    }
}
</style>
<script>
function exportApplications() {
    const status = document.querySelector('select[name="status"]')?.value || '';
    const level = document.querySelector('select[name="level"]')?.value || '';
    const search = document.querySelector('input[name="search"]')?.value || '';
    
    const params = new URLSearchParams();
    if (status) params.append('status', status);
    if (level) params.append('level', level);
    if (search) params.append('search', search);
    
    const exportUrl = '{{ route("admin.applications.export") }}' + '?' + params.toString();
    
    window.location.href = exportUrl;
}
</script>
@endsection