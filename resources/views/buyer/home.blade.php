@extends('layouts.app.buyer')

@section('css')
    <style>
        /* Custom styles for Flash Sales and consistent product card sizing */
        .swiper-group-3-hotdeal .card-product-small {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .swiper-group-3-hotdeal .card-product-small .card-image {
            flex-shrink: 0;
        }

        .swiper-group-3-hotdeal .card-product-small .card-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px 10px 10px;
        }

        .swiper-group-3-hotdeal .swiper-slide {
            height: auto;
        }

        .swiper-group-3-hotdeal .card-product-small .card-info .product-title {
            margin-bottom: 8px;
            min-height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .swiper-group-3-hotdeal .card-product-small .card-info .box-prices {
            margin-top: auto;
        }

        .flash-sale-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff4757;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
        }

        .flash-sale-timer {
            font-size: 11px;
            color: #ff4757;
            margin-top: 5px;
            font-weight: 600;
        }

        .discount-percentage {
            font-size: 12px;
            color: #28a745;
            margin-top: 5px;
            font-weight: 600;
        }

        .no-products-container {
            text-align: center;
            padding: 60px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .no-products-container:hover {
            background: #e9ecef;
            border-color: #ced4da;
        }

        .no-products-icon svg {
            transition: opacity 0.3s ease;
        }

        .no-products-container:hover .no-products-icon svg {
            opacity: 0.6;
        }
    </style>
@endsection

@section('content')
    @include('layouts.app.partials.buyer.ads.ads_space_1')
    {{-- @include('layouts.app.partials.buyer.ads.ads_box_4') --}}
    @include('layouts.app.partials.buyer.main_swiper')
    @include('layouts.app.partials.buyer.ads.ads_companies')
    @include('layouts.app.partials.buyer.categories.products_categories_1')
    @include('layouts.app.partials.buyer.ads.ads_space_2')
    @include('layouts.app.partials.buyer.flash_deals')
    @include('layouts.app.partials.buyer.ads.ads_space_3')
    @include('layouts.app.partials.buyer.categories.products_categories_2')
    @include('layouts.app.partials.buyer.ads.ads_space_4')
    @include('layouts.app.partials.buyer.ads.ads_space_5')
    @include('layouts.app.partials.buyer.categories.products_categories_3')
    @include('layouts.app.partials.buyer.latest_deals')
    @include('layouts.app.partials.buyer.categories.products_categories_4')
    @include('layouts.app.partials.buyer.top_brands')
    @include('layouts.app.partials.buyer.ads.ads_space_6')
    @include('layouts.app.partials.buyer.categories.single_promoting_1')
    @include('layouts.app.partials.buyer.ads.ads_space_7')
    @include('layouts.app.partials.buyer.picked_by_djibmarket')
    @include('layouts.app.partials.buyer.bestseller_trending')
    {{-- @include('layouts.app.partials.buyer.latest_news') --}}
    @include('layouts.app.partials.buyer.platform_features_bottom')
@endsection
