@extends('layouts.master')
@section('content')
    <main class="main-content" id="mainContent">
        <!-- Withdrawals Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>
                    <i class="bi bi-list-ul me-2"></i>
                    {{ $isAdmin ? 'All Withdrawals' : 'My Withdrawals' }}
                </h3>
                <div class="d-flex gap-2 align-items-center">
                    @if(!$isAdmin)
                        <a href="{{ route('withdrawals.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Request Withdrawal
                        </a>
                    @endif
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search withdrawals..." id="withdrawalSearch">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Withdrawal ID</th>
                            @if($isAdmin)
                                <th>User</th>
                            @endif
                            <th>Amount</th>
                            <th>Method</th>
                            <th>UPI/Bank Details</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="withdrawalTableBody">
                        @forelse($withdrawals as $withdrawal)
                            <tr>
                                <td>#WD-{{ str_pad($withdrawal->id, 4, '0', STR_PAD_LEFT) }}</td>
                                @if($isAdmin)
                                    <td>
                                        <div class="user-info-inline">
                                            <div class="user-avatar-tiny">
                                                {{ strtoupper(substr($withdrawal->user->full_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong>{{ $withdrawal->user->full_name }}</strong>
                                                <p class="text-muted small mb-0">{{ $withdrawal->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                <td>
                                    <strong class="amount-highlight">₹{{ number_format($withdrawal->amount, 2) }}</strong>
                                </td>
                                <td>
                                    <span class="payment-method-badge">
                                        <i class="bi bi-{{ $withdrawal->method === 'upi' ? 'phone' : 'bank' }}"></i>
                                        {{ ucwords(str_replace('_', ' ', $withdrawal->method)) }}
                                    </span>
                                </td>
                                <td>
                                    <code class="transaction-id">{{ $withdrawal->upi_id_or_bank }}</code>
                                </td>
                                <td>{{ $withdrawal->requested_at ? $withdrawal->requested_at->format('M d, Y') : $withdrawal->created_at->format('M d, Y') }}</td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="{{ route('withdrawals.show', $withdrawal) }}" class="action-icon" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? '8' : '7' }}" style="text-align: center; padding: 40px;">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-text-muted);"></i>
                                    <p class="text-muted mt-3">No withdrawals found</p>
                                    @if(!$isAdmin)
                                        <a href="{{ route('withdrawals.create') }}" class="btn btn-primary mt-3">
                                            <i class="bi bi-plus-circle me-2"></i>Request Your First Withdrawal
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($withdrawals->hasPages())
                <div class="pagination-container">
                    {{ $withdrawals->links() }}
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
        document.getElementById('withdrawalSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('#withdrawalTableBody tr');

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
