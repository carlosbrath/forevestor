@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1>User Management</h1>
        <p class="text-muted">Manage and monitor all users in the system</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Users List</h5>
            <div>
                <span class="badge bg-primary">Total: {{ $users->total() }}</span>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->full_name }}</strong>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst(str_replace('-', ' ', $user->role?->name ?? 'No Role')) }}</span>
                            </td>
                            <td>
                                @if($user->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($user->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($user->status === 'suspended')
                                    <span class="badge bg-danger">Suspended</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($user->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Edit User">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
