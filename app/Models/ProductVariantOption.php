<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;

class ProductVariantOption extends Model
{
    use HasFactory;

    protected $table = 'product_variant_options';

    protected $fillable = [
        'variant_id',
        'option_type',
        'option_value',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}