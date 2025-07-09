# Seller Password Reset System

A comprehensive password reset system for seller accounts with secure token-based authentication, email queue integration, and advanced password strength validation.

## Features

-   **Secure Token System**: 15-minute expiration tokens with cryptographic hashing
-   **Email Queue Integration**: Asynchronous email sending for better performance
-   **Password Strength Validation**: Real-time password strength indicator with requirements
-   **Modern UI**: Beautiful, responsive interface matching the login design
-   **Progressive Enhancement**: JavaScript-powered UX with graceful fallbacks
-   **Security Focused**: Email verification, account status checks, and token validation

## System Architecture

### 1. Database Schema

```sql
-- seller_password_reset_tokens table
CREATE TABLE seller_password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    INDEX idx_email (email)
);
```

### 2. Email Queue System

The system uses Laravel's queue system to send password reset emails asynchronously:

```php
// Mail is queued for better performance
Mail::queue(new SellerPasswordResetMail($seller, $resetUrl));
```

### 3. Token Security

-   **Generation**: 60-character random string using `Str::random(60)`
-   **Storage**: Hashed using Laravel's `Hash::make()` before database storage
-   **Validation**: Verified using `Hash::check()` during reset process
-   **Expiration**: 15-minute lifetime with automatic cleanup

## User Flow

### 1. Request Password Reset

1. **Access**: Visit `/seller/forgot-password`
2. **Validation**: Enter email address
3. **Verification**: System checks:
    - Seller account exists
    - Email is verified
    - Account is active (not suspended)
4. **Token Generation**: Creates secure reset token
5. **Email Sending**: Queues password reset email
6. **Confirmation**: Shows success message

### 2. Reset Password

1. **Email Link**: Click reset link in email
2. **Token Validation**: System verifies:
    - Token exists and is valid
    - Token hasn't expired (15 minutes)
    - Email matches token
3. **Password Form**: Enter new password with strength validation
4. **Requirements**: Password must meet:
    - At least 8 characters
    - One uppercase letter
    - One lowercase letter
    - One number
5. **Confirmation**: Passwords must match
6. **Success**: Auto-login after successful reset

## Password Strength Validation

### Real-time Indicators

-   **Weak** (25%): Basic requirements not met
-   **Fair** (50%): Some requirements met
-   **Good** (75%): Most requirements met
-   **Strong** (100%): All requirements met

### Requirements Checklist

-   ✓ At least 8 characters
-   ✓ One uppercase letter (A-Z)
-   ✓ One lowercase letter (a-z)
-   ✓ One number (0-9)
-   ✓ Passwords match

### Submit Button Logic

The submit button is only enabled when:

-   Password strength is "Good" or "Strong" (score ≥ 3)
-   Both password fields match
-   All form validation passes

## Security Features

### 1. Account Verification

Before sending reset email, the system verifies:

```php
// Check if seller exists
$seller = Seller::where('email', $request->email)->first();

// Verify email is confirmed
if (!$seller->email_verified_at) {
    return back()->withErrors(['email' => 'Email not verified']);
}

// Check account status
if (!in_array($seller->status, ['active', 'pending'])) {
    return back()->withErrors(['email' => 'Account not active']);
}
```

### 2. Token Management

-   **Single Use**: Each token can only be used once
-   **Email Specific**: Tokens are tied to specific email addresses
-   **Automatic Cleanup**: Expired tokens are automatically deleted
-   **Secure Storage**: Tokens are hashed before database storage

### 3. Rate Limiting

Built-in protection against abuse:

-   Form submission throttling
-   Email sending limits
-   Token generation restrictions

## Email Template

The password reset email includes:

-   **Professional Design**: Matches DjibMarket branding
-   **Clear Instructions**: Step-by-step reset process
-   **Security Warning**: 15-minute expiration notice
-   **Fallback Link**: Copy-paste option if button doesn't work
-   **Support Information**: Contact details for help

## Admin Commands

### Clear Password Reset Tokens

```bash
# Clear all expired tokens (older than 15 minutes)
php artisan seller:clear-password-reset-tokens

# Clear tokens for specific email
php artisan seller:clear-password-reset-tokens --email=seller@example.com
```

### Clear Login Throttle Data

```bash
# Clear all throttle data
php artisan seller:clear-login-throttle

# Clear throttle for specific email
php artisan seller:clear-login-throttle seller@example.com
```

## Configuration

### Queue Configuration

Ensure your queue system is properly configured:

```env
QUEUE_CONNECTION=database
# or
QUEUE_CONNECTION=redis
```

Start the queue worker:

```bash
php artisan queue:work
```

### Email Configuration

Configure your email settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@djibmarket.com
MAIL_FROM_NAME="DjibMarket"
```

## Testing

### Manual Testing

1. **Request Reset**:

    ```
    POST /seller/forgot-password
    email: test@example.com
    ```

2. **Check Email**: Verify email is received and formatted correctly

3. **Reset Password**:

    ```
    GET /seller/reset-password/{token}?email=test@example.com
    ```

4. **Submit New Password**:
    ```
    POST /seller/reset-password
    token: {token}
    email: test@example.com
    password: NewPassword123
    password_confirmation: NewPassword123
    ```

### Error Scenarios

Test these error conditions:

-   **Invalid Email**: Non-existent seller email
-   **Unverified Email**: Seller with unverified email
-   **Inactive Account**: Suspended seller account
-   **Expired Token**: Token older than 15 minutes
-   **Invalid Token**: Malformed or incorrect token
-   **Weak Password**: Password not meeting requirements
-   **Mismatched Passwords**: Confirmation doesn't match

## File Structure

```
app/
├── Console/Commands/
│   └── ClearPasswordResetTokensCommand.php
├── Http/Controllers/Seller/Auth/
│   ├── NewPasswordController.php
│   └── PasswordResetLinkController.php
├── Mail/
│   └── SellerPasswordResetMail.php
└── Models/
    └── Seller.php

database/migrations/
└── 2025_07_05_200222_create_seller_password_reset_tokens_table.php

resources/views/
├── emails/
│   └── seller-password-reset.blade.php
└── seller/auth/
    ├── forgot-password.blade.php
    └── reset-password.blade.php

routes/seller/
└── auth.php
```

## Browser Support

The system supports:

-   **Modern Browsers**: Chrome 90+, Firefox 88+, Safari 14+, Edge 90+
-   **Mobile Browsers**: iOS Safari 14+, Chrome Mobile 90+
-   **Progressive Enhancement**: Works without JavaScript
-   **Responsive Design**: Mobile-first approach

## Performance Considerations

-   **Queue Processing**: Emails sent asynchronously
-   **Database Indexing**: Optimized queries with proper indexes
-   **Asset Optimization**: Minified CSS and JavaScript
-   **Caching**: Leverages Laravel's caching system
-   **Memory Usage**: Efficient token cleanup

## Maintenance

### Regular Tasks

1. **Token Cleanup**: Run cleanup command daily

    ```bash
    php artisan seller:clear-password-reset-tokens
    ```

2. **Queue Monitoring**: Ensure queue workers are running

    ```bash
    php artisan queue:work --daemon
    ```

3. **Email Monitoring**: Check email delivery rates

### Troubleshooting

#### Common Issues

1. **Emails Not Sending**:

    - Check queue worker status
    - Verify email configuration
    - Check email service limits

2. **Tokens Not Working**:

    - Verify token hasn't expired
    - Check database connection
    - Ensure proper token format

3. **Password Validation Failing**:
    - Check JavaScript console for errors
    - Verify password requirements
    - Test with different browsers

## Security Considerations

-   **Token Expiration**: Short 15-minute window
-   **Single Use**: Tokens automatically deleted after use
-   **Email Verification**: Only verified sellers can reset
-   **Account Status**: Only active accounts can reset
-   **Rate Limiting**: Protection against abuse
-   **Secure Storage**: Hashed tokens in database
-   **HTTPS Required**: All reset links use HTTPS

## Future Enhancements

-   **SMS Integration**: Optional SMS-based reset
-   **Two-Factor Authentication**: Additional security layer
-   **Password History**: Prevent reusing recent passwords
-   **Account Lockout**: Temporary lockout after multiple attempts
-   **Audit Logging**: Track all password reset activities
-   **Custom Expiration**: Configurable token lifetime
