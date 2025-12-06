@extends('layouts.master-public')
@section('title', 'Privacy Policy')
@section('meta_description', 'Learn about Forevestor - Your trusted investment partner')
@section('content')
<!-- PLANS HERO SECTION -->
<section class="hero-section d-flex">
    <div class="w-100 blank-dv"></div>

    <div class="d-flex flex-column align-items-center pt-5 pt-md-0 gap-3">
        <!-- Row 1 - Badge -->
        <div class="d-flex align-items-center star-card gap-2">
            <i class="bi bi-graph-up" style="color: var(--color-primary); font-size: 1rem;"></i>
            <a href="" style="color: var(--color-text-primary); font-weight: 500;">Legal disclaimer for users</a>
        </div>

        <!-- Row 2 - Main Heading -->
        <h1 class="text-center" style="color: var(--color-text-primary);">privacy policies and legal disclaimer </h1>

        <!-- Row 3 - Subtitle -->
        <p class="text-center hero-subtitle" style="color: var(--color-text-secondary);">
            Understand the terms, conditions, and privacy practices governing your use of Forevestor's investment
            platform.
        </p>

        <!-- Row 4 - CTA Buttons -->
        <div class="d-flex gap-3 justify-content-center flex-wrap hero-cta">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg"
                style="background-color: var(--color-primary); border-color: var(--color-primary); color: white; font-weight: 600;">
                Start Investing
            </a>
            <a href="#forevestorNavTabs" class="btn btn-outline btn-lg"
                style="color: var(--color-text-primary); border-color: var(--color-primary); border-width: 2px;">
                View More
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
<!-- TABS NAVIGATION -->
<div class="forevestor-tabs-sticky">
    <div class="forevestor-tabs-container">
        <ul class="nav nav-tabs forevestor-nav-tabs" id="forevestorNavTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="disclaimer-tab" data-bs-toggle="tab"
                    data-bs-target="#forevestor-disclaimer" type="button" role="tab"
                    aria-controls="forevestor-disclaimer" aria-selected="true">
                    <i class="fas fa-exclamation-circle"></i>Legal Disclaimer
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#forevestor-privacy"
                    type="button" role="tab" aria-controls="forevestor-privacy" aria-selected="false">
                    <i class="fas fa-user-secret"></i>Privacy Policy
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="terms-tab" data-bs-toggle="tab" data-bs-target="#forevestor-terms"
                    type="button" role="tab" aria-controls="forevestor-terms" aria-selected="false">
                    <i class="fas fa-file-alt"></i>Terms of Service
                </button>
            </li>
        </ul>
    </div>
</div>
<!-- MAIN CONTENT -->
<div class="forevestor-content-wrapper">
    <div class="tab-content" id="forevestorNavTabContent">
        <!-- DISCLAIMER TAB -->
        <!-- DISCLAIMER TAB -->
        <div class="tab-pane fade show active" id="forevestor-disclaimer" role="tabpanel"
            aria-labelledby="disclaimer-tab" tabindex="0">

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">1</div>
                    <h2 class="forevestor-section-title">Investment Risk Awareness</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        At Forevestor, we provide a licensed and fully regulated investment platform. While we aim to
                        provide
                        profitable opportunities, all investments carry risk, including the potential loss of capital.
                        Past
                        performance does not guarantee future returns. Always invest responsibly and within your means.
                    </p>
                    <div class="forevestor-alert-premium">
                        <div class="forevestor-alert-premium-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="forevestor-alert-premium-content">
                            <p>
                                By using Forevestor, you acknowledge that you understand these risks and agree to invest
                                wisely.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">2</div>
                    <h2 class="forevestor-section-title">Professional Guidance Encouraged</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        Even though we are licensed, Forevestor does not replace professional financial, legal, or tax
                        advice.
                        We strongly recommend consulting with qualified advisors before making significant investment
                        decisions.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">3</div>
                    <h2 class="forevestor-section-title">Regulatory Compliance</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        As a licensed platform, we follow all applicable local and international regulations. However,
                        you are
                        responsible for ensuring that your participation complies with laws in your jurisdiction.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">4</div>
                    <h2 class="forevestor-section-title">Potential Returns</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        While Forevestor offers opportunities for returns, actual performance may vary due to market
                        conditions.
                        Historical results or projections are not guarantees of future performance. Diversify your
                        investments for
                        better risk management.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">5</div>
                    <h2 class="forevestor-section-title">Platform Reliability</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        Forevestor strives for a smooth, uninterrupted experience. However, technical issues may occur.
                        Always
                        maintain backups of your data and report any problems promptly.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">6</div>
                    <h2 class="forevestor-section-title">Responsible Usage & Security</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        You are responsible for the security of your account. Keep your login credentials safe and
                        notify us
                        immediately of any unauthorized activity.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">7</div>
                    <h2 class="forevestor-section-title">Fraud Prevention</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        We monitor accounts for suspicious activity. Any accounts suspected of fraud or violating terms
                        may be
                        suspended or closed. Remaining funds will be refunded according to our policies.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">8</div>
                    <h2 class="forevestor-section-title">Tax Responsibility</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        Users are responsible for understanding and fulfilling their tax obligations. Consult a tax
                        professional
                        regarding your investments.
                    </p>
                </div>
            </div>

            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">9</div>
                    <h2 class="forevestor-section-title">Disclaimer of Warranties</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">
                        The platform and content are provided "as-is" without any warranties. We aim to provide accurate
                        information but cannot guarantee perfection.
                    </p>
                </div>
            </div>

        </div>

        <!-- PRIVACY POLICY TAB -->
        <div class="tab-pane fade" id="forevestor-privacy" role="tabpanel" aria-labelledby="privacy-tab" tabindex="0">
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">1</div>
                    <h2 class="forevestor-section-title">Information We Collect</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Forevestor collects the following types of information to
                        provide optimal service:</p>
                    <ul class="forevestor-policy-list">
                        <li><strong>Personal Information:</strong> Name, email address, phone number, date of birth,
                            and identification documents required for verification purposes.</li>
                        <li><strong>Financial Information:</strong> Bank account details, payment method
                            information, and transaction history necessary to process investments and withdrawals.
                        </li>
                        <li><strong>Technical Information:</strong> IP address, browser type, operating system,
                            device information, and usage patterns to improve platform functionality.</li>
                        <li><strong>Account Information:</strong> User preferences, communication preferences, and
                            account activity data.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">2</div>
                    <h2 class="forevestor-section-title">How We Use Your Information</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">We use collected information for the following purposes:</p>
                    <ul class="forevestor-policy-list">
                        <li>To create and maintain your account and verify your identity</li>
                        <li>To process deposits, withdrawals, and investment transactions</li>
                        <li>To calculate and distribute returns on investment</li>
                        <li>To prevent fraud and enhance platform security</li>
                        <li>To comply with applicable legal and regulatory requirements</li>
                        <li>To communicate important account updates, policy changes, and support information</li>
                        <li>To improve platform functionality and user experience</li>
                        <li>To send promotional materials (only with your explicit consent)</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">3</div>
                    <h2 class="forevestor-section-title">Data Security</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Forevestor implements industry-leading security measures
                        including SSL encryption, secure password authentication, multi-factor authentication, and
                        regular security audits to protect your personal and financial information.</p>
                    <div class="forevestor-alert-premium">
                        <div class="forevestor-alert-premium-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="forevestor-alert-premium-content">
                            <p>Your account security is your responsibility. Never share your password or account
                                credentials with anyone, and always use strong, unique passwords.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">4</div>
                    <h2 class="forevestor-section-title">Data Retention</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">We retain your personal information for as long as necessary
                        to maintain your account and fulfill the purposes outlined in this policy. Financial records
                        are retained in accordance with applicable legal requirements, typically for 5-7 years. Upon
                        account closure, we retain data as required by law but cease active use.</p>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">5</div>
                    <h2 class="forevestor-section-title">Sharing Your Information</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Forevestor does not sell your personal information to third
                        parties. We may share information only in these circumstances:</p>
                    <ul class="forevestor-policy-list">
                        <li>With service providers who assist in operating the platform (payment processors, hosting
                            providers, security firms)</li>
                        <li>When required by law, court order, or government authority</li>
                        <li>To prevent fraud, enforce terms, or protect the rights and safety of our users and
                            platform</li>
                        <li>With your explicit consent for specific purposes</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">6</div>
                    <h2 class="forevestor-section-title">Cookies & Tracking Technologies</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">We use cookies and similar tracking technologies to enhance
                        your browsing experience, remember your preferences, and analyze platform usage patterns.
                        You can control cookie settings through your browser preferences, though disabling cookies
                        may limit certain platform functionality.</p>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">7</div>
                    <h2 class="forevestor-section-title">User Rights & Data Control</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Depending on your jurisdiction, you may have rights regarding
                        your personal information:</p>
                    <ul class="forevestor-policy-list">
                        <li>Right to access your personal information</li>
                        <li>Right to correct inaccurate information</li>
                        <li>Right to request deletion of your information</li>
                        <li>Right to opt-out of marketing communications</li>
                        <li>Right to data portability</li>
                        <li>Right to withdraw consent at any time</li>
                    </ul>
                    <p class="forevestor-policy-text">To exercise these rights, contact our support team using the
                        information provided below.</p>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">8</div>
                    <h2 class="forevestor-section-title">Third-Party Links</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Our platform may contain links to third-party websites.
                        Forevestor is not responsible for the privacy practices of these external sites. We
                        encourage you to review their privacy policies before providing any personal information.
                    </p>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">9</div>
                    <h2 class="forevestor-section-title">Children's Privacy</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">Forevestor is not intended for individuals under 18 years of
                        age. We do not knowingly collect information from minors. If we become aware that a minor
                        has provided information, we will delete it promptly.</p>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">10</div>
                    <h2 class="forevestor-section-title">Policy Updates & Amendments</h2>
                </div>
                <div class="forevestor-section-content">
                    <p class="forevestor-policy-text">We may update this privacy policy from time to time to reflect
                        changes in our practices or legal requirements. Updates will be posted on this page with the
                        date of the last revision. Continued use of the platform constitutes acceptance of the
                        updated policy.</p>
                </div>
            </div>

        </div>
        <!-- TERMS OF SERVICE TAB -->
        <div class="tab-pane fade" id="forevestor-terms" role="tabpanel" aria-labelledby="terms-tab" tabindex="0">
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">1</div>
                    <h2 class="forevestor-section-title">Investment Plans & Returns</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>1.1:</strong> Investors can participate in any active plan according to their
                            preferred amount and duration.</li>
                        <li><strong>1.2:</strong> The platform offers an average 12% monthly ROI (Return on
                            Investment), distributed in weekly cycles.</li>
                        <li><strong>1.3:</strong> ROI will be credited every Monday of the week to the investor's
                            account wallet or balance.</li>
                        <li><strong>1.4:</strong> Returns are based on the platform's performance and are subject to
                            change in case of major market volatility.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">2</div>
                    <h2 class="forevestor-section-title">Capital Withdrawal Policy</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>2.1:</strong> Investors may request capital withdrawal every 15 days from the
                            date of investment.</li>
                        <li><strong>2.2:</strong> Early withdrawal before 15 days is not allowed.</li>
                        <li><strong>2.3:</strong> Withdrawal requests must be submitted through the dashboard before
                            Sunday 11:59 PM to be processed the following business day.</li>
                        <li><strong>2.4:</strong> All withdrawals will be processed in the same currency/method used
                            for deposit.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">3</div>
                    <h2 class="forevestor-section-title">Deposit & Payment Terms</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>3.1:</strong> Investments can be made using supported payment methods including
                            Bank Transfer, USDT, BTC, or other digital wallets.</li>
                        <li><strong>3.2:</strong> The minimum investment amount is ₹10,000, and there is no maximum
                            limit.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">4</div>
                    <h2 class="forevestor-section-title">Referral Program</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>4.1:</strong> Registered users can earn referral commissions by inviting new
                            investors.</li>
                        <li><strong>4.2:</strong> Referral bonuses are credited instantly once the referred investor
                            activates a plan.</li>
                        <li><strong>4.3:</strong> Any misuse or fake account creation to claim bonuses will result
                            in account suspension.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">5</div>
                    <h2 class="forevestor-section-title">Account & Security</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>5.1:</strong> Investors must provide accurate personal details during
                            registration.</li>
                        <li><strong>5.2:</strong> Each user is responsible for maintaining the confidentiality of
                            their account credentials.</li>
                        <li><strong>5.3:</strong> The platform is not responsible for any loss due to unauthorized
                            access or user negligence.</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">6</div>
                    <h2 class="forevestor-section-title">Profit Distribution & Reinvestment</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>6.1:</strong> Weekly ROI can be withdrawn or reinvested into a new plan.</li>
                        <li><strong>6.2:</strong> Reinvestment compounds profits and increases your earning
                            potential.</li>
                        <li><strong>6.3:</strong> ROI is calculated on active capital only (excluding pending
                            withdrawal amounts).</li>
                    </ul>
                </div>
            </div>
            <div class="forevestor-section-block">
                <div class="forevestor-section-header">
                    <div class="forevestor-section-number">7</div>
                    <h2 class="forevestor-section-title">Termination of Account</h2>
                </div>
                <div class="forevestor-section-content">
                    <ul class="forevestor-policy-list">
                        <li><strong>9.1:</strong> The platform reserves the right to terminate or suspend accounts
                            in cases of fraud, misrepresentation, or breach of terms.</li>
                        <li><strong>9.2:</strong> Remaining funds, after applicable deductions, will be refunded
                            within 7–10 business days.</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- LICENSE DOWNLOAD -->


<!-- LICENSE DOWNLOAD -->
<div class="text-center my-5">
    <h2 class="mb-3" id="license-download">Download Our License</h2>
    <p class="mb-4">
        Forevestor is a fully licensed and regulated investment platform. You can download a copy of our official
        license for your records.
    </p>
    <a href="{{ asset('/assets/license/forevestor-license.pdf') }}" download class="btn btn-warning btn-lg">
        <i class="fas fa-file-download me-2"></i> Download License
    </a>
</div>



@endsection