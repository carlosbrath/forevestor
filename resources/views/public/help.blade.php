@extends('layouts.master-public')
@section('title', 'Help & Support')
@section('meta_description', 'Get help and find answers to frequently asked questions about Forevestor')
@section('content')

<!-- HELP HERO SECTION -->
<section class="hero-section d-flex">
    <div class="w-100 blank-dv"></div>

    <div class="d-flex flex-column align-items-center pt-5 pt-md-0 gap-3">
        <!-- Row 1 - Badge -->
        <div class="d-flex align-items-center star-card gap-2">
            <i class="bi bi-headset" style="color: var(--color-primary); font-size: 1rem;"></i>
            <a href="" style="color: var(--color-text-primary); font-weight: 500;">24/7 Support Available</a>
        </div>

        <!-- Row 2 - Main Heading -->
        <h1 class="text-center" style="color: var(--color-text-primary);">How Can We Help You?</h1>

        <!-- Row 3 - Subtitle -->
        <p class="text-center hero-subtitle" style="color: var(--color-text-secondary);">
            Find answers to common questions and get the support you need to make the most of your investments.
        </p>
    </div>

    <div class="d-flex flex-column align-items-center hero-image-section">
        <div class="hero-img-1">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="Help & Support" loading="lazy" />
        </div>
        <div class="hero-img-2">
            <img src="{{ asset('/assets/images/hero.png')}}" alt="Help & Support" loading="lazy" />
        </div>
    </div>
</section>

<!-- QUICK LINKS SECTION -->
<section class="how-it-works-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Quick Help Topics</h2>
            <p class="section-subtitle">Jump to the topic you need help with</p>
        </div>

        <div class="row g-4">
            <!-- Topic 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>
                    <h3 class="feature-title">Getting Started</h3>
                    <p class="feature-desc">Learn how to create your account and make your first investment with
                        Forevestor.</p>
                </div>
            </div>

            <!-- Topic 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <h3 class="feature-title">Making Investments</h3>
                    <p class="feature-desc">Understand investment plans, minimum amounts, and how to submit your
                        investment.</p>
                </div>
            </div>

            <!-- Topic 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-graph-up"></i>
                    </div>
                    <h3 class="feature-title">Profits & Returns</h3>
                    <p class="feature-desc">Learn about profit distribution, withdrawal process, and tracking your
                        earnings.</p>
                </div>
            </div>

            <!-- Topic 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Security & Safety</h3>
                    <p class="feature-desc">Discover how we protect your investments and personal information.</p>
                </div>
            </div>

            <!-- Topic 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h3 class="feature-title">Account Management</h3>
                    <p class="feature-desc">Manage your profile, update details, and track your investment portfolio.
                    </p>
                </div>
            </div>

            <!-- Topic 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <h3 class="feature-title">FAQs</h3>
                    <p class="feature-desc">Browse our comprehensive list of frequently asked questions and answers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="features-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Find answers to the most common questions</p>
        </div>

        <div class="accordion" id="faqAccordion">
            <!-- FAQ 1 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq1"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        How do I create an account on Forevestor?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Creating an account is simple! Click on the "Get Started" or "Sign Up" button on our homepage.
                        Fill in your details including full name, email, phone number, and create a secure password.
                        Agree to our terms and conditions, and you're ready to start investing.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq2"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        What is the minimum investment amount?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        The minimum investment amount varies by plan. Our Basic Plan starts at ₹10,000, while our
                        Premium and Elite plans have higher minimum investments. Check our <a
                            href="{{ route('plans') }}" style="color: var(--color-primary);">Investment Plans</a> page
                        for detailed information.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq3"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        How long does it take for my investment to be approved?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Once you submit your investment with the payment proof, our team typically reviews and approves
                        it within 24-48 hours. You'll receive an email notification once your investment is approved and
                        active.
                    </div>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq4"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        When and how will I receive my profits?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Profits are calculated daily and credited to your wallet. The profit percentage depends on your
                        investment plan. You can view your daily profits in your dashboard and request a withdrawal at
                        any time.
                    </div>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq5"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        Can I withdraw my investment before the maturity period?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Each investment plan has specific terms regarding early withdrawal. Please review the terms and
                        conditions of your selected plan or contact our support team for assistance with early
                        withdrawal requests.
                    </div>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq6"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        Is my money safe with Forevestor?
                    </button>
                </h2>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Yes! We prioritize the security of your investments. All transactions are verified through
                        secure bank receipts, and we maintain strict security protocols. Your personal and financial
                        information is encrypted and protected with bank-level security measures.
                    </div>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq7"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        What payment methods do you accept?
                    </button>
                </h2>
                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        We accept bank transfers and UPI payments. When making an investment, you'll need to upload a
                        payment proof (bank receipt or UPI transaction screenshot) for verification purposes.
                    </div>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="accordion-item"
                style="background: var(--color-bg-secondary); border: 1px solid var(--color-border); margin-bottom: 1rem; border-radius: 8px;">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faq8"
                        style="background: var(--color-bg-secondary); color: var(--color-text-primary); font-weight: 600;">
                        How can I track my investment performance?
                    </button>
                </h2>
                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body" style="color: var(--color-text-secondary);">
                        Your dashboard provides real-time information about your investments, daily profits, total
                        earnings, and transaction history. You can log in anytime to view detailed analytics and
                        performance metrics.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONTACT SUPPORT SECTION -->
<section class="how-it-works-section">
    <div class="container-lg">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Still Need Help?</h2>
            <p class="section-subtitle">Our support team is here to assist you</p>
        </div>

        <div class="row g-4">
            <!-- Email Support -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h3 class="feature-title">Email Support</h3>
                    <p class="feature-desc">Send us an email and we'll respond within 24 hours</p>
                    <a href="mailto:support@forevestor.com" style="color: var(--color-primary); font-weight: 600;">
                        support@forevestor.com
                    </a>
                </div>
            </div>

            <!-- Phone Support -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h3 class="feature-title">Phone Support</h3>
                    <p class="feature-desc">Call us during business hours (9 AM - 6 PM IST)</p>
                    <a href="tel:+911234567890" style="color: var(--color-primary); font-weight: 600;">
                        +91 123 456 7890
                    </a>
                </div>
            </div>

            <!-- WhatsApp Support -->
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h3 class="feature-title">Contact & Support</h3>
                    <p class="feature-desc">Chat with us on WhatsApp for quick assistance</p>
                    <a href="https://wa.me/911234567890" target="_blank"
                        style="color: var(--color-primary); font-weight: 600;">
                        Start Chat
                    </a>
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
            <p class="cta-subtitle">Join thousands of investors building wealth with Forevestor</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started Now</a>
        </div>
    </div>
</section>

@endsection