<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\SellerDocument;
use App\Mail\SellerActivationMail;
use App\Jobs\TrackableEmailJob;
use App\Services\EmailTrackingService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|\Illuminate\Http\RedirectResponse
    {
        // If seller is already authenticated, redirect to dashboard
        if (Auth::guard('seller')->check()) {
            return redirect()->route('seller.dashboard');
        }

        return view('seller.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Seller::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'business_activity_id' => ['required', 'exists:business_activities,id'],
            'address' => ['required', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            // Documents - all required
            'documents.patente' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:10240'],
            'documents.tva' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:10240'],
            'documents.id_card' => ['required', 'file', 'mimes:pdf,jpeg,png,jpg', 'max:10240'],
            // Patente additional fields
            'patente_number' => ['required', 'string', 'max:100'],
            'patente_owner' => ['required', 'string', 'max:255'],
            'patente_nif' => ['required', 'string', 'max:100'],
            'patente_quittance' => ['required', 'string', 'max:100'],
            'documents_expiry.patente' => ['required', 'date', 'after:today'],
            // Other expiry dates - required
            'documents_expiry.tva' => ['required', 'date', 'after:today'],
            'documents_expiry.id_card' => ['required', 'date', 'after:today'],
        ]);

        // Generate activation token
        $activationToken = Str::random(60);

        // Create seller first to get the ID
        $seller = Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'business_activity_id' => $request->business_activity_id,
            'status' => 'pending',
            'activation_token' => $activationToken,
        ]);

        // Create seller directory name
        $sellerDirectory = $seller->id . ' - ' . $seller->name;
        $publicStoragePath = public_path('storage/sellers/' . $sellerDirectory);

        // Create directory if it doesn't exist
        if (!file_exists($publicStoragePath)) {
            mkdir($publicStoragePath, 0755, true);
        }

        // Handle avatar upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarDir = $publicStoragePath . '/avatar';
            if (!file_exists($avatarDir)) {
                mkdir($avatarDir, 0755, true);
            }
            $avatarFile = $request->file('avatar');
            $avatarFilename = time() . '.' . $avatarFile->getClientOriginalExtension();
            $avatarFile->move($avatarDir, $avatarFilename);
            $avatarPath = 'storage/sellers/' . $sellerDirectory . '/avatar/' . $avatarFilename;
        }

        // Handle cover image upload
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverDir = $publicStoragePath . '/cover';
            if (!file_exists($coverDir)) {
                mkdir($coverDir, 0755, true);
            }
            $coverFile = $request->file('cover_image');
            $coverFilename = time() . '.' . $coverFile->getClientOriginalExtension();
            $coverFile->move($coverDir, $coverFilename);
            $coverImagePath = 'storage/sellers/' . $sellerDirectory . '/cover/' . $coverFilename;
        }

        // Update seller with avatar and cover paths
        $seller->update([
            'avatar' => $avatarPath,
            'cover_image' => $coverImagePath,
        ]);

        // Handle document uploads
        if ($request->hasFile('documents')) {
            // Handle Patente document
            if ($request->hasFile('documents.patente')) {
                $file = $request->file('documents.patente');
                $extension = $file->getClientOriginalExtension();
                $filename = 'patente_' . time() . '.' . $extension;
                $file->move($publicStoragePath, $filename);
                $documentPath = 'storage/sellers/' . $sellerDirectory . '/' . $filename;

                SellerDocument::create([
                    'seller_id' => $seller->id,
                    'document_type' => 'patente',
                    'document_path' => $documentPath,
                    'expiry_date' => $request->input('documents_expiry.patente'),
                    'additional_info' => [
                        'Numéro de Patente' => $request->input('patente_number'),
                        'Propriétaire de la Patente' => $request->input('patente_owner'),
                        'Numéro NIF' => $request->input('patente_nif'),
                        'Numéro de Quittance' => $request->input('patente_quittance'),
                    ],
                ]);
            }

            // Handle TVA document
            if ($request->hasFile('documents.tva')) {
                $file = $request->file('documents.tva');
                $extension = $file->getClientOriginalExtension();
                $filename = 'tva_' . time() . '.' . $extension;
                $file->move($publicStoragePath, $filename);
                $documentPath = 'storage/sellers/' . $sellerDirectory . '/' . $filename;

                SellerDocument::create([
                    'seller_id' => $seller->id,
                    'document_type' => 'tva',
                    'document_path' => $documentPath,
                    'expiry_date' => $request->input('documents_expiry.tva'),
                ]);
            }

            // Handle ID Card document
            if ($request->hasFile('documents.id_card')) {
                $file = $request->file('documents.id_card');
                $extension = $file->getClientOriginalExtension();
                $filename = 'id_card_' . time() . '.' . $extension;
                $file->move($publicStoragePath, $filename);
                $documentPath = 'storage/sellers/' . $sellerDirectory . '/' . $filename;

                SellerDocument::create([
                    'seller_id' => $seller->id,
                    'document_type' => 'id_card',
                    'document_path' => $documentPath,
                    'expiry_date' => $request->input('documents_expiry.id_card'),
                ]);
            }
        }

        // Send activation email
        $this->sendActivationEmail($seller, $activationToken);

        // Fire the registered event
        event(new Registered($seller));

        return redirect()->route('seller.login')->with(
            'success',
            'Registration successful! Please check your email to verify your account before logging in.'
        );
    }

    /**
     * Send activation email to the seller
     */
    private function sendActivationEmail(Seller $seller, string $token)
    {
        $activationUrl = route('seller.activate', ['token' => $token]);

        // Create trackable mailable (without queue)
        $mailable = new SellerActivationMail($seller, $activationUrl);
        $mailable->onConnection(null); // Remove ShouldQueue temporarily

        // Track the email in our system
        $emailLog = EmailTrackingService::trackQueued(
            $mailable,
            $seller->email,
            'Confirm Your E-Mail Address - DjibMarket',
            'seller_activation',
            [
                'seller_id' => $seller->id,
                'seller_name' => $seller->name,
                'activation_url' => $activationUrl,
                'sent_via' => 'TrackableEmailJob'
            ]
        );

        // Dispatch trackable job
        TrackableEmailJob::dispatch($mailable, $seller->email, $emailLog ? $emailLog->id : null);
    }

    /**
     * Activate seller account using token
     */
    public function activate(Request $request, string $token): RedirectResponse
    {
        $seller = Seller::where('activation_token', $token)->first();

        if (!$seller) {
            return redirect()->route('seller.login')->with(
                'error',
                'Invalid activation token. Please contact support if you continue to have issues.'
            );
        }

        if ($seller->email_verified_at) {
            return redirect()->route('seller.login')->with(
                'info',
                'Your email is already verified. You can now log in.'
            );
        }

        // Verify the seller email
        $seller->update([
            'activation_token' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('seller.login')->with(
            'success',
            'Your email has been successfully verified! You can now log in. Your account is pending approval and will be reviewed by our team.'
        );
    }

    /**
     * Show the resend activation email form
     */
    public function showResendForm(): View
    {
        return view('seller.auth.resend-activation');
    }

    /**
     * Handle resend activation email request
     */
    public function resendActivation(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $email = $request->email;

        // Check if seller exists
        $seller = Seller::where('email', $email)->first();

        if (!$seller) {
            return back()->withErrors([
                'email' => 'No account found with this email address.'
            ]);
        }

        // Additional verification level: Check if email_verified_at is null
        if (!is_null($seller->email_verified_at)) {
            return back()->withErrors([
                'email' => 'This email is already verified. You can log in now.'
            ]);
        }

        // Check rate limiting - 10 minutes between resends
        $cacheKey = 'seller_activation_resend_' . $seller->id;
        $lastSent = cache($cacheKey);

        if ($lastSent) {
            $timeRemaining = 10 * 60 - (now()->timestamp - $lastSent);
            if ($timeRemaining > 0) {
                $minutes = floor($timeRemaining / 60);
                $seconds = $timeRemaining % 60;
                return back()->withErrors([
                    'email' => "Please wait {$minutes} minutes and {$seconds} seconds before requesting another verification email."
                ])->with('time_remaining', $timeRemaining);
            }
        }

        // Additional verification: Double-check email_verified_at is still null before processing
        $seller->refresh(); // Refresh model to get latest data
        if (!is_null($seller->email_verified_at)) {
            return back()->withErrors([
                'email' => 'This email has been verified by another request. You can log in now.'
            ]);
        }

        // Generate new activation token
        $newActivationToken = Str::random(60);

        // Update seller with new token
        $seller->update([
            'activation_token' => $newActivationToken,
        ]);

        // Send new activation email
        $this->sendActivationEmail($seller, $newActivationToken);

        // Set rate limiting cache for 10 minutes
        cache([$cacheKey => now()->timestamp], now()->addMinutes(10));

        return redirect()->route('seller.login')->with(
            'success',
            'A new verification email has been sent to your email address. Please check your inbox.'
        );
    }

    /**
     * Get remaining time for rate limiting (API endpoint for real-time updates)
     */
    public function getRemainingTime(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $seller = Seller::where('email', $request->email)->first();

        if (!$seller) {
            return response()->json([
                'remaining' => 0,
                'email_exists' => false,
                'email_verified' => false
            ]);
        }

        // Check if email is already verified
        if ($seller->email_verified_at) {
            return response()->json([
                'remaining' => 0,
                'email_exists' => true,
                'email_verified' => true
            ]);
        }

        $cacheKey = 'seller_activation_resend_' . $seller->id;
        $lastSent = cache($cacheKey);

        if (!$lastSent) {
            return response()->json([
                'remaining' => 0,
                'email_exists' => true,
                'email_verified' => false
            ]);
        }

        $timeRemaining = 10 * 60 - (now()->timestamp - $lastSent);

        return response()->json([
            'remaining' => max(0, $timeRemaining),
            'email_exists' => true,
            'email_verified' => false
        ]);
    }
}