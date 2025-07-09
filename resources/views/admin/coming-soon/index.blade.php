@extends('layouts.app.admin')
@section('title', 'Coming Soon')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="row justify-content-center align-items-center min-vh-75">
                    <div class="col-12">
                        <div class="text-center">
                            <!-- Modern Icon -->
                            <div class="coming-soon-icon mb-3">
                                <div class="icon-wrapper">
                                    <em class="icon ni ni-clock-fill"></em>
                                </div>
                            </div>

                            <!-- Main Content -->
                            <div class="coming-soon-content mb-3">
                                <h1 class="display-6 fw-bold text-dark mb-4">Coming Soon</h1>
                                <p class="lead text-muted mb-0">
                                    We're crafting something amazing for you! This feature is currently under development
                                    and will be available soon.
                                </p>
                            </div>

                            <!-- Progress Indicator -->
                            <div class="progress-section mb-3">
                                <div class="row g-4 justify-content-center">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="progress-item">
                                            <div class="progress-icon completed">
                                                <em class="icon ni ni-check-circle-fill"></em>
                                            </div>
                                            <h6 class="mt-4 mb-2">Planning</h6>
                                            <small class="text-success">Completed</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="progress-item">
                                            <div class="progress-icon active">
                                                <em class="icon ni ni-code"></em>
                                            </div>
                                            <h6 class="mt-4 mb-2">Development</h6>
                                            <small class="text-primary">In Progress</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="progress-item">
                                            <div class="progress-icon pending">
                                                <em class="icon ni ni-rocket"></em>
                                            </div>
                                            <h6 class="mt-4 mb-2">Launch</h6>
                                            <small class="text-muted">Coming Soon</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Features Preview -->
                            <div class="features-preview mb-3">
                                <h5 class="mb-5 text-dark">What's Coming</h5>
                                <div class="row g-4 justify-content-center">
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="feature-card">
                                            <em class="icon ni ni-speed text-primary"></em>
                                            <span>Fast Performance</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="feature-card">
                                            <em class="icon ni ni-mobile text-info"></em>
                                            <span>Mobile Friendly</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="feature-card">
                                            <em class="icon ni ni-shield-check text-success"></em>
                                            <span>Secure & Reliable</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                        <div class="feature-card">
                                            <em class="icon ni ni-users text-warning"></em>
                                            <span>User Friendly</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg px-5 me-4">
                                    <em class="icon ni ni-arrow-left me-2"></em>
                                    Back to Dashboard
                                </a>
                                <button class="btn btn-outline-primary btn-lg px-5" onclick="showNotification()">
                                    <em class="icon ni ni-bell me-2"></em>
                                    Notify Me
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .min-vh-75 {
            min-height: 75vh;
        }

        /* Custom spacing utilities */
        .mb-3 {
            margin-bottom: 2rem !important;
        }

        .coming-soon-icon .icon-wrapper {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.3);
            animation: float 3s ease-in-out infinite;
        }

        .coming-soon-icon .icon-wrapper em {
            font-size: 3rem;
            color: white;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .progress-item {
            text-align: center;
            padding: 1.5rem 1rem;
        }

        .progress-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .progress-icon em {
            font-size: 1.75rem;
        }

        .progress-icon.completed {
            background: #e8f5e8;
            color: #28a745;
            border: 2px solid #28a745;
        }

        .progress-icon.active {
            background: #e3f2fd;
            color: #007bff;
            border: 2px solid #007bff;
            animation: pulse 2s infinite;
        }

        .progress-icon.pending {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #dee2e6;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
            }
        }

        .feature-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 140px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .feature-card em {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .feature-card span {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }

        .btn-lg {
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.75rem 2rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.2);
        }

        .display-6 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 3.5rem;
        }

        .lead {
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .action-buttons {
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .mb-3 {
                margin-bottom: 2rem !important;
            }

            .coming-soon-icon .icon-wrapper {
                width: 100px;
                height: 100px;
            }

            .coming-soon-icon .icon-wrapper em {
                font-size: 2.5rem;
            }

            .display-6 {
                font-size: 2.5rem;
            }

            .lead {
                font-size: 1.1rem;
            }

            .progress-icon {
                width: 60px;
                height: 60px;
            }

            .progress-icon em {
                font-size: 1.5rem;
            }

            .feature-card {
                padding: 1.5rem 1rem;
                min-height: 120px;
            }

            .feature-card em {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }

            .action-buttons .btn {
                display: block;
                width: 100%;
                margin-bottom: 1rem;
                margin-right: 0 !important;
            }

            .action-buttons .btn:last-child {
                margin-bottom: 0;
            }
        }

        @media (max-width: 576px) {
            .mb-3 {
                margin-bottom: 1rem !important;
            }

            .progress-item {
                padding: 1rem 0.5rem;
            }
        }
    </style>
@endsection

@section('js')
    <script>
        function showNotification() {
            // Simple notification function
            if (typeof NioApp !== 'undefined' && NioApp.Toast) {
                NioApp.Toast('We\'ll notify you when this feature is ready!', 'info', {
                    position: 'top-right'
                });
            } else {
                alert('We\'ll notify you when this feature is ready!');
            }
        }
    </script>
@endsection
