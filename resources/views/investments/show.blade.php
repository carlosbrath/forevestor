@extends('layouts.master')
@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="welcome-text">
                <h2>Investment Details</h2>
                <p>View your investment information and profit history</p>
            </div>
            <div class="user-profile">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2" style="padding: 0.5rem 1rem; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-house-door"></i>
                    Visit Website
                </a>
                <a href="{{ route('investments.index') }}" class="btn btn-outline-primary me-2" style="padding: 0.5rem 1rem; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-arrow-left"></i>
                    Back to List
                </a>
                <a href="{{ route('investments.create') }}" class="invest-now-btn">
                    <span class="invest-btn-border"></span>
                    <span class="invest-btn-text">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Invest Now
                    </span>
                </a>
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->full_name, 0, 2)) }}</div>
            </div>
        </div>

        <!-- Status Alert -->
        @if($investment->status === 'pending')
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Pending Approval</strong> Your investment is waiting for admin verification.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif($investment->status === 'approved')
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Approved!</strong> Your investment has been verified and activated.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif($investment->status === 'rejected')
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px;">
                <i class="bi bi-x-circle-fill me-2"></i>
                <strong>Rejected</strong> Your investment could not be verified. Please contact support.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <!-- Investment Details Section -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Investment Information</h3>
                    </div>
                    <div class="p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="bi bi-hash me-2"></i>Transaction ID
                                    </label>
                                    <p class="detail-value">{{ $investment->transaction_id }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="bi bi-bank me-2"></i>UPI/Bank Details
                                    </label>
                                    <p class="detail-value">{{ $investment->upi_id_or_bank }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="bi bi-calendar-event me-2"></i>Submitted At
                                    </label>
                                    <p class="detail-value">{{ $investment->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>

                            @if($investment->approved_at)
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="bi bi-check-circle me-2"></i>Approved At
                                        </label>
                                        <p class="detail-value">{{ $investment->approved_at->format('d M Y, h:i A') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($investment->profit_cycle_start)
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">
                                            <i class="bi bi-graph-up-arrow me-2"></i>Profit Cycle Start
                                        </label>
                                        <p class="detail-value">{{ $investment->profit_cycle_start->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label class="detail-label">
                                        <i class="bi bi-credit-card me-2"></i>Payment Method
                                    </label>
                                    <p class="detail-value">{{ ucfirst(str_replace('_', ' ', $investment->payment_method)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-4 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="p-4">
                        @if($investment->status === 'pending')
                            <div class="d-grid gap-3">
                                <a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-primary" style="border-radius: 10px; padding: 12px;">
                                    <i class="bi bi-pencil me-2"></i> Edit Investment
                                </a>
                                <form method="POST" action="{{ route('investments.destroy', $investment->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this investment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100" style="border-radius: 10px; padding: 12px;">
                                        <i class="bi bi-trash me-2"></i> Delete Investment
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-info mb-0" style="border-radius: 10px;">
                                <i class="bi bi-info-circle me-2"></i>
                                This investment has been {{ $investment->status }}. No actions available.
                            </div>
                        @endif

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 10px;">
                                <i class="bi bi-speedometer2 me-2"></i> Go to Dashboard
                            </a>
                            <a href="{{ route('investments.index') }}" class="btn btn-outline-secondary" style="border-radius: 10px; padding: 10px;">
                                <i class="bi bi-list-ul me-2"></i> View All Investments
                            </a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </main>

@endsection
