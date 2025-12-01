@extends('layouts.master-public')
@section('title', 'Sign In - Login')
@section('meta_description', 'Log in to your Forevestor account and manage your investments')
@section('content')

<!-- LOGIN FORM SECTION -->
<section class="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-5">

                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="login-title" style="color: var(--color-text-primary);">Welcome Back</h1>
                    <p class="login-subtitle" style="color: var(--color-text-secondary); margin-bottom: 0;">Sign in to
                        your Forevestor account to manage your investments</p>
                </div>

                <!-- Login Form -->
                <form id="loginForm" method="POST" action="{{ route('login.submit') }}" class="login-form">
                    @csrf

                    <!-- Session Status Messages -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Error!</strong> Please check the errors below.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-600" style="color: var(--color-text-primary);">Email
                            Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                            autofocus>
                        @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-600"
                            style="color: var(--color-text-primary);">Password <span
                                class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter your password" required>
                            <button class="btn btn-link password-toggle" type="button"
                                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;"
                                data-target="password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe"
                                style="color: var(--color-text-secondary);">
                                Remember me
                            </label>
                        </div>
                        <a href="" class="forgot-password-link"
                            style="color: var(--color-primary); font-weight: 500; font-size: var(--fs-sm);">Forgot
                            password?</a>
                    </div>

                    <!-- Sign In Button -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg fw-600"
                            style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <div class="text-center mb-4">
                        <p style="color: var(--color-text-secondary);">
                            Don't have an account?
                            <a href="{{ route('register') }}"
                                style="color: var(--color-primary); font-weight: 600;">Create one now</a>
                        </p>
                    </div>

                    <!-- Divider -->
                    <!-- <div class="divider mb-4">
                        <span style="color: var(--color-text-secondary);">OR</span>
                    </div> -->

                    <!-- Alternative Login Options -->
                    <!-- <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline btn-lg social-btn"
                            style="border-color: var(--color-border-primary); color: var(--color-text-primary);">
                            <i class="bi bi-google me-2"></i> Continue with Google
                        </button>
                    </div> -->

                </form>

                <!-- Security Notice -->
                <div class="security-notice mt-5 p-3"
                    style="background-color: var(--color-bg-light); border-radius: var(--radius-sm); border-left: 4px solid var(--color-primary);">
                    <div style="display: flex; gap: var(--spacing-md); align-items: flex-start;">
                        <i class="bi bi-shield-check"
                            style="color: var(--color-primary); font-size: 1.2rem; flex-shrink: 0;"></i>
                        <div>
                            <p class="fw-600 mb-2" style="color: var(--color-text-primary);">Secure Login</p>
                            <p class="mb-0" style="color: var(--color-text-secondary); font-size: var(--fs-sm);">Your
                                account is protected with industry-standard encryption. Never share your password with
                                anyone.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@push('style')
<style>
/* Login Section Styles */
.login-section {
    min-height: 100vh;
    padding-top: 140px;
    padding-bottom: 60px;
    background-color: var(--color-bg-primary);
}

.login-title {
    font-size: var(--fs-4xl);
    font-weight: var(--fw-bold);
    margin-bottom: var(--spacing-md);
    line-height: var(--lh-tight);
}

.login-subtitle {
    font-size: var(--fs-lg);
    font-weight: var(--fw-normal);
}

/* Form Styles */
.login-form {
    background-color: var(--color-bg-tertiary);
    padding: var(--spacing-3xl);
    border-radius: var(--radius-lg);
    border: 1px solid var(--color-border-primary);
    box-shadow: var(--shadow-sm);
    transition: var(--transition-normal);
}

.login-form:hover {
    box-shadow: var(--shadow-md);
}

/* Form Label Styles */
.login-form .form-label {
    font-size: var(--fs-sm);
    font-weight: var(--fw-semibold);
    color: var(--color-text-primary);
    margin-bottom: var(--spacing-md);
    text-transform: none;
    letter-spacing: 0;
}

/* Form Control Styles */
.login-form .form-control,
.login-form .form-select {
    font-size: var(--fs-base);
    padding: 0.75rem 1rem;
    border: 1px solid var(--color-border-primary);
    border-radius: var(--radius-sm);
    background-color: var(--color-bg-light);
    color: var(--color-text-primary);
    transition: var(--transition-fast);
}

.login-form .form-control:focus,
.login-form .form-select:focus {
    border-color: var(--color-primary);
    background-color: var(--color-bg-tertiary);
    box-shadow: 0 0 0 0.25rem var(--color-primary-opacity-2);
    color: var(--color-text-primary);
}

.login-form .form-control::placeholder {
    color: var(--color-text-muted);
}

/* Form Control Large Variant */
.login-form .form-control-lg,
.login-form .form-select {
    font-size: var(--fs-base);
    padding: 0.75rem 1rem;
    height: auto;
    min-height: 44px;
}

/* Checkbox Styles */
.login-form .form-check-input {
    width: 1.25em;
    height: 1.25em;
    margin-top: 0.2em;
    border: 2px solid var(--color-border-primary);
    border-radius: 4px;
    transition: var(--transition-fast);
    cursor: pointer;
}

.login-form .form-check-input:checked {
    background-color: var(--color-primary);
    border-color: var(--color-primary);
}

.login-form .form-check-input:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 0.25rem var(--color-primary-opacity-2);
}

.login-form .form-check-label {
    cursor: pointer;
    margin-left: var(--spacing-sm);
    font-size: var(--fs-sm);
}

/* Password Toggle Button */
.password-toggle {
    color: var(--color-text-secondary);
    padding: 0;
    font-size: var(--fs-lg);
    transition: var(--transition-fast);
}

.password-toggle:hover {
    color: var(--color-primary);
}

/* Submit Button */
.login-form .btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: var(--fs-base);
    height: auto;
    min-height: 44px;
    transition: var(--transition-fast);
}

.login-form .btn-primary:hover,
.login-form .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(221, 161, 37, 0.3);
}

.login-form .btn:active {
    transform: scale(0.98);
}

/* Social Button Styles */
.social-btn {
    border-color: var(--color-border-primary) !important;
    color: var(--color-text-primary) !important;
    transition: var(--transition-fast);
}

.social-btn:hover {
    background-color: var(--color-bg-light);
    border-color: var(--color-primary) !important;
    color: var(--color-primary) !important;
}

/* Error Styles */
.login-form .is-invalid {
    border-color: #dc3545;
}

.login-form .is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
}

.login-form .invalid-feedback {
    font-size: var(--fs-sm);
    color: #dc3545;
    margin-top: var(--spacing-xs);
}

.login-form .text-danger {
    color: #dc3545;
}

/* Alert Styles */
.alert {
    border-radius: var(--radius-sm);
    font-size: var(--fs-sm);
    border: 1px solid;
}

.alert-success {
    background-color: rgba(25, 135, 84, 0.1);
    border-color: rgba(25, 135, 84, 0.3);
    color: #155724;
}

.alert-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-color: rgba(220, 53, 69, 0.3);
    color: #721c24;
}

/* Divider Styles */
.divider {
    position: relative;
    text-align: center;
    margin: var(--spacing-2xl) 0;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: var(--color-border-primary);
    z-index: 0;
}

.divider span {
    position: relative;
    background-color: var(--color-bg-tertiary);
    padding: 0 var(--spacing-md);
    z-index: 1;
}

/* Forgot Password Link */
.forgot-password-link {
    transition: var(--transition-fast);
    text-decoration: none;
}

.forgot-password-link:hover {
    text-decoration: underline;
    color: var(--color-primary-dark);
}

/* Security Notice */
.security-notice {
    margin-top: var(--spacing-2xl);
}

/* Link Styles */
.login-form a {
    transition: var(--transition-fast);
}

.login-form a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-section {
        padding-top: 120px;
        padding-bottom: 40px;
    }

    .login-form {
        padding: var(--spacing-2xl);
    }

    .login-title {
        font-size: var(--fs-3xl);
    }

    .login-subtitle {
        font-size: var(--fs-base);
    }

    .d-flex {
        flex-direction: column;
        gap: var(--spacing-md);
    }

    .d-flex.justify-content-between {
        align-items: flex-start !important;
    }

    .forgot-password-link {
        margin-top: var(--spacing-md);
    }
}

@media (max-width: 576px) {
    .login-section {
        padding-top: 100px;
    }

    .login-form {
        padding: var(--spacing-xl);
        border-radius: var(--radius-md);
    }

    .login-title {
        font-size: var(--fs-2xl);
    }

    .login-subtitle {
        font-size: var(--fs-sm);
    }

    .mb-4 {
        margin-bottom: var(--spacing-2xl) !important;
    }

    .security-notice {
        padding: var(--spacing-lg) !important;
        font-size: var(--fs-sm);
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password Toggle Functionality
    const passwordToggles = document.querySelectorAll('.password-toggle');

    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                targetInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Form submission
    const form = document.getElementById('loginForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Login form submitted');
        });
    }
});
</script>
@endpush

@endsection