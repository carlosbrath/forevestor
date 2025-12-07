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
                            <option value="imps" {{ old('payment_method') == 'imps' ? 'selected' : '' }}>IMPS</option>
                            <option value="usdt_trc20" {{ old('payment_method') == 'usdt_trc20' ? 'selected' : '' }}>
                                USDT TRC20</option>
                        </select>
                        @error('payment_method')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Payment Information Section (Dynamic) -->
                    <div id="paymentInfoSection" class="mb-4" style="display: none;">
                        <div class="payment-info-card">
                            <div class="payment-info-header">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                <h5 class="mb-0">Payment Instructions</h5>
                            </div>

                            <div class="payment-info-body">
                                <div class="alert alert-warning mb-3" id="paymentMessage">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span id="paymentMessageText"></span>
                                </div>

                                <!-- Account Selection -->
                                <div class="mb-3" id="accountSelectionDiv">
                                    <label for="accountSelect" class="form-label fw-600">
                                        Select Account <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="accountSelect">
                                        <option value="">Choose an account</option>
                                    </select>
                                </div>

                                <!-- Account Details Display -->
                                <div id="accountDetailsDiv" style="display: none;">
                                    <div class="account-details-box">
                                        <div class="account-detail-row">
                                            <span class="detail-label">Account Type:</span>
                                            <span class="detail-value" id="accountType"></span>
                                        </div>
                                        <div class="account-detail-row">
                                            <span class="detail-label" id="accountLabel">Account:</span>
                                            <div class="copy-container">
                                                <span class="detail-value" id="accountValue"></span>
                                                <button type="button" class="copy-btn" id="copyBtn" onclick="copyToClipboard()">
                                                    <i class="bi bi-clipboard"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                        <div class="account-detail-row" id="accountNameRow" style="display: none;">
                                            <span class="detail-label">Account Name:</span>
                                            <span class="detail-value" id="accountName"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

/* Payment Information Card */
.payment-info-card {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    border: 2px solid var(--color-primary);
    border-radius: var(--radius-md);
    overflow: hidden;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.payment-info-header {
    background: var(--color-primary);
    color: white;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
}

.payment-info-header h5 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
}

.payment-info-body {
    padding: 1.5rem;
}

.account-details-box {
    background: var(--color-bg-light);
    border: 1px solid var(--color-border-primary);
    border-radius: var(--radius-sm);
    padding: 1.25rem;
    margin-top: 1rem;
}

.account-detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--color-border-primary);
}

.account-detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: var(--color-text-secondary);
    font-size: 0.9rem;
}

.detail-value {
    font-weight: 600;
    color: var(--color-text-primary);
    font-size: 1rem;
    font-family: 'Courier New', monospace;
}

.copy-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.copy-btn {
    background: var(--color-primary);
    color: white;
    border: none;
    padding: 0.4rem 0.9rem;
    border-radius: var(--radius-sm);
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.copy-btn:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.copy-btn.copied {
    background: #28a745;
}

.alert-warning {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    color: var(--color-text-primary);
    padding: 1rem;
    border-radius: var(--radius-sm);
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

    .account-detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .copy-container {
        width: 100%;
        justify-content: space-between;
    }

    .detail-value {
        font-size: 0.85rem;
        word-break: break-all;
    }

    .payment-info-body {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Hardcoded Payment Accounts
const paymentAccounts = {
    upi_gpay: [
        {
            id: 'upi1',
            name: 'Primary UPI Account',
            account: 'demo.user@okaxis',
            accountName: 'Forevestor Investment',
            type: 'UPI'
        },
        {
            id: 'upi2',
            name: 'Secondary UPI Account',
            account: 'invest@paytm',
            accountName: 'Forevestor Inc',
            type: 'UPI'
        }
    ],
    imps: [
        {
            id: 'imps1',
            name: 'HDFC Bank Account',
            account: '123456789012',
            accountName: 'Forevestor Investment Pvt Ltd',
            type: 'IMPS',
            ifsc: 'HDFC0001234'
        },
        {
            id: 'imps2',
            name: 'ICICI Bank Account',
            account: '987654321098',
            accountName: 'Forevestor Inc',
            type: 'IMPS',
            ifsc: 'ICIC0001234'
        }
    ],
    usdt_trc20: [
        {
            id: 'usdt1',
            name: 'Primary USDT Wallet',
            account: 'TQmMscsP9V6K4UAbcXHzyJq7eF9wZ5xR9D',
            accountName: 'Forevestor Crypto Wallet',
            type: 'USDT TRC20'
        }
    ]
};

// Copy to Clipboard Function
function copyToClipboard() {
    const accountValue = document.getElementById('accountValue').textContent;
    navigator.clipboard.writeText(accountValue).then(function() {
        const copyBtn = document.getElementById('copyBtn');
        const originalHTML = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Copied!';
        copyBtn.classList.add('copied');

        setTimeout(function() {
            copyBtn.innerHTML = originalHTML;
            copyBtn.classList.remove('copied');
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy: ' + err);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const investmentForm = document.getElementById('investmentForm');
    const investmentAmountInput = document.getElementById('investmentAmount');
    const paidAmountInput = document.getElementById('paidAmount');
    const paymentMethodSelect = document.getElementById('paymentMethod');
    const upiOrBankInput = document.getElementById('upiOrBank');
    const transactionIdInput = document.getElementById('transactionId');
    const paymentScreenshotInput = document.getElementById('paymentScreenshot');
    const transactionDateTimeInput = document.getElementById('transactionDateTime');

    // Payment Info Elements
    const paymentInfoSection = document.getElementById('paymentInfoSection');
    const paymentMessageText = document.getElementById('paymentMessageText');
    const accountSelect = document.getElementById('accountSelect');
    const accountDetailsDiv = document.getElementById('accountDetailsDiv');

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

            // Handle payment info section
            if (method && paymentAccounts[method]) {
                showPaymentInfo(method);
            } else {
                paymentInfoSection.style.display = 'none';
                accountDetailsDiv.style.display = 'none';
            }

            // Original validation logic
            if (method === 'upi_gpay' || method === 'bhim_upi' || method === 'imps' || method ===
                'neft_rtgs' || method === 'net_banking' || method === 'usdt_trc20') {
                upiOrBankInput.required = true;
                transactionIdInput.required = true;
            } else {
                upiOrBankInput.required = false;
                transactionIdInput.required = false;
            }
        });
    }

    // Account Selection change handler
    if (accountSelect) {
        accountSelect.addEventListener('change', function() {
            const selectedAccountId = this.value;
            const paymentMethod = paymentMethodSelect.value;

            if (selectedAccountId && paymentAccounts[paymentMethod]) {
                const account = paymentAccounts[paymentMethod].find(acc => acc.id === selectedAccountId);
                if (account) {
                    showAccountDetails(account);
                }
            } else {
                accountDetailsDiv.style.display = 'none';
            }
        });
    }

    // Function to show payment info section
    function showPaymentInfo(method) {
        const accounts = paymentAccounts[method];
        const investmentAmount = parseFloat(investmentAmountInput.value) || 0;

        // Update message
        if (investmentAmount > 0) {
            paymentMessageText.textContent = `Please send amount of ₹${investmentAmount.toLocaleString('en-IN')} to one of our accounts below:`;
        } else {
            paymentMessageText.textContent = 'Please enter your investment amount and select an account below:';
        }

        // Clear and populate account select
        accountSelect.innerHTML = '<option value="">Choose an account</option>';
        accounts.forEach(account => {
            const option = document.createElement('option');
            option.value = account.id;
            option.textContent = account.name;
            accountSelect.appendChild(option);
        });

        // Show payment info section
        paymentInfoSection.style.display = 'block';
        accountDetailsDiv.style.display = 'none';
    }

    // Function to show account details
    function showAccountDetails(account) {
        document.getElementById('accountType').textContent = account.type;
        document.getElementById('accountValue').textContent = account.account;

        if (account.type === 'IMPS') {
            document.getElementById('accountLabel').textContent = 'Account Number:';
            document.getElementById('accountNameRow').style.display = 'flex';
            document.getElementById('accountName').textContent = account.accountName + ' (IFSC: ' + account.ifsc + ')';
        } else if (account.type === 'UPI') {
            document.getElementById('accountLabel').textContent = 'UPI ID:';
            document.getElementById('accountNameRow').style.display = 'flex';
            document.getElementById('accountName').textContent = account.accountName;
        } else if (account.type === 'USDT TRC20') {
            document.getElementById('accountLabel').textContent = 'Wallet Address:';
            document.getElementById('accountNameRow').style.display = 'flex';
            document.getElementById('accountName').textContent = account.accountName;
        }

        accountDetailsDiv.style.display = 'block';
    }

    // Update payment message when investment amount changes
    if (investmentAmountInput) {
        investmentAmountInput.addEventListener('input', function() {
            const paymentMethod = paymentMethodSelect.value;
            if (paymentMethod && paymentAccounts[paymentMethod] && paymentInfoSection.style.display !== 'none') {
                const investmentAmount = parseFloat(this.value) || 0;
                if (investmentAmount > 0) {
                    paymentMessageText.textContent = `Please send amount of ₹${investmentAmount.toLocaleString('en-IN')} to one of our accounts below:`;
                } else {
                    paymentMessageText.textContent = 'Please enter your investment amount and select an account below:';
                }
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