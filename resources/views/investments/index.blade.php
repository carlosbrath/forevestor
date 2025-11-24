@extends('layouts.master-public')
@section('title', 'My Investments')
@section('content')

<section class="investments-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h1 style="color: var(--color-text-primary);">My Investments</h1>
                        <p class="text-muted">Track and manage your investments</p>
                    </div>
                    <a href="{{ route('investments.create') }}" class="btn btn-lg" style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                        <i class="bi bi-plus-circle me-2"></i> New Investment
                    </a>
                </div>

                <!-- Empty State -->
                @if($investments->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: var(--color-text-secondary);"></i>
                        </div>
                        <h4 style="color: var(--color-text-primary);">No Investments Yet</h4>
                        <p class="text-muted mb-4">You haven't made any investments. Start growing your wealth today!</p>
                        <a href="{{ route('investments.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i> Make Your First Investment
                        </a>
                    </div>
                @else
                    <!-- Investments Table -->
                    <div class="table-responsive">
                        <table class="table" style="border: 1px solid var(--color-border-primary);">
                            <thead style="background-color: var(--color-bg-secondary); border-bottom: 1px solid var(--color-border-primary);">
                                <tr>
                                    <th style="color: var(--color-text-primary);">Investment ID</th>
                                    <th style="color: var(--color-text-primary);">Amount</th>
                                    <th style="color: var(--color-text-primary);">Paid Amount</th>
                                    <th style="color: var(--color-text-primary);">Method</th>
                                    <th style="color: var(--color-text-primary);">Status</th>
                                    <th style="color: var(--color-text-primary);">Date</th>
                                    <th style="color: var(--color-text-primary);">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investments as $investment)
                                    <tr style="border-bottom: 1px solid var(--color-border-primary);">
                                        <td>
                                            <strong style="color: var(--color-text-primary);">#{{ $investment->id }}</strong>
                                        </td>
                                        <td style="color: var(--color-text-primary);">
                                            ₹{{ number_format($investment->investment_amount, 2) }}
                                        </td>
                                        <td style="color: var(--color-text-primary);">
                                            ₹{{ number_format($investment->paid_amount, 2) }}
                                        </td>
                                        <td style="color: var(--color-text-secondary);">
                                            <small>{{ ucfirst(str_replace('_', ' ', $investment->payment_method)) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $investment->status === 'approved' ? 'success' : ($investment->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($investment->status) }}
                                            </span>
                                        </td>
                                        <td style="color: var(--color-text-secondary);">
                                            <small>{{ $investment->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('investments.show', $investment->id) }}" class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $investments->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection
