<?php

namespace App\Http\Controllers\Seller;

use App\Models\Coupon;
use App\Models\Category;
use App\Enums\CouponType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerCouponController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Auth::guard('seller')->user();
        $coupons = Coupon::where('seller_id', $seller->id)
            ->latest()
            ->paginate(10);
        $categories = Category::orderBy('name')->get();
        $products = $seller->products()->with('images')->orderBy('title')->get();

        return view('seller.coupons.index', compact('coupons', 'categories', 'products'));
    }


    /**
     * Store a newly created coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authorize: Ensure the seller can create coupons (status must be active)
        $this->authorize('create', Coupon::class);

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => ['required', Rule::in(CouponType::toArray())],
            'amount' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'applicability_type' => 'required|in:all,category,products',
            'category_id' => 'nullable|exists:categories,id',
            'specific_categories' => 'nullable|array',
            'specific_categories.*' => 'exists:categories,id',
            'specific_products' => 'required_if:applicability_type,products|nullable',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->input('applicability_type') === 'category') {
                $categoryId = $request->input('category_id');
                $specificCategories = $request->input('specific_categories');

                $hasValidCategorySelection = !empty($categoryId) || (!empty($specificCategories) && is_array($specificCategories));

                if (!$hasValidCategorySelection) {
                    $validator->errors()->add('specific_categories', 'Please select at least one category.');
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Additional validation for percentage discount
        if ($request->type == CouponType::PERCENTAGE->value && $request->amount > 100) {
            return redirect()->back()
                ->withErrors(['amount' => 'Percentage discount cannot exceed 100%.'])
                ->withInput();
        }

        $seller = Auth::guard('seller')->user();

        $coupon = Coupon::create([
            'seller_id'     => $seller->id,
            'code'          => strtoupper($request->code),
            'type'          => $request->type,
            'amount'        => $request->amount,
            'min_purchase'  => $request->min_purchase,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'usage_limit'   => $request->usage_limit,
            'is_active'     => $request->has('is_active') ? 1 : 0,
            'description'   => $request->description,
            'applicability_type' => $request->applicability_type,
        ]);

        // Handle relationships based on applicability_type
        if ($request->applicability_type === 'category') {
            // First detach all categories
            $coupon->applicableCategories()->detach();
            // Then attach the selected category
            if ($request->has('specific_categories')) {
                // Remove duplicates from the array
                $uniqueCategories = array_unique($request->specific_categories);
                $coupon->applicableCategories()->attach($uniqueCategories);
            } elseif ($request->has('category_id')) {
                $coupon->applicableCategories()->attach($request->category_id);
            }
        } elseif ($request->applicability_type === 'products' && $request->has('specific_products')) {
            $productIds = explode(',', $request->specific_products);
            if (!empty($productIds)) {
                $coupon->applicableProducts()->attach($productIds);
            }
        }

        return redirect()->route('seller.coupons.index')
            ->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified coupon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $seller = Auth::guard('seller')->user();
        $coupon = Coupon::where('seller_id', $seller->id)
            ->where('slug', $slug)
            ->firstOrFail();
        $categories = Category::orderBy('name')->get();

        // Get seller's products for the product selector
        $products = $seller->products()
            ->with('images') // Changed from 'media' to 'images'
            ->orderBy('title')
            ->get();

        return view('seller.coupons.show', compact('coupon', 'categories', 'products'));
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = Auth::guard('seller')->user();
        $coupon = Coupon::where('seller_id', $seller->id)
            ->findOrFail($id);

        $couponTypes = CouponType::toSelectArray();
        $categories = Category::orderBy('name')->get();
        return view('seller.coupons.edit', compact('coupon', 'couponTypes', 'categories'));
    }

    /**
     * Update the specified coupon in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $seller = Auth::guard('seller')->user();
        $coupon = Coupon::where('seller_id', $seller->id)
            ->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'type' => ['required', Rule::in(CouponType::toArray())],
            'amount' => 'required|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'applicability_type' => 'required|in:all,category,products',
            'category_id' => 'nullable|exists:categories,id',
            'specific_categories' => 'nullable|array',
            'specific_categories.*' => 'exists:categories,id',
            'specific_products' => 'required_if:applicability_type,products|nullable',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->input('applicability_type') === 'category') {
                $categoryId = $request->input('category_id');
                $specificCategories = $request->input('specific_categories');

                $hasValidCategorySelection = !empty($categoryId) || (!empty($specificCategories) && is_array($specificCategories));

                if (!$hasValidCategorySelection) {
                    $validator->errors()->add('specific_categories', 'Please select at least one category.');
                }
            }
        });

        if ($validator->fails()) {
            if ($request->input('redirect_to') === 'index') {
                $request->session()->flash('edited_coupon_id', $coupon->id);
            }
            return redirect()->back()
                ->withErrors($validator, 'update')
                ->withInput();
        }

        // Additional validation for percentage discount
        if ($request->type == CouponType::PERCENTAGE->value && $request->amount > 100) {
            return redirect()->back()
                ->withErrors(['amount' => 'Percentage discount cannot exceed 100%.'], 'update')
                ->withInput();
        }

        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->amount = $request->amount;
        $coupon->min_purchase = $request->min_purchase;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->is_active = $request->has('is_active') ? 1 : 0;
        $coupon->description = $request->description;
        $coupon->applicability_type = $request->applicability_type;
        $coupon->save();

        // Handle relationships based on applicability_type
        if ($request->applicability_type === 'category') {
            // First detach all categories
            $coupon->applicableCategories()->detach();
            // Then attach the selected category
            if ($request->has('specific_categories')) {
                // Remove duplicates from the array
                $uniqueCategories = array_unique($request->specific_categories);
                $coupon->applicableCategories()->attach($uniqueCategories);
            } elseif ($request->has('category_id')) {
                $coupon->applicableCategories()->attach($request->category_id);
            }
        } elseif ($request->applicability_type === 'products' && $request->has('specific_products')) {
            // First detach all products
            $coupon->applicableProducts()->detach();

            // Then attach the selected products
            $productIds = explode(',', $request->specific_products);
            if (!empty($productIds)) {
                $coupon->applicableProducts()->attach($productIds);
            }
        } else {
            // If 'all' is selected, detach all relations
            $coupon->applicableCategories()->detach();
            $coupon->applicableProducts()->detach();
        }

        if ($request->has('redirect_to') && $request->redirect_to === 'show') {
            return redirect()->route('seller.coupons.show', $coupon->slug)
                ->with('success', 'Coupon updated successfully.');
        }

        return redirect()->route('seller.coupons.index')
            ->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Auth::guard('seller')->user();
        $coupon = Coupon::where('seller_id', $seller->id)
            ->findOrFail($id);

        $coupon->delete();

        return redirect()->route('seller.coupons.index')
            ->with('success', 'Coupon deleted successfully.');
    }
}