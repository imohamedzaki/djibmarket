<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerFlashSaleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of flash sales for the authenticated seller.
     */
    public function index()
    {
        $sellerId = Auth::guard('seller')->id();

        $flashSales = FlashSale::with(['products'])
            ->whereHas('products', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Get seller's products for creating new flash sales
        $products = Product::where('seller_id', $sellerId)
            ->where('status', 'published')
            ->orderBy('title')
            ->get();

        return view('seller.flash-sales.index', compact('flashSales', 'products'));
    }

    /**
     * Show the form for creating a new flash sale.
     */
    public function create()
    {
        // Authorize: Ensure the seller can create flash sales (status must be active)
        $this->authorize('create', FlashSale::class);

        $sellerId = Auth::guard('seller')->id();

        $products = Product::where('seller_id', $sellerId)
            ->where('status', 'published')
            ->orderBy('title')
            ->get();

        return view('seller.flash-sales.create', compact('products'));
    }

    /**
     * Store a newly created flash sale in storage.
     */
    public function store(Request $request)
    {
        // Authorize: Ensure the seller can create flash sales (status must be active)
        $this->authorize('create', FlashSale::class);

        $sellerId = Auth::guard('seller')->id();

        $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => [
                'required',
                'exists:products,id',
                Rule::exists('products', 'id')->where(function ($query) use ($sellerId) {
                    return $query->where('seller_id', $sellerId);
                }),
            ],
            'title' => 'required|string|max:255',
            'start_at' => 'required|date|after_or_equal:now',
            'end_at' => 'required|date|after:start_at',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'status' => 'required|in:' . implode(',', [
                FlashSale::STATUS_INACTIVE,
                FlashSale::STATUS_ACTIVE,
                FlashSale::STATUS_ENDED
            ])
        ], [
            'product_ids.*.exists' => 'You can only create flash sales for your own products.',
            'start_at.after_or_equal' => 'Start date must be today or in the future.',
            'end_at.after' => 'End date must be after start date.',
            'product_ids.required' => 'You must select at least one product.',
        ]);

        // Additional validation for discount value
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return redirect()->back()
                ->withErrors(['discount_value' => 'Percentage discount cannot be more than 100%.'])
                ->withInput();
        }

        // Check for existing active flash sales for these products
        $existingFlashSales = FlashSaleProduct::whereIn('product_id', $request->product_ids)
            ->whereHas('flashSale', function ($query) {
                $query->where('status', FlashSale::STATUS_ACTIVE)
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('start_at', '<=', now())
                            ->where('end_at', '>=', now());
                    });
            })
            ->with('product')
            ->get();

        if ($existingFlashSales->isNotEmpty()) {
            $conflictingProducts = $existingFlashSales->pluck('product.title')->join(', ');
            return redirect()->back()
                ->withErrors(['product_ids' => "The following products already have active flash sales: {$conflictingProducts}"])
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $flashSale = FlashSale::create([
                'title' => $request->title,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'discount_type' => $request->discount_type,
                'discount_value' => $request->discount_value,
                'usage_limit_per_user' => $request->usage_limit_per_user,
                'status' => $request->status,
            ]);

            // Attach products (no individual discount prices needed)
            $flashSale->products()->attach($request->product_ids);

            DB::commit();

            return redirect()->route('seller.flash-sales.index')
                ->with('success', 'Flash sale created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Failed to create flash sale. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Display the specified flash sale.
     */
    public function show(FlashSale $flashSale)
    {
        $sellerId = Auth::guard('seller')->id();

        // Ensure the flash sale belongs to the authenticated seller's products
        $hasSellerProducts = $flashSale->products()->where('seller_id', $sellerId)->exists();
        if (!$hasSellerProducts) {
            abort(404);
        }

        $flashSale->load(['products']);

        return view('seller.flash-sales.show', compact('flashSale'));
    }

    /**
     * Show the form for editing the specified flash sale.
     */
    public function edit(FlashSale $flashSale)
    {
        $sellerId = Auth::guard('seller')->id();

        // Ensure the flash sale belongs to the authenticated seller's products
        $hasSellerProducts = $flashSale->products()->where('seller_id', $sellerId)->exists();
        if (!$hasSellerProducts) {
            abort(404);
        }

        $products = Product::where('seller_id', $sellerId)
            ->where('status', 'published')
            ->orderBy('title')
            ->get();

        $flashSale->load(['products']);

        // Return JSON response for AJAX requests
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'flashSale' => [
                    'id' => $flashSale->id,
                    'slug' => $flashSale->slug,
                    'title' => $flashSale->title,
                    'start_at' => $flashSale->start_at->format('Y-m-d\TH:i'),
                    'end_at' => $flashSale->end_at->format('Y-m-d\TH:i'),
                    'discount_type' => $flashSale->discount_type,
                    'discount_value' => $flashSale->discount_value,
                    'usage_limit_per_user' => $flashSale->usage_limit_per_user,
                    'status' => $flashSale->status,
                    'product_ids' => $flashSale->products->pluck('id')->toArray(),
                ]
            ]);
        }

        return view('seller.flash-sales.edit', compact('flashSale', 'products'));
    }

    /**
     * Update the specified flash sale in storage.
     */
    public function update(Request $request, FlashSale $flashSale)
    {
        $sellerId = Auth::guard('seller')->id();

        // Ensure the flash sale belongs to the authenticated seller's products
        $hasSellerProducts = $flashSale->products()->where('seller_id', $sellerId)->exists();
        if (!$hasSellerProducts) {
            abort(404);
        }

        $request->validate([
            'product_ids' => 'required|array|min:1',
            'product_ids.*' => [
                'required',
                'exists:products,id',
                Rule::exists('products', 'id')->where(function ($query) use ($sellerId) {
                    return $query->where('seller_id', $sellerId);
                }),
            ],
            'title' => 'required|string|max:255',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:1',
            'status' => 'required|in:' . implode(',', [
                FlashSale::STATUS_INACTIVE,
                FlashSale::STATUS_ACTIVE,
                FlashSale::STATUS_ENDED
            ])
        ], [
            'product_ids.*.exists' => 'You can only create flash sales for your own products.',
            'end_at.after' => 'End date must be after start date.',
            'product_ids.required' => 'You must select at least one product.',
        ]);

        // Additional validation for discount value
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            return redirect()->back()
                ->withErrors(['discount_value' => 'Percentage discount cannot be more than 100%.'])
                ->withInput();
        }

        // Check for existing active flash sales for these products (excluding current one)
        $existingFlashSales = FlashSaleProduct::whereIn('product_id', $request->product_ids)
            ->whereHas('flashSale', function ($query) use ($flashSale) {
                $query->where('id', '!=', $flashSale->id)
                    ->where(function ($subQuery) {
                        $subQuery->where('status', FlashSale::STATUS_ACTIVE)
                            ->orWhere(function ($nestedQuery) {
                                $nestedQuery->where('start_at', '<=', now())
                                    ->where('end_at', '>=', now());
                            });
                    });
            })
            ->with('product')
            ->get();

        if ($existingFlashSales->isNotEmpty()) {
            $conflictingProducts = $existingFlashSales->pluck('product.title')->join(', ');
            return redirect()->back()
                ->withErrors(['product_ids' => "The following products already have active flash sales: {$conflictingProducts}"])
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $flashSale->update([
                'title' => $request->title,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'discount_type' => $request->discount_type,
                'discount_value' => $request->discount_value,
                'usage_limit_per_user' => $request->usage_limit_per_user,
                'status' => $request->status,
            ]);

            // Sync products (no individual discount prices needed)
            $flashSale->products()->sync($request->product_ids);

            DB::commit();

            // Check if it's from index page
            if ($request->has('redirect_to') && $request->redirect_to === 'index') {
                return redirect()->route('seller.flash-sales.index')
                    ->with('success', 'Flash sale updated successfully!');
            }

            return redirect()->route('seller.flash-sales.show', $flashSale->slug)
                ->with('success', 'Flash sale updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Failed to update flash sale. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified flash sale from storage.
     */
    public function destroy(FlashSale $flashSale)
    {
        $sellerId = Auth::guard('seller')->id();

        // Ensure the flash sale belongs to the authenticated seller's products
        $hasSellerProducts = $flashSale->products()->where('seller_id', $sellerId)->exists();
        if (!$hasSellerProducts) {
            abort(404);
        }

        try {
            DB::beginTransaction();

            $flashSale->delete();

            DB::commit();

            return redirect()->route('seller.flash-sales.index')
                ->with('success', 'Flash sale deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Failed to delete flash sale. Please try again.']);
        }
    }

    /**
     * Get status options for select dropdown
     */
    public function getStatusOptions()
    {
        return [
            FlashSale::STATUS_INACTIVE => 'Inactive',
            FlashSale::STATUS_ACTIVE => 'Active',
            FlashSale::STATUS_ENDED => 'Ended'
        ];
    }

    /**
     * Get status label
     */
    public function getStatusLabel($status)
    {
        $labels = $this->getStatusOptions();
        return $labels[$status] ?? 'Unknown';
    }

    /**
     * Get status color class
     */
    public function getStatusColor($status)
    {
        return match ($status) {
            FlashSale::STATUS_INACTIVE => 'warning',
            FlashSale::STATUS_ACTIVE => 'success',
            FlashSale::STATUS_ENDED => 'secondary',
            default => 'secondary'
        };
    }
}