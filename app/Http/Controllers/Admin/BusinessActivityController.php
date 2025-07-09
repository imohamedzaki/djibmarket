<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessActivity;
use Illuminate\Http\Request;

class BusinessActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = BusinessActivity::latest()->get(); // Fetch all activities, ordered by latest
        return view('admin.business_activities.index', compact('activities')); // Pass activities to the view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:business_activities,name',
            'description' => 'nullable|string',
        ]);

        BusinessActivity::create($validatedData);

        return back()->with('success', 'Business Activity added successfully.');
    }

    /**
     * Display the specified resource.
     */
    // Changed signature to use route model binding
    public function show(BusinessActivity $business_activity)
    {
        // Laravel automatically resolves the model by slug due to route definition
        // $activity = BusinessActivity::findOrFail($id); // No longer needed
        // Pass the resolved model to the view
        return view('admin.business_activities.show', ['activity' => $business_activity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Update signature even if route is excluded, for consistency
    public function edit(BusinessActivity $business_activity)
    {
        // Current logic redirects as editing seems to be via modal.
        // If a dedicated edit page is needed, remove the 'except('edit')' from the route
        // and return a view here, e.g.:
        // return view('admin.business_activities.edit', compact('business_activity'));
        return redirect()->route('admin.business_activities.index');
    }

    /**
     * Update the specified resource in storage.
     */
    // Changed signature to use route model binding
    public function update(Request $request, BusinessActivity $business_activity)
    {
        // dd($business_activity);
        // Laravel automatically resolves the model by slug
        // $activity = BusinessActivity::findOrFail($id); // No longer needed

        $validatedData = $request->validate([
            // Use the resolved model's ID for the unique rule exclusion
            'name' => 'required|string|max:255|unique:business_activities,name,' . $business_activity->id,
            'description' => 'nullable|string',
        ]);

        // Update the resolved model instance
        $business_activity->update($validatedData);

        // Redirect to the show page using the potentially updated slug
        return redirect()->route('admin.business_activities.show', $business_activity)
            ->with('success', 'Business Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Changed signature to use route model binding
    public function destroy(BusinessActivity $business_activity)
    {
        // Laravel automatically resolves the model by slug
        // $activity = BusinessActivity::findOrFail($id); // No longer needed
        $activityName = $business_activity->name; // Get name from resolved model

        // Delete the resolved model instance
        $business_activity->delete();

        // Redirect with success message
        // return back()->with('success', "Business Activity '$activityName' has been deleted.");
        return redirect()->route('admin.business_activities.index')
            ->with('success', "Business Activity '$activityName' has been deleted.");
    }
}
