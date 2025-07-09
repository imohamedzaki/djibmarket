<div class="modal fade" id="editNotificationBarModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Notification Bar</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-validate is-alter" id="editNotificationBarForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-notification-id">

                    <div class="row gx-4 gy-3">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-name">Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                        class="form-control @error('name', 'update') is-invalid @enderror"
                                        id="edit-name" name="name" value="{{ old('name') }}" required>
                                </div>
                                @error('name', 'update')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-column-count">Number of Columns *</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="edit-column-count" name="column_count" required>
                                        <option value="1">1 Column</option>
                                        <option value="2">2 Columns</option>
                                        <option value="3">3 Columns</option>
                                        <option value="4">4 Columns</option>
                                    </select>
                                </div>
                                @error('column_count', 'update')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-start-date">Start Date *</label>
                                <div class="form-control-wrap">
                                    <input type="date"
                                        class="form-control @error('start_date', 'update') is-invalid @enderror"
                                        id="edit-start-date" name="start_date" value="{{ old('start_date') }}" required>
                                </div>
                                @error('start_date', 'update')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-end-date">End Date *</label>
                                <div class="form-control-wrap">
                                    <input type="date"
                                        class="form-control @error('end_date', 'update') is-invalid @enderror"
                                        id="edit-end-date" name="end_date" value="{{ old('end_date') }}" required>
                                </div>
                                @error('end_date', 'update')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-css-class">CSS Class (Optional)</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                        class="form-control @error('css_class', 'update') is-invalid @enderror"
                                        id="edit-css-class" name="css_class" value="{{ old('css_class') }}"
                                        placeholder="e.g., box-notify custom-style">
                                </div>
                                @error('css_class', 'update')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input status-toggle"
                                        id="edit-is-active" name="is_active" value="1" data-id="">
                                    <label class="custom-control-label" for="edit-is-active">
                                        <span class="status-text">Active</span>
                                    </label>
                                </div>
                                <div class="form-note">Toggle to activate or deactivate this notification bar
                                    immediately.</div>
                            </div>

                        </div>

                        <!-- Columns Configuration -->
                        <div class="col-12">
                            <hr>
                            <h6 class="text-primary mb-3">Columns Configuration</h6>
                        </div>

                        <div class="col-12">
                            <div id="edit-columns-container">
                                <!-- Columns will be dynamically loaded here -->
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                    id="updateNotificationBarBtn">
                                    <span class="spinner d-none">
                                        <em class="spinner-border spinner-border-sm"></em>&nbsp;
                                    </span>
                                    <span class="btn-text">Update Notification Bar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Update the notification bar details and column content.</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editColumnCountSelect = document.getElementById('edit-column-count');
        const editColumnsContainer = document.getElementById('edit-columns-container');
        let currentEditData = null;

        // Handle edit button clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-notification-button')) {
                const btn = e.target.closest('.edit-notification-button');
                const notificationId = btn.getAttribute('data-id');
                loadNotificationData(notificationId);
            }
        });

        function loadNotificationData(id) {
            fetch(`{{ route('admin.notification-bars.editData', ':id') }}`.replace(':id', id))
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        currentEditData = data.notificationBar;
                        populateEditForm(data.notificationBar);
                    } else {
                        alert('Failed to load notification data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading notification data');
                });
        }

        function populateEditForm(notificationBar) {
            // Set form action
            document.getElementById('editNotificationBarForm').action =
                `{{ route('admin.notification-bars.update', ':id') }}`.replace(':id', notificationBar.id);

            // Populate basic fields
            document.getElementById('edit-notification-id').value = notificationBar.id;
            document.getElementById('edit-name').value = notificationBar.name;
            document.getElementById('edit-column-count').value = notificationBar.column_count;
            document.getElementById('edit-start-date').value = notificationBar.start_date;
            document.getElementById('edit-end-date').value = notificationBar.end_date;
            document.getElementById('edit-css-class').value = notificationBar.css_class || '';
            document.getElementById('edit-is-active').checked = notificationBar.is_active;

            // Set the data-id for the status toggle
            document.getElementById('edit-is-active').setAttribute('data-id', notificationBar.id);

            // Update the status text
            const statusText = notificationBar.is_active ? 'Active' : 'Inactive';
            const statusSpan = document.querySelector('#edit-is-active + label .status-text');
            if (statusSpan) {
                statusSpan.textContent = statusText;
            }

            // Generate columns
            generateEditColumns();
        }

        function generateEditColumns() {
            const columnCount = parseInt(editColumnCountSelect.value);
            editColumnsContainer.innerHTML = '';

            for (let i = 1; i <= columnCount; i++) {
                const existingColumn = currentEditData?.columns?.find(col => col.column_order === i);

                const columnHtml = `
                <div class="column-item position-relative mb-3">
                    <h6 class="text-secondary mb-3">Column ${i}</h6>
                    
                    <div class="row gx-3 gy-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Text Content *</label>
                                <textarea class="form-control" name="columns[${i-1}][text_content]" 
                                          rows="2" maxlength="500" required 
                                          placeholder="Enter promotional text for column ${i}">${existingColumn?.text_content || ''}</textarea>
                            </div>
                        </div>
                        
                        ${existingColumn?.image_path ? `
                        <div class="col-12">
                            <div class="current-image mb-2">
                                <label class="form-label">Current Image:</label>
                                <div>
                                    <img src="${existingColumn.image_url}" alt="Current image" 
                                         style="max-height: 60px; max-width: 120px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                        ` : ''}
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">${existingColumn?.image_path ? 'Replace Image (Optional)' : 'Image (Optional)'}</label>
                                <div class="form-file">
                                    <input type="file" class="form-file-input" 
                                           name="columns[${i-1}][image]" accept="image/*">
                                    <label class="form-file-label">Choose image</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Link URL (Optional)</label>
                                <input type="url" class="form-control" 
                                       name="columns[${i-1}][link_url]" 
                                       value="${existingColumn?.link_url || ''}"
                                       placeholder="https://example.com">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Link Target</label>
                                <select class="form-select" name="columns[${i-1}][link_target]">
                                    <option value="_self" ${existingColumn?.link_target === '_self' ? 'selected' : ''}>Same Tab</option>
                                    <option value="_blank" ${existingColumn?.link_target === '_blank' ? 'selected' : ''}>New Tab</option>
                                    <option value="_parent" ${existingColumn?.link_target === '_parent' ? 'selected' : ''}>Parent Frame</option>
                                    <option value="_top" ${existingColumn?.link_target === '_top' ? 'selected' : ''}>Full Window</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Column Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="edit-column-${i}-active" name="columns[${i-1}][is_active]" 
                                           value="1" ${existingColumn?.is_active !== false ? 'checked' : ''}>
                                    <label class="custom-control-label" for="edit-column-${i}-active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                editColumnsContainer.insertAdjacentHTML('beforeend', columnHtml);
            }
        }

        // Update columns when count changes
        editColumnCountSelect.addEventListener('change', generateEditColumns);

        // Form submission handling
        document.getElementById('editNotificationBarForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('updateNotificationBarBtn');
            submitBtn.disabled = true;
            submitBtn.querySelector('.spinner').classList.remove('d-none');
            submitBtn.querySelector('.btn-text').textContent = 'Updating...';
        });
    });
</script>
