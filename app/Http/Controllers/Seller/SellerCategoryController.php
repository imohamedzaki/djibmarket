<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerCategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $sellerId = Auth::guard('seller')->id();

        $categories = Category::with('parent')
            ->withCount(['products' => function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            }])
            ->get();

        return view('seller.categories.index', compact('categories'));
    }

    /**
     * Display products for the specified category.
     */
    public function products($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->where('seller_id', Auth::guard('seller')->id())
            ->get();

        return view('seller.categories.products', compact('category', 'products'));
    }
}