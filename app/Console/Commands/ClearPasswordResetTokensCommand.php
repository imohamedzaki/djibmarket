<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearPasswordResetTokensCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seller:clear-password-reset-tokens {--email= : Clear tokens for specific email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear expired seller password reset tokens or tokens for a specific email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');

        if ($email) {
            // Clear tokens for specific email
            $deleted = DB::table('seller_password_reset_tokens')
                ->where('email', $email)
                ->delete();

            if ($deleted > 0) {
                $this->info("Cleared password reset tokens for email: {$email}");
            } else {
                $this->warn("No password reset tokens found for email: {$email}");
            }
        } else {
            // Clear all expired tokens (older than 15 minutes)
            $deleted = DB::table('seller_password_reset_tokens')
                ->where('created_at', '<', now()->subMinutes(15))
                ->delete();

            if ($deleted > 0) {
                $this->info("Cleared {$deleted} expired password reset tokens");
            } else {
                $this->info("No expired password reset tokens found");
            }
        }

        return 0;
    }
}
