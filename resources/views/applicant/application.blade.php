@extends('layouts.app')

@section('title', 'Dashboard - EduAdmit')

@section('content')
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
                        Complete all application steps below. Navigate between sections using the tabs and submit when
                        ready. Your progress is automatically saved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-4xl mx-auto">
      @include('applicant.partials.personal-info')
    </div>
  </div>
@endsection