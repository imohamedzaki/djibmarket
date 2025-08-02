<?php

// Keep necessary imports for application routes
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerProfileController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerCouponController;
use App\Http\Controllers\Seller\SellerCategoryController;
use App\Http\Controllers\Seller\SellerCampaignController;
use App\Http\Controllers\Seller\SellerPromotionController;
use App\Http\Controllers\Seller\SellerFlashSaleController;
use App\Http\Controllers\Seller\SellerAdController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\ComingSoonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::prefix('seller')->name('seller.')->group(function () {
    // Base seller route check - redirect appropriately based on auth status
    Route::get('/', function () {
        if (Auth::guard('seller')->check()) {
            return redirect()->route('seller.dashboard');
        }
        return redirect()->route('seller.login');
    });

    // Include the authentication routes
    require __DIR__ . '/seller/auth.php';

    // Authenticated seller routes (application routes)
    Route::middleware('auth:seller')->group(function () {
        // Dashboard route
        Route::get('dashboard', [SellerDashboardController::class, 'index'])
            ->name('dashboard'); // This is accessible as 'seller.dashboard' due to the prefix

        // Profile route
        Route::get('profile', [SellerProfileController::class, 'index'])
            ->name('profile');

        // Profile edit route
        Route::get('profile/edit', [SellerProfileController::class, 'edit'])
            ->name('profile.edit');

        // Profile update route
        Route::put('profile', [SellerProfileController::class, 'update'])
            ->name('profile.update');

        // Document routes
        Route::get('documents/{document}/view', [SellerProfileController::class, 'viewDocument'])
            ->name('documents.view');

        Route::get('documents/{document}/download', [SellerProfileController::class, 'downloadDocument'])
            ->name('documents.download');

        // Products route
        Route::get('products', [SellerProductController::class, 'index'])
            ->name('products.index');

        // Add routes for store, show, update, destroy if they don't exist yet
        // It's recommended to use Route::resource for standard CRUD operations
        Route::post('products', [SellerProductController::class, 'store'])
            ->name('products.store');

        Route::get('products/{product}', [SellerProductController::class, 'show'])
            ->name('products.show'); // Assuming slug is used as the route key

        // Edit route for product data
        Route::get('products/{product}/edit', [SellerProductController::class, 'edit'])
            ->name('products.edit');

        // Note: PUT/PATCH is typically used for updates
        Route::put('products/{product}', [SellerProductController::class, 'update'])
            ->name('products.update');

        Route::delete('products/{product}', [SellerProductController::class, 'destroy'])
            ->name('products.destroy');

        // Gallery Image Delete Route
        Route::delete('gallery-images/{image}', [SellerProductController::class, 'deleteGalleryImage'])
            ->name('gallery-images.destroy');

        // Category Routes (read-only)
        Route::get('categories', [SellerCategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('categories/{slug}/products', [SellerCategoryController::class, 'products'])
            ->name('categories.products');

        // Coupon Routes
        Route::get('coupons', [SellerCouponController::class, 'index'])
            ->name('coupons.index');

        Route::get('coupons/create', [SellerCouponController::class, 'create'])
            ->name('coupons.create');

        Route::post('coupons', [SellerCouponController::class, 'store'])
            ->name('coupons.store');

        Route::get('coupons/{coupon}', [SellerCouponController::class, 'show'])
            ->name('coupons.show');

        Route::get('coupons/{coupon}/edit', [SellerCouponController::class, 'edit'])
            ->name('coupons.edit');

        Route::put('coupons/{coupon}', [SellerCouponController::class, 'update'])
            ->name('coupons.update');

        Route::delete('coupons/{coupon}', [SellerCouponController::class, 'destroy'])
            ->name('coupons.destroy');

        // Campaign Routes (read-only for campaigns)
        Route::get('campaigns', [SellerCampaignController::class, 'index'])
            ->name('campaigns.index');

        Route::get('campaigns/{campaign}', [SellerCampaignController::class, 'show'])
            ->name('campaigns.show');

        // Campaign Participation Routes (old routes kept for compatibility)
        Route::get('campaigns/{campaign}/promotions/create', [SellerCampaignController::class, 'createPromotion'])
            ->name('campaigns.promotions.create');

        Route::post('campaigns/{campaign}/promotions', [SellerCampaignController::class, 'storePromotion'])
            ->name('campaigns.promotions.store');

        // Promotions Routes
        Route::get('promotions', [SellerPromotionController::class, 'index'])
            ->name('promotions.index');

        Route::get('promotions/create', [SellerPromotionController::class, 'create'])
            ->name('promotions.create');

        Route::post('promotions', [SellerPromotionController::class, 'store'])
            ->name('promotions.store');

        Route::get('promotions/{promotion}/details', [SellerPromotionController::class, 'show'])
            ->name('promotions.show');

        Route::get('promotions/{promotion}/edit-details', [SellerPromotionController::class, 'edit'])
            ->name('promotions.edit');

        Route::put('promotions/{promotion}/update', [SellerPromotionController::class, 'update'])
            ->name('promotions.update');

        Route::delete('promotions/{promotion}', [SellerPromotionController::class, 'destroy'])
            ->name('promotions.destroy');

        Route::get('promotions/{promotion}', [SellerCampaignController::class, 'showPromotion'])
            ->name('campaigns.promotions.show');

        Route::get('promotions/{promotion}/edit', [SellerCampaignController::class, 'editPromotion'])
            ->name('campaigns.promotions.edit');

        Route::put('promotions/{promotion}', [SellerCampaignController::class, 'updatePromotion'])
            ->name('campaigns.promotions.update');

        // Flash Sales Routes
        Route::get('flash-sales', [SellerFlashSaleController::class, 'index'])
            ->name('flash-sales.index');

        Route::get('flash-sales/create', [SellerFlashSaleController::class, 'create'])
            ->name('flash-sales.create');

        Route::post('flash-sales', [SellerFlashSaleController::class, 'store'])
            ->name('flash-sales.store');

        Route::get('flash-sales/{flashSale}', [SellerFlashSaleController::class, 'show'])
            ->name('flash-sales.show');

        Route::get('flash-sales/{flashSale}/edit', [SellerFlashSaleController::class, 'edit'])
            ->name('flash-sales.edit');

        Route::put('flash-sales/{flashSale}', [SellerFlashSaleController::class, 'update'])
            ->name('flash-sales.update');

        Route::delete('flash-sales/{flashSale}', [SellerFlashSaleController::class, 'destroy'])
            ->name('flash-sales.destroy');

        // Advertisement Routes
        Route::resource('ads', SellerAdController::class);
        Route::post('ads/{ad}/pause', [SellerAdController::class, 'pause'])
            ->name('ads.pause');
        Route::post('ads/{ad}/resume', [SellerAdController::class, 'resume'])
            ->name('ads.resume');
        Route::get('ads-analytics', [SellerAdController::class, 'analytics'])
            ->name('ads.analytics');

        // Order Management Routes
        Route::get('orders', [SellerOrderController::class, 'index'])
            ->name('orders.index');
        Route::get('orders/{order}', [SellerOrderController::class, 'show'])
            ->name('orders.show');
        Route::patch('orders/{order}/status', [SellerOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        // Coming Soon page for placeholder links
        Route::get('coming-soon', [ComingSoonController::class, 'index'])
            ->name('coming-soon');

        // Utility Routes for Development/Deployment
        Route::get('clear-cache', function () {
            $previousUrl = url()->previous();

            try {
                // Clear all Laravel caches
                \Illuminate\Support\Facades\Artisan::call('cache:clear');
                \Illuminate\Support\Facades\Artisan::call('config:clear');
                \Illuminate\Support\Facades\Artisan::call('route:clear');
                \Illuminate\Support\Facades\Artisan::call('view:clear');
                \Illuminate\Support\Facades\Artisan::call('event:clear');
                \Illuminate\Support\Facades\Artisan::call('queue:clear');

                // Try to clear compiled services and packages
                try {
                    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
                } catch (\Exception $e) {
                    // Ignore if command doesn't exist
                }

                return redirect($previousUrl)->with('success', 'All caches cleared successfully!');
            } catch (\Exception $e) {
                return redirect($previousUrl)->with('error', 'Error clearing caches: ' . $e->getMessage());
            }
        })->name('clear-cache');

        // Add other authenticated seller application routes here...
    });
});
