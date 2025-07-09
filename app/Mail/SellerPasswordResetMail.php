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


class SellerPasswordResetMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $seller;
    public $resetUrl;
    public $emailLogId;


    /**
     * Create a new message instance.
     */
    public function __construct(Seller $seller, string $resetUrl)
    {
        $this->seller = $seller;
        $this->resetUrl = $resetUrl;

        // Set queue priority and delay if needed
        $this->onQueue('emails');

        // Log email as queued
        $emailLog = EmailLog::logQueued(
            $seller->email,
            'Reset Your Password - DjibMarket',
            'seller_password_reset',
            [
                'seller_id' => $seller->id,
                'seller_name' => $seller->name,
                'reset_url' => $resetUrl
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
            subject: 'Reset Your Password - DjibMarket',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seller-password-reset',
            with: [
                'seller' => $this->seller,
                'resetUrl' => $this->resetUrl,
            ],
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

        Log::error('Seller password reset email failed', [
            'seller_id' => $this->seller->id,
            'seller_email' => $this->seller->email,
            'email_log_id' => $this->emailLogId,
            'error' => $exception->getMessage()
        ]);
    }
}
