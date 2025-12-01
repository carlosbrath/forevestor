@extends('layouts.master-public')
@section('title', 'Investment Form - Make Your Investment')
@section('meta_description', 'Invest in promising projects with Forevestor and start building your portfolio')
@section('content')

<!-- INVESTMENT FORM SECTION -->
<section class="investment-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="investment-title" style="color: var(--color-text-primary);">Make Your Investment</h1>
                    <p class="investment-subtitle" style="color: var(--color-text-secondary); margin-bottom: 0;">Invest
                        in projects and grow your wealth with Forevestor</p>
                </div>

                <!-- Investment Form -->
                <form id="investmentForm" method="POST" action="{{ route('investments.store') }}"
                    enctype="multipart/form-data" class="investment-form">
                    @csrf

                    <!-- Row 1: Investment Amount -->
                    <div class="mb-4">
                        <label for="investmentAmount" class="form-label fw-600"
                            style="color: var(--color-text-primary);">Investment Amount (₹) <span
                                class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control @error('investment_amount') is-invalid @enderror"
                                id="investmentAmount" name="investment_amount" placeholder="e.g., 5000" min="500"
                                step="100" value="{{ old('investment_amount') }}" required>
                        </div>
                        <small class="form-text" style="color: var(--color-text-secondary);">Minimum investment amount:
                            ₹500</small>
                        @error('investment_amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 2: Payment Method -->
                    <div class="mb-4">
                        <label for="paymentMethod" class="form-label fw-600"
                            style="color: var(--color-text-primary);">Payment Method <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-control-lg @error('payment_method') is-invalid @enderror"
                            id="paymentMethod" name="payment_method" required>
                            <option value="">Choose Payment Method</option>
                            <option value="upi_gpay" {{ old('payment_method') == 'upi_gpay' ? 'selected' : '' }}>UPI
                                (GPay/PhonePe/Paytm)</option>
                            <!-- <option value="bhim_upi" {{ old('payment_method') == 'bhim_upi' ? 'selected' : '' }}>BHIM UPI</option> -->
                            <option value="imps" {{ old('payment_method') == 'imps' ? 'selected' : '' }}>IMPS</option>
                            <!-- <option value="neft_rtgs" {{ old('payment_method') == 'neft_rtgs' ? 'selected' : '' }}>
                                NEFT/RTGS</option>
                            <option value="net_banking" {{ old('payment_method') == 'net_banking' ? 'selected' : '' }}>
                                Net Banking</option> -->
                            <option value="usdt_trc20" {{ old('payment_method') == 'usdt_trc20' ? 'selected' : '' }}>
                                USDT TRC20</option>
                        </select>
                        @error('payment_method')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 3: UPI ID / Bank Name -->
                    <div class="mb-4">
                        <label for="upiOrBank" class="form-label fw-600" style="color: var(--color-text-primary);">Your
                            UPI ID or Bank Name <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control form-control-lg @error('upi_or_bank') is-invalid @enderror"
                            id="upiOrBank" name="upi_or_bank" placeholder="rohan@ybl or HDFC Bank"
                            value="{{ old('upi_or_bank') }}" required>
                        @error('upi_or_bank')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 4: Transaction ID -->
                    <div class="mb-4">
                        <label for="transactionId" class="form-label fw-600"
                            style="color: var(--color-text-primary);">UPI Ref No. / Transaction ID <span
                                class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control form-control-lg @error('transaction_id') is-invalid @enderror"
                            id="transactionId" name="transaction_id" placeholder="UPI12345XXXX or IMPS8765XXXX"
                            value="{{ old('transaction_id') }}" required>
                        @error('transaction_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 5: Paid Amount -->
                    <div class="mb-4">
                        <label for="paidAmount" class="form-label fw-600" style="color: var(--color-text-primary);">Paid
                            Amount (₹) <span class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control @error('paid_amount') is-invalid @enderror"
                                id="paidAmount" name="paid_amount" placeholder="e.g., 5000" min="500" step="100"
                                value="{{ old('paid_amount') }}" required>
                        </div>
                        <small class="form-text" style="color: var(--color-text-secondary);">Must be equal to or greater
                            than investment amount</small>
                        @error('paid_amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 9: Notes (Optional) -->
                    <div class="mb-4">
                        <label for="notes" class="form-label fw-600" style="color: var(--color-text-primary);">Notes
                            <span class="badge bg-secondary ms-2">Optional</span></label>
                        <textarea class="form-control form-control-lg @error('notes') is-invalid @enderror" id="notes"
                            name="notes" placeholder="e.g., 'Paid via Google Pay at 4 PM'" rows="4"
                            style="resize: vertical;">{{ old('notes') }}</textarea>
                        @error('notes')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg fw-600"
                            style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                            <i class="bi bi-check-circle me-2"></i> Submit Investment
                        </button>
                    </div>

                    <!-- Back Link -->
                    <div class="text-center">
                        <p style="color: var(--color-text-secondary);">
                            Want to go back?
                            <a href="{{ route('dashboard') }}"
                                style="color: var(--color-primary); font-weight: 600;">Back to Dashboard</a>
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

@push('style')
<style>
/* Investment Section Styles */
.investment-section {
    min-height: 100vh;
    padding-top: 140px;
    padding-bottom: 60px;
    background-color: var(--color-bg-primary);
}

.investment-title {
    font-size: var(--fs-4xl);
    font-weight: var(--fw-bold);
    margin-bottom: var(--spacing-md);
    line-height: var(--lh-tight);
}

.investment-subtitle {
    font-size: var(--fs-lg);
    font-weight: var(--fw-normal);
}

/* Form Styles */
.investment-form {
    background-color: var(--color-bg-tertiary);
    padding: var(--spacing-3xl);
    border-radius: var(--radius-lg);
    border: 1px solid var(--color-border-primary);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.investment-form:hover {
    box-shadow: var(--shadow-md);
}

/* Form Label Styles */
.investment-form .form-label {
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: var(--color-text-primary);
    margin-bottom: var(--spacing-md);
    text-transform: none;
    letter-spacing: 0;
}

/* Form Control Styles */
.investment-form .form-control,
.investment-form .form-select {
    font-size: var(--fs-base);
    padding: 0.75rem 1rem;
    border: 1px solid var(--color-border-primary);
    border-radius: var(--radius-sm);
    background-color: var(--color-bg-light);
    color: var(--color-text-primary);
    transition: var(--transition-fast);
}

.investment-form .form-control:focus,
.investment-form .form-select:focus {
    border-color: var(--color-primary);
    background-color: var(--color-bg-tertiary);
    box-shadow: 0 0 0 0.25rem var(--color-primary-opacity-2);
    color: var(--color-text-primary);
}

.investment-form .form-control::placeholder {
    color: var(--color-text-muted);
}

/* Form Control Large Variant */
.investment-form .form-control-lg,
.investment-form .form-select {
    font-size: var(--fs-base);
    padding: 0.75rem 1rem;
    height: auto;
    min-height: 44px;
}

/* Input Group Styles */
.investment-form .input-group-text {
    background-color: var(--color-bg-light);
    border: 1px solid var(--color-border-primary);
    color: var(--color-text-secondary);
    font-weight: var(--fw-semibold);
}

.investment-form .input-group-lg>.input-group-text {
    padding: 0.75rem 1rem;
}

/* Submit Button */
.investment-form .btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: var(--fs-base);
    height: auto;
    min-height: 44px;
    transition: var(--transition-fast);
}

.investment-form .btn-primary:hover {
    background-color: var(--color-primary-dark) !important;
    border-color: var(--color-primary-dark) !important;
}

.investment-form .btn-primary:active {
    background-color: var(--color-primary-dark) !important;
    border-color: var(--color-primary-dark) !important;
    transform: scale(0.98);
}

/* Error Styles */
.investment-form .is-invalid {
    border-color: #dc3545;
}

.investment-form .is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.investment-form .invalid-feedback {
    font-size: var(--fs-sm);
    color: #dc3545;
    margin-top: var(--spacing-xs);
}

.investment-form .text-danger {
    color: #dc3545;
}

/* Link Styles */
.investment-form a {
    transition: var(--transition-fast);
}

.investment-form a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .investment-section {
        padding-top: 80px;
        padding-bottom: 40px;
    }

    .investment-form {
        padding: var(--spacing-2xl);
    }

    .investment-title {
        font-size: var(--fs-3xl);
    }

    .investment-subtitle {
        font-size: var(--fs-base);
    }

    .row.g-3 {
        gap: var(--spacing-lg) !important;
    }
}

@media (max-width: 576px) {
    .investment-section {
        padding-top: 70px;
    }

    .investment-form {
        padding: var(--spacing-xl);
        border-radius: var(--radius-md);
    }

    .investment-title {
        font-size: var(--fs-2xl);
    }

    .investment-subtitle {
        font-size: var(--fs-sm);
    }

    .mb-4 {
        margin-bottom: var(--spacing-2xl) !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const investmentForm = document.getElementById('investmentForm');
    const investmentAmountInput = document.getElementById('investmentAmount');
    const paidAmountInput = document.getElementById('paidAmount');
    const paymentMethodSelect = document.getElementById('paymentMethod');
    const upiOrBankInput = document.getElementById('upiOrBank');
    const transactionIdInput = document.getElementById('transactionId');
    const paymentScreenshotInput = document.getElementById('paymentScreenshot');
    const transactionDateTimeInput = document.getElementById('transactionDateTime');

    // Real-time validation for Investment Amount
    if (investmentAmountInput) {
        investmentAmountInput.addEventListener('input', function() {
            const amount = parseFloat(this.value);
            if (isNaN(amount) || amount < 500) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
            validatePaidAmount();
        });
    }

    // Real-time validation for Paid Amount
    if (paidAmountInput) {
        paidAmountInput.addEventListener('input', function() {
            validatePaidAmount();
        });
    }

    function validatePaidAmount() {
        const investmentAmount = parseFloat(investmentAmountInput.value);
        const paidAmount = parseFloat(paidAmountInput.value);

        if (isNaN(paidAmount) || paidAmount < 500) {
            paidAmountInput.classList.add('is-invalid');
        } else if (paidAmount < investmentAmount) {
            paidAmountInput.classList.add('is-invalid');
        } else {
            paidAmountInput.classList.remove('is-invalid');
        }
    }

    // Payment Method change handler
    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function() {
            const method = this.value;
            if (method === 'upi_gpay' || method === 'bhim_upi' || method === 'imps' || method ===
                'neft_rtgs' || method === 'net_banking') {
                upiOrBankInput.required = true;
                transactionIdInput.required = true;
            } else {
                upiOrBankInput.required = false;
                transactionIdInput.required = false;
            }
        });
    }

    // File upload validation
    if (paymentScreenshotInput) {
        paymentScreenshotInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const validExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (!validExtensions.includes(file.type)) {
                    this.classList.add('is-invalid');
                    alert('Please upload a valid image file (JPG, JPEG, or PNG)');
                    this.value = '';
                } else if (file.size > maxSize) {
                    this.classList.add('is-invalid');
                    alert('File size must be less than 5MB');
                    this.value = '';
                } else {
                    this.classList.remove('is-invalid');
                }
            }
        });
    }

    // Form submission validation
    if (investmentForm) {
        investmentForm.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate Investment Amount
            const investmentAmount = parseFloat(investmentAmountInput.value);
            if (isNaN(investmentAmount) || investmentAmount < 500) {
                investmentAmountInput.classList.add('is-invalid');
                isValid = false;
            }

            // Validate Paid Amount
            const paidAmount = parseFloat(paidAmountInput.value);
            if (isNaN(paidAmount) || paidAmount < 500 || paidAmount < investmentAmount) {
                paidAmountInput.classList.add('is-invalid');
                isValid = false;
            }

            // Validate Payment Method
            if (!paymentMethodSelect.value) {
                paymentMethodSelect.classList.add('is-invalid');
                isValid = false;
            }

            // Validate UPI/Bank field
            if (!upiOrBankInput.value.trim()) {
                upiOrBankInput.classList.add('is-invalid');
                isValid = false;
            }

            // Validate Transaction ID
            if (!transactionIdInput.value.trim()) {
                transactionIdInput.classList.add('is-invalid');
                isValid = false;
            }




            if (!isValid) {
                e.preventDefault();
                console.log('Form validation failed');
            }
        });
    }

    // Set max date to today for transaction date
    if (transactionDateTimeInput) {
        const now = new Date();
        const isoDateTime = now.toISOString().slice(0, 16);
        transactionDateTimeInput.max = isoDateTime;
    }
});
</script>
@endpush

@endsection