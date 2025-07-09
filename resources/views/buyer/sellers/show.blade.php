@extends('layouts.app.buyer')

@section('title', $seller->name . ' - Seller Profile')

@section('content')
    <div class="seller-profile-page">
        <!-- Seller Header -->
        <div class="container mb-4">
            <div class="seller-header">
                <div class="seller-banner">
                    @if ($seller->cover_image)
                        <img src="{{ asset('storage/' . $seller->cover_image) }}" alt="{{ $seller->name }} Cover"
                            class="seller-cover">
                    @else
                        <div class="default-cover"></div>
                    @endif
                </div>
                <div class="seller-info-section">
                    <div class="seller-avatar-container">
                        @if ($seller->avatar)
                            <img src="{{ asset('storage/' . $seller->avatar) }}" alt="{{ $seller->name }}"
                                class="seller-avatar">
                        @else
                            <div class="default-avatar">
                                <i class="fas fa-store"></i>
                            </div>
                        @endif
                    </div>
                    <div class="seller-details">
                        <h1 class="seller-name">{{ $seller->name }}</h1>
                        <div class="seller-meta">
                            <span class="product-count">{{ $products->total() }} Products</span>
                            <span class="join-date">Joined {{ $seller->created_at->format('M Y') }}</span>
                        </div>
                        @if ($seller->businessActivity)
                            <div class="business-category">
                                <i class="fas fa-tag"></i>
                                {{ $seller->businessActivity->name }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Seller Products -->
        <div class="container">
            <div class="seller-products-section">
                <h2 class="section-title">Products from {{ $seller->name }}</h2>

                @if ($products->count() > 0)
                    <div class="products-grid">
                        @foreach ($products as $product)
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="{{ route('buyer.product.show', $product->slug ?? $product->id) }}">
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->title }}" loading="lazy">
                                        @else
                                            <div class="no-image-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </a>
                                    @if ($product->price_discounted && $product->price_discounted < $product->price_regular)
                                        <div class="discount-badge">
                                            {{ round((($product->price_regular - $product->price_discounted) / $product->price_regular) * 100) }}%
                                            OFF
                                        </div>
                                    @endif
                                </div>
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="{{ route('buyer.product.show', $product->slug ?? $product->id) }}">
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    <div class="product-price">
                                        @if ($product->price_discounted && $product->price_discounted < $product->price_regular)
                                            <span
                                                class="price-discounted">${{ number_format($product->price_discounted, 2) }}</span>
                                            <span
                                                class="price-original">${{ number_format($product->price_regular, 2) }}</span>
                                        @else
                                            <span
                                                class="price-regular">${{ number_format($product->price_regular, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-category">
                                        <a
                                            href="{{ route('categories.show', $product->category->slug ?? $product->category->id) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="no-products">
                        <div class="no-products-content">
                            <i class="fas fa-box-open no-products-icon"></i>
                            <h3>No Products Available</h3>
                            <p>This seller hasn't listed any products yet.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .seller-profile-page {
            padding: 20px 0;
        }

        .seller-header {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .seller-banner {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .seller-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .default-cover {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .seller-info-section {
            position: relative;
            padding: 40px 30px 30px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .seller-avatar-container {
            position: relative;
            margin-top: -60px;
        }

        .seller-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .default-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            background: #f7fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a0aec0;
            font-size: 2.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .seller-details {
            flex: 1;
            padding-top: 10px;
        }

        .seller-name {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 10px;
        }

        .seller-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            color: #718096;
        }

        .business-category {
            color: #4a5568;
            font-weight: 500;
        }

        .business-category i {
            margin-right: 8px;
        }

        .seller-products-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 30px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product-card {
            background: #f8fafc;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            position: relative;
            padding-bottom: 75%;
            overflow: hidden;
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #edf2f7;
            color: #a0aec0;
            font-size: 2rem;
        }

        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e53e3e;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-title a {
            color: #2d3748;
            text-decoration: none;
        }

        .product-title a:hover {
            color: #667eea;
        }

        .product-price {
            margin-bottom: 8px;
        }

        .price-discounted {
            font-size: 1.1rem;
            font-weight: 700;
            color: #e53e3e;
        }

        .price-original {
            font-size: 0.9rem;
            color: #718096;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .price-regular {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2d3748;
        }

        .product-category a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .product-category a:hover {
            text-decoration: underline;
        }

        .no-products {
            text-align: center;
            padding: 60px 20px;
        }

        .no-products-icon {
            font-size: 4rem;
            color: #a0aec0;
            margin-bottom: 20px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .seller-info-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .seller-avatar-container {
                margin-top: -60px;
            }

            .seller-name {
                font-size: 1.5rem;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }
    </style>
@endsection
