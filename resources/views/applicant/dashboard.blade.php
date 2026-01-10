@extends('layouts.app')

@section('title', 'Dashboard - ' . config('app.name'))

@section('content')
<div class="py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ __('applicant/dashboard.welcome_back') }}, {{ $user->first_name }} {{ $user->last_name }}</h1>
            <p class="mt-2 text-sm sm:text-base text-gray-600">{{ __('applicant/dashboard.track_your_application') }}</p>
        </div>

        <!-- Current Application Period Alert -->
        @if($currentPeriod)
        <div class="mb-4 sm:mb-6 bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4">
            <div class="flex items-start sm:items-center">
                <svg class="h-5 w-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5 sm:mt-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 6.5a2 2 0 002 2.5h6a2 2 0 002-2.5L16 7"></path>
                </svg>
                <div class="text-sm sm:text-base text-blue-800">
                    {{ __('applicant/dashboard.current_application_active', ['name' => $currentPeriod->name]) }}
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-4 sm:gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-4 sm:space-y-6">
                <!-- Application Status Card -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 sm:p-6 pb-3 sm:pb-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 sm:h-10 sm:w-10 text-blue-600 bg-blue-100 p-1.5 rounded-lg mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h2 class="text-lg sm:text-xl font-semibold text-gray-900">{{ __('applicant/dashboard.application_overview') }}</h2>
                        </div>
                    </div>
                    <div class="p-4 sm:p-6 pt-3 sm:pt-4">
                        @if($application)
                            <!-- Submitted Application -->
                            <div class="space-y-3 sm:space-y-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-0">
                                    <div>
                                        <h2 class="text-base sm:text-lg font-medium text-gray-900">{{ $selectedProgram->name ?? __('applicant/dashboard.program_choice') }}</h2>
                                        <p class="text-xs sm:text-sm text-gray-500">{{ __('applicant/dashboard.application_id')}} {{ $application->id }}</p>
                                    </div>
                                    @php $statusData = $application->getStatusData() @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusData['color'] }}  {{ $statusData['bg'] }} self-start sm:self-auto">
                                        {{ $statusData['label'] }}
                                    </span>
                                </div>

                                <div class="space-y-2 text-xs sm:text-sm">
                                    <div class="flex justify-between">
                                        <span>{{ __('applicant/dashboard.submitted_on') }}</span>
                                        <span class="text-right">{{ $application->submitted_at ? $application->submitted_at->format('F j, Y') : __('applicant/dashboard.not_submitted_yet') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>{{ __('applicant/dashboard.last_updated') }}</span>
                                        <span class="text-right">{{ $application->updated_at->format('F j, Y') }}</span>
                                    </div>
                                </div>

                                <div class="pt-3 sm:pt-4 border-t">
                                    <a href="{{ route('applicant.application') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-xs sm:text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        {{ __('applicant/dashboard.view_application_details') }}
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- No Application or Draft -->
                            <div class="text-center p-4 sm:p-6">
                                <div class="mx-auto flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-blue-100">
                                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-3 sm:mt-4 text-lg sm:text-xl font-medium text-gray-900">{{ __('applicant/dashboard.start_your_application') }}</h3>
                                <p class="text-slate-600 text-sm sm:text-base mb-6 sm:mb-8 max-w-md mx-auto mt-2">{{ __('applicant/dashboard.start_application_desc') }}</p>
                                <div class="mt-4 sm:mt-6">
                                    <a href="{{ route('applicant.application') }}">
                                        <button class="bg-blue-500 hover:bg-blue-500/90 inline-flex items-center text-white justify-center gap-2 whitespace-nowrap rounded-lg text-xs sm:text-sm font-medium transition-colors h-9 sm:h-10 px-3 sm:px-4 py-2">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            {{ __('applicant/dashboard.start_application') }}
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
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
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center mb-3 sm:mb-4">
                            <svg class="h-5 w-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-base sm:text-lg font-medium text-gray-900">{{ __('applicant/dashboard.application_in_progress') }}</h3>
                        </div>

                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <div class="flex justify-between text-xs sm:text-sm mb-2">
                                    <span>{{ __('applicant/dashboard.progress') }}</span>
                                    <span>{{ round($progress) }}% complete</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs sm:text-sm">
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full flex-shrink-0 {{ $application->nationality ? 'bg-green-500' : 'bg-gray-300' }}"></div>
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
                                    <div class="h-2 w-2 rounded-full flex-shrink-0 {{ $hasAddressInfo ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.contact_info')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full flex-shrink-0 {{ $application->previous_institution ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.academic_background')}}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full flex-shrink-0 {{ $application->program_id ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                                    <span>{{ __('applicant/dashboard.program_choice')}}</span>
                                </div>
                            </div>

                            <div class="pt-3 sm:pt-4 border-t">
                                <a href="{{ route('applicant.application') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('applicant/dashboard.continue_application') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 sm:p-6 pb-3 sm:pb-4 border-b border-gray-100">
                        <h3 class="text-lg sm:text-xl font-medium mb-2 text-gray-900">{{ __('applicant/dashboard.recent_activity') }}</h3>
                    </div>
                    <div class="p-4 sm:p-6 pt-3 sm:pt-4">
                        <div class="space-y-3 sm:space-y-4">
                            @if($application && $application->isSubmitted())
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-medium text-gray-900">{{ __('applicant/dashboard.application_submitted')}}</p>
                                        <p class="text-xs sm:text-sm text-gray-500">{{ $application->submitted_at ? $application->submitted_at->format('F j, Y') : __('applicant/dashboard.not_submitted_yet') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-medium text-gray-900">{{ __('applicant/dashboard.under_review')}}</p>
                                        <p class="text-xs sm:text-sm text-gray-500">{{ __('applicant/dashboard.review_note')}}</p>
                                    </div>
                                </div>
                                @php
                                    $statusData = $application->getStatusData();
                                @endphp
                                @if(in_array($application->status, ['accepted', 'rejected', 'require_resubmit']))
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-5 w-5 {{ $statusData['svg_color'] }}"
                                            >
                                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                                <path d="m9 11 3 3L22 4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs sm:text-sm font-medium text-gray-900">
                                                @if($application->status === 'accepted')
                                                    {{ __('applicant/dashboard.accepted') }}
                                                @elseif($application->status === 'rejected')
                                                    {{ __('applicant/dashboard.rejected') }}
                                                @elseif($application->status === 'require_resubmit')
                                                    {{ __('applicant/dashboard.require_resubmit') }}
                                                @endif
                                            </p>
                                            <p class="text-xs sm:text-sm text-gray-500">
                                                {{ $application->updated_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <svg class="h-6 w-6 sm:h-8 sm:w-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="text-slate-500 font-medium text-sm sm:text-base">{{ __('applicant/dashboard.no_recent_activity') }}</p>
                                    <p class="text-gray-400 text-xs sm:text-sm">{{ __('applicant/dashboard.no_recent_activity_desc') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-4 sm:space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border hover:shadow-md transition-shadow duration-200">
                    <div class="p-4 sm:p-6 border-b border-gray-100">
                        <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-1">{{ __('applicant/dashboard.quick_actions')}}</h3>
                    </div>
                    <div class="p-4 sm:p-6">
                        <div class="space-y-3">
                            <a href="{{ route('applicant.application') }}" class="w-full inline-flex items-center justify-start px-4 py-2 border shadow-sm text-xs sm:text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-3 sm:mr-5 flex-shrink-0">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                    <path d="M10 9H8"></path><path d="M16 13H8"></path>
                                    <path d="M16 17H8"></path>
                                </svg>
                                {{ $application && $application->isSubmitted() ? __('applicant/dashboard.view_application') : __('applicant/dashboard.start_application') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Application Period -->
                @if($currentPeriod)
                <div class="bg-white shadow-sm rounded-lg sm:rounded-2xl">
                    <div>
                        <div class="border-b border-gray-200 py-3 sm:py-4">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-900 mb-2 sm:mb-4 text-center">{{ __('applicant/dashboard.application_period')}}</h3>
                        </div>
                        <div class="p-4 sm:p-6">
                            <div class="mb-3 sm:mb-4">
                                <h4 class="font-bold text-gray-900 text-sm sm:text-base">{{ $currentPeriod->name }}</h4>
                                <span class="text-xs sm:text-sm text-gray-600">{{ __('applicant/dashboard.currently_active')}}</span>
                            </div>
                            <div class="space-y-1 text-xs sm:text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">{{ __('applicant/dashboard.start_date')}}</span>
                                    <span>{{ \Carbon\Carbon::parse($currentPeriod->start_date)->format('m/d/Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">{{ __('applicant/dashboard.end_date')}}</span>
                                    <span>{{ \Carbon\Carbon::parse($currentPeriod->end_date)->format('m/d/Y') }}</span>
                                </div>
                            </div>
                            <span class="mt-3 sm:mt-4 inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                                {{ __('applicant/dashboard.active')}}
                            </span>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Help & Support -->
                <div class="bg-gradient-to-br from-blue-50 to-slate-50 rounded-lg sm:rounded-xl hover:shadow-md transition-shadow duration-200 shadow-sm border border-blue-200">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-medium text-blue-900 mb-6 sm:mb-12">{{ __('applicant/dashboard.need_help')}}</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <h4 class="font-semibold text-blue-900 mb-2 text-sm sm:text-base">{{ __('applicant/dashboard.application_support')}}</h4>
                                <p class="text-xs sm:text-sm text-blue-700">{{ __('applicant/dashboard.application_support_desc')}}</p>
                            </div>
                            <div class="space-y-2 sm:space-y-3">
                                <a href="https://tsuos.uz/en/admission-for-international-students-2025/" target="_blank" class="w-full inline-flex justify-center items-center gap-2 px-3 sm:px-4 py-2 h-9 sm:h-10 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-600/90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-xs sm:text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 flex-shrink-0">
                                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                    </svg>
                                    <span class="truncate">{{ __('applicant/dashboard.contact_support')}}</span>
                                </a>
                                <a href="https://tsuos.uz/en/admission-for-international-students-2025/" target="_blank" class="w-full inline-flex justify-center items-center gap-2 px-3 sm:px-4 py-2 h-9 sm:h-10 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-600/90 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors text-xs sm:text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 flex-shrink-0">
                                        <path d="M12 7v14"></path>
                                        <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                                    </svg>
                                    <span class="truncate">{{ __('applicant/dashboard.view_faq')}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
