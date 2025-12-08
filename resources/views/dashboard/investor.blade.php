@extends('layouts.master')
{{-- Dashboard --}}
@section('content')
<main class="main-content" id="mainContent">
    <!-- Stats Cards -->
    <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card p-2">
                <div class="stat-content">
                    <div class="stat-header d-flex justify-content-between">
                        <span class="stat-label small">Total Investment</span>
                        <div class="stat-icon primary">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                    <h6 class="stat-value fs-6 mt-2">₹{{ number_format($wallet->total_investment ?? 0, 2) }}</h6>
                    <div class="stat-meta d-flex align-items-center gap-1 small">
                        <i class="bi bi-info-circle"></i>
                        <span class="stat-change positive">Active investments</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card p-2">
                <div class="stat-content">
                    <div class="stat-header d-flex justify-content-between">
                        <span class="stat-label small">Withdrawable Amount</span>
                        <div class="stat-icon warning">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <h6 class="stat-value fs-6 mt-2">₹{{ number_format($wallet->withdrawable_amount ?? 0, 2) }}</h6>
                    <div class="stat-meta d-flex align-items-center gap-1 small">
                        <i class="bi bi-check-circle"></i>
                        <span class="stat-change positive">Available now</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card p-2">
                <div class="stat-content">
                    <div class="stat-header d-flex justify-content-between">
                        <span class="stat-label small">Daily Profit</span>
                        <div class="stat-icon success">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                    <h6 class="stat-value fs-6 mt-2">₹{{ number_format($todaysProfit, 2) }}</h6>
                    <div class="stat-meta d-flex align-items-center gap-1 small">
                        <i class="bi bi-arrow-up"></i>
                        <span class="stat-change positive">8.2% vs yesterday</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="stat-card p-2">
                <div class="stat-content">
                    <div class="stat-header d-flex justify-content-between">
                        <span class="stat-label small">Total Profit</span>
                        <div class="stat-icon info">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                    <h6 class="stat-value fs-6 mt-2">₹{{ number_format($wallet->total_profit ?? 0, 2) }}</h6>
                    <div class="stat-meta d-flex align-items-center gap-1 small">
                        <i class="bi bi-arrow-up"></i>
                        <span class="stat-change positive">Total earnings</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Total Withdrawn Banner -->
    <div class="withdrawn-banner mt-4 mb-3">
        <div class="withdrawn-content ">
            <div class="withdrawn-info">
                <h4>Total Withdrawn</h4>
                <h2>₹{{ number_format($wallet->total_withdrawal ?? 0, 2) }}</h2>
                <p>Lifetime earnings withdrawn to your bank</p>
            </div>
            <div class="withdrawn-icon">
                <i class="bi bi-wallet2"></i>
            </div>
        </div>
    </div>
    <!-- Portfolio Allocation & Quick Actions Row -->
    <div class="portfolio-quick-row">
        <!-- Portfolio Allocation -->
        <div class="portfolio-allocation-card">
            <div class="card-header">
                <h3>Portfolio Allocation</h3>
            </div>
            <div class="allocation-content">
                <div class="chart-wrapper">
                    <canvas id="allocationChart"></canvas>
                </div>
                <div class="allocation-legend">
                    <div class="legend-row">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #b8860b;"></span>
                            <span class="legend-name">NYSE Stocks</span>
                            <span class="legend-percentage">25%</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #c9a532;"></span>
                            <span class="legend-name">Crypto Mining</span>
                            <span class="legend-percentage">18%</span>
                        </div>
                    </div>
                    <div class="legend-row">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #dda125;"></span>
                            <span class="legend-name">Forex</span>
                            <span class="legend-percentage">15%</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #d4a628;"></span>
                            <span class="legend-name">Commodities</span>
                            <span class="legend-percentage">12%</span>
                        </div>
                    </div>
                    <div class="legend-row">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #9a7510;"></span>
                            <span class="legend-name">Copy Trading</span>
                            <span class="legend-percentage">10%</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #b89520;"></span>
                            <span class="legend-name">Algo Trading</span>
                            <span class="legend-percentage">10%</span>
                        </div>
                    </div>
                    <div class="legend-row">
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #c5a02a;"></span>
                            <span class="legend-name">AI Projects</span>
                            <span class="legend-percentage">5%</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot" style="background: #d0ab35;"></span>
                            <span class="legend-name">Diversified</span>
                            <span class="legend-percentage">5%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Transactions -->
        <div class="quick-recent-column">
            <!-- Quick Actions -->
            <div class="quick-actions-card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions-grid">
                    {{-- <a href="" class="quick-action-btn deposit">
                        <i class="bi bi-download"></i>
                        <span>Deposit</span>
                    </a> --}}
                    <a href="" class="quick-action-btn withdraw">
                        <i class="bi bi-upload"></i>
                        <span>Withdraw</span>
                    </a>
                    <a href="#" class="quick-action-btn compound" data-bs-toggle="modal"
                        data-bs-target="#compoundModal">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Compound</span>
                    </a>
                    <a href="{{ route('investments.create') }}" class="quick-action-btn invest">
                        <i class="bi bi-plus-circle"></i>
                        <span>Invest</span>
                    </a>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="recent-transactions-card">
                <div class="card-header">
                    <h3>Recent Transactions</h3>
                    <a href="" class="view-all-link">View All</a>
                </div>
                <div class="transactions-list">
                    @forelse($recentTransactions ?? [] as $transaction)
                    @php
                    $status = $transaction->relatedInvestment
                    ? $transaction->relatedInvestment->status
                    : 'completed';
                    $statusClass = match ($status) {
                    'approved' => 'completed',
                    'pending' => 'processing',
                    'rejected' => 'failed',
                    default => 'completed',
                    };
                    @endphp
                    <div class="transaction-item">
                        <div
                            class="transaction-icon {{ in_array($transaction->type, ['deposit', 'profit']) ? 'deposit' : 'withdraw' }}">
                            <i
                                class="bi bi-{{ in_array($transaction->type, ['deposit', 'profit']) ? 'download' : 'upload' }}"></i>
                        </div>
                        <div class="transaction-details">
                            <h4>{{ ucfirst($transaction->type) }}</h4>
                            <p>{{ $transaction->created_at->format('M d, Y') }}</p>
                        </div>
                        <div
                            class="transaction-amount {{ in_array($transaction->type, ['deposit', 'profit']) ? 'positive' : 'negative' }}">
                            <div class="amount-value">
                                {{ in_array($transaction->type, ['deposit', 'profit']) ? '+' : '-' }}₹{{ number_format($transaction->amount, 2) }}
                            </div>
                            <div class="amount-status {{ $statusClass }}">
                                {{ ucfirst($status) }}</div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Compounds Section -->
    @if($compounds->count() > 0)
    <div class="compounds-section" style="margin-top: 2rem;">
        <div class="card-header"
            style="background: white; padding: 1.5rem; border-radius: 12px 12px 0 0; border-bottom: 1px solid #e5e7eb;">
            <h3 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">Compound History</h3>
        </div>
        <div style="background: white; border-radius: 0 0 12px 12px; overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <th
                                style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280;">
                                #</th>
                            <th
                                style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280;">
                                Amount</th>
                            <th
                                style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280;">
                                Date</th>
                            <th
                                style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: #6b7280;">
                                Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compounds as $index => $compound)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 1rem; color: #374151; font-size: 0.875rem;">{{ $index + 1 }}</td>
                            <td style="padding: 1rem; color: #059669; font-weight: 600; font-size: 0.875rem;">
                                +₹{{ number_format($compound->compound_amount, 2) }}
                            </td>
                            <td style="padding: 1rem; color: #374151; font-size: 0.875rem;">
                                {{ $compound->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td style="padding: 1rem; color: #6b7280; font-size: 0.875rem;">
                                {{ $compound->remark ?? 'Profit compounded to investment' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</main>

<!-- Compound Modal -->
<div class="modal fade" id="compoundModal" tabindex="-1" aria-labelledby="compoundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid #e5e7eb; padding: 1.5rem;">
                <h5 class="modal-title" id="compoundModalLabel" style="font-weight: 600; color: #1f2937;">
                    <i class="bi bi-arrow-repeat" style="color: #b8860b;"></i> Compound Profit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('compound') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding: 1.5rem;">
                    <div
                        style="background: #fef3c7; border: 1px solid #fbbf24; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
                        <div style="display: flex; align-items: start; gap: 0.75rem;">
                            <i class="bi bi-info-circle" style="color: #d97706; font-size: 1.25rem;"></i>
                            <div style="flex: 1;">
                                <p style="margin: 0; color: #78350f; font-size: 0.875rem; line-height: 1.5;">
                                    <strong>Available Profit:</strong>
                                    ₹{{ number_format($wallet->total_profit ?? 0, 2) }}
                                </p>
                                <p style="margin: 0.5rem 0 0 0; color: #78350f; font-size: 0.875rem;">
                                    You can compound any amount up to your total profit. The compounded amount will be
                                    added to your investment.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="compound_amount" class="form-label"
                            style="font-weight: 500; color: #374151; margin-bottom: 0.5rem;">
                            Compound Amount <span style="color: #dc2626;">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f9fafb; border-right: 0;">₹</span>
                            <input type="number" class="form-control @error('compound_amount') is-invalid @enderror"
                                id="compound_amount" name="compound_amount" step="0.01" min="1"
                                max="{{ $wallet->total_profit ?? 0 }}" placeholder="Enter amount to compound" required
                                style="border-left: 0;">
                        </div>
                        @error('compound_amount')
                        <div class="invalid-feedback d-block" style="font-size: 0.875rem;">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted"
                            style="font-size: 0.75rem; margin-top: 0.25rem; display: block;">
                            Maximum: ₹{{ number_format($wallet->total_profit ?? 0, 2) }}
                        </small>
                    </div>

                    <div
                        style="background: #f0fdf4; border: 1px solid #86efac; border-radius: 8px; padding: 1rem; margin-top: 1rem;">
                        <div style="display: flex; align-items: start; gap: 0.75rem;">
                            <i class="bi bi-check-circle" style="color: #16a34a; font-size: 1.25rem;"></i>
                            <div style="flex: 1;">
                                <p style="margin: 0; color: #14532d; font-size: 0.875rem; font-weight: 500;">What
                                    happens next?</p>
                                <ul
                                    style="margin: 0.5rem 0 0 0; padding-left: 1.25rem; color: #166534; font-size: 0.875rem; line-height: 1.6;">
                                    <li>The amount will be deducted from your profit</li>
                                    <li>It will be added to your total investment</li>
                                    <li>A transaction record will be created</li>
                                    <li>You'll see it in your compound history</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"
                    style="border-top: 1px solid #e5e7eb; padding: 1rem 1.5rem; background: #f9fafb;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="padding: 0.5rem 1rem; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="btn btn-primary"
                        style="background: #b8860b; border: none; padding: 0.5rem 1.5rem; border-radius: 6px;">
                        <i class="bi bi-arrow-repeat"></i> Compound Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush