<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')->latest()->get();
        $allCategories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories', 'allCategories'));
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
            'name' => 'required|string|max:255|unique:categories,name',
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if (empty($validatedData['parent_id'])) {
            $validatedData['parent_id'] = null;
        }

        Category::create($validatedData);

        return back()->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Fetch data needed for the edit modal.
     */
    public function getEditData(Category $category)
    {
        $allCategories = Category::orderBy('name')->get(['id', 'name']);
        $category->loadMissing('parent');
        return response()->json([
            'success' => true,
            'category' => $category,
            'allCategories' => $allCategories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return redirect()->route('admin.categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if (empty($validatedData['parent_id'])) {
            $validatedData['parent_id'] = null;
        }

        if (isset($validatedData['parent_id']) && $validatedData['parent_id'] == $category->id) {
            return back()->withErrors(['parent_id' => 'A category cannot be its own parent.'])->withInput();
        }

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $categoryName = $category->name;

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "Category '$categoryName' has been deleted.");
    }
}
