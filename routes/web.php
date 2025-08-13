<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\EvenementController;

// Main page - About Us
Route::get('/', [AboutUsController::class, 'index'])->name('aboutus.index');

// Dashboard page
Route::get('/dashboard', function() {
    return redirect('/');
})->name('dashboard');

// Events routes
Route::resource('evenements', EvenementController::class);

// About Us routes
Route::get('/about-us', [AboutUsController::class, 'index'])->name('aboutus.index');
Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('aboutus.update');