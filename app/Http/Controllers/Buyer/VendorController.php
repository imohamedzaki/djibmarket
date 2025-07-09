<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\BusinessActivity;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function index(Request $request)
    {
        $query = Seller::where('status', 'active')
            ->with(['businessActivity', 'products']);

        // Filter by business activity if specified
        if ($request->has('industry') && $request->industry) {
            $query->where('business_activity_id', $request->industry);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('address', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
        }

        $perPage = $request->get('per_page', 30);
        $vendors = $query->paginate($perPage);

        // Get business activities for filtering
        $businessActivities = BusinessActivity::all();

        // Get vendor count by business activity for sidebar
        $vendorsByIndustry = Seller::where('status', 'active')
            ->selectRaw('business_activity_id, count(*) as count')
            ->groupBy('business_activity_id')
            ->with('businessActivity')
            ->get()
            ->keyBy('business_activity_id');

        return view('buyer.vendors.index', compact(
            'vendors',
            'businessActivities',
            'vendorsByIndustry'
        ));
    }

    /**
     * Display the specified vendor.
     */
    public function show(Request $request, Seller $vendor)
    {
        // Load vendor with related data
        $vendor->load(['businessActivity']);

        // Get vendor's products with sorting and pagination
        $query = $vendor->products()
            ->where('status', 'published')
            ->with(['category', 'images', 'reviews']);

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price_regular', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_regular', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
        }

        $perPage = $request->get('per_page', 20);
        $products = $query->paginate($perPage);

        // Calculate some stats
        $totalProducts = $vendor->products()->where('status', 'published')->count();
        $averageRating = $vendor->products()
            ->where('status', 'active')
            ->withAvg('reviews', 'rating')
            ->get()
            ->avg('reviews_avg_rating') ?? 0;

        $totalReviews = $vendor->products()
            ->where('status', 'active')
            ->withCount('reviews')
            ->get()
            ->sum('reviews_count');

        return view('buyer.vendors.show', compact(
            'vendor',
            'products',
            'totalProducts',
            'averageRating',
            'totalReviews'
        ));
    }
}