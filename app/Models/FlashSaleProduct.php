<?php

namespace App\Models;

use App\Models\Product;
use App\Models\FlashSale;
use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{

    protected $table = 'flash_sale_products';
    protected $fillable = [
        'flash_sale_id',
        'product_id',
    ];

    public function flashSale()
    {
        return $this->belongsTo(FlashSale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
