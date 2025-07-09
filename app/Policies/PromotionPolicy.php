<?php

namespace App\Policies;

use App\Models\Promotion;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PromotionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the seller can view any promotions.
     */
    public function viewAny(Seller $seller): bool
    {
        return true;
    }

    /**
     * Determine whether the seller can view the promotion.
     */
    public function view(Seller $seller, Promotion $promotion): bool
    {
        return $seller->id === $promotion->seller_id;
    }

    /**
     * Determine whether the seller can create promotions.
     */
    public function create(Seller $seller): Response
    {
        // Only active sellers can create promotions
        return $seller->status === 'active'
            ? Response::allow()
            : Response::deny('Your seller application must be approved before you can create promotions. Please wait for admin approval.');
    }

    /**
     * Determine whether the seller can update the promotion.
     */
    public function update(Seller $seller, Promotion $promotion): bool
    {
        return $seller->id === $promotion->seller_id;
    }

    /**
     * Determine whether the seller can delete the promotion.
     */
    public function delete(Seller $seller, Promotion $promotion): bool
    {
        return $seller->id === $promotion->seller_id;
    }
}
