<?php

namespace App\Http\Controllers;

use App\Models\Compound;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // Check if user is admin, moderator, or super-admin
        $isAdmin = in_array($user->role->name, ['admin', 'moderator', 'super-admin']);

        if ($isAdmin) {
            // Admin view: Show all investments with user info
            $investments = Investment::with(['user', 'user.wallet'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            // Investor view: Show only their investments
            $investments = Investment::where('user_id', auth()->id())
                ->with('profitHistories')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        $title = $isAdmin ? 'All Investments - Admin' : 'My Investments';

        return view('investments.index', compact('investments', 'isAdmin', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public.investment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Comprehensive validation
        $validated = $request->validate([
            'investment_amount' => 'required|numeric|min:500|max:9999999.99',
            'paid_amount' => 'required|numeric|min:500|max:9999999.99',
            'payment_method' => 'required|in:upi_gpay,bhim_upi,imps,neft_rtgs,net_banking',
            'upi_or_bank' => 'required|string|max:150|min:3',
            'transaction_id' => 'required|string|max:150|min:5',
            'notes' => 'nullable|string|max:500',
        ]);

        // Additional validation: paid_amount should be >= investment_amount
        if ($validated['paid_amount'] < $validated['investment_amount']) {
            return back()
                ->withInput()
                ->with('error', 'Paid amount must be equal to or greater than investment amount.');
        }

        // Check for duplicate transactions (prevent double submission)
        $existingInvestment = Investment::where('user_id', auth()->id())
            ->where('transaction_id', $validated['transaction_id'])
            ->first();

        if ($existingInvestment) {
            return back()
                ->withInput()
                ->with('warning', 'This transaction ID has already been submitted.');
        }

        try {
            DB::beginTransaction();

            // Create the investment record as pending (no transaction or wallet update until admin approves)
            $investment = Investment::create([
                'user_id' => auth()->id(),
                'investment_amount' => $validated['investment_amount'],
                'paid_amount' => $validated['paid_amount'],
                'payment_method' => $validated['payment_method'],
                'upi_id_or_bank' => $validated['upi_or_bank'],
                'transaction_id' => $validated['transaction_id'],
                'status' => 'pending',
            ]);
            Transaction::create([
                'user_id' => $investment->user_id,
                'type' => 'deposit',
                'amount' => $investment->investment_amount,
                'related_id' => $investment->id,
                'remark' => 'Investment added wating for approval - Transaction ID: ' . $investment->transaction_id,
            ]);

            DB::commit();

            return redirect()->route('investments.show', $investment->id)
                ->with('success', 'Investment submitted successfully! Your payment is pending admin approval.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded file if something goes wrong
            if (isset($paymentProof)) {
                Storage::disk('public')->delete($paymentProof);
            }

            return back()
                ->withInput()
                ->with('error', 'An error occurred while processing your investment. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        $user = auth()->user();
        $isAdmin = in_array($user->role->name, ['admin', 'moderator', 'super-admin']);

        // If not admin, ensure user can only view their own investments
        if (!$isAdmin && $investment->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $investment->load(['user', 'user.wallet', 'profitHistories']);

        $profitHistories = $investment->profitHistories()
            ->orderBy('profit_date', 'desc')
            ->get();

        return view('investments.show', compact('investment', 'profitHistories', 'isAdmin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investment $investment)
    {
        // Ensure user can only edit their own investments
        if ($investment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow editing if status is pending
        if ($investment->status !== 'pending') {
            return redirect()->route('investments.show', $investment->id)
                ->withErrors(['error' => 'Only pending investments can be edited.']);
        }

        return view('investments.edit', compact('investment'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investment $investment)
    {
        // Ensure user can only delete their own investments
        if ($investment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow deleting if status is pending
        if ($investment->status !== 'pending') {
            return redirect()->route('investments.show', $investment->id)
                ->withErrors(['error' => 'Only pending investments can be deleted.']);
        }

        try {
            DB::beginTransaction();

            // Delete payment proof file
            if ($investment->payment_proof) {
                Storage::disk('public')->delete($investment->payment_proof);
            }

            // Delete related transactions
            Transaction::where('related_id', $investment->id)->delete();

            // Delete investment
            $investment->delete();

            DB::commit();

            return redirect()->route('investments.index')
                ->with('success', 'Investment deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'An error occurred while deleting your investment. Please try again.']);
        }
    }

    /**
     * Process compound request
     */
    public function compound(Request $request)
    {
        $validated = $request->validate([
            'compound_amount' => 'required|numeric|min:1|max:9999999.99',
        ]);

        $user = auth()->user();
        $wallet = $user->wallet;

        if (!$wallet) {
            return back()->with('error', 'Wallet not found.');
        }

        // Check if compound amount is less than or equal to total profit
        if ($validated['compound_amount'] > $wallet->total_profit) {
            return back()->with('error', 'Compound amount cannot exceed your total profit of ₹' . number_format($wallet->total_profit, 2));
        }

        try {
            DB::beginTransaction();

            // Create transaction record for compound
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $validated['compound_amount'],
                'remark' => 'Compound - Profit reinvested as investment',
            ]);

            // Create compound record
            Compound::create([
                'user_id' => $user->id,
                'wallet_id' => $wallet->id,
                'transaction_id' => $transaction->id,
                'compound_amount' => $validated['compound_amount'],
                'remark' => 'Profit compounded to investment',
            ]);

            // Update wallet - increase total_investment and total_deposit, decrease total_profit
            $wallet->total_investment += $validated['compound_amount'];
            $wallet->total_deposit += $validated['compound_amount'];
            $wallet->withdrawable_amount -= $validated['compound_amount'];
            $wallet->save();

            DB::commit();

            return back()->with('success', 'Successfully compounded ₹' . number_format($validated['compound_amount'], 2) . ' to your investment!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while processing your compound request. Please try again.');
        }
    }

    /**
     * Store payment proof file with dynamic folder structure
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string The stored file path (folder/filename)
     */
    private function storePaymentProof($file)
    {
        // Generate a unique filename with timestamp and random string
        $filename = 'payment_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Store in payments folder with user_id subfolder
        $path = $file->storeAs(
            'payments',
            $filename,
            'public'
        );

        return $path; // Returns: payments/payment_1234567890_abc123def.jpg
    }
}
