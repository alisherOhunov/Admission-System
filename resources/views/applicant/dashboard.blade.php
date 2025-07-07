@extends('layouts.app')

@section('title', 'Dashboard - EduAdmit')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('applicant/dashboard.welcome_back') }}, {{ $user->first_name }} {{ $user->last_name }}</h1>
            <p class="mt-2 text-gray-600">{{ __('applicant/dashboard.track_your_application') }}</p>
        </div>

        <!-- Current Application Period Alert -->
        @if($currentPeriod)
        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 6.5a2 2 0 002 2.5h6a2 2 0 002-2.5L16 7"></path>
                </svg>
                <div class="text-blue-800">
                    {{ __('applicant/dashboard.current_application_active', ['name' => $currentPeriod->name]) }}
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Application Status Card -->
                <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 pb-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <svg class="h-10 w-10 text-blue-600 bg-blue-100 p-1.5 rounded-lg mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900">{{ __('applicant/dashboard.application_overview') }}</h3>
                        </div>
                    </div>
                    <div class="p-6 pt-4">
                        @if($application && $application->isSubmitted())
                            <!-- Submitted Application -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $selectedProgram->name ?? __('dashboard.program_choice') }}</h4>
                                        <p class="text-sm text-gray-500">{{ __('applicant/dashboard.application_id')}} {{ $application->id }}</p>
                                    </div>
                                    @php $statusData = $application->getStatusData() @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusData['color'] }}">
                                        {{ $statusData['label'] }}
                                    </span>
                                </div>

                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span>{{ __('applicant/dashboard.submitted_on') }}</span>
                                        <span>{{ $application->submitted_at->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>{{ __('applicant/dashboard.last_updated') }}</span>
                                        <span>{{ $application->updated_at->format('F j, Y') }}</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t">
                                    <a href="{{ route('applicant.application', ['application_id' => $application->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        {{ __('applicant/dashboard.view_application_details') }}
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- No Application or Draft -->
                            <div class="text-center p-6">
                                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-xl font-medium text-gray-900">{{ __('applicant/dashboard.start_your_application') }}</h3>
                                <p class="text-slate-600 text-md mb-8 max-w-md mx-auto">{{ __('applicant/dashboard.start_application_desc') }}</p>
                                <div class="mt-6">
                                    <a href="{{ route('applicant.application', ['application_id' => $application->id]) }}">
                                        <button class="bg-blue-500 hover:bg-blue-500/90 inline-flex items-center text-white justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium transition-colors h-10 px-4 py-2">
                                            <svg class="lucide lucide-plus h-4 w-4 mr-2" ...></svg>
                                            {{ __('applicant/dashboard.start_application') }}
                                            <svg class="lucide lucide-arrow-right h-4 w-4 ml-2" ...></svg>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Application Progress -->
                @if($application && $application->isDraft() && $progress > 0)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">{{ __('applicant/dashboard.application_in_progress') }}</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-2">
                                    <span>{{ __('applicant/dashboard.progress') }}</span>
                                    <span>{{ round($progress) }}% complete</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->nationality ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.personal_info')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @php
                                        $hasAddressInfo = $application->permanent_country
                                        && $application->permanent_state
                                        && $application->permanent_city
                                        && $application->permanent_postcode
                                        && $application->permanent_street;
                                    @endphp

                                    <div class="h-2 w-2 rounded-full {{ $hasAddressInfo ? 'bg-green-500' : 'bg-gray-300' }}"></div>

                                    <span>{{ __('applicant/dashboard.contact_info')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->previous_institution ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.academic_background')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full {{ $application->program_id ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.program_choice')}}</span>
                                </div>
                            </div>

                            <div class="pt-4 border-t">
                                <a href="{{ route('applicant.application', ['application_id' => $application->id]) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('applicant/dashboard.continue_application') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 pb-4 border-b border-gray-100">
                        <h3 class="text-xl font-medium mb-2 text-gray-900">{{ __('applicant/dashboard.recent_activity') }}</h3>
                    </div>
                    <div class="p-6 pt-4">
                        <div class="space-y-4">
                            @if($application && $application->isSubmitted())
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ __('applicant/dashboard.application_submitted')}}</p>
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
                                        <p class="text-sm font-medium text-gray-900">{{ __('applicant/dashboard.under_review')}}</p>
                                        <p class="text-sm text-gray-500">{{ __('applicant/dashboard.review_note')}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <svg class="h-8 w-8 text-gray-400 mx-auto mb-2" ...></svg>
                                    <p class="text-slate-500 font-medium">{{ __('applicant/dashboard.no_recent_activity') }}</p>
                                    <p class="text-gray-400">{{ __('applicant/dashboard.no_recent_activity_desc') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-xl font-medium text-gray-900 mb-1">{{ __('applicant/dashboard.quick_actions')}}</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('applicant.application', ['application_id' => $application->id]) }}" class="w-full inline-flex items-center justify-start px-4 py-2 border shadow-sm text-sm font-medium rounded-lg text-white bg-blue-500 hover:bg-blue-500/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-4 w-4 mr-5">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                    <path d="M10 9H8"></path><path d="M16 13H8"></path>
                                    <path d="M16 17H8"></path>
                                </svg>
                                {{ $application && $application->isSubmitted() ? __('view_application') : __('dashboard.start_application') }}
                            </a>
                            <button class="w-full inline-flex items-center justify-start px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-white bg-blue-500 hover:bg-blue-500/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload h-4 w-4 mr-5">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" x2="12" y1="3" y2="15"></line>
                                </svg>
                                {{ __('applicant/dashboard.upload_documents')}}
                            </button>
                            <button class="w-full inline-flex items-center justify-start px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-white bg-blue-500 hover:bg-blue-500/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user h-4 w-4 mr-5">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                {{ __('applicant/dashboard.profile_settings')}}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Application Period -->
                @if($currentPeriod)
                <div class="bg-white rounded-xl shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('applicant/dashboard.current_period')}}</h3>
                        <div class="space-y-3">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $currentPeriod->name }}</h4>
                                <p class="text-sm text-gray-500">{{ __('applicant/dashboard.application_period')}}</p>
                            </div>
                            <div class="space-y-1 text-sm">
                                <div class="flex justify-between">
                                    <span>{{ __('applicant/dashboard.start_date')}}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>{{ __('applicant/dashboard.end_date')}}</span>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ __('applicant/dashboard.active')}}
                            </span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Selected Program -->
                @if($selectedProgram)
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('applicant/dashboard.selected_program')}}</h3>
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
                <div class="bg-gradient-to-br from-blue-50 to-slate-50 rounded-xl hover:shadow-md transition-shadow duration-200 shadow-sm border border-blue-200">
                    <div class="p-6">
                        <h3 class="text-xl font-medium text-blue-900 mb-12">{{ __('applicant/dashboard.need_help')}}</h3>
                        <div class="space-y-4">
                            <div>
                                <h4 class="font-semibold text-blue-900 mb-2">{{ __('applicant/dashboard.application_support')}}</h4>
                                <p class="text-sm text-blue-700">{{ __('applicant/dashboard.application_support_desc')}}</p>
                            </div>
                            <div class="space-y-3">
                                <button class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 h-10 bg-blue-500 text-white font-medium rounded-lg shadow-sm hover:bg-blue-500/90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                    {{ __('applicant/dashboard.contact_support')}}
                                </button>
                                <button class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 h-10 bg-blue-500 text-white font-medium rounded-lg shadow-sm hover:bg-blue-500/90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M12 7v14"></path>
                                        <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                                    </svg>
                                    {{ __('applicant/dashboard.view_faq')}}
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
