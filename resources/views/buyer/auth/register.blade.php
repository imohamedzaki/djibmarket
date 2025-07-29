<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="DjibMarket - Your premier online marketplace for buying and selling products in Djibouti">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template') }}/favicon.png" sizes="32x26">
    <!-- Page Title  -->
    <title>Register - DjibMarket</title>
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
            background: linear-gradient(90deg, #e3fff7 0%, #d9e7ff 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.5;
            padding: 1rem;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            max-width: 95%;
            width: 100%;
            min-height: 700px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            position: relative;
        }

        /* Left Side - Form */
        .auth-form-section {
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow-y: auto;
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
            margin-bottom: 2rem;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .brand-logo img {
            width: 32px;
            mix-blend-mode: screen;
            filter: brightness(0) invert(1);
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

        .register-form {
            space-y: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-input:disabled {
            background-color: #f3f4f6;
            color: #6b7280;
            cursor: not-allowed;
            border-color: #d1d5db;
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

        .submit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
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

        .signin-section {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .signin-text {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .signin-link {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: color 0.2s ease;
        }

        .signin-link:hover {
            color: #059669;
            text-decoration: underline;
        }

        .terms-section {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .terms-section a {
            color: #10b981;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .terms-section a:hover {
            color: #059669;
            text-decoration: underline;
        }

        /* Password Requirements Styles */
        .password-requirements {
            margin-top: 0.75rem;
            padding: 1rem;
            border-radius: 10px;
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.8rem;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .requirement-item:last-child {
            margin-bottom: 0;
        }

        .requirement-item.met {
            color: #10b981;
        }

        .requirement-icon {
            margin-right: 0.5rem;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #e5e7eb;
            transition: all 0.3s ease;
        }

        .requirement-item.met .requirement-icon {
            background-color: #10b981;
        }

        .requirement-icon i {
            font-size: 8px;
            color: white;
        }

        .password-strength-bar {
            height: 4px;
            background-color: #e5e7eb;
            margin-bottom: 0.75rem;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .strength-progress {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 2px;
            background-color: #f59e0b;
        }

        .strength-progress.weak {
            background-color: #ef4444;
            width: 25%;
        }

        .strength-progress.fair {
            background-color: #f59e0b;
            width: 50%;
        }

        .strength-progress.good {
            background-color: #06b6d4;
            width: 75%;
        }

        .strength-progress.strong {
            background-color: #10b981;
            width: 100%;
        }

        .strength-label {
            font-size: 0.75rem;
            margin-bottom: 0.75rem;
            text-align: right;
            font-weight: 500;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .strength-label.weak {
            color: #ef4444;
        }

        .strength-label.fair {
            color: #f59e0b;
        }

        .strength-label.good {
            color: #06b6d4;
        }

        .strength-label.strong {
            color: #10b981;
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
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.8) 0%, #06b6d4 100%);
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

        .buyer-badge {
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

        .register-form .form-group:nth-of-type(1) {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .register-form .form-group:nth-of-type(2) {
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .submit-btn {
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        .signin-section {
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

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
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
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <!-- Left Side - Registration Form -->
        <div class="auth-form-section">
            <a href="{{ route('buyer.home') }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="m19 12H5"></path>
                </svg>
                Back to home
            </a>

            <div class="brand-section">
                <div class="brand-logo">
                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo">
                </div>
                <h1 class="page-title">Create Account</h1>
                <p class="page-subtitle">Join DjibMarket and start shopping</p>
            </div>

            @if ($errors->any())
                <div class="error-message"
                    style="margin-bottom: 1rem; padding: 0.75rem; background-color: #fef2f2; border: 1px solid #fecaca; border-radius: 8px;">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm" class="register-form">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" class="form-input {{ $errors->get('name') ? 'error' : '' }}" id="name"
                        name="name" placeholder="Enter your full name" value="{{ old('name') }}" required
                        autofocus>
                    @if ($errors->get('name'))
                        <div class="error-message">{!! $errors->get('name')[0] !!}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-input {{ $errors->get('email') ? 'error' : '' }}" id="email"
                        name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                    @if ($errors->get('email'))
                        <div class="error-message">{!! $errors->get('email')[0] !!}</div>
                    @endif
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-input {{ $errors->get('password') ? 'error' : '' }}"
                            id="password" name="password" placeholder="Create a password" required>
                        @if ($errors->get('password'))
                            <div class="error-message">{{ $errors->get('password')[0] }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <input type="password"
                            class="form-input {{ $errors->get('password_confirmation') ? 'error' : '' }}"
                            id="password_confirmation" name="password_confirmation" placeholder="Confirm your password"
                            required>
                        @if ($errors->get('password_confirmation'))
                            <div class="error-message">{{ $errors->get('password_confirmation')[0] }}</div>
                        @endif
                    </div>
                </div>

                <div class="password-requirements">
                    <div class="password-strength-bar">
                        <div class="strength-progress"></div>
                    </div>
                    <div class="strength-label">Password Strength</div>
                    <div class="requirement-list">
                        <div class="requirement-item" data-requirement="length">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement-item" data-requirement="lowercase">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>At least 1 lowercase letter</span>
                        </div>
                        <div class="requirement-item" data-requirement="uppercase">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>At least 1 uppercase letter</span>
                        </div>
                        <div class="requirement-item" data-requirement="number">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>At least 1 number</span>
                        </div>
                        <div class="requirement-item" data-requirement="special">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>At least 1 special character</span>
                        </div>
                        <div class="requirement-item" data-requirement="match">
                            <span class="requirement-icon"><i class="ni ni-check"></i></span>
                            <span>Passwords match</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitButton">
                    <span class="button-text">Create Account</span>
                    <div class="loading-spinner" id="loadingSpinner" style="display: none;"></div>
                </button>
            </form>

            <div class="signin-section">
                <span class="signin-text">Already have an account?</span>
                <a href="{{ route('login') }}" class="signin-link">Sign in</a>
            </div>

            <div class="terms-section">
                <p>By signing up, you agree to our <a href="#">Terms of Service</a> and <a
                        href="#">Privacy Policy</a></p>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="auth-image-section">
            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Join DjibMarket"
                class="background-image">
            <div class="image-overlay"></div>

            <div class="floating-elements">
                <div class="floating-element"></div>
                <div class="floating-element"></div>
                <div class="floating-element"></div>
            </div>

            <div class="image-content">
                <div class="buyer-badge">Join Us</div>
                <h2 class="hero-title">Start Your Shopping Journey</h2>
                <p class="hero-subtitle">Create your account and discover thousands of amazing products from trusted
                    sellers across Djibouti</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script>
        // Form submission handling
        document.getElementById('registerForm').addEventListener('submit', function(e) {
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

        // Password strength checker
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const strengthProgress = document.querySelector('.strength-progress');
            const strengthLabel = document.querySelector('.strength-label');
            const requirementItems = document.querySelectorAll('.requirement-item');

            // Initialize default state
            strengthProgress.classList.remove('weak', 'fair', 'good', 'strong');
            strengthLabel.classList.remove('weak', 'fair', 'good', 'strong');
            strengthLabel.textContent = 'Password Strength';
            requirementItems.forEach(item => item.classList.remove('met'));

            function updatePasswordStrength(password, confirmPassword) {
                // If password is empty, reset to default state
                if (!password || password.length === 0) {
                    strengthProgress.classList.remove('weak', 'fair', 'good', 'strong');
                    strengthLabel.classList.remove('weak', 'fair', 'good', 'strong');
                    strengthLabel.textContent = 'Password Strength';
                    requirementItems.forEach(item => item.classList.remove('met'));
                    return;
                }

                // Reset requirements
                requirementItems.forEach(item => item.classList.remove('met'));

                // Check each requirement
                const requirements = {
                    length: password.length >= 8,
                    lowercase: /[a-z]/.test(password),
                    uppercase: /[A-Z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password),
                    match: password === confirmPassword && password !== ''
                };

                // Update requirement items
                Object.keys(requirements).forEach(req => {
                    if (requirements[req]) {
                        const item = document.querySelector(`.requirement-item[data-requirement="${req}"]`);
                        if (item) item.classList.add('met');
                    }
                });

                // Calculate strength (excluding "match" from strength calculation)
                const strengthRequirements = {
                    length: requirements.length,
                    lowercase: requirements.lowercase,
                    uppercase: requirements.uppercase,
                    number: requirements.number,
                    special: requirements.special
                };

                let metCount = Object.values(strengthRequirements).filter(Boolean).length;
                let strengthClass = '';
                let strengthText = '';

                // Update strength bar and label
                switch (metCount) {
                    case 0:
                    case 1:
                        strengthClass = 'weak';
                        strengthText = 'Weak';
                        break;
                    case 2:
                    case 3:
                        strengthClass = 'fair';
                        strengthText = 'Fair';
                        break;
                    case 4:
                        strengthClass = 'good';
                        strengthText = 'Good';
                        break;
                    case 5:
                        strengthClass = 'strong';
                        strengthText = 'Strong';
                        break;
                }

                // Remove all classes and add the relevant one
                strengthProgress.classList.remove('weak', 'fair', 'good', 'strong');
                strengthLabel.classList.remove('weak', 'fair', 'good', 'strong');
                strengthProgress.classList.add(strengthClass);
                strengthLabel.classList.add(strengthClass);
                strengthLabel.textContent = strengthText;
            }

            // Check password on input
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const confirmPassword = confirmPasswordInput.value;
                updatePasswordStrength(password, confirmPassword);
            });

            // Check confirm password on input
            confirmPasswordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                updatePasswordStrength(password, confirmPassword);
            });

            // Also check for password clear via backspace/delete
            passwordInput.addEventListener('keyup', function(e) {
                const password = this.value;
                const confirmPassword = confirmPasswordInput.value;
                if (!password || password.length === 0) {
                    updatePasswordStrength('', confirmPassword);
                }
            });

            confirmPasswordInput.addEventListener('keyup', function(e) {
                const password = passwordInput.value;
                const confirmPassword = this.value;
                if (!confirmPassword || confirmPassword.length === 0) {
                    updatePasswordStrength(password, '');
                }
            });
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';
    </script>
</body>

</html>
