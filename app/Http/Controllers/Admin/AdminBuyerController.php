<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buyers = User::withCount(['orders', 'reviews'])->latest()->get();
        return view('admin.buyers.index', compact('buyers'));
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
    public function show(User $buyer)
    {
        $buyer->loadMissing(['orders.orderItems', 'reviews', 'couponUsages']);
        return view('admin.buyers.show', compact('buyer'));
    }

    /**
     * Fetch data needed for the edit modal.
     */
    public function getEditData(User $buyer)
    {
        return response()->json([
            'success' => true,
            'buyer' => $buyer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $buyer)
    {
        return redirect()->route('admin.buyers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $buyer)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $buyer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,suspended,banned',
        ]);

        $buyer->update($validatedData);

        return redirect()->route('admin.buyers.index')
            ->with('success', 'Buyer updated successfully.');
    }

    /**
     * Update buyer status (enable/disable).
     */
    public function updateStatus(Request $request, User $buyer)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:active,suspended,banned',
        ]);

        $oldStatus = $buyer->status ?? 'active';
        $buyer->update($validatedData);

        $statusMessages = [
            'active' => 'activated',
            'suspended' => 'suspended',
            'banned' => 'banned',
        ];

        $statusMessage = $statusMessages[$validatedData['status']] ?? 'updated';

        return redirect()->route('admin.buyers.index')
            ->with('success', "Buyer status has been {$statusMessage} successfully. (Changed from {$oldStatus} to {$validatedData['status']})");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $buyer)
    {
        //
    }
}
