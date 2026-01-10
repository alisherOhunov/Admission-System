@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-3 sm:px-4 py-4 sm:py-6 lg:py-8" x-data="{ open: false }">
    <h1 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Programs</h1>

    <div class="mb-4 sm:mb-6">
        <button 
            @click="open = !open" 
            class="w-full sm:w-auto px-3 sm:px-4 py-2 text-blue font-medium rounded-md shadow hover:bg-gray-200 text-sm sm:text-base">
            + Add Program
        </button>
    </div>

    <div x-show="open" x-transition class="mb-4 sm:mb-6 bg-white shadow rounded-lg p-4 sm:p-6 border border-gray-200">
        <form method="POST" action="{{ route('admin.applications.settings.programs.store') }}" class="space-y-3 sm:space-y-4">
            @csrf

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">Program Name</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                    focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" required>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">Degree Level</label>
                <select name="degree_level"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                    focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" required>
                    <option value="bachelors">Bachelor's</option>
                    <option value="masters">Master's</option>
                </select>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700">Code</label>
                <input type="text" name="code" value="{{ old('code') }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                    focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" required>
            </div>

            {{-- Optional fields kept hidden or nullable --}}
            <input type="hidden" name="department">
            <input type="hidden" name="description">
            <input type="hidden" name="requirements">

            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3">
                <button type="button" @click="open = false" 
                    class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow 
                    hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Cancel
                </button>

                <button type="submit"
                    class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow 
                    hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save
                </button>
            </div>
        </form>
    </div>

    {{-- Desktop Programs Table --}}
    <div class="hidden md:block mt-6 sm:mt-8 bg-white shadow-sm rounded-xl sm:rounded-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Degree Level</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Code</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-500">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($programs as $program)
                <tr class="hover:bg-gray-50 transition-colors duration-150 text-left">
                    <td class="px-6 py-4 ">
                        <div class="text-sm font-medium text-gray-900">{{ $program->name }}</div>
                        <div class="text-xs text-gray-500">#{{ $program->id }}</div>
                    </td>

                    <td class="px-4 py-4  text-sm text-gray-900">
                        {{ ucfirst($program->degree_level) }}
                    </td>

                    <td class="px-4 py-4  text-sm text-gray-900">
                        {{ $program->code }}
                    </td>

                    <td class="px-4 py-4 ">
                        @if($program->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full 
                                text-xs font-medium bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full 
                                text-xs font-medium bg-gray-200 text-gray-700">Inactive</span>
                        @endif
                    </td>

                    <td class="px-4 py-4 text-sm font-medium">
                        <div class="flex justify-center items-center space-x-4">
                            
                            {{-- ACTIVE PROGRAM → only Deactivate --}}
                            @if($program->is_active)
                                <form action="{{ route('admin.applications.settings.programs.de-activate', $program->id) }}" 
                                    method="POST">
                                    @csrf
                                    <button type="submit" name="deactivate" value="1"
                                        class="px-3 py-1 bg-red-600 text-white text-xs rounded-md hover:bg-red-700">
                                        Deactivate
                                    </button>
                                </form>

                            @else

                                <a href="{{ route('admin.applications.settings.programs.edit', $program->id) }}" 
                                    class="px-3 py-1 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('admin.applications.settings.programs.activate', $program->id) }}" 
                                    method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 bg-green-500 text-white text-xs rounded-md hover:bg-green-600">
                                        Activate
                                    </button>
                                </form>

                                <form action="{{ route('admin.applications.settings.programs.destroy', $program->id) }}" 
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this program?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-xs rounded-md hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>

                            @endif
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                        No programs available.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Mobile Programs Card View --}}
    <div class="md:hidden mt-6 space-y-4">
        @forelse($programs as $program)
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold text-gray-900">{{ $program->name }}</h3>
                        <p class="text-xs text-gray-500">#{{ $program->id }}</p>
                    </div>
                    @if($program->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2 flex-shrink-0">Active</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700 ml-2 flex-shrink-0">Inactive</span>
                    @endif
                </div>

                <div class="space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Degree Level:</span>
                        <span class="text-gray-900 font-medium">{{ ucfirst($program->degree_level) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Code:</span>
                        <span class="text-gray-900 font-medium">{{ $program->code }}</span>
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    @if($program->is_active)
                        {{-- Active program - only show Deactivate --}}
                        <form action="{{ route('admin.applications.settings.programs.de-activate', $program->id) }}" 
                            method="POST">
                            @csrf
                            <button type="submit" name="deactivate" value="1"
                                class="w-full px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                                Deactivate
                            </button>
                        </form>
                    @else
                        {{-- Inactive program - show Edit, Activate, Delete --}}
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('admin.applications.settings.programs.edit', $program->id) }}" 
                                class="w-full text-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('admin.applications.settings.programs.activate', $program->id) }}" 
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full px-3 py-2 bg-green-500 text-white text-sm font-medium rounded-md hover:bg-green-600">
                                    Activate
                                </button>
                            </form>

                            <form action="{{ route('admin.applications.settings.programs.destroy', $program->id) }}" 
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this program?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6 text-center">
                <p class="text-sm text-gray-500">No programs available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
