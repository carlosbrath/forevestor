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

            <!-- Withdrawal Details -->
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="bi bi-receipt me-2"></i>Withdrawal Details
                            </h4>
                            <span class="status-badge {{ $withdrawal->status }}">
                                @if($withdrawal->status === 'pending')
                                    <i class="bi bi-clock-history"></i>
                                @elseif($withdrawal->status === 'paid')
                                    <i class="bi bi-check-circle-fill"></i>
                                @elseif($withdrawal->status === 'rejected')
                                    <i class="bi bi-x-circle-fill"></i>
                                @endif
                                {{ ucfirst($withdrawal->status) }}
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <!-- Withdrawal ID -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">Withdrawal ID</label>
                                        <p class="detail-value">#WD-{{ str_pad($withdrawal->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">Amount</label>
                                        <p class="detail-value text-success fs-4">₹{{ number_format($withdrawal->amount, 2) }}</p>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">Payment Method</label>
                                        <p class="detail-value">
                                            <span class="payment-method-badge">
                                                <i class="bi bi-{{ $withdrawal->method === 'upi' ? 'phone' : 'bank' }}"></i>
                                                {{ ucwords(str_replace('_', ' ', $withdrawal->method)) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <!-- UPI ID / Bank Details -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">{{ $withdrawal->method === 'upi' ? 'UPI ID' : 'Bank Details' }}</label>
                                        <p class="detail-value">
                                            <code class="transaction-id">{{ $withdrawal->upi_id_or_bank }}</code>
                                        </p>
                                    </div>
                                </div>

                                <!-- Requested Date -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">Requested Date</label>
                                        <p class="detail-value">
                                            {{ $withdrawal->requested_at ? $withdrawal->requested_at->format('M d, Y h:i A') : $withdrawal->created_at->format('M d, Y h:i A') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Processed Date -->
                                @if($withdrawal->processed_at)
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <label class="detail-label">Processed Date</label>
                                        <p class="detail-value">{{ $withdrawal->processed_at->format('M d, Y h:i A') }}</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Remarks -->
                                @if($withdrawal->remarks)
                                <div class="col-12">
                                    <div class="detail-item">
                                        <label class="detail-label">Remarks</label>
                                        <p class="detail-value">{{ $withdrawal->remarks }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User & Wallet Information (Admin View) -->
                @if($isAdmin)
                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-person me-2"></i>User Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="user-info-section">
                                <div class="user-avatar-large mb-3">
                                    {{ strtoupper(substr($withdrawal->user->full_name, 0, 1)) }}
                                </div>
                                <h5 class="mb-1">{{ $withdrawal->user->full_name }}</h5>
                                <p class="text-muted small mb-3">{{ $withdrawal->user->email }}</p>

                                <hr>

                                <h6 class="mb-3"><i class="bi bi-wallet2 me-2"></i>Wallet Details</h6>

                                <div class="wallet-detail">
                                    <span class="wallet-label">Withdrawable Amount</span>
                                    <span class="wallet-value text-success">₹{{ number_format($withdrawal->user->wallet->withdrawable_amount ?? 0, 2) }}</span>
                                </div>

                                <div class="wallet-detail">
                                    <span class="wallet-label">Total Profit</span>
                                    <span class="wallet-value">₹{{ number_format($withdrawal->user->wallet->total_profit ?? 0, 2) }}</span>
                                </div>

                                <div class="wallet-detail">
                                    <span class="wallet-label">Total Withdrawal</span>
                                    <span class="wallet-value">₹{{ number_format($withdrawal->user->wallet->total_withdrawal ?? 0, 2) }}</span>
                                </div>

                                <div class="wallet-detail">
                                    <span class="wallet-label">Last Withdrawal</span>
                                    <span class="wallet-value">
                                        {{ $withdrawal->user->wallet->last_withdrawal_date ? $withdrawal->user->wallet->last_withdrawal_date->format('M d, Y') : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Admin Actions -->
            @if($isAdmin && $withdrawal->status === 'pending')
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0">
                                <i class="bi bi-gear me-2"></i>Admin Actions
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Review this withdrawal request carefully before approving or rejecting.</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Current withdrawable amount: <strong>₹{{ number_format($withdrawal->user->wallet->withdrawable_amount ?? 0, 2) }}</strong></li>
                                    <li>Requested amount: <strong>₹{{ number_format($withdrawal->amount, 2) }}</strong></li>
                                    <li>After approval, ₹{{ number_format($withdrawal->amount, 2) }} will be deducted from user's wallet</li>
                                </ul>
                            </div>

                            <div class="d-flex gap-3">
                                <!-- Approve Button -->
                                <form method="POST" action="{{ route('admin.approve-withdrawal', $withdrawal) }}" class="flex-fill">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-success btn-lg w-100"
                                        onclick="return confirm('Are you sure you want to approve this withdrawal request of ₹{{ number_format($withdrawal->amount, 2) }}? The amount will be deducted from the user\'s wallet.')">
                                        <i class="bi bi-check-circle me-2"></i>Approve & Mark as Paid
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <button type="button"
                                    class="btn btn-danger btn-lg flex-fill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rejectModal">
                                    <i class="bi bi-x-circle me-2"></i>Reject Request
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reject Modal -->
            <div class="modal fade" id="rejectModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reject Withdrawal Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.reject-withdrawal', $withdrawal) }}">
                            @csrf
                            <div class="modal-body">
                                <p>Are you sure you want to reject this withdrawal request of <strong>₹{{ number_format($withdrawal->amount, 2) }}</strong>?</p>
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Enter reason for rejection" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Reject Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    @push('style')
    <style>
        .detail-item {
            margin-bottom: 1rem;
        }

        .detail-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            margin-bottom: 0.25rem;
            display: block;
        }

        .detail-value {
            font-size: 1rem;
            color: #1f2937;
            font-weight: 600;
            margin: 0;
        }

        .user-avatar-large {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 2rem;
            margin: 0 auto;
        }

        .wallet-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .wallet-detail:last-child {
            border-bottom: none;
        }

        .wallet-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .wallet-value {
            font-weight: 600;
            color: #1f2937;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-badge.pending {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-badge.paid {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-badge.rejected {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        /* Payment Method Badge */
        .payment-method-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            background: var(--color-bg-secondary);
            border: 1px solid var(--color-border-light);
            border-radius: 6px;
            font-size: 0.85rem;
            color: var(--color-text-primary);
        }

        /* Transaction ID */
        .transaction-id {
            font-family: 'Courier New', monospace;
            font-size: 0.85rem;
            background: var(--color-bg-secondary);
            padding: 0.3rem 0.6rem;
            border-radius: 4px;
            color: var(--color-text-primary);
        }
    </style>
    @endpush
@endsection
