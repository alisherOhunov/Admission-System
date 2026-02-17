<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Verify your email to activate your {{ config('app.name') }} account and access all personalized features, services, and updates.">
    <title>Email Verification</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-xl rounded-2xl p-6">
                <h4 class="text-xl font-semibold text-gray-900 mb-4">{{ __('auth.verify_email_heading') }}</h4>

                @if (session('message'))
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-4 text-sm">
                        {{ session('message') }}
                    </div>
                @endif

                <p class="text-sm text-gray-700 mb-2">
                    {{ __('auth.verify_email_check') }}
                </p>
                <p class="text-sm text-gray-700 mb-6">
                    {{ __('auth.verify_email_request') }}
                </p>

                <form method="POST" action="{{ route('verification.resend') }}" class="mb-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors">
                        {{ __('auth.resend_verification') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-sm text-blue-600 hover:underline text-center">
                        {{ __('auth.use_different_account') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
