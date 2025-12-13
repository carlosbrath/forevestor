@extends('layouts.master')
@section('content')
    <main class="main-content" id="mainContent">
        <div class="container-fluid px-4">
            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('withdrawals.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Withdrawals
                </a>
            </div>

            <!-- Withdrawal Request Form -->
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-wallet2 me-2"></i>Request Withdrawal
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <!-- Error/Warning/Success Messages -->
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    <strong>Please correct the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('warning'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    {{ session('warning') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Available Balance Info -->
                            <div class="alert alert-info d-flex align-items-start gap-3 mb-4">
                                <i class="bi bi-info-circle fs-4"></i>
                                <div class="flex-grow-1">
                                    <h5 class="alert-heading mb-2">Available Balance</h5>
                                    <p class="mb-2">
                                        <strong>Withdrawable Amount:</strong>
                                        <span class="fs-5 text-success">₹{{ number_format($wallet->withdrawable_amount, 2) }}</span>
                                    </p>
                                    @if($wallet->last_withdrawal_date)
                                    <p class="mb-2 small">
                                        <strong>Last Withdrawal:</strong>
                                        {{ $wallet->last_withdrawal_date->format('M d, Y') }}
                                        ({{ $wallet->last_withdrawal_date->diffForHumans() }})
                                    </p>
                                    @endif
                                    <p class="mb-0 small">
                                        You can request a withdrawal of any amount up to your withdrawable balance.
                                        Minimum withdrawal amount is ₹100.
                                    </p>
                                </div>
                            </div>

                            <!-- Withdrawal Form -->
                            <form action="{{ route('withdrawals.store') }}" method="POST">
                                @csrf

                                <!-- Amount -->
                                <div class="mb-4">
                                    <label for="amount" class="form-label fw-semibold">
                                        Withdrawal Amount <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light">₹</span>
                                        <input type="number"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            id="amount"
                                            name="amount"
                                            step="0.01"
                                            min="100"
                                            max="{{ $wallet->withdrawable_amount }}"
                                            value="{{ old('amount') }}"
                                            placeholder="Enter amount to withdraw"
                                            required>
                                    </div>
                                    @error('amount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Minimum: ₹100 | Maximum: ₹{{ number_format($wallet->withdrawable_amount, 2) }}
                                    </small>
                                </div>

                                <!-- Payment Method -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">
                                        Withdrawal Method <span class="text-danger">*</span>
                                    </label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="payment-method-option">
                                                <input type="radio"
                                                    class="btn-check"
                                                    name="method"
                                                    id="method_upi"
                                                    value="upi"
                                                    {{ old('method') === 'upi' ? 'checked' : '' }}
                                                    required>
                                                <label class="btn btn-outline-primary w-100 p-3" for="method_upi">
                                                    <i class="bi bi-phone fs-3 d-block mb-2"></i>
                                                    <strong>UPI</strong>
                                                    <p class="small text-muted mb-0">Google Pay, PhonePe, Paytm</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="payment-method-option">
                                                <input type="radio"
                                                    class="btn-check"
                                                    name="method"
                                                    id="method_bank"
                                                    value="bank_transfer"
                                                    {{ old('method') === 'bank_transfer' ? 'checked' : '' }}
                                                    required>
                                                <label class="btn btn-outline-primary w-100 p-3" for="method_bank">
                                                    <i class="bi bi-bank fs-3 d-block mb-2"></i>
                                                    <strong>Bank Transfer</strong>
                                                    <p class="small text-muted mb-0">IMPS, NEFT, RTGS</p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('method')
                                        <div class="text-danger small mt-2">
                                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- UPI ID / Bank Details -->
                                <div class="mb-4">
                                    <label for="upi_id_or_bank" class="form-label fw-semibold">
                                        UPI ID / Bank Account Details <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                        class="form-control @error('upi_id_or_bank') is-invalid @enderror"
                                        id="upi_id_or_bank"
                                        name="upi_id_or_bank"
                                        value="{{ old('upi_id_or_bank') }}"
                                        placeholder="Enter UPI ID or Bank Account Number"
                                        required>
                                    @error('upi_id_or_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        For UPI: Enter your UPI ID (e.g., yourname@paytm)<br>
                                        For Bank: Enter your account number and IFSC code (e.g., 1234567890 - SBIN0001234)
                                    </small>
                                </div>

                                <!-- Important Notes -->
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading">
                                        <i class="bi bi-exclamation-triangle me-2"></i>Important Notes
                                    </h6>
                                    <ul class="mb-0 small">
                                        <li><strong>You can only request a withdrawal once every 7 days</strong></li>
                                        <li>Withdrawal requests are processed within 24-48 hours</li>
                                        <li>Ensure your payment details are correct before submitting</li>
                                        <li>You can only have one pending withdrawal request at a time</li>
                                        <li>Once approved, the amount will be transferred to your provided account</li>
                                        <li>After approval, the amount will be deducted from your withdrawable balance</li>
                                    </ul>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="d-flex gap-3 justify-content-end mt-4">
                                    <a href="{{ route('withdrawals.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2"></i>Submit Withdrawal Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
