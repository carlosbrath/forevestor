@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1>Admin Settings</h1>
        <p class="text-muted">Manage system settings and configuration</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">System Configuration</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update-settings') }}" method="POST">
                        @csrf

                        <!-- Application Name -->
                        <div class="mb-3">
                            <label for="app_name" class="form-label">Application Name</label>
                            <input type="text" class="form-control @error('app_name') is-invalid @enderror"
                                   id="app_name" name="app_name"
                                   value="{{ old('app_name', config('app.name', 'Forevestor')) }}" required>
                            @error('app_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Application Description -->
                        <div class="mb-3">
                            <label for="app_description" class="form-label">Application Description</label>
                            <textarea class="form-control @error('app_description') is-invalid @enderror"
                                      id="app_description" name="app_description" rows="3">{{ old('app_description', 'Investment platform for making smart financial decisions') }}</textarea>
                            @error('app_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h6 class="mb-3">Investment Settings</h6>

                        <!-- Minimum Investment -->
                        <div class="mb-3">
                            <label for="min_investment" class="form-label">Minimum Investment Amount (PKR)</label>
                            <input type="number" class="form-control @error('min_investment') is-invalid @enderror"
                                   id="min_investment" name="min_investment"
                                   value="{{ old('min_investment', 5000) }}" step="100" required>
                            @error('min_investment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Maximum Investment -->
                        <div class="mb-3">
                            <label for="max_investment" class="form-label">Maximum Investment Amount (PKR)</label>
                            <input type="number" class="form-control @error('max_investment') is-invalid @enderror"
                                   id="max_investment" name="max_investment"
                                   value="{{ old('max_investment', 5000000) }}" step="1000" required>
                            @error('max_investment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profit Percentage -->
                        <div class="mb-3">
                            <label for="profit_percentage" class="form-label">Default Profit Percentage (%)</label>
                            <input type="number" class="form-control @error('profit_percentage') is-invalid @enderror"
                                   id="profit_percentage" name="profit_percentage"
                                   value="{{ old('profit_percentage', 12.5) }}" step="0.1" min="0" max="100" required>
                            @error('profit_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Save Settings
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Information Panel -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Settings Information</h5>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <p class="text-muted small">
                            <strong>Minimum Investment:</strong><br>
                            The minimum amount users can invest in the platform.
                        </p>
                    </div>

                    <div class="info-item mb-3">
                        <p class="text-muted small">
                            <strong>Maximum Investment:</strong><br>
                            The maximum amount a single user can invest at once.
                        </p>
                    </div>

                    <div class="info-item mb-3">
                        <p class="text-muted small">
                            <strong>Profit Percentage:</strong><br>
                            The default profit rate offered to investors on their investments.
                        </p>
                    </div>

                    <div class="alert alert-info small mt-4">
                        <i class="bi bi-info-circle"></i>
                        All changes will be applied globally to the system.
                    </div>
                </div>
            </div>

            <!-- Recent Changes -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">System Info</h5>
                </div>
                <div class="card-body">
                    <p class="small">
                        <strong>Last Updated:</strong><br>
                        <span class="text-muted">Settings are stored in configuration files</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
