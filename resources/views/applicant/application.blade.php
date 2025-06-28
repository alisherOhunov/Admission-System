<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University Application - EduAdmit</title>
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
  <body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
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
            <a href="dashboard.html" class="text-gray-600 hover:text-gray-900"
              >Dashboard</a
            >
            <a href="application.html" class="text-university-600 font-medium"
              >My Application</a
            >
            <div
              class="w-8 h-8 bg-university-100 rounded-full flex items-center justify-center"
            >
              <span class="text-university-600 font-medium text-sm">J</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="min-h-screen bg-slate-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    University Application Form
                </h1>
                <p class="mt-2 text-gray-600 text-lg max-w-4xl">
                Complete all application steps below. Navigate between sections using the tabs and submit when ready. Your progress is automatically saved.
                </p>
                </div>
            </div>

          <!-- Progress Bar -->
          <div class="mt-6 bg">
            <div class="flex justify-between text-sm text-gray-600 mb-2">
              <span>Progress</span>
              <span>20% complete</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
              <div
                class="bg-university-600 h-2 rounded-full"
                style="width: 20%"
              ></div>
            </div>
          </div>
        </div>

        <!-- Horizontal Tab Navigation -->
        <div class="mb-8">
          <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 overflow-x-auto">
              <!-- Step 1 - Active -->
              <button
                class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium border-university-500 text-university-600 border-b-2"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div class="relative">
                    <div
                      class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-university-600 bg-white"
                    >
                      <span class="text-sm font-medium text-university-600"
                        >1</span
                      >
                    </div>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-university-600">
                      Personal Information
                    </div>
                    <div class="text-xs text-gray-400 hidden sm:block">
                      Basic personal details
                    </div>
                  </div>
                </div>
              </button>

              <!-- Step 2 -->
              <button
                class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50 cursor-not-allowed"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div class="relative">
                    <div
                      class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-300 bg-white"
                    >
                      <span class="text-sm font-medium text-gray-500">2</span>
                    </div>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-gray-500">
                      Contact Information
                    </div>
                    <div class="text-xs text-gray-400 hidden sm:block">
                      Address and contact details
                    </div>
                  </div>
                </div>
              </button>

              <!-- Step 3 -->
              <button
                class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50 cursor-not-allowed"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div class="relative">
                    <div
                      class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-300 bg-white"
                    >
                      <span class="text-sm font-medium text-gray-500">3</span>
                    </div>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-gray-500">
                      Academic Background
                    </div>
                    <div class="text-xs text-gray-400 hidden sm:block">
                      Education background
                    </div>
                  </div>
                </div>
              </button>

              <!-- Step 4 -->
              <button
                class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50 cursor-not-allowed"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div class="relative">
                    <div
                      class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-300 bg-white"
                    >
                      <span class="text-sm font-medium text-gray-500">4</span>
                    </div>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-gray-500">
                      Program Choice
                    </div>
                    <div class="text-xs text-gray-400 hidden sm:block">
                      Program selection
                    </div>
                  </div>
                </div>
              </button>

              <!-- Step 5 -->
              <button
                class="group relative min-w-0 flex-1 overflow-hidden py-4 px-1 text-center text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 opacity-50 cursor-not-allowed"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div class="relative">
                    <div
                      class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-300 bg-white"
                    >
                      <span class="text-sm font-medium text-gray-500">5</span>
                    </div>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-gray-500">
                      Review & Submit
                    </div>
                    <div class="text-xs text-gray-400 hidden sm:block">
                      Review & submit
                    </div>
                  </div>
                </div>
              </button>
            </nav>
          </div>
        </div>

        <!-- Main Form Content -->
        <div class="max-w-4xl mx-auto">
          <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                  <span
                    class="flex items-center justify-center w-8 h-8 rounded-full bg-university-100 text-university-600 text-sm font-medium"
                    >1</span
                  >
                  <span class="text-lg font-medium">Personal Information</span>
                </div>
              </div>
              <p class="text-gray-600 mt-1">
                Basic personal details and identification
              </p>
            </div>

            <div class="p-6">
              <!-- Two Column Layout -->
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column - Form Fields -->
                <div class="space-y-6">
                  <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                      Personal Information
                    </h3>
                    <p class="text-sm text-gray-600 mb-6">
                      Please provide your basic personal information as it
                      appears on your passport.
                    </p>
                  </div>

                  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                      <label
                        for="firstName"
                        class="block text-sm font-medium text-gray-700"
                        >First Name <span class="text-red-500">*</span></label
                      >
                      <input
                        type="text"
                        id="firstName"
                        name="firstName"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      />
                    </div>

                    <div>
                      <label
                        for="lastName"
                        class="block text-sm font-medium text-gray-700"
                        >Last Name <span class="text-red-500">*</span></label
                      >
                      <input
                        type="text"
                        id="lastName"
                        name="lastName"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      />
                    </div>
                  </div>

                  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                      <label
                        for="dateOfBirth"
                        class="block text-sm font-medium text-gray-700"
                        >Date of Birth
                        <span class="text-red-500">*</span></label
                      >
                      <input
                        type="date"
                        id="dateOfBirth"
                        name="dateOfBirth"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      />
                    </div>

                    <div>
                      <label
                        for="gender"
                        class="block text-sm font-medium text-gray-700"
                        >Gender</label
                      >
                      <select
                        id="gender"
                        name="gender"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      >
                        <option value="">Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">
                          Prefer not to say
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                      <label
                        for="nationality"
                        class="block text-sm font-medium text-gray-700"
                        >Nationality <span class="text-red-500">*</span></label
                      >
                      <select
                        id="nationality"
                        name="nationality"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      >
                        <option value="">Select your nationality</option>
                        <option value="US">United States</option>
                        <option value="UK">United Kingdom</option>
                        <option value="CA">Canada</option>
                        <option value="DE">Germany</option>
                        <option value="FR">France</option>
                        <!-- Add more countries as needed -->
                      </select>
                    </div>

                    <div>
                      <label
                        for="passportNumber"
                        class="block text-sm font-medium text-gray-700"
                        >Passport Number
                        <span class="text-red-500">*</span></label
                      >
                      <input
                        type="text"
                        id="passportNumber"
                        name="passportNumber"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                      />
                    </div>
                  </div>

                  <div>
                    <label
                      for="nativeLanguage"
                      class="block text-sm font-medium text-gray-700"
                      >Native Language
                      <span class="text-red-500">*</span></label
                    >
                    <input
                      type="text"
                      id="nativeLanguage"
                      name="nativeLanguage"
                      required
                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-university-500 focus:border-university-500 sm:text-sm"
                    />
                  </div>

                  <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-900 mb-2">
                      Important Notes:
                    </h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                      <li>
                        • Ensure all information matches your passport exactly
                      </li>
                      <li>
                        • Your passport must be valid for at least 6 months
                      </li>
                      <li>
                        • Upload a clear scan of your passport on the right
                      </li>
                    </ul>
                  </div>
                </div>

                <!-- Right Column - Document Upload -->
                <div>
                  <div
                    class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit"
                  >
                    <div class="px-6 py-4 border-b border-gray-200">
                      <h3
                        class="text-lg font-medium flex items-center space-x-2"
                      >
                        <svg
                          class="h-5 w-5 text-university-600"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                          ></path>
                        </svg>
                        <span>Personal Documents</span>
                      </h3>
                      <p class="text-sm text-gray-600 mt-1">
                        Upload documents related to this step
                      </p>
                    </div>

                    <div class="p-6 space-y-4">
                      <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-3">
                          Required Documents
                        </h4>

                        <!-- Passport Upload -->
                        <div class="border rounded-lg p-4">
                          <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                              <div class="flex items-center space-x-2 mb-1">
                                <svg
                                  class="h-4 w-4 text-gray-400"
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
                                <span class="text-sm font-medium"
                                  >Passport (Scanned)</span
                                >
                                <span
                                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                  >Required</span
                                >
                              </div>
                              <p class="text-xs text-gray-500 mb-2">
                                Clear scan of your passport information page
                              </p>
                              <div class="text-xs text-gray-400">
                                Formats: PDF, JPG, PNG • Max: 5MB
                              </div>
                            </div>
                          </div>

                          <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors"
                          >
                            <svg
                              class="mx-auto h-6 w-6 text-gray-400 mb-2"
                              fill="none"
                              stroke="currentColor"
                              viewBox="0 0 24 24"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                              ></path>
                            </svg>
                            <label for="passport-file" class="cursor-pointer">
                              <span class="text-sm font-medium text-gray-900"
                                >Click to upload</span
                              >
                              <span class="text-sm text-gray-500">
                                or drag and drop</span
                              >
                              <input
                                id="passport-file"
                                type="file"
                                class="hidden"
                                accept=".pdf,.jpg,.jpeg,.png"
                              />
                            </label>
                          </div>
                        </div>
                      </div>

                      <!-- Upload Tips -->
                      <div
                        class="bg-blue-50 border border-blue-200 rounded-md p-3"
                      >
                        <h4 class="text-xs font-medium text-blue-900 mb-1">
                          Upload Tips:
                        </h4>
                        <ul class="text-xs text-blue-800 space-y-1">
                          <li>
                            • Use high-resolution scans (300 DPI recommended)
                          </li>
                          <li>• Ensure documents are clear and legible</li>
                          <li>• Files are automatically saved when uploaded</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Navigation Buttons -->
              <div class="flex items-center justify-between pt-8 border-t mt-8">
                <button
                  disabled
                  class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed"
                >
                  <svg
                    class="h-4 w-4 mr-2"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"
                    ></path>
                  </svg>
                  Previous
                </button>

                <div class="flex items-center space-x-4">
                  <button
                    class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                  >
                    <svg
                      class="h-4 w-4 mr-2"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"
                      ></path>
                    </svg>
                    Save Progress
                  </button>

                  <button
                    class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-university-600 hover:bg-university-700"
                  >
                    Next
                    <svg
                      class="h-4 w-4 ml-2"
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
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Progress Summary Card -->
          <div
            class="mt-8 bg-university-50 border border-university-200 rounded-lg"
          >
            <div class="p-6">
              <div class="flex items-center justify-between mb-4">
                <div>
                  <h3 class="text-lg font-medium text-university-900">
                    Application Progress
                  </h3>
                  <p class="text-sm text-university-700">20% complete</p>
                </div>
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                  >In Progress</span
                >
              </div>
              <div class="w-full bg-university-200 rounded-full h-3">
                <div
                  class="bg-university-600 h-3 rounded-full"
                  style="width: 20%"
                ></div>
              </div>

              <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                <div class="flex items-center space-x-2">
                  <div class="h-2 w-2 rounded-full bg-university-600"></div>
                  <span class="text-university-800">Personal Information</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="h-2 w-2 rounded-full bg-gray-300"></div>
                  <span class="text-university-800">Contact Information</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="h-2 w-2 rounded-full bg-gray-300"></div>
                  <span class="text-university-800">Academic Background</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="h-2 w-2 rounded-full bg-gray-300"></div>
                  <span class="text-university-800">Program Choice</span>
                </div>
                <div class="flex items-center space-x-2">
                  <div class="h-2 w-2 rounded-full bg-gray-300"></div>
                  <span class="text-university-800">Review & Submit</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
