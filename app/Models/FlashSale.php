<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;


class FlashSale extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'start_at',
        'end_at',
        'discount_type',
        'discount_value',
        'usage_limit_per_user',
        'status',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'discount_value' => 'decimal:2',
        'status' => 'integer',
    ];

    // Flash sale status constants
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ENDED = 2;

    // Discount type constants
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';
    const DISCOUNT_TYPE_FIXED = 'fixed';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key for the model.
     *
     * Use slug for route model binding instead of ID.
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Many-to-many relationship with products via pivot table
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'flash_sale_products', 'flash_sale_id', 'product_id')
            ->withTimestamps();
    }

    /**
     * العلاقة مع منتجات الفلاش سيل (الجدول المحوري)
     */
    public function flashSaleProducts()
    {
        return $this->hasMany(FlashSaleProduct::class);
    }

    /**
     * Scope لجلب الفلاش سيل النشط فقط
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->where('start_at', '<=', now())
            ->where('end_at', '>=', now());
    }

    /**
     * إنشاء slug تلقائيًا عند إنشاء الفلاش سيل
     */
    protected static function booted()
    {
        static::creating(function ($flashSale) {
            if (empty($flashSale->slug) && !empty($flashSale->title)) {
                $flashSale->slug = Str::slug($flashSale->title) . '-' . Str::random(5);
            }
        });
    }

    /**
     * هل الفلاش سيل نشط حاليًا؟
     */
    public function isCurrentlyActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE
            && $this->start_at <= now()
            && $this->end_at >= now();
    }

    /**
     * Calculate discounted price for a product
     */
    public function getDiscountedPrice($product)
    {
        $regularPrice = $product->price_regular;

        if ($this->discount_type === self::DISCOUNT_TYPE_PERCENTAGE) {
            return $regularPrice * (1 - ($this->discount_value / 100));
        } else {
            return max(0, $regularPrice - $this->discount_value);
        }
    }

    /**
     * Get discount amount for a product
     */
    public function getDiscountAmount($product)
    {
        return $product->price_regular - $this->getDiscountedPrice($product);
    }

    /**
     * Get products with their calculated discount prices
     */
    public function getProductsWithDiscounts()
    {
        return $this->products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'regular_price' => $product->price_regular,
                'discounted_price' => $this->getDiscountedPrice($product),
                'discount_amount' => $this->getDiscountAmount($product),
                'stock_quantity' => $product->stock_quantity,
                'thumbnail' => $product->thumbnail,
                'featured_image_url' => $product->featured_image_url,
            ];
        });
    }

    /**
     * Get total available stock from all products
     */
    public function getTotalStock()
    {
        return $this->products->sum('stock_quantity');
    }

    /**
     * Check if a product is included in this flash sale
     */
    public function hasProduct($productId)
    {
        return $this->products->contains('id', $productId);
    }

    /**
     * Get the status label
     */
    public function getStatusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ENDED => 'Ended',
            default => 'Unknown'
        };
    }

    /**
     * Get the status color class for UI
     */
    public function getStatusColor(): string
    {
        return match ($this->status) {
            self::STATUS_INACTIVE => 'warning',
            self::STATUS_ACTIVE => 'success',
            self::STATUS_ENDED => 'secondary',
            default => 'secondary'
        };
    }

    /**
     * Get all status options
     */
    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ENDED => 'Ended'
        ];
    }

    /**
     * Get all discount type options
     */
    public static function getDiscountTypeOptions(): array
    {
        return [
            self::DISCOUNT_TYPE_PERCENTAGE => 'Percentage (%)',
            self::DISCOUNT_TYPE_FIXED => 'Fixed Amount ($)'
        ];
    }

    /**
     * Get discount type label
     */
    public function getDiscountTypeLabel(): string
    {
        return match ($this->discount_type) {
            self::DISCOUNT_TYPE_PERCENTAGE => 'Percentage',
            self::DISCOUNT_TYPE_FIXED => 'Fixed Amount',
            default => 'Unknown'
        };
    }

    /**
     * Scope to get flash sales by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get upcoming flash sales
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_at', '>', now());
    }

    /**
     * Scope to get ended flash sales
     */
    public function scopeEnded($query)
    {
        return $query->where('end_at', '<', now());
    }
}
