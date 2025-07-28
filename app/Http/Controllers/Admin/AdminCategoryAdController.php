<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryAd;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminCategoryAdController extends Controller
{
    public function index(Request $request)
    {
        $query = CategoryAd::with('category');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('link_url', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('active', true)
                    ->where('starts_at', '<=', now())
                    ->where('ends_at', '>=', now());
            } elseif ($request->status === 'inactive') {
                $query->where(function ($q) {
                    $q->where('active', false)
                        ->orWhere('starts_at', '>', now())
                        ->orWhere('ends_at', '<', now());
                });
            }
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        if (in_array($sortBy, ['position', 'starts_at', 'ends_at', 'created_at', 'updated_at'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $categoryAds = $query->get();
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.category-ads.index', compact('categoryAds', 'categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.category-ads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url' => 'required|url|max:500',
            'position' => 'required|integer|min:1|max:100',
            'active' => 'boolean',
            'starts_at' => 'required|date|after_or_equal:today',
            'ends_at' => 'required|date|after:starts_at',
        ]);

        $categoryAd = new CategoryAd();
        $categoryAd->category_id = $request->category_id;
        $categoryAd->link_url = $request->link_url;
        $categoryAd->position = $request->position;
        $categoryAd->active = $request->boolean('active', true);
        $categoryAd->starts_at = Carbon::parse($request->starts_at);
        $categoryAd->ends_at = Carbon::parse($request->ends_at);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store in public/storage/category-ads
            $image->move(public_path('storage/category-ads'), $filename);

            // Save relative path in database
            $categoryAd->image_path = 'storage/category-ads/' . $filename;
        }

        $categoryAd->save();

        return redirect()->route('admin.category-ads.index')
            ->with('success', 'Category ad created successfully.');
    }

    public function show(CategoryAd $categoryAd)
    {
        $categoryAd->load('category');

        return view('admin.category-ads.show', compact('categoryAd'));
    }

    public function edit(CategoryAd $categoryAd)
    {
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();
        $categoryAd->load('category');

        return view('admin.category-ads.edit', compact('categoryAd', 'categories'));
    }

    public function update(Request $request, CategoryAd $categoryAd)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link_url' => 'required|url|max:500',
            'position' => 'required|integer|min:1|max:100',
            'active' => 'boolean',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);

        $categoryAd->category_id = $request->category_id;
        $categoryAd->link_url = $request->link_url;
        $categoryAd->position = $request->position;
        $categoryAd->active = $request->boolean('active', true);
        $categoryAd->starts_at = Carbon::parse($request->starts_at);
        $categoryAd->ends_at = Carbon::parse($request->ends_at);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old local image if exists
            if ($categoryAd->image_path && $categoryAd->isLocalImage()) {
                $oldImagePath = public_path($categoryAd->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store in public/storage/category-ads
            $image->move(public_path('storage/category-ads'), $filename);

            // Save relative path in database
            $categoryAd->image_path = 'storage/category-ads/' . $filename;
        }

        $categoryAd->save();

        return redirect()->route('admin.category-ads.index')
            ->with('success', 'Category ad updated successfully.');
    }

    public function destroy(CategoryAd $categoryAd)
    {
        // Delete local image if exists (don't delete external URLs)
        if ($categoryAd->image_path && $categoryAd->isLocalImage()) {
            $imagePath = public_path($categoryAd->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $categoryAd->delete();

        return redirect()->route('admin.category-ads.index')
            ->with('success', 'Category ad deleted successfully.');
    }

    public function getEditData(CategoryAd $categoryAd)
    {
        $categoryAd->load('category');

        return response()->json([
            'categoryAd' => $categoryAd,
            'starts_at_formatted' => $categoryAd->starts_at ? $categoryAd->starts_at->format('Y-m-d') : null,
            'ends_at_formatted' => $categoryAd->ends_at ? $categoryAd->ends_at->format('Y-m-d') : null,
        ]);
    }

    public function deleteImage(CategoryAd $categoryAd)
    {
        if ($categoryAd->image_path && $categoryAd->isLocalImage()) {
            $imagePath = public_path($categoryAd->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $categoryAd->image_path = null;
            $categoryAd->save();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'No local image to delete.']);
    }

    public function updateStatus(Request $request, CategoryAd $categoryAd)
    {
        $request->validate([
            'active' => 'required|boolean',
        ]);

        $categoryAd->active = $request->active;
        $categoryAd->save();

        $status = $categoryAd->active ? 'activated' : 'deactivated';

        return response()->json([
            'success' => true,
            'message' => "Category ad {$status} successfully.",
            'active' => $categoryAd->active
        ]);
    }
}
