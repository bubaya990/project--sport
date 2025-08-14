<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // No middleware - allow all users (including guests)
    }

    public function index()
    {
        try {
            $upcomingEvents = Evenement::where('status', '!=', 'completed')
                ->orderBy('date', 'asc')
                ->get();

            $completedEvents = Evenement::where('status', 'completed')
                ->orderBy('date', 'desc')
                ->get();

            return view('dashboard', compact('upcomingEvents', 'completedEvents'));
        } catch (\Exception $e) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the dashboard.');
        }
    }

    public function guests()
    {
        try {
            $guests = User::where('role', '!=', 'admin')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('users.guests', compact('guests'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to fetch guest list.');
        }
    }
}