<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Admin access required.');
        }

        return $next($request);
    }
}
