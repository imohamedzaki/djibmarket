<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;
use App\Models\SellerDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class SellerProfileController extends Controller
{
    /**
     * Display the seller profile page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::user();
        $seller->load('documents');

        return view('seller.profile.index', compact('seller'));
    }

    /**
     * Show the form for editing the seller's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::user();
        return view('seller.profile.edit', compact('seller'));
    }

    /**
     * Update the seller's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::user();

        // Check if seller status is pending
        if ($seller->status === 'pending') {
            return redirect()->back()->withErrors([
                'status' => 'You cannot update your profile while your seller application is pending review. Please wait for admin approval.'
            ])->withInput();
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('sellers')->ignore($seller->id),
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096', // Max 4MB
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string',
        ]);

        // Handle password change
        if ($request->filled('old_password') && $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $seller->password)) {
                return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
            }
            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Remove password fields from validated data if not changing password
        unset($validatedData['old_password'], $validatedData['new_password']);

        // Define directories
        $avatarsDir = 'storage/sellers/avatars';
        $coversDir = 'storage/sellers/covers';

        // Ensure directories exist in public folder
        if (!File::exists(public_path($avatarsDir))) {
            File::makeDirectory(public_path($avatarsDir), 0755, true);
        }
        if (!File::exists(public_path($coversDir))) {
            File::makeDirectory(public_path($coversDir), 0755, true);
        }

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($seller->avatar && File::exists(public_path($seller->avatar))) {
                File::delete(public_path($seller->avatar));
            }

            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($avatarsDir), $filename);
            $validatedData['avatar'] = $avatarsDir . '/' . $filename;
        }

        // Handle Cover Image Upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if it exists
            if ($seller->cover_image && File::exists(public_path($seller->cover_image))) {
                File::delete(public_path($seller->cover_image));
            }

            $file = $request->file('cover_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($coversDir), $filename);
            $validatedData['cover_image'] = $coversDir . '/' . $filename;
        }

        $seller->update($validatedData);

        return redirect()->route('seller.profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * View a document in the browser.
     *
     * @param  \App\Models\SellerDocument  $document
     * @return \Illuminate\Http\Response
     */
    public function viewDocument(SellerDocument $document)
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::user();

        // Check if the document belongs to the authenticated seller
        if ($document->seller_id !== $seller->id) {
            abort(403, 'Unauthorized access to document.');
        }

        $filePath = public_path($document->document_path);

        if (!File::exists($filePath)) {
            abort(404, 'Document not found.');
        }

        $mimeType = File::mimeType($filePath);
        $fileName = basename($document->document_path);

        return Response::file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }

    /**
     * Download a document.
     *
     * @param  \App\Models\SellerDocument  $document
     * @return \Illuminate\Http\Response
     */
    public function downloadDocument(SellerDocument $document)
    {
        /** @var \App\Models\Seller $seller */
        $seller = Auth::user();

        // Check if the document belongs to the authenticated seller
        if ($document->seller_id !== $seller->id) {
            abort(403, 'Unauthorized access to document.');
        }

        $filePath = public_path($document->document_path);

        if (!File::exists($filePath)) {
            abort(404, 'Document not found.');
        }

        $fileName = $document->document_type . '_' . basename($document->document_path);

        return Response::download($filePath, $fileName);
    }
}
