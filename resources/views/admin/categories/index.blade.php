@extends('layouts.app.admin')
@section('title', 'List of Categories')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Categories</h3>
                        <nav>
                            <ul class="breadcrumb ">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ul>
                        </nav>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addCategoryModal">
                                            <em class="icon ni ni-plus"></em><span>Add Category</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .toggle-wrap -->
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

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

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">List of Categories</h4>
                        <div class="nk-block-des">
                            <p>Use the table below to view, edit, and manage categories.</p>
                        </div>
                    </div>
                </div>
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
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Parent Category</span></th>
                                    <th class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $avatarColors = ['primary', 'success', 'info', 'warning', 'danger', 'dark'];
                                @endphp
                                @forelse ($categories as $category)
                                    @php
                                        $colorIndex = $loop->index % count($avatarColors);
                                        $avatarClass = 'bg-' . $avatarColors[$colorIndex] . '-dim';
                                    @endphp
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="category-{{ $category->id }}">
                                                <label class="custom-control-label"
                                                    for="category-{{ $category->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar {{ $avatarClass }} d-none d-sm-flex">
                                                    <span>{{ strtoupper(substr($category->name, 0, 2)) }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">{{ $category->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span>{{ Str::limit($category->description, 80) }}</span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            @if ($category->parent)
                                                <span
                                                    class="badge badge-dot bg-primary">{{ $category->parent->name }}</span>
                                            @else
                                                <span class="badge badge-dim bg-outline-secondary">No Category</span>
                                            @endif
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li class="nk-tb-action-hidden">
                                                    <a href="{{ route('admin.categories.show', $category->slug) }}"
                                                        class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Show Details">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon edit-category-button"
                                                        data-bs-toggle="modal" data-slug="{{ $category->slug }}"
                                                        data-id="{{ $category->id }}" data-bs-placement="top"
                                                        title="Edit">
                                                        <em class="icon ni ni-edit"></em>
                                                    </button>
                                                </li>
                                                <li class="nk-tb-action-hidden">
                                                    <button type="button"
                                                        class="btn btn-trigger btn-icon text-danger delete-category-button"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                                                        data-slug="{{ $category->slug }}"
                                                        data-name="{{ $category->name }}"
                                                        data-delete-url="{{ route('admin.categories.destroy', $category->slug) }}"
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
                                            <span class="text-soft">No categories found.</span>
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

    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="form-validate is-alter"
                        id="addCategoryForm">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="category-name">Category Name (English)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="category-name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="category-name-ar">Category Name (Arabic)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="category-name-ar" name="name_ar"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="category-name-fr">Category Name (French)</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="category-name-fr" name="name_fr">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="category-description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="category-description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="add-category-parent">Parent Category</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="add-category-parent" name="parent_id">
                                    <option value="">No Parent</option>
                                    @foreach ($allCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="addCategoryBtn">
                                <span class="spinner d-none"><em
                                        class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Save Category</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Enter the details for the new category.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="editCategoryForm" class="form-validate is-alter">
                        @csrf
                        @method('PUT')
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
                        <div class="form-group">
                            <label class="form-label" for="edit-category-description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="edit-category-description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="edit-category-parent">Parent Category</label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2" id="edit-category-parent" name="parent_id">
                                    <option value="">No Parent</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
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

    <div class="modal fade" id="deleteCategoryModal" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Delete Category</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross text-white"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="delete-category-name"></strong>?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>

                    <form action="" method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex justify-content-between w-100">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-category-button', function() {
                var slug = $(this).data('slug');
                var categoryId = $(this).data('id');
                var editModal = $('#editCategoryModal');
                var editForm = $('#editCategoryForm');
                var parentSelect = $('#edit-category-parent');

                editModal.find('.modal-body').addClass('loading');

                $.ajax({
                    url: `/admin/categories/${slug}/edit-data`,
                    method: 'GET',
                    success: function(response) {
                        console.log('Edit data fetched:', response);
                        if (response.success) {
                            var category = response.category;
                            var allCategories = response.allCategories;

                            editForm.find('#edit-category-name').val(category.name);
                            editForm.find('#edit-category-name-ar').val(category.name_ar);
                            editForm.find('#edit-category-name-fr').val(category.name_fr);
                            editForm.find('#edit-category-description').val(category
                                .description);
                            editForm.attr('action', `/admin/categories/${category.slug}`);

                            parentSelect.empty().append('<option value="">No Parent</option>');
                            allCategories.forEach(function(cat) {
                                if (cat.id !== category.id) {
                                    const selected = cat.id == category.parent_id ?
                                        ' selected' : '';
                                    parentSelect.append(
                                        `<option value="${cat.id}"${selected}>${cat.name}</option>`
                                    );
                                }
                            });
                            parentSelect.val(category.parent_id || '');
                            parentSelect.trigger('change');

                            editModal.find('.modal-body').removeClass('loading');
                            editModal.modal('show');
                        } else {
                            console.error('Error fetching category data:', response.message);
                            alert('Could not load category details. Please try again.');
                            editModal.find('.modal-body').removeClass('loading');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('An error occurred while fetching category data.');
                        editModal.find('.modal-body').removeClass('loading');
                    }
                });
            });

            $(document).on('click', '.delete-category-button', function() {
                console.log('Delete category button clicked');
                var slug = $(this).data('slug');
                var name = $(this).data('name');
                var deleteUrl = $(this).data('delete-url');

                console.log('Delete data:', slug, name, deleteUrl);

                $('#delete-category-name').text(name);
                $('#deleteCategoryForm').attr('action', deleteUrl);
            });

            $('#confirmDeleteCategoryBtn').on('click', function() {
                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('.spinner').removeClass('d-none');
                $this.find('.btn-text').text('Deleting...');
                $('#deleteCategoryForm').submit();
            });

            $('#addCategoryForm, #editCategoryForm').on('submit', function() {
                var $submitBtn = $(this).find('.submit-btn');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');

                var formId = $(this).attr('id');
                if (formId === 'addCategoryForm') {
                    $submitBtn.find('.btn-text').text('Saving...');
                } else if (formId === 'editCategoryForm') {
                    $submitBtn.find('.btn-text').text('Updating...');
                }
                return true;
            });
        });
    </script>
@endsection
