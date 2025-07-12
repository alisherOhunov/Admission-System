@extends('layouts.app')

@section('title', 'Admin Dashboard - EduAdmit')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('admin/dashboard.page_title') }}</h1>
            <p class="mt-2 text-gray-600">
                {{ __('admin/dashboard.page_welcome', ['name' => auth()->user()->first_name . ' ' . auth()->user()->last_name]) }}
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1 text-center">
                            <p class="text-sm font-medium text-gray-600">{{ __('admin/dashboard.total_applications') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_applications'] }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-8 w-8 text-university-600">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                            <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                            <path d="M10 9H8"></path>
                            <path d="M16 13H8"></path>
                            <path d="M16 17H8"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1 text-center">
                            <p class="text-sm font-medium text-gray-600">{{ __('admin/dashboard.new_applications') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['new_applications'] }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-8 w-8 text-green-600">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                            <polyline points="16 7 22 7 22 13"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1 text-center">
                            <p class="text-sm font-medium text-gray-600">{{ __('admin/dashboard.under_review') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['under_review'] }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-8 w-8 text-yellow-600">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-1 text-center">
                            <p class="text-sm font-medium text-gray-600">{{ __('admin/dashboard.accepted') }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['accepted'] }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big h-8 w-8 text-green-600">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                            <path d="m9 11 3 3L22 4"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Recent Applications -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-2xl">
                    <div class="p-6 text-center">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('admin/dashboard.recent_applications_title') }}</h3>
                        <div class="space-y-4">
                            @forelse($recentApplications as $application)
                                <div class="flex items-center justify-between p-4 border rounded-2xl text-left">
                                    <div>
                                        <h4 class="font-medium text-gray-900">
                                            {{ $application->user->first_name . ' ' . $application->user->last_name }}
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $application->program->name ?? __('admin/dashboard.program_not_selected') }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            ID: {{ $application->id }}
                                            @if($application->submitted_at)
                                                • {{ __('admin/dashboard.submitted_at', ['date' => $application->submitted_at->format('M j, Y')]) }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @php $statusData = $application->getStatusData() @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusData['color'] }}">
                                            {{ $statusData['label'] }}
                                        </span>
                                        <a href="{{ route('admin.applications.show', $application->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                                            {{ __('admin/dashboard.view') }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-sm text-gray-500">{{ __('admin/dashboard.no_applications') }}</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                                {{ __('admin/dashboard.view_all_applications') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6 text-center">
                <!-- Quick Actions -->
                <div class="bg-white shadow-sm rounded-2xl">
                    <div class="p-6">
                        <h3 class="text-2xl font-medium text-gray-900 mb-4">{{ __('admin/dashboard.quick_actions') }}</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.applications.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700">
                                {{ __('admin/dashboard.manage_applications') }}
                            </a>
                            <button class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                                {{ __('admin/dashboard.view_reports') }}
                            </button>
                            <button class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                                {{ __('admin/dashboard.system_settings') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Application Status Breakdown -->
                <div class="bg-white shadow-sm rounded-2xl">
                    <div class="p-6">
                        <h3 class="text-2xl font-medium text-gray-900 mb-4">{{ __('admin/dashboard.application_status') }}</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ __('admin/dashboard.status_submitted') }}</span>
                                <span class="font-medium">{{ $stats['submitted'] + $stats['re_submitted'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ __('admin/dashboard.status_under_review') }}</span>
                                <span class="font-medium">{{ $stats['under_review'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ __('admin/dashboard.status_accepted') }}</span>
                                <span class="font-medium text-green-600">{{ $stats['accepted'] }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ __('admin/dashboard.status_rejected') }}</span>
                                <span class="font-medium text-red-600">{{ $stats['rejected'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
