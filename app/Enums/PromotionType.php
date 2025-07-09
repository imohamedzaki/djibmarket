<?php

namespace App\Enums;

enum PromotionType: string
{
    case PERCENTAGE_DISCOUNT = 'percentage_discount';
    case FIXED_AMOUNT_DISCOUNT = 'fixed_amount_discount';
    case BUY_X_GET_Y_FREE = 'buy_x_get_y_free';
    case FREE_SHIPPING = 'free_shipping';
    case BUNDLE_DEAL = 'bundle_deal';

    // You can add a helper method to get a user-friendly label if needed
    public function label(): string
    {
        return match ($this) {
            self::PERCENTAGE_DISCOUNT => 'Percentage Discount',
            self::FIXED_AMOUNT_DISCOUNT => 'Fixed Amount Discount',
            self::BUY_X_GET_Y_FREE => 'Buy X Get Y Free',
            self::FREE_SHIPPING => 'Free Shipping',
            self::BUNDLE_DEAL => 'Bundle Deal',
        };
    }
}
