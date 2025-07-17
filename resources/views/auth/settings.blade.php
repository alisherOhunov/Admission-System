@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
            <p class="mt-2 text-gray-600">Manage your account settings and preferences</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8" x-data="updateProfile()">
            <div class="hidden lg:block"></div>
            <!-- Main Content -->
            <div class="col-span-1 lg:col-span-2">
                <!-- Profile Information Tab -->
                <form
                    hx-post="{{ route('profile.update') }}"
                    hx-select="#profile"
                    hx-on::after-request="clearPasswordFields()"
                    @htmx:after-request="clearPasswordFields()">
                    <div id="profile">
                        @csrf
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
                        <div class="tab-content bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Profile Information</h2>
                                <p class="mt-1 text-sm text-gray-600">Update your account's profile information and email address.</p>
                            </div>

                            <div class="pt-6 px-6 grid grid-cols-2 gap-4">
                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="p-6">
                                <!-- Email -->
                                <div class="mb-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                                        Current Password
                                    </label>
                                    <div class="mt-1 relative">
                                        <input id="current_password" name="current_password" :type="showCurrentPassword ? 'text' : 'password'"
                                            autocomplete="current-password"
                                            placeholder="Enter your current password"
                                            x-model="currentPassword"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors">
                                        <button type="button" @click="showCurrentPassword = !showCurrentPassword" 
                                            aria-label="Show current password"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg x-show="!showCurrentPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg x-show="showCurrentPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="new_password" class="block text-sm font-medium text-gray-700">
                                        New Password
                                    </label>
                                    <div class="mt-1 relative">
                                        <input id="new_password" name="new_password" :type="showPassword ? 'text' : 'password'"
                                            x-model="passwordMatch.new_password"
                                            placeholder="Enter a new password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors">
                                        <button type="button" @click="showPassword = !showPassword" 
                                            aria-label="Toggle password visibility"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg x-show="!showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg x-show="showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('new_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Confirm New Password
                                    </label>
                                    <div class="mt-1 relative">
                                        <input :type="showConfirmPassword ? 'text' : 'password'"
                                            id="new_password_confirmation"
                                            x-model="passwordMatch.new_password_confirmation"
                                            name="new_password_confirmation"
                                            placeholder="Enter the new password again"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                            :class="{ 'border-red-500': !passwordsMatch && passwordMatch.new_password_confirmation }"
                                            />
                                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" 
                                            aria-label="Toggle password visibility"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg x-show="!showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg x-show="showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p x-show="!passwordsMatch && passwordMatch.new_password_confirmation" x-transition class="mt-1 text-sm text-red-600">
                                        Passwords do not match.
                                    </p>
                                </div>

                                <!-- Save Button -->
                                <div class="mt-4 text-center">
                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="hidden lg:block"></div>
        </div>
    </div>
</div>
<script>
        function updateProfile() {
            return {
                showCurrentPassword: false,
                showPassword: false,
                showConfirmPassword: false,
                currentPassword: '',
                passwordMatch: {
                    new_password: '',
                    new_password_confirmation: '',
                },
                get passwordsMatch() {
                    return this.passwordMatch.new_password === this.passwordMatch.new_password_confirmation;
                },
                clearPasswordFields() {
                    this.currentPassword = '';
                    this.passwordMatch.new_password = '';
                    this.passwordMatch.new_password_confirmation = '';
                    
                    document.getElementById('current_password').value = '';
                    document.getElementById('new_password').value = '';
                    document.getElementById('new_password_confirmation').value = '';
                }
            }
        }
    </script>
@endsection