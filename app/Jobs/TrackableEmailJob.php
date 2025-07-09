<?php

namespace App\Jobs;

use App\Models\EmailLog;
use App\Services\EmailTrackingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TrackableEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mailable;
    protected $to;
    protected $emailLogId;

    /**
     * Create a new job instance.
     */
    public function __construct($mailable, $to, $emailLogId = null)
    {
        $this->mailable = $mailable;
        $this->to = $to;
        $this->emailLogId = $emailLogId;
        $this->onQueue('emails');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Send the email
            Mail::to($this->to)->send($this->mailable);

            // Mark as sent if we have an email log ID
            if ($this->emailLogId) {
                EmailTrackingService::markAsSent($this->emailLogId, [
                    'sent_via' => 'TrackableEmailJob',
                    'to_address' => is_array($this->to) ? $this->to['address'] : $this->to
                ]);
            }

            Log::info('Email sent successfully via TrackableEmailJob', [
                'email_log_id' => $this->emailLogId,
                'to' => is_array($this->to) ? $this->to['address'] : $this->to,
                'mailable' => get_class($this->mailable)
            ]);
        } catch (\Exception $e) {
            // Mark as failed if we have an email log ID
            if ($this->emailLogId) {
                EmailTrackingService::markAsFailed($this->emailLogId, $e->getMessage(), [
                    'failed_via' => 'TrackableEmailJob',
                    'to_address' => is_array($this->to) ? $this->to['address'] : $this->to
                ]);
            }

            Log::error('Email failed to send via TrackableEmailJob', [
                'email_log_id' => $this->emailLogId,
                'to' => is_array($this->to) ? $this->to['address'] : $this->to,
                'mailable' => get_class($this->mailable),
                'error' => $e->getMessage()
            ]);

            // Re-throw the exception to trigger Laravel's retry mechanism
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        // Mark as failed if we have an email log ID
        if ($this->emailLogId) {
            EmailTrackingService::markAsFailed($this->emailLogId, $exception->getMessage(), [
                'failed_permanently' => true,
                'failed_via' => 'TrackableEmailJob',
                'to_address' => is_array($this->to) ? $this->to['address'] : $this->to
            ]);
        }

        Log::error('Email permanently failed via TrackableEmailJob', [
            'email_log_id' => $this->emailLogId,
            'to' => is_array($this->to) ? $this->to['address'] : $this->to,
            'mailable' => get_class($this->mailable),
            'error' => $exception->getMessage()
        ]);
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
}
