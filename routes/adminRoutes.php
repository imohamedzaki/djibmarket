<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminBuyerController;
use App\Http\Controllers\Admin\AdminSellerController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminCampaignController;
use App\Http\Controllers\Admin\AdminPromotionController;
use App\Http\Controllers\Admin\AdminFlashSaleController;
use App\Http\Controllers\Admin\AdminAdsCompanyController;
use App\Http\Controllers\Admin\BusinessActivityController;
use App\Http\Controllers\Admin\AdminNotificationBarController;
use App\Http\Controllers\Admin\AdminAdController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminCategoryAdController;
use App\Http\Controllers\Admin\OrderManagementController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Base admin route check - redirect appropriately based on auth status
    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    });

    // Include the authentication routes
    require __DIR__ . '/admin/auth.php';

    // Authenticated admin routes (application routes)
    Route::middleware('auth:admin')->group(function () {
        // Dashboard route
        Route::get('dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
        // Business Activities Resource Route using slug
        Route::resource('business_activities', BusinessActivityController::class)->parameters(['business_activities' => 'business_activity:slug'])->except(['edit']);

        // Categories Resource Route using slug
        Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category:slug'])->except(['edit']);
        // AJAX route to get data for editing a category
        Route::get('categories/{category:slug}/edit-data', [CategoryController::class, 'getEditData'])->name('categories.editData');

        // Sellers Resource Route
        Route::resource('sellers', AdminSellerController::class)->except(['create', 'store', 'destroy', 'edit']);
        // AJAX route to get data for editing a seller
        Route::get('sellers/{seller}/edit-data', [AdminSellerController::class, 'getEditData'])->name('sellers.editData');
        // Route to update seller status (enable/disable)
        Route::patch('sellers/{seller}/status', [AdminSellerController::class, 'updateStatus'])->name('sellers.updateStatus');

        // Buyers Resource Route
        Route::resource('buyers', AdminBuyerController::class)->except(['create', 'store', 'destroy', 'edit']);
        // AJAX route to get data for editing a buyer
        Route::get('buyers/{buyer}/edit-data', [AdminBuyerController::class, 'getEditData'])->name('buyers.editData');
        // Route to update buyer status (enable/disable)
        Route::patch('buyers/{buyer}/status', [AdminBuyerController::class, 'updateStatus'])->name('buyers.updateStatus');

        // Status-specific order routes (commented out - using filter dropdown instead)
        // Route::get('orders/pending', [OrderManagementController::class, 'pending'])->name('orders.pending');
        // Route::get('orders/processing', [OrderManagementController::class, 'processing'])->name('orders.processing');
        // Route::get('orders/delivered', [OrderManagementController::class, 'delivered'])->name('orders.delivered');
        // Route::get('orders/shipped', [OrderManagementController::class, 'shipped'])->name('orders.shipped');
        
        // Orders Resource Route using order_number as slug
        Route::resource('orders', OrderManagementController::class)->parameters(['orders' => 'order:order_number'])->except(['create', 'store', 'edit']);
        // AJAX route to get data for editing an order
        Route::get('orders/{order:order_number}/edit-data', [OrderManagementController::class, 'getEditData'])->name('orders.editData');
        // Route to update order status
        Route::patch('orders/{order:order_number}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.updateStatus');

        // Admin Profile Routes
        Route::get('profile', [AdminProfileController::class, 'showProfile'])->name('profile.show');
        Route::get('profile/edit', [AdminProfileController::class, 'editProfile'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');

        // Campaign Resource Routes using slug
        Route::resource('campaigns', AdminCampaignController::class)->parameters(['campaigns' => 'campaign:slug'])->except(['edit']);
        // AJAX route to get data for editing a campaign
        Route::get('campaigns/{campaign:slug}/edit-data', [AdminCampaignController::class, 'getEditData'])->name('campaigns.editData');

        // Add route for deleting campaign banner image
        Route::delete('campaigns/{campaign:slug}/delete-banner', [AdminCampaignController::class, 'deleteBanner'])->name('campaigns.deleteBanner');

        // Campaign Promotion routes
        Route::post('campaigns/{campaign:slug}/promotions', [AdminCampaignController::class, 'storePromotion'])->name('campaigns.promotions.store');
        Route::get('campaigns/{campaign:slug}/promotions/{promotion}', [AdminCampaignController::class, 'showPromotion'])->name('campaigns.promotions.show');
        Route::get('campaigns/{campaign:slug}/promotions/{promotion}/edit', [AdminCampaignController::class, 'editPromotion'])->name('campaigns.promotions.edit');
        Route::put('campaigns/{campaign:slug}/promotions/{promotion}', [AdminCampaignController::class, 'updatePromotion'])->name('campaigns.promotions.update');
        Route::delete('campaigns/{campaign:slug}/promotions/{promotion}', [AdminCampaignController::class, 'destroyPromotion'])->name('campaigns.promotions.destroy');

        // Promotion Resource Routes
        Route::resource('promotions', AdminPromotionController::class)->except(['edit']);
        // AJAX route to get data for editing a promotion
        Route::get('promotions/{promotion}/edit-data', [AdminPromotionController::class, 'getEditData'])->name('promotions.editData');

        // Flash Sales Resource Routes
        Route::resource('flash-sales', AdminFlashSaleController::class)->parameters(['flash-sales' => 'flashSale:slug'])->only(['index', 'show']);

        // Ads Companies Resource Routes
        Route::resource('ads-companies', AdminAdsCompanyController::class)->except(['edit']);
        // AJAX route to get data for editing an ads company
        Route::get('ads-companies/{adsCompany}/edit-data', [AdminAdsCompanyController::class, 'getEditData'])->name('ads-companies.editData');
        // Route for deleting ads company logo
        Route::delete('ads-companies/{adsCompany}/delete-logo', [AdminAdsCompanyController::class, 'deleteLogo'])->name('ads-companies.deleteLogo');

        // Notification Bars Resource Routes
        Route::resource('notification-bars', AdminNotificationBarController::class)->except(['edit']);
        // AJAX route to get data for editing a notification bar
        Route::get('notification-bars/{notificationBar}/edit-data', [AdminNotificationBarController::class, 'getEditData'])->name('notification-bars.editData');
        // Route to update notification bar status (enable/disable)
        Route::patch('notification-bars/{notificationBar}/status', [AdminNotificationBarController::class, 'updateStatus'])->name('notification-bars.updateStatus');

        // Advertisement Management Routes
        Route::resource('ads', AdminAdController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
        Route::post('ads/{ad}/approve', [AdminAdController::class, 'approve'])
            ->name('ads.approve');
        Route::post('ads/{ad}/reject', [AdminAdController::class, 'reject'])
            ->name('ads.reject');
        Route::post('ads/{ad}/pause', [AdminAdController::class, 'pause'])
            ->name('ads.pause');
        Route::post('ads/{ad}/resume', [AdminAdController::class, 'resume'])
            ->name('ads.resume');
        Route::post('ads/bulk-action', [AdminAdController::class, 'bulkAction'])
            ->name('ads.bulk-action');
        Route::get('ads-analytics', [AdminAdController::class, 'analytics'])
            ->name('ads.analytics');
        Route::post('ads/export', [AdminAdController::class, 'export'])
            ->name('ads.export');

        // Email Management Routes
        Route::prefix('emails')->name('emails.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AdminEmailController::class, 'dashboard'])->name('dashboard');
            Route::get('/stats', [App\Http\Controllers\Admin\AdminEmailController::class, 'getStats'])->name('stats');
            Route::get('/real-time-data', [App\Http\Controllers\Admin\AdminEmailController::class, 'realTimeData'])->name('real-time-data');
            Route::get('/{emailLog}', [App\Http\Controllers\Admin\AdminEmailController::class, 'show'])->name('show');
            Route::post('/bulk-action', [App\Http\Controllers\Admin\AdminEmailController::class, 'bulkAction'])->name('bulk-action');
            Route::get('/{emailLog}/retry', [App\Http\Controllers\Admin\AdminEmailController::class, 'retry'])->name('retry');
            Route::get('/export/csv', [App\Http\Controllers\Admin\AdminEmailController::class, 'export'])->name('export');
            Route::post('/clear-old', [App\Http\Controllers\Admin\AdminEmailController::class, 'clearOld'])->name('clear-old');
        });

        // Brand Management Routes
        Route::resource('brands', AdminBrandController::class);
        Route::get('brands/{brand}/edit-data', [AdminBrandController::class, 'getEditData'])->name('brands.editData');
        Route::delete('brands/{brand}/delete-logo', [AdminBrandController::class, 'deleteLogo'])->name('brands.deleteLogo');

        // Category Ads Management Routes
        Route::resource('category-ads', AdminCategoryAdController::class);
        Route::get('category-ads/{categoryAd}/edit-data', [AdminCategoryAdController::class, 'getEditData'])->name('category-ads.editData');
        Route::delete('category-ads/{categoryAd}/delete-image', [AdminCategoryAdController::class, 'deleteImage'])->name('category-ads.deleteImage');
        Route::patch('category-ads/{categoryAd}/status', [AdminCategoryAdController::class, 'updateStatus'])->name('category-ads.updateStatus');

        // Analytics Routes
        Route::prefix('analytics')->name('analytics.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('dashboard');
            Route::get('/real-time-data', [App\Http\Controllers\Admin\AnalyticsController::class, 'realTimeData'])->name('real-time-data');
            Route::get('/export', [App\Http\Controllers\Admin\AnalyticsController::class, 'export'])->name('export');
        });

        // Coming Soon page for placeholder links
        Route::get('coming-soon', [ComingSoonController::class, 'indexAdmin'])
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

        // Add other authenticated admin application routes here...
    });
});