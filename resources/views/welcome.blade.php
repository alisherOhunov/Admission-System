<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduAdmit - International Student Admission Platform</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-gradient-to-br from-blue-50 to-white">
    <!-- Navigation -->
    <nav class="border-b bg-white/80 backdrop-blur-sm sticky top-0 z-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center space-x-2">
            <svg
              class="h-8 w-8 text-blue-600"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 14l9-5-9-5-9 5 9 5z"
              ></path>
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
              ></path>
            </svg>
            <span class="text-xl font-bold text-gray-900">Online admission system</span>
          </div>

          <div class="flex items-center space-x-4">
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900"
              >Sign In</a
            >
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
              >Get Started</a
            >
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative py-20 sm:py-24 lg:py-32">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h1
            class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
          >
            <span class="text-blue-600">Admission for international students</span>
          </h1>
          <p class="mt-6 text-lg leading-8 text-gray-600 max-w-3xl mx-auto">
            Apply to our blue with confidence and ease.
          </p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
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
              class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
            >
              Sign In
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Application Process Section -->
    <section class="py-20 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
            Simple Application Process
          </h2>
          <p class="mt-4 text-lg text-gray-600">
            Get started in just a few easy steps
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
          <div class="text-center">
            <div
              class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <span class="text-white font-bold text-xl">1</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Create Account</h3>
            <p class="text-gray-600">
              Sign up and verify your email to get started
            </p>
          </div>
          <div class="text-center">
            <div
              class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <span class="text-white font-bold text-xl">2</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Complete Application</h3>
            <p class="text-gray-600">
              Fill out your personal, academic, and program information
            </p>
          </div>
          <div class="text-center">
            <div
              class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4"
            >
              <span class="text-white font-bold text-xl">3</span>
            </div>
            <h3 class="text-xl font-semibold mb-2">Submit & Track</h3>
            <p class="text-gray-600">
              Submit your application and track its progress in real-time
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white sm:text-4xl">
          Ready to Start Your Journey?
        </h2>
        <p class="mt-4 text-lg text-white">
          Join thousands of students who have successfully applied through our
          platform
        </p>
        <div class="mt-8">
          <a
            href="{{ route('login') }}"
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-gray-100"
          >
            Start Your Application Today
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
    <footer class="bg-gray-800 text-white py-12">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div
          class="mt-8 pt-8 text-center text-gray-400"
        >
          <p>&copy; 2025 Tashkent state blue of oriental studies. All rights reserved.</p>
      </div>
      </div>
    </footer>
  </body>
</html>
