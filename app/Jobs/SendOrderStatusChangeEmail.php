<?php

namespace App\Jobs;

use App\Mail\OrderStatusChanged;
use App\Models\Order;
use App\Models\EmailLog;
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
    public $emailLogId;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order, string $oldStatus, string $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->onQueue('pendingChanges');

        // Log email as queued
        if ($this->order->user && $this->order->user->email) {
            $emailLog = EmailLog::logQueued(
                $this->order->user->email,
                'Order Status Update - Order #' . $this->order->order_number,
                'order_status_change',
                [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'customer_name' => $this->order->user->name,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                    'order_total' => $this->order->final_price
                ],
                $this->order->user->name
            );

            $this->emailLogId = $emailLog->id;
        }
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
                // Create mailable without logging (since we handle it in the job)
                $mailable = new OrderStatusChanged($this->order, $this->oldStatus, $this->newStatus);
                
                Mail::to($this->order->user->email)->send($mailable);
                
                // Mark email as sent in our tracking
                if ($this->emailLogId) {
                    $emailLog = EmailLog::find($this->emailLogId);
                    if ($emailLog) {
                        $emailLog->markAsSent();
                    }
                }
                
                Log::info('Order status change email sent', [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'user_email' => $this->order->user->email,
                    'old_status' => $this->oldStatus,
                    'new_status' => $this->newStatus,
                    'email_log_id' => $this->emailLogId
                ]);
            } else {
                // Mark email log as failed if no user/email
                if ($this->emailLogId) {
                    $emailLog = EmailLog::find($this->emailLogId);
                    if ($emailLog) {
                        $emailLog->markAsFailed('No user or email address available');
                    }
                }
                
                Log::warning('Order status change email not sent - no user or email', [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'has_user' => (bool) $this->order->user,
                    'user_email' => $this->order->user->email ?? null,
                    'email_log_id' => $this->emailLogId
                ]);
            }
        } catch (\Exception $e) {
            // Mark email as failed in our tracking
            if ($this->emailLogId) {
                $emailLog = EmailLog::find($this->emailLogId);
                if ($emailLog) {
                    $emailLog->markAsFailed($e->getMessage());
                }
            }
            
            Log::error('Failed to send order status change email', [
                'order_id' => $this->order->id,
                'order_number' => $this->order->order_number,
                'error' => $e->getMessage(),
                'old_status' => $this->oldStatus,
                'new_status' => $this->newStatus,
                'email_log_id' => $this->emailLogId
            ]);
            
            throw $e; // Re-throw to mark job as failed
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        // Mark email as failed in our tracking if not already marked
        if ($this->emailLogId) {
            $emailLog = EmailLog::find($this->emailLogId);
            if ($emailLog && $emailLog->status !== 'failed') {
                $emailLog->markAsFailed($exception->getMessage());
            }
        }
        
        Log::error('Order status change email job failed permanently', [
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'error' => $exception->getMessage(),
            'old_status' => $this->oldStatus,
            'new_status' => $this->newStatus,
            'email_log_id' => $this->emailLogId
        ]);
    }
}