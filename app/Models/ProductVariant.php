<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariantOption;
use App\Models\VariantImage;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'product_id',
        'title',
        'slug',
        'sku',
        'price_regular',
        'price_discounted',
        'stock_quantity',
    ];

    protected $casts = [
        'price_regular' => 'decimal:2',
        'price_discounted' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->hasMany(ProductVariantOption::class, 'variant_id');
    }

    public function images()
    {
        return $this->hasMany(VariantImage::class, 'variant_id');
    }
}