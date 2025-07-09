<?php

namespace App\Enums;

enum CouponType: string
{
    case PERCENTAGE = 'percentage';
    case FIXED = 'fixed';
    
    /**
     * Get all available coupon types as an array
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
    
    /**
     * Get all available coupon types as associative array for select inputs
     *
     * @return array
     */
    public static function toSelectArray(): array
    {
        $types = [];
        foreach (self::cases() as $case) {
            $types[$case->value] = ucfirst($case->value);
        }
        return $types;
    }
    
    /**
     * Get the label for a coupon type
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::PERCENTAGE => 'Percentage',
            self::FIXED => 'Fixed Amount',
        };
    }
}