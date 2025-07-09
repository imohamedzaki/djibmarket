<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Business Registration - DjibMarket</title>
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template') }}/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f8fafc;
            color: #1f2937;
            overflow-x: hidden;
        }

        .registration-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar */
        .sidebar {
            width: 400px;
            /* background: linear-gradient(135deg, #2f3b3d 0%, #1e2b2f 100%); */
            background: linear-gradient(135deg, #05213c 0%, #1e3b59 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-img {
            width: 32px;
            height: 32px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-content {
            flex: 1;
            padding: 24px;
        }

        .step-item {
            display: flex;
            align-items: center;
            padding: 18px 16px;
            position: relative;
            border-radius: 12px;
            margin: 4px 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            overflow: hidden;
        }

        .step-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(6, 182, 212, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 12px;
        }

        .step-item:hover {
            background: rgba(71, 85, 105, 0.3);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .step-item:hover::before {
            opacity: 1;
        }

        .step-item.active {
            background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
            transform: translateX(6px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .step-item.active::before {
            opacity: 0;
        }

        .step-indicator {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            flex-shrink: 0;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .step-item.completed .step-indicator {
            background: #10b981;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .step-item.active .step-indicator {
            background: rgba(255, 255, 255, 0.95);
            color: #10b981;
            transform: scale(1.15);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .step-item.pending .step-indicator {
            background: rgba(255, 255, 255, 0.15);
            color: rgba(255, 255, 255, 0.6);
        }

        .step-item:hover .step-indicator {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }

        .step-item.active:hover .step-indicator {
            transform: scale(1.15);
        }

        .step-info h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            transition: all 0.3s ease;
        }

        .step-info p {
            font-size: 13px;
            opacity: 0.75;
            line-height: 1.5;
            transition: all 0.3s ease;
        }

        .step-item:hover .step-info h3 {
            font-weight: 700;
        }

        .step-item:hover .step-info p {
            opacity: 0.9;
        }

        .step-item.active .step-info h3 {
            color: white;
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .step-item.active .step-info p {
            opacity: 0.95;
            color: rgba(255, 255, 255, 0.95);
        }

        .step-item.pending .step-info h3 {
            color: rgba(255, 255, 255, 0.6);
        }

        .sidebar-footer {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: white;
        }

        .help-link {
            margin-top: 16px;
            text-align: right;
        }

        .help-link a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .help-link a:hover {
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
        }

        .content-header {
            padding: 32px 48px 0 48px;
        }

        .content-body {
            flex: 1;
            padding: 24px 48px 48px 48px;
        }

        .step-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .step-description {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            gap: 24px;
            /* max-width: 600px; */
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-row.cols-2 {
            grid-template-columns: 1fr 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.2s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/path%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        .input-error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 4px;
        }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .alert ul {
            list-style: none;
            margin: 0;
        }

        .alert li {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 4px;
        }

        /* Navigation Buttons */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #2f3b3d;
            color: white;
        }

        .btn-primary:hover {
            background: #1e2b2f;
        }

        .btn-secondary {
            background: #f9fafb;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f3f4f6;
        }

        .progress-dots {
            display: flex;
            gap: 8px;
        }

        .progress-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #d1d5db;
        }

        .progress-dot.active {
            background: #2f3b3d;
        }

        .progress-dot.completed {
            background: #10b981;
        }

        .security-notice {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 32px;
            padding: 16px;
            background: #f0f9ff;
            border-radius: 8px;
            font-size: 14px;
            color: #0369a1;
        }

        .security-icon {
            width: 16px;
            height: 16px;
            background: #0369a1;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Step Content */
        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        /* Password Requirements */
        .password-requirements {
            margin-top: 16px;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .password-strength-bar {
            width: 100%;
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .strength-progress {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        .strength-progress.weak {
            width: 20%;
            background: #ef4444;
        }

        .strength-progress.fair {
            width: 40%;
            background: #f59e0b;
        }

        .strength-progress.good {
            width: 60%;
            background: #eab308;
        }

        .strength-progress.strong {
            width: 80%;
            background: #22c55e;
        }

        .strength-progress.very-strong {
            width: 100%;
            background: #16a34a;
        }

        .strength-label {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .requirement-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #6b7280;
        }

        .requirement-item.met {
            color: #16a34a;
        }

        .requirement-icon {
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.3;
        }

        .requirement-item.met .requirement-icon {
            opacity: 1;
        }

        /* Image Upload */
        .image-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .image-upload-area:hover {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .image-upload-area.cover-upload {
            min-height: 200px;
        }

        .upload-placeholder svg {
            color: #9ca3af;
            margin-bottom: 16px;
        }

        .upload-placeholder p {
            margin: 0 0 8px 0;
            font-weight: 500;
        }

        .upload-link {
            color: #10b981;
            font-weight: 600;
        }

        .upload-placeholder small {
            color: #6b7280;
        }

        .image-preview {
            position: relative;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
        }

        .image-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            justify-content: center;
        }

        .btn-crop,
        .btn-remove {
            padding: 6px 12px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
        }

        .btn-remove {
            color: #dc2626;
            border-color: #dc2626;
        }

        /* Document Upload */
        .document-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 16px;
        }

        .document-upload-area:hover {
            border-color: #10b981;
            background: #f0fdf4;
        }

        .document-preview {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            background: #f3f4f6;
            border-radius: 8px;
        }

        .doc-info {
            display: flex;
            flex-direction: column;
        }

        .doc-name {
            font-weight: 500;
            font-size: 14px;
        }

        .doc-size {
            font-size: 12px;
            color: #6b7280;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        /* Navigation Button States */
        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--single {
            height: 48px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px;
            padding-left: 16px;
            color: #1f2937;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
            right: 16px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .select2-dropdown {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #10b981;
        }

        /* Cropper Modal */
        .cropper-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .cropper-container-wrapper {
            background: white;
            border-radius: 12px;
            padding: 24px;
            max-width: 90vw;
            max-height: 90vh;
            overflow: hidden;
        }

        .cropper-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .cropper-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .cropper-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #6b7280;
        }

        .cropper-image-container {
            max-width: 500px;
            max-height: 400px;
            margin-bottom: 16px;
        }

        .cropper-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-crop-action {
            padding: 8px 16px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-crop-save {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }

        .btn-crop-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        /* Terms and Conditions Styling */
        .terms-content {
            scrollbar-width: thin;
            scrollbar-color: #d1d5db #f8f9fa;
        }

        .terms-content::-webkit-scrollbar {
            width: 6px;
        }

        .terms-content::-webkit-scrollbar-track {
            background: #f8f9fa;
            border-radius: 3px;
        }

        .terms-content::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .terms-content::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        .terms-agreement {
            transition: all 0.2s ease;
        }

        .terms-agreement:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .terms-agreement input[type="checkbox"] {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        .terms-agreement input[type="checkbox"]:hover {
            transform: scale(1.2);
        }

        .terms-conditions-section h4 {
            position: relative;
            padding-left: 16px;
        }

        .terms-conditions-section h4:before {
            content: "▶";
            position: absolute;
            left: 0;
            color: #10b981;
            font-size: 12px;
            top: 2px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .registration-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .content-header,
            .content-body {
                padding: 24px;
            }

            .form-row.cols-2 {
                grid-template-columns: 1fr;
            }

            .form-navigation {
                flex-direction: column;
                gap: 16px;
            }

            .requirement-list {
                grid-template-columns: 1fr;
            }

            .select2-container {
                width: 100% !important;
            }

            .cropper-container-wrapper {
                max-width: 95vw;
                padding: 16px;
            }

            .cropper-image-container {
                max-width: 300px;
                max-height: 300px;
            }

            .terms-content {
                max-height: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="registration-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo-container">
                    <img src="{{ asset('assets/imgs/template/logo_only.png') }}" alt="DjibMarket Logo" class="logo-img">
                    <h2 style="font-size: 18px; font-weight: 700; color: white;">DjibMarket</h2>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="step-item active" data-step="0">
                    <div class="step-indicator">1</div>
                    <div class="step-info">
                        <h3>Verify Your Identity</h3>
                        <p>Information to confirm your identity.</p>
                    </div>
                </div>

                <div class="step-item pending" data-step="1">
                    <div class="step-indicator">2</div>
                    <div class="step-info">
                        <h3>Basic Information</h3>
                        <p>Your personal and contact details.</p>
                    </div>
                </div>

                <div class="step-item pending" data-step="2">
                    <div class="step-indicator">3</div>
                    <div class="step-info">
                        <h3>Business Details</h3>
                        <p>Business activity and address information.</p>
                    </div>
                </div>

                <div class="step-item pending" data-step="3">
                    <div class="step-indicator">4</div>
                    <div class="step-info">
                        <h3>Profile Images</h3>
                        <p>Upload your avatar and cover image.</p>
                    </div>
                </div>

                <div class="step-item pending" data-step="4">
                    <div class="step-indicator">5</div>
                    <div class="step-info">
                        <h3>Documents</h3>
                        <p>Upload required business documents.</p>
                    </div>
                </div>
            </div>

            <div class="sidebar-footer">
                <a href="{{ route('buyer.home') }}" class="back-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M19 12H5" />
                        <path d="M12 19l-7-7 7-7" />
                    </svg>
                    Go back
                </a>
                <a href="{{ route('buyer.join') }}" class="back-btn" style="margin-top: 8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Back to Join Us
                </a>
                <div class="help-link">
                    <a href="{{ route('buyer.contact') }}">Need help?</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-header">
                <h1 class="step-title" id="stepTitle">Basic Information</h1>
                <p class="step-description" id="stepDescription">This information is necessary to verify your identity
                    and contact you about your seller account.</p>
            </div>

            <div class="content-body">
                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.register') }}" id="registrationForm"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Step 0: Verify Your Identity -->
                    <div class="step-content active" id="step0">
                        <div class="form-grid">
                            <div class="welcome-content" style="text-align: center; padding: 40px 0;">
                                <div style="margin-bottom: 32px;">
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none"
                                        stroke="#10b981" stroke-width="1.5" style="margin: 0 auto; display: block;">
                                        <path d="M9 12l2 2 4-4" />
                                        <path
                                            d="M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.745 3.745 0 0 1 3.296-1.043A3.745 3.745 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.745 3.745 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12z" />
                                    </svg>
                                </div>
                                <h3 style="font-size: 24px; font-weight: 700; color: #1f2937; margin-bottom: 16px;">
                                    Welcome to DjibMarket Seller Registration</h3>
                                <p
                                    style="color: #6b7280; font-size: 16px; line-height: 1.6; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto;">
                                    We're excited to have you join our marketplace! This registration process will help
                                    us verify your identity and set up your seller account.
                                </p>
                                <div
                                    style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 24px; margin-bottom: 32px;">
                                    <h4
                                        style="font-size: 16px; font-weight: 600; color: #166534; margin-bottom: 12px;">
                                        What you'll need:</h4>
                                    <ul
                                        style="list-style: none; padding: 0; margin: 0; text-align: left; color: #166534;">
                                        <li style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                            Personal information (name, email, phone)
                                        </li>
                                        <li style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                            Business activity and address
                                        </li>
                                        <li style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                            Profile images (avatar and cover)
                                        </li>
                                        <li style="display: flex; align-items: center; gap: 8px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                            Business documents (license, tax certificate, ID)
                                        </li>
                                    </ul>
                                </div>
                                <div
                                    style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 20px;">
                                    <div
                                        style="display: flex; align-items: center; gap: 12px; justify-content: center;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="#2563eb" stroke-width="2">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                        </svg>
                                        <span style="color: #2563eb; font-weight: 500;">Your information is secure and
                                            encrypted</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div class="step-content" id="step1">
                        <div class="form-grid">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter your full name" required autofocus
                                        value="{{ old('name') }}">
                                    <x-input-error :messages="$errors->get('name')" class="input-error" />
                                </div>
                            </div>

                            <div class="form-row cols-2">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter your email address" required value="{{ old('email') }}">
                                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="+253 XX XX XX XX" value="{{ old('phone') }}">
                                    <x-input-error :messages="$errors->get('phone')" class="input-error" />
                                </div>
                            </div>

                            <div class="form-row cols-2">
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Create a secure password" required>
                                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Confirm your password" required>
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
                                </div>
                            </div>

                            <!-- Password Requirements -->
                            <div class="password-requirements">
                                <div class="password-strength-bar">
                                    <div class="strength-progress"></div>
                                </div>
                                <div class="strength-label">Password Strength</div>
                                <div class="requirement-list">
                                    <div class="requirement-item" data-requirement="length">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>At least 6 characters (8+ recommended)</span>
                                    </div>
                                    <div class="requirement-item" data-requirement="lowercase">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>At least 1 lowercase letter</span>
                                    </div>
                                    <div class="requirement-item" data-requirement="uppercase">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>At least 1 uppercase letter</span>
                                    </div>
                                    <div class="requirement-item" data-requirement="number">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>At least 1 number</span>
                                    </div>
                                    <div class="requirement-item" data-requirement="special">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>At least 1 special character</span>
                                    </div>
                                    <div class="requirement-item" data-requirement="match">
                                        <span class="requirement-icon">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="20,6 9,17 4,12" />
                                            </svg>
                                        </span>
                                        <span>Passwords match</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="terms-conditions-section"
                                style="margin-top: 32px; padding: 24px; background: #f8f9fa; border-radius: 12px; border: 1px solid #e5e7eb;">
                                <h3
                                    style="font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="#059669" stroke-width="2">
                                        <path d="M9 12l2 2 4-4" />
                                        <path
                                            d="M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.745 3.745 0 0 1 3.296-1.043A3.745 3.745 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.745 3.745 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12z" />
                                    </svg>
                                    Seller Terms & Conditions
                                </h3>

                                <div class="terms-content"
                                    style="max-height: 300px; overflow-y: auto; padding-right: 8px; margin-bottom: 16px; line-height: 1.6; color: #374151; font-size: 14px;">
                                    <p style="margin-bottom: 12px;"><strong>By registering as a seller on DjibMarket,
                                            you agree to the following terms and conditions:</strong></p>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">1. Product
                                            Quality & Returns</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;">You commit to providing accurate product
                                                descriptions and high-quality images</li>
                                            <li style="margin-bottom: 4px;"><strong>You agree to accept returns for
                                                    damaged products within 14 days of purchase</strong></li>
                                            <li style="margin-bottom: 4px;">All returned items must be in their
                                                original condition unless damaged upon delivery</li>
                                        </ul>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">2. Product
                                            Compliance & Compensation</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;"><strong>You are obligated to provide
                                                    compensation if products do not match their descriptions</strong>
                                            </li>
                                            <li style="margin-bottom: 4px;">Product images and descriptions must
                                                accurately represent the actual item</li>
                                            <li style="margin-bottom: 4px;">Misleading information may result in
                                                account suspension and compensation claims</li>
                                        </ul>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">3. Order
                                            Processing & Shipping</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;">Orders must be processed within 2 business
                                                days</li>
                                            <li style="margin-bottom: 4px;">You must provide accurate shipping
                                                information and tracking details</li>
                                            <li style="margin-bottom: 4px;">Delivery delays must be communicated to
                                                customers promptly</li>
                                        </ul>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">4. Customer
                                            Service</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;">Respond to customer inquiries within 24
                                                hours</li>
                                            <li style="margin-bottom: 4px;">Maintain professional communication with
                                                buyers</li>
                                            <li style="margin-bottom: 4px;">Resolve disputes fairly and promptly</li>
                                        </ul>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">5. Platform
                                            Compliance</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;">Comply with all applicable laws and
                                                regulations in Djibouti</li>
                                            <li style="margin-bottom: 4px;">Maintain valid business licenses and tax
                                                documentation</li>
                                            <li style="margin-bottom: 4px;">Follow DjibMarket's pricing and promotional
                                                guidelines</li>
                                        </ul>
                                    </div>

                                    <div style="margin-bottom: 16px;">
                                        <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 8px;">6. Account
                                            Responsibilities</h4>
                                        <ul style="margin: 0; padding-left: 20px;">
                                            <li style="margin-bottom: 4px;">Keep account information accurate and
                                                up-to-date</li>
                                            <li style="margin-bottom: 4px;">Maintain inventory levels and product
                                                availability</li>
                                            <li style="margin-bottom: 4px;">Report any security issues or unauthorized
                                                access immediately</li>
                                        </ul>
                                    </div>

                                    <p
                                        style="margin-top: 16px; padding: 12px; background: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 4px; font-size: 13px;">
                                        <strong>Important:</strong> Violation of these terms may result in account
                                        suspension, financial penalties, or permanent ban from the platform. DjibMarket
                                        reserves the right to modify these terms with prior notice.
                                    </p>
                                </div>

                                <div class="terms-agreement"
                                    style="display: flex; align-items: flex-start; gap: 12px; padding: 16px; background: white; border-radius: 8px; border: 1px solid #d1d5db;">
                                    <input type="checkbox" id="terms_accepted" name="terms_accepted" required
                                        style="margin-top: 2px; width: 18px; height: 18px; accent-color: #10b981; cursor: pointer;">
                                    <label for="terms_accepted"
                                        style="cursor: pointer; font-size: 14px; line-height: 1.5; color: #374151;">
                                        <strong>I have read, understood, and agree to abide by all the Terms &
                                            Conditions outlined above.</strong>
                                        I acknowledge my responsibilities as a seller on DjibMarket, including product
                                        quality standards, return policies, and customer service requirements.
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('terms_accepted')" class="input-error" />
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Business Details -->
                    <div class="step-content" id="step2">
                        <div class="form-grid">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="business_activity_id">Business Activity</label>
                                    <select class="form-control form-select select2-dropdown"
                                        id="business_activity_id" name="business_activity_id" required>
                                        <option value="">Select your business activity</option>
                                        @foreach (\App\Models\BusinessActivity::orderBy('name')->get() as $activity)
                                            <option value="{{ $activity->id }}"
                                                {{ old('business_activity_id') == $activity->id ? 'selected' : '' }}>
                                                {{ $activity->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('business_activity_id')" class="input-error" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="address">Business Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"
                                        placeholder="Enter your complete business address" required>{{ old('address') }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="input-error" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Profile Images -->
                    <div class="step-content" id="step3">
                        <div class="form-grid">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Profile Avatar</label>
                                    <div class="image-upload-area" data-type="avatar">
                                        <div class="upload-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>
                                            <p>Drag & drop your avatar image here or <span
                                                    class="upload-link">browse</span></p>
                                            <small>Recommended: 300x300px, max 2MB</small>
                                        </div>
                                        <input type="file" name="avatar" accept="image/*"
                                            style="display: none;">
                                        <div class="image-preview" style="display: none;">
                                            <img src="" alt="Avatar preview">
                                            <div class="image-actions">
                                                <button type="button" class="btn-crop">Crop</button>
                                                <button type="button" class="btn-remove">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('avatar')" class="input-error" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Cover Image</label>
                                    <div class="image-upload-area cover-upload" data-type="cover">
                                        <div class="upload-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <rect x="3" y="3" width="18" height="18" rx="2"
                                                    ry="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21,15 16,10 5,21" />
                                            </svg>
                                            <p>Drag & drop your cover image here or <span
                                                    class="upload-link">browse</span></p>
                                            <small>Recommended: 1200x400px, max 5MB</small>
                                        </div>
                                        <input type="file" name="cover_image" accept="image/*"
                                            style="display: none;">
                                        <div class="image-preview" style="display: none;">
                                            <img src="" alt="Cover preview">
                                            <div class="image-actions">
                                                <button type="button" class="btn-crop">Crop</button>
                                                <button type="button" class="btn-remove">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('cover_image')" class="input-error" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 4: Documents -->
                    <div class="step-content" id="step4">
                        <div class="form-grid">
                            <div class="document-upload-section">
                                <!-- Patente Section -->
                                <div class="form-group">
                                    <label class="form-label">Patente *</label>
                                    <div class="document-upload-area" data-type="Patente">
                                        <div class="upload-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14,2 14,8 20,8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10,9 9,9 8,9" />
                                            </svg>
                                            <p>Télécharger le Document de Patente</p>
                                            <small>PDF, JPG, PNG (max 10MB)</small>
                                        </div>
                                        <input type="file" name="documents[patente]" accept=".pdf,.jpg,.jpeg,.png"
                                            style="display: none;" required>
                                        <div class="document-preview" style="display: none;">
                                            <div class="doc-info">
                                                <span class="doc-name"></span>
                                                <span class="doc-size"></span>
                                            </div>
                                            <button type="button" class="btn-remove">Remove</button>
                                        </div>
                                    </div>

                                    <!-- Patente Additional Fields -->
                                    <div class="form-row cols-2 mt-3">
                                        <div class="form-group">
                                            <label class="form-label" for="patente_number">Numéro de Patente *</label>
                                            <input type="text" class="form-control" id="patente_number"
                                                name="patente_number" placeholder="Saisissez le numéro de patente"
                                                required value="{{ old('patente_number') }}">
                                            <x-input-error :messages="$errors->get('patente_number')" class="input-error" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="patente_owner">Propriétaire de la Patente
                                                *</label>
                                            <input type="text" class="form-control" id="patente_owner"
                                                name="patente_owner" placeholder="Nom du propriétaire de la patente"
                                                required value="{{ old('patente_owner') }}">
                                            <x-input-error :messages="$errors->get('patente_owner')" class="input-error" />
                                        </div>
                                    </div>

                                    <div class="form-row cols-2">
                                        <div class="form-group">
                                            <label class="form-label" for="patente_nif">Numéro NIF *</label>
                                            <input type="text" class="form-control" id="patente_nif"
                                                name="patente_nif" placeholder="Saisissez le numéro NIF" required
                                                value="{{ old('patente_nif') }}">
                                            <x-input-error :messages="$errors->get('patente_nif')" class="input-error" />
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="patente_quittance">Numéro de Quittance
                                                *</label>
                                            <input type="text" class="form-control" id="patente_quittance"
                                                name="patente_quittance"
                                                placeholder="Saisissez le numéro de quittance" required
                                                value="{{ old('patente_quittance') }}">
                                            <x-input-error :messages="$errors->get('patente_quittance')" class="input-error" />
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label class="form-label">Date d'Expiration *</label>
                                        <input type="date" class="form-control" name="documents_expiry[patente]"
                                            required value="{{ old('documents_expiry.patente') }}">
                                        <x-input-error :messages="$errors->get('documents_expiry.patente')" class="input-error" />
                                    </div>
                                </div>

                                <!-- Line Separator -->
                                <hr style="margin: 40px 0; border: 0; border-top: 2px solid #e5e7eb;">

                                <!-- TVA Section -->
                                <div class="form-group">
                                    <label class="form-label">TVA *</label>
                                    <div class="document-upload-area" data-type="TVA">
                                        <div class="upload-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14,2 14,8 20,8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10,9 9,9 8,9" />
                                            </svg>
                                            <p>Télécharger le Document TVA</p>
                                            <small>PDF, JPG, PNG (max 10MB)</small>
                                        </div>
                                        <input type="file" name="documents[tva]" accept=".pdf,.jpg,.jpeg,.png"
                                            style="display: none;" required>
                                        <div class="document-preview" style="display: none;">
                                            <div class="doc-info">
                                                <span class="doc-name"></span>
                                                <span class="doc-size"></span>
                                            </div>
                                            <button type="button" class="btn-remove">Remove</button>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Date d'Expiration *</label>
                                        <input type="date" class="form-control" name="documents_expiry[tva]"
                                            required value="{{ old('documents_expiry.tva') }}">
                                        <x-input-error :messages="$errors->get('documents_expiry.tva')" class="input-error" />
                                    </div>
                                </div>

                                <!-- Line Separator -->
                                <hr style="margin: 40px 0; border: 0; border-top: 2px solid #e5e7eb;">

                                <!-- ID Card / Passport Section -->
                                <div class="form-group">
                                    <label class="form-label">Carte d'Identité / Passeport *</label>
                                    <div class="document-upload-area" data-type="ID Card">
                                        <div class="upload-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14,2 14,8 20,8" />
                                                <line x1="16" y1="13" x2="8" y2="13" />
                                                <line x1="16" y1="17" x2="8" y2="17" />
                                                <polyline points="10,9 9,9 8,9" />
                                            </svg>
                                            <p>Télécharger Carte d'Identité / Passeport</p>
                                            <small>PDF, JPG, PNG (max 10MB)</small>
                                        </div>
                                        <input type="file" name="documents[id_card]" accept=".pdf,.jpg,.jpeg,.png"
                                            style="display: none;" required>
                                        <div class="document-preview" style="display: none;">
                                            <div class="doc-info">
                                                <span class="doc-name"></span>
                                                <span class="doc-size"></span>
                                            </div>
                                            <button type="button" class="btn-remove">Remove</button>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Date d'Expiration *</label>
                                        <input type="date" class="form-control" name="documents_expiry[id_card]"
                                            required value="{{ old('documents_expiry.id_card') }}">
                                        <x-input-error :messages="$errors->get('documents_expiry.id_card')" class="input-error" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn btn-secondary" id="prevButton" style="display: none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M19 12H5" />
                                <path d="M12 19l-7-7 7-7" />
                            </svg>
                            Previous
                        </button>

                        <div class="progress-dots">
                            <div class="progress-dot completed"></div>
                            <div class="progress-dot active"></div>
                            <div class="progress-dot"></div>
                            <div class="progress-dot"></div>
                        </div>

                        <button type="button" class="btn btn-primary" id="nextButton">
                            <span class="button-text">Continue</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14" />
                                <path d="M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="security-notice">
                    <div class="security-icon">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </div>
                    <p>We use bank-level, 256-bit encryption to keep your data safe.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropper Modal -->
    <div class="cropper-modal" id="cropperModal">
        <div class="cropper-container-wrapper">
            <div class="cropper-header">
                <h3>Crop Image</h3>
                <button type="button" class="cropper-close" onclick="closeCropperModal()">&times;</button>
            </div>
            <div class="cropper-image-container">
                <img id="cropperImage" style="max-width: 100%; display: block;">
            </div>
            <div class="cropper-actions">
                <button type="button" class="btn-crop-action btn-crop-cancel"
                    onclick="closeCropperModal()">Cancel</button>
                <button type="button" class="btn-crop-action btn-crop-save"
                    onclick="saveCroppedImage()">Save</button>
            </div>
        </div>
    </div>

    <!-- jQuery (required for Select2) -->
    <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('assets/js/vendors/select2.min.js') }}"></script>

    <!-- Cropper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <script>
        let currentStep = 0;
        const totalSteps = 4;

        // Step data for dynamic content
        const stepData = {
            0: {
                title: "Verify Your Identity",
                description: "Welcome! Let's start by verifying your identity to create your seller account."
            },
            1: {
                title: "Basic Information",
                description: "This information is necessary to verify your identity and contact you about your seller account."
            },
            2: {
                title: "Business Details",
                description: "Tell us about your business activity and location."
            },
            3: {
                title: "Profile Images",
                description: "Upload your profile avatar and cover image to personalize your store."
            },
            4: {
                title: "Documents",
                description: "Upload required business documents for verification."
            }
        };

        // Initialize the form
        document.addEventListener('DOMContentLoaded', function() {
            initializePasswordStrength();
            initializeImageUploads();
            initializeDocumentUploads();
            initializeStepNavigation();
            initializeSelect2();
            updateUI();
        });

        // Step navigation
        function initializeStepNavigation() {
            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');

            nextButton.addEventListener('click', function() {
                if (currentStep === 0) {
                    // Move from step 0 (Verify Identity) to step 1 (Basic Information)
                    nextStep();
                } else if (currentStep < totalSteps) {
                    if (validateCurrentStep()) {
                        nextStep();
                    }
                } else {
                    submitForm();
                }
            });

            prevButton.addEventListener('click', function() {
                if (currentStep > 0) {
                    prevStep();
                }
            });
        }

        function nextStep() {
            if (currentStep < totalSteps) {
                currentStep++;
                updateUI();
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                updateUI();
            }
        }

        function updateUI() {
            // Update step content - show content for steps 0-4
            document.querySelectorAll('.step-content').forEach(step => {
                step.classList.remove('active');
            });
            if (currentStep >= 0 && currentStep <= 4) {
                document.getElementById(`step${currentStep}`).classList.add('active');
            }

            // Update step title and description
            document.getElementById('stepTitle').textContent = stepData[currentStep].title;
            document.getElementById('stepDescription').textContent = stepData[currentStep].description;

            // Update sidebar steps
            document.querySelectorAll('.step-item').forEach((item, index) => {
                item.classList.remove('active', 'completed', 'pending');
                const stepNumber = parseInt(item.dataset.step);

                if (stepNumber < currentStep) {
                    item.classList.add('completed');
                    // Update indicator to show checkmark for completed steps
                    const indicator = item.querySelector('.step-indicator');
                    indicator.innerHTML = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20,6 9,17 4,12" />
                    </svg>`;
                } else if (stepNumber === currentStep) {
                    item.classList.add('active');
                    // Update indicator to show step number for current step
                    const indicator = item.querySelector('.step-indicator');
                    indicator.innerHTML = stepNumber + 1;
                } else {
                    item.classList.add('pending');
                    // Update indicator to show step number for pending steps
                    const indicator = item.querySelector('.step-indicator');
                    indicator.innerHTML = stepNumber + 1;
                }
            });

            // Update progress dots (only for actual form steps 1-4)
            document.querySelectorAll('.progress-dot').forEach((dot, index) => {
                dot.classList.remove('active', 'completed');
                if (index + 1 < currentStep) {
                    dot.classList.add('completed');
                } else if (index + 1 === currentStep) {
                    dot.classList.add('active');
                }
            });

            // Update navigation buttons
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const buttonText = document.querySelector('.button-text');

            // Show previous button for steps 1 and above
            prevButton.style.display = currentStep >= 1 ? 'flex' : 'none';

            // Handle button text
            if (currentStep === 0) {
                buttonText.textContent = 'Start Registration';
            } else if (currentStep === totalSteps) {
                buttonText.textContent = 'Submit Registration';
            } else {
                buttonText.textContent = 'Continue';
            }
        }

        function validateCurrentStep() {
            // Step 0 (Verify Identity) doesn't need validation
            if (currentStep === 0) {
                return true;
            }

            let isValid = true;
            const currentStepElement = document.getElementById(`step${currentStep}`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (field.type === 'file') {
                    // Special validation for file inputs
                    if (!field.files || field.files.length === 0) {
                        field.style.borderColor = '#dc2626';
                        // Also highlight the upload area
                        const uploadArea = field.closest('.document-upload-area') || field.closest(
                            '.image-upload-area');
                        if (uploadArea) {
                            uploadArea.style.borderColor = '#dc2626';
                        }
                        isValid = false;
                    } else {
                        field.style.borderColor = '#d1d5db';
                        const uploadArea = field.closest('.document-upload-area') || field.closest(
                            '.image-upload-area');
                        if (uploadArea) {
                            uploadArea.style.borderColor = '#d1d5db';
                        }
                    }
                } else {
                    // Regular field validation
                    if (!field.value.trim()) {
                        field.style.borderColor = '#dc2626';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#d1d5db';
                    }
                }
            });

            // Special validation for password step
            if (currentStep === 1) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                const termsAccepted = document.getElementById('terms_accepted').checked;

                // Only check if passwords match and have minimum length
                if (password !== confirmPassword) {
                    document.getElementById('password_confirmation').style.borderColor = '#dc2626';
                    isValid = false;
                } else {
                    document.getElementById('password_confirmation').style.borderColor = '#d1d5db';
                }

                // Basic password length requirement (minimum 6 characters)
                if (password.length < 6) {
                    document.getElementById('password').style.borderColor = '#dc2626';
                    isValid = false;
                } else {
                    document.getElementById('password').style.borderColor = '#d1d5db';
                }

                // Terms and Conditions validation
                if (!termsAccepted) {
                    const termsContainer = document.querySelector('.terms-agreement');
                    termsContainer.style.borderColor = '#dc2626';
                    termsContainer.style.backgroundColor = '#fef2f2';
                    isValid = false;
                } else {
                    const termsContainer = document.querySelector('.terms-agreement');
                    termsContainer.style.borderColor = '#d1d5db';
                    termsContainer.style.backgroundColor = 'white';
                }
            }

            // Special validation for documents step
            if (currentStep === 4) {
                // Check if all document files are uploaded
                const documentTypes = ['patente', 'tva', 'id_card'];
                documentTypes.forEach(type => {
                    const fileInput = document.querySelector(`input[name="documents[${type}]"]`);
                    if (fileInput && (!fileInput.files || fileInput.files.length === 0)) {
                        const uploadArea = fileInput.closest('.document-upload-area');
                        if (uploadArea) {
                            uploadArea.style.borderColor = '#dc2626';
                        }
                        isValid = false;
                    }
                });

                // Validate file types for documents
                const allowedTypes = ['.pdf', '.jpg', '.jpeg', '.png'];
                documentTypes.forEach(type => {
                    const fileInput = document.querySelector(`input[name="documents[${type}]"]`);
                    if (fileInput && fileInput.files && fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        const fileName = file.name.toLowerCase();
                        const isValidType = allowedTypes.some(ext => fileName.endsWith(ext));

                        if (!isValidType) {
                            const uploadArea = fileInput.closest('.document-upload-area');
                            if (uploadArea) {
                                uploadArea.style.borderColor = '#dc2626';
                            }
                            isValid = false;
                            alert(
                                `Invalid file type for ${type}. Please upload PDF, JPG, JPEG, or PNG files only.`
                            );
                        }
                    }
                });
            }

            return isValid;
        }

        function submitForm() {
            const form = document.getElementById('registrationForm');
            const submitButton = document.getElementById('nextButton');
            const buttonText = document.querySelector('.button-text');

            if (validateCurrentStep()) {
                submitButton.disabled = true;
                buttonText.textContent = 'Processing...';
                form.submit();
            }
        }

        // Password strength checker
        function initializePasswordStrength() {
            const passwordField = document.getElementById('password');
            const confirmField = document.getElementById('password_confirmation');

            passwordField.addEventListener('input', updatePasswordStrength);
            confirmField.addEventListener('input', updatePasswordStrength);
        }

        function updatePasswordStrength() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            // Check each requirement
            const requirements = {
                length: password.length >= 6, // Changed from 8 to 6 for minimum requirement
                lowercase: /[a-z]/.test(password),
                uppercase: /[A-Z]/.test(password),
                number: /\d/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password),
                match: password === confirmPassword && password.length > 0
            };

            // Additional check for recommended 8+ characters
            const hasRecommendedLength = password.length >= 8;

            // Update requirement indicators
            Object.keys(requirements).forEach(req => {
                const element = document.querySelector(`[data-requirement="${req}"]`);
                if (element) {
                    if (requirements[req]) {
                        element.classList.add('met');
                    } else {
                        element.classList.remove('met');
                    }
                }
            });

            // Special handling for length indicator to show both 6+ and 8+ status
            const lengthElement = document.querySelector(`[data-requirement="length"]`);
            if (lengthElement) {
                const lengthSpan = lengthElement.querySelector('span:last-child');
                if (password.length >= 8) {
                    lengthSpan.textContent = '8+ characters (excellent!)';
                    lengthElement.classList.add('met');
                } else if (password.length >= 6) {
                    lengthSpan.textContent = '6+ characters (8+ recommended)';
                    lengthElement.classList.add('met');
                } else {
                    lengthSpan.textContent = 'At least 6 characters (8+ recommended)';
                    lengthElement.classList.remove('met');
                }
            }

            // Update strength bar based on all criteria including recommended length
            let strengthScore = 0;
            if (requirements.length) strengthScore++; // 6+ chars
            if (hasRecommendedLength) strengthScore++; // 8+ chars (bonus)
            if (requirements.lowercase) strengthScore++;
            if (requirements.uppercase) strengthScore++;
            if (requirements.number) strengthScore++;
            if (requirements.special) strengthScore++;
            if (requirements.match) strengthScore++;

            const strengthBar = document.querySelector('.strength-progress');

            strengthBar.className = 'strength-progress';
            if (strengthScore >= 6) {
                strengthBar.classList.add('very-strong');
            } else if (strengthScore >= 5) {
                strengthBar.classList.add('strong');
            } else if (strengthScore >= 4) {
                strengthBar.classList.add('good');
            } else if (strengthScore >= 2) {
                strengthBar.classList.add('fair');
            } else if (strengthScore >= 1) {
                strengthBar.classList.add('weak');
            }
        }

        function isPasswordStrong(password) {
            // This function is kept for compatibility but no longer blocks registration
            return password.length >= 6; // Only require minimum 6 characters
        }

        // Image upload functionality
        function initializeImageUploads() {
            document.querySelectorAll('.image-upload-area').forEach(area => {
                const input = area.querySelector('input[type="file"]');
                const placeholder = area.querySelector('.upload-placeholder');
                const preview = area.querySelector('.image-preview');

                // Click to browse
                placeholder.addEventListener('click', () => input.click());

                // Drag and drop
                area.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    area.style.borderColor = '#10b981';
                });

                area.addEventListener('dragleave', () => {
                    area.style.borderColor = '#d1d5db';
                });

                area.addEventListener('drop', (e) => {
                    e.preventDefault();
                    area.style.borderColor = '#d1d5db';
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        input.files = files;
                        handleImagePreview(input, area);
                    }
                });

                // File input change
                input.addEventListener('change', () => handleImagePreview(input, area));

                // Remove button
                const removeBtn = area.querySelector('.btn-remove');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        input.value = '';
                        placeholder.style.display = 'block';
                        preview.style.display = 'none';
                    });
                }
            });
        }

        function handleImagePreview(input, area) {
            const file = input.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = area.querySelector('.image-preview img');
                    const placeholder = area.querySelector('.upload-placeholder');
                    const preview = area.querySelector('.image-preview');

                    img.src = e.target.result;
                    placeholder.style.display = 'none';
                    preview.style.display = 'block';

                    // Add crop button functionality
                    const cropBtn = area.querySelector('.btn-crop');
                    if (cropBtn) {
                        cropBtn.onclick = () => openCropperModal(file, area);
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        // Document upload functionality
        function initializeDocumentUploads() {
            document.querySelectorAll('.document-upload-area').forEach(area => {
                const input = area.querySelector('input[type="file"]');
                const placeholder = area.querySelector('.upload-placeholder');
                const preview = area.querySelector('.document-preview');

                // Click to browse
                placeholder.addEventListener('click', () => input.click());

                // Drag and drop
                area.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    area.style.borderColor = '#10b981';
                });

                area.addEventListener('dragleave', () => {
                    area.style.borderColor = '#d1d5db';
                });

                area.addEventListener('drop', (e) => {
                    e.preventDefault();
                    area.style.borderColor = '#d1d5db';
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        // Validate file type
                        const file = files[0];
                        const fileName = file.name.toLowerCase();
                        const allowedTypes = ['.pdf', '.jpg', '.jpeg', '.png'];
                        const isValidType = allowedTypes.some(ext => fileName.endsWith(ext));

                        if (isValidType) {
                            input.files = files;
                            handleDocumentPreview(input, area);
                        } else {
                            alert('Invalid file type. Please upload PDF, JPG, JPEG, or PNG files only.');
                            area.style.borderColor = '#dc2626';
                        }
                    }
                });

                // File input change
                input.addEventListener('change', () => {
                    if (input.files && input.files.length > 0) {
                        const file = input.files[0];
                        const fileName = file.name.toLowerCase();
                        const allowedTypes = ['.pdf', '.jpg', '.jpeg', '.png'];
                        const isValidType = allowedTypes.some(ext => fileName.endsWith(ext));

                        if (isValidType) {
                            handleDocumentPreview(input, area);
                        } else {
                            alert('Invalid file type. Please upload PDF, JPG, JPEG, or PNG files only.');
                            input.value = ''; // Clear the invalid file
                            area.style.borderColor = '#dc2626';
                        }
                    }
                });

                // Remove button
                const removeBtn = area.querySelector('.btn-remove');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        input.value = '';
                        placeholder.style.display = 'block';
                        preview.style.display = 'none';
                    });
                }
            });
        }

        function handleDocumentPreview(input, area) {
            const file = input.files[0];
            if (file) {
                const placeholder = area.querySelector('.upload-placeholder');
                const preview = area.querySelector('.document-preview');
                const nameSpan = area.querySelector('.doc-name');
                const sizeSpan = area.querySelector('.doc-size');

                nameSpan.textContent = file.name;
                sizeSpan.textContent = formatFileSize(file.size);

                placeholder.style.display = 'none';
                preview.style.display = 'flex';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Select2 initialization
        function initializeSelect2() {
            // Wait for jQuery to be available
            if (typeof $ !== 'undefined') {
                $('#business_activity_id').select2({
                    placeholder: 'Select your business activity',
                    allowClear: false,
                    width: '100%',
                    dropdownParent: $('#step2'),
                    templateResult: function(option) {
                        if (!option.id) {
                            return option.text;
                        }
                        return $('<span>' + option.text + '</span>');
                    }
                });
            } else {
                // Fallback if jQuery is not available
                console.warn('jQuery not available, Select2 initialization skipped');
            }
        }

        // Cropper functionality
        let currentCropper = null;
        let currentImageArea = null;

        function openCropperModal(imageFile, imageArea) {
            const modal = document.getElementById('cropperModal');
            const cropperImage = document.getElementById('cropperImage');

            currentImageArea = imageArea;

            const reader = new FileReader();
            reader.onload = function(e) {
                cropperImage.src = e.target.result;
                modal.style.display = 'flex';

                // Initialize cropper
                if (currentCropper) {
                    currentCropper.destroy();
                }

                const aspectRatio = imageArea.dataset.type === 'avatar' ? 1 : 3; // 1:1 for avatar, 3:1 for cover

                currentCropper = new Cropper(cropperImage, {
                    aspectRatio: aspectRatio,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: true,
                    center: true,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            };
            reader.readAsDataURL(imageFile);
        }

        function closeCropperModal() {
            const modal = document.getElementById('cropperModal');
            modal.style.display = 'none';

            if (currentCropper) {
                currentCropper.destroy();
                currentCropper = null;
            }
            currentImageArea = null;
        }

        function saveCroppedImage() {
            if (!currentCropper || !currentImageArea) return;

            const canvas = currentCropper.getCroppedCanvas({
                width: currentImageArea.dataset.type === 'avatar' ? 300 : 1200,
                height: currentImageArea.dataset.type === 'avatar' ? 300 : 400,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            canvas.toBlob(function(blob) {
                // Create a new file from the cropped canvas
                const fileName = currentImageArea.dataset.type === 'avatar' ? 'avatar.jpg' : 'cover.jpg';
                const croppedFile = new File([blob], fileName, {
                    type: 'image/jpeg'
                });

                // Update the file input
                const input = currentImageArea.querySelector('input[type="file"]');
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                input.files = dataTransfer.files;

                // Update the preview
                const img = currentImageArea.querySelector('.image-preview img');
                const placeholder = currentImageArea.querySelector('.upload-placeholder');
                const preview = currentImageArea.querySelector('.image-preview');

                img.src = canvas.toDataURL();
                placeholder.style.display = 'none';
                preview.style.display = 'block';

                closeCropperModal();
            }, 'image/jpeg', 0.9);
        }
    </script>
</body>

</html>
