@extends('layouts.app.seller')
@section('title', $product->title)

@push('head-scripts')
    <!-- Slick Slider CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
@endpush

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Product Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.products.index') }}">Products</a></li>
                                <li class="breadcrumb-item active">{{ $product->title }}</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <button type="button" class="btn btn-primary edit-product-button"
                                            data-bs-toggle="modal" data-bs-target="#editProductModal"
                                            data-id="{{ $product->id }}" data-slug="{{ $product->slug }}"
                                            data-title="{{ $product->title }}"
                                            data-description="{{ $product->description }}"
                                            data-price="{{ $product->price_regular }}"
                                            data-price-discounted="{{ $product->price_discounted }}"
                                            data-stock="{{ $product->stock_quantity }}"
                                            data-status="{{ $product->status->value }}"
                                            data-category-id="{{ $product->category_id }}"
                                            data-has-image="{{ $product->thumbnail ? 'true' : 'false' }}"
                                            data-image-url="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}">
                                            <em class="icon ni ni-edit"></em><span>Edit Product</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-danger delete-product-button"
                                            data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                                            data-slug="{{ $product->slug }}" data-name="{{ $product->title }}"
                                            data-delete-url="{{ route('seller.products.destroy', $product->slug) }}">
                                            <em class="icon ni ni-trash"></em><span>Delete Product</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            {{-- Session Success/Error Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            <div class="nk-block">
                <div class="card">
                    <div class="card-inner">
                        <div class="row g-4">
                            <div class="col-lg-5">
                                <div class="product-gallery">
                                    <div class="product-gallery-main border border-light rounded p-3" id="img-container">
                                        @if ($product->thumbnail)
                                            <div class="img-zoom-container">
                                                <img id="featured-image"
                                                    src="{{ asset('storage/' . $product->thumbnail) }}"
                                                    alt="{{ $product->title }}" class="w-100 cursor-pointer"
                                                    onclick="openImageModal('{{ asset('storage/' . $product->thumbnail) }}', 0)">
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-lighter rounded"
                                                style="height: 350px;">
                                                <span class="text-muted">No featured image available</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-gallery-thumbs mt-3">
                                        <div class="product-thumbs-slider">
                                            @if ($product->thumbnail)
                                                <div class="thumb-item border-primary"
                                                    onclick="openImageModal('{{ asset('storage/' . $product->thumbnail) }}', 0)">
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        alt="Thumbnail" class="thumb-img">
                                                </div>
                                            @endif
                                            @forelse($product->images as $image)
                                                <div class="thumb-item"
                                                    onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}', {{ $loop->index + 1 }})">
                                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                                        alt="Gallery Image" class="thumb-img">
                                                </div>
                                            @empty
                                                @if (!$product->thumbnail)
                                                    <div class="text-muted">No gallery images available</div>
                                                @endif
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7" style="position: relative;">
                                <div class="product-info">
                                    <div id="img-zoom-result" class="mb-3"></div>
                                    <h3 class="product-title mb-2">{{ $product->title }}</h3>
                                    <div class="product-meta mb-3">
                                        <span class="badge bg-primary">SKU: {{ $product->sku ?? 'N/A' }}</span>
                                        <span
                                            class="badge bg-{{ $product->status->color() }}">{{ $product->status->label() }}</span>
                                        @if ($product->category)
                                            <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                        @endif
                                    </div>
                                    <div class="product-price mb-3">
                                        @if ($product->price_discounted)
                                            <div class="price-sale">
                                                <span
                                                    class="price-old fs-6 text-muted text-decoration-line-through">{{ number_format($product->price_regular, 2) }}</span>
                                                <span
                                                    class="price-current fs-4 fw-medium text-success">{{ number_format($product->price_discounted, 2) }}</span>
                                            </div>
                                            <div class="price-save mt-1">
                                                @php
                                                    $discount =
                                                        (($product->price_regular - $product->price_discounted) /
                                                            $product->price_regular) *
                                                        100;
                                                @endphp
                                                <span class="badge bg-success">Save
                                                    {{ number_format($discount, 0) }}%</span>
                                            </div>
                                        @else
                                            <span
                                                class="price-current fs-4 fw-medium">{{ number_format($product->price_regular, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-stock mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="me-1">Stock:</span>
                                            @if ($product->stock_quantity > 10)
                                                <span class="badge bg-success">In Stock ({{ $product->stock_quantity }}
                                                    available)</span>
                                            @elseif($product->stock_quantity > 0)
                                                <span class="badge bg-warning">Low Stock ({{ $product->stock_quantity }}
                                                    left)</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-description mb-4">
                                        <h6 class="mb-2">Description</h6>
                                        <div class="description-text">
                                            {!! nl2br(e($product->description)) !!}
                                        </div>
                                    </div>
                                    <div class="product-meta-info">
                                        <ul class="list-group list-group-borderless">
                                            <li class="list-group-item d-flex justify-content-between px-3">
                                                <span class="text-muted">Created:</span>
                                                <span>{{ $product->created_at->format('M d, Y h:i A') }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between px-3">
                                                <span class="text-muted">Last Updated:</span>
                                                <span>{{ $product->updated_at->format('M d, Y h:i A') }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between px-3">
                                                <span class="text-muted">Slug:</span>
                                                <span>{{ $product->slug }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($product->images) > 0)
                <div class="nk-block mt-4">
                    <div class="card">
                        <div class="card-inner">
                            <h5 class="card-title mb-3">Product Gallery</h5>
                            <div class="product-gallery-slider">
                                @foreach ($product->images as $image)
                                    <div class="gallery-slide-item">
                                        <div class="gallery-item">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image"
                                                class="rounded">
                                            <button type="button" class="btn btn-danger btn-sm delete-gallery-image"
                                                data-image-id="{{ $image->id }}">
                                                <em class="icon ni ni-trash"></em>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="nk-block-head nk-block-head-sm mt-4">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary">
                            <em class="icon ni ni-arrow-left"></em><span>Back to Products</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal Lightbox --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0 py-2">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center p-md-5">
                    <div class="image-slideshow">
                        <div class="slideshow-container">
                            {{-- Images will be dynamically loaded here --}}
                        </div>
                        <a class="slideshow-prev" onclick="changeSlide(-1)">❮</a>
                        <a class="slideshow-next" onclick="changeSlide(1)">❯</a>
                    </div>
                    <div class="thumbnails-wrapper mt-4">
                        <button class="thumbnails-nav thumbnails-prev" onclick="scrollThumbnails(-1)">❮</button>
                        <div class="slideshow-thumbnails">
                            {{-- Thumbnails will be dynamically loaded here --}}
                        </div>
                        <button class="thumbnails-nav thumbnails-next" onclick="scrollThumbnails(1)">❯</button>
                    </div>
                    <div class="slideshow-counter text-white mt-3">1 / 1</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Edit Product Modal - This will be the same modal as in index.blade.php --}}
    {{-- Include Delete Product Modal - This will be the same modal as in index.blade.php --}}

@endsection

@section('css')
    <style>
        .product-gallery-main {
            min-height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .product-gallery-main img {
            max-height: 350px;
            max-width: 100%;
            object-fit: contain;
        }

        .thumb-item {
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
            border: 2px solid #e5e9f2;
            transition: all 0.2s ease;
        }

        .thumb-img {
            transition: all 0.2s ease;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .thumb-item:hover {
            border-color: #6576ff !important;
            transform: translateY(-2px);
        }

        .thumb-item.border-primary {
            border-color: #6576ff !important;
            border-width: 2px !important;
        }

        .gallery-item {
            margin-bottom: 15px;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            border: 1px solid #e5e9f2;
            transition: all 0.3s ease;
            height: 180px;
        }

        .gallery-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .gallery-item .btn {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .btn {
            opacity: 1;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 1.5px solid #ddd
        }

        .file-thumbnails {
            height: 100%;
        }

        #current-gallery-images {
            height: 100%;
        }

        .gallery-images-container {
            height: 100%;
        }

        .product-gallery-thumbs-container {
            height: 100%;
            padding: .5rem;
        }

        /* Slider styles */
        .product-thumbs-slider {
            width: 100%;
            position: relative;
            margin: 0 auto;
        }

        .product-thumbs-slider .slick-slide {
            margin: 0 5px;
        }

        .product-thumbs-slider .slick-list {
            margin: 0 -5px;
        }

        .product-thumbs-slider .slick-prev,
        .product-thumbs-slider .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            z-index: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-thumbs-slider .slick-prev {
            left: -10px;
        }

        .product-thumbs-slider .slick-next {
            right: -10px;
        }

        /* Gallery slider styles */
        .product-gallery-slider {
            width: 100%;
            position: relative;
            margin: 0 auto;
        }

        .gallery-slide-item {
            padding: 10px;
        }

        .product-gallery-slider .slick-prev,
        .product-gallery-slider .slick-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            z-index: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-gallery-slider .slick-prev {
            left: -15px;
        }

        .product-gallery-slider .slick-next {
            right: -15px;
        }

        /* Horizontal product images display - No longer needed */
        .product-images-horizontal,
        .product-image-item {
            display: none;
        }

        /* Image Zoom Feature */
        .img-zoom-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #featured-image {
            max-height: 350px;
            object-fit: contain;
            cursor: crosshair;
        }

        #img-zoom-result {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 350px;
            border: 2px solid #e5e9f2;
            background-color: white;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            background-repeat: no-repeat;
            z-index: 100;
            border-radius: 4px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            display: none;
        }

        #img-container:hover~.col-lg-7 #img-zoom-result,
        .img-zoom-container:hover~.col-lg-7 #img-zoom-result {
            opacity: 1;
            display: block;
        }

        @media (max-width: 991px) {
            #img-zoom-result {
                display: none !important;
            }
        }

        /* Image Modal Lightbox */
        .image-slideshow {
            position: relative;
            max-width: 100%;
            width: 100%;
            margin: auto;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden;
        }

        .slideshow-container {
            position: relative;
            max-height: 65vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            overflow: hidden;
        }

        .slide {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slideshow-container img {
            max-height: 65vh;
            max-width: 100%;
            object-fit: contain;
            margin: 0 auto;
        }

        .slideshow-prev,
        .slideshow-next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -30px;
            color: white;
            font-weight: bold;
            font-size: 30px;
            transition: 0.3s ease;
            border-radius: 50%;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 10;
            height: 60px;
            width: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .thumbnails-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            position: relative;
            max-width: 960px;
            margin: 0 auto;
            padding: 10px 0;
            flex-shrink: 0;
        }

        .slideshow-thumbnails {
            overflow-x: hidden;
            scrollbar-width: none;
            white-space: nowrap;
            padding: 15px 0;
            width: 890px;
            /* Width for 9 thumbnails (90px each + 6px margin on each side) */
            margin: 0 auto;
            display: flex;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .slideshow-thumbnails::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .slideshow-thumbnails::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .slideshow-thumbnails::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .slideshow-thumbnails::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .slideshow-thumbnail {
            width: 90px;
            height: 90px;
            cursor: pointer;
            object-fit: cover;
            border: 3px solid transparent;
            border-radius: 4px;
            transition: all 0.25s ease;
            margin: 0 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .slideshow-thumbnail.active {
            border-color: #6576ff;
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .slideshow-thumbnail:hover:not(.active) {
            transform: translateY(-4px);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .slideshow-counter {
            font-size: 16px;
            padding: 8px 16px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            display: inline-block;
        }

        #imageModal .modal-dialog {
            margin: 0;
            max-width: 100%;
            height: 100%;
            overflow: hidden;
        }

        #imageModal .modal-content {
            height: 100%;
            border: none;
            overflow: hidden;
        }

        #imageModal .modal-body {
            height: 100%;
            padding: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Prevent scrollbars */
        #imageModal {
            overflow: hidden !important;
        }

        body.modal-open {
            overflow: hidden;
            padding-right: 0 !important;
        }

        #imageModal .btn-close {
            position: absolute;
            right: 20px;
            top: 20px;
            z-index: 1050;
            opacity: 0.8;
            font-size: 12px;
        }

        #imageModal .btn-close:hover {
            opacity: 1;
        }

        /* Cursor styles */
        .cursor-pointer {
            cursor: pointer;
        }

        .slideshow-next {
            right: 20px;
        }

        .slideshow-prev {
            left: 20px;
        }

        .slideshow-prev:hover,
        .slideshow-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Thumbnails navigation */
        .thumbnails-nav {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .thumbnails-nav:hover {
            background-color: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        .thumbnails-prev {
            left: 5px;
        }

        .thumbnails-next {
            right: 5px;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Image zoom functionality
            const featuredImage = document.getElementById('featured-image');
            const result = document.getElementById('img-zoom-result');
            const imgContainer = document.getElementById('img-container');

            if (featuredImage && result) {
                imgContainer.addEventListener('mousemove', function(e) {
                    // Make sure zoom result is visible
                    result.style.display = 'block';
                    result.style.opacity = '1';

                    // Get cursor position
                    const rect = featuredImage.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    // Calculate percentage position
                    const xPercent = (x / rect.width) * 100;
                    const yPercent = (y / rect.height) * 100;

                    // Calculate zoom level
                    const zoomLevel = 2.5;

                    // Apply the background position to the result element
                    result.style.backgroundImage = `url('${featuredImage.src}')`;
                    result.style.backgroundSize = (featuredImage.width * zoomLevel) + "px " + (featuredImage
                        .height * zoomLevel) + "px";
                    result.style.backgroundPosition = xPercent + '% ' + yPercent + '%';
                });

                // Hide zoom when mouse leaves
                imgContainer.addEventListener('mouseleave', function() {
                    result.style.display = 'none';
                    result.style.opacity = '0';
                });

                // Handle thumbnail click to change main image with zoom
                $('.product-thumbs-slider').on('click', '.thumb-item', function() {
                    const imgSrc = $(this).find('img').attr('src');
                    $('#featured-image').attr('src', imgSrc);

                    // Update active state
                    $('.thumb-item').removeClass('border-primary');
                    $(this).addClass('border-primary');
                });
            }

            // Initialize thumbnail slider
            $('.product-thumbs-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                arrows: true,
                infinite: true,
                vertical: false,
                prevArrow: '<button type="button" class="slick-prev"><em class="icon ni ni-chevron-left"></em></button>',
                nextArrow: '<button type="button" class="slick-next"><em class="icon ni ni-chevron-right"></em></button>',
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 2,
                        }
                    }
                ]
            });

            // Initialize gallery slider if it exists
            if ($('.product-gallery-slider').length > 0) {
                $('.product-gallery-slider').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    infinite: true,
                    vertical: false,
                    prevArrow: '<button type="button" class="slick-prev"><em class="icon ni ni-chevron-left"></em></button>',
                    nextArrow: '<button type="button" class="slick-next"><em class="icon ni ni-chevron-right"></em></button>',
                    responsive: [{
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
            }

            // Handle gallery image deletion
            $(document).on('click', '.delete-gallery-image', function(e) {
                e.preventDefault();

                var $btn = $(this);
                var imageId = $btn.data('image-id');

                if (confirm('Are you sure you want to delete this image?')) {
                    // Disable the button
                    $btn.prop('disabled', true);

                    // Send AJAX request to delete
                    var baseUrl = "{{ url('/') }}";
                    var deleteUrl = baseUrl + "/seller/gallery-images/" + imageId;

                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Remove the image from the UI
                                if ($('.product-gallery-slider').length > 0) {
                                    // If in slider view
                                    $btn.closest('.gallery-slide-item').fadeOut(300,
                                        function() {
                                            // Remove the slide
                                            var $slider = $('.product-gallery-slider');
                                            $slider.slick('slickRemove', $btn.closest(
                                                '.gallery-slide-item').data(
                                                'slick-index'));

                                            // Check if we need to reload
                                            if ($slider.find('.gallery-item').length <= 1) {
                                                location.reload();
                                            }
                                        });
                                } else {
                                    // If in grid view
                                    $btn.closest('.col-6').fadeOut(300, function() {
                                        $(this).remove();

                                        // Check if there are any remaining images
                                        if ($('.gallery-item').length === 0) {
                                            // If no images left, refresh the page to update the UI
                                            location.reload();
                                        }
                                    });
                                }
                            } else {
                                alert('Failed to delete image. Please try again.');
                                $btn.prop('disabled', false);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert(
                                'An error occurred while deleting the image. Please try again.'
                            );
                            $btn.prop('disabled', false);
                        }
                    });
                }
            });

            // Image Modal Slideshow
            window.currentSlide = 0;
            window.allImages = [];

            // Prepare image data for modal
            @if ($product->thumbnail)
                window.allImages.push({
                    src: "{{ asset('storage/' . $product->thumbnail) }}",
                    alt: "{{ $product->title }}"
                });
            @endif

            @foreach ($product->images as $image)
                window.allImages.push({
                    src: "{{ asset('storage/' . $image->image_path) }}",
                    alt: "Gallery Image {{ $loop->index + 1 }}"
                });
            @endforeach

            // When the modal is shown, load the images
            $('#imageModal').on('show.bs.modal', function() {
                const slideshowContainer = document.querySelector('.slideshow-container');
                const thumbnailsContainer = document.querySelector('.slideshow-thumbnails');

                // Clear existing content
                slideshowContainer.innerHTML = '';
                thumbnailsContainer.innerHTML = '';

                // Add all images to the slideshow
                window.allImages.forEach((image, index) => {
                    // Add main slides
                    const slideDiv = document.createElement('div');
                    slideDiv.className = 'slide';
                    slideDiv.style.display = index === window.currentSlide ? 'flex' : 'none';

                    const img = document.createElement('img');
                    img.src = image.src;
                    img.alt = image.alt;
                    img.className = 'img-fluid';

                    slideDiv.appendChild(img);
                    slideshowContainer.appendChild(slideDiv);

                    // Add thumbnails
                    const thumb = document.createElement('img');
                    thumb.src = image.src;
                    thumb.alt = `Thumbnail ${index + 1}`;
                    thumb.className = 'slideshow-thumbnail';
                    if (index === window.currentSlide) {
                        thumb.classList.add('active');
                    }
                    thumb.onclick = function() {
                        showSlide(index);
                    };

                    thumbnailsContainer.appendChild(thumb);
                });

                // Update counter
                updateCounter();

                // Initialize thumbnail navigation buttons state
                setTimeout(() => {
                    updateThumbnailNavButtons();

                    // Scroll to make active thumbnail visible
                    const activeThumb = document.querySelector('.slideshow-thumbnail.active');
                    if (activeThumb) {
                        activeThumb.scrollIntoView({
                            behavior: 'auto',
                            block: 'nearest',
                            inline: 'center'
                        });
                    }
                }, 100);
            });

            // Enable keyboard navigation in modal
            $(document).on('keydown', function(e) {
                if ($('#imageModal').hasClass('show')) {
                    if (e.keyCode === 37) { // Left arrow
                        changeSlide(-1);
                    } else if (e.keyCode === 39) { // Right arrow
                        changeSlide(1);
                    } else if (e.keyCode === 27) { // Escape
                        $('#imageModal').modal('hide');
                    }
                }
            });

            // --- Setup for edit product modal ---
            $(document).on('click', '.edit-product-button', function() {
                var $btn = $(this);
                var id = $btn.data('id');
                var slug = $btn.data('slug');
                var title = $btn.data('title');
                var description = $btn.data('description');
                var price = $btn.data('price');
                var priceDiscounted = $btn.data('price-discounted');
                var stock = $btn.data('stock');
                var status = $btn.data('status');
                var categoryId = $btn.data('category-id');
                var hasImage = $btn.data('has-image');
                var imageUrl = $btn.data('image-url');

                // Set form action URL using the route provided in the data attribute
                var updateUrl = "{{ route('seller.products.update', ['product' => ':slug']) }}".replace(
                    ':slug', slug);
                $('#editProductForm').attr('action', updateUrl);

                // Fill form fields
                $('#edit-product-id').val(id);
                $('#edit-product-title').val(title);
                $('#edit-product-price').val(price);
                $('#edit-product-price-discounted').val(priceDiscounted);
                $('#edit-product-stock').val(stock);
                $('#edit-product-description').val(description);
                $('#edit-product-status').val(status).trigger('change');

                // Set category if provided
                if (categoryId) {
                    $('#edit-product-category').val(categoryId).trigger('change');
                } else {
                    $('#edit-product-category').val('').trigger('change');
                }

                // Handle featured image display
                if (hasImage && imageUrl) {
                    $('#edit-product-current-image').attr('src', imageUrl).show();
                    $('#edit-product-no-image').hide();
                } else {
                    $('#edit-product-current-image').hide();
                    $('#edit-product-no-image').show();
                }

                // Load gallery images
                loadProductGalleryImages(slug);
            });

            // Load product gallery images for edit modal
            function loadProductGalleryImages(slug) {
                // Clear the container first
                var $container = $('#current-gallery-images .gallery-images-container');
                $container.empty().hide();
                $('#no-gallery-images').hide();

                // Show loading indicator
                $container.append(
                    '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                );
                $container.show();

                // Fetch the gallery images
                var editUrl = "{{ route('seller.products.edit', ['product' => ':slug']) }}".replace(':slug', slug);

                $.ajax({
                    url: editUrl,
                    method: 'GET',
                    success: function(response) {
                        // Remove loading indicator
                        $container.empty();

                        if (response.success && response.product.gallery_images && response.product
                            .gallery_images.length > 0) {
                            // Add each image to the container
                            response.product.gallery_images.forEach(function(image) {
                                var imageHtml = `
                                    <div class="gallery-image-item position-relative" style="width: 100px; margin-right: 10px; margin-bottom: 10px;">
                                        <img src="${image.url}" alt="Gallery Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-gallery-image" 
                                                data-image-id="${image.id}" style="padding: 0.1rem 0.3rem;">
                                            <em class="icon ni ni-trash"></em>
                                        </button>
                                    </div>
                                `;
                                $container.append(imageHtml);
                            });

                            $container.show();
                        } else {
                            $('#no-gallery-images').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Remove loading indicator
                        $container.empty();
                        $('#no-gallery-images').show();
                    }
                });
            }

            // Delete product handling
            $(document).on('click', '.delete-product-button', function() {
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                $('#delete-product-title').text(name);
                $('#deleteProductForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteProductForm').submit();
            });

            // Handle Edit Product Form Submission
            $('#editProductForm').on('submit', function() {
                var $submitBtn = $('#updateProductBtn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });
        });
    </script>

    {{-- Global functions for Image Modal --}}
    <script>
        // Open the image modal with a specific image
        function openImageModal(src, index) {
            window.currentSlide = index;
            // Ensure modal is fully shown before manipulating content
            $('#imageModal').modal('show');

            // Preload the current image to ensure it displays correctly
            const img = new Image();
            img.src = src;

            img.onload = function() {
                // After image is loaded, update the modal content
                showSlide(index);
            };
        }

        // Show a specific slide
        function showSlide(n) {
            const slides = document.querySelectorAll('.slide');
            const thumbnails = document.querySelectorAll('.slideshow-thumbnail');

            if (slides.length === 0) return;

            // Update current slide index
            window.currentSlide = n;

            // Handle circular navigation
            if (window.currentSlide >= slides.length) {
                window.currentSlide = 0;
            }
            if (window.currentSlide < 0) {
                window.currentSlide = slides.length - 1;
            }

            // Hide all slides and show the current one
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            // Remove active class from all thumbnails
            for (let i = 0; i < thumbnails.length; i++) {
                thumbnails[i].classList.remove("active");
            }

            slides[window.currentSlide].style.display = "flex";
            thumbnails[window.currentSlide].classList.add("active");

            // Ensure the image is centered
            const currentImage = slides[window.currentSlide].querySelector('img');
            if (currentImage) {
                // Reset any previous transforms/styles
                currentImage.style.maxHeight = '70vh';
                currentImage.style.maxWidth = '100%';
            }

            // Scroll thumbnail into view if needed
            thumbnails[window.currentSlide].scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });

            // Update thumbnail navigation buttons visibility
            updateThumbnailNavButtons();

            // Update the counter
            updateCounter();
        }

        // Change slide based on direction (prev/next)
        function changeSlide(direction) {
            showSlide(window.currentSlide + direction);
        }

        // Update the slide counter
        function updateCounter() {
            const counter = document.querySelector('.slideshow-counter');
            const slideCount = window.allImages.length;
            counter.textContent = `${window.currentSlide + 1} / ${slideCount}`;
        }

        // Scroll the thumbnails container
        function scrollThumbnails(direction) {
            const container = document.querySelector('.slideshow-thumbnails');
            const scrollAmount = 102; // 90px thumbnail width + 12px margins
            const maxScroll = container.scrollWidth - container.clientWidth;

            if (direction > 0) {
                // Scroll right
                const newScrollPosition = Math.min(container.scrollLeft + (scrollAmount * 3), maxScroll);
                container.scrollTo({
                    left: newScrollPosition,
                    behavior: 'smooth'
                });
            } else {
                // Scroll left
                const newScrollPosition = Math.max(container.scrollLeft - (scrollAmount * 3), 0);
                container.scrollTo({
                    left: newScrollPosition,
                    behavior: 'smooth'
                });
            }

            // Update visibility of navigation buttons
            updateThumbnailNavButtons();
        }

        // Update visibility of thumbnail navigation buttons
        function updateThumbnailNavButtons() {
            const container = document.querySelector('.slideshow-thumbnails');
            const prevBtn = document.querySelector('.thumbnails-prev');
            const nextBtn = document.querySelector('.thumbnails-next');

            // Hide/show prev button based on scroll position
            if (container.scrollLeft <= 10) {
                prevBtn.style.opacity = '0.3';
            } else {
                prevBtn.style.opacity = '1';
            }

            // Hide/show next button based on scroll position
            if (container.scrollLeft >= container.scrollWidth - container.clientWidth - 10) {
                nextBtn.style.opacity = '0.3';
            } else {
                nextBtn.style.opacity = '1';
            }
        }
    </script>

    {{-- Include Edit Product Modal - This will be the same modal as in index.blade.php --}}
    {{-- Include Delete Product Modal - This will be the same modal as in index.blade.php --}}

    {{-- Edit Product Modal --}}
    <div class="modal fade" id="editProductModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Form action will be set dynamically by JS --}}
                    <form action="" method="POST" id="editProductForm" class="form-validate is-alter"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method for update --}}
                        <input type="hidden" name="id" id="edit-product-id"> {{-- Hidden field for ID --}}
                        <input type="hidden" name="redirect_to" value="show"> {{-- Hidden field to track origin --}}

                        <div class="row gx-4 gy-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-title">Product Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text"
                                            class="form-control @error('title', 'update') is-invalid @enderror"
                                            id="edit-product-title" name="title" value="{{ old('title') }}" required>
                                    </div>
                                    @error('title', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-price">Regular Price</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_regular', 'update') is-invalid @enderror"
                                            id="edit-product-price" name="price_regular"
                                            value="{{ old('price_regular') }}" required step="0.01" min="10">
                                    </div>
                                    @error('price_regular', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Add Discounted Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-price-discounted">Discounted Price
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('price_discounted', 'update') is-invalid @enderror"
                                            id="edit-product-price-discounted" name="price_discounted"
                                            value="{{ old('price_discounted') }}" step="0.01" min="0"
                                            placeholder="Leave blank if no discount">
                                    </div>
                                    @error('price_discounted', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-stock">Stock Quantity</label>
                                    <div class="form-control-wrap">
                                        <input type="number"
                                            class="form-control @error('stock_quantity', 'update') is-invalid @enderror"
                                            id="edit-product-stock" name="stock_quantity"
                                            value="{{ old('stock_quantity') }}" required min="0">
                                    </div>
                                    @error('stock_quantity', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- Category Selection --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-category">Category</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('category_id', 'update') is-invalid @enderror"
                                            id="edit-product-category" name="category_id"
                                            data-placeholder="Select Category" required>
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control @error('description', 'update') is-invalid @enderror" id="edit-product-description"
                                            name="description">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Current Featured Image</label>
                                    <div class="mb-2">
                                        <img id="edit-product-current-image" src="" alt="Current Image"
                                            style="max-height: 100px; display: none;">
                                        <span id="edit-product-no-image" style="display: none;">No current image.</span>
                                    </div>
                                    <label class="form-label mt-2" for="edit-product-image">Change Featured Image
                                        (Optional)</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('featured_image', 'update') is-invalid @enderror"
                                                id="edit-product-image" name="featured_image" accept="image/*">
                                            <label class="form-file-label" for="edit-product-image">Choose file</label>
                                        </div>
                                    </div>
                                    @error('featured_image', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Product Gallery Images --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Product Gallery Images</label>

                                    {{-- Current Gallery Images --}}
                                    <div id="current-gallery-images" class="mb-3">
                                        <div class="gallery-images-container d-flex flex-wrap gap-2"
                                            style="display: none;">
                                            {{-- Images will be loaded dynamically via AJAX --}}
                                        </div>
                                        <span id="no-gallery-images" style="display: none;">No gallery images.</span>
                                    </div>

                                    <label class="form-label mt-2">Add More Gallery Images (Optional)</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                class="form-file-input @error('gallery_images.*', 'update') is-invalid @enderror"
                                                id="edit-product-gallery-images" name="gallery_images[]" accept="image/*"
                                                multiple>
                                            <label class="form-file-label" for="edit-product-gallery-images">Choose
                                                multiple files</label>
                                        </div>
                                    </div>
                                    <div class="form-note mt-1">You can select multiple images to add to the product
                                        gallery.</div>
                                    @error('gallery_images.*', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-product-status">Status</label>
                                    <div class="form-control-wrap">
                                        <select
                                            class="form-select js-select2 @error('status', 'update') is-invalid @enderror"
                                            id="edit-product-status" name="status" required>
                                            {{-- Assuming App\\Enums\\ProductStatus Enum --}}
                                            @foreach (App\Enums\ProductStatus::cases() as $status)
                                                <option value="{{ $status->value }}" @selected(old('status') == $status->value)>
                                                    {{ $status->label() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('status', 'update')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                        id="updateProductBtn">
                                        <span class="spinner d-none"><em
                                                class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                        <span class="btn-text">Update Product</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the product.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Product Confirmation Modal --}}
    <div class="modal fade" id="deleteProductModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Product</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-product-title"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteProductForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
