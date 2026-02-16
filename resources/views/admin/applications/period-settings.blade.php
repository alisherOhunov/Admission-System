@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8" x-data="{ open: false }">
    <h1 class="text-2xl font-bold mb-6">Application Periods</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-6">
        <button 
            @click="open = !open" 
            class="px-4 py-2 text-blue font-medium rounded-md shadow hover:bg-gray-200">
            + Add Period
        </button>
    </div>

    <div x-show="open" x-cloak x-transition class="mb-6 bg-white shadow rounded-lg p-6 border border-gray-200">
        <form method="POST" action="{{ route('admin.applications.settings.periods.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                    required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" @click="open = false" 
                    class="px-4 py-2 bg-red-600 text-white font-medium rounded-md shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Cancel
                </button>

                <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>

    <div class="mt-8 bg-white shadow-sm rounded-2xl">
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
</div>
@endsection
