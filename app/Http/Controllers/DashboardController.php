<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard based on user role
     */
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $userRole = $user->role?->name;

        // Route to appropriate dashboard based on role
        if (in_array($userRole, ['super-admin', 'admin', 'moderator'])) {
            return redirect()->route('admin.dashboard');
        }

        $title = 'Dashboard - Forevestor';
        return view('dashboard.investor', compact('title'));
    }
}
