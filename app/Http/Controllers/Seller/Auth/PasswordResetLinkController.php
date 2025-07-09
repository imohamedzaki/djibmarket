<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SellerPasswordResetMail;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;


class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('seller.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $throttleKey = 'password.email|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $remaining = RateLimiter::availableIn($throttleKey);
            return back()
                ->withErrors(['email' => "Too many password reset requests. Please try again in {$remaining} seconds."])
                ->with('time_remaining', $remaining);
        }

        // Check if seller exists
        $seller = Seller::where('email', $request->email)->first();

        if (!$seller) {
            return back()->withErrors([
                'email' => 'We could not find a seller account with that email address.',
            ]);
        }

        // Check if seller email is verified
        if (!$seller->email_verified_at) {
            return back()->withErrors([
                'email' => 'Your email address is not verified. Please verify your email first.',
            ]);
        }

        // Check if seller account is active
        if (!in_array($seller->status, ['active', 'pending'])) {
            return back()->withErrors([
                'email' => 'Your seller account is not active. Please contact support.',
            ]);
        }

        // Generate reset token
        $token = Str::random(60);

        // Delete any existing reset tokens for this email
        DB::table('seller_password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Store the new reset token
        DB::table('seller_password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => now(),
        ]);

        // Create reset URL
        $resetUrl = route('seller.password.reset', ['token' => $token, 'email' => $request->email]);

        // Send password reset email via queue
        Mail::queue(new SellerPasswordResetMail($seller, $resetUrl));

        // Hit the rate limiter
        RateLimiter::hit($throttleKey, 900); // 15 minutes

        return back()->with('status', 'We have sent a password reset link to your email address. Please check your inbox and follow the instructions. The link will expire in 15 minutes.');
    }

    /**
     * Get the remaining time for a password reset request.
     */
    public function getRemainingTime(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');

        $seller = Seller::where('email', $email)->first();

        if (!$seller) {
            return response()->json([
                'email_exists' => false,
                'remaining' => 0,
            ]);
        }

        // Check if seller email is verified
        if (!$seller->email_verified_at) {
            return response()->json([
                'email_exists' => true,
                'email_verified' => false,
                'remaining' => 0,
            ]);
        }

        // Check if seller account is active
        if (!in_array($seller->status, ['active', 'pending'])) {
            return response()->json([
                'email_exists' => true,
                'email_verified' => true,
                'account_active' => false,
                'remaining' => 0,
            ]);
        }

        $throttleKey = 'password.email|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 1)) {
            $remaining = RateLimiter::availableIn($throttleKey);
        } else {
            $remaining = 0;
        }

        return response()->json([
            'email_exists' => true,
            'email_verified' => true,
            'account_active' => true,
            'remaining' => $remaining,
        ]);
    }
}