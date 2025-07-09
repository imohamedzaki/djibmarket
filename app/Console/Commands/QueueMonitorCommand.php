<?php

namespace App\Console\Commands;

use App\Models\EmailLog;
use App\Models\Admin;
use App\Notifications\QueueStatusAlert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class QueueMonitorCommand extends Command
{
    protected $signature = 'queue:monitor {--alert-threshold=5 : Minutes threshold for stale jobs}';
    protected $description = 'Monitor queue status and alert admins if issues detected';

    public function handle()
    {
        $threshold = (int) $this->option('alert-threshold');
        $this->info("🔍 Monitoring queue status...");

        // التحقق من وجود Jobs معلقة لفترة طويلة
        $staleJobsCount = DB::table('jobs')
            ->where('queue', 'emails')
            ->where('created_at', '<', now()->subMinutes($threshold))
            ->count();

        // التحقق من إيميلات في انتظار المعالجة لفترة طويلة
        $staleEmailsCount = EmailLog::where('status', 'queued')
            ->where('created_at', '<', now()->subMinutes($threshold))
            ->count();

        // التحقق من معدل الفشل خلال الساعة الماضية
        $recentFailures = EmailLog::where('status', 'failed')
            ->where('created_at', '>=', now()->subHour())
            ->count();

        $totalRecent = EmailLog::where('created_at', '>=', now()->subHour())->count();
        $failureRate = $totalRecent > 0 ? ($recentFailures / $totalRecent) * 100 : 0;

        // تحديد حالة النظام
        $issues = [];
        $priority = 'low';

        if ($staleJobsCount > 0) {
            $issues[] = "{$staleJobsCount} jobs stuck in queue for >{$threshold} minutes";
            $priority = 'high';
        }

        if ($staleEmailsCount > 0) {
            $issues[] = "{$staleEmailsCount} emails waiting for >{$threshold} minutes";
            $priority = $priority === 'high' ? 'high' : 'medium';
        }

        if ($failureRate >= 20) {
            $issues[] = "High failure rate: {$failureRate}% in last hour";
            $priority = 'high';
        } elseif ($failureRate >= 10) {
            $issues[] = "Moderate failure rate: {$failureRate}% in last hour";
            $priority = $priority === 'high' ? 'high' : 'medium';
        }

        // إرسال تنبيه إذا كانت هناك مشاكل
        if (!empty($issues)) {
            $this->warn("❌ Issues detected:");
            foreach ($issues as $issue) {
                $this->line("  • {$issue}");
            }

            // إرسال تنبيه للأدمن
            $this->alertAdmins($issues, $priority, [
                'stale_jobs' => $staleJobsCount,
                'stale_emails' => $staleEmailsCount,
                'failure_rate' => $failureRate,
                'threshold_minutes' => $threshold
            ]);

            $this->warn("📧 Alert sent to admins");
        } else {
            $this->info("✅ Queue system operating normally");
        }

        // إظهار إحصائيات
        $this->displayStats();

        return empty($issues) ? 0 : 1;
    }

    private function alertAdmins(array $issues, string $priority, array $stats)
    {
        try {
            $admins = Admin::all();

            if ($admins->isNotEmpty()) {
                Notification::send($admins, new QueueStatusAlert($issues, $priority, $stats));
            }
        } catch (\Exception $e) {
            $this->error("Failed to send alert: " . $e->getMessage());
        }
    }

    private function displayStats()
    {
        $this->line("");
        $this->info("📊 Current Status:");

        $queuedJobs = DB::table('jobs')->where('queue', 'emails')->count();
        $queuedEmails = EmailLog::where('status', 'queued')->count();
        $processingEmails = EmailLog::where('status', 'queued')
            ->where('created_at', '>=', now()->subMinutes(5))
            ->count();

        $this->table(['Metric', 'Count'], [
            ['Jobs in Queue', $queuedJobs],
            ['Emails Queued', $queuedEmails],
            ['Recently Queued (5min)', $processingEmails],
        ]);

        // إحصائيات اليوم
        $todayStats = [
            'total' => EmailLog::whereDate('created_at', today())->count(),
            'sent' => EmailLog::where('status', 'sent')->whereDate('sent_at', today())->count(),
            'failed' => EmailLog::where('status', 'failed')->whereDate('created_at', today())->count(),
        ];

        $this->info("📅 Today's Summary:");
        $this->table(['Metric', 'Count'], [
            ['Total Emails', $todayStats['total']],
            ['Successfully Sent', $todayStats['sent']],
            ['Failed', $todayStats['failed']],
            ['Success Rate', $todayStats['total'] > 0 ? round(($todayStats['sent'] / $todayStats['total']) * 100, 1) . '%' : '0%'],
        ]);
    }
}
