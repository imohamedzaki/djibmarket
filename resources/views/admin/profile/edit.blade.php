@extends('layouts.app.admin')
@section('title', 'Edit Admin Profile')

@section('content')
    {{-- Breadcrumb --}}
    <x-breadcrumb.wrapper>
        <x-breadcrumb.single title="Dashboard" type="first" link="{{ route('admin.dashboard') }}" />
        <x-breadcrumb.single title="My Profile" link="{{ route('admin.profile.show') }}" />
        <x-breadcrumb.single title="Edit Profile" />
    </x-breadcrumb.wrapper>

    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title">Edit Personal Information</h5>
                        <div class="nk-block-des">
                            <p>Update your basic info, like your name and address.</p>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $admin->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $admin->email) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $admin->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="gender">Gender</label>
                                <select class="form-select" id="gender" name="gender" data-ui="lg">
                                    <option value="" {{ old('gender', $admin->gender) == '' ? 'selected' : '' }}>
                                        Select Gender</option>
                                    <option value="male" {{ old('gender', $admin->gender) == 'male' ? 'selected' : '' }}>
                                        Male</option>
                                    <option value="female"
                                        {{ old('gender', $admin->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other"
                                        {{ old('gender', $admin->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $admin->address) }}</textarea>
                            </div>
                        </div>

                        {{-- Password Change Section --}}
                        <div class="col-12">
                            <hr class="my-4">
                            <h6 class="mb-3">Change Password (Optional)</h6>
                            <p class="text-muted small mb-3">Leave blank if you don't want to change your password.</p>
                        </div>

                        {{-- Old Password --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="old_password">Current Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password"
                                    placeholder="Enter your current password">
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
                                    placeholder="Enter your new password">
                                @error('new_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="avatar">Change Avatar</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" id="avatar" name="avatar">
                                        <label class="form-file-label" for="avatar">Choose file</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Max file size 2MB. Allowed types: JPG, PNG, GIF,
                                    SVG.</small>
                                @if ($admin->avatar)
                                    <div class="mt-2">
                                        <span class="text-muted small">Current:</span>
                                        <img src="{{ asset($admin->avatar) }}" alt="Admin Avatar" class="img-thumbnail"
                                            style="max-height: 60px; max-width: 60px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="cover_photo">Change Cover Photo</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" id="cover_photo"
                                            name="cover_photo">
                                        <label class="form-file-label" for="cover_photo">Choose file</label>
                                    </div>
                                </div>
                                <small class="form-text text-muted">Max file size 2MB. Recommended size: 1200x300px.
                                    Allowed
                                    types: JPG, PNG.</small>
                                @if ($admin->cover_photo)
                                    <div class="mt-2">
                                        <span class="text-muted small">Current:</span>
                                        <img src="{{ asset($admin->cover_photo) }}" alt="Cover Photo"
                                            class="img-thumbnail"
                                            style="max-height: 60px; max-width: 120px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-lg btn-primary" id="submitBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                                id="submitSpinner"></span>
                            <span id="submitText">Update Profile</span>
                        </button>
                        <a href="{{ route('admin.profile.show') }}" class="btn btn-lg btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // File input label handling
            $('.form-file-input').on('change', function() {
                var fileName = this.files[0] ? this.files[0].name : 'Choose file';
                $(this).next('.form-file-label').text(fileName);
            });

            // Form submission handling
            $('form').on('submit', function() {
                var $submitBtn = $('#submitBtn');
                var $submitSpinner = $('#submitSpinner');
                var $submitText = $('#submitText');

                // Disable the button and show spinner
                $submitBtn.prop('disabled', true);
                $submitSpinner.removeClass('d-none');
                $submitText.text('Updating...');
            });
        });
    </script>
@endsection
