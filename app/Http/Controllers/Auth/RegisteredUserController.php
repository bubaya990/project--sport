<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller  
{
    /**
     * Show the registration form
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telephone' => 'required|string|max:15',
            'adresse' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'ville' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'ville' => $request->ville,
            'profession' => $request->profession,
            'role' => 'participant',
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }

    /**
     * Google OAuth redirect
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)->first();
            
            if ($user) {
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'participant',
                    'email_verified_at' => now(),
                ]);
                
                Auth::login($user);
                
                return redirect()->intended('/dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Une erreur s\'est produite lors de la connexion avec Google.');
        }
    }

    /**
     * Apple OAuth redirect
     */
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    /**
     * Apple OAuth callback
     */
    public function handleAppleCallback()
    {
        try {
            $appleUser = Socialite::driver('apple')->user();
            
            $user = User::where('email', $appleUser->email)->first();
            
            if ($user) {
                Auth::login($user);
                return redirect()->intended('/dashboard');
            } else {
                $user = User::create([
                    'name' => $appleUser->name ?? 'Apple User',
                    'email' => $appleUser->email,
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'participant',
                    'email_verified_at' => now(),
                ]);
                
                Auth::login($user);
                
                return redirect()->intended('/dashboard');
            }
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Une erreur s\'est produite lors de la connexion avec Apple.');
        }
    }
}