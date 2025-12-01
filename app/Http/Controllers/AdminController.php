<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::where('role_id', 4)->count();
        $totalInvestments = Investment::count();
        $pendingInvestments = Investment::where('status', 'pending')->get();
        $pendingInvestmentsCount = $pendingInvestments->count();
        $activeInvestments = Investment::where('status', 'approved')->count();
        $totalInvestmentAmount = Investment::sum('investment_amount');

        // Calculate total profits paid (from profit histories)
        $totalProfitsPaid = \App\Models\ProfitHistory::sum('profit_amount');

        // Get all users with their wallet and investment data
        $users = User::with(['wallet', 'investments' => function ($query) {
            $query->where('status', 'active');
        }])->where('role_id', 4)->get();

        // Calculate total earnings for each user
        $usersData = $users->map(function ($user) {
            $totalEarnings = $user->profitHistories()->sum('profit_amount');
            return [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'status' => $user->status,
                'total_investment' => $user->investments()->sum('investment_amount'),
                'total_earnings' => $totalEarnings,
                'investments_count' => $user->investments()->count(),
            ];
        });

        $title = 'Admin Dashboard - Forevestor';

        return view('dashboard.admin', compact(
            'title',
            'totalUsers',
            'totalInvestments',
            'pendingInvestmentsCount',
            'pendingInvestments',
            'activeInvestments',
            'totalInvestmentAmount',
            'totalProfitsPaid',
            'usersData'
        ));
    }

    /**
     * Show admin settings page
     */
    public function settings()
    {
        $title = 'Admin Settings - Forevestor';
        return view('admin.settings', compact('title'));
    }

    /**
     * Update admin settings
     */
    public function updateSettings(Request $request)
    {
        // Validate settings
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'min_investment' => 'required|numeric|min:0',
            'max_investment' => 'required|numeric|min:0',
            'profit_percentage' => 'required|numeric|min:0|max:100',
        ]);

        // Update settings in your settings table or config
        // For now, we'll just return success
        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully!');
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::with('role')
            ->paginate(15);

        $title = 'User Management - Forevestor';

        return view('admin.users', compact('title', 'users'));
    }

    /**
     * Show all investments
     */
    public function investments()
    {
        $investments = Investment::with('user')
            ->paginate(15);

        $title = 'Investments Management - Forevestor';

        return view('admin.investments', compact('title', 'investments'));
    }

    /**
     * Approve an investment
     */
    public function approveInvestment(Investment $investment)
    {
        $investment->update(['status' => 'approved']);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Investment approved successfully!');
    }

    /**
     * Reject an investment
     */
    public function rejectInvestment(Investment $investment)
    {
        $investment->update(['status' => 'rejected']);

        return redirect()->route('admin.investments')
            ->with('success', 'Investment rejected successfully!');
    }

    /**
     * Show super admin dashboard
     */
    public function superAdminDashboard()
    {
        $totalUsers = User::count();
        $totalInvestments = Investment::count();
        $usersByRole = User::with('role')
            ->groupBy('role_id')
            ->selectRaw('role_id, COUNT(*) as count')
            ->get();

        $title = 'Super Admin Dashboard - Forevestor';

        return view('admin.super-admin-dashboard', compact('title', 'totalUsers', 'totalInvestments', 'usersByRole'));
    }

    /**
     * Show roles management
     */
    public function roles()
    {
        $title = 'Roles Management - Forevestor';
        return view('admin.roles', compact('title'));
    }

    /**
     * Show permissions management
     */
    public function permissions()
    {
        $title = 'Permissions Management - Forevestor';
        return view('admin.permissions', compact('title'));
    }
}
