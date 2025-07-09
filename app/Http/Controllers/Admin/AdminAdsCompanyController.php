<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsCompany;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminAdsCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adsCompanies = AdsCompany::with('seller')->latest()->get();
        $sellers = Seller::where('status', 'active')->orderBy('name')->get(['id', 'name']);


        return view('admin.ads-companies.index', compact('adsCompanies', 'sellers'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'seller_id' => 'nullable|exists:sellers,id',
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        // Handle logo upload to public/storage
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            try {
                // Create directory if it doesn't exist
                $uploadPath = public_path('storage/ads-companies/logos');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filename
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public/storage
                $file->move($uploadPath, $fileName);

                // Save relative path in database
                $validatedData['logo'] = 'ads-companies/logos/' . $fileName;
                Log::info('File uploaded successfully to: ' . $uploadPath . '/' . $fileName);
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to upload logo. Please try again.');
            }
        }

        AdsCompany::create($validatedData);

        return redirect()->route('admin.ads-companies.index')
            ->with('success', 'Ads company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdsCompany $adsCompany)
    {
        $adsCompany->loadMissing('seller');
        return view('admin.ads-companies.show', compact('adsCompany'));
    }

    /**
     * Fetch data needed for the edit modal.
     */
    public function getEditData(AdsCompany $adsCompany)
    {
        $sellers = Seller::where('status', 'active')->orderBy('name')->get(['id', 'name']);
        $adsCompany->loadMissing('seller');

        return response()->json([
            'success' => true,
            'adsCompany' => [
                'id' => $adsCompany->id,
                'name' => $adsCompany->name,
                'logo' => $adsCompany->logo,
                'link' => $adsCompany->link,
                'start_date' => $adsCompany->start_date->format('Y-m-d'),
                'end_date' => $adsCompany->end_date->format('Y-m-d'),
                'seller_id' => $adsCompany->seller_id,
                'is_active' => $adsCompany->is_active,
            ],
            'sellers' => $sellers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdsCompany $adsCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdsCompany $adsCompany)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'seller_id' => 'nullable|exists:sellers,id',
        ]);

        $validatedData['is_active'] = $request->has('is_active');

        // Handle logo upload to public/storage
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            try {
                // Delete old logo if exists
                if ($adsCompany->logo) {
                    $oldLogoPath = public_path('storage/' . $adsCompany->logo);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                // Create directory if it doesn't exist
                $uploadPath = public_path('storage/ads-companies/logos');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filename
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public/storage
                $file->move($uploadPath, $fileName);

                // Save relative path in database
                $validatedData['logo'] = 'ads-companies/logos/' . $fileName;
                Log::info('File updated successfully to: ' . $uploadPath . '/' . $fileName);
            } catch (\Exception $e) {
                Log::error('File update failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Failed to update logo. Please try again.');
            }
        }

        // Remove null seller_id if empty
        if (empty($validatedData['seller_id'])) {
            $validatedData['seller_id'] = null;
        }

        $adsCompany->update($validatedData);

        return redirect()->route('admin.ads-companies.index')
            ->with('success', 'Ads company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdsCompany $adsCompany)
    {
        // Delete logo file if exists
        if ($adsCompany->logo) {
            $logoPath = public_path('storage/' . $adsCompany->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        $adsCompany->delete();

        return redirect()->route('admin.ads-companies.index')
            ->with('success', 'Ads company deleted successfully.');
    }

    /**
     * Delete the logo image.
     */
    public function deleteLogo(AdsCompany $adsCompany)
    {
        if ($adsCompany->logo) {
            $logoPath = public_path('storage/' . $adsCompany->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
            $adsCompany->update(['logo' => null]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Logo deleted successfully.'
        ]);
    }
}