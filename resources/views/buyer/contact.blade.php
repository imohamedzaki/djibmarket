@extends('layouts.app.buyer')

@section('title', 'Contact Us - DjibMarket')

@section('css')
    <style>
        /* Modern Design System */
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --secondary-color: #64748b;
            --accent-color: #10b981;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-light: #94a3b8;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-accent: #f1f5f9;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }

        /* Base Styles */
        .contact-page {
            /* background: linear-gradient(135deg, #a6c1ff 0%, #e3effa 100% 100%); */
            min-height: 100vh;
            position: relative;
            background-color: #f9fafc;
        }

        /* Hero Section */
        .contact-hero {
            padding: 6rem 0 4rem;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .contact-hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            /* color: #557ede; */
            /* color: white; */
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-hero p {
            font-size: 1.25rem;
            /* color: #557ede; */
            max-width: 600px;
            margin: 0 auto;
        }

        /* Main Container */
        .contact-container {
            position: relative;
            z-index: 2;
            margin-top: -2rem;
            padding-bottom: 6rem;
        }

        /* Contact Card */
        .contact-card {
            background: var(--bg-primary);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            margin-bottom: 4rem;
        }

        .contact-form-section {
            padding: 3rem;
        }

        .contact-info-section {
            background: linear-gradient(135deg, #d0e7ff 0%, #e2e8f0 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        /* Form Styling */
        .contact-form h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        .contact-form .subtitle {
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        /* .form-control {
                                                                width: 100%;
                                                                padding: 1rem 1.25rem;
                                                                border: 2px solid var(--border-color);
                                                                border-radius: var(--radius-lg);
                                                                font-size: 1rem;
                                                                transition: all 0.3s ease;
                                                                background: var(--bg-primary);
                                                                color: var(--text-primary);
                                                            }

                                                            .form-control:focus {
                                                                outline: none;
                                                                border-color: var(--primary-color);
                                                                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                                                                transform: translateY(-1px);
                                                            }

                                                            .form-control::placeholder {
                                                                color: var(--text-light);
                                                            } */

        /* textarea.form-control {
                                                            resize: vertical;
                                                            min-height: 120px;
                                                        } */

        /* Button */
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Contact Info */
        .contact-info h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .contact-info .subtitle {
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            font-size: 1.1rem;
        }

        .contact-details {
            display: grid;
            gap: 2rem;
        }

        .contact-detail {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .contact-icon {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .contact-detail-content h4 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .contact-detail-content p {
            color: var(--text-secondary);
            margin: 0;
        }

        .contact-detail-content a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .contact-detail-content a:hover {
            text-decoration: underline;
        }

        /* Support Cards */
        .support-section {
            margin-top: 4rem;
        }

        .support-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .support-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            /* color: white; */
            margin-bottom: 1rem;
        }

        .support-header p {
            font-size: 1.1rem;
            /* color: rgba(255, 255, 255, 0.8); */
        }

        .support-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .support-card {
            background: var(--bg-primary);
            border-radius: var(--radius-xl);
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .support-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .support-icon {
            width: 4rem;
            height: 4rem;
            background: linear-gradient(135deg, var(--accent-color) 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.5rem;
        }

        .support-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        .support-card p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .support-card a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .support-card a:hover {
            text-decoration: underline;
        }

        /* Features Section */
        .features-section {
            background: var(--bg-primary);
            padding: 4rem 0;
            margin-top: 4rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .feature-icon {
            width: 3rem;
            height: 3rem;
            flex-shrink: 0;
        }

        .feature-content h4 {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .feature-content p {
            color: var(--text-secondary);
            margin: 0;
            font-size: 0.9rem;
        }

        /* Alert */
        .success-alert {
            background: linear-gradient(135deg, var(--accent-color) 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2.5rem;
            }

            .contact-hero p {
                font-size: 1.1rem;
            }

            .contact-form-section,
            .contact-info-section {
                padding: 2rem;
            }

            .contact-details {
                gap: 1.5rem;
            }

            .support-card {
                padding: 2rem 1.5rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .contact-hero {
                padding: 4rem 0 2rem;
            }

            .contact-hero h1 {
                font-size: 2rem;
            }

            .contact-form-section,
            .contact-info-section {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <x-buyer.breadcrumb :items="[
        ['text' => 'Home', 'url' => route('buyer.home')],
        ['text' => 'Contact', 'url' => route('buyer.contact')],
    ]" />

    <div class="contact-page">
        <!-- Hero Section -->
        <section class="contact-hero">
            <div class="container">
                <h1>Get in Touch</h1>
                <p>We're here to help you with any questions or concerns. Reach out to our friendly team today.</p>
            </div>
        </section>

        <!-- Main Contact Section -->
        <section class="contact-container">
            <div class="container">
                <div class="contact-card">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <div class="contact-form-section">
                                @if (session('success'))
                                    <div class="success-alert">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                @endif

                                <div class="contact-form">
                                    <h2>Send us a Message</h2>
                                    <p class="subtitle">Fill out the form below and we'll get back to you as soon as
                                        possible.</p>

                                    <form action="{{ route('buyer.contact.submit') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">First Name</label>
                                                    <input class="form-control @error('first_name') is-invalid @enderror"
                                                        type="text" name="first_name" placeholder="Enter your first name"
                                                        value="{{ old('first_name') }}" required>
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Last Name</label>
                                                    <input class="form-control @error('last_name') is-invalid @enderror"
                                                        type="text" name="last_name" placeholder="Enter your last name"
                                                        value="{{ old('last_name') }}" required>
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" placeholder="Enter your email address"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input class="form-control @error('phone') is-invalid @enderror" type="tel"
                                                name="phone" placeholder="Enter your phone number"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Message</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                                                placeholder="Tell us how we can help you..." rows="5" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn-submit">Send Message</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="contact-info-section">
                                <div class="contact-info">
                                    <h2>Contact Information</h2>
                                    <p class="subtitle">Get in touch with us through any of these channels.</p>

                                    <div class="contact-details">
                                        <div class="contact-detail">
                                            <div class="contact-icon">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                            <div class="contact-detail-content">
                                                <h4>Our Address</h4>
                                                <p>Djibouti City<br>Republic of Djibouti</p>
                                            </div>
                                        </div>

                                        <div class="contact-detail">
                                            <div class="contact-icon">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                            <div class="contact-detail-content">
                                                <h4>Phone Number</h4>
                                                <p><a href="tel:+25377608558">+253 77 60 8558</a></p>
                                            </div>
                                        </div>

                                        <div class="contact-detail">
                                            <div class="contact-icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <div class="contact-detail-content">
                                                <h4>Email Address</h4>
                                                <p><a href="mailto:info@djibmarket.com">info@djibmarket.com</a></p>
                                            </div>
                                        </div>

                                        <div class="contact-detail">
                                            <div class="contact-icon">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="contact-detail-content">
                                                <h4>Business Hours</h4>
                                                <p>Monday - Saturday<br>8:00 AM - 6:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Section -->
                <section class="support-section">
                    <div class="support-header">
                        <h2>How Can We Help?</h2>
                        <p>Choose the best way to reach out to our team</p>
                    </div>

                    <div class="support-cards">
                        <div class="support-card">
                            <div class="support-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3>Chat with Sales</h3>
                            <p>Get instant answers from our sales team</p>
                            <a href="mailto:sales@djibmarket.com">sales@djibmarket.com</a>
                        </div>

                        <div class="support-card">
                            <div class="support-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3>Customer Support</h3>
                            <p>Need help with your order or account?</p>
                            <a href="tel:+25377608558">+253 77 60 8558</a>
                        </div>

                        <div class="support-card">
                            <div class="support-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3>Visit Our Office</h3>
                            <p>Come see us in person during business hours</p>
                            <span>Djibouti City</span>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="{{ asset('assets/imgs/template/delivery.svg') }}" alt="Free Delivery">
                        </div>
                        <div class="feature-content">
                            <h4>Free Delivery</h4>
                            <p>Free shipping on orders over 5,000 Fdj</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="{{ asset('assets/imgs/template/support.svg') }}" alt="24/7 Support">
                        </div>
                        <div class="feature-content">
                            <h4>24/7 Support</h4>
                            <p>Round-the-clock customer assistance</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="{{ asset('assets/imgs/template/voucher.svg') }}" alt="Gift Vouchers">
                        </div>
                        <div class="feature-content">
                            <h4>Gift Vouchers</h4>
                            <p>Perfect gifts for your loved ones</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="{{ asset('assets/imgs/template/return.svg') }}" alt="Easy Returns">
                        </div>
                        <div class="feature-content">
                            <h4>Easy Returns</h4>
                            <p>Free returns on orders over 10,000 Fdj</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <img src="{{ asset('assets/imgs/template/secure.svg') }}" alt="Secure Payment">
                        </div>
                        <div class="feature-content">
                            <h4>Secure Payment</h4>
                            <p>100% secure and protected transactions</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scroll behavior for better UX
            document.documentElement.style.scrollBehavior = 'smooth';

            // Form validation enhancement
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('.form-control');

            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = 'var(--accent-color)';
                    }
                });

                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--primary-color)';
                });
            });
        });
    </script>
@endsection
