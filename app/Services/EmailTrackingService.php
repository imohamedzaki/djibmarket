<?php

namespace App\Services;

use App\Models\EmailLog;
use App\Models\Admin;
use App\Notifications\EmailFailureAlert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Mail\Events\MessageSent;

class EmailTrackingService
{
    /**
     * Track an email that's about to be queued
     */
    public static function trackQueued($mailable, $to, $subject, $type, $metadata = [])
    {
        try {
            $emailLog = EmailLog::logQueued($to, $subject, $type, $metadata);

            // Store the email log ID in the mailable if it has the property
            if (property_exists($mailable, 'emailLogId')) {
                $mailable->emailLogId = $emailLog->id;
            }

            Log::info('Email queued for tracking', [
                'email_log_id' => $emailLog->id,
                'to_email' => is_array($to) ? $to['address'] : $to,
                'email_type' => $type
            ]);

            return $emailLog;
        } catch (\Exception $e) {
            Log::error('Failed to track queued email', [
                'error' => $e->getMessage(),
                'to_email' => is_array($to) ? $to['address'] : $to,
                'email_type' => $type
            ]);
            return null;
        }
    }

    /**
     * Mark email as sent
     */
    public static function markAsSent($emailLogId, $additionalInfo = [])
    {
        try {
            $emailLog = EmailLog::find($emailLogId);
            if ($emailLog) {
                $emailLog->markAsSent();

                Log::info('Email marked as sent', array_merge([
                    'email_log_id' => $emailLog->id,
                    'to_email' => $emailLog->to_email,
                    'processing_time' => $emailLog->processing_time_human
                ], $additionalInfo));

                return $emailLog;
            }
        } catch (\Exception $e) {
            Log::error('Failed to mark email as sent', [
                'email_log_id' => $emailLogId,
                'error' => $e->getMessage()
            ]);
        }
        return null;
    }

    /**
     * Mark email as failed
     */
    public static function markAsFailed($emailLogId, $errorMessage = null, $additionalInfo = [])
    {
        try {
            $emailLog = EmailLog::find($emailLogId);
            if ($emailLog) {
                $emailLog->markAsFailed($errorMessage);

                Log::error('Email marked as failed', array_merge([
                    'email_log_id' => $emailLog->id,
                    'to_email' => $emailLog->to_email,
                    'error_message' => $errorMessage
                ], $additionalInfo));

                // Send notification to admins for critical failures
                self::notifyAdminsOfFailure($emailLog, $additionalInfo);

                return $emailLog;
            }
        } catch (\Exception $e) {
            Log::error('Failed to mark email as failed', [
                'email_log_id' => $emailLogId,
                'error' => $e->getMessage()
            ]);
        }
        return null;
    }

    /**
     * Get email statistics
     */
    public static function getStatistics($days = 30)
    {
        $startDate = now()->subDays($days);

        return [
            'total' => EmailLog::where('created_at', '>=', $startDate)->count(),
            'sent' => EmailLog::where('created_at', '>=', $startDate)->where('status', 'sent')->count(),
            'queued' => EmailLog::where('created_at', '>=', $startDate)->where('status', 'queued')->count(),
            'failed' => EmailLog::where('created_at', '>=', $startDate)->where('status', 'failed')->count(),
            'by_type' => EmailLog::where('created_at', '>=', $startDate)
                ->selectRaw('email_type, count(*) as count, 
                    sum(case when status = "sent" then 1 else 0 end) as sent_count,
                    sum(case when status = "failed" then 1 else 0 end) as failed_count')
                ->groupBy('email_type')
                ->get(),
            'avg_processing_time' => EmailLog::where('created_at', '>=', $startDate)
                ->where('status', 'sent')
                ->whereNotNull('sent_at')
                ->whereNotNull('queued_at')
                ->get()
                ->avg('processing_time'),
            'daily_stats' => EmailLog::where('created_at', '>=', $startDate)
                ->selectRaw('DATE(created_at) as date, 
                    count(*) as total,
                    sum(case when status = "sent" then 1 else 0 end) as sent,
                    sum(case when status = "failed" then 1 else 0 end) as failed')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->get()
        ];
    }

    /**
     * Get recent emails
     */
    public static function getRecentEmails($limit = 50, $filters = [])
    {
        $query = EmailLog::query();

        if (isset($filters['type'])) {
            $query->where('email_type', $filters['type']);
        }

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['email'])) {
            $query->where('to_email', 'like', '%' . $filters['email'] . '%');
        }

        if (isset($filters['date_from'])) {
            $query->where('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $query->where('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    /**
     * Initialize email tracking listeners
     */
    public static function initialize()
    {
        // Listen for sent emails
        Event::listen(MessageSent::class, function ($event) {
            // Try to get mailable from event data
            $mailable = $event->data['__laravel_mailable'] ?? null;

            if ($mailable && property_exists($mailable, 'emailLogId') && $mailable->emailLogId) {
                self::markAsSent($mailable->emailLogId, [
                    'message_id' => $event->sent->getDebug() ?? 'unknown'
                ]);
            }
        });
    }

    /**
     * Notify admins about email failures
     */
    private static function notifyAdminsOfFailure(EmailLog $emailLog, array $additionalInfo = [])
    {
        try {
            // Get failure priority
            $priority = self::getFailurePriority($emailLog);

            // Only notify for medium and high priority failures to avoid spam
            if (in_array($priority, ['medium', 'high'])) {
                $admins = Admin::all(); // Get all admins for now

                if ($admins->isNotEmpty()) {
                    Notification::send($admins, new EmailFailureAlert($emailLog, [
                        'priority' => $priority,
                        'additional_info' => $additionalInfo,
                        'failure_count_today' => EmailLog::where('status', 'failed')
                            ->whereDate('created_at', today())
                            ->count()
                    ]));

                    Log::info('Admin notification sent for email failure', [
                        'email_log_id' => $emailLog->id,
                        'priority' => $priority,
                        'admins_notified' => $admins->count()
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to notify admins of email failure', [
                'email_log_id' => $emailLog->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Determine failure priority based on email type and frequency
     */
    private static function getFailurePriority(EmailLog $emailLog): string
    {
        // Check how many failures for this email type today
        $todayFailures = EmailLog::where('email_type', $emailLog->email_type)
            ->where('status', 'failed')
            ->whereDate('created_at', today())
            ->count();

        // Check failures to same email
        $emailFailures = EmailLog::where('to_email', $emailLog->to_email)
            ->where('status', 'failed')
            ->where('created_at', '>=', now()->subHours(24))
            ->count();

        // Critical email types (like activation emails)
        $criticalTypes = ['seller_activation', 'password_reset', 'order_confirmation'];
        $isCritical = in_array($emailLog->email_type, $criticalTypes);

        if ($emailFailures >= 3 || $todayFailures >= 10 || ($isCritical && $todayFailures >= 5)) {
            return 'high';
        } elseif ($emailFailures >= 2 || $todayFailures >= 5 || ($isCritical && $todayFailures >= 2)) {
            return 'medium';
        }

        return 'low';
    }
}
