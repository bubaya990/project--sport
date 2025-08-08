<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $upcomingEvents = Evenement::where('status', '!=', 'completed')
            ->orderBy('date', 'asc')
            ->get();

        $completedEvents = Evenement::where('status', 'completed')
            ->orderBy('date', 'desc')
            ->get();

        return view('dashboard', compact('upcomingEvents', 'completedEvents'));
    }
}