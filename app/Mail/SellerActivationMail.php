<?php

namespace App\Mail;

use App\Models\Seller;
use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SellerActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $seller;
    public $activationUrl;
    public $emailLogId;

    /**
     * Create a new message instance.
     */
    public function __construct(Seller $seller, string $activationUrl)
    {
        $this->seller = $seller;
        $this->activationUrl = $activationUrl;

        // Set queue priority and delay if needed
        $this->onQueue('emails');

        // Log email as queued
        $emailLog = EmailLog::logQueued(
            $seller->email,
            'Confirm Your E-Mail Address - DjibMarket',
            'seller_activation',
            [
                'seller_id' => $seller->id,
                'seller_name' => $seller->name,
                'activation_url' => $activationUrl
            ]
        );

        $this->emailLogId = $emailLog->id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->seller->email,
            subject: 'Confirm Your E-Mail Address - DjibMarket',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seller-activation',
            with: [
                'seller' => $this->seller,
                'activationUrl' => $this->activationUrl,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff()
    {
        return [30, 60, 120]; // Retry after 30s, 1min, 2min
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception)
    {
        if ($this->emailLogId) {
            $emailLog = EmailLog::find($this->emailLogId);
            if ($emailLog) {
                $emailLog->markAsFailed($exception->getMessage());
            }
        }

        Log::error('Seller activation email failed', [
            'seller_id' => $this->seller->id,
            'seller_email' => $this->seller->email,
            'email_log_id' => $this->emailLogId,
            'error' => $exception->getMessage()
        ]);
    }
}