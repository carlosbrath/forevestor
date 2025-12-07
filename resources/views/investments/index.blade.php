@extends('layouts.master')
@section('content')
    <main class="main-content" id="mainContent">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-header">
                        <span class="stat-label">Total Investments</span>
                        <div class="stat-icon primary">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                    <h3 class="stat-value">{{ $stats['total_investments'] }}</h3>
                    <div class="stat-meta">
                        <i class="bi bi-info-circle"></i>
                        <span class="stat-change">{{ $isAdmin ? 'All Users' : 'Your Investments' }}</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-header">
                        <span class="stat-label">Total Amount</span>
                        <div class="stat-icon success">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                    </div>
                    <h3 class="stat-value">₹{{ number_format($stats['total_amount'], 2) }}</h3>
                    <div class="stat-meta">
                        <i class="bi bi-arrow-up"></i>
                        <span class="stat-change positive">Total Invested</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-header">
                        <span class="stat-label">Pending</span>
                        <div class="stat-icon warning">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                    <h3 class="stat-value">{{ $stats['pending_count'] }}</h3>
                    <div class="stat-meta">
                        <i class="bi bi-clock"></i>
                        <span class="stat-change">Awaiting Approval</span>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-header">
                        <span class="stat-label">Approved</span>
                        <div class="stat-icon info">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                    <h3 class="stat-value">{{ $stats['approved_count'] }}</h3>
                    <div class="stat-meta">
                        <i class="bi bi-check-circle-fill"></i>
                        <span class="stat-change positive">Active</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Investments Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>
                    <i class="bi bi-list-ul me-2"></i>
                    {{ $isAdmin ? 'All Investments' : 'My Investments' }}
                </h3>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search investments..." id="investmentSearch">
                </div>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Investment ID</th>
                            @if($isAdmin)
                                <th>User</th>
                            @endif
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="investmentTableBody">
                        @forelse($investments as $investment)
                            <tr>
                                <td>#INV-{{ str_pad($investment->id, 4, '0', STR_PAD_LEFT) }}</td>
                                @if($isAdmin)
                                    <td>
                                        <div class="user-info-inline">
                                            <div class="user-avatar-tiny">
                                                {{ strtoupper(substr($investment->user->full_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong>{{ $investment->user->full_name }}</strong>
                                                <p class="text-muted small mb-0">{{ $investment->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <strong class="amount-highlight">₹{{ number_format($investment->investment_amount, 2) }}</strong>
                                </td>
                                <td>
                                    <span class="payment-method-badge">
                                        <i class="bi bi-credit-card"></i>
                                        {{ ucwords(str_replace('_', ' ', $investment->payment_method)) }}
                                    </span>
                                </td>
                                <td>
                                    <code class="transaction-id">{{ $investment->transaction_id }}</code>
                                </td>
                                <td>{{ $investment->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="status-badge {{ $investment->status }}">
                                        @if($investment->status === 'pending')
                                            <i class="bi bi-clock-history"></i>
                                        @elseif($investment->status === 'approved')
                                            <i class="bi bi-check-circle-fill"></i>
                                        @elseif($investment->status === 'rejected')
                                            <i class="bi bi-x-circle-fill"></i>
                                        @endif
                                        {{ ucfirst($investment->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('investments.show', $investment) }}" class="action-icon" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($isAdmin && $investment->status === 'pending')
                                        <form method="POST" action="{{ route('admin.approve-investment', $investment) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-icon success" title="Approve">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject-investment', $investment) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-icon danger" title="Reject" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? '8' : '7' }}" style="text-align: center; padding: 40px;">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-text-muted);"></i>
                                    <p class="text-muted mt-3">No investments found</p>
                                    @if(!$isAdmin)
                                        <a href="{{ route('investments.create') }}" class="btn btn-primary mt-3">
                                            <i class="bi bi-plus-circle me-2"></i>Make Your First Investment
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($investments->hasPages())
                <div class="pagination-container">
                    {{ $investments->links() }}
                </div>
            @endif
        </div>
    </main>

    @push('style')
    <style>
        /* User Info Inline */
        .user-info-inline {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar-tiny {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        /* Amount Highlight */
        .amount-highlight {
            color: var(--color-primary);
            font-size: 1.05rem;
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

        .payment-method-badge i {
            font-size: 0.9rem;
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

        .status-badge.approved,
        .status-badge.active {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .status-badge.rejected {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        /* Action Icons */
        .action-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 1px solid var(--color-border-light);
            border-radius: 6px;
            background: var(--color-bg-secondary);
            color: var(--color-text-primary);
            cursor: pointer;
            transition: all 0.2s ease;
            margin-right: 0.3rem;
        }

        .action-icon:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .action-icon.success {
            color: #28a745;
            border-color: #28a745;
        }

        .action-icon.success:hover {
            background: #28a745;
            color: white;
        }

        .action-icon.danger {
            color: #dc3545;
            border-color: #dc3545;
        }

        .action-icon.danger:hover {
            background: #dc3545;
            color: white;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            padding: 1.5rem;
            border-top: 1px solid var(--color-border-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .user-info-inline {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Search functionality
        document.getElementById('investmentSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('#investmentTableBody tr');

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
    @endpush
@endsection
