<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderStatusLog extends Model
{
    use HasFactory;

    protected $table = 'order_status_logs';

    protected $fillable = [
        'order_id',
        'status',
        'message',
        'estimated_delivery_time',
        // 'created_at' is usually handled automatically
    ];

    // Define relationship to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}