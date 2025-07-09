<?php

namespace App\Console\Commands;

use App\Models\EmailLog;
use App\Models\Admin;
use App\Notifications\EmailDailyReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class EmailReportsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reports 
                          {period=daily : Report period (daily, weekly, monthly)}
                          {--send-notification : Send notification to admins}
                          {--export-csv : Export data as CSV}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate email delivery reports and optionally send to admins';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $period = $this->argument('period');
        $sendNotification = $this->option('send-notification');
        $exportCsv = $this->option('export-csv');

        $this->info("📊 Generating {$period} email report...");

        // Generate report data
        $reportData = $this->generateReportData($period);

        // Display report
        $this->displayReport($reportData, $period);

        // Export CSV if requested
        if ($exportCsv) {
            $this->exportToCsv($reportData, $period);
        }

        // Send notification to admins if requested
        if ($sendNotification) {
            $this->sendReportNotification($reportData, $period);
        }

        $this->info("✅ Email report generation completed!");
    }

    /**
     * Generate report data based on period
     */
    private function generateReportData(string $period): array
    {
        [$startDate, $endDate] = $this->getDateRange($period);

        $baseQuery = EmailLog::whereBetween('created_at', [$startDate, $endDate]);

        // Basic statistics
        $stats = [
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_emails' => $baseQuery->count(),
            'sent_emails' => (clone $baseQuery)->where('status', 'sent')->count(),
            'failed_emails' => (clone $baseQuery)->where('status', 'failed')->count(),
            'queued_emails' => (clone $baseQuery)->where('status', 'queued')->count(),
        ];

        // Calculate rates
        $stats['success_rate'] = $stats['total_emails'] > 0
            ? round(($stats['sent_emails'] / $stats['total_emails']) * 100, 2)
            : 0;
        $stats['failure_rate'] = $stats['total_emails'] > 0
            ? round(($stats['failed_emails'] / $stats['total_emails']) * 100, 2)
            : 0;

        // Email types breakdown
        $stats['by_type'] = (clone $baseQuery)
            ->selectRaw('email_type, 
                count(*) as total,
                sum(case when status = "sent" then 1 else 0 end) as sent,
                sum(case when status = "failed" then 1 else 0 end) as failed,
                sum(case when status = "queued" then 1 else 0 end) as queued')
            ->groupBy('email_type')
            ->get()
            ->map(function ($item) {
                $item->success_rate = $item->total > 0
                    ? round(($item->sent / $item->total) * 100, 2)
                    : 0;
                return $item;
            });

        // Daily breakdown for weekly/monthly reports
        if (in_array($period, ['weekly', 'monthly'])) {
            $stats['daily_breakdown'] = (clone $baseQuery)
                ->selectRaw('DATE(created_at) as date,
                    count(*) as total,
                    sum(case when status = "sent" then 1 else 0 end) as sent,
                    sum(case when status = "failed" then 1 else 0 end) as failed')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        }

        // Top failure reasons
        $stats['top_failures'] = EmailLog::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'failed')
            ->whereNotNull('error_message')
            ->selectRaw('error_message, count(*) as count')
            ->groupBy('error_message')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        // Performance metrics
        $sentEmails = (clone $baseQuery)->where('status', 'sent')
            ->whereNotNull('sent_at')
            ->whereNotNull('queued_at')
            ->get();

        if ($sentEmails->isNotEmpty()) {
            $processingTimes = $sentEmails->pluck('processing_time')->filter();
            $stats['avg_processing_time'] = round($processingTimes->avg(), 2);
            $stats['min_processing_time'] = $processingTimes->min();
            $stats['max_processing_time'] = $processingTimes->max();
        } else {
            $stats['avg_processing_time'] = 0;
            $stats['min_processing_time'] = 0;
            $stats['max_processing_time'] = 0;
        }

        // Peak hours analysis
        $stats['peak_hours'] = (clone $baseQuery)
            ->selectRaw('HOUR(created_at) as hour, count(*) as count')
            ->groupBy('hour')
            ->orderBy('count', 'desc')
            ->limit(3)
            ->get();

        return $stats;
    }

    /**
     * Get date range for period
     */
    private function getDateRange(string $period): array
    {
        switch ($period) {
            case 'daily':
                return [today()->startOfDay(), today()->endOfDay()];
            case 'weekly':
                return [now()->startOfWeek(), now()->endOfWeek()];
            case 'monthly':
                return [now()->startOfMonth(), now()->endOfMonth()];
            default:
                return [today()->startOfDay(), today()->endOfDay()];
        }
    }

    /**
     * Display report in console
     */
    private function displayReport(array $data, string $period): void
    {
        $this->newLine();
        $this->info("📈 Email Delivery Report - " . ucfirst($period));
        $this->line("Period: {$data['start_date']->format('M d, Y')} to {$data['end_date']->format('M d, Y')}");
        $this->newLine();

        // Summary table
        $this->table(['Metric', 'Value'], [
            ['Total Emails', number_format($data['total_emails'])],
            ['✅ Sent', number_format($data['sent_emails']) . " ({$data['success_rate']}%)"],
            ['❌ Failed', number_format($data['failed_emails']) . " ({$data['failure_rate']}%)"],
            ['⏳ Queued', number_format($data['queued_emails'])],
            ['Average Processing Time', $data['avg_processing_time'] . ' seconds'],
        ]);

        // Email types breakdown
        if ($data['by_type']->isNotEmpty()) {
            $this->newLine();
            $this->info("📧 By Email Type:");
            $this->table(
                ['Type', 'Total', 'Sent', 'Failed', 'Success Rate'],
                $data['by_type']->map(function ($item) {
                    return [
                        ucwords(str_replace('_', ' ', $item->email_type)),
                        $item->total,
                        $item->sent,
                        $item->failed,
                        $item->success_rate . '%'
                    ];
                })->toArray()
            );
        }

        // Top failures
        if ($data['top_failures']->isNotEmpty()) {
            $this->newLine();
            $this->error("🚨 Top Failure Reasons:");
            $this->table(
                ['Error Message', 'Count'],
                $data['top_failures']->map(function ($item) {
                    return [
                        \Str::limit($item->error_message, 80),
                        $item->count
                    ];
                })->toArray()
            );
        }

        // Peak hours
        if ($data['peak_hours']->isNotEmpty()) {
            $this->newLine();
            $this->info("⏰ Peak Hours:");
            foreach ($data['peak_hours'] as $hour) {
                $this->line("  {$hour->hour}:00 - {$hour->count} emails");
            }
        }
    }

    /**
     * Export report to CSV
     */
    private function exportToCsv(array $data, string $period): void
    {
        $filename = "email_report_{$period}_" . now()->format('Y-m-d_H-i-s') . '.csv';
        $filepath = storage_path("app/reports/{$filename}");

        // Ensure directory exists
        if (!file_exists(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }

        $file = fopen($filepath, 'w');

        // Write summary
        fputcsv($file, ['Email Delivery Report - ' . ucfirst($period)]);
        fputcsv($file, ['Period', $data['start_date']->format('M d, Y') . ' to ' . $data['end_date']->format('M d, Y')]);
        fputcsv($file, []); // Empty row

        fputcsv($file, ['Summary']);
        fputcsv($file, ['Metric', 'Value']);
        fputcsv($file, ['Total Emails', $data['total_emails']]);
        fputcsv($file, ['Sent Emails', $data['sent_emails']]);
        fputcsv($file, ['Failed Emails', $data['failed_emails']]);
        fputcsv($file, ['Success Rate', $data['success_rate'] . '%']);
        fputcsv($file, ['Average Processing Time', $data['avg_processing_time'] . ' seconds']);

        // Write email types
        if ($data['by_type']->isNotEmpty()) {
            fputcsv($file, []); // Empty row
            fputcsv($file, ['By Email Type']);
            fputcsv($file, ['Type', 'Total', 'Sent', 'Failed', 'Success Rate']);
            foreach ($data['by_type'] as $item) {
                fputcsv($file, [
                    ucwords(str_replace('_', ' ', $item->email_type)),
                    $item->total,
                    $item->sent,
                    $item->failed,
                    $item->success_rate . '%'
                ]);
            }
        }

        fclose($file);

        $this->info("📄 Report exported to: {$filepath}");
    }

    /**
     * Send report notification to admins
     */
    private function sendReportNotification(array $data, string $period): void
    {
        try {
            $admins = Admin::all();

            if ($admins->isNotEmpty()) {
                // Create a simple notification for the report
                Notification::send($admins, new \App\Notifications\EmailDailyReport($data, $period));
                $this->info("📧 Report notification sent to {$admins->count()} admin(s)");
            } else {
                $this->warn("⚠️  No admins found to send notification");
            }
        } catch (\Exception $e) {
            $this->error("❌ Failed to send notification: " . $e->getMessage());
        }
    }
}
