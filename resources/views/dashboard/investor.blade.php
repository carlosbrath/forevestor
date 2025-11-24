@extends('layouts.master')
@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="welcome-text">
                <h2>Welcome Back, John!</h2>
                <p>Here's what's happening with your investments today</p>
            </div>
            <div class="user-profile">
                <a href="{{ route('investments.create') }}" class="invest-now-btn">
                    <span class="invest-btn-border"></span>
                    <span class="invest-btn-text">
                        <i class="bi bi-lightning-charge-fill"></i>
                        Invest Now
                    </span>
                </a>
                <button class="notification-btn">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-avatar">JD</div>
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
                    <h3>$45,280</h3>
                    <p class="stat-label">Total Investment</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>+12.5% from last month</span>
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
                    <h3>$4,892</h3>
                    <p class="stat-label">Total Earnings</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>+8.3% this week</span>
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
                    <h3>$452</h3>
                    <p class="stat-label">Today's Profit</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>1% daily return</span>
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
                    <h3>2</h3>
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
                        <tr>
                            <td>#TXN-001234</td>
                            <td>Nov 20, 2025</td>
                            <td>$5,000</td>
                            <td>Investment</td>
                            <td><span class="status-badge approved">Approved</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>#TXN-001235</td>
                            <td>Nov 19, 2025</td>
                            <td>$50</td>
                            <td>Profit</td>
                            <td><span class="status-badge approved">Approved</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>#TXN-001236</td>
                            <td>Nov 18, 2025</td>
                            <td>$3,000</td>
                            <td>Investment</td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>#TXN-001237</td>
                            <td>Nov 17, 2025</td>
                            <td>$45</td>
                            <td>Profit</td>
                            <td><span class="status-badge approved">Approved</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                        </tr>
                        <tr>
                            <td>#TXN-001238</td>
                            <td>Nov 16, 2025</td>
                            <td>$2,000</td>
                            <td>Investment</td>
                            <td><span class="status-badge rejected">Rejected</span></td>
                            <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                        </tr>
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
                            <label class="form-label">Investment Amount ($)</label>
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
