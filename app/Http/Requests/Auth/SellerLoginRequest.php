<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SellerLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::guard('seller')->attempt([
            'email' => request('email'),
            'password' => request('password')
        ], request()->has('remember'))) {

            // Get remaining attempts BEFORE hitting the rate limiter
            $currentAttempts = $this->getCurrentAttempts();
            $remainingAttempts = max(0, 5 - ($currentAttempts + 1));

            // Hit the rate limiter
            $this->hitRateLimiter();

            // Check if user is now locked out after hitting rate limiter
            if ($this->isLockedOut()) {
                $seconds = $this->getLockoutTimeRemaining();
                $minutes = ceil($seconds / 60);

                throw ValidationException::withMessages([
                    'email' => "Too many login attempts. Please try again after {$minutes} minutes.",
                ]);
            }

            // Create error message with remaining attempts
            $errorMessage = trans('auth.failed');
            if ($remainingAttempts > 0) {
                if ($remainingAttempts == 1) {
                    $errorMessage .= " <strong>Warning:</strong> You have only one attempt remaining before your account is temporarily locked.";
                } else {
                    $errorMessage .= " You have {$remainingAttempts} attempts remaining.";
                }
            }

            throw ValidationException::withMessages([
                'email' => $errorMessage,
            ]);
        }

        // Check if the seller email is verified and account status
        $seller = Auth::guard('seller')->user();
        if ($seller && !$seller->email_verified_at) {
            Auth::guard('seller')->logout();

            $message = 'Your email is not verified. Please check your email for the verification link. <br><br><strong><a href="' . route('seller.resend-activation') . '" style="color: #3b82f6; text-decoration: none;">Resend verification email</a></strong>';

            throw ValidationException::withMessages([
                'email' => $message,
            ]);
        }

        // Check if the seller account is rejected or suspended
        if ($seller && in_array($seller->status, ['rejected', 'suspended'])) {
            Auth::guard('seller')->logout();

            $message = match ($seller->status) {
                'suspended' => 'Your account has been suspended. Please contact support for assistance.',
                'rejected' => 'Your seller application has been rejected. Please contact support for more information.',
                default => 'Your account is not active. Please contact support for assistance.'
            };

            throw ValidationException::withMessages([
                'email' => $message,
            ]);
        }

        // Clear rate limiter on successful login
        $this->clearRateLimiter();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        $throttleKey = $this->throttleKey();
        $attempts = $this->getCurrentAttempts();

        // Check if user is currently locked out
        if ($this->isLockedOut()) {
            $seconds = $this->getLockoutTimeRemaining();
            $minutes = ceil($seconds / 60);

            throw ValidationException::withMessages([
                'email' => "Too many login attempts. Please try again after {$minutes} minutes.",
            ]);
        }
    }

    /**
     * Hit the rate limiter for the current request.
     */
    protected function hitRateLimiter(): void
    {
        $throttleKey = $this->throttleKey();
        $attempts = $this->getCurrentAttempts() + 1;

        // Store the current attempt count
        Cache::put($throttleKey, $attempts, now()->addHours(24));

        // If we've reached 5 attempts, lock out the user
        if ($attempts >= 5) {
            $this->lockoutUser();
        }
    }

    /**
     * Lock out the user for a progressive amount of time.
     */
    protected function lockoutUser(): void
    {
        $lockoutKey = $this->lockoutKey();
        $lockoutCount = $this->getLockoutCount() + 1;

        // Calculate lockout duration: 5 minutes for first lockout, then +5 minutes each time
        $lockoutMinutes = 5 * $lockoutCount;
        $lockoutUntil = now()->addMinutes($lockoutMinutes);

        // Store lockout information
        Cache::put($lockoutKey, $lockoutUntil, $lockoutUntil);
        Cache::put($this->lockoutCountKey(), $lockoutCount, now()->addHours(24));

        // Reset attempts counter
        Cache::forget($this->throttleKey());

        event(new Lockout($this));
    }

    /**
     * Check if the user is currently locked out.
     */
    protected function isLockedOut(): bool
    {
        $lockoutKey = $this->lockoutKey();
        $lockoutUntil = Cache::get($lockoutKey);

        if ($lockoutUntil && now()->lt($lockoutUntil)) {
            return true;
        }

        // Clean up expired lockout
        if ($lockoutUntil && now()->gte($lockoutUntil)) {
            Cache::forget($lockoutKey);
        }

        return false;
    }

    /**
     * Get the remaining lockout time in seconds.
     */
    protected function getLockoutTimeRemaining(): int
    {
        $lockoutKey = $this->lockoutKey();
        $lockoutUntil = Cache::get($lockoutKey);

        if ($lockoutUntil && now()->lt($lockoutUntil)) {
            return now()->diffInSeconds($lockoutUntil);
        }

        return 0;
    }

    /**
     * Get the current number of attempts.
     */
    protected function getCurrentAttempts(): int
    {
        return Cache::get($this->throttleKey(), 0);
    }

    /**
     * Get the remaining attempts.
     */
    protected function getRemainingAttempts(): int
    {
        return max(0, 5 - $this->getCurrentAttempts());
    }

    /**
     * Get the current lockout count.
     */
    protected function getLockoutCount(): int
    {
        return Cache::get($this->lockoutCountKey(), 0);
    }

    /**
     * Clear the rate limiter.
     */
    protected function clearRateLimiter(): void
    {
        Cache::forget($this->throttleKey());
        Cache::forget($this->lockoutKey());
        // Don't clear lockout count to maintain progressive timing
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return 'seller_login_attempts:' . Str::transliterate(Str::lower(request('email')) . '|' . request()->ip());
    }

    /**
     * Get the lockout key for the request.
     */
    protected function lockoutKey(): string
    {
        return 'seller_login_lockout:' . Str::transliterate(Str::lower(request('email')) . '|' . request()->ip());
    }

    /**
     * Get the lockout count key for the request.
     */
    protected function lockoutCountKey(): string
    {
        return 'seller_login_lockout_count:' . Str::transliterate(Str::lower(request('email')) . '|' . request()->ip());
    }
}