<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of withdrawals.
     */
    public function index()
    {
        $user = auth()->user();

        // Check if user is admin, moderator, or super-admin
        $isAdmin = in_array($user->role->name, ['admin', 'moderator', 'super-admin']);

        if ($isAdmin) {
            // Admin view: Show all withdrawals with user info
            $withdrawals = Withdrawal::with(['user', 'user.wallet'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            // Investor view: Show only their withdrawals
            $withdrawals = Withdrawal::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        $title = $isAdmin ? 'All Withdrawals - Admin' : 'My Withdrawals';

        return view('withdrawals.index', compact('withdrawals', 'isAdmin', 'title'));
    }

    /**
     * Show the form for creating a new withdrawal request.
     */
    public function create()
    {
        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            return redirect()->route('dashboard')
                ->with('error', 'Wallet not found.');
        }

        // Check if there's enough withdrawable amount
        if ($wallet->withdrawable_amount <= 0) {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have any withdrawable amount.');
        }

        return view('withdrawals.create', compact('wallet'));
    }

    /**
     * Store a newly created withdrawal request.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'amount' => 'required|numeric|min:100|max:9999999.99',
            'method' => 'required|in:upi,bank_transfer',
            'upi_id_or_bank' => 'required|string|max:150|min:3',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            return back()->with('error', 'Wallet not found.');
        }

        // Check if withdrawable amount is available
        if ($wallet->withdrawable_amount <= 0) {
            return back()
                ->withInput()
                ->with('error', 'You do not have any withdrawable amount.');
        }

        // Validate withdrawal amount against wallet's withdrawable amount
        if ($validated['amount'] > $wallet->withdrawable_amount) {
            return back()
                ->withInput()
                ->with('error', 'Withdrawal amount cannot exceed your withdrawable amount of ₹' . number_format($wallet->withdrawable_amount, 2));
        }

        // Check for pending withdrawal requests
        $hasPendingWithdrawal = Withdrawal::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($hasPendingWithdrawal) {
            return back()
                ->withInput()
                ->with('warning', 'You already have a pending withdrawal request. Please wait for it to be processed.');
        }

        // Check if user can request withdrawal (once a week restriction)
        if ($wallet->last_withdrawal_date) {
            $daysSinceLastWithdrawal = $wallet->last_withdrawal_date->diffInDays(now());
            if ($daysSinceLastWithdrawal < 7) {
                $daysRemaining = ceil(7 - $daysSinceLastWithdrawal);
                $dayText = $daysRemaining == 1 ? 'day' : 'days';
                return back()
                    ->withInput()
                    ->with('error', "You can only request a withdrawal once a week. Please wait {$daysRemaining} more {$dayText}.");
            }
        }

        try {
            DB::beginTransaction();

            // Create withdrawal request
            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'upi_id_or_bank' => $validated['upi_id_or_bank'],
                'status' => 'pending',
                'requested_at' => now(),
            ]);

            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'withdrawal',
                'amount' => $validated['amount'],
                'related_id' => $withdrawal->id,
                'remark' => 'Withdrawal request pending approval - Amount: ₹' . number_format($validated['amount'], 2),
            ]);

            DB::commit();

            return redirect()->route('withdrawals.index')
                ->with('success', 'Withdrawal request submitted successfully! Please wait for admin approval.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'An error occurred while processing your withdrawal request. Please try again.');
        }
    }

    /**
     * Display the specified withdrawal.
     */
    public function show(Withdrawal $withdrawal)
    {
        $user = auth()->user();
        $isAdmin = in_array($user->role->name, ['admin', 'moderator', 'super-admin']);

        // If not admin, ensure user can only view their own withdrawals
        if (!$isAdmin && $withdrawal->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $withdrawal->load(['user', 'user.wallet']);

        return view('withdrawals.show', compact('withdrawal', 'isAdmin'));
    }

    /**
     * Approve withdrawal request (Admin only)
     */
    public function approve(Withdrawal $withdrawal)
    {
        // Ensure user is admin
        $user = auth()->user();
        if (!in_array($user->role->name, ['admin', 'moderator', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        // Only pending withdrawals can be approved
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be approved.');
        }

        $wallet = $withdrawal->user->wallet;

        if (!$wallet) {
            return back()->with('error', 'User wallet not found.');
        }

        // Check if user has enough withdrawable amount
        if ($withdrawal->amount > $wallet->withdrawable_amount) {
            return back()->with('error', 'User does not have enough withdrawable amount.');
        }

        try {
            DB::beginTransaction();

            // Update withdrawal status
            $withdrawal->update([
                'status' => 'paid',
                'processed_at' => now(),
                'remarks' => 'Approved and paid by ' . $user->full_name,
            ]);

            // Update wallet - deduct from withdrawable_amount, add to total_withdrawal
            // Note: total_profit remains unchanged as it represents all-time cumulative profit
            $wallet->withdrawable_amount -= $withdrawal->amount;
            $wallet->total_withdrawal += $withdrawal->amount;
            $wallet->last_withdrawal_date = now();
            $wallet->save();

            // Update transaction record
            Transaction::where('related_id', $withdrawal->id)
                ->where('type', 'withdrawal')
                ->update([
                    'remark' => 'Withdrawal approved and paid - Amount: ₹' . number_format($withdrawal->amount, 2),
                ]);

            DB::commit();

            return redirect()->route('withdrawals.index')
                ->with('success', 'Withdrawal approved and marked as paid successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while approving the withdrawal. Please try again.');
        }
    }

    /**
     * Reject withdrawal request (Admin only)
     */
    public function reject(Request $request, Withdrawal $withdrawal)
    {
        // Ensure user is admin
        $user = auth()->user();
        if (!in_array($user->role->name, ['admin', 'moderator', 'super-admin'])) {
            abort(403, 'Unauthorized');
        }

        // Only pending withdrawals can be rejected
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        $remarks = $request->input('remarks', 'Rejected by admin');

        try {
            DB::beginTransaction();

            // Update withdrawal status
            $withdrawal->update([
                'status' => 'rejected',
                'processed_at' => now(),
                'remarks' => $remarks,
            ]);

            // Update transaction record
            Transaction::where('related_id', $withdrawal->id)
                ->where('type', 'withdrawal')
                ->update([
                    'remark' => 'Withdrawal request rejected - Reason: ' . $remarks,
                ]);

            DB::commit();

            return redirect()->route('withdrawals.index')
                ->with('success', 'Withdrawal request rejected.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while rejecting the withdrawal. Please try again.');
        }
    }
}
