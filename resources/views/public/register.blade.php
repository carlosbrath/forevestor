@extends('layouts.master-public')
@section('title', 'Sign Up - Register')
@section('meta_description', 'Create your Forevestor account and start investing today')
@section('content')

<!-- REGISTRATION FORM SECTION -->
<section class="registration-sectiongit ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="registration-title" style="color: var(--color-text-primary);">Create Your Account</h1>
                    <p class="registration-subtitle" style="color: var(--color-text-secondary); margin-bottom: 0;">Join thousands of investors building wealth with Forevestor</p>
                </div>

                <!-- Registration Form -->
                <form id="registrationForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="registration-form">
                    @csrf

                    <!-- Row 1: Full Name -->
                    <div class="mb-4">
                        <label for="fullName" class="form-label fw-600" style="color: var(--color-text-primary);">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('full_name') is-invalid @enderror" id="fullName" name="full_name" placeholder="Enter your full name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 2: Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-600" style="color: var(--color-text-primary);">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 3: Phone & Date of Birth -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-600" style="color: var(--color-text-primary);">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter your phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="dateOfBirth" class="form-label fw-600" style="color: var(--color-text-primary);">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-lg @error('date_of_birth') is-invalid @enderror" id="dateOfBirth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 4: Password & Confirm Password -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-600" style="color: var(--color-text-primary);">Password <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="Create a strong password" required>
                                <button class="btn btn-link password-toggle" type="button" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;" data-target="password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label fw-600" style="color: var(--color-text-primary);">Confirm Password <span class="text-danger">*</span></label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                                <button class="btn btn-link password-toggle" type="button" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none;" data-target="confirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 5: CNIC Number & City -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="cnicNumber" class="form-label fw-600" style="color: var(--color-text-primary);">CNIC Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('cnic_number') is-invalid @enderror" id="cnicNumber" name="cnic_number" placeholder="e.g., 12345-1234567-1" value="{{ old('cnic_number') }}" required>
                            @error('cnic_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label fw-600" style="color: var(--color-text-primary);">City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('city') is-invalid @enderror" id="city" name="city" placeholder="Enter your city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 6: Country & Address -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="country" class="form-label fw-600" style="color: var(--color-text-primary);">Country <span class="text-danger">*</span></label>
                            <select class="form-select form-control-lg @error('country') is-invalid @enderror" id="country" name="country" required>
                                <option value="">Select your country</option>
                                <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>UK</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                <option value="Other" {{ old('country') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('country')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label fw-600" style="color: var(--color-text-primary);">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter your address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Row 7: Referral Code (Optional) -->
                    <div class="mb-4">
                        <label for="referralCode" class="form-label fw-600" style="color: var(--color-text-primary);">Referral Code <span class="badge bg-secondary ms-2">Optional</span></label>
                        <input type="text" class="form-control form-control-lg" id="referralCode" name="referral_code" placeholder="Enter referral code (if you have one)" value="{{ old('referral_code') }}">
                        <small class="form-text" style="color: var(--color-text-secondary);">Got a referral code? Enter it to unlock bonuses</small>
                    </div>

                    <!-- Row 8: Terms & Conditions -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input @error('terms_agreed') is-invalid @enderror" type="checkbox" id="termsCheckbox" name="terms_agreed" required>
                            <label class="form-check-label" for="termsCheckbox" style="color: var(--color-text-secondary);">
                                I agree to the <a href="#" style="color: var(--color-primary);">Terms & Conditions</a> and <a href="#" style="color: var(--color-primary);">Risk Disclaimer</a> <span class="text-danger">*</span>
                            </label>
                        </div>
                        @error('terms_agreed')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-lg fw-600" style="background-color: var(--color-primary); border-color: var(--color-primary); color: white;">
                            <i class="bi bi-check-circle me-2"></i> Create Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p style="color: var(--color-text-secondary);">
                            Already have an account?
                            <a href="{{ route('login') }}" style="color: var(--color-primary); font-weight: 600;">Sign In</a>
                        </p>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>

@push('style')
<style>
    /* Registration Section Styles */
    .registration-section {
        min-height: 100vh;
        padding-top: 140px;
        padding-bottom: 60px;
        background-color: var(--color-bg-primary);
    }

    .registration-title {
        font-size: var(--fs-4xl);
        font-weight: var(--fw-bold);
        margin-bottom: var(--spacing-md);
        line-height: var(--lh-tight);
    }

    .registration-subtitle {
        font-size: var(--fs-lg);
        font-weight: var(--fw-normal);
    }

    /* Form Styles */
    .registration-form {
        background-color: var(--color-bg-tertiary);
        padding: var(--spacing-3xl);
        border-radius: var(--radius-lg);
        border: 1px solid var(--color-border-primary);
        box-shadow: var(--shadow-sm);
        transition: var(--transition-normal);
    }

    .registration-form:hover {
        box-shadow: var(--shadow-md);
    }

    /* Form Label Styles */
    .registration-form .form-label {
        font-size: var(--fs-sm);
        font-weight: var(--fw-semibold);
        color: var(--color-text-primary);
        margin-bottom: var(--spacing-md);
        text-transform: none;
        letter-spacing: 0;
    }

    /* Form Control Styles */
    .registration-form .form-control,
    .registration-form .form-select {
        font-size: var(--fs-base);
        padding: 0.75rem 1rem;
        border: 1px solid var(--color-border-primary);
        border-radius: var(--radius-sm);
        background-color: var(--color-bg-light);
        color: var(--color-text-primary);
        transition: var(--transition-fast);
    }

    .registration-form .form-control:focus,
    .registration-form .form-select:focus {
        border-color: var(--color-primary);
        background-color: var(--color-bg-tertiary);
        box-shadow: 0 0 0 0.25rem var(--color-primary-opacity-2);
        color: var(--color-text-primary);
    }

    .registration-form .form-control::placeholder {
        color: var(--color-text-muted);
    }

    /* Form Control Large Variant */
    .registration-form .form-control-lg,
    .registration-form .form-select {
        font-size: var(--fs-base);
        padding: 0.75rem 1rem;
        height: auto;
        min-height: 44px;
    }

    /* Input Group Styles */
    .registration-form .input-group-text {
        background-color: var(--color-bg-light);
        border: 1px solid var(--color-border-primary);
        color: var(--color-text-secondary);
    }

    /* Checkbox & Radio Styles */
    .registration-form .form-check-input {
        width: 1.25em;
        height: 1.25em;
        margin-top: 0.2em;
        border: 2px solid var(--color-border-primary);
        border-radius: 4px;
        transition: var(--transition-fast);
        cursor: pointer;
    }

    .registration-form .form-check-input:checked {
        background-color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .registration-form .form-check-input:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 0.25rem var(--color-primary-opacity-2);
    }

    .registration-form .form-check-label {
        cursor: pointer;
        margin-left: var(--spacing-sm);
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
    .registration-form .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: var(--fs-base);
        height: auto;
        min-height: 44px;
        transition: var(--transition-fast);
    }

    .registration-form .btn-primary:hover {
        background-color: var(--color-primary-dark) !important;
        border-color: var(--color-primary-dark) !important;
    }

    .registration-form .btn-primary:active {
        background-color: var(--color-primary-dark) !important;
        border-color: var(--color-primary-dark) !important;
        transform: scale(0.98);
    }

    /* Error Styles */
    .registration-form .is-invalid {
        border-color: #dc3545;
    }

    .registration-form .is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .registration-form .invalid-feedback {
        font-size: var(--fs-sm);
        color: #dc3545;
        margin-top: var(--spacing-xs);
    }

    .registration-form .text-danger {
        color: #dc3545;
    }

    /* File Upload Wrapper */
    .file-upload-wrapper {
        position: relative;
    }

    .file-upload-wrapper input[type="file"] {
        cursor: pointer;
    }

    /* Link Styles */
    .registration-form a {
        transition: var(--transition-fast);
    }

    .registration-form a:hover {
        text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .registration-section {
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .registration-form {
            padding: var(--spacing-2xl);
        }

        .registration-title {
            font-size: var(--fs-3xl);
        }

        .registration-subtitle {
            font-size: var(--fs-base);
        }

        .row.g-3 {
            gap: var(--spacing-lg) !important;
        }
    }

    @media (max-width: 576px) {
        .registration-section {
            padding-top: 70px;
        }

        .registration-form {
            padding: var(--spacing-xl);
            border-radius: var(--radius-md);
        }

        .registration-title {
            font-size: var(--fs-2xl);
        }

        .registration-subtitle {
            font-size: var(--fs-sm);
        }

        .mb-4 {
            margin-bottom: var(--spacing-2xl) !important;
        }
    }

    /* Badge Style for Optional */
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        font-weight: var(--fw-semibold);
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

        // Form Validation
        const form = document.getElementById('registrationForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Custom validation can be added here if needed
                console.log('Form submitted');
            });
        }
    });
</script>
@endpush

@endsection
