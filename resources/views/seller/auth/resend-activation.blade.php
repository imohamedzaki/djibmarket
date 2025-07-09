<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="DjibMarket - Your premier online marketplace for buying and selling products in Djibouti">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template') }}/favicon.png">
    <!-- Page Title  -->
    <title>DjibMarket - Resend Verification Email</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/shared') }}/css/dashlite.css?ver=3.2.2">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.5;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            min-height: 650px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
        }

        /* Left Side - Form */
        .auth-form-section {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .back-link {
            position: absolute;
            top: 2rem;
            left: 2.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: #374151;
            transform: translateX(-2px);
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .brand-logo svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 1rem;
            font-weight: 400;
        }

        .resend-form {
            space-y: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: #ffffff;
            color: #111827;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .countdown-section {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 10px;
            margin: 1rem 0;
            text-align: center;
            display: none;
        }

        .countdown-text {
            color: #856404;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .countdown-timer {
            font-size: 1.25rem;
            font-weight: 700;
            color: #d97706;
            margin-top: 0.5rem;
        }

        .back-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .back-text {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .back-link-text {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: color 0.2s ease;
        }

        .back-link-text:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        /* Right Side - Image */
        .auth-image-section {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.8) 0%, #09c2de 100%);
            z-index: 1;
        }

        .image-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 2rem;
            max-width: 91%;
        }

        .seller-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: 'Inter';
            color: #fff;
            width: 100%;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            line-height: 1.6;
            font-weight: 400;
            position: relative;
            top: 2rem;
        }

        .background-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .floating-elements {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 30%;
            animation-delay: 4s;
        }

        /* Animations */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Page animations */
        .auth-container {
            animation: fadeInUp 0.6s ease-out;
        }

        .brand-section {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .form-group:nth-child(1) {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .submit-btn {
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .back-section {
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-container {
                grid-template-columns: 1fr;
                margin: 1rem;
                border-radius: 16px;
                min-height: auto;
            }

            .auth-form-section {
                padding: 2rem 1.5rem;
                order: 1;
            }

            .auth-image-section {
                min-height: 200px;
                order: 2;
            }

            .back-link {
                top: 1rem;
                left: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .hero-title {
                font-size: 1.5rem;
            }

            .image-content {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .auth-container {
                margin: 0.5rem;
            }

            .auth-form-section {
                padding: 1.5rem 1rem;
            }

            .brand-section {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <!-- Left Side - Resend Form -->
        <div class="auth-form-section">
            <a href="{{ route('seller.login') }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="m19 12H5"></path>
                </svg>
                Back to login
            </a>

            <div class="brand-section">
                <div class="brand-logo">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7V10C2 16 6 20.5 12 22C18 20.5 22 16 22 10V7L12 2Z" fill="currentColor" />
                    </svg>
                </div>
                <h1 class="page-title">Resend Verification</h1>
                <p class="page-subtitle">Enter your email to receive a new verification link</p>
            </div>

            {{-- Display success messages --}}
            @if (session('success'))
                <x-alert-summary type="success" :messages="[session('success')]" />
            @endif

            {{-- Display error messages --}}
            @if (session('error'))
                <x-alert-summary type="error" :messages="[session('error')]" />
            @endif

            {{-- Display info messages --}}
            @if (session('info'))
                <x-alert-summary type="info" :messages="[session('info')]" />
            @endif

            <form action="{{ route('seller.resend-activation') }}" method="post" id="resendForm" class="resend-form">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-input {{ $errors->get('email') ? 'error' : '' }}" id="email"
                        name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                    @if ($errors->get('email'))
                        <div class="error-message">{{ $errors->get('email')[0] }}</div>
                    @endif
                </div>

                <!-- Countdown Section -->
                <div class="countdown-section" id="countdownSection">
                    <div class="countdown-text">Please wait before sending another verification email</div>
                    <div class="countdown-timer" id="countdownTimer">10:00</div>
                </div>

                <button type="submit" class="submit-btn" id="submitButton" disabled>
                    <span class="button-text">Send Verification Email</span>
                    <div class="loading-spinner" id="loadingSpinner" style="display: none;"></div>
                </button>
            </form>

            <div class="back-section">
                <span class="back-text">Remember your login details?</span>
                <a href="{{ route('seller.login') }}" class="back-link-text">Sign in instead</a>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="auth-image-section">
            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Verification Email"
                class="background-image">
            <div class="image-overlay"></div>

            <div class="floating-elements">
                <div class="floating-element"></div>
                <div class="floating-element"></div>
                <div class="floating-element"></div>
            </div>

            <div class="image-content">
                <div class="seller-badge">Email Verification</div>
                <h2 class="hero-title">Resend Your Verification Link</h2>
                <p class="hero-subtitle">Get a fresh verification email sent to your inbox to verify your seller
                    account</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script>
        let countdownInterval;
        let remainingTime = {{ session('time_remaining', 0) }};

        // Form submission handling
        document.getElementById('resendForm').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submitButton');
            const buttonText = submitButton.querySelector('.button-text');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Disable the button
            submitButton.disabled = true;

            // Show loading spinner
            loadingSpinner.style.display = 'block';
            buttonText.style.display = 'none';
        });

        // Real-time countdown functionality
        function startCountdown() {
            const countdownSection = document.getElementById('countdownSection');
            const countdownTimer = document.getElementById('countdownTimer');
            const submitButton = document.getElementById('submitButton');

            if (remainingTime <= 0) {
                countdownSection.style.display = 'none';
                submitButton.disabled = false;
                return;
            }

            countdownSection.style.display = 'block';
            submitButton.disabled = true;

            countdownInterval = setInterval(function() {
                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                    countdownSection.style.display = 'none';
                    submitButton.disabled = false;
                    return;
                }

                const minutes = Math.floor(remainingTime / 60);
                const seconds = remainingTime % 60;
                countdownTimer.textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                remainingTime--;
            }, 1000);
        }

        // Email validation function
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Check remaining time when email is entered
        function checkRemainingTime() {
            const email = document.getElementById('email').value;
            if (!email || !isValidEmail(email)) return;

            fetch('{{ route('seller.resend-activation.remaining-time') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const submitButton = document.getElementById('submitButton');
                    const emailInput = document.getElementById('email');

                    // Remove existing error classes
                    emailInput.classList.remove('error');
                    const existingError = emailInput.parentElement.querySelector('.error-message');
                    if (existingError) {
                        existingError.remove();
                    }

                    if (!data.email_exists) {
                        // Email doesn't exist in database
                        showEmailError('No account found with this email address.');
                        submitButton.disabled = true;
                        return;
                    }

                    if (data.email_verified) {
                        // Email is already verified
                        showEmailError('This email is already verified. You can log in now.');
                        submitButton.disabled = true;
                        return;
                    }

                    // Email exists but not verified, check rate limiting
                    remainingTime = data.remaining;
                    if (countdownInterval) {
                        clearInterval(countdownInterval);
                    }
                    startCountdown();
                })
                .catch(error => {
                    console.error('Error checking remaining time:', error);
                });
        }

        // Show email error message
        function showEmailError(message) {
            const emailInput = document.getElementById('email');
            emailInput.classList.add('error');

            const existingError = emailInput.parentElement.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.textContent = message;
            emailInput.parentElement.appendChild(errorDiv);
        }

        // Enable/disable submit button based on email validity
        function toggleSubmitButton() {
            const email = document.getElementById('email').value;
            const submitButton = document.getElementById('submitButton');

            if (isValidEmail(email)) {
                submitButton.disabled = false;
                // Check email status when valid email is entered
                checkRemainingTime();
            } else {
                submitButton.disabled = true;
                // Clear any existing error messages for invalid format
                const emailInput = document.getElementById('email');
                if (email.length > 0) {
                    showEmailError('Please enter a valid email address.');
                } else {
                    // Clear error when input is empty
                    emailInput.classList.remove('error');
                    const existingError = emailInput.parentElement.querySelector('.error-message');
                    if (existingError) {
                        existingError.remove();
                    }
                }
            }
        }

        // Input focus effects
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
                if (this.id === 'email') {
                    toggleSubmitButton();
                }
            });

            // Remove error state on input
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    this.classList.remove('error');
                    const errorMsg = this.parentElement.querySelector('.error-message');
                    if (errorMsg) {
                        errorMsg.style.display = 'none';
                    }
                }

                // Check email validity on each input
                if (this.id === 'email') {
                    toggleSubmitButton();
                }
            });
        });

        // Initialize countdown if there's remaining time from server
        if (remainingTime > 0) {
            startCountdown();
        }

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>

</html>
