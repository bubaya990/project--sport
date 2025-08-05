<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Add your methods here
    public function index()
    {
        return view('payments.index');
    }

    public function process(Request $request)
    {
        // Payment processing logic
    }
}