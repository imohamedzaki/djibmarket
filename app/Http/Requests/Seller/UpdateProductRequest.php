<?php

namespace App\Http\Requests\Seller;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get the product from the route
        $product = request()->route('product');

        // Ensure the user is authenticated and owns the product
        return Auth::check() && $product && $product->seller_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Generally the same rules as store, but perhaps adjust if needed
        // e.g., making some fields optional if they don't always need to be provided on update
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price_regular' => ['required', 'numeric', 'min:10'],
            'price_discounted' => [
                'nullable',         // Optional
                'numeric',          // Must be a number if present
                'min:0',            // Cannot be negative
                'lt:price_regular' // Must be less than the regular price
            ],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'status' => ['required', new Enum(ProductStatus::class)],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:1536'], // Max 1.5MB
            'gallery_images' => ['nullable', 'array', 'max:10'], // Maximum 10 images
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:1536'], // Each image max 1.5MB
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
