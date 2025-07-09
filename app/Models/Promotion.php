<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PromotionType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'campaign_id',
        'seller_id',
        'admin_id',
        'ref',
        'title',
        'description',
        'start_at',
        'end_at',
        'is_active',
        'banner_image',
        'promotion_type',
        'discount_value',
        'min_purchase_amount',
        'required_quantity',
        'free_quantity',
        'free_product_id',
        'usage_limit',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'is_active' => 'boolean',
        'promotion_type' => PromotionType::class,
        'discount_value' => 'decimal:2',
        'min_purchase_amount' => 'decimal:2',
        'required_quantity' => 'integer',
        'free_quantity' => 'integer',
        'usage_limit' => 'integer',
    ];

    /**
     * Get the campaign that this promotion belongs to.
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the seller that this promotion belongs to (if any).
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Get the admin that created this promotion (if any).
     */
    public function admin(): BelongsTo
    {
        // Assuming your Admin model is named Admin and is in App\Models namespace
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the product that is offered for free (if applicable).
     */
    public function freeProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'free_product_id');
    }

    /**
     * The products that are part of this promotion.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_product');
    }

    /**
     * The sellers that are associated with the promotion.
     */
    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'promotion_seller');
    }

    // Add relationships if needed, e.g., products included in the promotion
    // public function products()
    // {
    //    return $this->belongsToMany(Product::class, 'promotion_product');
    // }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($promotion) {
            $promotion->ref = 'PROM-' . str_pad($promotion->id, 3, '0', STR_PAD_LEFT);
            $promotion->save();
        });
    }
}
