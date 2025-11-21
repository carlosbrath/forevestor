<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $title = 'Sign In - Login to Forevestor';
        return view('public.login', compact('title'));
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Attempt to authenticate the user
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials, $request->boolean('remember'))) {
                // Authentication successful
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'))
                    ->with('success', 'Welcome back! You have been logged in successfully.');
            }

            // Authentication failed
            return redirect()->back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->withInput();

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Login error: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()
                ->with('error', 'An error occurred during login. Please try again.')
                ->withInput();
        }
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
