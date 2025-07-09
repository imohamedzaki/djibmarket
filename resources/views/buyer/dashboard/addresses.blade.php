@extends('buyer.dashboard.layout')
<style>
    .address-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        height: 100%;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .address-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .address-card.default-address {
        border-color: #007bff;
        background: linear-gradient(135deg, #e5f3fa7d 0%, #dfe7fddb 100%)
    }

    .address-header {
        margin-bottom: 15px;
    }

    .address-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0 0 5px 0;
    }

    .address-actions {
        display: flex;
        gap: 5px;
    }

    .address-name {
        font-size: 16px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }

    .address-details {
        color: #666;
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .address-phone,
    .address-notes {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .address-phone i,
    .address-notes i {
        margin-right: 8px;
        color: #999;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }

    .modal-content {
        border-radius: 12px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #eee;
        padding: 20px;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        border-top: 1px solid #eee;
        padding: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .alert {
        border-radius: 8px;
        border: none;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert ul {
        padding-left: 20px;
    }
</style>
<script>
    function editAddress(addressId) {
        console.log('editAddress called with ID:', addressId);

        // Find the address data from the page
        const addresses = @json($addresses);
        console.log('Available addresses:', addresses);

        const address = addresses.find(addr => addr.id === addressId);
        console.log('Found address:', address);

        if (!address) {
            console.error('Address not found');
            return;
        }

        // Update form action
        const updateUrl = "{{ route('buyer.dashboard.addresses.update', ':id') }}".replace(':id', addressId);
        document.getElementById('editAddressForm').action = updateUrl;

        // Populate form fields
        document.getElementById('edit_type').value = address.type || '';
        document.getElementById('edit_title').value = address.title || '';
        document.getElementById('edit_first_name').value = address.first_name || '';
        document.getElementById('edit_last_name').value = address.last_name || '';
        document.getElementById('edit_phone').value = address.phone || '';
        document.getElementById('edit_address_line_1').value = address.address_line_1 || '';
        document.getElementById('edit_address_line_2').value = address.address_line_2 || '';
        document.getElementById('edit_city').value = address.city || '';
        document.getElementById('edit_state').value = address.state || '';
        document.getElementById('edit_postal_code').value = address.postal_code || '';
        document.getElementById('edit_country').value = address.country || '';
        document.getElementById('edit_notes').value = address.notes || '';
        document.getElementById('edit_is_default').checked = !!address.is_default;

        console.log('Form populated successfully');
    }

    // Handle form submission with AJAX for better UX
    document.addEventListener('DOMContentLoaded', function() {
        const editForm = document.getElementById('editAddressForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                // Show loading state
                submitBtn.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Updating...';
                submitBtn.disabled = true;

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Close modal and reload page to show updated data
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'editAddressModal'));
                            modal.hide();
                            location.reload();
                        } else {
                            throw new Error('Update failed');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating the address. Please try again.');
                    })
                    .finally(() => {
                        // Reset button state
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    });
            });
        }
    });
</script>
@section('dashboard-content')
    <div class="dashboard-header d-flex justify-content-between align-items-center">
        <div>
            <h1>My Addresses</h1>
            <p>Manage your shipping and billing addresses.</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
            <i class="fas fa-plus"></i> Add New Address
        </button>
    </div>

    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @forelse($addresses as $address)
            <div class="col-lg-6 mb-4">
                <div class="address-card {{ $address->is_default ? 'default-address' : '' }}">
                    <div class="address-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="address-title">{{ $address->title }}</h5>
                                @if ($address->is_default)
                                    <span class="badge badge-primary">Default</span>
                                @endif
                            </div>
                            <div class="address-actions">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="editAddress({{ $address->id }})" data-bs-toggle="modal"
                                    data-bs-target="#editAddressModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if (!$address->is_default)
                                    <form action="{{ route('buyer.dashboard.addresses.delete', $address) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this address?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="address-body">
                        <p class="address-name"><strong>{{ $address->full_name }}</strong></p>
                        <p class="address-details">{{ $address->full_address }}</p>
                        <p class="address-phone"><i class="fas fa-phone"></i> {{ $address->phone }}</p>
                        @if ($address->notes)
                            <p class="address-notes"><i class="fas fa-sticky-note"></i> {{ $address->notes }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                    <h5>No addresses found</h5>
                    <p class="text-muted">Add your first address to get started with faster checkout.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        Add Your First Address
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('buyer.dashboard.addresses.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="type" class="form-label">Address Type *</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Address Title *</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="e.g., Home, Office" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address_line_1" class="form-label">Address Line 1 *</label>
                            <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                placeholder="Street address, P.O. box, company name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address_line_2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                placeholder="Apartment, suite, unit, building, floor, etc.">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="postal_code" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="country" class="form-label">Country *</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes" class="form-label">Delivery Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2"
                                placeholder="Any special delivery instructions..."></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_default" name="is_default"
                                    value="1">
                                <label class="form-check-label" for="is_default">
                                    Set as default address
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Address Modal -->
    <div class="modal fade" id="editAddressModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editAddressForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="edit_type" class="form-label">Address Type *</label>
                                    <select class="form-control" id="edit_type" name="type" required>
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="edit_title" class="form-label">Address Title *</label>
                                    <input type="text" class="form-control" id="edit_title" name="title" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="edit_first_name" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="edit_first_name" name="first_name"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="edit_last_name" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="edit_last_name" name="last_name"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_address_line_1" class="form-label">Address Line 1 *</label>
                            <input type="text" class="form-control" id="edit_address_line_1" name="address_line_1"
                                placeholder="Street address, P.O. box, company name" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_address_line_2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="edit_address_line_2" name="address_line_2"
                                placeholder="Apartment, suite, unit, building, floor, etc.">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="edit_city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="edit_city" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="edit_state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="edit_state" name="state">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="edit_postal_code" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="edit_postal_code" name="postal_code"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_country" class="form-label">Country *</label>
                            <input type="text" class="form-control" id="edit_country" name="country" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_notes" class="form-label">Delivery Notes</label>
                            <textarea class="form-control" id="edit_notes" name="notes" rows="2"
                                placeholder="Any special delivery instructions..."></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit_is_default" name="is_default"
                                    value="1">
                                <label class="form-check-label" for="edit_is_default">
                                    Set as default address
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
