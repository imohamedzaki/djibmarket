<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Search for products via AJAX
     */
    public function searchProducts(Request $request): JsonResponse
    {
        $query = $request->input('query', '');
        $categoryId = $request->input('category_id', '');

        // Validate minimum query length
        if (strlen(trim($query)) < 2) {
            return response()->json([
                'success' => true,
                'products' => []
            ]);
        }

        // Build the product search query
        $productsQuery = Product::where('status', 'published')
            ->with(['category', 'seller']);

        // Apply search filters
        $productsQuery->where(function ($q) use ($query) {
            $q->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('sku', 'like', '%' . $query . '%');
        });

        // Apply category filter if provided
        if (!empty($categoryId)) {
            $category = Category::find($categoryId);
            if ($category) {
                // Get all subcategory IDs including the parent category
                $categoryIds = $this->getAllCategoryIds($category);
                $productsQuery->whereIn('category_id', $categoryIds);
            }
        }

        // Get limited results for performance
        $products = $productsQuery->orderBy('title')
            ->take(10)
            ->get();

        // Format the results for frontend
        $formattedProducts = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'price' => number_format($product->price_discounted ?? $product->price_regular, 2) . ' DJF',
                'image' => $product->thumbnail
                    ? asset('storage/' . $product->thumbnail)
                    : asset('assets/imgs/page/homepage1/imgsp7.png'),
                'url' => route('buyer.product.show', $product->slug),
                'category' => $product->category->name ?? 'Uncategorized',
                'seller' => $product->seller->name ?? 'Unknown Seller'
            ];
        });

        return response()->json([
            'success' => true,
            'products' => $formattedProducts
        ]);
    }

    /**
     * Get all category IDs including subcategories
     */
    private function getAllCategoryIds(Category $category): array
    {
        $categoryIds = [$category->id];

        // Get all subcategories recursively
        $subcategories = Category::where('parent_id', $category->id)->get();

        foreach ($subcategories as $subcategory) {
            $categoryIds = array_merge($categoryIds, $this->getAllCategoryIds($subcategory));
        }

        return $categoryIds;
    }

    /**
     * Display search results page
     */
    public function searchResults(Request $request): View
    {
        $query = $request->input('query', '');
        $categoryId = $request->input('category_id', '');
        $sort = $request->input('sort', 'latest');
        $perPage = $request->input('per_page', 16);
        $priceRange = $request->input('price_range', '');

        // Initialize products query
        $productsQuery = Product::where('status', 'published')
            ->with(['category', 'seller', 'reviews']);

        // Apply search filters if query exists
        if (!empty(trim($query))) {
            $productsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('sku', 'like', '%' . $query . '%');
            });
        }

        // Apply category filter if provided
        $selectedCategory = null;
        if (!empty($categoryId)) {
            $category = Category::find($categoryId);
            if ($category) {
                $selectedCategory = $category;
                // Get all subcategory IDs including the parent category
                $categoryIds = $this->getAllCategoryIds($category);
                $productsQuery->whereIn('category_id', $categoryIds);
            }
        }

        // Apply price range filter
        if (!empty($priceRange)) {
            switch ($priceRange) {
                case '0-100':
                    $productsQuery->where('price_regular', '>=', 0)->where('price_regular', '<=', 100);
                    break;
                case '100-300':
                    $productsQuery->where('price_regular', '>=', 100)->where('price_regular', '<=', 300);
                    break;
                case '300-600':
                    $productsQuery->where('price_regular', '>=', 300)->where('price_regular', '<=', 600);
                    break;
                case '600-1000':
                    $productsQuery->where('price_regular', '>=', 600)->where('price_regular', '<=', 1000);
                    break;
                case '1000+':
                    $productsQuery->where('price_regular', '>', 1000);
                    break;
            }
        }

        // Apply sorting
        switch ($sort) {
            case 'price_low':
                $productsQuery->orderBy('price_regular', 'asc');
                break;
            case 'price_high':
                $productsQuery->orderBy('price_regular', 'desc');
                break;
            case 'oldest':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            case 'popular':
                $productsQuery->withCount('reviews')
                    ->orderBy('reviews_count', 'desc');
                break;
            case 'latest':
            default:
                $productsQuery->orderBy('created_at', 'desc');
                break;
        }

        // Get paginated results
        $products = $productsQuery->paginate($perPage)->withQueryString();

        // Get all categories for the sidebar
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('status', 'published');
        }])
            ->where('parent_id', null)
            ->orderBy('name')
            ->get();

        // Build breadcrumbs
        $breadcrumbs = [];
        if ($selectedCategory) {
            // Get category hierarchy
            $categoryHierarchy = [];
            $currentCategory = $selectedCategory;
            while ($currentCategory) {
                array_unshift($categoryHierarchy, $currentCategory);
                $currentCategory = $currentCategory->parent;
            }
            $breadcrumbs = $categoryHierarchy;
        }

        return view('buyer.search.results', compact(
            'products',
            'categories',
            'query',
            'categoryId',
            'selectedCategory',
            'sort',
            'perPage',
            'priceRange',
            'breadcrumbs'
        ));
    }
}
