@extends('layouts.app.seller')
@section('title', 'Advertisement Analytics')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Advertisement Analytics</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('seller.ads.index') }}">Advertisements</a></li>
                                <li class="breadcrumb-item active">Analytics</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            {{-- Pending Status Alert --}}
            @include('includes.seller-pending-alert')

            <div class="nk-block nk-block-lg">
                <div class="row g-4">
                    <!-- Overview Stats -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Ads</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $totalAds ?? 0 }}</div>
                                            <div class="nk-ecwg6-ck">
                                                <em class="icon ni ni-card-view text-primary"></em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Views</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ number_format($totalViews ?? 0) }}</div>
                                            <div class="nk-ecwg6-ck">
                                                <em class="icon ni ni-eye text-info"></em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Clicks</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ number_format($totalClicks ?? 0) }}</div>
                                            <div class="nk-ecwg6-ck">
                                                <em class="icon ni ni-click text-success"></em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Spent</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ number_format($totalSpent ?? 0) }} DJF</div>
                                            <div class="nk-ecwg6-ck">
                                                <em class="icon ni ni-wallet text-warning"></em>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ad Performance Table -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="title">Advertisement Performance</h5>
                    </div>
                    <div class="card-inner">
                        @if (isset($ads) && $ads->count() > 0)
                            <table class="nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col"><span class="sub-text">Advertisement</span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text">Views</span></th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text">Clicks</span></th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text">CTR</span></th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text">Cost</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ads as $ad)
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead">{{ $ad->title }}</span>
                                                        <span
                                                            class="fs-12px text-soft">{{ \App\Models\SellerAd::AD_SLOTS[$ad->ad_slot] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span class="badge badge-outline-primary">{{ ucfirst($ad->status) }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-sm">
                                                <span>{{ number_format($ad->current_views) }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-sm">
                                                <span>{{ number_format($ad->current_clicks) }}</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-sm">
                                                <span>{{ $ad->current_views > 0 ? number_format(($ad->current_clicks / $ad->current_views) * 100, 2) : 0 }}%</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-sm">
                                                <span>{{ number_format($ad->current_cost, 0) }} DJF</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center py-4">
                                <em class="icon ni ni-bar-chart" style="font-size: 48px; opacity: 0.3;"></em>
                                <h6 class="mt-2">No advertisement data available</h6>
                                <p class="text-soft">Create your first advertisement to see analytics here.</p>
                                @if (Auth::guard('seller')->user()->status === 'pending')
                                    <span class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Advertisement creation is only available when your seller application has been accepted">
                                        <button class="btn btn-primary mt-2" disabled>
                                            <em class="icon ni ni-lock"></em><span>Create Advertisement (Locked)</span>
                                        </button>
                                    </span>
                                @else
                                    <a href="{{ route('seller.ads.create') }}" class="btn btn-primary mt-2">
                                        <em class="icon ni ni-plus"></em><span>Create Advertisement</span>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
