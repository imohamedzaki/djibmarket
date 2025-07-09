@extends('layouts.guest.buyer')

@section('title', 'Register - djibMarket')

@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/v1/login.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .login-image {
            width: 45%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .login-form-container {
            width: 55%;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            background-color: var(--bg-light);
            transition: background-color 0.3s ease;
            animation: slideInRight 0.8s ease-out;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(50px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 1024px) {
            .login-image {
                display: none;
            }

            .login-form-container {
                width: 100%;
            }
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .language-selector {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.2s;
        }

        .language-selector:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .theme-toggle {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            color: var(--text-light);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .theme-toggle:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .theme-toggle svg {
            width: 20px;
            height: 20px;
        }

        .theme-toggle .moon-icon {
            display: block;
        }

        .theme-toggle .sun-icon {
            display: none;
        }

        .dark-mode .theme-toggle .moon-icon {
            display: none;
        }

        .dark-mode .theme-toggle .sun-icon {
            display: block;
        }

        .login-form-wrapper {
            max-width: 450px;
            width: 100%;
            margin: auto;
            background-color: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        .logo {
            height: 40px;
            margin-bottom: 2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .form-header {
            margin-bottom: 2.5rem;
            animation: fadeIn 0.8s ease-out 0.5s both;
        }

        .form-header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }

        .form-header p {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 1rem;
        }

        .form-header a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .form-header a:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        .form-group {
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(20px);
            animation: formItemFadeIn 0.5s ease-out forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.6s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.8s;
        }

        .form-group:nth-child(3) {
            animation-delay: 1s;
        }

        .form-group:nth-child(4) {
            animation-delay: 1.2s;
        }

        @keyframes formItemFadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: var(--text-light);
            width: 20px;
            height: 20px;
            transition: all 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s;
            background-color: var(--bg-card);
            color: var(--text-dark);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            transform: translateY(-2px);
        }

        .form-control:focus+.input-icon {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .form-control::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            background-size: 200% auto;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            position: relative;
            opacity: 0;
            transform: translateY(20px);
            animation: formItemFadeIn 0.5s ease-out 1.4s forwards;
            overflow: hidden;
        }

        .submit-btn:hover {
            background-position: right center;
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .submit-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .submit-btn:hover:before {
            left: 100%;
        }

        .submit-btn .spinner {
            display: none;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            position: absolute;
            left: 52% !important;
            top: 75%;
            transform: translate(-50%, -50%);
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 3px solid #ffffff;
            box-sizing: border-box;
        }

        .submit-btn.loading .spinner {
            display: block;
        }

        .submit-btn.loading span {
            opacity: 0;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.875rem;
            color: var(--text-light);
            opacity: 0;
            animation: fadeIn 0.5s ease-out 1.6s forwards;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .form-footer a:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        .pattern-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            background-image: url("{{ asset('assets/imgs/template/logo_pattern.png') }}");
            background-size: cover;
            animation: patternFloat 20s linear infinite;
        }

        @keyframes patternFloat {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 100px 100px;
            }
        }

        .brand-logo {
            position: relative;
            z-index: 2;
            width: 180px;
            filter: brightness(0) invert(1);
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            background-color: var(--bg-card);
            animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both;
            transform: translate3d(0, 0, 0);
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert .close {
            margin-left: auto;
            background: none;
            border: none;
            color: currentColor;
            opacity: 0.7;
            cursor: pointer;
            font-size: 1.25rem;
            transition: all 0.2s;
        }

        .alert .close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
    </style>
@endsection

@section('content')
    <div class="login-container">
        <div class="login-image">
            <div class="pattern-overlay"></div>
            <img class="brand-logo" src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="djibMarket Logo">
        </div>

        <div class="login-form-container">
            <div class="header">
                <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="djibMarket" class="logo">
                <div class="header-right">
                    <button id="theme-toggle" class="theme-toggle" aria-label="Toggle dark mode">
                        <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </button>
                    <a href="#" class="language-selector">العربية</a>
                </div>
            </div>

            <div class="login-form-wrapper">
                <div class="form-header">
                    <h1>Create an account</h1>
                    <p>Join djibMarket today</p>
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="disabled_submit">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name"
                                required autofocus autocomplete="name" value="{{ old('name') }}">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                </path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email address" required autocomplete="username" value="{{ old('email') }}">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                </rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Create a password" required autocomplete="new-password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                </rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                placeholder="Confirm your password" required autocomplete="new-password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="submit-btn disabled_button">
                        <div class="spinner"></div>
                        <span class="disabled_text">Create Account</span>
                    </button>

                    <div class="form-footer">
                        <p>By signing up, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script>
        $(document).ready(function() {
            $(".alert .close").on("click", function() {
                $(this).closest(".alert").fadeOut(300);
            });

            $("form").on("submit", function(e) {
                if (!$(this).hasClass("disabled_submit")) {
                    const submitBtn = $(this).find(".submit-btn");
                    submitBtn.addClass("loading");
                }
            });

            // Animate focus effects
            $(".form-control").on("focus", function() {
                $(this).parent().addClass("input-focused");
            }).on("blur", function() {
                $(this).parent().removeClass("input-focused");
            });

            // Theme toggle with animation
            const themeToggle = document.getElementById('theme-toggle');
            const htmlElement = document.documentElement;

            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)')
                    .matches)) {
                htmlElement.classList.remove('light-mode');
                htmlElement.classList.add('dark-mode');
            }

            themeToggle.addEventListener('click', function() {
                if (htmlElement.classList.contains('dark-mode')) {
                    htmlElement.classList.remove('dark-mode');
                    htmlElement.classList.add('light-mode');
                    localStorage.setItem('theme', 'light');
                } else {
                    htmlElement.classList.remove('light-mode');
                    htmlElement.classList.add('dark-mode');
                    localStorage.setItem('theme', 'dark');
                }

                // Add rotation animation on theme toggle
                this.style.transform = 'rotate(360deg)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 500);
            });
        });
    </script>
@endsection
