@extends('layouts.app.seller')
@section('title', 'Edit Advertisement')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Edit Advertisement</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Edit Advertisement</h5>
                    </div>
                    <div class="card-inner">
                        <form action="{{ route('seller.ads.update', $ad) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="title">Title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $ad->title) }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="ad_slot">Ad Slot <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="ad_slot" name="ad_slot" required>
                                            @foreach (\App\Models\SellerAd::AD_SLOTS as $slot => $displayName)
                                                <option value="{{ $slot }}"
                                                    {{ $ad->ad_slot == $slot ? 'selected' : '' }}>
                                                    {{ $displayName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $ad->description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <em class="icon ni ni-check"></em><span>Update Advertisement</span>
                                </button>
                                <a href="{{ route('seller.ads.show', $ad) }}" class="btn btn-outline-light">
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
