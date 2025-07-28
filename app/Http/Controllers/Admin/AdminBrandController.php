<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandType;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminBrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::with(['type', 'categories']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('website', 'like', "%{$search}%")
                    ->orWhereHas('type', function ($typeQuery) use ($search) {
                        $typeQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by brand type
        if ($request->filled('brand_type_id')) {
            $query->where('brand_type_id', $request->brand_type_id);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        if (in_array($sortBy, ['name', 'created_at', 'updated_at'])) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $brands = $query->get();
        $brandTypes = BrandType::orderBy('name')->get();

        return view('admin.brands.index', compact('brands', 'brandTypes'));
    }

    public function create()
    {
        $brandTypes = BrandType::orderBy('name')->get();
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.brands.create', compact('brandTypes', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'brand_type_id' => 'required|exists:brand_types,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'top_brand_categories' => 'nullable|array',
            'top_brand_categories.*' => 'exists:categories,id',
            'priorities' => 'nullable|array',
            'priorities.*' => 'integer|min:1|max:100'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->brand_type_id = $request->brand_type_id;
        $brand->website = $request->website;
        $brand->description = $request->description;

        // Handle logo upload
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            try {
                // Create directory if it doesn't exist
                $uploadPath = public_path('storage/logos');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filename
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public/storage/logos
                $file->move($uploadPath, $fileName);

                // Save relative path in database
                $brand->logo = 'storage/logos/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Failed to upload logo. Please try again.');
            }
        }

        $brand->save();

        // Attach categories if provided
        if ($request->filled('categories')) {
            $categoryData = [];

            foreach ($request->categories as $categoryId) {
                $isTopBrand = in_array($categoryId, $request->top_brand_categories ?? []);
                $priority = $isTopBrand ? ($request->priorities[$categoryId] ?? 1) : 0;

                $categoryData[$categoryId] = [
                    'is_top_brand' => $isTopBrand,
                    'priority' => $priority,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $brand->categories()->sync($categoryData);
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        $brand->load(['type', 'categories']);

        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $brandTypes = BrandType::orderBy('name')->get();
        $categories = Category::whereNull('parent_id')->orderBy('name')->get();
        $brand->load('categories');

        return view('admin.brands.edit', compact('brand', 'brandTypes', 'categories'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('brands')->ignore($brand->id)],
            'brand_type_id' => 'required|exists:brand_types,id',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'top_brand_categories' => 'nullable|array',
            'top_brand_categories.*' => 'exists:categories,id',
            'priorities' => 'nullable|array',
            'priorities.*' => 'integer|min:1|max:100'
        ]);

        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->brand_type_id = $request->brand_type_id;
        $brand->website = $request->website;
        $brand->description = $request->description;

        // Handle logo upload
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            try {
                // Delete old logo if exists and it's a local file
                if ($brand->logo && $this->isLocalImage($brand->logo)) {
                    $oldLogoPath = public_path($brand->logo);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath);
                    }
                }

                // Create directory if it doesn't exist
                $uploadPath = public_path('storage/logos');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filename
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public/storage/logos
                $file->move($uploadPath, $fileName);

                // Save relative path in database
                $brand->logo = 'storage/logos/' . $fileName;
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Failed to upload logo. Please try again.');
            }
        }

        $brand->save();

        // Update category relationships
        if ($request->filled('categories')) {
            $categoryData = [];

            foreach ($request->categories as $categoryId) {
                $isTopBrand = in_array($categoryId, $request->top_brand_categories ?? []);
                $priority = $isTopBrand ? ($request->priorities[$categoryId] ?? 1) : 0;

                $categoryData[$categoryId] = [
                    'is_top_brand' => $isTopBrand,
                    'priority' => $priority,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $brand->categories()->sync($categoryData);
        } else {
            $brand->categories()->detach();
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        // Delete logo if exists and it's a local file
        if ($brand->logo && $this->isLocalImage($brand->logo)) {
            $logoPath = public_path($brand->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        // Detach from categories
        $brand->categories()->detach();

        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }

    public function getEditData(Brand $brand)
    {
        $brand->load(['type', 'categories']);

        return response()->json([
            'brand' => $brand,
            'category_relationships' => $brand->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'is_top_brand' => $category->pivot->is_top_brand,
                    'priority' => $category->pivot->priority,
                ];
            })
        ]);
    }

    public function deleteLogo(Brand $brand)
    {
        if ($brand->logo && $this->isLocalImage($brand->logo)) {
            $logoPath = public_path($brand->logo);
            if (file_exists($logoPath)) {
                unlink($logoPath);
                $brand->logo = null;
                $brand->save();

                return response()->json(['success' => true, 'message' => 'Logo deleted successfully.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'No logo to delete.']);
    }

    /**
     * Check if an image path is a local file or external URL
     */
    private function isLocalImage($imagePath)
    {
        return $imagePath && !filter_var($imagePath, FILTER_VALIDATE_URL);
    }
}