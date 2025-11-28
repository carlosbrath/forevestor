@extends('layouts.master-public')
@section('title', 'Investment Plans')
@section('meta_description', 'Explore our flexible investment plans designed to help you grow your wealth')
@section('content')

<!-- PLANS HERO SECTION -->
<section class="hero-section d-flex">
    <div class="w-100 blank-dv"></div>

    <div class="d-flex flex-column align-items-center gap-3">
        <!-- Row 1 - Badge -->
        <div class="d-flex align-items-center star-card gap-2">
            <i class="bi bi-graph-up" style="color: var(--color-primary); font-size: 1rem;"></i>
            <a href="" style="color: var(--color-text-primary); font-weight: 500;">Upto 14% Monthly Returns</a>
        </div>

        <!-- Row 2 - Main Heading -->
        <h1 class="text-center" style="color: var(--color-text-primary);">Choose Your Investment Plan</h1>

        <!-- Row 3 - Subtitle -->
        <p class="text-center hero-subtitle" style="color: var(--color-text-secondary);">
            Flexible plans designed to match your financial goals and risk appetite. Start small or go big - we have
            options for everyone.
        </p>

        <!-- Row 4 - CTA Buttons -->
        <div class="d-flex gap-3 justify-content-center flex-wrap hero-cta">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg"
                style="background-color: var(--color-primary); border-color: var(--color-primary); color: white; font-weight: 600;">
                Start Investing
            </a>
            <a href="#plans" class="btn btn-outline btn-lg"
                style="color: var(--color-text-primary); border-color: var(--color-primary); border-width: 2px;">
                View Plans
            </a>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center hero-image-section">
        <div class="hero-img-1">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="Investment Plans" loading="lazy" />
        </div>
        <div class="hero-img-2">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="Investment Plans" loading="lazy" />
        </div>
    </div>
</section>

<!-- INVESTMENT PLANS SECTION -->
<section id="plans" class="features-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Investment Plans</h2>
            <p class="section-subtitle">Choose the plan that best fits your investment goals</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Starter Plan -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card text-center"
                    style="position: relative; padding: var(--spacing-3xl) var(--spacing-2xl);">
                    <div class="feature-icon">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h3 class="feature-title" style="font-size: var(--fs-3xl); margin-bottom: var(--spacing-md);">
                        Starter Plan</h3>
                    <div style="margin-bottom: var(--spacing-xl);">
                        <div
                            style="font-size: var(--fs-4xl); font-weight: var(--fw-extra-bold); color: var(--color-primary);">
                            10%
                        </div>
                        <div style="font-size: var(--fs-base); color: var(--color-text-secondary);">Monthly Returns
                        </div>
                    </div>

                    <div style="text-align: left; margin-bottom: var(--spacing-2xl);">
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Minimum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> ₹10,000</span>
                        </div>
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Maximum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> ₹100,000</span>
                        </div>
                    </div>

                    <ul style="list-style: none; padding: 0; margin-bottom: var(--spacing-2xl); text-align: left;">
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Perfect for beginners
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Monthly profit distribution
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Basic support
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Anytime withdrawal
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="btn btn-primary w-100"
                        style="background-color: var(--color-primary); border-color: var(--color-primary); padding: var(--spacing-md);">
                        Choose Plan
                    </a>
                </div>
            </div>

            <!-- Growth Plan -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card text-center"
                    style="position: relative; padding: var(--spacing-3xl) var(--spacing-2xl); border: 2px solid var(--color-primary);">
                    <!-- Popular Badge -->
                    <div
                        style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: var(--color-primary); color: white; padding: var(--spacing-xs) var(--spacing-xl); border-radius: var(--radius-lg); font-weight: var(--fw-semibold); font-size: var(--fs-sm);">
                        MOST POPULAR
                    </div>

                    <div class="feature-icon">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <h3 class="feature-title" style="font-size: var(--fs-3xl); margin-bottom: var(--spacing-md);">Growth
                        Plan</h3>
                    <div style="margin-bottom: var(--spacing-xl);">
                        <div
                            style="font-size: var(--fs-4xl); font-weight: var(--fw-extra-bold); color: var(--color-primary);">
                            12%
                        </div>
                        <div style="font-size: var(--fs-base); color: var(--color-text-secondary);">Monthly Returns
                        </div>
                    </div>

                    <div style="text-align: left; margin-bottom: var(--spacing-2xl);">
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Minimum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> ₹100,001</span>
                        </div>
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Maximum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> ₹300,000</span>
                        </div>
                    </div>

                    <ul style="list-style: none; padding: 0; margin-bottom: var(--spacing-2xl); text-align: left;">
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Ideal for regular investors
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Monthly profit distribution
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Priority support
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Anytime withdrawal
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Detailed reports
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="btn btn-primary w-100"
                        style="background-color: var(--color-primary); border-color: var(--color-primary); padding: var(--spacing-md);">
                        Choose Plan
                    </a>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card text-center"
                    style="position: relative; padding: var(--spacing-3xl) var(--spacing-2xl);">
                    <div class="feature-icon">
                        <i class="bi bi-trophy"></i>
                    </div>
                    <h3 class="feature-title" style="font-size: var(--fs-3xl); margin-bottom: var(--spacing-md);">
                        Premium Plan</h3>
                    <div style="margin-bottom: var(--spacing-xl);">
                        <div
                            style="font-size: var(--fs-4xl); font-weight: var(--fw-extra-bold); color: var(--color-primary);">
                            14%
                        </div>
                        <div style="font-size: var(--fs-base); color: var(--color-text-secondary);">Monthly Returns
                        </div>
                    </div>

                    <div style="text-align: left; margin-bottom: var(--spacing-2xl);">
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Minimum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> ₹3,00,001</span>
                        </div>
                        <div style="margin-bottom: var(--spacing-lg);">
                            <strong style="color: var(--color-text-primary);">Maximum Investment:</strong>
                            <span style="color: var(--color-text-secondary);"> Unlimited</span>
                        </div>
                    </div>

                    <ul style="list-style: none; padding: 0; margin-bottom: var(--spacing-2xl); text-align: left;">
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Maximum returns
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Monthly profit distribution
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Dedicated account manager
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Anytime withdrawal
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            Advanced analytics
                        </li>
                        <li style="padding: var(--spacing-sm) 0; color: var(--color-text-secondary);">
                            <i class="bi bi-check-circle-fill"
                                style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                            VIP support 24/7
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="btn btn-primary w-100"
                        style="background-color: var(--color-primary); border-color: var(--color-primary); padding: var(--spacing-md);">
                        Choose Plan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PLAN FEATURES COMPARISON -->
<section class="how-it-works-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Why Invest with Forevestor?</h2>
            <p class="section-subtitle">All plans include these amazing benefits</p>
        </div>

        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h3 class="feature-title">Zero Hidden Charges</h3>
                    <p class="feature-desc">No hidden fees, no surprise deductions. What you see is what you get.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3 class="feature-title">Flexible Withdrawals</h3>
                    <p class="feature-desc">Withdraw your profits or principal amount anytime without penalties.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Bank Verified</h3>
                    <p class="feature-desc">All investments verified through secure bank receipts for your safety.</p>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Monthly Profits</h3>
                    <p class="feature-desc">Receive your returns every month like clockwork, automatically calculated.
                    </p>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="feature-title">Real-time Tracking</h3>
                    <p class="feature-desc">Monitor your investments and profits in real-time through your dashboard.
                    </p>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h3 class="feature-title">Expert Support</h3>
                    <p class="feature-desc">Our team is always ready to help you make the most of your investments.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW TO GET STARTED -->
<section class="features-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">How to Get Started</h2>
            <p class="section-subtitle">Begin your investment journey in three simple steps</p>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="steps-container">
                    <!-- Step 1 -->
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3>Choose Your Plan</h3>
                            <p>Select the investment plan that matches your financial goals and budget</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3>Create Account & Invest</h3>
                            <p>Register, verify your email, and make your first investment with bank receipt upload</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3>Watch Your Money Grow</h3>
                            <p>Sit back and watch your investment grow with monthly profit distributions</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="steps-image">
                    <img src="{{ asset('/assets/images/HOWITWORK.png')}}" alt="How to Get Started" loading="lazy"
                        class="img-fluid rounded shadow custom-img" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="testimonials-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Got questions? We've got answers</p>
        </div>

        <div class="row g-4">
            <!-- FAQ 1 -->
            <div class="col-lg-6">
                <div class="testimonial-card">
                    <h3
                        style="font-size: var(--fs-xl); font-weight: var(--fw-semibold); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
                        <i class="bi bi-question-circle"
                            style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                        Can I switch between plans?
                    </h3>
                    <p class="feature-desc">
                        Yes, you can upgrade or change your investment plan at any time. Simply contact our support team
                        or manage it through your dashboard.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="col-lg-6">
                <div class="testimonial-card">
                    <h3
                        style="font-size: var(--fs-xl); font-weight: var(--fw-semibold); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
                        <i class="bi bi-question-circle"
                            style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                        When do I receive my profits?
                    </h3>
                    <p class="feature-desc">
                        Profits are calculated and distributed at the end of each month automatically. You can withdraw
                        them or reinvest for compound growth.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="col-lg-6">
                <div class="testimonial-card">
                    <h3
                        style="font-size: var(--fs-xl); font-weight: var(--fw-semibold); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
                        <i class="bi bi-question-circle"
                            style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                        Is there a lock-in period?
                    </h3>
                    <p class="feature-desc">
                        No, there is no lock-in period. You can withdraw your investment anytime, giving you complete
                        flexibility and control over your funds.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="col-lg-6">
                <div class="testimonial-card">
                    <h3
                        style="font-size: var(--fs-xl); font-weight: var(--fw-semibold); color: var(--color-text-primary); margin-bottom: var(--spacing-lg);">
                        <i class="bi bi-question-circle"
                            style="color: var(--color-primary); margin-right: var(--spacing-sm);"></i>
                        How secure is my investment?
                    </h3>
                    <p class="feature-desc">
                        All investments are verified through bank receipts and protected with bank-level security. We
                        maintain 99.9% uptime and use enterprise-grade encryption.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container-lg">
        <div class="cta-content text-center">
            <h2 class="cta-title">Ready to Start Earning?</h2>
            <p class="cta-subtitle">Choose your plan and start building your wealth today</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create Account Now</a>
        </div>
    </div>
</section>
@endsection