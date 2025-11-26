@extends('layouts.master')
@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="welcome-text">
                <h2>Admin Dashboard</h2>
                <p>System Overview & Management</p>
            </div>
            <div class="user-profile">
                <div class="top-actions">
                    <button class="action-btn">
                        <i class="bi bi-gear"></i>
                    </button>
                </div>
                <div class="user-avatar">AD</div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-header">
                    <div class="stat-icon primary">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>{{ $totalUsers }}</h3>
                    <p class="stat-label">Total Users</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Active Users</span>
                    </div>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-header">
                    <div class="stat-icon success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>${{ number_format($totalInvestmentAmount, 2) }}</h3>
                    <p class="stat-label">Total Investments</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>{{ $totalInvestments }} total</span>
                    </div>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-header">
                    <div class="stat-icon warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>{{ $pendingInvestmentsCount }}</h3>
                    <p class="stat-label">Pending Approvals</p>
                    <div class="stat-change">
                        <i class="bi bi-dash"></i>
                        <span>Requires attention</span>
                    </div>
                </div>
            </div>

            <div class="stat-card danger">
                <div class="stat-header">
                    <div class="stat-icon danger">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>${{ number_format($totalProfitsPaid, 2) }}</h3>
                    <p class="stat-label">Total Profits Paid</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Distributed</span>
                    </div>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-header">
                    <div class="stat-icon info">
                        <i class="bi bi-check-circle"></i>
                    </div>
                </div>
                <div class="stat-value">
                    <h3>{{ $activeInvestments }}</h3>
                    <p class="stat-label">Active Investments</p>
                    <div class="stat-change positive">
                        <i class="bi bi-arrow-up"></i>
                        <span>Currently Active</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Investment & Profit Trends</h3>
                        <div class="chart-filter">
                            <button class="filter-btn active">7D</button>
                            <button class="filter-btn">1M</button>
                            <button class="filter-btn">3M</button>
                            <button class="filter-btn">1Y</button>
                        </div>
                    </div>
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Investment Status</h3>
                    </div>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Section -->
        <div class="table-container mb-4">
            <div class="table-header">
                <h3><i class="bi bi-hourglass-split me-2"></i>Pending Approvals ({{ $pendingInvestmentsCount }})</h3>
            </div>
        </div>

        <div class="pending-grid">
            @forelse($pendingInvestments as $investment)
                <div class="pending-card">
                    <div class="pending-header">
                        <div class="user-info">
                            <div class="user-avatar-small">
                                {{ strtoupper(substr($investment->user->full_name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $investment->user->full_name)[1] ?? '', 0, 1)) }}
                            </div>
                            <div>
                                <strong>{{ $investment->user->full_name }}</strong>
                                <p class="text-muted small mb-0">{{ $investment->user->email }}</p>
                            </div>
                        </div>
                        <div class="pending-amount">${{ number_format($investment->investment_amount, 2) }}</div>
                    </div>
                    <div class="pending-details">
                        <div class="detail-row">
                            <span class="detail-label">Date Submitted:</span>
                            <span>{{ $investment->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Account:</span>
                            <span>{{ $investment->upi_id_or_bank ? '****' . substr($investment->upi_id_or_bank, -4) : 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Payment Method:</span>
                            <span>{{ ucfirst($investment->payment_method) }}</span>
                        </div>
                    </div>
                    @if($investment->payment_proof_url)
                        <img src="{{ Storage::url($investment->payment_proof) }}" alt="Receipt" class="receipt-preview" onclick="viewReceipt(this.src)">
                    @endif
                    <div class="action-buttons">
                        <form method="POST" action="{{ route('admin.approve-investment', $investment) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-approve">
                                <i class="bi bi-check-circle"></i>
                                Approve
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.reject-investment', $investment) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-reject" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-x-circle"></i>
                                Reject
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 20px;">
                    <p class="text-muted">No pending approvals</p>
                </div>
            @endforelse
        </div>

        <!-- User Management Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>User Management</h3>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search users..." id="userSearch">
                </div>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Total Investment</th>
                            <th>Total Earnings</th>
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        @forelse($usersData as $user)
                            <tr>
                                <td>#USR-{{ str_pad($user['id'], 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $user['full_name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>${{ number_format($user['total_investment'], 2) }}</td>
                                <td>${{ number_format($user['total_earnings'], 2) }}</td>
                                <td>{{ $user['created_at']->format('M d, Y') }}</td>
                                <td>
                                    <span class="status-badge {{ $user['status'] === 'active' ? 'active' : 'rejected' }}">
                                        {{ ucfirst($user['status']) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="action-icon" title="View"><i class="bi bi-eye"></i></button>
                                    {{-- <button class="action-icon" title="Edit"><i class="bi bi-pencil"></i></button> --}}
                                    <button class="action-icon" title="Delete"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 20px;">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
