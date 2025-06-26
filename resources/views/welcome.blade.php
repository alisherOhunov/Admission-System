<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EduAdmit - International Student Admission Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              university: {
                50: "#f0f6ff",
                100: "#e0edff",
                200: "#b8dcff",
                300: "#7cc0ff",
                400: "#369dff",
                500: "#0a7fff",
                600: "#0066ff",
                700: "#0052cc",
                800: "#0047b3",
                900: "#003d99",
                950: "#002566",
              },
            },
          },
        },
      };
    </script>
  </head>
  <body class="bg-gradient-to-br from-university-50 to-white">
    <!-- Navigation -->
    <nav class="border-b bg-white/80 backdrop-blur-sm sticky top-0 z-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center space-x-2">
            <svg
              class="h-8 w-8 text-university-600"
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
            <span class="text-xl font-bold text-gray-900">EduAdmit</span>
          </div>

          <div class="flex items-center space-x-4">
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900"
              >Sign In</a
            >
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-university-600 hover:bg-university-700"
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
            Your Gateway to
            <span class="text-university-600">International Education</span>
          </h1>
          <p class="mt-6 text-lg leading-8 text-gray-600 max-w-3xl mx-auto">
            Streamline your university application process with our
            comprehensive admission platform. Apply to top universities
            worldwide with confidence and ease.
          </p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a
              href="{{ route('login') }}"
              class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-university-600 hover:bg-university-700"
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

    <!-- Stats Section -->
    <section class="py-16 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
          <div class="text-center">
            <div class="text-3xl font-bold text-university-600">2,500+</div>
            <div class="text-sm text-gray-600">Students Admitted</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-university-600">80+</div>
            <div class="text-sm text-gray-600">Countries Represented</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-university-600">150+</div>
            <div class="text-sm text-gray-600">Programs Available</div>
          </div>
          <div class="text-center">
            <div class="text-3xl font-bold text-university-600">94%</div>
            <div class="text-sm text-gray-600">Success Rate</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
            Why Choose EduAdmit?
          </h2>
          <p class="mt-4 text-lg text-gray-600">
            Everything you need for a successful university application
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">
              Simple Application Process
            </h3>
            <p class="text-gray-600">
              Complete your application in easy steps with our guided form
            </p>
          </div>

          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">International Students</h3>
            <p class="text-gray-600">
              Designed specifically for international student admissions
            </p>
          </div>

          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M5 13l4 4L19 7"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Document Management</h3>
            <p class="text-gray-600">
              Secure upload and management of all required documents
            </p>
          </div>

          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Real-time Tracking</h3>
            <p class="text-gray-600">
              Track your application status in real-time
            </p>
          </div>

          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Secure & Private</h3>
            <p class="text-gray-600">
              Your data is protected with enterprise-level security
            </p>
          </div>

          <div
            class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-lg transition-shadow"
          >
            <div
              class="w-12 h-12 bg-university-100 rounded-lg flex items-center justify-center mb-4"
            >
              <svg
                class="h-6 w-6 text-university-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                ></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Support Team</h3>
            <p class="text-gray-600">
              Get help from our dedicated admissions support team
            </p>
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
              class="w-16 h-16 bg-university-600 rounded-full flex items-center justify-center mx-auto mb-4"
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
              class="w-16 h-16 bg-university-600 rounded-full flex items-center justify-center mx-auto mb-4"
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
              class="w-16 h-16 bg-university-600 rounded-full flex items-center justify-center mx-auto mb-4"
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
    <section class="py-20 bg-university-600">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white sm:text-4xl">
          Ready to Start Your Journey?
        </h2>
        <p class="mt-4 text-lg text-university-100">
          Join thousands of students who have successfully applied through our
          platform
        </p>
        <div class="mt-8">
          <a
            href="{{ route('login') }}"
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-university-600 bg-white hover:bg-gray-100"
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
    <footer class="bg-gray-900 text-white py-12">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-2 mb-4">
              <svg
                class="h-6 w-6 text-university-400"
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
              <span class="text-lg font-bold">EduAdmit</span>
            </div>
            <p class="text-gray-400">
              Your trusted partner for international university admissions.
            </p>
          </div>
          <div>
            <h3 class="font-semibold mb-4">Platform</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">Features</a></li>
              <li><a href="#" class="hover:text-white">Pricing</a></li>
              <li><a href="#" class="hover:text-white">Security</a></li>
            </ul>
          </div>
          <div>
            <h3 class="font-semibold mb-4">Support</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">Help Center</a></li>
              <li><a href="#" class="hover:text-white">Contact Us</a></li>
              <li><a href="#" class="hover:text-white">FAQ</a></li>
            </ul>
          </div>
          <div>
            <h3 class="font-semibold mb-4">Legal</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-white">Terms of Service</a></li>
              <li><a href="#" class="hover:text-white">Cookie Policy</a></li>
            </ul>
          </div>
        </div>
        <div
          class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400"
        >
          <p>&copy; 2024 EduAdmit. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
