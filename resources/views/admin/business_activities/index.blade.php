@extends('layouts.app.admin')

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Business Activities</h3>
                        @php
                            $breadcrumbs = [
                                ['url' => route('admin.dashboard'), 'text' => 'Dashboard'],
                                ['text' => 'Business Activities'],
                            ];
                        @endphp
                        <x-breadcrumb.full :items="$breadcrumbs" />
                    </div><!-- .nk-block-hsead-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addActivityModal">
                                            <em class="icon ni ni-plus"></em><span>Add Activity</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Business Activities</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage business activities.</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="card card-bordered card-preview"> --}}
                <div class="card card-preview">
                    <div class="card-inner">
                        <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head">
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Description</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Define avatar colors --}}
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($activities as $activity)
                                    {{-- Cycle through colors based on loop index --}}
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="activity-{{ $activity->id }}">
                                                <label class="custom-control-label"
                                                    for="activity-{{ $activity->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                {{-- Use dynamic avatar class --}}
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($activity->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $activity->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ Str::limit($activity->description, 80) }}</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.business_activities.show', $activity->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-activity-button"
                                                        data-bs-toggle="modal" data-bs-target="#editActivityModal"
                                                        data-slug="{{ $activity->slug }}" data-name="{{ $activity->name }}"
                                                        data-description="{{ $activity->description ?? '' }}"
                                                        data-update-url="{{ route('admin.business_activities.update', $activity->slug) }}"
                                                        data-bs-placement="top" title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                {{-- Change Delete Hover Action to trigger modal --}}
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-activity-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteActivityModal"
                                                        data-slug="{{ $activity->slug }}"
                                                        data-name="{{ $activity->name }}"
                                                        data-delete-url="{{ route('admin.business_activities.destroy', $activity->slug) }}"
                                                        data-bs-placement="top" title="Delete">
                                                        <em class="icon ni ni-trash"></em>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                @empty
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check"></td>
                                        <td class="nk-tb-col text-center" colspan="2">
                                            <span class="text-soft">No business activities found.</span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools"></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div><!-- .card-preview -->
            </div> <!-- nk-block -->
        </div>
    </div>

    {{-- Add Activity Modal --}}
    <div class="modal fade" id="addActivityModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Business Activity</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Form submits to the store route --}}
                    <form action="{{ route('admin.business_activities.store') }}" method="POST"
                        class="form-validate is-alter" id="addActivityForm">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="activity-name">Activity Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="activity-name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="activity-description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="activity-description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addActivityBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Save Activity</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Enter the details for the new business activity.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Activity Modal --}}
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
                    {{-- Form action will be set dynamically by JS --}}
                    <form action="" method="POST" id="editActivityForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT') {{-- Method for update --}}
                        <input type="hidden" name="id" id="edit-activity-id"> {{-- Hidden field for ID --}}

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
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateActivityBtn">
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

    {{-- Delete Confirmation Modal --}}
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

{{-- Remove old script from scripts stack --}}
@section('js')
    <script>
        $(document).ready(function() {
            // Use event delegation for dynamically created elements
            $(document).on('click', '.edit-activity-button', function() {
                console.log('Edit button clicked');
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var updateUrl = $(this).data('update-url');

                console.log('Edit data:', slug, name, description, updateUrl);

                // Set form values
                $('#edit-activity-name').val(name);
                $('#edit-activity-description').val(description);
                $('#editActivityForm').attr('action', updateUrl);
            });

            // Handle delete button clicks with event delegation
            $(document).on('click', '.delete-activity-button', function() {
                console.log('Delete button clicked');
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                console.log('Delete data:', slug, name, deleteUrl);

                // Update the delete confirmation modal
                $('#delete-activity-name').text(name);
                $('#deleteActivityForm').attr('action', deleteUrl);
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
            $('#addActivityForm, #editActivityForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');

                // Change button text based on which form is submitting
                var formId = $(this).attr('id');
                if (formId === 'addActivityForm') {
                    $submitBtn.find('.btn-text').text('Saving...');
                } else if (formId === 'editActivityForm') {
                    $submitBtn.find('.btn-text').text('Updating...');
                }

                return true; // Continue with form submission
            });
        });
    </script>
@endsection
