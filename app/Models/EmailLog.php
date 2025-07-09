<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_email',
        'to_name',
        'subject',
        'email_type',
        'status',
        'queued_at',
        'sent_at',
        'failed_at',
        'error_message',
        'metadata'
    ];

    protected $casts = [
        'queued_at' => 'datetime',
        'sent_at' => 'datetime',
        'failed_at' => 'datetime',
        'metadata' => 'array'
    ];

    /**
     * Log when email is queued
     */
    public static function logQueued($to, $subject, $type, $metadata = [])
    {
        return self::create([
            'to_email' => is_array($to) ? $to['address'] : $to,
            'to_name' => is_array($to) ? $to['name'] ?? null : null,
            'subject' => $subject,
            'email_type' => $type,
            'status' => 'queued',
            'queued_at' => now(),
            'metadata' => $metadata
        ]);
    }

    /**
     * Mark email as sent
     */
    public function markAsSent()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
    }

    /**
     * Mark email as failed
     */
    public function markAsFailed($errorMessage = null)
    {
        $this->update([
            'status' => 'failed',
            'failed_at' => now(),
            'error_message' => $errorMessage
        ]);
    }

    /**
     * Get emails by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('email_type', $type);
    }

    /**
     * Get emails by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get emails sent today
     */
    public function scopeSentToday($query)
    {
        return $query->whereDate('sent_at', today());
    }

    /**
     * Get processing time (time between queued and sent)
     */
    public function getProcessingTimeAttribute()
    {
        if ($this->queued_at && $this->sent_at) {
            return $this->sent_at->diffInSeconds($this->queued_at);
        }
        return null;
    }

    /**
     * Get human readable processing time
     */
    public function getProcessingTimeHumanAttribute()
    {
        $seconds = $this->processing_time;
        if ($seconds === null) return null;

        if ($seconds < 60) {
            return $seconds . ' seconds';
        } elseif ($seconds < 3600) {
            return floor($seconds / 60) . ' minutes ' . ($seconds % 60) . ' seconds';
        } else {
            return floor($seconds / 3600) . ' hours ' . floor(($seconds % 3600) / 60) . ' minutes';
        }
    }
}
