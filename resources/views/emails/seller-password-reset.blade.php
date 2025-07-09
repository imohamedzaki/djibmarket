<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - DjibMarket</title>
    <style>
        * {
            box-sizing: border-box;
        }

        /*! Email Template */
        .email-wraper {
            background: #f5f6fa;
            font-size: 14px;
            line-height: 22px;
            font-weight: 400;
            color: #8094ae;
            width: 100%;
        }

        .email-wraper a {
            color: #55aff7;
            word-break: break-all;
        }

        .email-wraper .link-block {
            display: block;
        }

        .email-ul {
            margin: 5px 0;
            padding: 0;
        }

        .email-ul:not(:last-child) {
            margin-bottom: 10px;
        }

        .email-ul li {
            list-style: disc;
            list-style-position: inside;
        }

        .email-ul-col2 {
            display: flex;
            flex-wrap: wrap;
        }

        .email-ul-col2 li {
            width: 50%;
            padding-right: 10px;
        }

        .email-body {
            width: 96%;
            max-width: 620px;
            margin: 0 auto;
            background: #ffffff;
        }

        .email-success {
            border-bottom: #1ee0ac;
        }

        .email-warning {
            border-bottom: #f4bd0e;
        }

        .email-btn {
            background: linear-gradient(135deg, #7cd596 0%, #55aff7 100%);
            border-radius: 4px;
            color: #ffffff !important;
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            line-height: 44px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            padding: 0 30px;
        }

        .email-btn-sm {
            line-height: 38px;
        }

        .email-header,
        .email-footer {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
        }

        .email-logo {
            height: 40px;
        }

        .email-title {
            font-size: 13px;
            color: #55aff7;
            padding-top: 12px;
        }

        .email-heading {
            font-size: 18px;
            color: #55aff7;
            font-weight: 600;
            margin: 0;
            line-height: 1.4;
        }

        .email-heading-sm {
            font-size: 24px;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }

        .email-heading-s1 {
            font-size: 20px;
            font-weight: 400;
            color: #526484;
        }

        .email-heading-s2 {
            font-size: 16px;
            color: #526484;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .email-heading-s3 {
            font-size: 18px;
            color: #55aff7;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .email-heading-success {
            color: #1ee0ac;
        }

        .email-heading-warning {
            color: #f4bd0e;
        }

        .email-note {
            margin: 0;
            font-size: 13px;
            line-height: 22px;
            color: #8094ae;
        }

        .email-copyright-text {
            font-size: 13px;
        }

        .email-social li {
            display: inline-block;
            padding: 4px;
        }

        .email-social li a {
            display: inline-block;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: #ffffff;
        }

        .email-social li a img {
            width: 30px;
        }

        @media (max-width: 480px) {
            .email-preview-page .card {
                border-radius: 0;
                margin-left: -20px;
                margin-right: -20px;
            }

            .email-ul-col2 li {
                width: 100%;
            }
        }

        /* Additional custom styles */
        body {
            margin: 0;
            padding: 0;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .welcome-section {
            background: linear-gradient(135deg, #7cd596 0%, #55aff7 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: white;
        }

        .welcome-subtitle {
            font-size: 16px;
            margin: 0;
            color: rgba(255, 255, 255, 0.9);
        }

        .content-section {
            padding: 30px;
        }

        .highlight-box {
            background: #f8f9fa;
            border-left: 4px solid #55aff7;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .steps-list {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .steps-list ul {
            margin: 0;
            padding-left: 20px;
        }

        .steps-list li {
            margin-bottom: 8px;
            color: #526484;
        }
    </style>
</head>

<body>
    <div class="email-wraper">


        <!-- Header -->
        <div class="email-header" style="background: white; padding: 20px; text-align: center;">
            <img class="email-logo" src="https://i.ibb.co/pjs2v56w/mini-logo2.png" alt="DjibMarket Logo">
            <p class="email-title">Reset Your Password</p>
        </div>

        <!-- Main Body -->
        <div class="email-body">

            <!-- Content Section -->
            <div class="content-section">
                <h2 class="email-heading-s1" style="margin-bottom: 20px; font-weight:bold;">Hello {{ $seller->name }},
                </h2>

                <p style="color: #526484; line-height: 1.6; margin-bottom: 20px;">
                    We received a request to reset the password for your seller account associated with
                    <strong>{{ $seller->email }}</strong>.

                </p>
                <p style="color: #526484; line-height: 1.6; margin-bottom: 20px;">If you made this request, please click
                    the button below to reset your password:</p>

                <div class="highlight-box">
                    <h3 class="email-heading-s3">Reset Your Password</h3>
                    <p style="margin: 0; color: #526484;">
                        Please click the button below to reset your password.
                    </p>
                </div>

                <!-- Activation Button -->
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $resetUrl }}" class="email-btn"
                        style="font-size: 14px; padding: 0 40px; line-height: 50px;">
                        Reset Your Password
                    </a>
                </div>

                <div class="steps-list">
                    <h4 class="email-heading-s2" style="color: #55aff7;">What happens next?</h4>
                    <ul>
                        <li>Click the reset password button above</li>
                        <li>You will be redirected to a page where you can enter a new password</li>
                        <li>Once you have entered a new password, you will be able to log in with your new password</li>
                    </ul>
                </div>

                <p style="color: #526484; line-height: 1.6; margin: 20px 0;">
                    If you're unable to click the button, you can copy and paste this link into your browser:
                </p>

                <a href="{{ $resetUrl }}" class="link-block"
                    style="background: #f8f9fa; padding: 15px; border-radius: 6px; display: block; word-break: break-all; color: #55aff7; text-decoration: none; margin: 15px 0;">
                    {{ $resetUrl }}
                </a>

                <div
                    style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 6px; margin: 20px 0;">
                    <p class="email-note" style="margin: 0; color: #856404;">
                        <strong>⚠️ Important:</strong> This password reset link will expire in 15 minutes for security
                        reasons.
                    </p>
                </div>

                <h4 class="email-heading-s3">Need Help?</h4>
                <p style="color: #526484; line-height: 1.6; margin-bottom: 20px;">
                    If you have any questions or need assistance, our support team is here to help:
                </p>

                <ul class="email-ul">
                    <li>Email: <a href="mailto:support@djibmarket.com">support@djibmarket.com</a></li>
                    <li>Phone: +253 77 XX XX XX</li>
                    <li>Help Center: <a href="#">help.djibmarket.com</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer"
            style="background: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e9ecef;">
            <div class="email-copyright-text" style="margin-bottom: 15px;">
                <p style="margin: 0; color: #8094ae; line-height: 1.6;">
                    This email was sent to {{ $seller->email }} because you registered for a seller account on
                    DjibMarket.
                    <br>
                    If you didn't create this account, please ignore this email or <a
                        href="mailto:support@djibmarket.com">contact our support team</a>.
                </p>
            </div>

            <div style="margin: 15px 0;">
                <ul class="email-social"
                    style="list-style: none; padding: 0; margin: 0; display: inline-flex; gap: 10px;">
                    <li><a href="#"
                            style="background: #3b5998; color: white; width: 35px; height: 35px; line-height: 35px; border-radius: 50%; text-decoration: none;">f</a>
                    </li>
                    <li><a href="#"
                            style="background: #1da1f2; color: white; width: 35px; height: 35px; line-height: 35px; border-radius: 50%; text-decoration: none;">t</a>
                    </li>
                    <li><a href="#"
                            style="background: #0077b5; color: white; width: 35px; height: 35px; line-height: 35px; border-radius: 50%; text-decoration: none;">in</a>
                    </li>
                </ul>
            </div>

            <div class="email-copyright-text">
                <p style="margin: 0; color: #8094ae; font-size: 12px;">
                    &copy; {{ date('Y') }} DjibMarket. All rights reserved.
                    <br>
                    Djibouti City, Djibouti
                </p>
            </div>
        </div>
    </div>
</body>

</html>
