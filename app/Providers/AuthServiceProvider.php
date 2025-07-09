<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Promotion;
use App\Policies\PromotionPolicy;
use App\Models\Product;
use App\Policies\ProductPolicy;
use App\Models\Coupon;
use App\Policies\CouponPolicy;
use App\Models\FlashSale;
use App\Policies\FlashSalePolicy;
use App\Models\SellerAd;
use App\Policies\SellerAdPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Promotion::class => PromotionPolicy::class,
        Product::class => ProductPolicy::class,
        Coupon::class => CouponPolicy::class,
        FlashSale::class => FlashSalePolicy::class,
        SellerAd::class => SellerAdPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
