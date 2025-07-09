<?php

namespace App\Notifications;

use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailFailureAlert extends Notification implements ShouldQueue
{
    use Queueable;

    protected $emailLog;
    protected $failureDetails;

    /**
     * Create a new notification instance.
     */
    public function __construct(EmailLog $emailLog, array $failureDetails = [])
    {
        $this->emailLog = $emailLog;
        $this->failureDetails = $failureDetails;
        $this->onQueue('notifications');
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->error()
            ->subject('🚨 Email Delivery Failure Alert - DjibMarket')
            ->greeting('Email Delivery Alert')
            ->line('An email failed to deliver on DjibMarket platform.')
            ->line('**Email Details:**')
            ->line('- To: ' . $this->emailLog->to_email)
            ->line('- Type: ' . ucwords(str_replace('_', ' ', $this->emailLog->email_type)))
            ->line('- Subject: ' . $this->emailLog->subject)
            ->line('- Failed At: ' . $this->emailLog->failed_at->format('M d, Y H:i:s'))
            ->line('**Error Message:**')
            ->line($this->emailLog->error_message)
            ->action('View Email Details', route('admin.emails.show', $this->emailLog))
            ->line('Please review and take necessary action.')
            ->salutation('DjibMarket Email System');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'email_failure',
            'title' => 'Email Delivery Failure',
            'message' => "Email to {$this->emailLog->to_email} failed to deliver",
            'email_log_id' => $this->emailLog->id,
            'email_type' => $this->emailLog->email_type,
            'to_email' => $this->emailLog->to_email,
            'error_message' => $this->emailLog->error_message,
            'failed_at' => $this->emailLog->failed_at,
            'action_url' => route('admin.emails.show', $this->emailLog),
            'priority' => $this->getPriority(),
            'details' => $this->failureDetails
        ];
    }

    /**
     * Get failure priority based on email type and frequency
     */
    private function getPriority(): string
    {
        // Check how many failures for this email type today
        $todayFailures = EmailLog::where('email_type', $this->emailLog->email_type)
            ->where('status', 'failed')
            ->whereDate('created_at', today())
            ->count();

        // Check failures to same email
        $emailFailures = EmailLog::where('to_email', $this->emailLog->to_email)
            ->where('status', 'failed')
            ->where('created_at', '>=', now()->subHours(24))
            ->count();

        if ($emailFailures >= 3 || $todayFailures >= 10) {
            return 'high';
        } elseif ($emailFailures >= 2 || $todayFailures >= 5) {
            return 'medium';
        }

        return 'low';
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
