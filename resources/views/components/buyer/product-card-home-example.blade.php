{{-- Example usage of the product-card-home component --}}

{{-- Single product card --}}
<x-buyer.product-card-home :product="$product" />

{{-- Product card with vendor information --}}
<x-buyer.product-card-home :product="$product" :vendor="$vendor" />

{{-- In a grid layout (recommended usage) --}}
<div class="products-grid">
    @foreach ($products as $product)
        <x-buyer.product-card-home :product="$product" />
    @endforeach
</div>

<style>
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 12px;
        }
    }
</style>
