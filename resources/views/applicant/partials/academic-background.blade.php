<div x-show="currentStep === {{$step}}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium"
                        >3</span
                        >
                        <span class="text-lg font-medium">Academic</span>
                    </div>
                </div>
                <p class="text-gray-600 mt-1">
                Education background
                </p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="border-b border-gray-200">
                            <div class="flex items-center space-x-3 mb-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                Academic Background
                                </h3>
                            </div>
                            <p class="text-lg text-gray-600 mb-6">
                                Provide details about your previous education and English language proficiency to help us evaluate your academic readiness.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <p class="text-lg font-semibold text-gray-900">Previous Education</p>
                            </div>
                            <div>
                                <label
                                for="previousInstitution"
                                class="block text-sm font-medium text-gray-700"
                                >Previous Institution <span class="text-red-500">*</span></label
                                >
                                <input
                                    x-model="form.previous_institution"
                                    type="text"
                                    id="previousInstitution"
                                    name="previous_institution"
                                    placeholder="e.g., University of California, Berkeley"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                <p class="mt-2 text-gray-500">Enter the full name of your most recent educational institution</p>
                                @error('previous_institution')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    for="degreeEarned"
                                    class="block text-sm font-medium text-gray-700"
                                    >Degree/Certificate Earned <span class="text-red-500">*</span>
                                </label
                                >
                                <input
                                    x-model="form.degree_earned"
                                    type="text"
                                    id="degreeEarned"
                                    name="degree_earned"
                                    placeholder="e.g., Bachelor of Science in Computer Science"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                @error('degree_earned')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 py-6 border-b border-gray-200">
                            <div>
                                <label
                                for="gpa"
                                class="block text-sm font-medium text-gray-700"
                                >GPA/GRADE
                                <span class="text-red-500">*</span></label
                                >
                                <input
                                x-data="{ form: { previous_gpa: '{{ old('previous_gpa', $application->previous_gpa ?? '') }}' } }"
                                x-model="form.previous_gpa"
                                type="text"
                                id="gpa"
                                name="previous_gpa"
                                placeholder="e.g., 3.8/4.0 or First Class"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                />
                                <p class="mt-2 text-gray-500">Use the grading system from your institution</p>
                                @error('previous_gpa')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label
                                    for="graduationDate"
                                    class="block text-sm font-medium text-gray-700"
                                    >Graduation Date (Optional)
                                    </label
                                    >
                                    <input
                                    x-model="form.graduation_date"
                                    type="date"
                                    id="graduationDate"
                                    name="graduation_date"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    />
                                    <p class="mt-2 text-gray-500">When did you graduate or when do you expect to graduate?</p>
                                    @error('graduation_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">English Language Proficiency</p>
                                </div>
                                <div>
                                    <label
                                    for="english-test-type"
                                    class="block text-sm font-medium text-gray-700"
                                    >English Test Type</label
                                    >
                                    <select
                                    x-model="form.english_test_type"
                                    id="english-test-type"
                                    name="english_test_type"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    >
                                    <option value="IELTS">IELTS Academic</option>
                                    <option value="TOEFL">TOEFL iBT</option>
                                    <option value="DUOLINGO">Duolingo English Test</option>
                                    <option value="CAMBRIDGE">Cambridge English</option>
                                    <option value="PTE">PTE Academic</option>
                                    <option value="OTHER">Other</option>
                                    </select>
                                    <p class="mt-2 text-gray-500">Select the English proficiency test you have taken or plan to take</p>
                                    @error('english_test_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                    for="testScore"
                                    class="block text-sm font-medium text-gray-700"
                                    >Test Score <span class="text-red-500">*</span></label
                                    >
                                    <input
                                    x-model="form.english_test_score"
                                    type="text"
                                    id="testScore"
                                    name="english_test_score"
                                    placeholder="Enter your score"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    />
                                    @error('english_test_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label
                                            for="testDate"
                                            class="block text-sm font-medium text-gray-700"
                                            >Test Date <span class="text-red-500">*</span>
                                        </label
                                        >
                                        <input
                                            x-model="form.english_test_date"
                                            type="date"
                                            id="testDate"
                                            name="english_test_date"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        />
                                        @error('english_test_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex items-start space-2 rounded-md border border-blue-200 bg-blue-50 p-4 text-left text-blue-800">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe h-5 w-5">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                                            <path d="M2 12h20"></path>
                                        </svg>
                                        </div>
                                        <div class="text-left ml-3">
                                        <h4 class="font-semibold mb-2">IELTS Academic Score Information</h4>
                                        <p class="text-sm"></p>
                                    </div>
                                </div>
                                <div class="flex items-start rounded-md border border-yellow-200 bg-yellow-50 p-4 text-yellow-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 mt-1"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>

                                    <div class="ml-3 text-left">
                                        <h4 class="text-sm font-medium mb-2">
                                            Academic Requirements:
                                        </h4>
                                        <ul class="text-sm space-y-1">
                                            <li>• Upload official transcripts from all institutions attended</li>
                                            <li>• English test scores must be from the last 2 years</li>
                                            <li>• Provide exact scores as they appear on official reports</li>
                                            <li>• Graduate programs may have higher GPA and test score requirements</li>
                                            <li>• All documents must be in English or include certified translations</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>                
                        </div>
                    </div>
                    <!-- Right Column - Document Upload -->
                    <div>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm h-fit">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3
                                class="text-lg font-medium flex items-center space-x-2"
                                >
                                <svg
                                    class="h-5 w-5 text-blue-600"
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
                                <span>Academic Documents</span>
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">
                                Upload required and optional documents for this step
                                </p>
                            </div>

                            <div class="p-6 space-y-4">
                                <!-- Transcripts Upload -->
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="text-sm font-medium"
                                                    >Official Transcripts</span
                                                >
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                    >Required</span
                                                >
                                            </div>
                                            <p class="text-s text-gray-500 mb-2">
                                                Complete academic transcripts from all institutions
                                            </p>
                                            <div class="text-xs text-gray-400">
                                                Formats: PDF • Max size: 10MB
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
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
                                        <label for="transcripsts-file" class="cursor-pointer">
                                            <span class="text-sm font-medium text-gray-900"
                                            >Click to upload</span
                                            >
                                            <span class="text-sm text-gray-500">
                                            or drag and drop</span
                                            >
                                            <input
                                            id="transcripsts-file"
                                            type="file"
                                            class="hidden"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            />
                                        </label>
                                    </div>
                                </div>

                                <!-- Diploma certificate Upload -->
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-sm font-medium"
                                            >Diploma/Certificate</span
                                        >
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                            >Required</span
                                        >
                                        </div>
                                        <p class="text-s text-gray-500 mb-2">
                                        Your degree certificate or diploma
                                        </p>
                                        <div class="text-xs text-gray-400">
                                        Formats: PDF, JPG, PNG • Max size: 5MB
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
                                    <label for="diploma-file" class="cursor-pointer">
                                        <span class="text-sm font-medium text-gray-900"
                                        >Click to upload</span
                                        >
                                        <span class="text-sm text-gray-500">
                                        or drag and drop</span
                                        >
                                        <input
                                        id="diploma-file"
                                        type="file"
                                        class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        />
                                    </label>
                                    </div>
                                </div>
                                <!-- Englis Test Score Upload -->
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="text-sm font-medium"
                                                    >English Test Score</span
                                                >
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"
                                                    >Optional</span
                                                >
                                            </div>
                                            <p class="text-s text-gray-500 mb-2">
                                                Official IELTS, TOEFL, or other English test results
                                            </p>
                                            <div class="text-xs text-gray-400">
                                                Formats: PDF • Max size: 5MB
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors">
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
                                        <label for="english-score-file" class="cursor-pointer">
                                            <span class="text-sm font-medium text-gray-900"
                                            >Click to upload</span
                                            >
                                            <span class="text-sm text-gray-500">
                                            or drag and drop</span
                                            >
                                            <input
                                            id="english-score-file"
                                            type="file"
                                            class="hidden"
                                            accept=".pdf,.jpg,.jpeg,.png"
                                            />
                                        </label>
                                    </div>
                                </div>

                                <div class="flex items-start rounded-md border border-blue-200 bg-blue-50 p-4 text-blue-700">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 mt-1"
                                            fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M12 5a7 7 0 1 1-6.93 6.41" />
                                        </svg>
                                    </div>

                                    <div class="ml-3 text-left">
                                        <h4 class="text-sm font-medium mb-2">
                                            Document Requirements:
                                        </h4>
                                        <ul class="text-sm space-y-1">
                                            <li>• All documents must be clear and legible</li>
                                            <li>• Official documents should be in original language</li>
                                            <li>• Translations must be certified if documents are not in English</li>
                                            <li>• File names should be descriptive and professional</li>
                                            <li>• Ensure all pages are included for multi-page documents</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between pt-8 border-t mt-8">
                    <button type="button" @click="currentStep = 2" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </button>

                    <div class="flex items-center space-x-4">
                        <button
                        type="submit"
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

                        <button type="button" @click="currentStep = 4" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Next
                            <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>