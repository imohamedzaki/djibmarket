# Seller Login Throttling System

## Overview

An advanced login protection system for sellers that protects against brute force attacks and provides an enhanced user experience.

## Features

### 1. Progressive Attempt System

-   **5 attempts** per user before lockout
-   Display remaining attempts after each failed login
-   Special warning when only one attempt remains

### 2. Progressive Lockout System

-   **First lockout**: 5 minutes
-   **Second lockout**: 10 minutes
-   **Third lockout**: 15 minutes
-   **Fourth lockout**: 20 minutes
-   And so on... (each lockout increases by 5 minutes)

### 3. Enhanced User Interface

-   Real-time countdown timer showing remaining lockout time
-   Form disabled during lockout period
-   Clear and understandable messages in English

## How It Works

### 1. Failed Attempts

```
Attempt 1: Error - "Invalid credentials. You have 4 attempts remaining."
Attempt 2: Error - "Invalid credentials. You have 3 attempts remaining."
Attempt 3: Error - "Invalid credentials. You have 2 attempts remaining."
Attempt 4: Error - "Invalid credentials. Warning: You have only one attempt remaining before your account is temporarily locked."
Attempt 5: Error - Locked for 5 minutes
```

### 2. Progressive Lockout

```
First lockout: 5 minutes
Second lockout: 10 minutes
Third lockout: 15 minutes
Fourth lockout: 20 minutes
```

## Modified Files

### 1. `app/Http/Requests/Auth/SellerLoginRequest.php`

-   Added attempt tracking system
-   Added progressive lockout system
-   Added custom error messages

### 2. `resources/views/seller/auth/login.blade.php`

-   Added countdown timer
-   Enhanced error messages
-   Form disabled during lockout

### 3. `app/Console/Commands/ClearSellerLoginThrottleCommand.php`

-   Command to clear throttle data (for testing and administration)

## Available Commands

### Clear throttle data for specific user

```bash
php artisan seller:clear-login-throttle user@example.com
```

### Clear all throttle data

```bash
php artisan seller:clear-login-throttle
```

## Technologies Used

-   **Laravel Cache**: For storing attempt and lockout data
-   **JavaScript**: For real-time countdown timer
-   **CSS**: For enhanced user interface

## Requirements

-   Laravel 10+
-   Cache system enabled (Redis preferred for better performance)
-   JavaScript enabled in browser

## Important Notes

1. **Security**: The system uses IP address + email to track attempts
2. **Performance**: Uses Laravel Cache for temporary data storage
3. **Cleanup**: Lockout data expires automatically
4. **Customization**: Number of attempts and lockout times can be easily modified

## Testing

1. Try logging in with wrong credentials 5 times
2. Verify remaining attempts messages appear
3. Verify lockout activates after 5th attempt
4. Verify countdown timer works
5. Try repeated lockouts to verify progressive timing

## Configuration

You can modify the following parameters in `SellerLoginRequest.php`:

-   **MAX_ATTEMPTS**: Currently set to 5
-   **BASE_LOCKOUT_MINUTES**: Currently set to 5 minutes
-   **LOCKOUT_INCREMENT**: Currently set to 5 minutes per lockout cycle

## Cache Keys Used

-   `seller_login_attempts:{email}|{ip}` - Stores current attempt count
-   `seller_login_lockout:{email}|{ip}` - Stores lockout expiration time
-   `seller_login_lockout_count:{email}|{ip}` - Stores number of lockout cycles

## Support

In case of issues:

1. Ensure Cache system is enabled
2. Check JavaScript is enabled in browser
3. Use the clear command for testing purposes
4. Check Laravel logs for any errors

## Security Considerations

-   The system tracks attempts per IP + email combination
-   Lockout data is stored in cache with automatic expiration
-   Progressive timing prevents persistent attacks
-   Successful login clears attempt counters
-   System is resistant to cache poisoning attacks
