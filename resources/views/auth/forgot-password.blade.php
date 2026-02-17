{{-- resources/views/auth/forgot-password.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Reset your password on {{ config('app.name') }}.">
    <title>Forgot Password - {{ config('app.name') }}</title>
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"></noscript>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="bg-gray-50">
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
                    {{ __('auth.forgot_password_heading') }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    {{ __('auth.forgot_password_subtitle') }}
                </p>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

                    @if (session('status'))
                        <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm text-green-800">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                {{ __('auth.email') }}
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required
                                    value="{{ old('email') }}"
                                    placeholder="{{ __('auth.email_placeholder') }}"
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-300 @enderror">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-center mb-4">
                                {!! app('captcha')->display() !!}
                            </div>
                            <button type="submit" 
                                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ __('auth.send_reset_email') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-500">
                                {{ __('auth.back_to_login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>