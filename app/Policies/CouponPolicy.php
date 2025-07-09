<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CouponPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the seller can view the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\Coupon $coupon
     * @return bool
     */
    public function view(Seller $seller, Coupon $coupon): bool
    {
        // Seller can view the coupon if they own it
        return $seller->id === $coupon->seller_id;
    }

    /**
     * Determine whether the seller can create coupons.
     * 
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(Seller $seller): Response
    {
        // Only active sellers can create coupons
        return $seller->status === 'active'
            ? Response::allow()
            : Response::deny('Your seller application must be approved before you can create coupons. Please wait for admin approval.');
    }

    /**
     * Determine whether the seller can update the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\Coupon $coupon
     * @return bool
     */
    public function update(Seller $seller, Coupon $coupon): bool
    {
        // Seller can update the coupon if they own it
        return $seller->id === $coupon->seller_id;
    }

    /**
     * Determine whether the seller can delete the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\Coupon $coupon
     * @return bool
     */
    public function delete(Seller $seller, Coupon $coupon): bool
    {
        // Seller can delete the coupon if they own it
        return $seller->id === $coupon->seller_id;
    }
}
