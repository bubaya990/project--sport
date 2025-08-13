<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\EvenementController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

// Admin routes - moved from auth.php
Route::get('/admin/login', function () {
    return view('auth.admin-login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->username === 'admin' && $request->password === 'admin') {
        $user = User::where('email', 'admin@admin.com')->first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ]);
        }
        
        Auth::login($user);
        return redirect('/');
    }
    
    return back()->withErrors(['message' => 'Invalid credentials']);
})->name('admin.login.submit');

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('admin.logout');