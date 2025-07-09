<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductAdditionalInformation extends Model
{
    use HasFactory;

    protected $table = 'product_additional_information';

    protected $fillable = [
        'product_id',
        'content',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}