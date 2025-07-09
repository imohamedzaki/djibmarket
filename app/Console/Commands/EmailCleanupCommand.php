<?php

namespace App\Console\Commands;

use App\Models\EmailLog;
use Illuminate\Console\Command;

class EmailCleanupCommand extends Command
{
    protected $signature = 'email:cleanup {days=90 : Number of days to keep}';
    protected $description = 'Clean up old email logs';

    public function handle()
    {
        $days = (int) $this->argument('days');
        $cutoffDate = now()->subDays($days);

        $this->info("🧹 Cleaning email logs older than {$days} days...");

        $deletedCount = EmailLog::where('created_at', '<', $cutoffDate)->delete();

        $this->info("✅ Deleted {$deletedCount} old email log records.");

        return 0;
    }
}
