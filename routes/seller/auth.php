<?php

use App\Http\Controllers\Seller\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Seller\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Seller\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Seller\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Seller\Auth\NewPasswordController;
use App\Http\Controllers\Seller\Auth\PasswordController;
use App\Http\Controllers\Seller\Auth\PasswordResetLinkController;
use App\Http\Controllers\Seller\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Routes for guests (not logged in as seller)
Route::middleware('guest:seller')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Account activation route
    Route::get('activate/{token}', [RegisteredUserController::class, 'activate'])
        ->name('activate');

    // Resend activation routes
    Route::get('resend-activation', [RegisteredUserController::class, 'showResendForm'])
        ->name('resend-activation');
    Route::post('resend-activation', [RegisteredUserController::class, 'resendActivation']);
    Route::post('resend-activation/remaining-time', [RegisteredUserController::class, 'getRemainingTime'])
        ->name('resend-activation.remaining-time');

    // Keep POST login here so guests can submit the form
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::post('forgot-password/remaining-time', [PasswordResetLinkController::class, 'getRemainingTime'])
        ->name('password.remaining-time');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// GET Login Route - Handle redirect here if already logged in
Route::get('login', function (Request $request) {
    if (Auth::guard('seller')->check()) {
        return redirect()->route('seller.dashboard');
    }
    // If not logged in, show the login form via the controller
    return app(AuthenticatedSessionController::class)->create($request);
})->name('login');

// Routes requiring seller authentication
Route::middleware('auth:seller')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
