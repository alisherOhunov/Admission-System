@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-3 sm:px-4 py-4 sm:py-6 lg:py-8" x-data="{ open: false }">
    <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Application Periods</h1>

    <div class="mb-4 sm:mb-6">
        <button 
            @click="open = !open" 
            class="w-full sm:w-auto px-3 sm:px-4 py-2 text-blue font-medium rounded-md shadow hover:bg-gray-200 text-sm sm:text-base">
            + Add Period
        </button>
    </div>

    <div x-show="open" x-transition class="mb-4 sm:mb-6 bg-white shadow rounded-lg p-4 sm:p-6 border border-gray-200">
        <form method="POST" action="{{ route('admin.applications.settings.periods.store') }}" class="space-y-3 sm:space-y-4">
            @csrf

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                    required>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                    required>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                    required>
            </div>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3">
                <button type="button" @click="open = false" 
                    class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Cancel
                </button>

                <button type="submit" 
                    class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block mt-6 sm:mt-8 bg-white shadow-sm rounded-xl sm:rounded-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">Start Date</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">End Date</th>
                    <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                    <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($periods as $period)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 text-left">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $period->name ?? 'Unnamed Period' }}</div>
                            <div class="text-xs text-gray-500">#{{ $period->id }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($period->start_date)->format('M j, Y') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($period->end_date)->format('M j, Y') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($period->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">Inactive</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap text-sm font-medium">
                            <div class="flex justify-center items-center">
                                @if(!$period->is_active)
                                    <div class="flex space-x-4">
                                        <a href="{{ route('admin.applications.settings.periods.edit', $period->id) }}" 
                                        class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.applications.settings.periods.activate', $period->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700">
                                                Activate
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.applications.settings.periods.destroy', $period->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this period?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs rounded-md hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-sm text-green-400">Current Active</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No periods available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden mt-6 space-y-4">
        @forelse($periods as $period)
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold text-gray-900 truncate">{{ $period->name ?? 'Unnamed Period' }}</h3>
                        <p class="text-xs text-gray-500">#{{ $period->id }}</p>
                    </div>
                    @if($period->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2 flex-shrink-0">Active</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700 ml-2 flex-shrink-0">Inactive</span>
                    @endif
                </div>

                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Start Date:</span>
                        <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($period->start_date)->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">End Date:</span>
                        <span class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($period->end_date)->format('M j, Y') }}</span>
                    </div>
                </div>

                @if(!$period->is_active)
                    <div class="flex flex-col gap-2 pt-3 border-t border-gray-100">
                        <a href="{{ route('admin.applications.settings.periods.edit', $period->id) }}" 
                            class="w-full text-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="{{ route('admin.applications.settings.periods.activate', $period->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                                Activate
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.applications.settings.periods.destroy', $period->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this period?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                @else
                    <div class="pt-3 border-t border-gray-100 text-center">
                        <span class="text-sm text-green-600 font-medium">Current Active Period</span>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6 text-center">
                <p class="text-sm text-gray-500">No periods available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
