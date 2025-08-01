<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Models\OrderDelivery;
use App\Models\OrderPayment;
use App\Models\CouponUsage;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Use order_number as route key for admin routes
    public function getRouteKeyName()
    {
        return 'order_number';
    }

    // Generate slug based on order number
    public function getSlugAttribute()
    {
        return $this->order_number;
    }

    // Resolve route binding using order_number
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('order_number', $value)->first();
    }

    protected $fillable = [
        'order_number',
        'user_id',
        'shipping_address_id',
        'total_price',
        'discount_amount',
        'shipping_cost',
        'tax_amount',
        'final_price',
        'coupon_id',
        'status',
        'tracking_number',
        'shipping_method',
        'shipped_at',
        'delivered_at',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'shipping_address_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Alias for items() relationship for backward compatibility
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function delivery()
    {
        return $this->hasOne(OrderDelivery::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function couponUsages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Helper methods
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'canceled' => 'danger',
            default => 'secondary'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'canceled' => 'Canceled',
            default => ucfirst($this->status)
        };
    }

    public function generateOrderNumber()
    {
        return 'ORD-' . date('Y') . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function addStatusLog($status, $message = null, $estimatedDelivery = null)
    {
        return $this->statusLogs()->create([
            'status' => $status,
            'message' => $message,
            'estimated_delivery_time' => $estimatedDelivery,
        ]);
    }

    public function canBeCanceled()
    {
        return $this->status === 'pending';
    }

    public function cancel($reason = null)
    {
        if (!$this->canBeCanceled()) {
            return false;
        }

        $this->update(['status' => 'canceled']);
        $this->addStatusLog('canceled', $reason ?? 'Order canceled by customer');

        // Restore product stock
        foreach ($this->orderItems as $item) {
            if ($item->product) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        return true;
    }
}
