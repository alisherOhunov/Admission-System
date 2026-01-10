<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('app.name') }} is an online admission system that helps students register, apply, and track their academic applications easily.">
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"></noscript>

    <title>@yield('title', config('app.name') .' - International Student Admission Platform')</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen">
        @auth
            <!-- Navigation Header -->
            <header class="bg-white shadow-sm border-b sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
                    <div class="flex justify-between items-center h-14 sm:h-16">
                        <!-- Logo -->
                        <div class="flex items-center space-x-2 min-w-0 flex-shrink">
                            <!-- Mobile menu button -->
                            <button type="button" aria-label="Toggle navigation"
                                class="md:hidden -ml-1 p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                                id="mobile-menu-button">
                                <svg class="h-5 w-5 sm:h-6 sm:w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="#000000ff">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <a href="{{ auth()->user()->isApplicant() ? route('applicant.dashboard') : route('admin.dashboard') }}"
                                class="flex items-center space-x-1.5 sm:space-x-2 min-w-0">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                        class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 flex-shrink-0" style="display: block;">
                                <span class="text-base sm:text-lg md:text-xl font-bold text-gray-900 truncate">{{ config('app.name') }}</span>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <nav class="hidden md:flex items-center space-x-4 lg:space-x-8" x-data="{ openSettings: false }">
                            @if (auth()->user()->isApplicant())
                                <a href="{{ route('applicant.dashboard') }}"
                                    class="flex items-center space-x-1.5 lg:space-x-2 text-gray-600 hover:text-gray-900 text-sm lg:text-base whitespace-nowrap {{ request()->routeIs('applicant.dashboard') ? 'text-blue-600 font-medium' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chart-column h-4 w-4">
                                        <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                        <path d="M18 17V9"></path>
                                        <path d="M13 17V5"></path>
                                        <path d="M8 17v-3"></path>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                                <a href="{{ route('applicant.application') }}"
                                    class="flex items-center space-x-1.5 lg:space-x-2 text-gray-600 hover:text-gray-900 text-sm lg:text-base whitespace-nowrap {{ request()->routeIs('applicant.application') ? 'text-blue-600 font-medium' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-4 w-4">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>My Application</span>
                                </a>
                            @else
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center space-x-1.5 lg:space-x-2 text-gray-600 hover:text-gray-900 text-sm lg:text-base whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-medium' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-chart-column h-4 w-4">
                                        <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                        <path d="M18 17V9"></path>
                                        <path d="M13 17V5"></path>
                                        <path d="M8 17v-3"></path>
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                                <a href="{{ route('admin.applications.index') }}"
                                    class="flex items-center space-x-1.5 lg:space-x-2 text-gray-600 hover:text-gray-900 text-sm lg:text-base whitespace-nowrap {{ request()->routeIs('admin.applications.*') ? 'text-blue-600 font-medium' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-4 w-4">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>Applications</span>
                                </a>
                                <div class="relative">
                                    <button 
                                        @click="openSettings = !openSettings"
                                        class="flex items-center space-x-1.5 lg:space-x-2 text-gray-600 hover:text-gray-900 text-sm lg:text-base whitespace-nowrap
                                        {{ request()->routeIs('admin.applications.settings.*') ? 'text-blue-600 font-medium' : '' }}">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-settings h-4 w-4">
                                            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>

                                        <span>Settings</span>

                                        <svg class="w-4 h-4 transform transition"
                                            :class="{ 'rotate-180': openSettings }"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path d="M6 9l6 6 6-6"/>
                                        </svg>
                                    </button>

                                    <div 
                                        x-show="openSettings"
                                        @click.away="openSettings = false"
                                        x-transition
                                        class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 
                                            border border-gray-200 z-20">

                                        <a href="{{ route('admin.applications.settings.periods') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Periods
                                        </a>

                                        <a href="{{ route('admin.applications.settings.programs') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Programs
                                        </a>

                                        <a href="{{ route('admin.applications.settings.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Site Settings
                                        </a>

                                    </div>
                                </div>
                            @endif
                        </nav>

                        <!-- User Menu -->
                        <div class="relative flex-shrink-0" x-data="{ open: false }">
                            <!-- Notifications -->
                            <!-- <button class="p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-4">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5V17z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h9.586a1 1 0 00.707-.293l5.414-5.414A1 1 0 0021 12.586V7a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path>
                                    </svg>
                                </button> -->

                            <!-- Profile dropdown -->
                            <!-- <button @click="open = !open" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-medium">{{ substr(auth()->user()->first_name, 0, 1) }}</span>
                                    </div>
                                </button> -->
                            <button @click="open = !open"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent-foreground p-2 relative h-8 w-8 sm:h-9 sm:w-9 rounded-full"
                                type="button" id="radix-:r3:" aria-haspopup="menu" aria-expanded="false"
                                data-state="closed">
                                <span class="bg-blue-50 relative flex shrink-0 overflow-hidden rounded-full h-7 w-7 sm:h-8 sm:w-8">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-full text-university-700 text-sm sm:text-base">{{ substr(auth()->user()->first_name, 0, 1) }}</span>
                                </span>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-56 sm:w-64 bg-white rounded-md shadow-lg py-1 z-50">
                                <div class="p-3 px-4">
                                    <div class="text-sm font-medium text-gray-900 truncate">
                                        {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</div>
                                    <div class="text-xs text-gray-600 truncate mt-0.5">{{ auth()->user()->email }}</div>
                                    <div
                                        class="inline-block px-2 py-0.5 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full shadow-sm mt-1.5">
                                        {{ auth()->user()->role === 2 ? 'Admin' : 'Applicant' }}
                                    </div>
                                </div>
                                <div class="border-t border-gray-100"></div>
                                <!-- <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg> -->
                                <a href="{{ route('profile.settings') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-settings mr-2 h-4 w-4 flex-shrink-0">
                                        <path
                                            d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z">
                                        </path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <span>Settings</span>
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-log-out mr-2 h-4 w-4 flex-shrink-0">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" x2="9" y1="12" y2="12"></line>
                                        </svg>
                                        <span>Log out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu -->
                <div class="md:hidden hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t bg-white">
                        @if (auth()->user()->isApplicant())
                            <a href="{{ route('applicant.dashboard') }}"
                                class="flex items-center space-x-2 px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md {{ request()->routeIs('applicant.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                    <path d="M18 17V9"></path>
                                    <path d="M13 17V5"></path>
                                    <path d="M8 17v-3"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('applicant.application') }}"
                                class="flex items-center space-x-2 px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md {{ request()->routeIs('applicant.application') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>My Application</span>
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-2 px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M3 3v16a2 2 0 0 0 2 2h16"></path>
                                    <path d="M18 17V9"></path>
                                    <path d="M13 17V5"></path>
                                    <path d="M8 17v-3"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('admin.applications.index') }}"
                                class="flex items-center space-x-2 px-3 py-2.5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md {{ request()->routeIs('admin.applications.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>Applications</span>
                            </a>
                            
                            <!-- Settings Section in Mobile -->
                            <div class="pt-2 border-t border-gray-100">
                                <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Settings
                                </div>
                                <a href="{{ route('admin.applications.settings.periods') }}"
                                    class="flex items-center space-x-2 px-3 py-2.5 pl-5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">
                                    <span>Periods</span>
                                </a>
                                <a href="{{ route('admin.applications.settings.programs') }}"
                                    class="flex items-center space-x-2 px-3 py-2.5 pl-5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">
                                    <span>Programs</span>
                                </a>
                                <a href="{{ route('admin.applications.settings.index') }}"
                                    class="flex items-center space-x-2 px-3 py-2.5 pl-5 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">
                                    <span>Site Settings</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </header>
        @endauth

        <!-- Page Content -->
        <main class="w-full">
            @yield('content')
        </main>
    </div>

    <!-- Mobile menu toggle -->
    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>