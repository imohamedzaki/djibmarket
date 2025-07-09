<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\BusinessActivity;
use Illuminate\Http\Request;

class AdminSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellers = Seller::with('businessActivity')->latest()->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        $seller->loadMissing(['businessActivity', 'documents', 'products']);
        return view('admin.sellers.show', compact('seller'));
    }

    /**
     * Fetch data needed for the edit modal.
     */
    public function getEditData(Seller $seller)
    {
        $businessActivities = BusinessActivity::orderBy('name')->get(['id', 'name']);
        $seller->loadMissing('businessActivity');
        return response()->json([
            'success' => true,
            'seller' => $seller,
            'businessActivities' => $businessActivities
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        return redirect()->route('admin.sellers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seller $seller)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:sellers,email,' . $seller->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'business_activity_id' => 'nullable|exists:business_activities,id',
            'status' => 'required|in:active,pending,banned',
        ]);

        if (empty($validatedData['business_activity_id'])) {
            $validatedData['business_activity_id'] = null;
        }

        $seller->update($validatedData);

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller updated successfully.');
    }

    /**
     * Update seller status (enable/disable).
     */
    public function updateStatus(Request $request, Seller $seller)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:active,pending,banned',
        ]);

        $oldStatus = $seller->status;
        $seller->update($validatedData);

        $statusMessages = [
            'active' => 'activated',
            'pending' => 'set to pending',
            'banned' => 'banned',
        ];

        $statusMessage = $statusMessages[$validatedData['status']] ?? 'updated';

        return redirect()->route('admin.sellers.index')
            ->with('success', "Seller status has been {$statusMessage} successfully. (Changed from {$oldStatus} to {$validatedData['status']})");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
