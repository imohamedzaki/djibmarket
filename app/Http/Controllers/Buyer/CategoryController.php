<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a category and its products
     */
    public function show(Category $category, Request $request)
    {
        // Load category with its children for navigation
        $category->load('children', 'parent');

        // Build query for products in this category and its subcategories
        $categoryIds = $this->getAllCategoryIds($category);

        $productsQuery = Product::whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->with(['category', 'seller', 'reviews']);

        // Handle filters
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $productsQuery->orderBy('price_regular', 'asc');
                    break;
                case 'price_high':
                    $productsQuery->orderBy('price_regular', 'desc');
                    break;
                case 'newest':
                    $productsQuery->orderBy('created_at', 'desc');
                    break;
                case 'popular':
                    $productsQuery->withCount('reviews')
                        ->orderBy('reviews_count', 'desc');
                    break;
                default:
                    $productsQuery->orderBy('created_at', 'desc');
            }
        } else {
            $productsQuery->orderBy('created_at', 'desc');
        }

        // Handle price range filter
        if ($request->has('min_price') && $request->has('max_price')) {
            $productsQuery->whereBetween('price_regular', [
                $request->min_price,
                $request->max_price
            ]);
        }

        // Handle seller filter
        if ($request->has('seller_id')) {
            $productsQuery->where('seller_id', $request->seller_id);
        }

        // Paginate results
        $products = $productsQuery->paginate(24);

        // Get category breadcrumbs
        $breadcrumbs = $this->getCategoryBreadcrumbs($category);

        // Get filters data
        $filters = $this->getFiltersData($categoryIds);

        return view('buyer.categories.show', compact(
            'category',
            'products',
            'breadcrumbs',
            'filters'
        ));
    }

    /**
     * Get all category IDs including subcategories recursively
     */
    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];

        // Get all descendants
        $children = Category::where('parent_id', $category->id)->get();
        foreach ($children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }

    /**
     * Get category breadcrumbs
     */
    private function getCategoryBreadcrumbs($category)
    {
        $breadcrumbs = [];
        $current = $category;

        while ($current) {
            array_unshift($breadcrumbs, $current);
            $current = $current->parent;
        }

        return $breadcrumbs;
    }

    /**
     * Get filters data for the category
     */
    private function getFiltersData($categoryIds)
    {
        // Get price range
        $priceRange = Product::whereIn('category_id', $categoryIds)
            ->where('status', 'active')
            ->selectRaw('MIN(price_regular) as min_price, MAX(price_regular) as max_price')
            ->first();

        // Get sellers with products in this category
        $sellers = \App\Models\Seller::whereHas('products', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds)
                ->where('status', 'active');
        })
            ->withCount(['products' => function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds)
                    ->where('status', 'active');
            }])
            ->having('products_count', '>', 0)
            ->orderBy('products_count', 'desc')
            ->take(20)
            ->get();

        return [
            'price_range' => $priceRange,
            'sellers' => $sellers
        ];
    }
}