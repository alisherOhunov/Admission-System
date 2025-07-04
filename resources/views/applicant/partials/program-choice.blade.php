<div x-show="currentStep === {{$step}}" x-transition>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span
                    class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-medium"
                    >4</span
                    >
                    <span class="text-2xl font-medium">Program</span>
                </div>
                </div>
                <p class="text-gray-600 text-lg mt-1">
                Program selection
                </p>
            </div>

            <div class="p-6">
                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Form Fields -->
                    <div class="space-y-6">
                        <div class="border-b border-gray-200">
                        <div class="flex items-center space-x-3 mb-4">
                            <h3 class="text-2xl font-medium text-gray-900 mb-4">
                                Program Selection
                            </h3>
                        </div>
                        <p class="text-lg text-gray-600 mb-6">
                            Choose your desired degree level and program of study. This will help us understand your academic goals and provide appropriate guidance.
                        </p>
                        </div>

                        <div class="grid grid-cols-1 pb-10 gap-6 border-b border-gray-200">
                        <div>
                            <p class="text-lg font-semibold text-gray-900">Academic Program</p>
                        </div>
                        <div>
                            <label
                            for="degreeLevel"
                            class="block text-sm font-medium text-gray-700"
                            >Degree Level<span class="text-red-500">*</span></label
                            >
                            <select
                            id="degreeLevel"
                            name="degreeLevel"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            >
                            <option value="masters">Graduate (Master's)</option>
                            <option value="undergraduate">Undergraduate (Bachelor's)</option>
                            </select>
                            <p class="mt-2 text-gray-500">Select the level of degree you wish to pursue</p>
                        </div>

                        <div>
                            <label
                                for="programOfStudy"
                                class="block text-sm font-medium text-gray-700"
                            >Program of Study<span class="text-red-500">*</span></label
                            >
                            <select
                                id="program_id"
                                name="program_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            >  
                                <option value="">Select Program</option>
                                
                                @foreach($programs as $programOfStudy => $programList)
                                    @foreach($programList as $program)
                                        <option value="{{ $program['id'] }}" @selected(old('program_id', $application->program_id ?? '') == $program['id'])>
                                            {{ $program['name'] }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                            <p class="mt-2 text-gray-500">Select the program you wish to apply for</p>
                            @error('program_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                            for="start_term"
                            class="block text-sm font-medium text-gray-700"
                            >Preferred Start Term<span class="text-red-500">*</span></label
                            >
                            <select
                            id="start_term"
                            name="start_term"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            >
                                <option value="">Select Start Term</option>
                                <option value="spring2025" @selected(old('start_term', $application->start_term ?? '') == 'spring2025')>Spring 2025</option>
                                <option value="fall2024" @selected(old('start_term', $application->start_term ?? '') == 'fall2024')>Fall 2024</option>
                                <option value="fall2025" @selected(old('start_term', $application->start_term ?? '') == 'fall2025')>Fall 2025</option>
                                <option value="spring2026" @selected(old('start_term', $application->start_term ?? '') == 'spring2026')>Spring 2026</option>
                            </select>
                            <p class="mt-2 text-gray-500">When would you like to begin your studies?</p>
                            @error('start_term')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <div class="flex items-center">
                                <input
                                    id="funding_interest"
                                    name="funding_interest"
                                    type="checkbox"
                                    value="1"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer"
                                    @checked(old('funding_interest', $application->funding_interest ?? false))
                                >
                                <label for="funding_interest" class="ml-2 block text-sm text-gray-700">
                                    I am interested in scholarships and financial aid opportunities
                                </label>
                            </div>
                            @error('funding_interest')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 gap-6">
                            <div class=" items-start rounded-md border border-blue-200 bg-blue-50 p-4 text-blue-black">
                            <div class="flex items-center space-x-3 mb-10">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open h-5 w-5">
                                        <path d="M12 7v14"></path>
                                        <path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-slate-900">Master of Science in Data Science</h4>
                                    <p class="text-slate-600">Computer Science</p>
                                </div>
                                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-secondary/80 bg-blue-100 text-blue-800 capitalize">graduate</div>
                            </div>

                            <div class="ml-3 text-left">
                                <h4 class="text-sm font-medium mb-2">
                                    Program overview:
                                </h4>
                                <p class="mb-4">Advanced program in data analysis, machine learning, and statistical modeling.</p>
                                <h4 class="text-sm font-medium mb-2">
                                Program Requirements
                                </h4>
                                <ul class="text-sm space-y-1">
                                    <li>• Bachelor's Degree</li>
                                    <li>• Programming Experience</li>
                                    <li>• Statistics Background</li>
                                    <li>• English Proficiency</li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div 
                            x-data="{ text: '', min: 100 }" 
                            class="grid grid-cols-1 gap-4 pb-10"
                        >
                        <div>
                            <p class="text-lg font-semibold text-gray-900">
                            Statement of Purpose <span class="text-red-500">*</span>
                            </p>
                        </div>

                        <div x-data="{ 
                            text: '{{ old('statement_of_purpose', $application->statement_of_purpose ?? '') }}', 
                            min: 100
                        }">
                            <div>
                                <label for="statement_of_purpose" class="block font-medium text-gray-700">
                                    Personal Statement <span class="text-red-500">*</span>
                                </label>
                            </div>

                            <div>
                                <p class="text-center text-gray-600">
                                    Explain why you want to study this program, your academic and professional background, and your career goals.
                                    This is your opportunity to make a compelling case for your admission.
                                </p>
                            </div>

                            <div>
                                <textarea
                                    id="statement_of_purpose"
                                    name="statement_of_purpose"
                                    placeholder="Begin your statement of purpose here..."
                                    rows="6"
                                    maxlength="1000"
                                    x-model="text"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                ></textarea>

                                <div class="mt-2 text-sm text-right">
                                    <span 
                                        :class="text.length < min ? 'text-orange-500' : 'text-green-600'"
                                        x-text="text.length < min 
                                            ? `${text.length} characters (${100 - text.length} more needed)` 
                                            : `${text.length} characters`"
                                    ></span>
                                    @error('statement_of_purpose')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="flex items-start rounded-md border border-green-200 bg-green-50 p-4 text-green-700">
                        <div class="ml-3 text-left">
                            <h4 class="font-medium text-lg mb-2">
                            Statement of Purpose Tips
                            </h4>
                            <ul class="text-md space-y-1">
                                <li>• Explain your academic and professional background</li>
                                <li>• Describe why you chose this specific program</li>
                                <li>• Outline your career goals and how this program fits</li>
                                <li>• Mention any relevant experience or achievements</li>
                                <li>• Keep it focused, clear, and well-structured</li>
                                <li>• Proofread for grammar and spelling errors</li>
                            </ul>
                        </div>
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
                            <span>Supporting Documents</span>
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                            Upload required and optional documents for this step
                            </p>
                        </div>

                        <div class="p-6 space-y-4">
                            <!-- Statement of Purpose Upload -->
                            <div x-data="documentUpload('sop', @js($documents->get('sop')))" class="border rounded-lg p-4">
                                <div class="mb-3">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-sm font-medium">Statement of Purpose</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="uploaded ? 'bg-green-100 text-green-800' :
                                                'bg-red-100 text-red-800'"
                                            x-text="uploaded ? 'Uploaded' : 'Required'">
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-2">Your personal statement (if separate file)</p>
                                    <div class="text-xs text-gray-400">Formats: PDF, DOC, DOCX • Max size: 5MB</div>
                                </div>

                                <div x-show="!uploaded" x-transition
                                    class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                    :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                        'border-gray-300 hover:border-gray-400'"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="handleDrop($event)">

                                    <div x-show="!uploading">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <label for="sop-file" class="cursor-pointer">
                                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                    fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <span class="text-md font-medium text-gray-900">Click to
                                                    upload</span>
                                                <span class="text-sm text-gray-500">or drag and drop</span>
                                                <span class="text-md text-gray-500">PDF, DOC, DOCX up to
                                                    5MB</span>
                                                <input id="sop-file" name="sop" type="file"
                                                    class="hidden" accept=".pdf,.doc,.docx"
                                                    @change="handleFileSelect($event)">
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Loading State -->
                                    <div x-show="uploading" class="flex flex-col items-center">
                                        <div
                                            class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                        </div>
                                        <span class="text-sm text-gray-600">Uploading...</span>
                                    </div>
                                </div>

                                <!-- Success State (shown after successful upload) -->
                                <div x-show="uploaded" x-transition
                                    class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-green-900"
                                                    x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                </p>
                                                <p class="text-sm text-green-700">
                                                    <span x-text="fileSize"></span><br>
                                                    <span class="text-green-600">Uploaded
                                                        successfully</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <!-- Download Button - only show when fileId exists -->
                                            <template x-if="fileId">
                                                <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                    class="text-green-600 hover:text-green-800 transition-colors">
                                                    <svg class="h-5 w-5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </template>

                                            <!-- Remove Button -->
                                            @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                                <button @click="removeFile()"
                                                    class="text-red-500 hover:text-red-700 transition-colors"
                                                    type="button">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Error State -->
                                <div x-show="error" x-transition
                                    class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Curriculum Vitae/Resume Upload -->
                            <div x-data="documentUpload('cv', @js($documents->get('cv')))" class="border rounded-lg p-4">
                                <div class="mb-3">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-sm font-medium">Curriculum Vitae/Resume</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="uploaded ? 'bg-green-100 text-green-800' :
                                                'bg-gray-100 text-gray-800'"
                                            x-text="uploaded ? 'Uploaded' : 'Optional'">
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-2">Your updated CV or resume</p>
                                    <div class="text-xs text-gray-400">Formats: PDF, DOC, DOCX • Max size: 5MB</div>
                                </div>

                                <div x-show="!uploaded" x-transition
                                    class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                    :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                        'border-gray-300 hover:border-gray-400'"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="handleDrop($event)">

                                    <div x-show="!uploading">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <label for="cv-file" class="cursor-pointer">
                                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                    fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <span class="text-md font-medium text-gray-900">Click to
                                                    upload</span>
                                                <span class="text-sm text-gray-500">or drag and drop</span>
                                                <span class="text-md text-gray-500">PDF, DOC, DOCX up to
                                                    5MB</span>
                                                <input id="cv-file" name="cv" type="file"
                                                    class="hidden" accept=".pdf,.doc,.docx"
                                                    @change="handleFileSelect($event)">
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Loading State -->
                                    <div x-show="uploading" class="flex flex-col items-center">
                                        <div
                                            class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                        </div>
                                        <span class="text-sm text-gray-600">Uploading...</span>
                                    </div>
                                </div>

                                <!-- Success State (shown after successful upload) -->
                                <div x-show="uploaded" x-transition
                                    class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-green-900"
                                                    x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                </p>
                                                <p class="text-sm text-green-700">
                                                    <span x-text="fileSize"></span><br>
                                                    <span class="text-green-600">Uploaded
                                                        successfully</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <!-- Download Button - only show when fileId exists -->
                                            <template x-if="fileId">
                                                <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                    class="text-green-600 hover:text-green-800 transition-colors">
                                                    <svg class="h-5 w-5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </template>

                                            <!-- Remove Button -->
                                            @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                                <button @click="removeFile()"
                                                    class="text-red-500 hover:text-red-700 transition-colors"
                                                    type="button">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Error State -->
                                <div x-show="error" x-transition
                                    class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Portfolio Upload -->
                            <div x-data="documentUpload('portfolio', @js($documents->get('portfolio')))" class="border rounded-lg p-4">
                                <div class="mb-3">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-sm font-medium">Portfolio</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                            :class="uploaded ? 'bg-green-100 text-green-800' :
                                                'bg-gray-100 text-gray-800'"
                                            x-text="uploaded ? 'Uploaded' : 'Optional'">
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-2">Academic or professional portfolio (if applicable)</p>
                                    <div class="text-xs text-gray-400">Formats: PDF, ZIP • Max size: 20MB</div>
                                </div>

                                <div x-show="!uploaded" x-transition
                                    class="border-2 border-dashed rounded-lg p-4 text-center transition-colors"
                                    :class="isDragging ? 'border-blue-400 bg-blue-50' :
                                        'border-gray-300 hover:border-gray-400'"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="handleDrop($event)">

                                    <div x-show="!uploading">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <label for="portfolio-file" class="cursor-pointer">
                                                <svg class="mx-auto h-10 w-10 text-gray-400 mb-2"
                                                    fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <span class="text-md font-medium text-gray-900">Click to
                                                    upload</span>
                                                <span class="text-sm text-gray-500">or drag and drop</span>
                                                <span class="text-md text-gray-500">PDF, ZIP up to
                                                    20MB</span>
                                                <input id="portfolio-file" name="portfolio" type="file"
                                                    class="hidden" accept=".pdf,.zip"
                                                    @change="handleFileSelect($event)">
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Loading State -->
                                    <div x-show="uploading" class="flex flex-col items-center">
                                        <div
                                            class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600 mb-2">
                                        </div>
                                        <span class="text-sm text-gray-600">Uploading...</span>
                                    </div>
                                </div>

                                <!-- Success State (shown after successful upload) -->
                                <div x-show="uploaded" x-transition
                                    class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="h-8 w-8 text-green-600" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-green-900"
                                                    x-text="fileName.length > 17 ? fileName.slice(0, 17) + '...' : fileName">
                                                </p>
                                                <p class="text-sm text-green-700">
                                                    <span x-text="fileSize"></span><br>
                                                    <span class="text-green-600">Uploaded
                                                        successfully</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <!-- Download Button - only show when fileId exists -->
                                            <template x-if="fileId">
                                                <a :href="`/applicant/application/{{ $application->id }}/download-document/${fileId}`"
                                                    class="text-green-600 hover:text-green-800 transition-colors">
                                                    <svg class="h-5 w-5" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </template>

                                            <!-- Remove Button -->
                                            @if($application->status !== 'submitted' && $application->status !== 'accepted')
                                            <button @click="removeFile()"
                                                class="text-red-500 hover:text-red-700 transition-colors"
                                                type="button">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Error State -->
                                <div x-show="error" x-transition
                                    class="bg-red-50 border border-red-200 rounded-lg p-4 mt-2">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-red-800" x-text="errorMessage"></span>
                                    </div>
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
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between pt-8 pb-6 px-6 border-t mt-8">
                    <button type="button" @click="currentStep = 3" class="flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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

                        <button @click="currentStep = 5" class="flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
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