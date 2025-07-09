<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $seller = Auth::guard('seller')->user();

        if ($seller->hasVerifiedEmail()) {
            return redirect()->intended(route('seller.dashboard', absolute: false) . '?verified=1');
        }

        if ($seller->markEmailAsVerified()) {
            event(new Verified($seller));
        }

        return redirect()->intended(route('seller.dashboard', absolute: false) . '?verified=1');
    }
}
