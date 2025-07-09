@extends('layouts.app.admin')

@section('title', 'Campaigns Management')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Campaigns</h3>
                        <div class="nk-block-des text-soft">
                            <p>Manage your marketing campaigns.</p>
                        </div>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.campaigns.create') }}" class="btn btn-primary">
                                            <em class="icon ni ni-plus"></em><span>Add Campaign</span>
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
                <div class="card card-bordered card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner p-0">
                            <div class="nk-tb-list nk-tb-ulist">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col"><span class="sub-text">Name</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Start Date</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">End Date</span></div>
                                    <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                    <div class="nk-tb-col nk-tb-col-tools text-end">Actions</div>
                                </div><!-- .nk-tb-item -->

                                @forelse($campaigns as $campaign)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                @if ($campaign->banner_image)
                                                    <div class="user-avatar sq bg-primary">
                                                        <img src="{{ asset('storage/' . $campaign->banner_image) }}"
                                                            alt="">
                                                    </div>
                                                @else
                                                    <div class="user-avatar sq bg-primary">
                                                        <span>{{ substr($campaign->name, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $campaign->name }} <span
                                                            class="dot dot-success d-md-none ms-1"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $campaign->start_date->format('M d, Y') }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span>{{ $campaign->end_date->format('M d, Y') }}</span>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            @if ($campaign->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-tools"
                                            data-campaign="{{ json_encode([
                                                'name' => $campaign->name,
                                                'description' => $campaign->description,
                                                'is_active' => $campaign->is_active,
                                                'start_date' => $campaign->start_date->format('Y-m-d\TH:i'),
                                                'end_date' => $campaign->end_date->format('Y-m-d\TH:i'),
                                                'banner_image' => $campaign->banner_image,
                                            ]) }}">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.campaigns.show', $campaign->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button" class="btn btn-trigger btn-icon edit-campaign"
                                                        data-action="{{ route('admin.campaigns.update', $campaign->slug) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-campaign"
                                                        data-campaign-slug="{{ $campaign->slug }}"
                                                        data-campaign="{{ $campaign->name }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown"><em
                                                                class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a
                                                                        href="{{ route('admin.campaigns.show', $campaign->slug) }}">
                                                                        <em class="icon ni ni-eye"></em><span>View
                                                                            Details</span></a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="edit-campaign"
                                                                        data-action="{{ route('admin.campaigns.update', $campaign->slug) }}">
                                                                        <em class="icon ni ni-edit"></em><span>Edit
                                                                            Campaign</span>
                                                                    </a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a href="#" class="text-danger delete-campaign"
                                                                        data-campaign-slug="{{ $campaign->slug }}"
                                                                        data-campaign="{{ $campaign->name }}">
                                                                        <em class="icon ni ni-trash"></em><span>Delete
                                                                            Campaign</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div><!-- .nk-tb-item -->
                                @empty
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col text-center" colspan="5">
                                            <span>No campaigns found</span>
                                        </div>
                                    </div>
                                @endforelse

                            </div><!-- .nk-tb-list -->
                        </div><!-- .card-inner -->
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $campaigns->links() }}
                                </div>
                            </div><!-- .nk-block-between -->
                        </div><!-- .card-inner -->
                    </div><!-- .card-inner-group -->
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
    <div class="modal fade" id="deleteCampaignModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Campaign</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="campaign-name"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteCampaignForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteCampaignBtn">
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
            // Edit campaign
            $('.edit-campaign').on('click', function(e) {
                e.preventDefault();
                var actionUrl = $(this).data('action');
                var editModal = $('#editCampaignModal');
                var editForm = $('#editCampaignForm');
                var campaignData = $(this).closest('.nk-tb-col-tools').data('campaign');

                editForm.attr('action', actionUrl);

                // Populate form fields directly from the stored data
                editForm.find('#edit-name').val(campaignData.name);
                editForm.find('#edit-description').val(campaignData.description);
                editForm.find('#edit-is_active').val(campaignData.is_active ? '1' : '0');
                editForm.find('#edit-start_date').val(campaignData.start_date);
                editForm.find('#edit-end_date').val(campaignData.end_date);

                // Display current image if exists
                if (campaignData.banner_image) {
                    $('#current-image').attr('src', '/storage/' + campaignData.banner_image);
                    $('#current-image-container').removeClass('d-none');
                } else {
                    $('#current-image-container').addClass('d-none');
                }

                // Initialize select2 for the modal
                if ($.fn.select2) {
                    $('.js-select2').each(function() {
                        var $this = $(this);
                        $this.select2({
                            dropdownParent: $('#editCampaignModal')
                        });
                    });
                }

                // Clear any previous remove_banner_image hidden field
                $('#remove_banner_image').remove();

                // Show the modal immediately
                editModal.modal('show');
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

            // Handle delete confirmation
            $('#confirmDeleteCampaignBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteCampaignForm').submit();
            });

            // Handle form submissions
            $('#editCampaignForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
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
                var $this = $(this);
                // Add a confirmation dialog
                if (confirm('Are you sure you want to delete the banner image?')) {
                    // Extract the campaign slug from the form's action URL
                    var actionUrl = $('#editCampaignForm').attr('action');
                    var campaignSlug = actionUrl.split('/').pop();
                    var deleteUrl = '/admin/campaigns/' + campaignSlug + '/delete-banner';

                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Clear the file input and hide the image container on success
                                $('#edit-banner_image').val('');
                                $('#current-image-container').addClass('d-none');
                                alert(
                                    'Banner image deleted successfully.'
                                ); // Or use a more styled alert
                            } else {
                                alert('Failed to delete banner image: ' + response.message);
                            }
                        },
                        error: function(xhr) {
                            alert('Error deleting banner image.');
                            console.error(xhr);
                        }
                    });
                }
            });

            // Reset remove image flag when uploading new image
            $('#edit-banner_image').on('change', function() {
                $('#remove_banner_image').remove();
            });

            // Initialize select2 if needed
            if ($.fn.select2) {
                $('.js-select2').select2({
                    dropdownParent: $(this).closest('.modal')
                });
            }

            // Dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert-dismissible').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection
