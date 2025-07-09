@extends('layouts.app.admin')
@section('title', 'Create Advertisement')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Create Advertisement</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            {{-- Session Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />
            <x-alert-summary :messages="$errors->all()" type="danger" heading="Please fix the following errors:" />

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Create Advertisement for Seller</h5>
                        <p class="text-soft">Create advertisements on behalf of sellers. These will be automatically
                            approved.</p>
                    </div>
                    <div class="card-inner">
                        <form action="{{ route('admin.ads.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="seller_id">Select Seller <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="seller_id" name="seller_id" required>
                                            <option value="">Choose a seller</option>
                                            @foreach ($sellers as $seller)
                                                <option value="{{ $seller->id }}">
                                                    {{ $seller->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="ad_slot">Advertisement Slot <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="ad_slot" name="ad_slot" required>
                                            <option value="">Select Ad Slot</option>
                                            @foreach (\App\Models\SellerAd::AD_SLOTS as $slot => $displayName)
                                                <option value="{{ $slot }}">{{ $displayName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Duration Type <span class="text-danger">*</span></label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="duration_days"
                                                name="duration_type" value="duration_days" checked>
                                            <label class="custom-control-label" for="duration_days">7 Days (Default)</label>
                                        </div>
                                        <input type="hidden" name="duration_days" value="7">
                                        <input type="hidden" name="daily_budget" value="5000">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-check"></em><span>Create & Approve</span>
                                </button>
                                <a href="{{ route('admin.ads.index') }}" class="btn btn-outline-light">
                                    <em class="icon ni ni-arrow-left"></em><span>Cancel</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
