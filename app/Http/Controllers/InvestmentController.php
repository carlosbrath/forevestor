<?php

namespace App\Http\Controllers;

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
        $investments = Investment::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('investments.index', compact('investments'));
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
                ->withErrors(['paid_amount' => 'Paid amount must be equal to or greater than investment amount.']);
        }

        // Check for duplicate transactions (prevent double submission)
        $existingInvestment = Investment::where('user_id', auth()->id())
            ->where('transaction_id', $validated['transaction_id'])
            ->first();

        if ($existingInvestment) {
            return back()
                ->withInput()
                ->withErrors(['transaction_id' => 'This transaction ID has already been submitted.']);
        }

        try {
            DB::beginTransaction();

            // Create the investment record
            $investment = Investment::create([
                'user_id' => auth()->id(),
                'investment_amount' => $validated['investment_amount'],
                'paid_amount' => $validated['paid_amount'],
                'payment_method' => $validated['payment_method'],
                'upi_id_or_bank' => $validated['upi_or_bank'],
                'transaction_id' => $validated['transaction_id'],
                'status' => 'pending',
            ]);

            // Create a transaction record for deposit
            Transaction::create([
                'user_id' => auth()->id(),
                'type' => 'deposit',
                'amount' => $validated['investment_amount'],
                'related_id' => $investment->id,
                'remark' => $validated['notes'] ?? null,
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
                ->withErrors(['error' => 'An error occurred while processing your investment. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        // Ensure user can only view their own investments
        if ($investment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $profitHistories = $investment->profitHistories()
            ->orderBy('profit_date', 'desc')
            ->get();

        return view('investments.show', compact('investment', 'profitHistories'));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investment $investment)
    {
        // Ensure user can only update their own investments
        if ($investment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Only allow updating if status is pending
        if ($investment->status !== 'pending') {
            return redirect()->route('investments.show', $investment->id)
                ->withErrors(['error' => 'Only pending investments can be edited.']);
        }

        $validated = $request->validate([
            'investment_amount' => 'required|numeric|min:500|max:9999999.99',
            'paid_amount' => 'required|numeric|min:500|max:9999999.99',
            'payment_method' => 'required|in:upi_gpay,bhim_upi,imps,neft_rtgs,net_banking',
            'upi_or_bank' => 'required|string|max:150|min:3',
            'transaction_id' => 'required|string|max:150|min:5',
            'payment_screenshot' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'transaction_date_time' => 'required|date_format:Y-m-d\TH:i|before_or_equal:now',
            'investment_plan' => 'nullable|in:1_percent_daily,1_5_percent_daily,30_day_roi,45_day_fixed',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validated['paid_amount'] < $validated['investment_amount']) {
            return back()
                ->withInput()
                ->withErrors(['paid_amount' => 'Paid amount must be equal to or greater than investment amount.']);
        }

        try {
            DB::beginTransaction();

            // Handle new screenshot if provided
            $paymentProof = $investment->payment_proof;
            if ($request->hasFile('payment_screenshot')) {
                // Delete old proof
                Storage::disk('public')->delete($investment->payment_proof);
                // Store new proof
                $paymentProof = $this->storePaymentProof($request->file('payment_screenshot'));
            }

            // Update investment
            $investment->update([
                'investment_amount' => $validated['investment_amount'],
                'paid_amount' => $validated['paid_amount'],
                'payment_method' => $validated['payment_method'],
                'upi_id_or_bank' => $validated['upi_or_bank'],
                'transaction_id' => $validated['transaction_id'],
                'payment_proof' => $paymentProof,
                'transaction_datetime' => $validated['transaction_date_time'],
            ]);

            // Update related transaction
            $investment->transactions()->where('type', 'deposit')->first()->update([
                'amount' => $validated['investment_amount'],
                'remark' => $validated['notes'] ?? null,
            ]);

            DB::commit();

            return redirect()->route('investments.show', $investment->id)
                ->with('success', 'Investment updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while updating your investment. Please try again.']);
        }
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
