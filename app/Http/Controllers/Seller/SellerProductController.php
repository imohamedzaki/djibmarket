<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use App\Enums\ProductStatus;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Seller\StoreProductRequest;
use App\Http\Requests\Seller\UpdateProductRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Renamed class
class SellerProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the seller's products page.
     */
    public function index(Request $request): View
    {
        // Get products belonging to the authenticated seller using the 'seller' guard
        $seller = Auth::guard('seller')->user();

        // Start building the query
        $query = $seller->products()->with('category');

        // Handle search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->get('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('sku', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Handle per page parameter
        $perPage = $request->get('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;

        // Get paginated results
        $products = $query->latest()->paginate($perPage);

        // Append query parameters to pagination links
        $products->appends($request->query());

        // Get categories for the add/edit forms
        $categories = Category::orderBy('name')->get();

        return view('seller.products.index', compact('products', 'categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        // Get seller using the 'seller' guard
        $seller = Auth::guard('seller')->user();

        // Authorize: Ensure the seller can create products (status must be active)
        $this->authorize('create', Product::class);

        $validated = $request->validated();

        // Add seller_id
        $validated['seller_id'] = $seller->id;

        // Set price_discounted to 0 if it's null or empty
        $validated['price_discounted'] = $validated['price_discounted'] ?? 0;

        // Create directories based on seller ID and name
        $sellerName = str_replace(' ', '_', strtolower($seller->name));
        $featuredImagesDir = "storage/products/{$seller->id}_{$sellerName}_featured_images";
        $productImagesDir = "storage/products/{$seller->id}_{$sellerName}_product_images";

        // Ensure directories exist in public folder
        if (!File::exists(public_path($featuredImagesDir))) {
            File::makeDirectory(public_path($featuredImagesDir), 0755, true);
        }
        if (!File::exists(public_path($productImagesDir))) {
            File::makeDirectory(public_path($productImagesDir), 0755, true);
        }

        // Handle featured image upload
        /** @var \Illuminate\Http\Request $request */
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($featuredImagesDir), $filename);
            $validated['thumbnail'] = $featuredImagesDir . '/' . $filename;
        }

        // Convert status enum value if needed
        $validated['status'] = ProductStatus::from($validated['status']);

        // Create the product
        $product = Product::create($validated);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($productImagesDir), $filename);
                $path = $productImagesDir . '/' . $filename;

                // Create product image record
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        // Authorize: Ensure the product belongs to the seller
        $this->authorize('view', $product);
        $categories = Category::orderBy('name')->get();

        return view('seller.products.show', compact('product', 'categories'));
    }

    /**
     * Fetch product data for the edit modal via AJAX.
     */
    public function edit(Product $product)
    {
        // Authorize: Ensure the product belongs to the seller
        $this->authorize('update', $product);

        // Get the gallery images
        $galleryImages = $product->images->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => asset('storage/' . $image->image_path)
            ];
        });

        // Return the product data as JSON
        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price_regular' => $product->price_regular,
                'price_discounted' => $product->price_discounted,
                'stock_quantity' => $product->stock_quantity,
                'status' => $product->status->value,
                'featured_image_url' => $product->thumbnail ? asset('storage/' . $product->thumbnail) : null,
                'gallery_images' => $galleryImages
            ]
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        // Authorize: Ensure the product belongs to the seller
        $this->authorize('update', $product);

        $validated = $request->validated();

        // Set price_discounted to 0 if it's null or empty
        $validated['price_discounted'] = $validated['price_discounted'] ?? 0;

        // Get the seller
        $seller = Auth::guard('seller')->user();

        // Create directories based on seller ID and name
        $sellerName = str_replace(' ', '_', strtolower($seller->name));
        $featuredImagesDir = "storage/products/{$seller->id}_{$sellerName}_featured_images";
        $productImagesDir = "storage/products/{$seller->id}_{$sellerName}_product_images";

        // Ensure directories exist in public folder
        if (!File::exists(public_path($featuredImagesDir))) {
            File::makeDirectory(public_path($featuredImagesDir), 0755, true);
        }
        if (!File::exists(public_path($productImagesDir))) {
            File::makeDirectory(public_path($productImagesDir), 0755, true);
        }

        // Handle featured image update
        /** @var \Illuminate\Http\Request $request */
        if ($request->hasFile('featured_image')) {
            // Delete old image if it exists
            if ($product->thumbnail && File::exists(public_path($product->thumbnail))) {
                File::delete(public_path($product->thumbnail));
            }

            $file = $request->file('featured_image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($featuredImagesDir), $filename);
            $validated['thumbnail'] = $featuredImagesDir . '/' . $filename;
        }

        // Convert status enum value if needed
        $validated['status'] = ProductStatus::from($validated['status']);

        $product->update($validated);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path($productImagesDir), $filename);
                $path = $productImagesDir . '/' . $filename;

                // Create product image record
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Check where to redirect based on the form origin
        if ($request->input('redirect_to') === 'show') {
            return redirect()->route('seller.products.show', $product->slug)
                ->with('success', 'Product updated successfully.');
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Authorize: Ensure the product belongs to the seller
        $this->authorize('delete', $product);

        // Delete the featured image if it exists
        if ($product->thumbnail && File::exists(public_path($product->thumbnail))) {
            File::delete(public_path($product->thumbnail));
        }

        // Delete all gallery images
        foreach ($product->images as $image) {
            if (File::exists(public_path($image->image_path))) {
                File::delete(public_path($image->image_path));
            }
            $image->delete();
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Delete a specific gallery image.
     */
    public function deleteGalleryImage(ProductImage $image): \Illuminate\Http\JsonResponse
    {
        // Get the product
        $product = $image->product;

        // Authorize: Ensure the product belongs to the seller
        $this->authorize('update', $product);

        // Delete the image file
        if (File::exists(public_path($image->image_path))) {
            File::delete(public_path($image->image_path));
        }

        // Delete the image record
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
