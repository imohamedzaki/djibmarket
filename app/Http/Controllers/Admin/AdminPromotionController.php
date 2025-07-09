<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Campaign;
use App\Models\Product;
use App\Enums\PromotionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class AdminPromotionController extends Controller
{
    /**
     * Display a listing of the promotions.
     */
    public function index()
    {
        $promotions = Promotion::with(['campaign', 'admin', 'seller', 'products'])
            ->latest()
            ->paginate(10);

        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new promotion.
     */
    public function create()
    {
        $promotionTypes = PromotionType::cases();
        $campaigns = Campaign::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();
        $products = Product::with('seller')->get();

        return view('admin.promotions.create', compact('promotionTypes', 'campaigns', 'products'));
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function store(Request $request)
    {
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

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('promotions', 'public');
            $validated['banner_image'] = $path;
        }

        // Set admin_id
        $validated['admin_id'] = auth()->guard('admin')->id();

        // Create the promotion
        $promotion = Promotion::create($validated);

        // Attach products to the promotion
        $promotion->products()->attach($request->products);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion created successfully.');
    }

    /**
     * Display the specified promotion.
     */
    public function show(Promotion $promotion)
    {
        $promotion->load(['campaign', 'admin', 'seller', 'products.seller', 'freeProduct']);

        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified promotion.
     */
    public function edit(Promotion $promotion)
    {
        // Check if the admin can edit this promotion (only if they created it)
        if ($promotion->admin_id !== auth()->guard('admin')->id()) {
            return redirect()->route('admin.promotions.index')
                ->with('error', 'You can only edit promotions that you created.');
        }

        $promotionTypes = PromotionType::cases();
        $campaigns = Campaign::where('is_active', true)
            ->where('end_date', '>', now())
            ->get();
        $products = Product::with('seller')->get();
        $selectedProductIds = $promotion->products->pluck('id')->toArray();

        return view('admin.promotions.edit', compact('promotion', 'promotionTypes', 'campaigns', 'products', 'selectedProductIds'));
    }

    /**
     * Update the specified promotion in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        // Check if the admin can update this promotion (only if they created it)
        if ($promotion->admin_id !== auth()->guard('admin')->id()) {
            return redirect()->route('admin.promotions.index')
                ->with('error', 'You can only edit promotions that you created.');
        }

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
        $promotion->products()->sync($request->products);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified promotion from storage.
     */
    public function destroy(Promotion $promotion)
    {
        // Check if the admin can delete this promotion (only if they created it)
        if ($promotion->admin_id !== auth()->guard('admin')->id()) {
            return redirect()->route('admin.promotions.index')
                ->with('error', 'You can only delete promotions that you created.');
        }

        // Delete banner image if exists
        if ($promotion->banner_image) {
            Storage::disk('public')->delete($promotion->banner_image);
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion deleted successfully.');
    }

    /**
     * Get data for editing a promotion using AJAX.
     */
    public function getEditData(Promotion $promotion)
    {
        // Check if the admin can edit this promotion (only if they created it)
        if ($promotion->admin_id !== auth()->guard('admin')->id()) {
            return response()->json(['error' => 'You can only edit promotions that you created.'], 403);
        }

        $promotion->load(['products']);
        $promotion->selected_product_ids = $promotion->products->pluck('id');

        return response()->json($promotion);
    }
}