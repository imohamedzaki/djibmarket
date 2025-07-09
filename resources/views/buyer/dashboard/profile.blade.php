@extends('buyer.dashboard.layout')

@section('dashboard-content')
    <div class="dashboard-header">
        <h1>My Profile</h1>
        <p>Manage your personal information and account settings.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buyer.dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', Auth::user()->phone) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                        value="{{ old('date_of_birth', Auth::user()->date_of_birth?->format('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male"
                                            {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="other"
                                            {{ old('gender', Auth::user()->gender) == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city', Auth::user()->city) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country"
                                        value="{{ old('country', Auth::user()->country) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        value="{{ old('postal_code', Auth::user()->postal_code) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Tell us about yourself...">{{ old('bio', Auth::user()->bio) }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="newsletter_subscription"
                                    name="newsletter_subscription" value="1"
                                    {{ old('newsletter_subscription', Auth::user()->newsletter_subscription) ? 'checked' : '' }}>
                                <label class="form-check-label" for="newsletter_subscription">
                                    Subscribe to newsletter and promotional emails
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('buyer.dashboard.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Profile Picture -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile Picture</h5>
                </div>
                <div class="card-body text-center">
                    <div class="profile-picture-container mb-3">
                        <div class="profile-picture">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                    id="profile-preview"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="avatar-placeholder" id="profile-preview-fallback" style="display: none;">
                                    {{ Auth::user()->initials }}
                                </div>
                            @else
                                <div class="avatar-placeholder" id="profile-preview">
                                    {{ Auth::user()->initials }}
                                </div>
                            @endif
                            {{-- Debug info (remove in production) --}}
                            {{-- @if (config('app.debug'))
                                <small class="text-muted mt-2 d-block">Avatar path:
                                    {{ Auth::user()->avatar ?? 'No avatar' }}</small>
                                <small class="text-muted d-block">Full URL:
                                    {{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'No URL' }}</small>
                            @endif --}}
                        </div>
                    </div>

                    <form action="{{ route('buyer.dashboard.profile.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hidden required fields for avatar update -->
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                        <div class="form-group mb-3">
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                                onchange="previewImage(this)">
                            <small class="text-muted">Max file size: 2MB. Supported formats: JPG, PNG, GIF</small>
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-sm">Update Picture</button>
                    </form>
                </div>
            </div>

            <!-- Account Stats -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Account Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Member Since:</span>
                        <strong>{{ Auth::user()->created_at->format('M Y') }}</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Total Orders:</span>
                        <strong>{{ Auth::user()->orders()->count() }}</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between mb-2">
                        <span>Wishlist Items:</span>
                        <strong>{{ Auth::user()->wishlist()->count() }}</strong>
                    </div>
                    <div class="stat-item d-flex justify-content-between">
                        <span>Account Status:</span>
                        <span class="badge badge-success">{{ ucfirst(Auth::user()->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .profile-picture-container {
        position: relative;
        display: inline-block;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
        border: 4px solid #f0f0f0;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 600;
    }

    .stat-item {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 0.3rem;
        border: 1px solid #ddd;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn {
        border-radius: 0.3rem;
        padding: 10px 20px;
        font-weight: 500;
    }
</style>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var preview = document.getElementById('profile-preview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace placeholder with image
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.id = 'profile-preview';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    preview.parentNode.replaceChild(img, preview);
                }
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
