@extends('layouts.app')

@section('content')
<div class="container mx-auto px-3 sm:px-4 py-4 sm:py-6 lg:py-8">
    <div class="max-w-md mx-auto">
        <div class="mb-4 sm:mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Program</h1>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-gray-600">Update the program details below.</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 border border-gray-200">
            <form action="{{ route('admin.applications.settings.programs.update', $program->id) }}" 
                  method="POST" 
                  class="space-y-3 sm:space-y-4">
                  
                @csrf
                @method('PUT')

                {{-- Program Name --}}
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Program Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $program->name) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                           required>
                    @error('name')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Degree Level --}}
                <div>
                    <label for="degree_level" class="block text-xs sm:text-sm font-medium text-gray-700">Degree Level</label>
                    <select id="degree_level" 
                            name="degree_level" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                            required>

                        <option value="bachelors" {{ old('degree_level', $program->degree_level) === 'bachelors' ? 'selected' : '' }}>
                            Bachelor's
                        </option>

                        <option value="masters" {{ old('degree_level', $program->degree_level) === 'masters' ? 'selected' : '' }}>
                            Master's
                        </option>

                    </select>

                    @error('degree_level')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Program Code --}}
                <div>
                    <label for="code" class="block text-xs sm:text-sm font-medium text-gray-700">Program Code</label>
                    <input type="text" 
                           id="code" 
                           name="code" 
                           value="{{ old('code', $program->code) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2 px-3" 
                           required>
                    @error('code')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:gap-3 pt-3 sm:pt-4">
                    <a href="{{ route('admin.applications.settings.programs') }}" 
                        class="w-full sm:w-auto text-center px-3 sm:px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md shadow 
                               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                        Cancel
                    </a>

                    <button type="submit" 
                        class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow 
                               hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Program
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
