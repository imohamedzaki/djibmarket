<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Campaign;
use App\Models\Product;
use App\Enums\PromotionType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerPromotionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the promotions.
     */
    public function index()
    {
        $seller = Auth::guard('seller')->user();
        $promotions = Promotion::where('seller_id', $seller->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create()
    {
        // Authorize: Ensure the seller can create promotions (status must be active)
        $this->authorize('create', Promotion::class);

        $seller = Auth::guard('seller')->user();
        $promotionTypes = PromotionType::cases();
        $products = Product::where('seller_id', $seller->id)->get();

        // Get active campaigns
        $campaigns = Campaign::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();

        return view('seller.promotions.create', compact('promotionTypes', 'products', 'campaigns'));
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function store(Request $request)
    {
        // Authorize: Ensure the seller can create promotions (status must be active)
        $this->authorize('create', Promotion::class);

        $seller = Auth::guard('seller')->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'is_active' => 'boolean',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'promotion_type' => ['required', new Enum(PromotionType::class)],
            'discount_value' => 'required_if:promotion_type,percentage_discount,fixed_amount_discount|nullable|numeric',
            'min_purchase_amount' => 'nullable|numeric',
            'required_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer',
            'free_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer',
            'free_product_id' => 'required_if:promotion_type,buy_x_get_y_free|nullable|exists:products,id',
            'usage_limit' => 'nullable|integer',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        // Make sure the seller can only select their own products
        $sellerProductIds = Product::where('seller_id', $seller->id)
            ->whereIn('id', $request->products)
            ->pluck('id')
            ->toArray();

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('promotions', 'public');
            $validated['banner_image'] = $path;
        }

        // Set seller_id
        $validated['seller_id'] = $seller->id;

        // Create the promotion
        $promotion = Promotion::create($validated);

        // Attach products to the promotion
        $promotion->products()->attach($sellerProductIds);

        return redirect()->route('seller.promotions.index')
            ->with('success', 'Promotion created successfully.');
    }

    /**
     * Display the specified promotion.
     */
    public function show(Promotion $promotion)
    {
        if (Gate::denies('view', $promotion)) {
            abort(403, 'Unauthorized action.');
        }
        return view('seller.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified promotion.
     */
    public function edit(Promotion $promotion)
    {
        if (Gate::denies('update', $promotion)) {
            abort(403, 'Unauthorized action.');
        }

        $seller = Auth::guard('seller')->user();
        $promotionTypes = PromotionType::cases();
        $products = Product::where('seller_id', $seller->id)->get();

        // Get active campaigns
        $campaigns = Campaign::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();

        // Get the IDs of the products currently attached to the promotion
        $selectedProductIds = $promotion->products->pluck('id')->toArray();

        return view('seller.promotions.edit', compact(
            'promotion',
            'promotionTypes',
            'products',
            'campaigns',
            'selectedProductIds'
        ));
    }

    /**
     * Update the specified promotion in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        if (Gate::denies('update', $promotion)) {
            abort(403, 'Unauthorized action.');
        }

        $seller = Auth::guard('seller')->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'is_active' => 'boolean',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'promotion_type' => ['required', new Enum(PromotionType::class)],
            'discount_value' => 'required_if:promotion_type,percentage_discount,fixed_amount_discount|nullable|numeric',
            'min_purchase_amount' => 'nullable|numeric',
            'required_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer',
            'free_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer',
            'free_product_id' => 'required_if:promotion_type,buy_x_get_y_free|nullable|exists:products,id',
            'usage_limit' => 'nullable|integer',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        // Make sure the seller can only select their own products
        $sellerProductIds = Product::where('seller_id', $seller->id)
            ->whereIn('id', $request->products)
            ->pluck('id')
            ->toArray();

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($promotion->banner_image) {
                Storage::disk('public')->delete($promotion->banner_image);
            }

            $path = $request->file('banner_image')->store('promotions', 'public');
            $validated['banner_image'] = $path;
        }

        // Update the promotion
        $promotion->update($validated);

        // Sync products
        $promotion->products()->sync($sellerProductIds);

        return redirect()->route('seller.promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified promotion from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if (Gate::denies('delete', $promotion)) {
            abort(403, 'Unauthorized action.');
        }

        // Delete banner image if exists
        if ($promotion->banner_image) {
            Storage::disk('public')->delete($promotion->banner_image);
        }

        $promotion->delete();

        return redirect()->route('seller.promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }
}
