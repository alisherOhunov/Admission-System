@php
    $universityName = 'State Academy of Sports of Uzbekistan!';
    $universityFile = storage_path('app/university_name.txt');
    if (File::exists($universityFile)) {
        $universityName = File::get($universityFile);
    }
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} - International Student Admission Platform</title>
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"></noscript>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-gradient-to-br from-blue-50 to-white">
    <!-- Navigation -->
    <nav class="border-b bg-white/80 backdrop-blur-sm sticky top-0 z-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-14 sm:h-16 items-center justify-between">
          <!-- Logo -->
          <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo"
            class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12" style="display: block;">
            <span class="text-base sm:text-lg md:text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
          </div>

          <!-- Navigation Links -->
          <div class="flex items-center space-x-2 sm:space-x-4">
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium text-gray-700 hover:text-gray-900"
              >Sign In</a
            >
            <a
              href="{{ route('register') }}"
              class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
              ><span class="hidden sm:inline">Get Started</span><span class="sm:hidden">Start</span></a
            >
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative py-12 sm:py-16 md:py-20 lg:py-24 xl:py-32">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h1
            class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900"
          >
            <span class="text-blue-600">Admission for international students</span>
          </h1>
          <p class="mt-4 sm:mt-6 text-base sm:text-lg leading-7 sm:leading-8 text-gray-800 max-w-7xl mx-auto px-4">
            Welcome to the online admission system for foreign students of {{ $universityName }}
          </p>
          <p class="mt-3 sm:mt-4 text-base sm:text-lg leading-7 sm:leading-8 text-gray-600 max-w-3xl mx-auto px-4">
            Apply to our university with confidence and ease.
          </p>
          <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 md:gap-6 px-4">
            <a
              href="{{ route('register') }}"
              class="w-full sm:w-auto inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
            >
              Start Your Application
              <svg
                class="ml-2 h-4 w-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"
                ></path>
              </svg>
            </a>
            <a
              href="{{ route('login') }}"
              class="w-full sm:w-auto inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 border border-gray-300 text-sm sm:text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
              Sign In
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Application Process Section -->
    <section class="py-12 sm:py-16 md:py-20 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-12 md:mb-16">
          <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">
            Simple Application Process
          </h2>
          <p class="mt-3 sm:mt-4 text-base sm:text-lg text-gray-600">
            Get started in just a few easy steps
          </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-3">
          <!-- Step 1 -->
          <div class="text-center px-4">
            <div
              class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4"
            >
              <span class="text-white font-bold text-lg sm:text-xl">1</span>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold mb-2">Create Account</h3>
            <p class="text-sm sm:text-base text-gray-600">
              Sign up and verify your email to get started
            </p>
          </div>

          <!-- Step 2 -->
          <div class="text-center px-4">
            <div
              class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4"
            >
              <span class="text-white font-bold text-lg sm:text-xl">2</span>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold mb-2">Complete Application</h3>
            <p class="text-sm sm:text-base text-gray-600">
              Fill out your personal, academic, and program information
            </p>
          </div>

          <!-- Step 3 -->
          <div class="text-center px-4">
            <div
              class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4"
            >
              <span class="text-white font-bold text-lg sm:text-xl">3</span>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold mb-2">Submit & Track</h3>
            <p class="text-sm sm:text-base text-gray-600">
              Submit your application and track its progress in real-time
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 sm:py-16 md:py-20 bg-blue-600">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white">
          Ready to Start Your Journey?
        </h2>
        <p class="mt-3 sm:mt-4 text-base sm:text-lg text-white px-4">
          Join thousands of students who have successfully applied through our
          platform
        </p>
        <div class="mt-6 sm:mt-8 px-4">
          <a
            href="{{ route('register') }}"
            class="inline-flex items-center justify-center px-5 sm:px-6 py-2.5 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-100 w-full sm:w-auto"
          >
            <span class="hidden sm:inline">Sign Up and Start Your Application Today</span>
            <span class="sm:hidden">Start Your Application</span>
            <svg
              class="ml-2 h-4 w-4"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
              ></path>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 sm:py-8">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center text-gray-400">
          <p class="text-sm sm:text-base">&copy; 2025 U-PRESS LLC. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>