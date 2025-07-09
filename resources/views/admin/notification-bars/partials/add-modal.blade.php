<div class="modal fade" id="addNotificationBarModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Notification Bar</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.notification-bars.store') }}" method="POST"
                    class="form-validate is-alter" id="addNotificationBarForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-4 gy-3">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-name">Name *</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                        class="form-control @error('name', 'store') is-invalid @enderror" id="add-name"
                                        name="name" value="{{ old('name') }}" required>
                                </div>
                                @error('name', 'store')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-column-count">Number of Columns *</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="add-column-count" name="column_count" required>
                                        <option value="1" {{ old('column_count') == 1 ? 'selected' : '' }}>1 Column
                                        </option>
                                        <option value="2" {{ old('column_count') == 2 ? 'selected' : '' }}>2
                                            Columns</option>
                                        <option value="3" {{ old('column_count', 3) == 3 ? 'selected' : '' }}>3
                                            Columns</option>
                                        <option value="4" {{ old('column_count') == 4 ? 'selected' : '' }}>4
                                            Columns</option>
                                    </select>
                                </div>
                                @error('column_count', 'store')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-start-date">Start Date *</label>
                                <div class="form-control-wrap">
                                    <input type="date"
                                        class="form-control @error('start_date', 'store') is-invalid @enderror"
                                        id="add-start-date" name="start_date"
                                        value="{{ old('start_date', date('Y-m-d')) }}" required>
                                </div>
                                @error('start_date', 'store')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-end-date">End Date *</label>
                                <div class="form-control-wrap">
                                    <input type="date"
                                        class="form-control @error('end_date', 'store') is-invalid @enderror"
                                        id="add-end-date" name="end_date" value="{{ old('end_date') }}" required>
                                </div>
                                @error('end_date', 'store')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="add-css-class">CSS Class (Optional)</label>
                                <div class="form-control-wrap">
                                    <input type="text"
                                        class="form-control @error('css_class', 'store') is-invalid @enderror"
                                        id="add-css-class" name="css_class"
                                        value="{{ old('css_class', 'box-notify') }}"
                                        placeholder="e.g., box-notify custom-style">
                                </div>
                                @error('css_class', 'store')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="add-is-active"
                                        name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="add-is-active">Active</label>
                                </div>
                            </div>
                        </div>

                        <!-- Columns Configuration -->
                        <div class="col-12">
                            <hr>
                            <h6 class="text-primary mb-3">Columns Configuration</h6>
                        </div>

                        <div class="col-12">
                            <div id="add-columns-container">
                                <!-- Columns will be dynamically generated here -->
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary submit-btn"
                                    id="addNotificationBarBtn">
                                    <span class="spinner d-none">
                                        <em class="spinner-border spinner-border-sm"></em>&nbsp;
                                    </span>
                                    <span class="btn-text">Create Notification Bar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Create a new notification bar with custom columns and content.</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addColumnCountSelect = document.getElementById('add-column-count');
        const addColumnsContainer = document.getElementById('add-columns-container');

        function generateAddColumns() {
            const columnCount = parseInt(addColumnCountSelect.value);
            addColumnsContainer.innerHTML = '';

            for (let i = 1; i <= columnCount; i++) {
                const columnHtml = `
                <div class="column-item position-relative mb-3">
                    <h6 class="text-secondary mb-3">Column ${i}</h6>
                    
                    <div class="row gx-3 gy-2">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Text Content *</label>
                                <textarea class="form-control" name="columns[${i-1}][text_content]" 
                                          rows="2" maxlength="500" required 
                                          placeholder="Enter promotional text for column ${i}"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Image (Optional)</label>
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
                                       placeholder="https://example.com">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Link Target</label>
                                <select class="form-select" name="columns[${i-1}][link_target]">
                                    <option value="_self">Same Tab</option>
                                    <option value="_blank">New Tab</option>
                                    <option value="_parent">Parent Frame</option>
                                    <option value="_top">Full Window</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Column Status</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="add-column-${i}-active" name="columns[${i-1}][is_active]" 
                                           value="1" checked>
                                    <label class="custom-control-label" for="add-column-${i}-active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                addColumnsContainer.insertAdjacentHTML('beforeend', columnHtml);
            }
        }

        // Initialize columns
        generateAddColumns();

        // Update columns when count changes
        addColumnCountSelect.addEventListener('change', generateAddColumns);

        // Form submission handling
        document.getElementById('addNotificationBarForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('addNotificationBarBtn');
            submitBtn.disabled = true;
            submitBtn.querySelector('.spinner').classList.remove('d-none');
            submitBtn.querySelector('.btn-text').textContent = 'Creating...';
        });
    });
</script>
