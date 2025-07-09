<?php

namespace App\Models;

use App\Enums\CouponType;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $table = 'coupons';

    protected $fillable = [
        'seller_id',
        'code',
        'type',
        'amount',
        'min_purchase',
        'start_date',
        'end_date',
        'usage_limit',
        'usage_count',
        'is_active',
        'description',
        'applicability_type',
        'slug',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'type' => CouponType::class,
    ];

    // Relationship: Coupon belongs to a Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // Relationship: Coupon can be used in many Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship: Coupon has many Usages
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Relationship: Coupon can be applied to many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // New relationships
    public function applicableProducts()
    {
        return $this->belongsToMany(Product::class, 'coupon_product');
    }

    public function applicableCategories()
    {
        return $this->belongsToMany(Category::class, 'coupon_category');
    }

    // Check if coupon is valid
    public function isValid()
    {
        $now = now();

        // Check if coupon is active
        if (!$this->is_active) {
            return false;
        }

        // Check if coupon is within date range
        if ($now->lt($this->start_date) || $now->gt($this->end_date)) {
            return false;
        }

        // Check if usage limit is reached
        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    /**
     * Get formatted discount amount with symbol
     * 
     * @return string
     */
    public function getFormattedDiscount(): string
    {
        if ($this->type === CouponType::PERCENTAGE) {
            return $this->amount . '%';
        }

        return config('app.currency_symbol', '$') . $this->amount;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['seller.name', 'code']
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
