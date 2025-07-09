<?php

namespace App\Listeners;

use App\Models\EmailLog;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class EmailSentListener
{
    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        // Get the mailable instance if available
        $mailable = $event->data['mailable'] ?? null;

        if ($mailable && property_exists($mailable, 'emailLogId') && $mailable->emailLogId) {
            $emailLog = EmailLog::find($mailable->emailLogId);
            if ($emailLog) {
                $emailLog->markAsSent();

                Log::info('Email sent successfully', [
                    'email_log_id' => $emailLog->id,
                    'to_email' => $emailLog->to_email,
                    'email_type' => $emailLog->email_type,
                    'processing_time' => $emailLog->processing_time_human
                ]);
            }
        }
    }
}
