
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', [AboutUsController::class, 'index'])->name('aboutus.index');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('aboutus.show');
Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');
Route::get('/evenements/{evenement}', [EvenementController::class, 'show'])->name('evenements.show');

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Social Authentication Routes
    Route::get('auth/google', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [RegisteredUserController::class, 'handleGoogleCallback']);
    Route::get('auth/apple', [RegisteredUserController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('auth/apple/callback', [RegisteredUserController::class, 'handleAppleCallback']);
});

// Admin Authentication
Route::prefix('admin')->group(function () {
    // Login Routes
    Route::get('/login', function () {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/dashboard');
        }
        return view('auth.admin-login');
    })->name('admin.login');

    Route::post('/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            Auth::logout();
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    })->name('admin.login.submit');

    // Logout Route
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('admin.logout');
});

// Dashboard - accessible by both admins and guests
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Protected Admin Routes
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'auth', 'admin' => function ($request, $next) {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }], function () {
        // Events Management
        Route::get('/evenements/add', [EvenementController::class, 'add'])->name('evenements.add');
        Route::post('/evenements', [EvenementController::class, 'store'])->name('evenements.store');
        Route::get('/evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
        Route::put('/evenements/{evenement}', [EvenementController::class, 'update'])->name('evenements.update');
        Route::delete('/evenements/{evenement}', [EvenementController::class, 'destroy'])->name('evenements.destroy');

        // About Us Management
        Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
        Route::put('/about-us', [AboutUsController::class, 'update'])->name('aboutus.update');

        // Guest List Management
        Route::get('/users/guests', [DashboardController::class, 'guests'])->name('users.guests');
    });
});