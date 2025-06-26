<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboardController;
use App\Http\Controllers\Applicant\ApplicationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ApplicationsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home/Landing Page
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->isApplicant()) {
            return redirect()->route('applicant.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Applicant Routes
Route::middleware(['auth'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('dashboard');
    
    // Application Management
    Route::get('/application', [ApplicationController::class, 'index'])->name('application');
    Route::post('/application/personal-info', [ApplicationController::class, 'updatePersonalInfo'])->name('application.personal');
    Route::post('/application/contact-info', [ApplicationController::class, 'updateContactInfo'])->name('application.contact');
    Route::post('/application/academic-info', [ApplicationController::class, 'updateAcademicInfo'])->name('application.academic');
    Route::post('/application/program-choice', [ApplicationController::class, 'updateProgramChoice'])->name('application.program');
    Route::post('/application/upload-document', [ApplicationController::class, 'uploadDocument'])->name('application.upload');
    Route::post('/application/submit', [ApplicationController::class, 'submit'])->name('application.submit');
});

// Admin & Staff Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Application Management
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationsController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/status', [ApplicationsController::class, 'updateStatus'])->name('applications.status');
    Route::post('/applications/{application}/notes', [ApplicationsController::class, 'addNote'])->name('applications.notes');
    Route::get('/applications/export', [ApplicationsController::class, 'export'])->name('applications.export');
});

// Error Pages
Route::fallback(function () {
    return view('errors.404');
});
