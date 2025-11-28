<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RegistrationController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        $title = 'Sign Up - Create Your Account';
        return view('public.register', compact('title'));
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'referral_code' => 'nullable|string|max:50',
            'terms_agreed' => 'required|accepted',
        ], [
            'email.unique' => 'This email is already registered.',
            'phone.unique' => 'This phone number is already registered.',
            'password.confirmed' => 'Passwords do not match.',
            'terms_agreed.required' => 'You must accept the terms and conditions.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Store CNIC images
            $cnicFrontPath = null;
            $cnicBackPath = null;

            // if ($request->hasFile('cnic_front_image')) {
            //     $cnicFrontPath = $request->file('cnic_front_image')->store('cnic/front', 'public');
            // }

            // if ($request->hasFile('cnic_back_image')) {
            //     $cnicBackPath = $request->file('cnic_back_image')->store('cnic/back', 'public');
            // }

            // Get the investor role
            $investorRole = Role::where('name', 'investor')->first();

            // Create new user
            $user = new \App\Models\User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->referral_code = $request->referral_code;
            $user->terms_agreed = true;
            $user->email_verified_at = null; // Email not verified yet
            $user->status = 'active'; // Account pending verification
            $user->role_id = $investorRole?->id; // Assign investor role
            $user->save();

            // Redirect to login with success message
            return redirect()->route('login')->with('success', 'Account created successfully! Please log in with your credentials.');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Registration error: ' . $e->getMessage());

            // Redirect back with error message
            return redirect()->back()
                ->with('error', 'An error occurred during registration. Please try again.')
                ->withInput();
        }
    }
}
