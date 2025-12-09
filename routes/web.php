<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReferralController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Referral Link
Route::get('/ref/{code}', [ReferralController::class, 'redirect'])->name('referral.redirect');

// Language Switcher
Route::get('/language/{locale}', function (string $locale) {
    \App\Services\LanguageService::setLanguage($locale);
    return redirect()->back();
})->name('language.switch');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('register.post');

    Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);

    // Two-Factor Challenge (shown after successful credential verification)
    Route::get('two-factor-challenge', [AuthController::class, 'twoFactorChallenge'])->name('two-factor.challenge');
    Route::post('two-factor-challenge', [AuthController::class, 'verifyTwoFactor'])->name('two-factor.verify');

    // Forgot Password
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

Route::post('logout', [AuthController::class, 'destroy'])->name('logout')->middleware('auth');

// Email verification routes
Route::middleware('auth')->group(function () {
    Route::get('email/verify', [AuthController::class, 'verificationNotice'])
        ->name('verification.notice');
    
    Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');
    
    Route::post('email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// Email change verification (signed URL)
Route::get('email-change/verify/{token}', [AuthController::class, 'verifyEmailChange'])
    ->name('email-change.verify')
    ->middleware('signed');

Route::get('/dashboard', function () {
    return redirect()->route('app.index');
})->middleware(['auth'])->name('dashboard');

// Public Pages (Terms, Privacy, etc.)
Route::get('/page/{page}', [PageController::class, 'show'])->name('page.show');

// API Documentation
Route::get('/docs/api/{section?}', [\App\Http\Controllers\Docs\ApiDocumentationController::class, 'index'])->name('docs.api');

