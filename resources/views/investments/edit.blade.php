@extends('layouts.master-public')
@section('title', 'Edit Investment - #' . $investment->id)
@section('content')

<section class="investment-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="investment-title" style="color: var(--color-text-primary);">Edit Investment</h1>
                    <p class="investment-subtitle" style="color: var(--color-text-secondary);">Update your investment details</p>
                </div>

                <!-- Edit Form -->
                <form method="POST" action="{{ route('investments.update', $investment->id) }}" enctype="multipart/form-data" class="investment-form">
                    @csrf
                    @method('PUT')

                    <!-- Investment Amount -->
                    <div class="mb-4">
                        <label for="investmentAmount" class="form-label fw-600" style="color: var(--color-text-primary);">Investment Amount (₹) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control @error('investment_amount') is-invalid @enderror" id="investmentAmount" name="investment_amount" placeholder="e.g., 5000" min="500" step="100" value="{{ old('investment_amount', $investment->investment_amount) }}" required>
                        </div>
                        @error('investment_amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label for="paymentMethod" class="form-label fw-600" style="color: var(--color-text-primary);">Payment Method <span class="text-danger">*</span></label>
                        <select class="form-select form-control-lg @error('payment_method') is-invalid @enderror" id="paymentMethod" name="payment_method" required>
                            <option value="">Choose Payment Method</option>
                            <option value="upi_gpay" {{ old('payment_method', $investment->payment_method) == 'upi_gpay' ? 'selected' : '' }}>UPI (GPay/PhonePe/Paytm)</option>
                            <option value="bhim_upi" {{ old('payment_method', $investment->payment_method) == 'bhim_upi' ? 'selected' : '' }}>BHIM UPI</option>
                            <option value="imps" {{ old('payment_method', $investment->payment_method) == 'imps' ? 'selected' : '' }}>IMPS</option>
                            <option value="neft_rtgs" {{ old('payment_method', $investment->payment_method) == 'neft_rtgs' ? 'selected' : '' }}>NEFT/RTGS</option>
                            <option value="net_banking" {{ old('payment_method', $investment->payment_method) == 'net_banking' ? 'selected' : '' }}>Net Banking</option>
                        </select>
                        @error('payment_method')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- UPI ID / Bank Name -->
                    <div class="mb-4">
                        <label for="upiOrBank" class="form-label fw-600" style="color: var(--color-text-primary);">Your UPI ID or Bank Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('upi_or_bank') is-invalid @enderror" id="upiOrBank" name="upi_or_bank" placeholder="rohan@ybl or HDFC Bank" value="{{ old('upi_or_bank', $investment->upi_id_or_bank) }}" required>
                        @error('upi_or_bank')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Transaction ID -->
                    <div class="mb-4">
                        <label for="transactionId" class="form-label fw-600" style="color: var(--color-text-primary);">UPI Ref No. / Transaction ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('transaction_id') is-invalid @enderror" id="transactionId" name="transaction_id" placeholder="UPI12345XXXX or IMPS8765XXXX" value="{{ old('transaction_id', $investment->transaction_id) }}" required>
                        @error('transaction_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Paid Amount -->
                    <div class="mb-4">
                        <label for="paidAmount" class="form-label fw-600" style="color: var(--color-text-primary);">Paid Amount (₹) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control @error('paid_amount') is-invalid @enderror" id="paidAmount" name="paid_amount" placeholder="e.g., 5000" min="500" step="100" value="{{ old('paid_amount', $investment->paid_amount) }}" required>
                        </div>
                        <small class="form-text" style="color: var(--color-text-secondary);">Must be equal to or greater than investment amount</small>
                        @error('paid_amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Payment Screenshot -->
                    <div class="mb-4">
                        <label for="paymentScreenshot" class="form-label fw-600" style="color: var(--color-text-primary);">Payment Screenshot <span class="text-muted">(Leave empty to keep current)</span></label>

                        @if($investment->payment_proof)
                            <div class="mb-3">
                                <small class="text-muted">Current Screenshot:</small>
                                <div class="mt-2">
                                    <img src="{{ Storage::url($investment->payment_proof) }}" alt="Current Payment Proof" style="max-height: 150px; border-radius: var(--radius-md); border: 1px solid var(--color-border-primary);">
                                </div>
                            </div>
                        @endif

                        <input type="file" class="form-control form-control-lg @error('payment_screenshot') is-invalid @enderror" id="paymentScreenshot" name="payment_screenshot" accept=".jpg,.jpeg,.png">
                        <small class="form-text" style="color: var(--color-text-secondary);">Accepted formats: JPG, JPEG, PNG (Max 5MB)</small>
                        @error('payment_screenshot')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Transaction Date & Time -->
                    <div class="mb-4">
                        <label for="transactionDateTime" class="form-label fw-600" style="color: var(--color-text-primary);">Transaction Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control form-control-lg @error('transaction_date_time') is-invalid @enderror" id="transactionDateTime" name="transaction_date_time" value="{{ old('transaction_date_time', $investment->transaction_datetime->format('Y-m-d\TH:i')) }}" required>
                        @error('transaction_date_time')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-600" style="color: var(--color-text-primary);">Notes <span class="badge bg-secondary ms-2">Optional</span></label>
                        <textarea class="form-control form-control-lg @error('notes') is-invalid @enderror" id="notes" name="notes" placeholder="e.g., 'Paid via Google Pay at 4 PM'" rows="4" style="resize: vertical;">{{ old('notes', $investment->transactions()->where('type', 'deposit')->first()?->remark) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg fw-600" style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                            <i class="bi bi-check-circle me-2"></i> Update Investment
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('investments.show', $investment->id) }}" style="color: var(--color-primary);">Back to Investment Details</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

@endsection
