<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Promotion;

class AdminCampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created campaign in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('campaigns', 'public');
            $data['banner_image'] = $path;
        }

        // Set admin ID
        $data['admin_id'] = auth()->guard('admin')->id();

        Campaign::create($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    /**
     * Get data for editing a campaign using AJAX.
     */
    public function getEditData(Campaign $campaign)
    {
        return response()->json($campaign);
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old image if exists
            if ($campaign->banner_image) {
                Storage::disk('public')->delete($campaign->banner_image);
            }

            $path = $request->file('banner_image')->store('campaigns', 'public');
            $data['banner_image'] = $path;
        }

        $campaign->update($data);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        // Delete banner image if exists
        if ($campaign->banner_image) {
            Storage::disk('public')->delete($campaign->banner_image);
        }

        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully.');
    }

    /**
     * Delete the banner image for a campaign.
     */
    public function deleteBanner(Campaign $campaign)
    {
        try {
            // Delete banner image if exists
            if ($campaign->banner_image) {
                Storage::disk('public')->delete($campaign->banner_image);
                $campaign->banner_image = null;
                $campaign->save();
            }

            return response()->json(['success' => true, 'message' => 'Banner image deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete banner image.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a new promotion for the specified campaign.
     */
    public function storePromotion(Request $request, Campaign $campaign)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->with('error', 'Percentage discount cannot exceed 100%');
        }

        // Create the promotion
        $promotion = new Promotion([
            'name' => $request->name,
            'description' => $request->description,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'is_active' => $request->is_active ?? 0,
            'admin_id' => auth()->guard('admin')->id(),
            'campaign_id' => $campaign->id,
        ]);

        $promotion->save();

        return redirect()->route('admin.campaigns.show', $campaign->slug)
            ->with('success', 'Promotion added to campaign successfully.');
    }

    /**
     * Display the specified promotion.
     */
    public function showPromotion(Campaign $campaign, Promotion $promotion)
    {
        // Check if the promotion belongs to the campaign
        if ($promotion->campaign_id !== $campaign->id) {
            return abort(404);
        }

        return view('admin.campaigns.promotions.show', compact('campaign', 'promotion'));
    }

    /**
     * Show the form for editing the specified promotion.
     */
    public function editPromotion(Campaign $campaign, Promotion $promotion)
    {
        // Check if the promotion belongs to the campaign
        if ($promotion->campaign_id !== $campaign->id) {
            return abort(404);
        }

        return view('admin.campaigns.promotions.edit', compact('campaign', 'promotion'));
    }

    /**
     * Update the specified promotion in storage.
     */
    public function updatePromotion(Request $request, Campaign $campaign, Promotion $promotion)
    {
        // Check if the promotion belongs to the campaign
        if ($promotion->campaign_id !== $campaign->id) {
            return abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Additional validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return back()->with('error', 'Percentage discount cannot exceed 100%');
        }

        $promotion->update([
            'name' => $request->name,
            'description' => $request->description,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'is_active' => $request->is_active ?? 0,
        ]);

        return redirect()->route('admin.campaigns.show', $campaign->slug)
            ->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified promotion from storage.
     */
    public function destroyPromotion(Campaign $campaign, Promotion $promotion)
    {
        // Check if the promotion belongs to the campaign
        if ($promotion->campaign_id !== $campaign->id) {
            return abort(404);
        }

        $promotion->delete();

        return redirect()->route('admin.campaigns.show', $campaign->slug)
            ->with('success', 'Promotion deleted successfully.');
    }
}
