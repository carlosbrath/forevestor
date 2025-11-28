@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1>Investment Management</h1>
        <p class="text-muted">Approve or reject pending investments</p>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Investments</h5>
            <div>
                <span class="badge bg-primary">Total: {{ $investments->total() }}</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Investor</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Duration</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($investments as $investment)
                    <tr>
                        <td>
                            <strong>{{ $investment->user?->full_name ?? 'Unknown' }}</strong><br>
                            <small class="text-muted">{{ $investment->user?->email }}</small>
                        </td>
                        <td>
                            <strong>PKR {{ number_format($investment->amount, 2) }}</strong>
                        </td>
                        <td>
                            @if($investment->status === 'pending')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($investment->status === 'active')
                            <span class="badge bg-success">Active</span>
                            @elseif($investment->status === 'completed')
                            <span class="badge bg-info">Completed</span>
                            @else
                            <span class="badge bg-danger">{{ ucfirst($investment->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $investment->duration ?? 'N/A' }} months</td>
                        <td>{{ $investment->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($investment->status === 'pending')
                            <form action="{{ route('admin.approve-investment', $investment->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.reject-investment', $investment->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" title="Reject"
                                    onclick="return confirm('Are you sure you want to reject this investment?')">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-outline-primary" title="View Details">
                                <i class="bi bi-eye"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            No investments found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($investments->hasPages())
        <div class="card-footer">
            {{ $investments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection