<?php

namespace App\Jobs;

use App\Mail\OrderStatusChanged;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendOrderStatusChangeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order, string $oldStatus, string $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->onQueue('pendingChanges');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Load the user relationship if not already loaded
            $this->order->loadMissing('user');
            
            // Only send email if user exists and has an email
            if ($this->order->user && $this->order->user->email) {
                Mail::to($this->order->user->email)
                    ->send(new OrderStatusChanged($this->order, $this->oldStatus, $this->newStatus));
                
                Log::info('Order status change email sent', [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'user_email' => $this->order->user->email,
                    'old_status' => $this->oldStatus,
                    'new_status' => $this->newStatus
                ]);
            } else {
                Log::warning('Order status change email not sent - no user or email', [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'has_user' => (bool) $this->order->user,
                    'user_email' => $this->order->user->email ?? null
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send order status change email', [
                'order_id' => $this->order->id,
                'order_number' => $this->order->order_number,
                'error' => $e->getMessage(),
                'old_status' => $this->oldStatus,
                'new_status' => $this->newStatus
            ]);
            
            throw $e; // Re-throw to mark job as failed
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Order status change email job failed permanently', [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'error' => $exception->getMessage(),
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus
        ]);
    }
}