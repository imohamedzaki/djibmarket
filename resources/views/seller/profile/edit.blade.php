@extends('layouts.app.seller')
@section('title', 'Edit Seller Profile')

@section('content')
    {{-- Breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Dashboard" type="first" link="{{ route('seller.dashboard') }}" />
        <x-breadcrumb.single title="Profile" link="{{ route('seller.profile') }}" />
        <x-breadcrumb.single title="Edit" />
    </x-breadcrumb.wrapper>

    <div class="nk-block">
        {{-- Pending Status Alert for Profile Editing --}}
        @if ($seller->status === 'pending')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon me-3">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="alert-heading mb-1">Profile Editing Restricted</h6>
                        <p class="mb-0">You cannot edit your profile while your seller application is pending review.
                            Please wait for admin approval to unlock profile editing features.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="card-title">Edit Profile Information</h5>
                {{-- Form for updating profile --}}
                <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Or PATCH --}}

                    <div class="row gy-4">
                        {{-- Name --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $seller->name) }}"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}
                                    required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $seller->email) }}"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}
                                    required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $seller->phone) }}"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $seller->address) }}"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @error('address')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password Change Section --}}
                        <div class="col-12">
                            <hr class="my-4">
                            <h6 class="mb-3">Change Password (Optional)</h6>
                            @if ($seller->status === 'pending')
                                <p class="text-muted small mb-3">Password changes are disabled while your application is
                                    pending approval.</p>
                            @else
                                <p class="text-muted small mb-3">Leave blank if you don't want to change your password.</p>
                            @endif
                        </div>

                        {{-- Old Password --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="old_password">Current Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Enter your current password"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @error('old_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- New Password --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Enter your new password"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @error('new_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Avatar --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="avatar">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                                    {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @if ($seller->avatar)
                                    <div class="mt-2">
                                        <img src="{{ asset($seller->avatar) }}" alt="Current Avatar"
                                            style="max-height: 60px; border-radius: .25rem;">
                                    </div>
                                @endif
                                @error('avatar')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Cover Image --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="cover_image">Cover Image</label>
                                <input type="file" class="form-control" id="cover_image" name="cover_image"
                                    accept="image/*" {{ $seller->status === 'pending' ? 'disabled' : '' }}
                                    {{ $seller->status === 'pending' ? 'title=Profile editing is disabled while your application is pending approval' : '' }}>
                                @if ($seller->cover_image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $seller->cover_image) }}"
                                            alt="Current Cover Image"
                                            style="max-height: 60px; width: auto; border-radius: .25rem;">
                                    </div>
                                @endif
                                @error('cover_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="col-12">
                            @if ($seller->status === 'pending')
                                <button type="button" class="btn btn-secondary" disabled
                                    title="Profile editing is disabled while your application is pending approval">
                                    <i class="fas fa-lock me-2"></i>Profile Locked (Pending Approval)
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary" id="updateProfileBtn">
                                    <span class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                    <span class="button-text">Update Profile</span>
                                </button>
                            @endif
                            <a href="{{ route('seller.profile') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action*="seller/profile"]'); // More specific selector
            const submitButton = document.getElementById('updateProfileBtn');
            const spinner = submitButton ? submitButton.querySelector('.spinner-border') : null;
            const buttonText = submitButton ? submitButton.querySelector('.button-text') : null;

            if (form && submitButton && spinner && buttonText) {
                console.log('Attaching submit event listener.'); // Debug log
                form.addEventListener('submit', function(event) {

                    // Disable button
                    submitButton.disabled = true;

                    // Show spinner and change text
                    spinner.classList.remove('d-none');
                    buttonText.textContent = 'Updating...';

                });
            } else {
                console.error(
                    'Could not find all required elements for profile update button script.'); // Error log
            }
        });
    </script>
@endsection
