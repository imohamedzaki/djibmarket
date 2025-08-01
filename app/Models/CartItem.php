<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    /**
     * Get the user that owns the cart item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the cart item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the total price for this cart item.
     */
    public function getTotalPriceAttribute(): float
    {
        $price = $this->product->price_discounted > 0
            ? $this->product->price_discounted
            : $this->product->price_regular;

        return $price * $this->quantity;
    }

    /**
     * Get the unit price for this cart item.
     */
    public function getUnitPriceAttribute(): float
    {
        return $this->product->price_discounted > 0
            ? $this->product->price_discounted
            : $this->product->price_regular;
    }
}
