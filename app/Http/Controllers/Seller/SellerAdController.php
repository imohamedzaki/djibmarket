<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerAdController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the seller's ads.
     */
    public function index(Request $request)
    {
        $seller = Auth::guard('seller')->user();

        $query = $seller->ads()->latest();

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by ad slot if provided
        if ($request->filled('slot')) {
            $query->where('ad_slot', $request->slot);
        }

        // Search by title and description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('headline', 'like', "%{$search}%");
            });
        }

        $ads = $query->paginate(15)->appends($request->query());

        $statusCounts = [
            'all' => $seller->ads()->count(),
            'pending' => $seller->ads()->pending()->count(),
            'approved' => $seller->ads()->approved()->count(),
            'active' => $seller->ads()->active()->count(),
            'paused' => $seller->ads()->where('status', SellerAd::STATUS_PAUSED)->count(),
            'completed' => $seller->ads()->where('status', SellerAd::STATUS_COMPLETED)->count(),
            'rejected' => $seller->ads()->rejected()->count(),
        ];
        return view('seller.ads.index', compact('ads', 'statusCounts'));
    }

    /**
     * Show the form for creating a new ad.
     */
    public function create()
    {
        // Authorize: Ensure the seller can create ads (status must be active)
        $this->authorize('create', SellerAd::class);

        $adSlots = SellerAd::AD_SLOTS;
        $defaultColors = SellerAd::getDefaultColors();

        return view('seller.ads.create', compact('adSlots', 'defaultColors'));
    }

    /**
     * Store a newly created ad in storage.
     */
    public function store(Request $request)
    {
        // Authorize: Ensure the seller can create ads (status must be active)
        $this->authorize('create', SellerAd::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'ad_slot' => [
                'required',
                Rule::in(array_keys(SellerAd::AD_SLOTS))
            ],
            'headline' => 'nullable|string|max:255',
            'sub_headline' => 'nullable|string|max:255',
            'call_to_action_text' => 'required|string|max:50',
            'call_to_action_url' => 'nullable|url|max:255',
            'ad_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Pricing
            'pricing_type' => 'required|in:daily,per_view',
            'total_budget' => 'nullable|numeric|min:0|max:9999999999.99',

            // Campaign Duration
            'start_date' => 'required|date|after_or_equal:today',
            'duration_type' => 'required|in:end_date,duration_days',
            'end_date' => 'nullable|date|after:start_date',
            'duration_days' => 'nullable|integer|min:1|max:365',

            // Limits
            'max_views' => 'nullable|integer|min:1|max:9999999999',
            'max_clicks' => 'nullable|integer|min:1|max:9999999999',

            // Colors
            'background_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'heading_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_bg_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_text_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        // Validate duration logic
        if ($validated['duration_type'] === 'end_date') {
            $request->validate([
                'end_date' => 'required|date|after:start_date'
            ]);
        } else {
            $request->validate([
                'duration_days' => 'required|integer|min:1|max:365'
            ]);
        }

        $seller = Auth::guard('seller')->user();

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('ad_image')) {
            $imagePath = $request->file('ad_image')->store('seller-ads', 'public');
        }

        // Prepare custom colors
        $customColors = [
            'background' => $validated['background_color'] ?? SellerAd::getDefaultColors()['background'],
            'text' => $validated['text_color'] ?? SellerAd::getDefaultColors()['text'],
            'heading' => $validated['heading_color'] ?? SellerAd::getDefaultColors()['heading'],
            'button_bg' => $validated['button_bg_color'] ?? SellerAd::getDefaultColors()['button_bg'],
            'button_text' => $validated['button_text_color'] ?? SellerAd::getDefaultColors()['button_text'],
        ];

        // Calculate rates
        $dailyRate = 5000.00; // Fixed rate in DJF
        $perViewRate = 2.50; // Fixed rate in DJF

        // Prepare ad data
        $adData = [
            'seller_id' => $seller->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'ad_slot' => $validated['ad_slot'],
            'headline' => $validated['headline'],
            'sub_headline' => $validated['sub_headline'],
            'call_to_action_text' => $validated['call_to_action_text'],
            'call_to_action_url' => $validated['call_to_action_url'],
            'ad_image' => $imagePath,
            'custom_colors' => $customColors,
            'pricing_type' => $validated['pricing_type'],
            'daily_rate' => $dailyRate,
            'per_view_rate' => $perViewRate,
            'total_budget' => $validated['total_budget'],
            'start_date' => $validated['start_date'],
            'max_views' => $validated['max_views'],
            'max_clicks' => $validated['max_clicks'],
            'status' => SellerAd::STATUS_PENDING,
        ];

        // Set end date based on duration type
        if ($validated['duration_type'] === 'end_date') {
            $adData['end_date'] = $validated['end_date'];
        } else {
            $adData['duration_days'] = $validated['duration_days'];
        }

        $ad = SellerAd::create($adData);

        return redirect()
            ->route('seller.ads.show', $ad)
            ->with('success', 'Advertisement request submitted successfully! It will be reviewed by our admin team.');
    }

    /**
     * Display the specified ad.
     */
    public function show(SellerAd $ad)
    {
        $this->authorize('view', $ad);

        // Get stats for the ad
        $dailyStats = $ad->stats()
            ->selectRaw('DATE(event_time) as date, event_type, COUNT(*) as count')
            ->where('event_time', '>=', now()->subDays(30))
            ->groupBy('date', 'event_type')
            ->orderBy('date')
            ->get()
            ->groupBy('date');

        return view('seller.ads.show', compact('ad', 'dailyStats'));
    }

    /**
     * Show the form for editing the specified ad.
     */
    public function edit(SellerAd $ad)
    {
        $this->authorize('update', $ad);

        // Only allow editing pending or rejected ads
        if (!in_array($ad->status, [SellerAd::STATUS_PENDING, SellerAd::STATUS_REJECTED])) {
            return redirect()
                ->route('seller.ads.show', $ad)
                ->with('error', 'You can only edit pending or rejected advertisements.');
        }

        $adSlots = SellerAd::AD_SLOTS;
        $defaultColors = SellerAd::getDefaultColors();

        return view('seller.ads.edit', compact('ad', 'adSlots', 'defaultColors'));
    }

    /**
     * Update the specified ad in storage.
     */
    public function update(Request $request, SellerAd $ad)
    {
        $this->authorize('update', $ad);

        // Only allow updating pending or rejected ads
        if (!in_array($ad->status, [SellerAd::STATUS_PENDING, SellerAd::STATUS_REJECTED])) {
            return redirect()
                ->route('seller.ads.show', $ad)
                ->with('error', 'You can only edit pending or rejected advertisements.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'ad_slot' => [
                'required',
                Rule::in(array_keys(SellerAd::AD_SLOTS))
            ],
            'headline' => 'nullable|string|max:255',
            'sub_headline' => 'nullable|string|max:255',
            'call_to_action_text' => 'required|string|max:50',
            'call_to_action_url' => 'nullable|url|max:255',
            'ad_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Pricing
            'pricing_type' => 'required|in:daily,per_view',
            'total_budget' => 'nullable|numeric|min:0|max:9999999999.99',

            // Campaign Duration
            'start_date' => 'required|date|after_or_equal:today',
            'duration_type' => 'required|in:end_date,duration_days',
            'end_date' => 'nullable|date|after:start_date',
            'duration_days' => 'nullable|integer|min:1|max:365',

            // Limits
            'max_views' => 'nullable|integer|min:1|max:9999999999',
            'max_clicks' => 'nullable|integer|min:1|max:9999999999',

            // Colors
            'background_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'text_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'heading_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_bg_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'button_text_color' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        // Validate duration logic
        if ($validated['duration_type'] === 'end_date') {
            $request->validate([
                'end_date' => 'required|date|after:start_date'
            ]);
        } else {
            $request->validate([
                'duration_days' => 'required|integer|min:1|max:365'
            ]);
        }

        // Handle image upload
        if ($request->hasFile('ad_image')) {
            // Delete old image
            if ($ad->ad_image) {
                Storage::disk('public')->delete($ad->ad_image);
            }
            $validated['ad_image'] = $request->file('ad_image')->store('seller-ads', 'public');
        }

        // Prepare custom colors
        $customColors = [
            'background' => $validated['background_color'] ?? $ad->custom_colors['background'] ?? SellerAd::getDefaultColors()['background'],
            'text' => $validated['text_color'] ?? $ad->custom_colors['text'] ?? SellerAd::getDefaultColors()['text'],
            'heading' => $validated['heading_color'] ?? $ad->custom_colors['heading'] ?? SellerAd::getDefaultColors()['heading'],
            'button_bg' => $validated['button_bg_color'] ?? $ad->custom_colors['button_bg'] ?? SellerAd::getDefaultColors()['button_bg'],
            'button_text' => $validated['button_text_color'] ?? $ad->custom_colors['button_text'] ?? SellerAd::getDefaultColors()['button_text'],
        ];

        $validated['custom_colors'] = $customColors;

        // Set end date based on duration type
        if ($validated['duration_type'] === 'end_date') {
            $validated['end_date'] = $validated['end_date'];
            $validated['duration_days'] = null;
        } else {
            $validated['duration_days'] = $validated['duration_days'];
            $validated['end_date'] = null;
        }

        // Reset status to pending if it was rejected
        if ($ad->status === SellerAd::STATUS_REJECTED) {
            $validated['status'] = SellerAd::STATUS_PENDING;
            $validated['admin_notes'] = null;
        }

        // Remove fields not in fillable
        unset($validated['duration_type'], $validated['background_color'], $validated['text_color'], $validated['heading_color'], $validated['button_bg_color'], $validated['button_text_color']);

        $ad->update($validated);

        return redirect()
            ->route('seller.ads.show', $ad)
            ->with('success', 'Advertisement updated successfully!');
    }

    /**
     * Remove the specified ad from storage.
     */
    public function destroy(SellerAd $ad)
    {
        $this->authorize('delete', $ad);

        // Only allow deletion of pending, rejected, paused, or completed ads
        if (in_array($ad->status, [SellerAd::STATUS_ACTIVE, SellerAd::STATUS_APPROVED])) {
            return redirect()
                ->route('seller.ads.index')
                ->with('error', 'Cannot delete active or approved advertisements.');
        }

        $ad->delete();

        return redirect()
            ->route('seller.ads.index')
            ->with('success', 'Advertisement deleted successfully!');
    }

    /**
     * Pause the specified ad.
     */
    public function pause(SellerAd $ad)
    {
        $this->authorize('update', $ad);

        if (!$ad->is_active) {
            return redirect()
                ->route('seller.ads.show', $ad)
                ->with('error', 'Advertisement is not currently active.');
        }

        $ad->pause();

        return redirect()
            ->route('seller.ads.index')
            ->with('success', 'Advertisement paused successfully!');
    }

    /**
     * Resume the specified ad.
     */
    public function resume(SellerAd $ad)
    {
        $this->authorize('update', $ad);

        if (!$ad->resume()) {
            return redirect()
                ->route('seller.ads.show', $ad)
                ->with('error', 'Cannot resume this advertisement.');
        }

        return redirect()
            ->route('seller.ads.show', $ad)
            ->with('success', 'Advertisement resumed successfully!');
    }

    /**
     * Show analytics for the seller's ads.
     */
    public function analytics()
    {
        $seller = Auth::guard('seller')->user();

        $totalAds = $seller->ads()->count();
        $activeAds = $seller->ads()->active()->count();
        $totalViews = $seller->ads()->sum('current_views');
        $totalClicks = $seller->ads()->sum('current_clicks');
        $totalSpent = $seller->ads()->sum('current_cost');

        $ads = $seller->ads()
            ->with(['stats' => function ($query) {
                $query->where('event_time', '>=', now()->subDays(30));
            }])
            ->latest()
            ->get();

        return view('seller.ads.analytics', compact(
            'totalAds',
            'activeAds',
            'totalViews',
            'totalClicks',
            'totalSpent',
            'ads'
        ));
    }
}
