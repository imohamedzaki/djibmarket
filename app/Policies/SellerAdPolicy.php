<?php

namespace App\Policies;

use App\Models\SellerAd;
use App\Models\Seller;
use Illuminate\Auth\Access\Response;

class SellerAdPolicy
{
    /**
     * Determine whether the seller can view any models.
     */
    public function viewAny(Seller $seller): bool
    {
        return true;
    }

    /**
     * Determine whether the seller can view the model.
     */
    public function view(Seller $seller, SellerAd $sellerAd): bool
    {
        return $seller->id === $sellerAd->seller_id;
    }

    /**
     * Determine whether the seller can create models.
     */
    public function create(Seller $seller): Response
    {
        return $seller->status === 'active'
            ? Response::allow()
            : Response::deny('Your seller application must be approved before you can create advertisements. Please wait for admin approval.');
    }

    /**
     * Determine whether the seller can update the model.
     */
    public function update(Seller $seller, SellerAd $sellerAd): bool
    {
        return $seller->id === $sellerAd->seller_id;
    }

    /**
     * Determine whether the seller can delete the model.
     */
    public function delete(Seller $seller, SellerAd $sellerAd): bool
    {
        return $seller->id === $sellerAd->seller_id;
    }

    /**
     * Determine whether the seller can restore the model.
     */
    public function restore(Seller $seller, SellerAd $sellerAd): bool
    {
        return $seller->id === $sellerAd->seller_id;
    }

    /**
     * Determine whether the seller can permanently delete the model.
     */
    public function forceDelete(Seller $seller, SellerAd $sellerAd): bool
    {
        return $seller->id === $sellerAd->seller_id;
    }
}
