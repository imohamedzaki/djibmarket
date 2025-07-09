@extends('layouts.app.admin')

@push('styles')
    <style>
        .profile-ud-list .profile-ud-item {
            padding: 0 !important;
            /* Remove padding */
            margin: 0 !important;
            /* Remove margin */
        }

        .profile-ud-list {
            width: 100% !important;
            /* Set width to 100% */
            max-width: 100% !important;
            /* Set max-width to 100% */
        }

        /* Optional: Adjust spacing between label and value if needed */
        .profile-ud-list .profile-ud-label {
            margin-right: 0.5rem;
            /* Adjust as needed */
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .edit-activity-button {
            display: flex;
            align-items: center;
        }

        .edit-activity-button .spinner {
            margin-right: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Business Activity Details</h3>
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.business_activities.index') }}">Business
                                        Activities</a></li>
                                <li class="breadcrumb-item active">{{ $activity->name }}</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-menu-alt-r"></em>
                            </a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="#"
                                                class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                data-bs-toggle="dropdown">
                                                <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                                <span><span class="d-none d-md-inline">Activity</span>
                                                    Actions</span>
                                                <em class="dd-indc icon ni ni-chevron-right"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#" class="edit-activity-button"
                                                            data-bs-toggle="modal" data-bs-target="#editActivityModal"
                                                            data-slug="{{ $activity->slug }}"
                                                            data-name="{{ $activity->name }}"
                                                            data-description="{{ $activity->description ?? '' }}"
                                                            data-update-url="{{ route('admin.business_activities.update', $activity->slug) }}">
                                                            <div class="spinner"></div>
                                                            <em class="icon ni ni-edit"></em><span>Edit Activity</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="delete-activity-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteActivityModal"
                                                            data-slug="{{ $activity->slug }}"
                                                            data-name="{{ $activity->name }}"
                                                            data-delete-url="{{ route('admin.business_activities.destroy', $activity->slug) }}">
                                                            <em class="icon ni ni-trash text-danger"></em><span
                                                                class="text-danger">Delete Activity</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.business_activities.index') }}" class="btn btn-primary">
                                            <em class="icon ni ni-list"></em><span>Back to List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-content">
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Activity Information</h5>
                                        <p>Basic activity details and information.</p>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">ID</span>
                                                <span class="profile-ud-value">{{ $activity->id }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Name</span>
                                                <span class="profile-ud-value">{{ $activity->name }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Created At</span>
                                                <span
                                                    class="profile-ud-value">{{ $activity->created_at->format('M d, Y h:i A') }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Last Updated</span>
                                                <span
                                                    class="profile-ud-value">{{ $activity->updated_at->format('M d, Y h:i A') }}</span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-line">
                                        <h6 class="title overline-title text-base">Description</h6>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item w-100">
                                            <div class="profile-ud wider w-100">
                                                <p>{{ $activity->description ?? 'No description available.' }}</p>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                            </div><!-- .card-inner -->
                        </div><!-- .card-content -->
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>

    {{-- Add Edit Activity Modal --}}
    <div class="modal fade" id="editActivityModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Business Activity</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editActivityForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-activity-id">
                        <div class="form-group">
                            <label class="form-label" for="edit-activity-name">Activity Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-activity-name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-activity-description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="edit-activity-description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Activity</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the business activity.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteActivityModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Business Activity</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-activity-name"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                    <form action="" method="POST" id="deleteActivityForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteBtn">
                            <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Edit activity button
            $('.edit-activity-button').on('click', function() {
                var $button = $(this);
                var $spinner = $button.find('.spinner');
                var $icon = $button.find('.icon');
                var $text = $button.find('span');

                // Show spinner, hide icon (or handle UI as needed before modal opens)
                // $spinner.show(); // Spinner logic might be better inside the modal submit
                // $icon.hide();
                // $text.text('Loading...'); // Perhaps change text briefly

                // Read data attributes using slug
                var slug = $button.data('slug'); // Changed from data-id
                var name = $button.data('name');
                var description = $button.data('description');
                var updateUrl = $button.data('update-url'); // URL already contains the slug

                // Set modal form values
                $('#editActivityForm').attr('action', updateUrl); // Use the URL with slug
                $('#edit-activity-name').val(name);
                $('#edit-activity-description').val(description);
                // No need to set a hidden slug field unless your backend specifically requires it in the POST body
                // $('#edit-activity-id').val(id); // Remove or repurpose if needed

                // Reset button state when modal is hidden (if you added spinner logic above)
                // $('#editActivityModal').on('hidden.bs.modal', function() {
                //     $spinner.hide();
                //     $icon.show();
                //     $text.text('Edit Activity');
                // });
            });

            // Handle delete button clicks
            $('.delete-activity-button').on('click', function() {
                // Read data attributes using slug
                var slug = $(this).data('slug'); // Changed from data-id
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url'); // URL already contains the slug

                // Update the delete confirmation modal
                $('#delete-activity-name').text(name);
                $('#deleteActivityForm').attr('action', deleteUrl); // Use the URL with slug
            });

            // Handle confirm delete button
            $('#confirmDeleteBtn').on('click', function() {
                // Show spinner and disable button
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');

                // Submit the form
                $('#deleteActivityForm').submit();
            });

            // Handle form submissions with spinners
            $('#editActivityForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');

                return true; // Continue with form submission
            });
        });
    </script>
@endsection
