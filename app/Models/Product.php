<?php

namespace App\Models;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductSpecification;
use App\Models\ProductAdditionalInformation;
use App\Models\ProductReview;
use App\Models\FlashSale;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'seller_id',
        'category_id',
        'title',
        'sku',
        'description',
        'type',
        'price_regular',
        'price_discounted',
        'stock_quantity',
        'thumbnail',
        'featured_image_path',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_regular' => 'decimal:2',
        'price_discounted' => 'decimal:2',
        'stock_quantity' => 'integer',
        'status' => ProductStatus::class,
    ];

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

    // Relationships
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function additionalInformation(): HasMany
    {
        return $this->hasMany(ProductAdditionalInformation::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function flashSales(): HasMany
    {
        return $this->hasMany(FlashSale::class);
    }

    // New relationship
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product');
    }

    // Order items relationship for sales tracking
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper method to get total sold quantity
    public function getTotalSoldAttribute(): int
    {
        return $this->orderItems()
            ->whereHas('order', function ($query) {
                $query->whereIn('status', ['completed', 'delivered']);
            })
            ->sum('quantity');
    }

    // Accessor for Featured Image URL
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->thumbnail) {
            /** @var \\Illuminate\\Contracts\\Filesystem\\Filesystem $disk */
            $disk = Storage::disk('public');
            return $disk->url($this->thumbnail);
        }
        return null;
    }

    /**
     * Get the primary image URL for the product
     * Priority: thumbnail -> first product image -> featured_image_path
     */
    public function getPrimaryImageUrlAttribute(): string
    {
        // Try thumbnail first
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        // Try first product image
        if ($this->images && $this->images->count() > 0) {
            return asset('storage/' . $this->images->first()->image_path);
        }

        // Try featured image path
        if ($this->featured_image_path) {
            return asset('storage/' . $this->featured_image_path);
        }

        // Return empty string if no image is available
        // This will allow the frontend to handle the display appropriately
        return '';
    }

    /**
     * The promotions that this product belongs to.
     */
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product');
    }
}
