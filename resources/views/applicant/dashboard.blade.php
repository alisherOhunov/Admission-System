@extends('layouts.app')

@section('title', 'Dashboard - EduAdmit')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ $user->name }}</h1>
            <p class="mt-2 text-gray-600">Track your application progress and manage your documents</p>
        </div>

        <!-- Current Application Period Alert -->
        @if($currentPeriod)
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 6.5a2 2 0 002 2.5h6a2 2 0 002-2.5L16 7"></path>
                </svg>
                <div class="text-blue-800">
                    <strong>{{ $currentPeriod->name }}</strong> application period is currently active. 
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Application Status Card -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Application Status</h3>
                        </div>

                        @if($application && $application->isSubmitted())
                            <!-- Submitted Application -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $selectedProgram->name ?? 'Program Selected' }}</h4>
                                        <p class="text-sm text-gray-500">Application ID: {{ $application->id }}</p>
                                    </div>
                                    @php $statusData = $application->getStatusData() @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusData['color'] }}">
                                        {{ $statusData['label'] }}
                                    </span>
                                </div>

                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>Submitted on</span>
                                        <span>{{ $application->submitted_at->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Last updated</span>
                                        <span>{{ $application->updated_at->format('F j, Y') }}</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t">
                                    <a href="{{ route('applicant.application') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        View Application Details
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- No Application or Draft -->
                            <div class="text-center py-6">
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No application yet</h3>
                                <p class="mt-2 text-sm text-gray-500">Start your application to study abroad</p>
                                <div class="mt-6">
                                    <a href="{{ route('applicant.application') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Start Application
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Application Progress (for draft applications) -->
                @if($application && $application->isDraft() && $progress > 0)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Application in Progress</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span>Progress</span>
                                    <span>{{ round($progress) }}% complete</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->nationality ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>Personal Info</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->permanent_address ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>Contact Info</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->previous_institution ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>Academic Background</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->program_id ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>Program Choice</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t">
                                <a href="{{ route('applicant.application') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Continue Application
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            @if($application && $application->isSubmitted())
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Application submitted</p>
                                        <p class="text-sm text-gray-500">{{ $application->submitted_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Under review</p>
                                        <p class="text-sm text-gray-500">Your application is being reviewed by admission staff</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <svg class="h-8 w-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-500">No recent activity</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('applicant.application') }}" class="w-full inline-flex items-center justify-start px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ $application && $application->isSubmitted() ? 'View Application' : 'Start Application' }}
                            </a>
                            <button class="w-full inline-flex items-center justify-start px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload Documents
                            </button>
                            <button class="w-full inline-flex items-center justify-start px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Application Period -->
                @if($currentPeriod)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Current Period</h3>
                        <div class="space-y-3">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $currentPeriod->name }}</h4>
                                <p class="text-sm text-gray-500">Application Period</p>
                            </div>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span>Start Date:</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>End Date:</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Selected Program -->
                @if($selectedProgram)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Selected Program</h3>
                        <div class="space-y-3">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $selectedProgram->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $selectedProgram->department }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 capitalize">
                                <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                </svg>
                                {{ $selectedProgram->degree_level }}
                            </span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Help & Support -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Need Help?</h3>
                        <div class="space-y-3">
                            <div>
                                <h4 class="font-medium text-gray-900">Application Support</h4>
                                <p class="text-sm text-gray-500">Get help with your application process</p>
                            </div>
                            <div class="space-y-2">
                                <button class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Contact Support
                                </button>
                                <button class="w-full inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View FAQ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
