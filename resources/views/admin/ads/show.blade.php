@extends('layouts.app.admin')
@section('title', 'Advertisement Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">{{ $ad->title }}</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">{{ $ad->title }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Advertisement Details</h5>
                    </div>
                    <div class="card-inner">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <p class="form-control-plaintext">{{ $ad->title }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge badge-primary">{{ ucfirst($ad->status) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Seller</label>
                                    <p class="form-control-plaintext">
                                        @if ($ad->seller)
                                            {{ $ad->seller->name }}
                                        @else
                                            No seller assigned
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Ad Slot</label>
                                    <p class="form-control-plaintext">{{ \App\Models\SellerAd::AD_SLOTS[$ad->ad_slot] }}</p>
                                </div>
                            </div>
                            @if ($ad->description)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <p class="form-control-plaintext">{{ $ad->description }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
