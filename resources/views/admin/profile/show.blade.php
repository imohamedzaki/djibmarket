@extends('layouts.app.admin')
@section('title', 'Admin Profile')

@section('content')
    {{-- Breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Dashboard" type="first" link="{{ route('admin.dashboard') }}" />
        <x-breadcrumb.single title="My Profile" />
    </x-breadcrumb.wrapper>

    {{-- Profile Content --}}
    <div class="nk-block">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                <strong><em class="icon ni ni-check-circle"></em> Success!</strong> {{ session('success') }}
                <button type="button" class="close" id="closeAlertBtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row g-gs">
            {{-- Profile Info Card --}}
            <div class="col-lg-4">
                <div class="card card-bordered h-100">
                    <div class="card-inner p-0">
                        {{-- Cover Image with Overlay --}}
                        <div class="profile-cover position-relative"
                            style="height: 180px; 
                            background-image: {{ $admin->cover_photo ? 'url(\'' . asset($admin->cover_photo) . '\')' : 'url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' height=\'100%25\' width=\'100%25\'%3E%3Cdefs%3E%3Cpattern id=\'doodad\' width=\'100\' height=\'100\' viewBox=\'0 0 40 40\' patternUnits=\'userSpaceOnUse\' patternTransform=\'rotate(45)\'%3E%3Crect width=\'100%25\' height=\'100%25\' fill=\'%232d3748\'/%3E%3Ccircle cx=\'34\' cy=\'20\' r=\'4\' fill=\'%234a5568\'/%3E%3Ccircle cx=\'6\' cy=\'20\' r=\'4\' fill=\'%234a5568\'/%3E%3Ccircle cx=\'20\' cy=\'34\' r=\'4\' fill=\'%234a5568\'/%3E%3Ccircle cx=\'20\' cy=\'6\' r=\'4\' fill=\'%234a5568\'/%3E%3Ccircle cx=\'34\' cy=\'6\' r=\'4\' fill=\'%231a202c\'/%3E%3Ccircle cx=\'6\' cy=\'34\' r=\'4\' fill=\'%231a202c\'/%3E%3Ccircle cx=\'34\' cy=\'34\' r=\'4\' fill=\'%231a202c\'/%3E%3Ccircle cx=\'6\' cy=\'6\' r=\'4\' fill=\'%231a202c\'/%3E%3C/pattern%3E%3C/defs%3E%3Crect fill=\'url(%23doodad)\' height=\'200%25\' width=\'200%25\'/%3E%3C/svg%3E")' }}; 
                            background-size: cover; 
                            background-position: center;">
                            <div class="cover-bottom-gradient"></div>
                            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            </div>

                            {{-- Avatar positioned at bottom center of cover --}}
                            <div class="avatar-wrapper"
                                style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%);">
                                <div class="user-avatar bg-primary-dim"
                                    style="width: 80px; height: 80px; border: 4px solid #fff; box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);">
                                    @if ($admin->avatar)
                                        <img src="{{ asset($admin->avatar) }}" alt="{{ $admin->name }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        @php
                                            $nameParts = explode(' ', trim($admin->name));
                                            $initials =
                                                count($nameParts) > 1
                                                    ? strtoupper(
                                                        substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1),
                                                    )
                                                    : strtoupper(substr($nameParts[0] ?? '', 0, 2));
                                        @endphp
                                        <span style="font-size: 1.5rem;">{{ $initials }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Profile Summary Content --}}
                        <div class="text-center pt-5 pb-3 px-4 mt-3">
                            <h4 class="mt-3 mb-1">{{ $admin->name }}</h4>
                            <p class="text-muted">Administrator</p>

                            <a href="{{ route('admin.profile.edit') }}"
                                class="btn btn-primary btn-block mt-4 edit-profile-btn">
                                <em class="icon ni ni-edit me-1"></em><span>Edit Profile</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profile Details Card --}}
            <div class="col-lg-8">
                <div class="card card-bordered h-100">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-3">
                            <div class="card-title">
                                <h6 class="title">Personal Information</h6>
                                <p class="text-soft">Basic info used on the platform.</p>
                            </div>
                        </div>

                        <div class="nk-data data-list">
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Full Name</span>
                                    <span class="data-value">{{ $admin->name }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                            class="icon ni ni-user"></em></span></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email Address</span>
                                    <span class="data-value">{{ $admin->email }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                            class="icon ni ni-mail"></em></span></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Phone Number</span>
                                    <span class="data-value">{{ $admin->phone ?? 'Not set' }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                            class="icon ni ni-call"></em></span></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Gender</span>
                                    <span
                                        class="data-value">{{ $admin->gender ? ucfirst($admin->gender) : 'Not set' }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                            class="icon ni ni-users"></em></span></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Address</span>
                                    <span class="data-value">{{ $admin->address ?? 'Not set' }}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                            class="icon ni ni-map-pin"></em></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        .edit-profile-btn {
            background-color: #7356f1;
            border-color: #7356f1;
            transition: all 0.3s ease;
        }

        .edit-profile-btn:hover {
            color: #fff;
            background-color: #5a3fd8;
            border-color: #5a3fd8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(115, 86, 241, 0.3);
        }

        .card a:hover span {
            color: #fff;
        }

        .alert .close {
            background: none !important;
            border: none;
            box-shadow: none;
            outline: none;
        }

        .alert .close:before,
        .alert .close:after {
            display: none !important;
        }

        .cover-bottom-gradient {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 40px;
            background: linear-gradient(to top, rgb(44 62 80 / 29%), rgba(44, 62, 80, 0));
            pointer-events: none;
            z-index: 2;
        }

        .avatar-wrapper {
            z-index: 3;
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#closeAlertBtn').on('click', function() {
                $('#successAlert').fadeOut(300, function() {
                    $(this).remove();
                });
            });
        });
    </script>
@endsection
