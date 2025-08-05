<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/verify-phone', [PhoneVerificationController::class, 'show'])->name('verification.notice');
    Route::post('/verify-phone', [PhoneVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify-phone/resend', [PhoneVerificationController::class, 'resend'])->name('verification.resend');
});
// Socialite Routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [RegisteredUserController::class, 'handleGoogleCallback']);
    
    Route::get('/apple', [RegisteredUserController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/apple/callback', [RegisteredUserController::class, 'handleAppleCallback']);
});
Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments/process', [PaymentController::class, 'process'])->name('payments.process');
require __DIR__.'/auth.php';
