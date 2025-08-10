<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Evenement routes (protected)
    Route::resource('evenements', EvenementController::class)->except(['show']);
});

// Public show route
Route::get('evenements/{evenement}', [EvenementController::class, 'show'])
    ->name('evenements.show');

// Socialite Routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [RegisteredUserController::class, 'handleGoogleCallback']);
    
    Route::get('/apple', [RegisteredUserController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/apple/callback', [RegisteredUserController::class, 'handleAppleCallback']);
});

require __DIR__.'/auth.php';