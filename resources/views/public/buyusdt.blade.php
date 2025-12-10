@extends('layouts.master')
@section('title', 'Buy USDT')
@section('content')
    <main class="main-content" id="mainContent">
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="mb-4">
                <h2 class="mb-2">
                    <i class="bi bi-currency-exchange me-2"></i>Buy USDT
                </h2>
                <p class="text-muted">Purchase USDT at competitive rates with instant delivery</p>
            </div>

            <!-- Hero Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-3">
                                        <i class="bi bi-lightning-charge me-2"></i>Instant USDT Purchase
                                    </h3>
                                    <p class="mb-3">Get USDT instantly at the best rates in the market. Safe, secure, and
                                        hassle-free transactions.</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill me-2"></i>Best exchange rates
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill me-2"></i>Instant delivery to your wallet
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill me-2"></i>24/7 customer support
                                        </li>
                                        <li class="mb-2">
                                            <i class="bi bi-check-circle-fill me-2"></i>Secure and verified transactions
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="p-4 bg-white bg-opacity-10 rounded">
                                        <h4 class="mb-2">Current Rate</h4>
                                        <h2 class="mb-0">₹84.50</h2>
                                        <p class="mb-0 small">per USDT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- USDT Purchase Packages -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="bi bi-box-seam me-2"></i>Quick Purchase Packages
                    </h4>
                </div>

                <!-- Package 1 - Starter -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-star me-2"></i>Starter Package
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h2 class="text-primary">100 USDT</h2>
                                <p class="text-muted mb-0">≈ ₹8,450</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Instant delivery
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>0% transaction fee
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Email support
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Secure transfer
                                </li>
                            </ul>
                            <button class="btn btn-primary w-100" disabled>
                                <i class="bi bi-cart-plus me-2"></i>Buy Now
                            </button>
                            <small class="text-muted d-block mt-2 text-center">Coming Soon</small>
                        </div>
                    </div>
                </div>

                <!-- Package 2 - Standard -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100" style="border: 2px solid #667eea !important;">
                        <div class="card-header text-white" style="background: #667eea;">
                            <h5 class="mb-0">
                                <i class="bi bi-trophy me-2"></i>Standard Package
                                <span class="badge bg-warning float-end">Popular</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h2 style="color: #667eea;">500 USDT</h2>
                                <p class="text-muted mb-0">≈ ₹42,250</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Priority delivery
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>0% transaction fee
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Priority support
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Bonus: 5 USDT extra
                                </li>
                            </ul>
                            <button class="btn w-100" style="background: #667eea; color: white;" disabled>
                                <i class="bi bi-cart-plus me-2"></i>Buy Now
                            </button>
                            <small class="text-muted d-block mt-2 text-center">Coming Soon</small>
                        </div>
                    </div>
                </div>

                <!-- Package 3 - Premium -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-gem me-2"></i>Premium Package
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h2 class="text-success">1000 USDT</h2>
                                <p class="text-muted mb-0">≈ ₹84,500</p>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Instant delivery
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>0% transaction fee
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>VIP support 24/7
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>Bonus: 15 USDT extra
                                </li>
                            </ul>
                            <button class="btn btn-success w-100" disabled>
                                <i class="bi bi-cart-plus me-2"></i>Buy Now
                            </button>
                            <small class="text-muted d-block mt-2 text-center">Coming Soon</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Amount Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-calculator me-2"></i>Custom Amount Purchase
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Enter Amount (USDT)</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">USDT</span>
                                        <input type="number" class="form-control" placeholder="Enter amount" min="10"
                                            id="usdtAmount" disabled>
                                    </div>
                                    <small class="text-muted">Minimum: 10 USDT</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">You Pay (INR)</label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">₹</span>
                                        <input type="text" class="form-control" placeholder="0.00" readonly
                                            id="inrAmount">
                                    </div>
                                    <small class="text-muted">Rate: 1 USDT = ₹84.50</small>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-lg btn-primary" disabled>
                                        <i class="bi bi-cart-check me-2"></i>Proceed to Payment
                                    </button>
                                    <span class="ms-3 text-muted">Feature Coming Soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- How it Works -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="mb-3">
                        <i class="bi bi-info-circle me-2"></i>How It Works
                    </h4>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div
                                    style="width: 60px; height: 60px; border-radius: 50%; background: #667eea; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                                    1
                                </div>
                            </div>
                            <h5>Select Package</h5>
                            <p class="text-muted small mb-0">Choose your desired USDT amount or enter custom amount</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div
                                    style="width: 60px; height: 60px; border-radius: 50%; background: #667eea; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                                    2
                                </div>
                            </div>
                            <h5>Make Payment</h5>
                            <p class="text-muted small mb-0">Pay using UPI, Net Banking, or Bank Transfer</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div
                                    style="width: 60px; height: 60px; border-radius: 50%; background: #667eea; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                                    3
                                </div>
                            </div>
                            <h5>Verification</h5>
                            <p class="text-muted small mb-0">Our team verifies your payment within minutes</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div
                                    style="width: 60px; height: 60px; border-radius: 50%; background: #667eea; color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: bold; margin: 0 auto;">
                                    4
                                </div>
                            </div>
                            <h5>Receive USDT</h5>
                            <p class="text-muted small mb-0">USDT is instantly transferred to your wallet</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h5 class="alert-heading">
                            <i class="bi bi-exclamation-circle me-2"></i>Important Information
                        </h5>
                        <ul class="mb-0">
                            <li>Current exchange rate: 1 USDT = ₹84.50 (rates may vary)</li>
                            <li>Minimum purchase: 10 USDT</li>
                            <li>Processing time: Instant to 15 minutes</li>
                            <li>Make sure to provide correct wallet address</li>
                            <li>All transactions are secured and encrypted</li>
                            <li>For any queries, contact our 24/7 support team</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        // Calculate INR amount when USDT amount changes
        document.getElementById('usdtAmount')?.addEventListener('input', function() {
            const usdtAmount = parseFloat(this.value) || 0;
            const rate = 84.50;
            const inrAmount = usdtAmount * rate;
            document.getElementById('inrAmount').value = inrAmount.toFixed(2);
        });
    </script>
    @endpush
@endsection
