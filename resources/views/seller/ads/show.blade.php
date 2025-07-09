@extends('layouts.app.seller')
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
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">{{ $ad->title }}</li>
                            </ul>
                        </nav>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    @if (in_array($ad->status, ['pending', 'approved', 'rejected']))
                                        <li>
                                            <a href="{{ route('seller.ads.edit', $ad) }}" class="btn btn-outline-primary">
                                                <em class="icon ni ni-edit"></em><span>Edit</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if ($ad->status === 'active')
                                        <li>
                                            <form action="{{ route('seller.ads.pause', $ad) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">
                                                    <em class="icon ni ni-pause"></em><span>Pause</span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif

                                    @if ($ad->status === 'paused')
                                        <li>
                                            <form action="{{ route('seller.ads.resume', $ad) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">
                                                    <em class="icon ni ni-play"></em><span>Resume</span>
                                                </button>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Session Messages --}}
            <x-alert-summary :messages="session('success')" type="success" />
            <x-alert-summary :messages="session('error')" type="danger" />

            <div class="nk-block nk-block-lg">
                <div class="row g-4">
                    <!-- Ad Details -->
                    <div class="col-lg-8">
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
                                            <label class="form-label">Ad Slot</label>
                                            <p class="form-control-plaintext">
                                                {{ \App\Models\SellerAd::AD_SLOTS[$ad->ad_slot] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Duration</label>
                                            <p class="form-control-plaintext">
                                                @if ($ad->start_date && $ad->end_date)
                                                    {{ $ad->start_date->format('M d, Y') }} -
                                                    {{ $ad->end_date->format('M d, Y') }}
                                                @else
                                                    View-based duration
                                                @endif
                                            </p>
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

                        <!-- Performance Stats -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="title">Performance Statistics</h5>
                            </div>
                            <div class="card-inner">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="stat-box text-center">
                                            <div class="stat-value h4 text-primary">{{ number_format($ad->total_views) }}
                                            </div>
                                            <div class="stat-label">Total Views</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-box text-center">
                                            <div class="stat-value h4 text-success">{{ number_format($ad->total_clicks) }}
                                            </div>
                                            <div class="stat-label">Total Clicks</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-box text-center">
                                            <div class="stat-value h4 text-info">
                                                {{ $ad->total_views > 0 ? number_format(($ad->total_clicks / $ad->total_views) * 100, 2) : 0 }}%
                                            </div>
                                            <div class="stat-label">CTR</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="stat-box text-center">
                                            <div class="stat-value h4 text-warning">{{ number_format($ad->total_cost, 0) }}
                                                DJF</div>
                                            <div class="stat-label">Total Cost</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Budget Info -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="title">Budget Information</h6>
                            </div>
                            <div class="card-inner">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Total Budget</label>
                                            <p class="form-control-plaintext">{{ number_format($ad->total_budget, 0) }} DJF
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Spent</label>
                                            <p class="form-control-plaintext">{{ number_format($ad->total_cost, 0) }} DJF
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Remaining</label>
                                            <p class="form-control-plaintext">
                                                {{ number_format($ad->total_budget - $ad->total_cost, 0) }} DJF</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Budget Progress -->
                                @php
                                    $budgetPercentage =
                                        $ad->total_budget > 0 ? ($ad->total_cost / $ad->total_budget) * 100 : 0;
                                @endphp
                                <div class="progress mt-3">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ min(100, $budgetPercentage) }}%"
                                        aria-valuenow="{{ $budgetPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ number_format($budgetPercentage, 1) }}%
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Limits -->
                        @if ($ad->max_views || $ad->max_clicks)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="title">Limits</h6>
                                </div>
                                <div class="card-inner">
                                    @if ($ad->max_views)
                                        <div class="form-group">
                                            <label class="form-label">View Limit</label>
                                            <p class="form-control-plaintext">
                                                {{ number_format($ad->total_views) }} /
                                                {{ number_format($ad->max_views) }}
                                            </p>
                                            @php
                                                $viewPercentage = ($ad->total_views / $ad->max_views) * 100;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ min(100, $viewPercentage) }}%"
                                                    aria-valuenow="{{ $viewPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($ad->max_clicks)
                                        <div class="form-group">
                                            <label class="form-label">Click Limit</label>
                                            <p class="form-control-plaintext">
                                                {{ number_format($ad->total_clicks) }} /
                                                {{ number_format($ad->max_clicks) }}
                                            </p>
                                            @php
                                                $clickPercentage = ($ad->total_clicks / $ad->max_clicks) * 100;
                                            @endphp
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ min(100, $clickPercentage) }}%"
                                                    aria-valuenow="{{ $clickPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Admin Notes -->
                        @if ($ad->admin_notes)
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h6 class="title">Admin Notes</h6>
                                </div>
                                <div class="card-inner">
                                    <p class="text-soft">{{ $ad->admin_notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .stat-box {
                padding: 20px;
                border-radius: 8px;
                background: #f8f9fa;
                margin-bottom: 15px;
            }

            .stat-value {
                margin-bottom: 5px;
            }

            .stat-label {
                font-size: 12px;
                color: #6c757d;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
        </style>
    @endpush
@endsection
