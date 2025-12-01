<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\ProfitHistory;
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

        // Fetch investor data
        $totalInvestment = Investment::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'active'])
            ->sum('investment_amount');

        $totalEarnings = ProfitHistory::where('user_id', $user->id)
            ->sum('profit_amount');

        // Today's profit - get profits added today
        $todaysProfit = ProfitHistory::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->sum('profit_amount');

        // Pending approvals count
        $pendingApprovalsCount = Investment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Recent transactions - combining investments and profits
        $recentInvestments = Investment::where('user_id', $user->id)
            ->select('id', 'investment_amount as amount', 'status', 'created_at')
            ->selectRaw("'investment' as type")
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentProfits = ProfitHistory::where('user_id', $user->id)
            ->select('id', 'profit_amount as amount', 'created_at')
            ->selectRaw("'profit' as type")
            ->selectRaw("'approved' as status")
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Merge and sort transactions
        $recentTransactions = $recentInvestments->merge($recentProfits)
            ->sortByDesc('created_at')
            ->take(5);

        $title = 'Dashboard - Forevestor';
        return view('dashboard.investor', compact(
            'title',
            'user',
            'totalInvestment',
            'totalEarnings',
            'todaysProfit',
            'pendingApprovalsCount',
            'recentTransactions'
        ));
    }
}
