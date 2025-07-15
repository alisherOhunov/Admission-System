<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased" x-data="registerForm()">
    <div class="min-h-screen flex flex-col justify-center py-12">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="flex justify-center items-center space-x-1">
                <svg class="h-10 w-10 text-gray-600" fill="none" stroke="#2563EB" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                </svg>
                <span class="text-2xl font-bold text-gray-900">{{ config('app.name') }}</span>
            </div>
            <h2 class="mt-5 text-center text-2xl font-bold tracking-tight text-gray-900">
                {{ __('auth.title') }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                {{ __('auth.or') }}
                <a href="{{ route('login') }}" class="font-medium text-university-600 hover:text-university-500">
                    {{ __('auth.sign_in_option') }}
                </a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
                <div class="p-4 pb-0 text-center">
                    <h3 class="text-2xl font-semibold text-gray-900">{{ __('auth.get_started') }}</h3>
                </div>

                <div class="p-6 pt-0">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            @foreach ($errors->all() as $error)
                                <p class="text-sm text-red-600">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-sm text-green-600">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-6" @submit="handleSubmit">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('auth.first_name') }}
                                </label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    x-model="form.first_name"
                                    value="{{ old('first_name') }}"
                                    placeholder="{{ __('auth.first_name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                    required autofocus
                                />
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('auth.last_name') }}
                                </label>
                                <input type="text"
                                       id="last_name"
                                       name="last_name"
                                       x-model="form.last_name"
                                       value="{{ old('last_name') }}"
                                       placeholder="{{ __('auth.last_name') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                       required />
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('auth.email') }}
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   x-model="form.email"
                                   value="{{ old('email') }}"
                                   placeholder="{{ __('auth.enter_your_email') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                   required />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                {{ __('auth.password') }}
                            </label>
                            <div class="mt-1 relative">
                                <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                       x-model="form.password"
                                       autocomplete="current-password" required
                                       placeholder="{{ __('auth.create_password') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors">
                                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
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
                                       x-model="form.password_confirmation"
                                       placeholder="{{ __('auth.confirm_your_password') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-colors"
                                       :class="{ 'border-red-500': !passwordsMatch && form.password_confirmation }"
                                       required />
                                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg x-show="!showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showConfirmPassword" class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                                    </svg>
                                </button>
                            </div>
                            <p x-show="!passwordsMatch && form.password_confirmation" x-transition class="mt-1 text-sm text-red-600">
                                {{ __('auth.password_not_match') }}
                            </p>
                        </div>

                        <div class="flex items-start space-x-2">
                            <input type="checkbox"
                                   id="terms"
                                   name="terms"
                                   x-model="form.terms"
                                   value="1"
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                   {{ old('terms') ? 'checked' : '' }}
                                   required />
                            <label for="terms" class="text-sm text-gray-600">
                                {{ __('auth.agree_to_terms') }}
                                <a href="#" class="font-medium text-university-600 hover:text-university-500">
                                    {{ __('auth.terms_of_service') }}
                                </a>
                                {{ __('auth.and') }}
                                <a href="#" class="font-medium text-university-600 hover:text-university-500">
                                    {{ __('auth.privacy_policy') }}
                                </a>
                            </label>
                        </div>

                        <div class="flex justify-center mb-4">
                            {!! app('captcha')->display() !!}
                        </div>
                        
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors">
                            <span>{{ __('auth.create_account') }}</span>
                        </button>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-gray-500">{{ __('auth.already_have_account') }}?</span>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('login') }}" class="font-medium text-university-600 hover:text-university-500">
                                {{ __('auth.sign_in_here') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function registerForm() {
            return {
                showPassword: false,
                showConfirmPassword: false,
                form: {
                    first_name: '{{ old('first_name') }}',
                    last_name: '{{ old('last_name') }}',
                    email: '{{ old('email') }}',
                    password: '',
                    password_confirmation: '',
                    terms: {{ old('terms') ? 'true' : 'false' }}
                },
                get passwordsMatch() {
                    return this.form.password === this.form.password_confirmation;
                },
            }
        }
    </script>
</body>
</html>
