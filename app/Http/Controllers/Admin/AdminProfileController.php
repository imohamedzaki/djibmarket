<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; // Assuming your Admin model is in App\Models
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminProfileController extends Controller
{
    /**
     * Display the authenticated admin's profile.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.show', compact('admin'));
    }

    /**
     * Show the form for editing the authenticated admin's profile.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the authenticated admin's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female,other',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png|max:2048',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string',
        ]);

        // Handle password change
        if ($request->filled('old_password') && $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $admin->password)) {
                return redirect()->back()->withErrors(['old_password' => 'The old password is incorrect.'])->withInput();
            }
            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Remove password fields from validated data if not changing password
        unset($validatedData['old_password'], $validatedData['new_password']);

        // Define directories
        $avatarsDir = 'storage/admins/avatars';
        $coversDir = 'storage/admins/covers';

        // Ensure directories exist in public folder
        if (!File::exists(public_path($avatarsDir))) {
            File::makeDirectory(public_path($avatarsDir), 0755, true);
        }
        if (!File::exists(public_path($coversDir))) {
            File::makeDirectory(public_path($coversDir), 0755, true);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($admin->avatar && File::exists(public_path($admin->avatar))) {
                // Check if it's not a seeder image before deleting
                if (strpos($admin->avatar, 'seeders') === false) {
                    File::delete(public_path($admin->avatar));
                }
            }

            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($avatarsDir), $filename);
            $validatedData['avatar'] = $avatarsDir . '/' . $filename;
        }

        if ($request->hasFile('cover_photo')) {
            // Delete old cover photo if it exists
            if ($admin->cover_photo && File::exists(public_path($admin->cover_photo))) {
                // Check if it's not a seeder image before deleting
                if (strpos($admin->cover_photo, 'seeders') === false) {
                    File::delete(public_path($admin->cover_photo));
                }
            }

            $file = $request->file('cover_photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($coversDir), $filename);
            $validatedData['cover_photo'] = $coversDir . '/' . $filename;
        }

        $admin->update($validatedData);

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }
}
