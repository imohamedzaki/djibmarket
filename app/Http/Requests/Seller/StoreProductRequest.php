<?php

namespace App\Http\Requests\Seller;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Ensure the user is authenticated (is a seller)
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price_regular' => ['required', 'numeric', 'min:10'],
            'price_discounted' => [
                'nullable',
                'numeric',
                'min:0',
                'lt:price_regular'
            ],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'status' => ['required', new Enum(ProductStatus::class)],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:1536'], // Max 1.5MB
            'gallery_images' => ['nullable', 'array', 'max:15'], // Maximum 10 images
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:1536'], // Each image max 1.5MB
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}