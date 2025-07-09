<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - DjibMarket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo svg {
            width: 30px;
            height: 30px;
            color: white;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }

        .reset-button:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }

        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #666;
        }

        .alternative-link {
            word-break: break-all;
            color: #3b82f6;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7V10C2 16 6 20.5 12 22C18 20.5 22 16 22 10V7L12 2Z" fill="currentColor" />
                </svg>
            </div>
            <h1>Reset Your Password</h1>
        </div>

        <p>Hello {{ $seller->name }},</p>

        <p>We received a request to reset the password for your seller account associated with
            <strong>{{ $seller->email }}</strong>.
        </p>

        <p>If you made this request, please click the button below to reset your password:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $resetUrl }}" class="reset-button">Reset My Password</a>
        </div>

        <div class="warning">
            <strong>Important:</strong> This password reset link will expire in 15 minutes for security reasons.
        </div>

        <p>If the button above doesn't work, you can copy and paste the following link into your browser:</p>
        <p class="alternative-link">{{ $resetUrl }}</p>

        <p>If you did not request a password reset, please ignore this email. Your password will remain unchanged.</p>

        <div class="footer">
            <p><strong>DjibMarket Team</strong></p>
            <p>This is an automated message, please do not reply to this email.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>

</html>
