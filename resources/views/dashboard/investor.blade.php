@extends('layouts.master')
@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="welcome-text">
                <h2>Welcome Back, {{ $user->full_name }}!</h2>
                <p>Here's what's happening with your investments today</p>
            </div>
            <div class="user-profile">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2" style="padding: 0.5rem 1rem; border-radius: 8px; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="bi bi-house-door"></i>
                    Visit Website
                </a>
                <a href="{{ route('investments.create') }}" class="invest-now-btn">
                    <span class="invest-btn-border"></span>
                    <span class="invest-btn-text">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Invest Now
                    </span>
                </a>

                <div class="user-avatar">{{ strtoupper(substr($user->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $user->full_name)[1] ?? '', 0, 1)) }}</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon primary">
                        <i class="bi bi-wallet2"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>₹{{ number_format($totalInvestment, 2) }}</h3>
                    <p class="stat-label">Total Investment</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Active investments</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon success">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>₹{{ number_format($totalEarnings, 2) }}</h3>
                    <p class="stat-label">Total Earnings</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Lifetime earnings</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon warning">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>₹{{ number_format($todaysProfit, 2) }}</h3>
                    <p class="stat-label">Today's Profit</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Earned today</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon danger">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>{{ $pendingApprovalsCount }}</h3>
                    <p class="stat-label">Pending Approvals</p>
                    <div class="stat-change">
                        <i class="bi bi-dash"></i>
                        <span>Awaiting verification</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Profit Overview</h3>
                        <div class="chart-filter">
                            <button class="filter-btn active">7D</button>
                            <button class="filter-btn">1M</button>
                            <button class="filter-btn">3M</button>
                            <button class="filter-btn">1Y</button>
                        </div>
                    </div>
                    <canvas id="profitChart"></canvas>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Investment Distribution</h3>
                    </div>
                    <canvas id="distributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="table-container">
            <div class="table-header">
                <h3>Recent Transactions</h3>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td>#{{ strtoupper($transaction->type) }}-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                <td>₹{{ number_format($transaction->amount, 2) }}</td>
                                <td>{{ ucfirst($transaction->type) }}</td>
                                <td>
                                    <span class="status-badge {{ $transaction->status }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px;">
                                    No transactions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Investment Modal -->
    <div class="modal fade" id="investmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit New Investment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="investmentForm">
                        <div class="form-group">
                            <label class="form-label">Investment Amount (₹)</label>
                            <input type="number" class="form-control" placeholder="Enter amount" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Bank Account Details</label>
                            <input type="text" class="form-control" placeholder="Account holder name" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Account number" required>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Bank name" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload Bank Receipt/Proof</label>
                            <div class="file-upload" id="fileUpload">
                                <i class="bi bi-cloud-upload"></i>
                                <p>Click to upload or drag and drop</p>
                                <p class="text-muted small">PNG, JPG or PDF (MAX. 5MB)</p>
                                <input type="file" id="receiptFile" accept="image/*,.pdf" hidden>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control" rows="3" placeholder="Enter any additional information"></textarea>
                        </div>

                        <button type="submit" class="btn-primary">
                            <i class="bi bi-check-circle me-2"></i>
                            Submit Investment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
