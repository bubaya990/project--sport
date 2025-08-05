<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneVerificationController extends Controller
{
    public function showVerificationForm()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('register');
        }
        
        $user = User::find($userId);
        return view('auth.verify-phone', compact('user'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string|size:6',
        ]);

        $storedCode = session('phone_verification_code');
        $userId = session('user_id');

        if (!$storedCode || !$userId) {
            return redirect()->route('register')->with('error', 'Session expirée. Veuillez vous réinscrire.');
        }

        if ($request->verification_code != $storedCode) {
            return redirect()->back()->with('error', 'Code de vérification incorrect.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register')->with('error', 'Utilisateur non trouvé.');
        }

        // Mark phone as verified (you might want to add a phone_verified_at column)
        // $user->update(['phone_verified_at' => now()]);

        // Clear verification data
        session()->forget(['phone_verification_code', 'user_id']);

        // Log in the user
        Auth::login($user);

        // Redirect to payment page
        return redirect()->route('payment.form');
    }

    public function resendCode()
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('register');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register');
        }

        // Generate new verification code
        $code = rand(100000, 999999);
        session(['phone_verification_code' => $code]);
        
        // Log for demo
        \Log::info("New phone verification code for {$user->telephone}: {$code}");
        session()->flash('verification_code', $code);

        return redirect()->back()->with('success', 'Nouveau code envoyé à votre téléphone.');
    }
}