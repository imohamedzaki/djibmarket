<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Load product with relationships
        $product->load(['category', 'seller', 'images', 'reviews', 'specifications']);

        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->with(['category', 'reviews'])
            ->take(8)
            ->get();

        // Get more products from the same seller
        $moreFromSeller = Product::where('seller_id', $product->seller_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->with(['category', 'reviews'])
            ->take(8)
            ->get();

        // Get products that customers also viewed (simulate with random products from same category or popular products)
        $customersAlsoViewed = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->with(['category', 'reviews'])
            ->inRandomOrder()
            ->take(8)
            ->get();

        // If not enough products in same category, get random products
        if ($customersAlsoViewed->count() < 4) {
            $additionalProducts = Product::where('id', '!=', $product->id)
                ->where('status', 'published')
                ->with(['category', 'reviews'])
                ->inRandomOrder()
                ->take(8 - $customersAlsoViewed->count())
                ->get();

            $customersAlsoViewed = $customersAlsoViewed->merge($additionalProducts);
        }

        return view('buyer.products.show', compact(
            'product',
            'relatedProducts',
            'moreFromSeller',
            'customersAlsoViewed'
        ));
    }

    /**
     * Fetch product data for quick view modal.
     */
    public function quickview($id)
    {
        try {
            // Load product with all necessary relationships
            $product = \App\Models\Product::with([
                'seller:id,name',
                'category:id,name,slug',
                'images:id,product_id,image_path',
                'reviews:id,product_id,rating'
            ])->find($id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            // Process images - get real product images
            $images = collect();

            // Add thumbnail if exists
            if ($product->thumbnail) {
                $images->push([
                    'url' => asset('storage/' . $product->thumbnail),
                    'alt' => $product->title . ' - Main Image'
                ]);
            }

            // Add product images
            if ($product->images && $product->images->count() > 0) {
                foreach ($product->images as $image) {
                    $images->push([
                        'url' => asset('storage/' . $image->image_path),
                        'alt' => $product->title . ' - Gallery Image'
                    ]);
                }
            }

            // Add featured image if no thumbnail but featured image exists
            if ($images->isEmpty() && $product->featured_image_path) {
                $images->push([
                    'url' => asset('storage/' . $product->featured_image_path),
                    'alt' => $product->title . ' - Featured Image'
                ]);
            }

            // Fallback to placeholder if no images
            if ($images->isEmpty()) {
                $images->push([
                    'url' => asset('assets/imgs/template/logo_only.png'),
                    'alt' => 'No image available'
                ]);
            }

            // Fix pricing logic - if price_discounted is 0, use price_regular
            $hasDiscount = $product->price_discounted && $product->price_discounted > 0 && $product->price_discounted < $product->price_regular;
            $finalPrice = $hasDiscount ? $product->price_discounted : $product->price_regular;

            // Calculate real discount percentage
            $discountPercentage = 0;
            if ($hasDiscount) {
                $discountPercentage = round((($product->price_regular - $product->price_discounted) / $product->price_regular) * 100);
            }

            // Calculate real rating from reviews
            $averageRating = 0;
            $reviewsCount = 0;
            if ($product->reviews && $product->reviews->count() > 0) {
                $ratings = $product->reviews->pluck('rating')->filter(); // Remove null ratings
                if ($ratings->count() > 0) {
                    $averageRating = round($ratings->avg(), 1);
                    $reviewsCount = $ratings->count();
                }
            }

            // Generate star array for rating display
            $stars = [];
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= floor($averageRating)) {
                    $stars[] = ['filled' => true, 'half' => false];
                } elseif ($i == ceil($averageRating) && ($averageRating - floor($averageRating)) >= 0.5) {
                    $stars[] = ['filled' => false, 'half' => true];
                } else {
                    $stars[] = ['filled' => false, 'half' => false];
                }
            }

            // Get real seller information
            $sellerName = 'Unknown Seller';
            $sellerUrl = '#';
            if ($product->seller) {
                $sellerName = $product->seller->name;
                $sellerUrl = route('sellers.show', $product->seller->id);
            }

            // Get real category information
            $categoryName = 'Uncategorized';
            $categoryUrl = '#';
            if ($product->category) {
                $categoryName = $product->category->name;
                if ($product->category->slug) {
                    $categoryUrl = route('categories.show', $product->category->slug);
                }
            }

            // Process description
            $description = strip_tags($product->description ?? 'No description available.');
            $shortDescription = strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description;

            // Check if product is in user's wishlist (if user is authenticated)
            $isInWishlist = false;
            if (Auth::check()) {
                $isInWishlist = Auth::user()->wishlist()->where('product_id', $product->id)->exists();
            }

            return response()->json([
                'success' => true,
                'product' => [
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'description' => $description,
                    'shortDescription' => $shortDescription,
                    'price' => [
                        'regular' => $product->price_regular,
                        'discounted' => $hasDiscount ? $product->price_discounted : null,
                        'final' => $finalPrice,
                        'regularFormatted' => number_format($product->price_regular, 0) . ' DJF',
                        'discountedFormatted' => $hasDiscount ? number_format($product->price_discounted, 0) . ' DJF' : null,
                        'finalFormatted' => number_format($finalPrice, 0) . ' DJF',
                        'hasDiscount' => $hasDiscount,
                        'discountPercentage' => $discountPercentage
                    ],
                    'stock' => [
                        'quantity' => $product->stock_quantity ?? 0,
                        'inStock' => ($product->stock_quantity ?? 0) > 0
                    ],
                    'rating' => [
                        'average' => $averageRating,
                        'count' => $reviewsCount,
                        'stars' => $stars
                    ],
                    'images' => $images->unique('url')->values(),
                    'seller' => [
                        'id' => $product->seller ? $product->seller->id : null,
                        'name' => $sellerName,
                        'url' => $sellerUrl
                    ],
                    'category' => [
                        'id' => $product->category ? $product->category->id : null,
                        'name' => $categoryName,
                        'url' => $categoryUrl
                    ],
                    'wishlist' => [
                        'isInWishlist' => $isInWishlist
                    ],
                    'urls' => [
                        'view' => route('buyer.product.show', $product->slug),
                        'addToCart' => route('cart.add')
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to load product details: ' . $e->getMessage(),
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    /**
     * Generate stars array for rating display
     */
    private function generateStarsArray($rating)
    {
        $stars = [];
        for ($i = 1; $i <= 5; $i++) {
            $stars[] = [
                'filled' => $i <= $rating,
                'half' => $i - 0.5 == $rating
            ];
        }
        return $stars;
    }
}
