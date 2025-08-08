<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutusController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



 // Evenments
Route::resource('evenements', \App\Http\Controllers\EvenementController::class)
    ->except(['show'])
    ->middleware('auth');


Route::get('evenements/{evenement}', [\App\Http\Controllers\EvenementController::class, 'show'])
    ->name('evenements.show');

Route::resource('evenements/add', \App\Http\Controllers\EvenementController::class)
    ->except(['evenements.add']);



  
// Socialite Routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [RegisteredUserController::class, 'handleGoogleCallback']);
    
    Route::get('/apple', [RegisteredUserController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/apple/callback', [RegisteredUserController::class, 'handleAppleCallback']);
});


require __DIR__.'/auth.php';
