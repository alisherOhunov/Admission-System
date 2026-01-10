<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Verify your email to activate your {{ config('app.name') }} account and access all personalized features, services, and updates.">
    <title>Email Verification - {{ config('app.name') }}</title>
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"></noscript>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center py-6 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        class="w-10 h-10 sm:w-12 sm:h-12" style="display: block;">
                    <span class="text-xl sm:text-2xl font-bold text-gray-900">{{ config('app.name') }}</span>
                </div>
            </div>

            <h2 class="mt-4 sm:mt-6 text-center text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                Verify Your Email Address
            </h2>
        </div>

        <div class="mt-6 sm:mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-6 sm:py-8 px-4 shadow rounded-lg sm:px-10">

                @if (session('message'))
                    <div class="bg-green-50 border border-green-200 rounded-md p-3 sm:p-4 mb-5 sm:mb-6">
                        <div class="flex">
                            <svg class="h-5 w-5 text-green-400 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-green-800">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="space-y-5 sm:space-y-6">
                    <div class="text-sm text-gray-600 space-y-2">
                        <p>
                            Before continuing, please check your email for a verification link.
                        </p>
                        <p>
                            If you didn't receive the email, click the button below to request another.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Resend Verification Email
                        </button>
                    </form>

                    <div class="text-center">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="font-medium text-gray-600 hover:text-gray-500">
                                Use a different account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>