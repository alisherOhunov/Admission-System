<?php

use App\Http\Controllers\Admin\ApplicationsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Applicant\ApplicationController;
use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');
});

Route::get('/email/verify', [EmailVerificationController::class, 'show'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['auth', 'applicant'])->name('verification.verify');
Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Applicant Routes
Route::middleware(['auth', 'applicant', 'verified'])->prefix('applicant')->name('applicant.')->group(function () {
    Route::get('/dashboard', [ApplicantDashboardController::class, 'index'])->name('dashboard');
    Route::get('/application', [ApplicationController::class, 'show'])->name('application');
    Route::post('/application/{application_id}/update', [ApplicationController::class, 'updateApplication'])->name('application.update');
    Route::post('/application/{application_id}/upload-document', [ApplicationController::class, 'uploadDocument'])->name('application.upload');
    Route::get('/application/{application_id}/download-document/{file_id}', [ApplicationController::class, 'downloadDocument'])->name('application.downloadDocument');
    Route::post('/application/{application_id}/remove-document/{file_id}', [ApplicationController::class, 'removeDocument'])->name('application.removeDocument');
    Route::post('/application/{application_id}/submit', [ApplicationController::class, 'submit'])->name('application.submit');
});

// Admin & Staff Routes
Route::middleware(['auth', 'admin', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application_id}', [ApplicationsController::class, 'show'])->name('applications.show');
    Route::post('/applications/{application_id}/status', [ApplicationsController::class, 'updateStatus'])->name('applications.status');
    Route::post('/applications/{application_id}/notes', [ApplicationsController::class, 'addNote'])->name('applications.notes');
    Route::get('/applications/{application_id}/document/{file_id}', [ApplicationsController::class, 'getApplicantDocument'])->name('applications.getApplicantDocument');

});

// Error Pages
Route::fallback(function () {
    return view('errors.404');
});
