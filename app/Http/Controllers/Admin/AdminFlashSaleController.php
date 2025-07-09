<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class AdminFlashSaleController extends Controller
{
    /**
     * Display a listing of all flash sales created by sellers.
     */
    public function index(Request $request)
    {
        $query = FlashSale::with(['products.seller', 'products.images'])
            ->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('slug', 'like', "%{$searchTerm}%")
                    ->orWhereHas('products', function ($productQuery) use ($searchTerm) {
                        $productQuery->where('title', 'like', "%{$searchTerm}%")
                            ->orWhereHas('seller', function ($sellerQuery) use ($searchTerm) {
                                $sellerQuery->where('name', 'like', "%{$searchTerm}%");
                            });
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by discount type
        if ($request->filled('discount_type')) {
            $query->where('discount_type', $request->discount_type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('start_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('end_at', '<=', $request->date_to);
        }

        $flashSales = $query->paginate(15)->withQueryString();

        // Get filter options
        $statusOptions = FlashSale::getStatusOptions();
        $discountTypeOptions = FlashSale::getDiscountTypeOptions();

        return view('admin.flash-sales.index', compact('flashSales', 'statusOptions', 'discountTypeOptions'));
    }

    /**
     * Display the specified flash sale with all details.
     */
    public function show(FlashSale $flashSale)
    {
        $flashSale->load([
            'products.seller',
            'products.images',
            'products.category'
        ]);

        // Calculate statistics
        $stats = [
            'total_products' => $flashSale->products->count(),
            'total_stock' => $flashSale->getTotalStock(),
            'total_sellers' => $flashSale->products->pluck('seller_id')->unique()->count(),
            'avg_discount_amount' => $flashSale->products->avg(function ($product) use ($flashSale) {
                return $flashSale->getDiscountAmount($product);
            }),
            'total_original_value' => $flashSale->products->sum('price_regular'),
            'total_discounted_value' => $flashSale->products->sum(function ($product) use ($flashSale) {
                return $flashSale->getDiscountedPrice($product);
            }),
        ];

        // Group products by seller
        $productsBySeller = $flashSale->products->groupBy('seller.name');

        return view('admin.flash-sales.show', compact('flashSale', 'stats', 'productsBySeller'));
    }
}
