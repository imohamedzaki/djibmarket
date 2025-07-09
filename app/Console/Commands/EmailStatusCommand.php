<?php

namespace App\Console\Commands;

use App\Models\EmailLog;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmailStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:status 
                           {--type= : Filter by email type (seller_activation, password_reset, etc.)}
                           {--status= : Filter by status (queued, sent, failed)}
                           {--today : Show only today\'s emails}
                           {--stats : Show statistics only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show email sending status and statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = EmailLog::query();

        // Apply filters
        if ($this->option('type')) {
            $query->byType($this->option('type'));
        }

        if ($this->option('status')) {
            $query->byStatus($this->option('status'));
        }

        if ($this->option('today')) {
            $query->whereDate('created_at', today());
        }

        if ($this->option('stats')) {
            $this->showStatistics($query);
            return;
        }

        // Show recent emails
        $emails = $query->orderBy('created_at', 'desc')->limit(20)->get();

        if ($emails->isEmpty()) {
            $this->info('No emails found matching the criteria.');
            return;
        }

        $this->table([
            'ID',
            'To Email',
            'Subject',
            'Type',
            'Status',
            'Queued At',
            'Sent At',
            'Processing Time',
            'Error'
        ], $emails->map(function ($email) {
            return [
                $email->id,
                $email->to_email,
                Str::limit($email->subject, 30),
                $email->email_type,
                $this->getStatusWithColor($email->status),
                $email->queued_at->format('Y-m-d H:i:s'),
                $email->sent_at ? $email->sent_at->format('Y-m-d H:i:s') : '-',
                $email->processing_time_human ?? '-',
                $email->error_message ? Str::limit($email->error_message, 50) : '-'
            ];
        }));

        $this->showStatistics($query);
    }

    private function showStatistics($query)
    {
        $this->newLine();
        $this->info('📊 Email Statistics:');

        $baseQuery = clone $query;

        $total = $baseQuery->count();
        $queued = (clone $query)->byStatus('queued')->count();
        $sent = (clone $query)->byStatus('sent')->count();
        $failed = (clone $query)->byStatus('failed')->count();

        $this->table(['Status', 'Count', 'Percentage'], [
            ['Total', $total, '100%'],
            ['✅ Sent', $sent, $total > 0 ? round(($sent / $total) * 100, 1) . '%' : '0%'],
            ['⏳ Queued', $queued, $total > 0 ? round(($queued / $total) * 100, 1) . '%' : '0%'],
            ['❌ Failed', $failed, $total > 0 ? round(($failed / $total) * 100, 1) . '%' : '0%'],
        ]);

        // Average processing time for sent emails
        $avgProcessingTime = (clone $query)->byStatus('sent')
            ->whereNotNull('sent_at')
            ->whereNotNull('queued_at')
            ->get()
            ->avg('processing_time');

        if ($avgProcessingTime) {
            $avgSeconds = round($avgProcessingTime);
            $avgMinutes = floor($avgSeconds / 60);
            $avgSecondsRemainder = $avgSeconds % 60;

            $this->info("⚡ Average Processing Time: {$avgMinutes}m {$avgSecondsRemainder}s");
        }

        // Today's statistics
        $todayTotal = EmailLog::whereDate('created_at', today())->count();
        $todaySent = EmailLog::whereDate('sent_at', today())->count();

        $this->newLine();
        $this->info("📅 Today's Activity: {$todaySent}/{$todayTotal} emails sent");

        // Email types breakdown
        $typeStats = EmailLog::selectRaw('email_type, count(*) as count')
            ->groupBy('email_type')
            ->get();

        if ($typeStats->isNotEmpty()) {
            $this->newLine();
            $this->info('📧 By Email Type:');
            $this->table(['Type', 'Count'], $typeStats->map(function ($stat) {
                return [$stat->email_type, $stat->count];
            }));
        }
    }

    private function getStatusWithColor($status)
    {
        return match ($status) {
            'sent' => '<fg=green>✅ Sent</>',
            'queued' => '<fg=yellow>⏳ Queued</>',
            'failed' => '<fg=red>❌ Failed</>',
            default => $status
        };
    }
}
