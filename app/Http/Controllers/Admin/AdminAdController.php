<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Seller;
use App\Models\SellerAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAdController extends Controller
{
    /**
     * Display a listing of all ad requests.
     */
    public function index(Request $request)
    {
        $query = SellerAd::with(['seller'])->latest();

        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by ad slot if provided
        if ($request->filled('ad_slot')) {
            $query->where('ad_slot', $request->ad_slot);
        }

        // Search by title or seller name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhereHas('seller', function ($sellerQuery) use ($search) {
                        $sellerQuery->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $ads = $query->paginate(20);

        $statusCounts = [
            'all' => SellerAd::count(),
            'pending' => SellerAd::pending()->count(),
            'approved' => SellerAd::approved()->count(),
            'active' => SellerAd::active()->count(),
            'paused' => SellerAd::where('status', SellerAd::STATUS_PAUSED)->count(),
            'completed' => SellerAd::where('status', SellerAd::STATUS_COMPLETED)->count(),
            'rejected' => SellerAd::rejected()->count(),
        ];

        return view('admin.ads.index', compact('ads', 'statusCounts'));
    }

    /**
     * Show the form for creating a new advertisement.
     */
    public function create()
    {
        $sellers = Seller::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.ads.create', compact('sellers'));
    }

    /**
     * Store a newly created advertisement (automatically approved since created by admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'ad_slot' => 'required|in:' . implode(',', array_keys(SellerAd::AD_SLOTS)),
            'duration_type' => 'required|in:date_range,duration_days,views_based',
            'start_date' => 'required_if:duration_type,date_range|nullable|date|after_or_equal:today',
            'end_date' => 'required_if:duration_type,date_range|nullable|date|after:start_date',
            'duration_days' => 'required_if:duration_type,duration_days|nullable|integer|min:1|max:365',
            'max_views' => 'required_if:duration_type,views_based|nullable|integer|min:100',
            'max_clicks' => 'nullable|integer|min:1',
            'daily_budget' => 'nullable|numeric|min:0',
            'cost_per_view' => 'nullable|numeric|min:0',
            'target_url' => 'nullable|url|max:500',
            'button_text' => 'nullable|string|max:50',
            'custom_css' => 'nullable|string|max:2000',
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'text_color' => 'nullable|string|max:7',
            'background_color' => 'nullable|string|max:7',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->except(['image']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('ads', $imageName, 'public');
                $data['image_path'] = $imagePath;
            }

            // Set dates based on duration type
            if ($request->duration_type === 'duration_days') {
                $data['start_date'] = now()->startOfDay();
                $data['end_date'] = now()->addDays($request->duration_days)->endOfDay();
            } elseif ($request->duration_type === 'views_based') {
                $data['start_date'] = now()->startOfDay();
                $data['end_date'] = null; // Will be set when max views reached
            }

            // Calculate budget
            $data['total_budget'] = $this->calculateBudget($request);

            // Admin-created ads are automatically approved and active
            $data['status'] = 'approved';
            $data['approved_by'] = auth('admin')->id();
            $data['approved_at'] = now();

            $ad = SellerAd::create($data);

            // Automatically set to active if start date is today or before
            if ($ad->start_date && $ad->start_date <= now()) {
                $ad->update(['status' => 'active']);
            }

            DB::commit();

            return redirect()
                ->route('admin.ads.index')
                ->with('success', 'Advertisement created successfully and automatically approved!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create advertisement: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified ad request.
     */
    public function show(SellerAd $ad)
    {
        $ad->load(['seller', 'stats', 'approvedBy']);

        // Get performance stats
        $totalViews = $ad->stats()->views()->count();
        $totalClicks = $ad->stats()->clicks()->count();
        $clickThroughRate = $totalViews > 0 ? ($totalClicks / $totalViews) * 100 : 0;

        // Get daily stats for the last 30 days
        $dailyStats = $ad->stats()
            ->selectRaw('DATE(event_time) as date, event_type, COUNT(*) as count')
            ->where('event_time', '>=', now()->subDays(30))
            ->groupBy('date', 'event_type')
            ->orderBy('date')
            ->get()
            ->groupBy('date');

        // Get recent activity
        $recentActivity = $ad->stats()
            ->with('buyer')
            ->latest('event_time')
            ->take(20)
            ->get();

        return view('admin.ads.show', compact(
            'ad',
            'totalViews',
            'totalClicks',
            'clickThroughRate',
            'dailyStats',
            'recentActivity'
        ));
    }

    /**
     * Approve an ad request.
     */
    public function approve(Request $request, SellerAd $ad)
    {
        if ($ad->status !== SellerAd::STATUS_PENDING) {
            return redirect()
                ->route('admin.ads.show', $ad)
                ->with('error', 'Only pending advertisements can be approved.');
        }

        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $admin = Auth::guard('admin')->user();
        $ad->approve($admin, $request->admin_notes);

        // Auto-activate if start date is today or in the past
        if ($ad->start_date <= today()) {
            $ad->activate();
        }

        return redirect()
            ->route('admin.ads.show', $ad)
            ->with('success', 'Advertisement approved successfully!');
    }

    /**
     * Reject an ad request.
     */
    public function reject(Request $request, SellerAd $ad)
    {
        if ($ad->status !== SellerAd::STATUS_PENDING) {
            return redirect()
                ->route('admin.ads.show', $ad)
                ->with('error', 'Only pending advertisements can be rejected.');
        }

        $request->validate([
            'admin_notes' => 'required|string|max:1000',
        ]);

        $admin = Auth::guard('admin')->user();
        $ad->reject($admin, $request->admin_notes);

        return redirect()
            ->route('admin.ads.show', $ad)
            ->with('success', 'Advertisement rejected.');
    }

    /**
     * Pause an active ad.
     */
    public function pause(Request $request, SellerAd $ad)
    {
        if (!$ad->is_active) {
            return redirect()
                ->route('admin.ads.show', $ad)
                ->with('error', 'Advertisement is not currently active.');
        }

        $request->validate([
            'pause_reason' => 'nullable|string|max:500',
        ]);

        $ad->pause($request->pause_reason ?: 'manually_paused');

        return redirect()
            ->route('admin.ads.show', $ad)
            ->with('success', 'Advertisement paused successfully!');
    }

    /**
     * Resume a paused ad.
     */
    public function resume(SellerAd $ad)
    {
        if (!$ad->resume()) {
            return redirect()
                ->route('admin.ads.show', $ad)
                ->with('error', 'Cannot resume this advertisement.');
        }

        return redirect()
            ->route('admin.ads.show', $ad)
            ->with('success', 'Advertisement resumed successfully!');
    }

    /**
     * Remove the specified ad.
     */
    public function destroy(SellerAd $ad)
    {
        // Only allow deletion of pending, rejected, or completed ads
        if (in_array($ad->status, [SellerAd::STATUS_ACTIVE, SellerAd::STATUS_APPROVED])) {
            return redirect()
                ->route('admin.ads.index')
                ->with('error', 'Cannot delete active or approved advertisements.');
        }

        $ad->delete();

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Advertisement deleted successfully!');
    }

    /**
     * Bulk operations on multiple ads.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,pause,resume,delete',
            'ads' => 'required|array|min:1',
            'ads.*' => 'exists:seller_ads,id',
            'bulk_admin_notes' => 'nullable|string|max:1000',
        ]);

        $ads = SellerAd::whereIn('id', $request->ads)->get();
        $admin = Auth::guard('admin')->user();
        $successCount = 0;

        foreach ($ads as $ad) {
            switch ($request->action) {
                case 'approve':
                    if ($ad->status === SellerAd::STATUS_PENDING) {
                        $ad->approve($admin, $request->bulk_admin_notes);
                        if ($ad->start_date <= today()) {
                            $ad->activate();
                        }
                        $successCount++;
                    }
                    break;

                case 'reject':
                    if ($ad->status === SellerAd::STATUS_PENDING) {
                        $ad->reject($admin, $request->bulk_admin_notes ?: 'Bulk rejection');
                        $successCount++;
                    }
                    break;

                case 'pause':
                    if ($ad->is_active) {
                        $ad->pause('manually_paused');
                        $successCount++;
                    }
                    break;

                case 'resume':
                    if ($ad->resume()) {
                        $successCount++;
                    }
                    break;

                case 'delete':
                    if (!in_array($ad->status, [SellerAd::STATUS_ACTIVE, SellerAd::STATUS_APPROVED])) {
                        $ad->delete();
                        $successCount++;
                    }
                    break;
            }
        }

        $actionLabels = [
            'approve' => 'approved',
            'reject' => 'rejected',
            'pause' => 'paused',
            'resume' => 'resumed',
            'delete' => 'deleted',
        ];

        return redirect()
            ->route('admin.ads.index')
            ->with('success', "Successfully {$actionLabels[$request->action]} {$successCount} advertisement(s).");
    }

    /**
     * Show analytics dashboard for all ads.
     */
    public function analytics()
    {
        $totalAds = SellerAd::count();
        $activeAds = SellerAd::active()->count();
        $pendingAds = SellerAd::pending()->count();
        $totalViews = SellerAd::sum('current_views');
        $totalClicks = SellerAd::sum('current_clicks');
        $totalRevenue = SellerAd::sum('current_cost');

        // Performance by ad slot
        $slotPerformance = SellerAd::selectRaw('
                ad_slot,
                COUNT(*) as total_ads,
                SUM(current_views) as total_views,
                SUM(current_clicks) as total_clicks,
                SUM(current_cost) as total_revenue
            ')
            ->groupBy('ad_slot')
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    SellerAd::AD_SLOTS[$item->ad_slot] ?? $item->ad_slot => [
                        'total_ads' => $item->total_ads,
                        'total_views' => $item->total_views,
                        'total_clicks' => $item->total_clicks,
                        'total_revenue' => $item->total_revenue,
                        'ctr' => $item->total_views > 0 ? ($item->total_clicks / $item->total_views) * 100 : 0,
                    ]
                ];
            });

        // Top performing ads
        $topAds = SellerAd::with('seller')
            ->where('current_views', '>', 0)
            ->orderByDesc('current_views')
            ->take(10)
            ->get();

        // Recent activity
        $recentActivity = SellerAd::with('seller')
            ->latest()
            ->take(15)
            ->get();

        return view('admin.ads.analytics', compact(
            'totalAds',
            'activeAds',
            'pendingAds',
            'totalViews',
            'totalClicks',
            'totalRevenue',
            'slotPerformance',
            'topAds',
            'recentActivity'
        ));
    }

    /**
     * Export ads data.
     */
    public function export(Request $request)
    {
        $request->validate([
            'format' => 'required|in:csv,xlsx',
            'status' => 'nullable|in:pending,approved,active,paused,completed,rejected',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // This would implement CSV/Excel export functionality
        // For now, return a placeholder response
        return redirect()
            ->route('admin.ads.index')
            ->with('info', 'Export functionality will be implemented in a future update.');
    }

    /**
     * Calculate total budget based on pricing model.
     */
    private function calculateBudget(Request $request)
    {
        if ($request->duration_type === 'date_range' || $request->duration_type === 'duration_days') {
            // Daily budget model
            $days = $request->duration_type === 'date_range'
                ? now()->parse($request->start_date)->diffInDays(now()->parse($request->end_date)) + 1
                : $request->duration_days;

            $dailyRate = $request->daily_budget ?: 5000; // Default 5000 DJF per day
            return $days * $dailyRate;
        } elseif ($request->duration_type === 'views_based') {
            // Per-view model
            $costPerView = $request->cost_per_view ?: 2.5; // Default 2.5 DJF per view
            return $request->max_views * $costPerView;
        }

        return 0;
    }
}