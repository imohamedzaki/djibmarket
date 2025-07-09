<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $token = $request->route('token');
        $email = $request->get('email');

        // Validate token and email
        if (!$token || !$email) {
            return redirect()->route('seller.login')->withErrors([
                'email' => 'Invalid password reset link.',
            ]);
        }

        // Check if token exists and is not expired (15 minutes)
        $resetRecord = DB::table('seller_password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$resetRecord) {
            return redirect()->route('seller.login')->withErrors([
                'email' => 'This password reset link is invalid or has been used.',
            ]);
        }

        // Check if token is expired (15 minutes)
        if (now()->diffInMinutes($resetRecord->created_at) > 15) {
            // Delete expired token
            DB::table('seller_password_reset_tokens')
                ->where('email', $email)
                ->delete();

            return redirect()->route('seller.login')->withErrors([
                'email' => 'This password reset link has expired. Please request a new one.',
            ]);
        }

        // Verify token
        if (!Hash::check($token, $resetRecord->token)) {
            return redirect()->route('seller.login')->withErrors([
                'email' => 'Invalid password reset link.',
            ]);
        }

        return view('seller.auth.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Handle an incoming new password request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Check if token exists and is not expired
        $resetRecord = DB::table('seller_password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors([
                'email' => 'This password reset link is invalid or has been used.',
            ]);
        }

        // Check if token is expired (15 minutes)
        if (now()->diffInMinutes($resetRecord->created_at) > 15) {
            // Delete expired token
            DB::table('seller_password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return back()->withErrors([
                'email' => 'This password reset link has expired. Please request a new one.',
            ]);
        }

        // Verify token
        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors([
                'email' => 'Invalid password reset link.',
            ]);
        }

        // Find the seller
        $seller = Seller::where('email', $request->email)->first();

        if (!$seller) {
            return back()->withErrors([
                'email' => 'We could not find a seller account with that email address.',
            ]);
        }

        // Update the seller's password
        $seller->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Delete the used token
        DB::table('seller_password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Fire password reset event
        event(new PasswordReset($seller));

        // Log the seller in
        Auth::guard('seller')->login($seller);

        return redirect()->route('seller.dashboard')->with('status', 'Your password has been successfully reset!');
    }
}
