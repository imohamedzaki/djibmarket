<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Category;
use App\Models\Product;
use App\Models\FlashSale;
use App\Models\Campaign;
use App\Models\Promotion;
use App\Models\SellerAd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\DB;

class HomeControllerCopy extends Controller
{
    public function index()
    {
        // Fetch latest 9 products for new arrivals section
        $newArrivals = Product::with(['category', 'reviews'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();

        // Fetch best selling products (top 9 by total quantity sold)
        $bestSelling = $this->getBestSellingProducts(9);

        // Fetch flash sales products (top 3 from active flash sales)
        $flashSalesProducts = $this->getFlashSalesProducts(3);

        // Fetch campaigns products (20 products from campaigns)
        $campaignsProducts = $this->getCampaignsProducts(20);

        // Fetch top discounted products (20 products with highest discounts)
        $topDiscountsProducts = $this->getTopDiscountsProducts(20);

        // Fetch upcoming deals products (20-30 products from upcoming promotions)
        $upcomingDealsProducts = $this->getUpcomingDealsProducts(25);

        // Fetch most reviewed products (20 products with most reviews)
        $mostReviewedProducts = $this->getMostReviewedProducts(20);

        // Fetch top rated products (20 products with highest average rating)
        $topRatedProducts = $this->getTopRatedProducts(20);

        // Fetch dynamic category data for computers accessories section
        $categoryData = $this->getMostReferencedCategoryData();

        // Fetch dynamic category data for home application section (second most referenced category)
        $homeApplicationCategoryData = $this->getSecondMostReferencedCategoryData();

        // Fetch dynamic category data for furniture decor section (third most referenced category)
        $furnitureDecorCategoryData = $this->getThirdMostReferencedCategoryData();

        // Fetch dynamic category data for tools equipment section (fourth most referenced category)
        $toolsEquipmentCategoryData = $this->getFourthMostReferencedCategoryData();

        // Fetch active ads for each slot
        $activeAds = $this->getActiveAds();

        return view('buyer.home', compact(
            'newArrivals',
            'bestSelling',
            'flashSalesProducts',
            'campaignsProducts',
            'topDiscountsProducts',
            'upcomingDealsProducts',
            'mostReviewedProducts',
            'topRatedProducts',
            'categoryData',
            'homeApplicationCategoryData',
            'furnitureDecorCategoryData',
            'toolsEquipmentCategoryData',
            'activeAds'
        ));
    }

    /**
     * Show the about page
     */
    public function about()
    {
        return view('buyer.about2');
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('buyer.contact');
    }

    /**
     * Handle contact form submission
     */
    public function submitContact(ContactFormRequest $request)
    {
        $validated = $request->validated();

        // Here you can add logic to:
        // 1. Send email notification
        // 2. Store in database  
        // 3. Send auto-reply to user

        // Example: Store contact message in database (you would need to create a ContactMessage model)
        // ContactMessage::create($validated);

        // Example: Send email notification to admin
        // Mail::to('admin@djibmarket.com')->send(new ContactFormSubmitted($validated));

        // For now, just return with success message
        return redirect()->route('buyer.contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    /**
     * Get best selling products based on order items
     */
    private function getBestSellingProducts($limit = 10, $days = null)
    {
        $query = Product::select([
            'products.*',
            DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
        ])
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->whereIn('orders.status', ['completed', 'delivered']); // Only count completed sales
            })
            ->where('products.status', 'active')
            ->with(['category', 'reviews']);

        // Optional: Filter by date range (e.g., last 30 days)
        if ($days) {
            $query->where('orders.created_at', '>=', now()->subDays($days));
        }

        return $query->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->orderByDesc('products.created_at') // Secondary sort for products with same sales
            ->take($limit)
            ->get();
    }

    /**
     * Get flash sales products from active flash sales
     */
    private function getFlashSalesProducts($limit = 3)
    {
        // Get active flash sales with their products
        $activeFlashSales = FlashSale::active()
            ->with(['products' => function ($query) {
                $query->where('status', 'active')
                    ->with(['category', 'reviews']);
            }])
            ->get();

        $flashSalesProducts = collect();

        foreach ($activeFlashSales as $flashSale) {
            foreach ($flashSale->products as $product) {
                // Calculate discounted price from flash sale
                $discountedPrice = $flashSale->getDiscountedPrice($product);

                // Add flash sale info to product
                $product->flash_sale_id = $flashSale->id;
                $product->flash_sale_title = $flashSale->title;
                $product->flash_sale_discounted_price = $discountedPrice;
                $product->flash_sale_discount_type = $flashSale->discount_type;
                $product->flash_sale_discount_value = $flashSale->discount_value;
                $product->flash_sale_end_at = $flashSale->end_at;

                $flashSalesProducts->push($product);
            }
        }

        // Return unique products (in case a product is in multiple flash sales)
        return $flashSalesProducts->unique('id')->take($limit);
    }

    /**
     * Alternative method: Get best selling for specific time periods
     */
    private function getBestSellingByPeriod($period = 'month', $limit = 10)
    {
        $dateFilter = match ($period) {
            'week' => now()->subWeek(),
            'month' => now()->subMonth(),
            'quarter' => now()->subMonths(3),
            'year' => now()->subYear(),
            default => now()->subMonth()
        };

        return Product::select([
            'products.*',
            DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold'),
            DB::raw('COALESCE(COUNT(DISTINCT orders.id), 0) as order_count')
        ])
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function ($join) use ($dateFilter) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.created_at', '>=', $dateFilter)
                    ->whereIn('orders.status', ['completed', 'delivered']);
            })
            ->where('products.status', 'active')
            ->with(['category', 'reviews'])
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->take($limit)
            ->get();
    }

    /**
     * Get products from active campaigns
     */
    private function getCampaignsProducts($limit = 20)
    {
        // Check if any campaigns exist
        $campaigns = Campaign::where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists();

        if (!$campaigns) {
            return collect(); // Return empty collection for fallback UI
        }

        // Get promotions linked to active campaigns
        $promotions = Promotion::whereHas('campaign', function ($query) {
            $query->where('is_active', true)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now());
        })
            ->where('is_active', true)
            ->with(['products' => function ($query) {
                $query->where('status', 'active')
                    ->with(['category', 'reviews']);
            }])
            ->get();

        $campaignProducts = collect();

        foreach ($promotions as $promotion) {
            foreach ($promotion->products as $product) {
                // Add promotion info to product
                $product->campaign_promotion_id = $promotion->id;
                $product->campaign_promotion_title = $promotion->title;
                $product->campaign_promotion_description = $promotion->description;

                $campaignProducts->push($product);
            }
        }

        // Return unique products randomly mixed
        return $campaignProducts->unique('id')->shuffle()->take($limit);
    }

    /**
     * Get products with top discounts
     */
    private function getTopDiscountsProducts($limit = 20)
    {
        return Product::select([
            'products.*',
            DB::raw('(price_regular - price_discounted) as discount_amount'),
            DB::raw('ROUND(((price_regular - price_discounted) / price_regular) * 100, 2) as discount_percentage')
        ])
            ->where('status', 'active')
            ->whereNotNull('price_discounted')
            ->whereColumn('price_discounted', '<', 'price_regular')
            ->where(DB::raw('(price_regular - price_discounted)'), '>', 0)
            ->with(['category', 'reviews'])
            ->orderByDesc('discount_amount')
            ->orderByDesc('discount_percentage')
            ->orderByDesc('created_at')
            ->take($limit)
            ->get();
    }

    /**
     * Get products from upcoming promotions
     */
    private function getUpcomingDealsProducts($limit = 25)
    {
        // Get promotions that start from tomorrow onward
        $upcomingPromotions = Promotion::where('start_at', '>', now()->endOfDay())
            ->where('is_active', true)
            ->with(['products' => function ($query) {
                $query->where('status', 'active')
                    ->with(['category', 'reviews']);
            }])
            ->get();

        $upcomingProducts = collect();

        foreach ($upcomingPromotions as $promotion) {
            foreach ($promotion->products as $product) {
                // Add upcoming promotion info to product
                $product->upcoming_promotion_id = $promotion->id;
                $product->upcoming_promotion_title = $promotion->title;
                $product->upcoming_promotion_start_at = $promotion->start_at;
                $product->upcoming_promotion_end_at = $promotion->end_at;

                $upcomingProducts->push($product);
            }
        }

        // Return unique products randomly mixed
        return $upcomingProducts->unique('id')->shuffle()->take($limit);
    }

    /**
     * Get products with most reviews
     */
    private function getMostReviewedProducts($limit = 20)
    {
        return Product::select([
            'products.*',
            DB::raw('COUNT(product_reviews.id) as reviews_count')
        ])
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->where('products.status', 'active')
            ->with(['category', 'reviews'])
            ->groupBy('products.id')
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_count')
            ->orderByDesc('products.created_at')
            ->take($limit * 2) // Get more to randomize
            ->get()
            ->shuffle()
            ->take($limit);
    }

    /**
     * Get products with highest average rating
     */
    private function getTopRatedProducts($limit = 20)
    {
        return Product::select([
            'products.*',
            DB::raw('AVG(product_reviews.rating) as average_rating'),
            DB::raw('COUNT(product_reviews.id) as reviews_count')
        ])
            ->leftJoin('product_reviews', 'products.id', '=', 'product_reviews.product_id')
            ->where('products.status', 'active')
            ->with(['category', 'reviews'])
            ->groupBy('products.id')
            ->having('reviews_count', '>=', 3) // Minimum 3 reviews for reliability
            ->having('average_rating', '>=', 4.0) // Minimum 4 stars average
            ->orderByDesc('average_rating')
            ->orderByDesc('reviews_count')
            ->orderByDesc('products.created_at')
            ->take($limit * 2) // Get more to randomize
            ->get()
            ->shuffle()
            ->take($limit);
    }

    /**
     * Get the most referenced parent category with its subcategories and their latest products
     */
    private function getMostReferencedCategoryData()
    {
        // Find the most referenced parent category
        $mostReferencedParent = Category::select('categories.id', 'categories.name', 'categories.slug')
            ->join('categories as subcategories', 'categories.id', '=', 'subcategories.parent_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByRaw('COUNT(subcategories.id) DESC')
            ->first();

        if (!$mostReferencedParent) {
            // Fallback: get any category with children
            $mostReferencedParent = Category::has('children')->first();
        }

        if (!$mostReferencedParent) {
            return null;
        }

        // Get up to 10 subcategories of the most referenced parent
        $subcategories = Category::where('parent_id', $mostReferencedParent->id)
            ->with(['products' => function ($query) {
                $query->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(5);
            }])
            ->take(10)
            ->get();

        return [
            'parentCategory' => $mostReferencedParent,
            'subcategories' => $subcategories
        ];
    }

    /**
     * Get the second most referenced parent category with its subcategories and their latest products
     * This ensures we get a different category than the one used in computers_accessories
     */
    private function getSecondMostReferencedCategoryData()
    {
        // Find the top 2 most referenced parent categories
        $topParentCategories = Category::select('categories.id', 'categories.name', 'categories.slug')
            ->join('categories as subcategories', 'categories.id', '=', 'subcategories.parent_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByRaw('COUNT(subcategories.id) DESC')
            ->take(2)
            ->get();

        // Get the second one if available, otherwise get any other category with children
        $secondMostReferencedParent = $topParentCategories->count() > 1
            ? $topParentCategories->get(1)
            : Category::has('children')
            ->whereNotIn('id', $topParentCategories->pluck('id'))
            ->first();

        if (!$secondMostReferencedParent) {
            // Ultimate fallback: get any category with children
            $secondMostReferencedParent = Category::has('children')->first();
        }

        if (!$secondMostReferencedParent) {
            return null;
        }

        // Get up to 10 subcategories of the second most referenced parent
        $subcategories = Category::where('parent_id', $secondMostReferencedParent->id)
            ->with(['products' => function ($query) {
                $query->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(5);
            }])
            ->take(10)
            ->get();

        return [
            'parentCategory' => $secondMostReferencedParent,
            'subcategories' => $subcategories
        ];
    }

    /**
     * Get the third most referenced parent category with its subcategories and their latest products
     */
    private function getThirdMostReferencedCategoryData()
    {
        // Find the top 3 most referenced parent categories
        $topParentCategories = Category::select('categories.id', 'categories.name', 'categories.slug')
            ->join('categories as subcategories', 'categories.id', '=', 'subcategories.parent_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByRaw('COUNT(subcategories.id) DESC')
            ->take(3)
            ->get();

        // Get the third one if available, otherwise get any other category with children
        $thirdMostReferencedParent = $topParentCategories->count() > 2
            ? $topParentCategories->get(2)
            : Category::has('children')
            ->whereNotIn('id', $topParentCategories->pluck('id'))
            ->first();

        if (!$thirdMostReferencedParent) {
            // Ultimate fallback: get any category with children
            $thirdMostReferencedParent = Category::has('children')->first();
        }

        if (!$thirdMostReferencedParent) {
            return null;
        }

        // Get up to 10 subcategories of the third most referenced parent
        $subcategories = Category::where('parent_id', $thirdMostReferencedParent->id)
            ->with(['products' => function ($query) {
                $query->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(5);
            }])
            ->take(10)
            ->get();

        return [
            'parentCategory' => $thirdMostReferencedParent,
            'subcategories' => $subcategories
        ];
    }

    /**
     * Get the fourth most referenced parent category with its subcategories and their latest products
     */
    private function getFourthMostReferencedCategoryData()
    {
        // Find the top 4 most referenced parent categories
        $topParentCategories = Category::select('categories.id', 'categories.name', 'categories.slug')
            ->join('categories as subcategories', 'categories.id', '=', 'subcategories.parent_id')
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderByRaw('COUNT(subcategories.id) DESC')
            ->take(4)
            ->get();

        // Get the fourth one if available, otherwise get any other category with children
        $fourthMostReferencedParent = $topParentCategories->count() > 3
            ? $topParentCategories->get(3)
            : Category::has('children')
            ->whereNotIn('id', $topParentCategories->pluck('id'))
            ->first();

        if (!$fourthMostReferencedParent) {
            // Ultimate fallback: get any category with children
            $fourthMostReferencedParent = Category::has('children')->first();
        }

        if (!$fourthMostReferencedParent) {
            return null;
        }

        // Get up to 10 subcategories of the fourth most referenced parent
        $subcategories = Category::where('parent_id', $fourthMostReferencedParent->id)
            ->with(['products' => function ($query) {
                $query->where('status', 'published')
                    ->orderBy('created_at', 'desc')
                    ->take(5);
            }])
            ->take(10)
            ->get();

        return [
            'parentCategory' => $fourthMostReferencedParent,
            'subcategories' => $subcategories
        ];
    }

    /**
     * Get active advertisements for all slots
     */
    private function getActiveAds()
    {
        $ads = SellerAd::active()
            ->with(['seller'])
            ->get()
            ->groupBy('ad_slot');

        // Initialize all slots to ensure we have entries for each
        $activeAds = [];
        foreach (SellerAd::AD_SLOTS as $slot => $displayName) {
            $activeAds[$slot] = $ads->get($slot, collect())->first(); // Get first ad for each slot
        }

        // Record views for displayed ads
        foreach ($activeAds as $slot => $ad) {
            if ($ad) {
                $ad->recordView([
                    'page_url' => request()->fullUrl(),
                    'ad_slot' => $slot,
                ]);
            }
        }

        return $activeAds;
    }
}