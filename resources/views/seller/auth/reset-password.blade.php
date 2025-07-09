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
    <title>DjibMarket - Reset Password</title>
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

        .form-input.success {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
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

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            width: 100%;
            height: 6px;
            background-color: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        .strength-fill.weak {
            background-color: #ef4444;
            width: 25%;
        }

        .strength-fill.fair {
            background-color: #f59e0b;
            width: 50%;
        }

        .strength-fill.good {
            background-color: #3b82f6;
            width: 75%;
        }

        .strength-fill.strong {
            background-color: #10b981;
            width: 100%;
        }

        .strength-text {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .strength-text.weak {
            color: #ef4444;
        }

        .strength-text.fair {
            color: #f59e0b;
        }

        .strength-text.good {
            color: #3b82f6;
        }

        .strength-text.strong {
            color: #10b981;
        }

        .password-requirements {
            margin-top: 0.5rem;
            font-size: 0.75rem;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 0.25rem;
            color: #6b7280;
        }

        .requirement.met {
            color: #10b981;
        }

        .requirement-icon {
            width: 12px;
            height: 12px;
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

        .login-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .login-text {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .login-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: color 0.2s ease;
        }

        .login-link:hover {
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

        .form-group:nth-of-type(1) {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .form-group:nth-of-type(2) {
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .submit-btn {
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        .login-section {
            animation: fadeInUp 0.6s ease-out 0.7s both;
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
        <!-- Left Side - Reset Password Form -->
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
                <h1 class="page-title">Reset Password</h1>
                <p class="page-subtitle">Create a new secure password for your account</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Display error messages --}}
            @if (session('error'))
                <x-alert-summary type="error" :messages="[session('error')]" />
            @endif

            <form action="{{ route('seller.password.store') }}" method="post" id="resetForm">
                @csrf

                <!-- Hidden fields -->
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label class="form-label" for="password">New Password</label>
                    <input type="password" class="form-input {{ $errors->get('password') ? 'error' : '' }}"
                        id="password" name="password" placeholder="Enter your new password" required>
                    @if ($errors->get('password'))
                        <div class="error-message">{{ $errors->get('password')[0] }}</div>
                    @endif

                    <!-- Password Strength Indicator -->
                    <div class="password-strength" id="passwordStrength" style="display: none;">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>

                        <div class="password-requirements">
                            <div class="requirement" id="lengthReq">
                                <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                At least 8 characters
                            </div>
                            <div class="requirement" id="uppercaseReq">
                                <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                One uppercase letter
                            </div>
                            <div class="requirement" id="lowercaseReq">
                                <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                One lowercase letter
                            </div>
                            <div class="requirement" id="numberReq">
                                <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                One number
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password"
                        class="form-input {{ $errors->get('password_confirmation') ? 'error' : '' }}"
                        id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm your new password" required>
                    @if ($errors->get('password_confirmation'))
                        <div class="error-message">{{ $errors->get('password_confirmation')[0] }}</div>
                    @endif
                    <div id="passwordMatch" style="display: none;">
                        <div class="requirement" id="matchReq">
                            <svg class="requirement-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Passwords match
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitButton" disabled>
                    <span class="button-text">Reset Password</span>
                    <div class="loading-spinner" id="loadingSpinner" style="display: none;"></div>
                </button>
            </form>

            <div class="login-section">
                <span class="login-text">Remember your password?</span>
                <a href="{{ route('seller.login') }}" class="login-link">Sign in</a>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="auth-image-section">
            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Reset Password"
                class="background-image">
            <div class="image-overlay"></div>

            <div class="floating-elements">
                <div class="floating-element"></div>
                <div class="floating-element"></div>
                <div class="floating-element"></div>
            </div>

            <div class="image-content">
                <div class="seller-badge">Secure Reset</div>
                <h2 class="hero-title">New Password, Fresh Start</h2>
                <p class="hero-subtitle">Create a strong password to keep your seller account secure and protected</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            let score = 0;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(password)
            };

            // Count met requirements
            Object.values(requirements).forEach(met => {
                if (met) score++;
            });

            // Update requirement indicators
            updateRequirement('lengthReq', requirements.length);
            updateRequirement('uppercaseReq', requirements.uppercase);
            updateRequirement('lowercaseReq', requirements.lowercase);
            updateRequirement('numberReq', requirements.number);

            // Determine strength level
            let strength = 'weak';
            let strengthText = 'Weak';

            if (score === 4) {
                strength = 'strong';
                strengthText = 'Strong';
            } else if (score === 3) {
                strength = 'good';
                strengthText = 'Good';
            } else if (score === 2) {
                strength = 'fair';
                strengthText = 'Fair';
            }

            // Update strength indicator
            const strengthFill = document.getElementById('strengthFill');
            const strengthTextEl = document.getElementById('strengthText');

            strengthFill.className = `strength-fill ${strength}`;
            strengthTextEl.className = `strength-text ${strength}`;
            strengthTextEl.textContent = strengthText;

            return {
                score,
                requirements
            };
        }

        function updateRequirement(elementId, met) {
            const element = document.getElementById(elementId);
            const icon = element.querySelector('.requirement-icon');

            if (met) {
                element.classList.add('met');
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
            } else {
                element.classList.remove('met');
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
            }
        }

        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const matchReq = document.getElementById('matchReq');
            const passwordMatch = document.getElementById('passwordMatch');

            if (confirmation.length > 0) {
                passwordMatch.style.display = 'block';
                updateRequirement('matchReq', password === confirmation && password.length > 0);
            } else {
                passwordMatch.style.display = 'none';
            }
        }

        function updateSubmitButton() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const submitButton = document.getElementById('submitButton');

            const {
                score
            } = checkPasswordStrength(password);
            const passwordsMatch = password === confirmation && password.length > 0;
            const canSubmit = score >= 3 && passwordsMatch;

            submitButton.disabled = !canSubmit;
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');

            if (password.length > 0) {
                strengthIndicator.style.display = 'block';
                checkPasswordStrength(password);
            } else {
                strengthIndicator.style.display = 'none';
            }

            checkPasswordMatch();
            updateSubmitButton();
        });

        document.getElementById('password_confirmation').addEventListener('input', function() {
            checkPasswordMatch();
            updateSubmitButton();
        });

        // Form submission handling
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const submitButton = document.getElementById('submitButton');
            const buttonText = submitButton.querySelector('.button-text');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Disable the button
            submitButton.disabled = true;

            // Show loading spinner
            loadingSpinner.style.display = 'block';
            buttonText.style.display = 'none';
        });

        // Input focus effects
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
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
            });
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>

</html>
