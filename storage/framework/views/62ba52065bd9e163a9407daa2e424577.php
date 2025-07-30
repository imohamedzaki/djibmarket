

<?php $__env->startSection('dashboard-content'); ?>
    <div class="dashboard-header">
        <h1>My Profile</h1>
        <p>Manage your personal information and account settings.</p>
    </div>

    <div class="profile-layout">
        <!-- Main Profile Form -->
        <div class="profile-main">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="card-title">Personal Information</h3>
                    <p class="card-description">Update your personal details and contact information</p>
                </div>
                <div class="profile-card-content">
                    <form action="<?php echo e(route('buyer.dashboard.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo e(old('name', Auth::user()->name)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo e(old('email', Auth::user()->email)); ?>" required>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo e(old('phone', Auth::user()->phone)); ?>">
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                    value="<?php echo e(old('date_of_birth', Auth::user()->date_of_birth?->format('Y-m-d'))); ?>">
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male"
                                        <?php echo e(old('gender', Auth::user()->gender) == 'male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="female"
                                        <?php echo e(old('gender', Auth::user()->gender) == 'female' ? 'selected' : ''); ?>>Female
                                    </option>
                                    <option value="other"
                                        <?php echo e(old('gender', Auth::user()->gender) == 'other' ? 'selected' : ''); ?>>Other
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="<?php echo e(old('city', Auth::user()->city)); ?>">
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="<?php echo e(old('country', Auth::user()->country)); ?>">
                            </div>
                            <div class="form-group">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="<?php echo e(old('postal_code', Auth::user()->postal_code)); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Tell us about yourself..."><?php echo e(old('bio', Auth::user()->bio)); ?></textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-checkbox">
                                <input class="checkbox-input" type="checkbox" id="newsletter_subscription"
                                    name="newsletter_subscription" value="1"
                                    <?php echo e(old('newsletter_subscription', Auth::user()->newsletter_subscription) ? 'checked' : ''); ?>>
                                <label class="checkbox-label" for="newsletter_subscription">
                                    Subscribe to newsletter and promotional emails
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="card-title">Change Password</h3>
                    <p class="card-description">Update your password to keep your account secure</p>
                </div>
                <div class="profile-card-content">
                    <form action="<?php echo e(route('buyer.dashboard.profile.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-group">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key me-1"></i>
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Sidebar -->
        <div class="profile-sidebar">
            <!-- Profile Picture Card -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="card-title">Profile Picture</h3>
                    <p class="card-description">Upload a new profile picture</p>
                </div>
                <div class="profile-card-content profile-picture-section">
                    <div class="profile-picture-container">
                        <div class="profile-picture">
                            <?php if(Auth::user()->avatar): ?>
                                <img src="<?php echo e(asset(Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>"
                                    id="profile-preview"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="avatar-placeholder" id="profile-preview-fallback" style="display: none;">
                                    <?php echo e(Auth::user()->initials); ?>

                                </div>
                            <?php else: ?>
                                <div class="avatar-placeholder" id="profile-preview">
                                    <?php echo e(Auth::user()->initials); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="picture-overlay">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>

                    <form action="<?php echo e(route('buyer.dashboard.profile.update')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <!-- Hidden required fields for avatar update -->
                        <input type="hidden" name="name" value="<?php echo e(Auth::user()->name); ?>">
                        <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>">

                        <div class="form-group">
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*"
                                onchange="previewImage(this)">
                            <small class="help-text">Max file size: 2MB. Supported formats: JPG, PNG, GIF</small>
                        </div>

                        <button type="submit" class="btn btn-outline-primary btn-sm btn-block">
                            <i class="fas fa-upload me-1"></i>
                            Update Picture
                        </button>
                    </form>
                </div>
            </div>

            <!-- Account Stats Card -->
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="card-title">Account Statistics</h3>
                    <p class="card-description">Your account overview</p>
                </div>
                <div class="profile-card-content">
                    <div class="stats-list">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-label">Member Since</span>
                                <span class="stat-value"><?php echo e(Auth::user()->created_at->format('M Y')); ?></span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-label">Total Orders</span>
                                <span class="stat-value"><?php echo e(Auth::user()->orders()->count()); ?></span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-label">Wishlist Items</span>
                                <span class="stat-value"><?php echo e(Auth::user()->wishlist()->count()); ?></span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="stat-content">
                                <span class="stat-label">Account Status</span>
                                <span class="status-badge status-success"><?php echo e(ucfirst(Auth::user()->status)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Profile Layout */
        .profile-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: var(--spacing-xl);
        }

        .profile-main {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        .profile-sidebar {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        /* Profile Cards */
        .profile-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .profile-card:hover {
            box-shadow: var(--shadow-md);
            transition: box-shadow 0.2s ease;
        }

        .profile-card-header {
            padding: var(--spacing-lg);
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 var(--spacing-xs) 0;
        }

        .card-description {
            font-size: 14px;
            color: var(--gray-600);
            margin: 0;
        }

        .profile-card-content {
            padding: var(--spacing-lg);
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-md);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
            margin-bottom: var(--spacing-md);
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-control {
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-md);
            font-size: 14px;
            background: var(--white);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-600);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .checkbox-input {
            width: 16px;
            height: 16px;
            border-radius: var(--radius-sm);
        }

        .checkbox-label {
            font-size: 14px;
            color: var(--gray-700);
            cursor: pointer;
        }

        .help-text {
            font-size: 12px;
            color: var(--gray-600);
            margin-top: var(--spacing-xs);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            padding: var(--spacing-sm) var(--spacing-md);
            font-size: 14px;
            font-weight: 500;
            border-radius: var(--radius-md);
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--primary-700);
            border-color: var(--primary-700);
            color: var(--white);
            text-decoration: none;
        }

        .btn-outline-primary {
            background: transparent;
            border-color: var(--primary-600);
            color: var(--primary-600);
        }

        .btn-outline-primary:hover {
            background: var(--primary-600);
            color: var(--white);
            text-decoration: none;
        }

        .btn-warning {
            background: var(--orange-600);
            border-color: var(--orange-600);
            color: var(--white);
        }

        .btn-warning:hover {
            background: #d97706;
            border-color: #d97706;
            color: var(--white);
            text-decoration: none;
        }

        .btn-sm {
            padding: var(--spacing-xs) var(--spacing-sm);
            font-size: 12px;
        }

        .btn-block {
            width: 100%;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: var(--spacing-lg);
        }

        /* Profile Picture Section */
        .profile-picture-section {
            text-align: center;
        }

        .profile-picture-container {
            position: relative;
            display: inline-block;
            margin-bottom: var(--spacing-lg);
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            border: 4px solid var(--gray-200);
            position: relative;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 100%;
            height: 100%;
            background: var(--primary-600);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 600;
        }

        .picture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
            border-radius: 50%;
            color: var(--white);
            font-size: 20px;
        }

        .profile-picture-container:hover .picture-overlay {
            opacity: 1;
        }

        /* Stats List */
        .stats-list {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-md);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-sm) 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            flex-shrink: 0;
        }

        .stat-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xs);
        }

        .stat-label {
            font-size: 12px;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-900);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: var(--spacing-xs) var(--spacing-sm);
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-badge.status-success {
            background: var(--green-100);
            color: var(--green-800);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .profile-layout {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {

            .profile-card-header,
            .profile-card-content {
                padding: var(--spacing-md);
            }

            .profile-picture {
                width: 100px;
                height: 100px;
            }

            .avatar-placeholder {
                font-size: 28px;
            }

            .form-actions {
                justify-content: stretch;
            }

            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }
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
                        preview.style.display = 'block';
                        var fallback = document.getElementById('profile-preview-fallback');
                        if (fallback) fallback.style.display = 'none';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('buyer.dashboard.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\djibmarket\resources\views/buyer/dashboard/profile.blade.php ENDPATH**/ ?>