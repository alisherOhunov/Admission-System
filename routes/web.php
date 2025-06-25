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
// Route::middleware(['auth', 'role:applicant'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/applicant/dashboard', [ApplicantDashboardController::class, 'index'])->name('applicant.dashboard');
    
    // Application Management
    Route::get('/applicant/application', [ApplicationController::class, 'index'])->name('applicant.application');
    Route::post('/applicant/application/personal-info', [ApplicationController::class, 'updatePersonalInfo'])->name('applicant.application.personal');
    Route::post('/applicant/application/contact-info', [ApplicationController::class, 'updateContactInfo'])->name('applicant.application.contact');
    Route::post('/applicant/application/academic-info', [ApplicationController::class, 'updateAcademicInfo'])->name('applicant.application.academic');
    Route::post('/applicant/application/program-choice', [ApplicationController::class, 'updateProgramChoice'])->name('applicant.application.program');
    Route::post('/applicant/application/upload-document', [ApplicationController::class, 'uploadDocument'])->name('applicant.application.upload');
    Route::post('/applicant/application/submit', [ApplicationController::class, 'submit'])->name('applicant.application.submit');
// });

// Admin & Staff Routes
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// Route::middleware(['auth', 'role:admin,staff'])->prefix('admin')->name('admin.')->group(function () {
    
    // Application Management
    Route::get('/admin/applications', [ApplicationsController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{application}', [ApplicationsController::class, 'show'])->name('admin.applications.show');
    Route::post('/admin/applications/{application}/status', [ApplicationsController::class, 'updateStatus'])->name('admin.applications.status');
    Route::post('/admin/applications/{application}/notes', [ApplicationsController::class, 'addNote'])->name('admin.applications.notes');
    Route::get('/admin/applications/export', [ApplicationsController::class, 'export'])->name('admin.applications.export');
// });

// Error Pages
Route::fallback(function () {
    return view('errors.404');
});
