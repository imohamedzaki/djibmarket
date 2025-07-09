<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearSellerLoginThrottleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seller:clear-login-throttle {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear seller login throttle data. Provide email to clear specific user or leave empty to clear all.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            // Clear specific user's throttle data
            $this->clearUserThrottleData($email);
            $this->info("Cleared login throttle data for email: {$email}");
        } else {
            // Clear all seller login throttle data
            $this->clearAllThrottleData();
            $this->info("Cleared all seller login throttle data");
        }
    }

    /**
     * Clear throttle data for a specific user.
     */
    private function clearUserThrottleData(string $email): void
    {
        // Get all possible IP combinations for this email
        // This is a simplified approach - in production you might want to store IP addresses
        $baseKey = strtolower($email);

        // Clear cache entries that might exist
        $patterns = [
            'seller_login_attempts:' . $baseKey,
            'seller_login_lockout:' . $baseKey,
            'seller_login_lockout_count:' . $baseKey,
        ];

        foreach ($patterns as $pattern) {
            // Try to clear with different IP combinations
            for ($i = 0; $i < 256; $i++) {
                for ($j = 0; $j < 256; $j++) {
                    $key = $pattern . '|192.168.' . $i . '.' . $j;
                    Cache::forget($key);

                    $key = $pattern . '|127.0.0.' . $j;
                    Cache::forget($key);
                }
            }

            // Also try common localhost patterns
            $commonIPs = ['127.0.0.1', '::1', 'localhost'];
            foreach ($commonIPs as $ip) {
                Cache::forget($pattern . '|' . $ip);
            }
        }
    }

    /**
     * Clear all seller login throttle data.
     */
    private function clearAllThrottleData(): void
    {
        // This is a simplified approach. In production, you might want to use
        // cache tags or a more sophisticated cache clearing mechanism

        $prefixes = [
            'seller_login_attempts:',
            'seller_login_lockout:',
            'seller_login_lockout_count:',
        ];

        // If using Redis, you could use SCAN to find and delete keys
        // For now, we'll use a simple approach
        if (config('cache.default') === 'redis') {
            $redis = Cache::getRedis();
            foreach ($prefixes as $prefix) {
                $keys = $redis->keys($prefix . '*');
                if (!empty($keys)) {
                    $redis->del($keys);
                }
            }
        } else {
            // For other cache drivers, this is more complex
            // You might need to implement a custom solution
            $this->warn('Complete clearing only supported for Redis cache driver.');
            $this->warn('For other cache drivers, use specific email clearing or flush entire cache.');
        }
    }
}
