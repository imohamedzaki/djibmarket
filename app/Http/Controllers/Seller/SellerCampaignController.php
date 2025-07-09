<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerCampaignController extends Controller
{
    /**
     * Display a listing of available campaigns.
     */
    public function index()
    {
        // Get active campaigns
        $campaigns = Campaign::where('is_active', true)
            ->where('end_date', '>=', now())
            ->latest()
            ->paginate(10);

        return view('seller.campaigns.index', compact('campaigns'));
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        // Check if campaign is active
        if (!$campaign->is_active || $campaign->end_date < now()) {
            return redirect()->route('seller.campaigns.index')
                ->with('error', 'This campaign is no longer active.');
        }

        // Get seller's promotion for this campaign if exists
        $promotion = Promotion::where('campaign_id', $campaign->id)
            ->where('seller_id', Auth::guard('seller')->id())
            ->first();

        return view('seller.campaigns.show', compact('campaign', 'promotion'));
    }

    /**
     * Show the form for creating a new promotion for a campaign.
     */
    public function createPromotion(Campaign $campaign)
    {
        // Check if seller already has a promotion for this campaign
        $existingPromotion = Promotion::where('campaign_id', $campaign->id)
            ->where('seller_id', Auth::guard('seller')->id())
            ->first();

        if ($existingPromotion) {
            return redirect()->route('seller.campaigns.promotions.edit', $existingPromotion->id)
                ->with('info', 'You already have a promotion for this campaign.');
        }

        // Get the products owned by the seller
        $products = Product::where('seller_id', Auth::guard('seller')->id())->get();

        return view('seller.campaigns.promotions.create', compact('campaign', 'products'));
    }

    /**
     * Store a newly created promotion in storage.
     */
    public function storePromotion(Request $request, Campaign $campaign)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date|after_or_equal:today',
            'end_at' => 'required|date|after:start_at|before_or_equal:' . $campaign->end_date,
            'promotion_type' => 'required|string',
            'discount_value' => 'required_if:promotion_type,percentage_discount,fixed_amount_discount|nullable|numeric|min:0',
            'min_purchase_amount' => 'nullable|numeric|min:0',
            'required_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer|min:1',
            'free_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer|min:1',
            'free_product_id' => 'nullable|exists:products,id',
            'usage_limit' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|max:2048',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Handle banner image upload if provided
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('promotion_banners', 'public');
            $validated['banner_image'] = $path;
        }

        // Create the promotion
        $promotion = new Promotion([
            'campaign_id' => $campaign->id,
            'seller_id' => Auth::guard('seller')->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'],
            'is_active' => true,
            'banner_image' => $validated['banner_image'] ?? null,
            'promotion_type' => $validated['promotion_type'],
            'discount_value' => $validated['discount_value'] ?? null,
            'min_purchase_amount' => $validated['min_purchase_amount'] ?? null,
            'required_quantity' => $validated['required_quantity'] ?? null,
            'free_quantity' => $validated['free_quantity'] ?? null,
            'free_product_id' => $validated['free_product_id'] ?? null,
            'usage_limit' => $validated['usage_limit'] ?? null,
        ]);

        $promotion->save();

        // Attach products to the promotion
        $promotion->products()->attach($validated['product_ids']);

        return redirect()->route('seller.campaigns.promotions.show', $promotion->id)
            ->with('success', 'Promotion created successfully.');
    }

    /**
     * Display the specified promotion.
     */
    public function showPromotion(Promotion $promotion)
    {
        // Check if promotion belongs to the authenticated seller
        if ($promotion->seller_id !== Auth::guard('seller')->id()) {
            abort(403);
        }

        $campaign = $promotion->campaign;
        $products = $promotion->products;

        return view('seller.campaigns.promotions.show', compact('promotion', 'campaign', 'products'));
    }

    /**
     * Show the form for editing the specified promotion.
     */
    public function editPromotion(Promotion $promotion)
    {
        // Check if promotion belongs to the authenticated seller
        if ($promotion->seller_id !== Auth::guard('seller')->id()) {
            abort(403);
        }

        $campaign = $promotion->campaign;
        $products = Product::where('seller_id', Auth::guard('seller')->id())->get();
        $selectedProductIds = $promotion->products->pluck('id')->toArray();

        return view('seller.campaigns.promotions.edit', compact('promotion', 'campaign', 'products', 'selectedProductIds'));
    }

    /**
     * Update the specified promotion in storage.
     */
    public function updatePromotion(Request $request, Promotion $promotion)
    {
        // Check if promotion belongs to the authenticated seller
        if ($promotion->seller_id !== Auth::guard('seller')->id()) {
            abort(403);
        }

        // Get campaign for validation
        $campaign = $promotion->campaign;

        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at|before_or_equal:' . $campaign->end_date,
            'promotion_type' => 'required|string',
            'discount_value' => 'required_if:promotion_type,percentage_discount,fixed_amount_discount|nullable|numeric|min:0',
            'min_purchase_amount' => 'nullable|numeric|min:0',
            'required_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer|min:1',
            'free_quantity' => 'required_if:promotion_type,buy_x_get_y_free|nullable|integer|min:1',
            'free_product_id' => 'nullable|exists:products,id',
            'usage_limit' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|max:2048',
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => 'exists:products,id',
        ]);

        // Handle banner image upload if provided
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('promotion_banners', 'public');
            $validated['banner_image'] = $path;
        }

        // Update the promotion
        $promotion->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'start_at' => $validated['start_at'],
            'end_at' => $validated['end_at'],
            'promotion_type' => $validated['promotion_type'],
            'discount_value' => $validated['discount_value'] ?? null,
            'min_purchase_amount' => $validated['min_purchase_amount'] ?? null,
            'required_quantity' => $validated['required_quantity'] ?? null,
            'free_quantity' => $validated['free_quantity'] ?? null,
            'free_product_id' => $validated['free_product_id'] ?? null,
            'usage_limit' => $validated['usage_limit'] ?? null,
        ]);

        if (isset($validated['banner_image'])) {
            $promotion->banner_image = $validated['banner_image'];
            $promotion->save();
        }

        // Sync products to the promotion
        $promotion->products()->sync($validated['product_ids']);

        return redirect()->route('seller.campaigns.promotions.show', $promotion->id)
            ->with('success', 'Promotion updated successfully.');
    }
}