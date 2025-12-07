<?php

namespace App\Http\Controllers;

use App\Models\Compound;
use App\Models\Investment;
use App\Models\ProfitHistory;
use App\Models\Wallet;
use App\Models\Transaction;
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

        // Fetch investor wallet data
        $wallet = Wallet::where('user_id', $user->id)->first();

        // If wallet doesn't exist, create one
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => $user->id,
                'wallet_id' => Wallet::generateWalletId(),
                'total_deposit' => 0,
                'total_investment' => 0,
                'total_profit' => 0,
                'total_withdrawal' => 0,
                'withdrawable_amount' => 0,
            ]);
        }

        // Today's profit - get profits added today
        $todaysProfit = ProfitHistory::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->sum('profit_amount');

        // Pending approvals count
        $pendingApprovalsCount = Investment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        // Recent transactions from transactions table with investment status
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('relatedInvestment')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get compounds
        $compounds = Compound::where('user_id', $user->id)
            ->with('transaction')
            ->orderBy('created_at', 'desc')
            ->get();

        $title = 'Dashboard - Forevestor';
        return view('dashboard.investor', compact(
            'title',
            'user',
            'wallet',
            'todaysProfit',
            'pendingApprovalsCount',
            'recentTransactions',
            'compounds'
        ));
    }
}
