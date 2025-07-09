@extends('layouts.app.seller')

@section('title', 'Campaigns')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Available Campaigns</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Participate in campaigns to boost your sales.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pending Status Alert --}}
                    @include('includes.seller-pending-alert')

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
                        @if ($campaigns->count() > 0)
                            <div class="row g-gs">
                                @foreach ($campaigns as $campaign)
                                    <div class="col-sm-6 col-lg-4 col-xxl-3">
                                        <div class="card card-bordered h-100">
                                            <div class="card-inner">
                                                @if ($campaign->banner_image)
                                                    <div class="mb-3">
                                                        <img src="{{ asset('storage/' . $campaign->banner_image) }}"
                                                            class="w-100 rounded" alt="{{ $campaign->name }}">
                                                    </div>
                                                @endif
                                                <h5 class="card-title">{{ $campaign->name }}</h5>
                                                <p class="card-text text-soft">{{ Str::limit($campaign->description, 100) }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <span
                                                        class="badge bg-primary">{{ $campaign->start_date->format('M d, Y') }}</span>
                                                    <span>to</span>
                                                    <span
                                                        class="badge bg-danger">{{ $campaign->end_date->format('M d, Y') }}</span>
                                                </div>
                                                <a href="{{ route('seller.campaigns.show', $campaign) }}"
                                                    class="btn btn-primary btn-block mt-3">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4">
                                {{ $campaigns->links() }}
                            </div>
                        @else
                            <div class="card card-bordered">
                                <div class="card-inner text-center py-5">
                                    <div class="py-4">
                                        <div class="mb-3">
                                            <em class="icon ni ni-spark-fill" style="font-size: 3rem; color: #c4c4c4;"></em>
                                        </div>
                                        <h6 class="text-muted">No active campaigns</h6>
                                        <p class="text-muted small">Currently, there are no active campaigns available for
                                            participation.<br>
                                            Please check back later for new opportunities to promote your products.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
