@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Program</h1>
            <p class="mt-2 text-sm text-gray-600">Update the program details below.</p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <form action="{{ route('admin.applications.settings.programs.update', $program->id) }}" 
                  method="POST" 
                  class="space-y-4">
                  
                @csrf
                @method('PUT')

                {{-- Program Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Program Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $program->name) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Degree Level --}}
                <div>
                    <label for="degree_level" class="block text-sm font-medium text-gray-700">Degree Level</label>
                    <select id="degree_level" 
                            name="degree_level" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                   focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                            required>

                        <option value="bachelors" {{ old('degree_level', $program->degree_level) === 'bachelors' ? 'selected' : '' }}>
                            {{ __('degrees.bachelors') }}
                        </option>

                        <option value="masters" {{ old('degree_level', $program->degree_level) === 'masters' ? 'selected' : '' }}>
                            {{ __('degrees.masters') }}
                        </option>

                    </select>

                    @error('degree_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Program Code --}}
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Program Code</label>
                    <input type="text" 
                           id="code" 
                           name="code" 
                           value="{{ old('code', $program->code) }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                           required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.applications.settings.programs') }}" 
                        class="px-4 py-2 bg-red-600 text-white font-medium rounded-md shadow 
                               hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                        Cancel
                    </a>

                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow 
                               hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Update Program
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
