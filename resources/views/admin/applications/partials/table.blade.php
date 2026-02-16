<!-- Applications Table -->
<div class="bg-white shadow-sm rounded-2xl">
    <div class="px-6 py-4">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <h1 class="ml-1 mt-0.5 text-2xl font-bold text-gray-900">{{ __('admin/index.table_title', ['count' => $applications->total()]) }}</h1>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_applicant') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_level') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_program') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_period') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_country') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_submitted') }}</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_status') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500 tracking-wider">{{ __('admin/index.th_actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($applications as $application)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 text-left">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $application->user->first_name .' '. $application->user->last_name}}</div>
                                <div class="text-sm text-gray-500">{{ $application->user->email }}</div>
                                <div class="text-xs text-gray-500">{{ __('admin/index.application_id') }} {{ $application->id }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-gray-100 text-foreground capitalize">
                                {{ $application->level ?? __('admin/index.not_specified') }}
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $application->program->name ??__('admin/index.not_selected') }}
                            </div>
                            @if($application->program)
                                <div class="text-sm text-gray-500">{{ $application->program->department }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $application->applicationPeriod->name ??__('admin/index.not_selected') }}
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if ($application->nationality)
                                @foreach (config('countries') as $code => $name)
                                    <p class="text-gray-900">{{ $application->nationality == $code ? $name : '' }}
                                    </p>
                                @endforeach
                            @else
                                <p class="text-gray-900">{{ __('admin/index.not_specified') }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $application->submitted_at ? $application->submitted_at->format('M j, Y') :$application->created_at->format('M j, Y') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @php $statusData = $application->getStatusData() @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusData['color'] }}  {{ $statusData['bg'] }}">
                                {{ $statusData['label'] }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-left text-sm font-medium">
                            <div class="flex items-center justify-start">
                                <a href="{{ route('admin.applications.show', $application->id) }}" title="{{ __('admin/index.view') }}">
                                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" aria-label="{{ __('admin/index.view') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye h-4 w-4">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                </a>
                                <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" title="{{ __('admin/index.more') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis h-4 w-4">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            <div class="flex flex-col items-center justify-center py-8">
                                <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 text-sm">{{ __('admin/index.no_results') }}</p>
                                <p class="text-gray-400 text-xs mt-1">{{ __('admin/index.try_adjusting') }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($applications->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            {{ __('admin/index.pagination_previous') }}
                        </span>
                    @else
                        <a href="{{ $applications->appends(request()->query())->previousPageUrl() }}" 
                           class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                           hx-get="{{ $applications->appends(request()->query())->previousPageUrl() }}"
                           hx-target="#applications-container"
                           hx-push-url="true">
                            {{ __('admin/index.pagination_previous') }}
                        </a>
                    @endif
                    
                    @if ($applications->hasMorePages())
                        <a href="{{ $applications->appends(request()->query())->nextPageUrl() }}" 
                           class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50"
                           hx-get="{{ $applications->appends(request()->query())->nextPageUrl() }}"
                           hx-target="#applications-container"
                           hx-push-url="true">
                            {{ __('admin/index.pagination_next') }}
                        </a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                            {{ __('admin/index.pagination_next') }}
                        </span>
                    @endif
                </div>
                
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            {{ __('admin/index.pagination_showing') }}
                            <span class="font-medium">{{ $applications->firstItem() }}</span>
                            {{ __('admin/index.pagination_to') }}
                            <span class="font-medium">{{ $applications->lastItem() }}</span>
                            {{ __('admin/index.pagination_of') }}
                            <span class="font-medium">{{ $applications->total() }}</span>
                            {{ __('admin/index.pagination_results') }}
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            @if ($applications->onFirstPage())
                                <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-default">
                                    <span class="sr-only">{{ __('admin/index.pagination_previous') }}</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @else
                                <a href="{{ $applications->appends(request()->query())->previousPageUrl() }}" 
                                   class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                   hx-get="{{ $applications->appends(request()->query())->previousPageUrl() }}"
                                   hx-target="#applications-container"
                                   hx-push-url="true">
                                    <span class="sr-only">{{ __('admin/index.pagination_previous') }}</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                            
                            @foreach ($applications->appends(request()->query())->getUrlRange(1, $applications->lastPage()) as $page => $url)
                                @if ($page == $applications->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                       class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50"
                                       hx-get="{{ $url }}"
                                       hx-target="#applications-container"
                                       hx-push-url="true">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
            
                            @if ($applications->hasMorePages())
                                <a href="{{ $applications->appends(request()->query())->nextPageUrl() }}" 
                                   class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                                   hx-get="{{ $applications->appends(request()->query())->nextPageUrl() }}"
                                   hx-target="#applications-container"
                                   hx-push-url="true">
                                    <span class="sr-only">{{ __('admin/index.pagination_next') }}</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-default">
                                    <span class="sr-only">{{ __('admin/index.pagination_next') }}</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>