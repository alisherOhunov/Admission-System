{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Reset your account password on {{ config('app.name') }} to access personalized features and services.">
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"></noscript>
    
    <title>Reset Password - {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-gray-50" x-data="resetPassword()">
        <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <div class="flex justify-center">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                            width="48" height="48" style="display: block;">
                        <span class="text-2xl font-bold text-gray-900">{{ config('app.name') }}</span>
                    </div>
                </div>

                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Reset Password
                </h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required 
                                    value="{{ old('email', $email) }}"
                                    placeholder="Enter your email"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 @enderror">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                {{ __('auth.password') }}
                            </label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                       autocomplete="current-password" required
                                        x-model="resetPasswordForm.password"
                                       placeholder="{{ __('auth.create_password') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors">
                                <button type="button" @click="showPassword = !showPassword"  aria-label="Show password" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                {{ __('auth.confirm_password') }}
                            </label>
                            <div class="mt-1 relative">
                                <input :type="showConfirmPassword ? 'text' : 'password'"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       x-model="resetPasswordForm.password_confirmation"
                                       placeholder="{{ __('auth.confirm_your_password') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                       :class="{ 'border-red-500': !passwordsMatch && resetPasswordForm.password_confirmation }"
                                       required />
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword" aria-label="Show password" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            <p x-show="!passwordsMatch && resetPasswordForm.password_confirmation" x-transition class="mt-1 text-sm text-red-600">
                                {{ __('auth.password_not_match') }}
                            </p>
                        </div>

                        <div>
                            <button type="submit" 
                                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <script>
            function resetPassword() {
                return {
                    showPassword: false,
                    showConfirmPassword: false,
                    resetPasswordForm: {
                        password: '',
                        password_confirmation: '',
                    },
                    get passwordsMatch() {
                        return this.resetPasswordForm.password === this.resetPasswordForm.password_confirmation;
                    },
                }
            }
        </script>
    </body>
</html>