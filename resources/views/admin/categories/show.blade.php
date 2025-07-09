@extends('layouts.app.admin')

@push('styles')
    <style>
        /* Keep the same styles as BusinessActivity show page or adjust as needed */
        .profile-ud-list .profile-ud-item {
            padding: 0 !important;
            margin: 0 !important;
        }

        .profile-ud-list {
            width: 100% !important;
            max-width: 100% !important;
        }

        .profile-ud-list .profile-ud-label {
            margin-right: 0.5rem;
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

        .edit-category-button {
            /* Changed class */
            display: flex;
            align-items: center;
        }

        .edit-category-button .spinner {
            /* Changed class */
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
                        <h3 class="nk-block-title page-title">Category Details</h3> {{-- Changed Title --}}
                        <nav>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                {{-- Changed Route and Text --}}
                                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a>
                                </li>
                                {{-- Changed Variable --}}
                                <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                                                <em class="d-none d-sm-inline icon ni ni-tag"></em> {{-- Changed Icon --}}
                                                <span><span class="d-none d-md-inline">Category</span> Actions</span>
                                                {{-- Changed Text --}}
                                                <em class="dd-indc icon ni ni-chevron-right"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        {{-- Changed button class, modal target, data attributes, route --}}
                                                        <a href="#" class="edit-category-button"
                                                            data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                                            data-slug="{{ $category->slug }}"
                                                            data-name="{{ $category->name }}"
                                                            data-name-ar="{{ $category->name_ar ?? '' }}"
                                                            {{-- Added name_ar --}}
                                                            data-name-fr="{{ $category->name_fr ?? '' }}"
                                                            {{-- Added name_fr --}}
                                                            data-description="{{ $category->description ?? '' }}"
                                                            {{-- Add parent_id if needed: data-parent-id="{{ $category->parent_id }}" --}}
                                                            data-update-url="{{ route('admin.categories.update', $category->slug) }}">
                                                            <div class="spinner"></div>
                                                            <em class="icon ni ni-edit"></em><span>Edit Category</span>
                                                            {{-- Changed Text --}}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        {{-- Changed button class, modal target, data attributes, route --}}
                                                        <a href="#" class="delete-category-button"
                                                            data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                                            data-slug="{{ $category->slug }}"
                                                            data-name="{{ $category->name }}"
                                                            data-delete-url="{{ route('admin.categories.destroy', $category->slug) }}">
                                                            <em class="icon ni ni-trash text-danger"></em><span
                                                                class="text-danger">Delete Category</span>
                                                            {{-- Changed Text --}}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        {{-- Changed Route --}}
                                        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">
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
                                        <h5 class="title">Category Information</h5> {{-- Changed Title --}}
                                        <p>Basic category details and information.</p> {{-- Changed Text --}}
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">ID</span>
                                                <span class="profile-ud-value">{{ $category->id }}</span>
                                                {{-- Changed Variable --}}
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Name (English)</span>
                                                <span class="profile-ud-value">{{ $category->name }}</span>
                                                {{-- Changed Variable --}}
                                            </div>
                                        </div>
                                        {{-- Display Multilingual Names --}}
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Name (Arabic)</span>
                                                <span class="profile-ud-value">{{ $category->name_ar ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Name (French)</span>
                                                <span class="profile-ud-value">{{ $category->name_fr ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        {{-- Display Parent Category if desired --}}
                                        {{-- <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Parent Category</span>
                                                <span class="profile-ud-value">
                                                    @if ($category->parent)
                                                        <a href="{{ route('admin.categories.show', $category->parent->slug) }}">{{ $category->parent->name }}</a>
                                                    @else
                                                        None
                                                    @endif
                                                </span>
                                            </div>
                                        </div> --}}
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Created At</span>
                                                <span
                                                    class="profile-ud-value">{{ $category->created_at->format('M d, Y h:i A') }}</span>
                                                {{-- Changed Variable --}}
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Last Updated</span>
                                                <span
                                                    class="profile-ud-value">{{ $category->updated_at->format('M d, Y h:i A') }}</span>
                                                {{-- Changed Variable --}}
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
                                                {{-- Changed Variable --}}
                                                <p>{{ $category->description ?? 'No description available.' }}</p>
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

    {{-- Edit Category Modal (Copied from index, ensure IDs match) --}}
    <div class="modal fade" id="editCategoryModal" data-bs-keyboard="true" tabindex="-1"> {{-- Changed ID --}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5> {{-- Changed Title --}}
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Changed form ID --}}
                    <form action="" method="POST" id="editCategoryForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="id" id="edit-category-id"> --}}

                        <div class="form-group">
                            <label class="form-label" for="edit-category-name">Category Name (English)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-category-name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-category-name-ar">Category Name (Arabic)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-category-name-ar" name="name_ar"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-category-name-fr">Category Name (French)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="edit-category-name-fr" name="name_fr">
                            </div>
                        </div>
                        {{-- Optional: Add Parent Category Select --}}
                        {{-- <div class="form-group">
                            <label class="form-label" for="edit-category-parent">Parent Category</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="edit-category-parent" name="parent_id">
                                    <option value="">None (Root Category)</option>
                                    @php
                                        // Fetch categories again for the dropdown, excluding the current one and its descendants
                                        $availableParents = \App\Models\Category::where('id', '!=', $category->id)->get();
                                        // Consider adding logic to exclude descendants if hierarchy is deep
                                    @endphp
                                    @foreach ($availableParents as $parentCategory)
                                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label class="form-label" for="edit-category-description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="edit-category-description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- Changed button ID and text --}}
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateCategoryBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Category</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Modify the details of the category.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal (Copied from index, ensure IDs match) --}}
    <div class="modal fade" id="deleteCategoryModal" data-bs-keyboard="true" tabindex="-1"> {{-- Changed ID --}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Category</h5> {{-- Changed Title --}}
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- Changed strong ID --}}
                    <p>Are you sure you want to delete <strong id="delete-category-name"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                    {{-- Changed form ID --}}
                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        {{-- Changed button ID --}}
                        <button type="button" class="btn btn-danger submit-btn" id="confirmDeleteCategoryBtn">
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
    {{-- Include the same JS as the index page for modal handling --}}
    <script>
        $(document).ready(function() {
            // Edit category button click (Handles populating the modal)
            $('.edit-category-button').on('click', function() { // Changed selector
                console.log('Edit category button clicked (show page)');
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var nameAr = $(this).data('name-ar');
                var nameFr = $(this).data('name-fr');
                var description = $(this).data('description');
                // var parentId = $(this).data('parent-id');
                var updateUrl = $(this).data('update-url');

                console.log('Edit data:', slug, name, nameAr, nameFr, description, updateUrl);

                // Set edit form values
                $('#edit-category-name').val(name);
                $('#edit-category-name-ar').val(nameAr);
                $('#edit-category-name-fr').val(nameFr);
                $('#edit-category-description').val(description);
                // $('#edit-category-parent').val(parentId).trigger('change'); // Set parent_id
                $('#editCategoryForm').attr('action', updateUrl);
            });

            // Delete category button click (Handles setting delete modal action)
            $('.delete-category-button').on('click', function() { // Changed selector
                console.log('Delete category button clicked (show page)');
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                console.log('Delete data:', slug, name, deleteUrl);

                $('#delete-category-name').text(name);
                $('#deleteCategoryForm').attr('action', deleteUrl);
            });

            // Handle confirm delete button (Copied from index JS)
            $('#confirmDeleteCategoryBtn').on('click', function() { // Changed ID
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteCategoryForm').submit(); // Changed ID
            });

            // Handle edit form submission with spinner (Copied from index JS)
            $('#editCategoryForm').on('submit', function() { // Changed ID
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
                return true;
            });

            // Optional: Initialize Select2 if using parent dropdown in edit modal
            // $('#editCategoryModal .js-select2').select2({ dropdownParent: $('#editCategoryModal') });
        });
    </script>
@endsection
