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
    <title>DjibMarket - Admin Login</title>
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
            background: linear-gradient(135deg, #573894 0%, #002D72 100%) !important;
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
            background: linear-gradient(135deg, #573894 0%, #002D72 100%);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(87, 56, 148, 0.3);
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

        .login-form {
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
            border-color: #573894;
            box-shadow: 0 0 0 3px rgba(87, 56, 148, 0.1);
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

        .warning-message {
            color: #f59e0b;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .info-message {
            color: #573894;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .password-section {
            position: relative;
        }

        .forgot-link {
            display: block;
            text-align: right;
            color: #573894;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #002D72;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #573894 0%, #002D72 100%);
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
            box-shadow: 0 10px 25px rgba(87, 56, 148, 0.3);
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

        .signup-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .signup-text {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .signup-link {
            color: #573894;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
            transition: color 0.2s ease;
        }

        .signup-link:hover {
            color: #002D72;
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
            background: linear-gradient(135deg, rgba(87, 56, 148, 0.8) 0%, rgba(0, 45, 114, 0.9) 100%);
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

        .admin-badge {
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

        .login-form .form-group:nth-of-type(1) {
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .login-form .form-group:nth-of-type(2) {
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .submit-btn {
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        .signup-section {
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
        <!-- Left Side - Login Form -->
        <div class="auth-form-section">
            <a href="/" class="back-link">
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
                <h1 class="page-title">Admin Access</h1>
                <p class="page-subtitle">Sign in to your admin dashboard</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Display success messages --}}
            @if (session('success'))
                <div class="info-message mb-4">{{ session('success') }}</div>
            @endif

            {{-- Display error messages --}}
            @if (session('error'))
                <div class="error-message mb-4">{{ session('error') }}</div>
            @endif

            {{-- Display info messages --}}
            @if (session('info'))
                <div class="info-message mb-4">{{ session('info') }}</div>
            @endif

            <form action="{{ route('admin.login') }}" method="post" id="loginForm" class="login-form">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-input {{ $errors->get('email') ? 'error' : '' }}" id="email"
                        name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                    @if ($errors->get('email'))
                        <div class="error-message">{!! $errors->get('email')[0] !!}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="password-section">
                        <input type="password" class="form-input {{ $errors->get('password') ? 'error' : '' }}"
                            id="password" name="password" placeholder="Enter your password" required>
                        @if ($errors->get('password'))
                            <div class="error-message">{{ $errors->get('password')[0] }}</div>
                        @endif
                        <a href="{{ route('admin.password.request') }}" class="forgot-link">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitButton">
                    <span class="button-text">Access Dashboard</span>
                    <div class="loading-spinner" id="loadingSpinner" style="display: none;"></div>
                </button>
            </form>

            <div class="signup-section">
                <span class="signup-text">Need admin access?</span>
                <a href="{{ route('admin.register') }}" class="signup-link">Request account</a>
            </div>
        </div>

        <!-- Right Side - Image Section -->
        <div class="auth-image-section">
            <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="Admin Dashboard"
                class="background-image">
            <div class="image-overlay"></div>

            <div class="floating-elements">
                <div class="floating-element"></div>
                <div class="floating-element"></div>
                <div class="floating-element"></div>
            </div>

            <div class="image-content">
                <div class="admin-badge">Admin Portal</div>
                <h2 class="hero-title">Manage DjibMarket</h2>
                <p class="hero-subtitle">Access powerful admin tools to manage users, products, orders, and system settings with complete control</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
    <script>
        // Form submission handling
        document.getElementById('loginForm').addEventListener('submit', function(e) {
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