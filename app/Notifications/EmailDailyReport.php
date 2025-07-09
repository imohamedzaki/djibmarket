<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailDailyReport extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reportData;
    protected $period;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $reportData, string $period = 'daily')
    {
        $this->reportData = $reportData;
        $this->period = $period;
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
        $data = $this->reportData;
        $period = ucfirst($this->period);

        return (new MailMessage)
            ->subject("📊 {$period} Email Report - DjibMarket")
            ->greeting("{$period} Email Delivery Report")
            ->line("Here's your {$this->period} email delivery summary for DjibMarket:")
            ->line('')
            ->line("**📈 Summary Statistics:**")
            ->line("• Total Emails: " . number_format($data['total_emails']))
            ->line("• Successfully Sent: " . number_format($data['sent_emails']) . " ({$data['success_rate']}%)")
            ->line("• Failed: " . number_format($data['failed_emails']) . " ({$data['failure_rate']}%)")
            ->line("• Still Queued: " . number_format($data['queued_emails']))
            ->line('')
            ->line("**⚡ Performance:**")
            ->line("• Average Processing Time: {$data['avg_processing_time']} seconds")
            ->line('')
            ->when($data['failed_emails'] > 0, function ($mail) use ($data) {
                return $mail->line("**🚨 Attention Required:**")
                    ->line("{$data['failed_emails']} emails failed to deliver. Please review the failures in the admin panel.");
            })
            ->when(isset($data['by_type']) && $data['by_type']->isNotEmpty(), function ($mail) use ($data) {
                $mail->line("**📧 Email Types Breakdown:**");
                foreach ($data['by_type']->take(5) as $type) {
                    $typeName = ucwords(str_replace('_', ' ', $type->email_type));
                    $mail->line("• {$typeName}: {$type->total} total, {$type->sent} sent ({$type->success_rate}%)");
                }
                return $mail;
            })
            ->action('View Detailed Report', route('admin.emails.dashboard'))
            ->line('Keep monitoring your email delivery performance!')
            ->salutation('DjibMarket Email System');
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        $data = $this->reportData;

        return [
            'type' => 'email_report',
            'title' => ucfirst($this->period) . ' Email Report',
            'message' => $this->generateSummaryMessage($data),
            'period' => $this->period,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_emails' => $data['total_emails'],
            'sent_emails' => $data['sent_emails'],
            'failed_emails' => $data['failed_emails'],
            'success_rate' => $data['success_rate'],
            'failure_rate' => $data['failure_rate'],
            'action_url' => route('admin.emails.dashboard'),
            'priority' => $this->getReportPriority($data),
            'stats' => [
                'avg_processing_time' => $data['avg_processing_time'],
                'peak_hours' => $data['peak_hours'] ?? [],
                'top_failures' => $data['top_failures'] ?? []
            ]
        ];
    }

    /**
     * Generate summary message for database notification
     */
    private function generateSummaryMessage(array $data): string
    {
        $total = number_format($data['total_emails']);
        $sent = number_format($data['sent_emails']);
        $failed = number_format($data['failed_emails']);
        $rate = $data['success_rate'];

        $message = "{$total} emails processed, {$sent} sent successfully ({$rate}% success rate)";

        if ($data['failed_emails'] > 0) {
            $message .= ". {$failed} emails failed - requires attention.";
        }

        return $message;
    }

    /**
     * Determine report priority based on failure rate and volumes
     */
    private function getReportPriority(array $data): string
    {
        $failureRate = $data['failure_rate'];
        $totalEmails = $data['total_emails'];

        // High priority if failure rate is high or significant volume failures
        if ($failureRate >= 10 || ($failureRate >= 5 && $totalEmails >= 100)) {
            return 'high';
        }

        // Medium priority if moderate failure rate
        if ($failureRate >= 5 || ($failureRate >= 2 && $totalEmails >= 50)) {
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
