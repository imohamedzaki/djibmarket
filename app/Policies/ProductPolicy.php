<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * 
     * @param \App\Models\User|\App\Models\Seller $user
     * @param \App\Models\Product $product
     * @return bool
     */
    public function view($user, Product $product): bool
    {
        // User can view the product if they own it
        return $user->id === $product->seller_id;
    }

    /**
     * Determine whether the user can update the model.
     * 
     * @param \App\Models\User|\App\Models\Seller $user
     * @param \App\Models\Product $product
     * @return bool
     */
    public function update($user, Product $product): bool
    {
        // User can update the product if they own it
        return $user->id === $product->seller_id;
    }

    /**
     * Determine whether the user can delete the model.
     * 
     * @param \App\Models\User|\App\Models\Seller $user
     * @param \App\Models\Product $product
     * @return bool
     */
    public function delete($user, Product $product): bool
    {
        // User can delete the product if they own it
        return $user->id === $product->seller_id;
    }

    /**
     * Determine whether the seller can create products.
     * 
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(Seller $seller): Response
    {
        // Only active sellers can create products
        return $seller->status === 'active'
            ? Response::allow()
            : Response::deny('Your seller application must be approved before you can create products. Please wait for admin approval.');
    }
}