@extends('layouts.app.admin')
@section('title', 'Brand Details')

@section('style')
    <style>
        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .brand-logo-container {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .brand-logo-container:hover {
            transform: scale(1.02);
        }

        .brand-info-card {
            transition: box-shadow 0.3s ease;
        }

        .brand-info-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Brand Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brands</a></li>
                                <li class="breadcrumb-item active">{{ $brand->name }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('admin.brands.edit', $brand) }}"
                            class="btn btn-outline-primary d-none d-sm-inline-flex">
                            <em class="icon ni ni-edit"></em><span>Edit Brand</span>
                        </a>
                        <a href="{{ route('admin.brands.edit', $brand) }}"
                            class="btn btn-icon btn-outline-primary d-inline-flex d-sm-none">
                            <em class="icon ni ni-edit"></em>
                        </a>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="row g-gs">
                    <!-- Brand Information -->
                    <div class="col-xxl-8">
                        <div class="card card-bordered brand-info-card">
                            <div class="card-inner">
                                <div class="row g-5">
                                    <div class="col-lg-5">
                                        <div class="brand-logo-container">
                                            <div class="user-avatar sq"
                                                style="width: 200px; height: 200px; border-radius: 12px; position: relative; margin: 0 auto;">
                                                <!-- Skeleton loading placeholder -->
                                                <div class="brand-skeleton" id="logoSkeleton"
                                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: skeleton-loading 1.5s infinite; border-radius: 12px;">
                                                </div>

                                                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" id="brandLogo"
                                                    style="width: 100%; height: 100%; object-fit: contain; background: #f8f9fa; border-radius: 12px; border: 1px solid #e5e9f2;"
                                                    onload="document.getElementById('logoSkeleton').style.display='none';"
                                                    onerror="this.src='{{ asset('assets/imgs/template/logo_only.png') }}'; this.style.filter='grayscale(100%)'; document.getElementById('logoSkeleton').style.display='none';" />
                                            </div>

                                            @if ($brand->website)
                                                <div class="text-center mt-3">
                                                    <a href="{{ $brand->website }}" target="_blank"
                                                        class="btn btn-outline-primary">
                                                        <em class="icon ni ni-external"></em>&nbsp;Visit Website
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="brand-details">
                                            <h4 class="title">{{ $brand->name }}</h4>
                                            <p class="text-soft">{{ $brand->slug }}</p>

                                            <div class="row g-3 mt-4">
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Brand Type</span>
                                                    <div class="mt-1">
                                                        @if ($brand->type)
                                                            <span
                                                                class="badge badge-dim bg-primary">{{ $brand->type->name }}</span>
                                                        @else
                                                            <span class="text-soft">No type assigned</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Total Categories</span>
                                                    <div class="mt-1">
                                                        <span class="lead-text">{{ $brand->categories->count() }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Top Brand Categories</span>
                                                    <div class="mt-1">
                                                        <span
                                                            class="lead-text text-success">{{ $brand->categories->where('pivot.is_top_brand', true)->count() }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="sub-text">Created Date</span>
                                                    <div class="mt-1">
                                                        <span
                                                            class="sub-text">{{ $brand->created_at->format('M d, Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($brand->description)
                                                <div class="mt-4">
                                                    <span class="sub-text">Description</span>
                                                    <p class="mt-2">{{ $brand->description }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Actions -->
                    <div class="col-xxl-4">
                        <!-- Actions Card -->
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <h6 class="title">Actions</h6>
                                <div class="d-flex flex-column mt-3" style="gap: .6rem;">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-outline-primary">
                                        <em class="icon ni ni-edit"></em>&nbsp;Edit Brand
                                    </a>

                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteBrandModal">
                                        <em class="icon ni ni-trash"></em>&nbsp;Delete Brand
                                    </button>

                                    <a href="{{ route('admin.brands.index') }}" class="btn btn-light">
                                        <em class="icon ni ni-arrow-left"></em>&nbsp;Back to List
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Card -->
                        @if ($brand->categories->count() > 0)
                            <div class="card card-bordered mt-3">
                                <div class="card-inner">
                                    <h6 class="title">Associated Categories</h6>
                                    <div class="mt-3">
                                        @foreach ($brand->categories as $category)
                                            <div
                                                class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <div>
                                                    <span class="fw-medium">{{ $category->name }}</span>
                                                    @if ($category->pivot->is_top_brand)
                                                        <span class="badge badge-sm badge-success ms-1">
                                                            <em class="icon ni ni-star-fill"></em> Top
                                                        </span>
                                                    @endif
                                                </div>
                                                @if ($category->pivot->is_top_brand)
                                                    <div>
                                                        <small class="text-soft">Priority:
                                                            {{ $category->pivot->priority }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Logo Information -->
                        <div class="card card-bordered mt-3">
                            <div class="card-inner">
                                <h6 class="title">Logo Information</h6>
                                <div class="mt-3">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <span class="sub-text">Logo Source</span>
                                            <div class="mt-1">
                                                @if ($brand->isLocalLogo())
                                                    <span class="badge badge-success">Local File</span>
                                                @elseif($brand->logo)
                                                    <span class="badge badge-info">External URL</span>
                                                @else
                                                    <span class="badge badge-light">Default Image</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($brand->logo)
                                            <div class="col-12">
                                                <span class="sub-text">Logo Path</span>
                                                <div class="mt-1">
                                                    <small class="text-break">{{ $brand->logo }}</small>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Brand Modal -->
    <div class="modal fade" id="deleteBrandModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Brand</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the brand <strong>{{ $brand->name }}</strong>?</p>
                    <p class="text-soft">This action cannot be undone and will also remove all category associations.</p>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger submit-btn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Delete Brand</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Form submission with loading state
            $('.submit-btn').on('click', function() {
                var $submitBtn = $(this);
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Deleting...');
                return true;
            });

            // Reset modal when closed
            $('#deleteBrandModal').on('hidden.bs.modal', function() {
                var $submitBtn = $('.submit-btn');
                $submitBtn.prop('disabled', false);
                $submitBtn.find('.spinner').addClass('d-none');
                $submitBtn.find('.btn-text').text('Delete Brand');
            });
        });
    </script>
@endsection
