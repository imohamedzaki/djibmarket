<?php

namespace App\Policies;

use App\Models\FlashSale;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FlashSalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the seller can view the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\FlashSale $flashSale
     * @return bool
     */
    public function view(Seller $seller, FlashSale $flashSale): bool
    {
        // Seller can view the flash sale if they own it
        return $seller->id === $flashSale->seller_id;
    }

    /**
     * Determine whether the seller can create flash sales.
     * 
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(Seller $seller): Response
    {
        // Only active sellers can create flash sales
        return $seller->status === 'active'
            ? Response::allow()
            : Response::deny('Your seller application must be approved before you can create flash sales. Please wait for admin approval.');
    }

    /**
     * Determine whether the seller can update the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\FlashSale $flashSale
     * @return bool
     */
    public function update(Seller $seller, FlashSale $flashSale): bool
    {
        // Seller can update the flash sale if they own it
        return $seller->id === $flashSale->seller_id;
    }

    /**
     * Determine whether the seller can delete the model.
     * 
     * @param \App\Models\Seller $seller
     * @param \App\Models\FlashSale $flashSale
     * @return bool
     */
    public function delete(Seller $seller, FlashSale $flashSale): bool
    {
        // Seller can delete the flash sale if they own it
        return $seller->id === $flashSale->seller_id;
    }
}
