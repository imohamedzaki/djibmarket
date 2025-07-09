<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QueueStatusAlert extends Notification implements ShouldQueue
{
    use Queueable;

    protected $issues;
    protected $priority;
    protected $stats;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $issues, string $priority, array $stats = [])
    {
        $this->issues = $issues;
        $this->priority = $priority;
        $this->stats = $stats;
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
        $icon = $this->priority === 'high' ? '🚨' : '⚠️';
        $subject = "{$icon} Queue System Alert - DjibMarket";

        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting('Queue System Alert')
            ->line('Issues detected with the email queue system:')
            ->line('');

        // Add issues
        foreach ($this->issues as $issue) {
            $mail->line("• {$issue}");
        }

        $mail->line('')
            ->line('**System Statistics:**')
            ->line("• Stale Jobs: {$this->stats['stale_jobs']}")
            ->line("• Stale Emails: {$this->stats['stale_emails']}")
            ->line("• Recent Failure Rate: " . round($this->stats['failure_rate'], 1) . "%")
            ->line("• Alert Threshold: {$this->stats['threshold_minutes']} minutes")
            ->line('')
            ->action('Review Email Dashboard', route('admin.emails.dashboard'))
            ->line('Please investigate and resolve these issues promptly.');

        if ($this->priority === 'high') {
            $mail->error();
        }

        return $mail->salutation('DjibMarket Queue Monitoring System');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'queue_alert',
            'title' => 'Queue System Alert',
            'message' => $this->generateSummaryMessage(),
            'priority' => $this->priority,
            'issues' => $this->issues,
            'stats' => $this->stats,
            'action_url' => route('admin.emails.dashboard'),
            'alert_time' => now(),
        ];
    }

    /**
     * Generate summary message for database notification
     */
    private function generateSummaryMessage(): string
    {
        $issueCount = count($this->issues);
        $summary = $issueCount === 1 ? $this->issues[0] : "{$issueCount} queue issues detected";

        if ($this->priority === 'high') {
            return "🚨 URGENT: {$summary}";
        }

        return "⚠️ {$summary}";
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }
}
