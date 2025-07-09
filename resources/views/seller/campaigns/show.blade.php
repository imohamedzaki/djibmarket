@extends('layouts.app.seller')
@section('title', $campaign->name)

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Campaign: {{ $campaign->name }}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>View campaign details and create promotions.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('seller.campaigns.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back to Campaigns</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Alert for success message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Alert for error message -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                @if ($campaign->banner_image)
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $campaign->banner_image) }}" class="w-100 rounded"
                                            alt="{{ $campaign->name }}">
                                    </div>
                                @endif

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Campaign Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="{{ $campaign->name }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <div class="form-control-wrap">
                                                <span class="badge bg-success">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Start Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $campaign->start_date->format('M d, Y') }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">End Date</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    value="{{ $campaign->end_date->format('M d, Y') }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea class="form-control" disabled rows="4">{{ $campaign->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="nk-divider divider md"></div>

                                <div class="mt-4">
                                    <h5>Your Promotion</h5>

                                    @if ($promotion)
                                        <div class="alert alert-success">
                                            <p>You are participating in this campaign with the promotion:
                                                <strong>{{ $promotion->title }}</strong>
                                            </p>
                                            <div class="mt-3">
                                                <a href="{{ route('seller.campaigns.promotions.show', $promotion) }}"
                                                    class="btn btn-sm btn-primary">
                                                    View Promotion
                                                </a>
                                                <a href="{{ route('seller.campaigns.promotions.edit', $promotion) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Edit Promotion
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-info">
                                            <p>You are not participating in this campaign yet.</p>
                                            <a href="{{ route('seller.campaigns.promotions.create', $campaign) }}"
                                                class="btn btn-primary mt-2">
                                                Create Promotion
                                            </a>
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
@endsection
