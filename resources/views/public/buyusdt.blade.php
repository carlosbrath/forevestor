@extends('layouts.master')
@section('title', 'Buy USDT')
@section('content')
@push('scripts')

<div class="container-fluid-buyusdt">
    <!-- Header -->
    <div class="header-section">
        <h1><i class="fas fa-coins"></i>Buy USDT</h1>
        <p>Send payment to seller and upload proof</p>
    </div>

    <!-- Hero Section with Integrated Exchange Calculator -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0"
                style="background: linear-gradient(135deg, #dda125 0%, #dda125 100%); color: white;">
                <div class="card-body p-4">

                    <div class="row align-items-center">

                        <!-- Left Content -->
                        <div class="col-md-8">
                            <h3 class="mb-3">
                                <i class="bi bi-lightning-charge me-2"></i>Instant USDT Purchase
                            </h3>

                            <p class="mb-3">
                                Get USDT instantly at the best rates in the market. Safe, secure, and hassle-free
                                transactions.
                            </p>

                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>Best exchange rates
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>Instant delivery to your wallet
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>24/7 customer support
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill me-2"></i>Secure and verified transactions
                                </li>
                            </ul>
                        </div>

                        <!-- Right Section (Exchange Calculator) -->
                        <div class="col-md-4">
                            <div class="p-4 bg-white bg-opacity-10 rounded text-center">

                                <h4 class="mb-3">Live Exchange Calculator</h4>

                                <!-- Current Rate -->
                                <div class="rate-info mb-3">
                                    <div class="rate-label">1 USDT =</div>
                                    <div class="rate-value" id="exchangeRate" style="font-size: 2rem;">₹89.96</div>
                                    <div class="rate-subtext small">
                                        <small>(Live from CoinGecko)</small>
                                    </div>
                                </div>

                                <!-- You Pay -->
                                <div class="rate-info mb-3">
                                    <div class="rate-label">You Pay</div>
                                    <div class="rate-value" style="font-size: 2rem;">
                                        <span id="totalAmount">₹0.00</span>
                                    </div>
                                    <div class="rate-subtext small">
                                        for <span id="displayAmount">0</span> USDT
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div> <!-- row end -->

                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Step 1: USDT Amount -->
            <div class="form-card">
                <h3>
                    <span class="step-badge">1</span>
                    How Much USDT Do You Want?
                </h3>
                <div class="input-group">
                    <input type="number" class="form-control" id="usdtAmount" placeholder="Enter amount in USDT"
                        min="1" />
                    <span class="input-group-text">USDT</span>
                </div>
            </div>

            <!-- Step 2: Seller Account Details -->
            <div class="form-card">
                <h3>
                    <span class="step-badge">2</span>
                    Send Payment to Seller Account
                </h3>

                <div class="seller-card">
                    <div class="seller-detail">
                        <div>
                            <div class="seller-detail-label">Account Holder Name</div>
                            <div class="seller-detail-value">
                                USDT Trading Solutions Pvt Ltd
                            </div>
                        </div>
                        <button type="button" class="copy-btn"
                            onclick="copyToClipboard('USDT Trading Solutions Pvt Ltd')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="seller-detail">
                                <div>
                                    <div class="seller-detail-label">Account Number</div>
                                    <div class="seller-detail-value">5234891234567890</div>
                                </div>
                                <button type="button" class="copy-btn" onclick="copyToClipboard('5234891234567890')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="seller-detail">
                                <div>
                                    <div class="seller-detail-label">IFSC Code</div>
                                    <div class="seller-detail-value">HDFC0001234</div>
                                </div>
                                <button type="button" class="copy-btn" onclick="copyToClipboard('HDFC0001234')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="seller-detail">
                                <div>
                                    <div class="seller-detail-label">Bank Name</div>
                                    <div class="seller-detail-value">HDFC Bank</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="seller-detail">
                                <div>
                                    <div class="seller-detail-label">Branch</div>
                                    <div class="seller-detail-value">New Delhi Main</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="seller-detail">
                        <div>
                            <div class="seller-detail-label">UPI ID (Alternative)</div>
                            <div class="seller-detail-value">usdttrading@hdfc</div>
                        </div>
                        <button type="button" class="copy-btn" onclick="copyToClipboard('usdttrading@hdfc')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>

                    <div class="alert alert-warning mb-0" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Make sure to transfer exactly
                        <strong id="amountAlert">₹0.00</strong> to this account
                    </div>
                </div>
            </div>

            <!-- Step 3: Your Details -->
            <div class="form-card">
                <h3>
                    <span class="step-badge">3</span>
                    Your Details
                </h3>

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required />
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number"
                            pattern="[0-9]{10,15}" title="Phone number must be 10-15 digits" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">USDT Wallet Address (ERC-20)</label>
                    <input type="text" class="form-control" id="walletAddress" placeholder="0x..."
                        pattern="^0x[a-fA-F0-9]{40}$"
                        title="Valid Ethereum wallet address (0x followed by 40 hex chars)" required />
                </div>
            </div>

            <!-- Step 4: Upload Proof -->
            <div class="form-card">
                <h3>
                    <span class="step-badge">4</span>
                    Upload Payment Proof
                </h3>

                <p class="text-muted mb-4">
                    Upload screenshot of bank transfer, UPI receipt, or payment
                    confirmation
                </p>

                <div class="upload-area" onclick="document.getElementById('fileInput').click()" id="uploadArea">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p id="uploadText">Click to upload or drag and drop</p>
                    <small>PNG, JPG, GIF up to 10MB</small>
                </div>

                <input type="file" id="fileInput" accept="image/*" style="display: none" />

                <img id="previewImg" class="preview-img" style="display: none" />
            </div>
        </div>

        <!-- Right Column: Summary -->
        <div class="col-lg-4">
            <div class="summary-card">
                <h4>Order Summary</h4>

                <div class="summary-row">
                    <span class="summary-label">USDT Amount</span>
                    <span class="summary-value"><span id="summaryUSDT">0</span> USDT</span>
                </div>

                <div class="summary-row">
                    <span class="summary-label">Exchange Rate</span>
                    <span class="summary-value" id="summaryRate">₹89.96</span>
                </div>

                <div class="summary-row">
                    <span class="summary-label">Total Amount</span>
                    <span class="summary-value summary-total"><span id="summaryTotal">₹0.00</span></span>
                </div>

                <button class="btn-submit" id="submitBtn" onclick="submitForm()">
                    <i class="fas fa-check-circle me-2"></i><span id="submitBtnText">Submit for
                        Verification</span>
                </button>

                <small>Your USDT will be credited within 30 minutes of
                    verification</small>
            </div>
        </div>
    </div>
</div>

<!-- Toast Messages -->
<div class="toast-container" id="toastContainer"></div>
@push('scripts')
<script>
let currentRate = 89.96; // Fallback rate as of Dec 10, 2025

let selectedFile = null;

// Fetch live exchange rate on page load
async function fetchExchangeRate() {
    try {
        const response = await fetch(
            "https://api.coingecko.com/api/v3/simple/price?ids=tether&vs_currencies=inr"
        );
        const data = await response.json();
        currentRate = data.tether.inr;
        document.getElementById(
            "exchangeRate"
        ).textContent = `₹${currentRate.toFixed(2)}`;
        document.getElementById(
            "summaryRate"
        ).textContent = `₹${currentRate.toFixed(2)}`;
        showToast("Exchange rate updated live!", "success");
    } catch (error) {
        console.error("Failed to fetch rate:", error);
        showToast("Using fallback rate. Please refresh.", "error");
    }
}

fetchExchangeRate();

// Update amounts on input change
document
    .getElementById("usdtAmount")
    .addEventListener("input", function() {
        const amount = parseFloat(this.value) || 0;
        const totalAmount = (amount * currentRate).toFixed(2);

        document.getElementById("totalAmount").textContent =
            "₹" + totalAmount;
        document.getElementById("displayAmount").textContent = amount;
        document.getElementById("amountAlert").textContent =
            "₹" + totalAmount;
        document.getElementById("summaryUSDT").textContent = amount;
        document.getElementById("summaryTotal").textContent =
            "₹" + totalAmount;
    });

// File upload
const uploadArea = document.getElementById("uploadArea");
const fileInput = document.getElementById("fileInput");
const uploadText = document.getElementById("uploadText");
const previewImg = document.getElementById("previewImg");

fileInput.addEventListener("change", handleFile);

uploadArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    uploadArea.classList.add("active");
});

uploadArea.addEventListener("dragleave", () => {
    uploadArea.classList.remove("active");
});

uploadArea.addEventListener("drop", (e) => {
    e.preventDefault();
    uploadArea.classList.remove("active");
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        handleFile();
    }
});

function handleFile() {
    selectedFile = fileInput.files[0];
    if (selectedFile) {
        // Validation
        const maxSize = 10 * 1024 * 1024; // 10MB
        const allowedTypes = ["image/png", "image/jpeg", "image/gif"];
        if (selectedFile.size > maxSize) {
            showToast("File too large! Maximum 10MB allowed.", "error");
            fileInput.value = "";
            selectedFile = null;
            return;
        }
        if (!allowedTypes.includes(selectedFile.type)) {
            showToast(
                "Invalid file type! Only PNG, JPG, GIF allowed.",
                "error"
            );
            fileInput.value = "";
            selectedFile = null;
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            previewImg.style.display = "block";
            uploadText.textContent = `${selectedFile.name} (${(
              selectedFile.size /
              1024 /
              1024
            ).toFixed(2)} MB)`;
        };
        reader.readAsDataURL(selectedFile);
    }
}

// Copy to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target.closest(".copy-btn");
        const icon = btn.querySelector("i");
        icon.classList.remove("fa-copy");
        icon.classList.add("fa-check");
        btn.classList.add("copied");

        setTimeout(() => {
            icon.classList.remove("fa-check");
            icon.classList.add("fa-copy");
            btn.classList.remove("copied");
        }, 2000);
    });
}

// Submit form using FormData (preserves original image format)
async function submitForm() {
    const amount = document.getElementById("usdtAmount").value;
    const fullName = document.getElementById("fullName").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const walletAddress = document
        .getElementById("walletAddress")
        .value.trim();
    const submitBtn = document.getElementById("submitBtn");
    const submitBtnText = document.getElementById("submitBtnText");

    // Validation
    if (!amount || parseFloat(amount) < 1) {
        showToast("Please enter a valid USDT amount (minimum 1).", "error");
        return;
    }
    if (!fullName) {
        showToast("Please enter your full name.", "error");
        return;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showToast("Please enter a valid email address.", "error");
        return;
    }
    if (phone.length < 10 || phone.length > 15 || !/^\d+$/.test(phone)) {
        showToast(
            "Please enter a valid phone number (10-15 digits).",
            "error"
        );
        return;
    }
    const walletRegex = /^0x[a-fA-F0-9]{40}$/;
    if (!walletRegex.test(walletAddress)) {
        showToast(
            "Please enter a valid USDT wallet address (ERC-20).",
            "error"
        );
        return;
    }
    if (!selectedFile) {
        showToast("Please upload payment proof.", "error");
        return;
    }

    submitBtn.disabled = true;
    submitBtnText.textContent = "Submitting...";

    try {
        const formData = new FormData();
        formData.append("access_key", WEB3FORMS_API_KEY);
        formData.append("from_name", fullName);
        formData.append("email", email);
        formData.append("phone", phone);
        formData.append("wallet_address", walletAddress);
        formData.append("usdt_amount", amount);
        formData.append("exchange_rate", currentRate.toFixed(2));
        formData.append("total_amount", (amount * currentRate).toFixed(2));
        formData.append(
            "message",
            `USDT Purchase Request:\n\nName: ${fullName}\nEmail: ${email}\nPhone: ${phone}\nWallet Address: ${walletAddress}\nUSDT Amount: ${amount}\nExchange Rate: ₹${currentRate.toFixed(
              2
            )}\nTotal Amount: ₹${(amount * currentRate).toFixed(
              2
            )}\n\nPayment Proof: Image attached as file.`
        );
        formData.append("payment_proof", selectedFile); // Original file format (PNG/JPG/etc.)

        const response = await fetch("https://api.web3forms.com/submit", {
            method: "POST",
            body: formData, // Multipart/form-data auto-set
        });

        const data = await response.json();

        console.log("Response:", data);

        if (data.success) {
            showToast(
                "✓ Your USDT purchase request submitted successfully!",
                "success"
            );

            // Clear form after delay
            setTimeout(() => {
                document.getElementById("usdtAmount").value = "";
                document.getElementById("fullName").value = "";
                document.getElementById("email").value = "";
                document.getElementById("phone").value = "";
                document.getElementById("walletAddress").value = "";
                fileInput.value = "";
                previewImg.style.display = "none";
                uploadText.textContent = "Click to upload or drag and drop";
                selectedFile = null;
                document.getElementById("totalAmount").textContent = "₹0.00";
                document.getElementById("displayAmount").textContent = "0";
                document.getElementById("amountAlert").textContent = "₹0.00";
                document.getElementById("summaryUSDT").textContent = "0";
                document.getElementById("summaryTotal").textContent = "₹0.00";

                submitBtn.disabled = false;
                submitBtnText.textContent = "Submit for Verification";
            }, 1500);
        } else {
            showToast(
                "Error: " + (data.message || "Please try again"),
                "error"
            );
            console.error("API Error:", data);
            submitBtn.disabled = false;
            submitBtnText.textContent = "Submit for Verification";
        }
    } catch (error) {
        console.error("Error:", error);
        showToast(
            "Network error. Please check your connection and try again.",
            "error"
        );
        submitBtn.disabled = false;
        submitBtnText.textContent = "Submit for Verification";
    }
}

// Show toast
function showToast(message, type) {
    const toastContainer = document.getElementById("toastContainer");
    const toastClass = type === "success" ? "toast-success" : "toast-error";
    const icon =
        type === "success" ? "fa-check-circle" : "fa-exclamation-circle";

    const toast = document.createElement("div");
    toast.className = toastClass;
    toast.innerHTML = `<i class="fas ${icon}"></i><span>${message}</span>`;

    toastContainer.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 4000);
}
</script>


@endpush
@endsection