@extends('layouts.app.admin')

@section('title', 'Campaign Details')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Campaign Details</h3>
                        <div class="nk-block-des text-soft">
                            <p>Viewing campaign "{{ $campaign->name }}"</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-light">
                                            <em class="icon ni ni-arrow-left"></em><span>Back</span>
                                        </a>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#" class="btn btn-primary edit-campaign"
                                            data-action="{{ route('admin.campaigns.update', $campaign->slug) }}"
                                            data-campaign="{{ json_encode([
                                                'name' => $campaign->name,
                                                'description' => $campaign->description,
                                                'is_active' => $campaign->is_active,
                                                'start_date' => $campaign->start_date->format('Y-m-d\TH:i'),
                                                'end_date' => $campaign->end_date->format('Y-m-d\TH:i'),
                                                'banner_image' => $campaign->banner_image,
                                            ]) }}">
                                            <em class="icon ni ni-edit"></em><span>Edit Campaign</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="alert-text">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div class="alert-text">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-aside-wrap">
                        <div class="card-content">
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Campaign Information</h5>
                                    </div><!-- .nk-block-head -->

                                    @if ($campaign->banner_image)
                                        <div class="profile-ud-list mb-4">
                                            <div class="profile-ud-item col-12">
                                                <img src="{{ asset('storage/' . $campaign->banner_image) }}"
                                                    alt="{{ $campaign->name }}" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">Name</div>
                                            <div class="profile-ud-value">{{ $campaign->name }}</div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">Status</div>
                                            <div class="profile-ud-value">
                                                @if ($campaign->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">Start Date</div>
                                            <div class="profile-ud-value">
                                                {{ $campaign->start_date->format('M d, Y h:i A') }}</div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">End Date</div>
                                            <div class="profile-ud-value">{{ $campaign->end_date->format('M d, Y h:i A') }}
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">Created By</div>
                                            <div class="profile-ud-value">
                                                {{ $campaign->admin ? $campaign->admin->name : 'N/A' }}</div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud-label">Created At</div>
                                            <div class="profile-ud-value">
                                                {{ $campaign->created_at->format('M d, Y h:i A') }}</div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->

                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Campaign Description</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="card-text">
                                        <p>{{ $campaign->description ?? 'No description available.' }}</p>
                                    </div>
                                </div><!-- .nk-block -->

                                <div class="nk-divider divider md"></div>

                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h5 class="title">Related Promotions</h5>
                                            </div>
                                            <div class="nk-block-head-content">
                                                <a href="#" class="btn btn-sm btn-primary add-promotion-btn"
                                                    data-campaign-id="{{ $campaign->id }}"
                                                    data-campaign-slug="{{ $campaign->slug }}">
                                                    <em class="icon ni ni-plus"></em> Add Promotion
                                                </a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->

                                    @if ($campaign->promotions->count() > 0)
                                        <div class="card card-bordered">
                                            <div class="card-inner-group">
                                                <div class="card-inner p-0">
                                                    <div class="nk-tb-list nk-tb-ulist">
                                                        <div class="nk-tb-item nk-tb-head">
                                                            <div class="nk-tb-col"><span class="sub-text">Promotion</span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md"><span
                                                                    class="sub-text">Discount</span></div>
                                                            <div class="nk-tb-col tb-col-md"><span
                                                                    class="sub-text">Status</span></div>
                                                            <div class="nk-tb-col nk-tb-col-tools text-end">Actions</div>
                                                        </div><!-- .nk-tb-item -->

                                                        @foreach ($campaign->promotions as $promotion)
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col">
                                                                    <span class="tb-lead">{{ $promotion->name }}</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    <span>{{ $promotion->discount_value }}{{ $promotion->discount_type == 'percentage' ? '%' : ' ' . config('app.currency') }}</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-md">
                                                                    @if ($promotion->is_active)
                                                                        <span class="badge bg-success">Active</span>
                                                                    @else
                                                                        <span class="badge bg-danger">Inactive</span>
                                                                    @endif
                                                                </div>
                                                                <div class="nk-tb-col nk-tb-col-tools">
                                                                    <ul class="nk-tb-actions gx-1">
                                                                        <li>
                                                                            <div class="drodown">
                                                                                <a href="#"
                                                                                    class="dropdown-toggle btn btn-icon btn-trigger"
                                                                                    data-bs-toggle="dropdown"><em
                                                                                        class="icon ni ni-more-h"></em></a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-end">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li><a href="#"><em
                                                                                                    class="icon ni ni-eye"></em><span>View
                                                                                                    Details</span></a></li>
                                                                                        <li><a href="#"><em
                                                                                                    class="icon ni ni-edit"></em><span>Edit</span></a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a href="#"
                                                                                                class="text-danger delete-campaign"
                                                                                                data-campaign-slug="{{ $campaign->slug }}"
                                                                                                data-campaign="{{ $campaign->name }}">
                                                                                                <em
                                                                                                    class="icon ni ni-trash"></em><span>Delete</span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div><!-- .nk-tb-item -->
                                                        @endforeach
                                                    </div><!-- .nk-tb-list -->
                                                </div><!-- .card-inner -->
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    @else
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="text-center">
                                                    <span>No promotions found for this campaign</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div><!-- .nk-block -->
                            </div><!-- .card-inner -->
                        </div><!-- .card-content -->
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>

    <!-- Edit Campaign Modal -->
    <div class="modal fade" id="editCampaignModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Campaign</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editCampaignForm" class="form-validate is-alter"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-name">Campaign Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="edit-name" name="name"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-is_active">Status</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" id="edit-is_active" name="is_active">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-start_date">Start Date</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local" class="form-control" id="edit-start_date"
                                            name="start_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="edit-end_date">End Date</label>
                                    <div class="form-control-wrap">
                                        <input type="datetime-local" class="form-control" id="edit-end_date"
                                            name="end_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" id="edit-description" name="description" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="edit-banner_image">Change Banner Image</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" class="form-control" id="edit-banner_image"
                                                name="banner_image" accept="image/jpeg,image/png">
                                        </div>
                                        <div class="form-note text-muted mt-2">
                                            Max file size 2MB. Recommended size: 1200x300px. Allowed types: JPG, PNG.
                                        </div>
                                    </div>
                                    <div id="current-image-container" class="mt-3 d-none">
                                        <label class="form-label">Current Image</label>
                                        <div class="d-flex align-items-center">
                                            <img id="current-image" src="" alt="Current Banner"
                                                class="img-fluid rounded" style="max-height: 100px;">
                                            <button type="button" class="btn btn-icon btn-outline-danger ms-2"
                                                id="remove-image">
                                                <em class="icon ni ni-trash"></em>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateCampaignBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Campaign</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the campaign.</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Campaign Modal -->
    <div class="modal fade" tabindex="-1" id="deleteCampaignModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Campaign</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="deleteCampaignForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="campaign-name">Campaign Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="campaign-name"
                                            name="campaign-name" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="delete-reason">Reason for Deletion</label>
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" id="delete-reason" name="delete-reason" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Delete Campaign</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Edit campaign
            $('.edit-campaign').on('click', function(e) {
                e.preventDefault();
                var actionUrl = $(this).data('action');
                var editModal = $('#editCampaignModal');
                var editForm = $('#editCampaignForm');
                var campaignData = $(this).data('campaign'); // Read data from the button's attribute

                // Set the form action URL
                editForm.attr('action', actionUrl);

                // Populate form fields directly from the stored data
                editForm.find('#edit-name').val(campaignData.name);
                editForm.find('#edit-description').val(campaignData.description);
                editForm.find('#edit-is_active').val(campaignData.is_active ? '1' : '0');
                editForm.find('#edit-start_date').val(campaignData.start_date); // Dates are pre-formatted
                editForm.find('#edit-end_date').val(campaignData.end_date); // Dates are pre-formatted

                // Display current image if exists
                if (campaignData.banner_image) {
                    $('#current-image').attr('src', '/storage/' + campaignData.banner_image);
                    $('#current-image-container').removeClass('d-none');
                } else {
                    $('#current-image-container').addClass('d-none');
                }

                // Initialize select2 for the modal
                if ($.fn.select2) {
                    editModal.find('.js-select2').each(function() {
                        var $this = $(this);
                        if ($this.data('select2')) {
                            $this.select2('destroy');
                        }
                        $this.select2({
                            dropdownParent: editModal
                        });
                    });
                    // Ensure the value is correctly set for select2 after initialization
                    editForm.find('#edit-is_active').val(campaignData.is_active ? '1' : '0').trigger(
                        'change');
                }

                // Clear any previous remove_banner_image hidden field
                $('#remove_banner_image').remove();

                // Show the modal
                editModal.modal('show');
            });

            // Add Promotion button
            $('.add-promotion-btn').on('click', function(e) {
                e.preventDefault();

                // Initialize select2 for the promotion modal
                if ($.fn.select2) {
                    $('#addPromotionModal').find('.js-select2').each(function() {
                        var $this = $(this);
                        if ($this.data('select2')) {
                            $this.select2('destroy');
                        }
                        $this.select2({
                            dropdownParent: $('#addPromotionModal')
                        });
                    });
                }

                $('#addPromotionModal').modal('show');
            });

            // File input preview
            $('#edit-banner_image').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#current-image').attr('src', e.target.result);
                        $('#current-image-container').removeClass('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Remove image button
            $('#remove-image').on('click', function() {
                $('#edit-banner_image').val('');
                $('#current-image-container').addClass('d-none');
                // Add a hidden input to indicate image removal on the server
                if (!$('#remove_banner_image').length) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'remove_banner_image',
                        name: 'remove_banner_image',
                        value: '1'
                    }).appendTo('#editCampaignForm');
                }
            });

            // Handle form submissions
            $('#editCampaignForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                var $submitBtn = form.find('.submit-btn');

                // Disable button and show spinner
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editCampaignModal').modal('hide');
                        // Reload the page to see the changes
                        window.location.reload();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        // Format errors for display
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });

                        // Show error message
                        alert('Error updating campaign: ' + errorMessage);

                        // Reset button state
                        $submitBtn.prop('disabled', false);
                        $submitBtn.find('.spinner').addClass('d-none');
                        $submitBtn.find('.btn-text').text('Update Campaign');
                    }
                });
            });

            // Delete campaign
            $('.delete-campaign').on('click', function(e) {
                e.preventDefault();
                var campaignSlug = $(this).data('campaign-slug');
                var campaignName = $(this).data('campaign');
                var route = '{{ route('admin.campaigns.destroy', ['campaign' => 'CAMPAIGN_SLUG']) }}';
                route = route.replace('CAMPAIGN_SLUG', campaignSlug);

                $('#campaign-name').text(campaignName);
                $('#deleteCampaignForm').attr('action', route);
                $('#deleteCampaignModal').modal('show');
            });

            // Dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert-dismissible').fadeOut('slow');
            }, 5000);

            // Handle promotion form submission
            $('#addPromotionForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                var $submitBtn = form.find('.submit-btn');

                // Disable button and show spinner
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Adding...');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#addPromotionModal').modal('hide');
                        // Reload the page to see the changes
                        window.location.reload();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        // Format errors for display
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '<br>';
                        });

                        // Show error message
                        alert('Error adding promotion: ' + errorMessage);

                        // Reset button state
                        $submitBtn.prop('disabled', false);
                        $submitBtn.find('.spinner').addClass('d-none');
                        $submitBtn.find('.btn-text').text('Add Promotion');
                    }
                });
            });
        });
    </script>
@endsection

<!-- Add Promotion Modal -->
<div class="modal fade" id="addPromotionModal" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Promotion to Campaign</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.campaigns.promotions.store', $campaign->slug) }}" method="POST"
                    id="addPromotionForm" class="form-validate is-alter" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="promotion-name">Promotion Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="promotion-name" name="name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="promotion-is_active">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="promotion-is_active" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="promotion-discount_type">Discount Type</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2" id="promotion-discount_type"
                                        name="discount_type">
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="promotion-discount_value">Discount Value</label>
                                <div class="form-control-wrap">
                                    <input type="number" min="0" step="0.01" class="form-control"
                                        id="promotion-discount_value" name="discount_value" required>
                                </div>
                                <div class="form-note text-muted">For percentage, enter a value between 0-100</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="promotion-description">Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" id="promotion-description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addPromotionBtn">
                            <span class="spinner d-none"><em
                                    class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Add Promotion</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Add a new promotion to this campaign</span>
            </div>
        </div>
    </div>
</div>
