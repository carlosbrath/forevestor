@extends('layouts.master-public')
@section('title', 'About Us')
@section('meta_description', 'Learn about Forevestor - Your trusted investment partner')
@section('content')

<!-- ABOUT HERO SECTION -->
<section class="hero-section d-flex">
    <div class="w-100 blank-dv"></div>

    <div class="d-flex flex-column align-items-center pt-5 pt-md-0 gap-3">
        <!-- Row 1 - Badge -->
        <div class="d-flex align-items-center star-card gap-2">
            <i class="bi bi-award-fill" style="color: var(--color-primary); font-size: 1rem;"></i>
            <a href="" style="color: var(--color-text-primary); font-weight: 500;">Trusted by 50,000+ Investors</a>
        </div>

        <!-- Row 2 - Main Heading -->
        <h1 class="text-center" style="color: var(--color-text-primary);">Building Financial Freedom Together</h1>

        <!-- Row 3 - Subtitle -->
        <p class="text-center hero-subtitle" style="color: var(--color-text-secondary);">
            We're on a mission to make wealth creation accessible to everyone through smart, secure, and transparent
            investments.
        </p>
    </div>

    <div class="d-flex flex-column align-items-center hero-image-section">
        <div class="hero-img-1">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="About Forevestor" loading="lazy" />
        </div>
        <div class="hero-img-2">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="About Forevestor" loading="lazy" />
        </div>
    </div>
</section>

<!-- OUR STORY SECTION -->
<section class="features-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Story</h2>
            <p class="section-subtitle">Empowering investors since our inception</p>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <div class="steps-image">
                    <img src="{{ asset('/assets/images/HOWITWORK.png')}}" alt="Our Story" loading="lazy"
                        class="img-fluid rounded shadow custom-img" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="step-content">
                    <h3
                        style="font-size: var(--fs-3xl); font-weight: var(--fw-bold); color: var(--color-text-primary); margin-bottom: var(--spacing-xl);">
                        Who We Are
                    </h3>
                    <p
                        style="font-size: var(--fs-base); color: var(--color-text-secondary); line-height: var(--lh-normal); margin-bottom: var(--spacing-lg);">
                        Forevestor was founded with a simple yet powerful vision: to democratize wealth creation and
                        make investment opportunities accessible to everyone. We believe that financial growth shouldn't
                        be limited to the privileged few.
                    </p>
                    <p
                        style="font-size: var(--fs-base); color: var(--color-text-secondary); line-height: var(--lh-normal); margin-bottom: var(--spacing-lg);">
                        Our platform combines cutting-edge technology with financial expertise to provide a secure,
                        transparent, and user-friendly investment experience. With over 50,000 active investors and ₹100
                        Crores in managed assets, we've proven that smart investing can be both simple and profitable.
                    </p>
                    <p
                        style="font-size: var(--fs-base); color: var(--color-text-secondary); line-height: var(--lh-normal);">
                        Every day, we work tirelessly to ensure our investors receive consistent returns while
                        maintaining the highest standards of security and transparency.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- OUR VALUES SECTION -->
<section class="how-it-works-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Core Values</h2>
            <p class="section-subtitle">The principles that guide everything we do</p>
        </div>

        <div class="row g-4">
            <!-- Value 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Transparency</h3>
                    <p class="feature-desc">We believe in complete transparency. Every transaction, every profit, every
                        detail is clearly communicated to our investors.</p>
                </div>
            </div>

            <!-- Value 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-lock-fill"></i>
                    </div>
                    <h3 class="feature-title">Security First</h3>
                    <p class="feature-desc">Your investments are protected with bank-level security and verified through
                        secure bank receipts.</p>
                </div>
            </div>

            <!-- Value 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="feature-title">Customer First</h3>
                    <p class="feature-desc">Our investors are our priority. We're committed to providing exceptional
                        support and service at every step.</p>
                </div>
            </div>

            <!-- Value 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h3 class="feature-title">Innovation</h3>
                    <p class="feature-desc">We continuously evolve our platform with the latest technology to provide
                        the best investment experience.</p>
                </div>
            </div>

            <!-- Value 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <h3 class="feature-title">Excellence</h3>
                    <p class="feature-desc">We strive for excellence in everything we do, from our technology to our
                        customer service.</p>
                </div>
            </div>

            <!-- Value 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="feature-title">Trust & Integrity</h3>
                    <p class="feature-desc">We build lasting relationships through honest practices and consistent
                        delivery of our promises.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION & VISION SECTION -->
<section class="features-section">
    <div class="container-lg">
        <div class="row g-5">
            <!-- Mission -->
            <div class="col-lg-6">
                <div class="feature-card text-center h-100" style="padding: var(--spacing-4xl) var(--spacing-2xl);">
                    <div class="feature-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3 class="feature-title" style="font-size: var(--fs-3xl);">Our Mission</h3>
                    <p class="feature-desc" style="font-size: var(--fs-lg);">
                        To empower individuals to achieve financial independence through accessible, secure, and
                        profitable investment opportunities that deliver consistent returns.
                    </p>
                </div>
            </div>

            <!-- Vision -->
            <div class="col-lg-6">
                <div class="feature-card text-center h-100" style="padding: var(--spacing-4xl) var(--spacing-2xl);">
                    <div class="feature-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <h3 class="feature-title" style="font-size: var(--fs-3xl);">Our Vision</h3>
                    <p class="feature-desc" style="font-size: var(--fs-lg);">
                        To become Global most trusted investment platform, enabling millions to build wealth and
                        secure
                        their financial future with confidence.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="stats-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Impact in Numbers</h2>
            <p class="section-subtitle">Building trust through results</p>
        </div>

        <div class="row text-center g-4">
            <!-- Stat 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Active Investors</div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-number">₹100Cr+</div>
                    <div class="stat-label">Total Invested</div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-number">₹50Cr+</div>
                    <div class="stat-label">Profits Distributed</div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="stat-card">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime Guarantee</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container-lg">
        <div class="cta-content text-center">
            <h2 class="cta-title">Join Our Community of Investors</h2>
            <p class="cta-subtitle">Start your journey to financial freedom with Forevestor today</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started Now</a>
        </div>
    </div>
</section>

@endsection