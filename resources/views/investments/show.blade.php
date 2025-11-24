@extends('layouts.master-public')
@section('title', 'Investment Details - ' . $investment->id)
@section('content')

<section class="investment-details-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="mb-0" style="color: var(--color-text-primary);">Investment Details</h1>
                    <a href="{{ route('investments.index') }}" class="btn btn-outline-secondary">Back to List</a>
                </div>

                <!-- Status Alert -->
                @if($investment->status === 'pending')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Pending Approval</strong> Your investment is waiting for admin verification.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @elseif($investment->status === 'approved')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Approved!</strong> Your investment has been verified and activated.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @elseif($investment->status === 'rejected')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Rejected</strong> Your investment could not be verified. Please contact support.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Investment Card -->
                <div class="card mb-4" style="border: 1px solid var(--color-border-primary);">
                    <div class="card-header" style="background-color: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border-primary);">
                        <h5 class="mb-0" style="color: var(--color-text-primary);">Investment #{{ $investment->id }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Investment Amount</label>
                                <h6 style="color: var(--color-text-primary);">₹{{ number_format($investment->investment_amount, 2) }}</h6>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Paid Amount</label>
                                <h6 style="color: var(--color-text-primary);">₹{{ number_format($investment->paid_amount, 2) }}</h6>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Payment Method</label>
                                <p style="color: var(--color-text-primary);" class="mb-0">{{ ucfirst(str_replace('_', ' ', $investment->payment_method)) }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Status</label>
                                <p class="mb-0">
                                    <span class="badge bg-{{ $investment->status === 'approved' ? 'success' : ($investment->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($investment->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Transaction ID</label>
                                <p style="color: var(--color-text-primary);" class="mb-0 text-break">{{ $investment->transaction_id }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">UPI/Bank</label>
                                <p style="color: var(--color-text-primary);" class="mb-0 text-break">{{ $investment->upi_id_or_bank }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Transaction Date & Time</label>
                                <p style="color: var(--color-text-primary);" class="mb-0">{{ $investment->transaction_datetime->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Submitted At</label>
                                <p style="color: var(--color-text-primary);" class="mb-0">{{ $investment->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            @if($investment->approved_at)
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Approved At</label>
                                    <p style="color: var(--color-text-primary);" class="mb-0">{{ $investment->approved_at->format('d M Y, h:i A') }}</p>
                                </div>
                            @endif
                            @if($investment->profit_cycle_start)
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small">Profit Cycle Start</label>
                                    <p style="color: var(--color-text-primary);" class="mb-0">{{ $investment->profit_cycle_start->format('d M Y') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment Proof -->
                <div class="card mb-4" style="border: 1px solid var(--color-border-primary);">
                    <div class="card-header" style="background-color: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border-primary);">
                        <h5 class="mb-0" style="color: var(--color-text-primary);">Payment Proof</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ Storage::url($investment->payment_proof) }}" alt="Payment Screenshot" class="img-fluid" style="max-height: 400px; border-radius: var(--radius-md);">
                    </div>
                </div>

                <!-- Profit History -->
                @if($profitHistories->count() > 0)
                    <div class="card mb-4" style="border: 1px solid var(--color-border-primary);">
                        <div class="card-header" style="background-color: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border-primary);">
                            <h5 class="mb-0" style="color: var(--color-text-primary);">Profit History</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background-color: var(--color-bg-secondary);">
                                    <tr>
                                        <th style="color: var(--color-text-primary);">Date</th>
                                        <th style="color: var(--color-text-primary);">Profit Amount</th>
                                        <th style="color: var(--color-text-primary);">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($profitHistories as $profit)
                                        <tr>
                                            <td>{{ $profit->profit_date->format('d M Y') }}</td>
                                            <td style="color: var(--color-text-primary);">₹{{ number_format($profit->profit_amount, 2) }}</td>
                                            <td style="color: var(--color-text-primary);">{{ number_format($profit->percentage, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                @if($investment->status === 'pending')
                    <div class="d-flex gap-2">
                        <a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil me-2"></i> Edit Investment
                        </a>
                        <form method="POST" action="{{ route('investments.destroy', $investment->id) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this investment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i> Delete Investment
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection
