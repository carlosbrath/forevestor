@extends('layouts.master-public')
@section('title', 'Landing')
@section('meta_description', 'Landing page')
@section('content')
    <!-- HERO SECTION -->
    <section id="heroSection" class="hero-section d-flex">
        <div class="w-100 blank-dv"></div>

        <div class="d-flex flex-column align-items-center gap-3">
            <!-- Row 1 - Promo Card -->
            <div class="d-flex align-items-center star-card gap-2">
                <i class="bi bi-star-fill" style="color: var(--color-primary); font-size: 1rem;"></i>
                <a href="" style="color: var(--color-text-primary); font-weight: 500;">Launched: Start Investing Today</a>
            </div>

            <!-- Row 2 - Main Heading -->
            <h1 class="text-center" style="color: var(--color-text-primary);">Grow Your Wealth with Smart Investments</h1>

            <!-- Row 3 - Subtitle -->
            <p class="text-center hero-subtitle" style="color: var(--color-text-secondary);">Invest with confidence. Earn 1% daily profit and build your financial future.</p>

            <!-- Row 4 - CTA Buttons -->
            <div class="d-flex gap-3 justify-content-center flex-wrap hero-cta">
                <a href="#" class="btn btn-primary btn-lg" style="background-color: var(--color-primary); border-color: var(--color-primary); color: white; font-weight: 600;">Get Started</a>
                <a href="#" class="btn btn-outline btn-lg" style="color: var(--color-text-primary); border-color: var(--color-primary); border-width: 2px;">Learn More</a>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center hero-image-section">
            <div class="hero-img-1">
                <img src="{{ asset('/assets/images/hero-image-desktop-v2.webp')}}" alt="Investment Dashboard Preview" loading="lazy" />
            </div>
            <div class="hero-img-2">
                <img src="{{ asset('/assets/images/hero-image-lottie-fallback-v2.webp')}}" alt="Investment Growth Animation" loading="lazy" />
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features-section">
        <div class="container-lg">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Why Choose Forevestor?</h2>
                <p class="section-subtitle">Everything you need to start investing and grow your wealth</p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="feature-title">1% Daily Profit</h3>
                        <p class="feature-desc">Earn consistent 1% daily returns on your investments automatically</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="feature-title">Secure & Verified</h3>
                        <p class="feature-desc">All transactions verified through bank receipts and secure uploads</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h3 class="feature-title">Easy Investments</h3>
                        <p class="feature-desc">Simple and intuitive interface for manual fund investments</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h3 class="feature-title">Real-time Dashboard</h3>
                        <p class="feature-desc">Track your profits and investments in real-time with live updates</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h3 class="feature-title">Dedicated Support</h3>
                        <p class="feature-desc">Our team is here to help you every step of your investment journey</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-lock"></i>
                        </div>
                        <h3 class="feature-title">Bank-level Security</h3>
                        <p class="feature-desc">Your data is protected with enterprise-grade encryption</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section class="how-it-works-section">
        <div class="container-lg">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">How It Works</h2>
                <p class="section-subtitle">Three simple steps to start your investment journey</p>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="steps-container">
                        <!-- Step 1 -->
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h3>Create Account</h3>
                                <p>Register with your details and verify your email address to get started</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h3>Invest Funds</h3>
                                <p>Upload bank receipt and invest your desired amount to start earning</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h3>Earn Daily Profits</h3>
                                <p>Watch your investment grow with automatic 1% daily profit calculation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="steps-image">
                        <div class="placeholder-image">
                            <i class="bi bi-image"></i>
                            <p>Investment Process Illustration</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="stats-section">
        <div class="container-lg">
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

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonials-section">
        <div class="container-lg">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">What Our Users Say</h2>
                <p class="section-subtitle">Real stories from investors like you</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"I started with ₹10,000 and within 3 months, my profits exceeded my initial investment. Forevestor is a game-changer!"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">AR</div>
                            <div>
                                <div class="author-name">Amit Sharma</div>
                                <div class="author-title">Software Engineer</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"The verification process was smooth and the customer support is amazing. I feel confident with my investments here."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">PR</div>
                            <div>
                                <div class="author-name">Priya Verma</div>
                                <div class="author-title">Business Owner</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Transparent, reliable, and consistent. The 1% daily profit is exactly what I needed to grow my portfolio."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">RK</div>
                            <div>
                                <div class="author-name">Rajesh Kumar</div>
                                <div class="author-title">Entrepreneur</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="container-lg">
            <div class="cta-content text-center">
                <h2 class="cta-title">Ready to Start Investing?</h2>
                <p class="cta-subtitle">Join thousands of investors and start earning 1% daily profit today</p>
                <a href="#" class="btn btn-primary btn-lg">Register Now</a>
            </div>
        </div>
    </section>

@endsection
