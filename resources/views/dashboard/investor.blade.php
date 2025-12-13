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
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container tradingview-container">
                        <div class="tradingview-widget-container__widget tradingview-widget">
                        </div>
                        <script type="text/javascript"
                            src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                        {
                            "allow_symbol_change": true,
                            "calendar": false,
                            "details": false,
                            "hide_side_toolbar": true,
                            "hide_top_toolbar": true,
                            "hide_legend": false,
                            "hide_volume": false,
                            "hotlist": false,
                            "interval": "D",
                            "locale": "en",
                            "save_image": false,
                            "style": "1",
                            "symbol": "NASDAQ:AAPL",
                            "theme": "light",
                            "timezone": "Etc/UTC",
                            "backgroundColor": "#ffffff",
                            "gridColor": "rgba(242, 242, 242, 0.06)",
                            "watchlist": [],
                            "withdateranges": false,
                            "compareSymbols": [],
                            "studies": [],
                            "autosize": true
                        }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
                <div class="allocation-legend">
                    <div class="legend-row">
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-1"></span>
                            <span class="legend-name">NYSE Stocks</span>
                            <span class="legend-percentage">25%</span>
                        </a>
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-2"></span>
                            <span class="legend-name">Crypto Mining</span>
                            <span class="legend-percentage">18%</span>
                        </a>
                    </div>
                    <div class="legend-row">
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-3"></span>
                            <span class="legend-name">Forex</span>
                            <span class="legend-percentage">15%</span>
                        </a>
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-4"></span>
                            <span class="legend-name">Commodities</span>
                            <span class="legend-percentage">12%</span>
                        </a>
                    </div>
                    <div class="legend-row">
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-5"></span>
                            <span class="legend-name">Copy Trading</span>
                            <span class="legend-percentage">10%</span>
                        </a>
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-6"></span>
                            <span class="legend-name">Algo Trading</span>
                            <span class="legend-percentage">10%</span>
                        </a>
                    </div>
                    <div class="legend-row">
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-7"></span>
                            <span class="legend-name">AI Projects</span>
                            <span class="legend-percentage">5%</span>
                        </a>
                        <a href="{{ route('analytic') }}" class="legend-item">
                            <span class="legend-dot legend-dot-gold-8"></span>
                            <span class="legend-name">Diversified</span>
                            <span class="legend-percentage">5%</span>
                        </a>
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
                    <a href="{{ route('withdrawals.index') }}" class="quick-action-btn withdraw">
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
    <div class="table-section">
        <div class="table-section-header">
            <h3 class="table-section-title">Compound History</h3>
        </div>
        <div class="table-section-body">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compounds as $index => $compound)
                        <tr>
                            <td class="text-gray">{{ $index + 1 }}</td>
                            <td class="table-amount-success">
                                +₹{{ number_format($compound->compound_amount, 2) }}
                            </td>
                            <td class="text-gray">
                                {{ $compound->created_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="text-gray-light">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compoundModalLabel">
                    <i class="bi bi-arrow-repeat text-primary"></i> Compound Profit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('compound') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert-box alert-box-warning">
                        <i class="bi bi-info-circle alert-box-icon alert-box-icon-warning"></i>
                        <div class="alert-box-content">
                            <p class="alert-box-text alert-box-text-warning">
                                <strong>Available Profit:</strong>
                                ₹{{ number_format($wallet->total_profit ?? 0, 2) }}
                            </p>
                            <p class="alert-box-text alert-box-text-warning mt-2">
                                You can compound any amount up to your total profit. The compounded amount will be
                                added to your investment.
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="compound_amount" class="form-label fw-medium text-gray">
                            Compound Amount <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light">₹</span>
                            <input type="number" class="form-control @error('compound_amount') is-invalid @enderror"
                                id="compound_amount" name="compound_amount" step="0.01" min="1"
                                max="{{ $wallet->total_profit ?? 0 }}" placeholder="Enter amount to compound" required>
                        </div>
                        @error('compound_amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted mt-1">
                            Maximum: ₹{{ number_format($wallet->total_profit ?? 0, 2) }}
                        </small>
                    </div>

                    <div class="alert-box alert-box-success mt-3">
                        <i class="bi bi-check-circle alert-box-icon alert-box-icon-success"></i>
                        <div class="alert-box-content">
                            <p class="alert-box-text alert-box-text-success fw-medium m-0">What happens next?</p>
                            <ul class="alert-box-list alert-box-list-success">
                                <li>The amount will be deducted from your profit</li>
                                <li>It will be added to your total investment</li>
                                <li>A transaction record will be created</li>
                                <li>You'll see it in your compound history</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
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