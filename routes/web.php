<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\HomeController;
use App\Http\Controllers\Buyer\ProductController as BuyerProductController;
use App\Http\Controllers\Buyer\CategoryController as BuyerCategoryController;
use App\Http\Controllers\Buyer\VendorController;
use App\Http\Controllers\Buyer\SearchController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\JoinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BusinessActivityController as AdminBusinessActivityController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Auth;

// Include route files first
require __DIR__ . '/auth.php';
require __DIR__ . '/adminRoutes.php';
require __DIR__ . '/sellerRoutes.php';

Route::get('/', [HomeController::class, 'index'])->name('buyer.home');

// Demo page for testing quickview
Route::get('/quickview-demo', function () {
    $products = \App\Models\Product::with(['seller', 'category', 'images'])
        ->where('stock_quantity', '>', 0)
        ->take(6)
        ->get();

    return view('quickview-demo', compact('products'));
});


// About page route
Route::get('/about', [HomeController::class, 'about'])->name('buyer.about');

// Contact page route
Route::get('/contact', [HomeController::class, 'contact'])->name('buyer.contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('buyer.contact.submit');

// Join us page route
Route::get('/join', [JoinController::class, 'index'])->name('buyer.join');

// Buyer product routes
Route::get('/product/{product}', [BuyerProductController::class, 'show'])->name('buyer.product.show');
Route::get('/products/{id}/quickview', [BuyerProductController::class, 'quickview'])->name('products.quickview');

// Buyer category routes
Route::get('/category/{category}', [BuyerCategoryController::class, 'show'])->name('categories.show');

// Buyer vendor routes
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendors.show');

// Buyer seller routes
Route::get('/sellers/{seller}', function (\App\Models\Seller $seller) {
    $products = $seller->products()->where('status', 'active')->with(['category', 'reviews'])->paginate(24);
    return view('buyer.sellers.show', compact('seller', 'products'));
})->name('sellers.show');

// Mega Menu API route
Route::get('/api/mega-menu/categories', [HomeController::class, 'getMegaMenuApi'])->name('api.megamenu.categories');

// Search API route
Route::post('/search/products', [SearchController::class, 'searchProducts'])->name('search.products');

// Search results page
Route::get('/search', [SearchController::class, 'searchResults'])->name('search.results');

// Advertisement tracking routes
Route::post('/ad-click/{ad}', function (\App\Models\SellerAd $ad) {
    $ad->recordClick([
        'page_url' => request()->header('referer'),
        'ad_slot' => $ad->ad_slot,
    ]);

    return response()->json(['success' => true]);
})->name('ad.click');

// Ad view tracking
Route::post('/ad-track/view', function () {
    $adId = request('seller_ad_id');
    $ad = \App\Models\SellerAd::find($adId);

    if ($ad) {
        \App\Models\SellerAdStat::create([
            'seller_ad_id' => $ad->id,
            'event_type' => 'view',
            'event_time' => now(),
            'user_ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'session_id' => session()->getId(),
            'buyer_id' => auth()->id(),
            'referer_url' => request()->header('referer'),
            'page_url' => request()->header('referer'),
            'device_type' => request()->isMobile() ? 'mobile' : 'desktop',
        ]);

        // Update current views count
        $ad->increment('current_views');
    }

    return response()->json(['success' => true]);
})->name('ad.track.view');

// Ad click tracking
Route::post('/ad-track/click', function () {
    $adId = request('seller_ad_id');
    $ad = \App\Models\SellerAd::find($adId);

    if ($ad) {
        \App\Models\SellerAdStat::create([
            'seller_ad_id' => $ad->id,
            'event_type' => 'click',
            'event_time' => now(),
            'user_ip' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'session_id' => session()->getId(),
            'buyer_id' => auth()->id(),
            'referer_url' => request()->header('referer'),
            'page_url' => request()->header('referer'),
            'device_type' => request()->isMobile() ? 'mobile' : 'desktop',
        ]);

        // Update current clicks count
        $ad->increment('current_clicks');
    }

    return response()->json(['success' => true]);
})->name('ad.track.click');

// Cart routes (accessible to both authenticated and guest users)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/remove', [CartController::class, 'remove'])->name('remove');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::get('/data', [CartController::class, 'getData'])->name('data');
    Route::get('/html', [CartController::class, 'getCartHtml'])->name('html');
    Route::post('/clear', [CartController::class, 'clear'])->name('clear');
});

// Checkout routes (accessible to both authenticated and guest users)
Route::middleware('auth')->prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
});

Route::middleware('auth')->name('buyer.')->group(function () {
    // Dashboard routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Profile routes
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

        // Address routes
        Route::get('/addresses', [DashboardController::class, 'addresses'])->name('addresses');
        Route::post('/addresses', [DashboardController::class, 'storeAddress'])->name('addresses.store');
        Route::put('/addresses/{address}', [DashboardController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('/addresses/{address}', [DashboardController::class, 'deleteAddress'])->name('addresses.delete');

        // Order routes
        Route::get('/orders', [DashboardController::class, 'orders'])->name('orders');
        Route::get('/orders/{order}', [DashboardController::class, 'orderDetails'])->name('orders.show');
        Route::post('/orders/{order}/cancel', [DashboardController::class, 'cancelOrder'])->name('orders.cancel');
        Route::get('/orders/{order}/invoice', [DashboardController::class, 'downloadInvoice'])->name('orders.invoice');

        // Wishlist routes
        Route::get('/wishlist', [DashboardController::class, 'wishlist'])->name('wishlist');
        Route::delete('/wishlist/{wishlist}', [DashboardController::class, 'removeFromWishlist'])->name('wishlist.remove');
        Route::post('/wishlist/add', [DashboardController::class, 'addToWishlist'])->name('wishlist.add');
        Route::post('/wishlist/remove', [DashboardController::class, 'removeFromWishlistByProduct'])->name('wishlist.remove-product');

        // Browsing history routes
        Route::get('/browsing-history', [DashboardController::class, 'browsingHistory'])->name('browsing-history');
        Route::delete('/browsing-history', [DashboardController::class, 'clearBrowsingHistory'])->name('browsing-history.clear');

        // Return requests routes
        Route::get('/return-requests', [DashboardController::class, 'returnRequests'])->name('return-requests');

        // Cart route
        Route::get('/cart', [DashboardController::class, 'cart'])->name('cart');
        Route::post('/cart/save-to-wishlist', [DashboardController::class, 'saveCartToWishlist'])->name('cart.save-to-wishlist');
        Route::get('/wishlist/count', [DashboardController::class, 'getWishlistCount'])->name('wishlist.count');

        // Tracking routes
        Route::get('/tracking', [DashboardController::class, 'tracking'])->name('tracking');
    });
});

// Utility Routes for Development/Deployment (accessible to all authenticated users)
Route::middleware('auth')->get('/clear-cache', [CacheController::class, 'clearCache'])->name('clear-cache');
Route::get('/emergency/clear-cache', [CacheController::class, 'emergencyClearCache'])->name('emergency.clear-cache');

// Test routes (for development)
Route::get('/test-quickview-modifications', function () {
    $product = \App\Models\Product::with(['seller', 'category', 'images', 'reviews'])->find(274);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }

    return response()->json([
        'product_id' => $product->id,
        'title' => $product->title,
        'price_regular' => $product->price_regular,
        'price_discounted' => $product->price_discounted,
        'stock_quantity' => $product->stock_quantity,
        'reviews_count' => $product->reviews->count(),
        'rating' => $product->reviews->avg('rating'),
        'has_discount' => $product->price_discounted && $product->price_discounted > 0 && $product->price_discounted < $product->price_regular,
        'is_authenticated' => Auth::check(),
        'user_id' => Auth::id(),
        'wishlist_routes' => [
            'add' => route('buyer.dashboard.wishlist.add'),
            'remove' => route('buyer.dashboard.wishlist.remove-product')
        ]
    ]);
});

Route::get('/update-test-product-stock', function () {
    $product = \App\Models\Product::find(274);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }

    $product->update([
        'stock_quantity' => 50, // Set to 50 to test higher quantities
        'price_discounted' => 0 // Set to 0 to test the pricing fix
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Product updated successfully',
        'product' => [
            'id' => $product->id,
            'stock_quantity' => $product->stock_quantity,
            'price_regular' => $product->price_regular,
            'price_discounted' => $product->price_discounted
        ]
    ]);
});