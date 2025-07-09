<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'order_item_id',
        'return_number',
        'reason',
        'description',
        'images',
        'status',
        'refund_amount',
        'admin_notes',
        'requested_at',
        'processed_at',
    ];

    protected $casts = [
        'images' => 'array',
        'refund_amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'approved' => 'info',
            'rejected' => 'danger',
            'processing' => 'primary',
            'completed' => 'success',
            default => 'secondary'
        };
    }

    public function getReasonTextAttribute(): string
    {
        return match ($this->reason) {
            'defective' => 'Defective Product',
            'wrong_item' => 'Wrong Item Received',
            'not_as_described' => 'Not as Described',
            'damaged' => 'Damaged in Shipping',
            'other' => 'Other',
            default => 'Unknown'
        };
    }
}
