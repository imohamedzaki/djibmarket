<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;

class VariantImage extends Model
{
    use HasFactory;

    protected $table = 'variant_images';

    protected $fillable = [
        'variant_id',
        'image_path',
        'sort_order',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}