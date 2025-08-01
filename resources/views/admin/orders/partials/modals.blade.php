<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Order</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editOrderForm" class="form-validate is-alter">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-order-status">Status</label>
                                <div class="form-control-wrap">
                                    <select class="form-select" id="edit-order-status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="shipped">Shipped</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="completed">Completed</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="edit-order-customer">Customer</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="edit-order-customer" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="edit-order-address">Delivery Address</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" id="edit-order-address" name="delivery_address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="edit-order-notes">Notes</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control" id="edit-order-notes" name="notes" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateOrderBtn">
                            <span class="spinner d-none"><em
                                    class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                            <span class="btn-text">Update Order</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Modify the details of the order.</span>
            </div>
        </div>
    </div>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusOrderModal" data-bs-keyboard="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white">Change Order Status</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross text-white"></em>
                </a>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to change the status of order <strong id="status-order-number"></strong>?</p>
                <p>Current status: <span id="current-status-display"></span></p>

                <form action="" method="POST" id="statusOrderForm">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="form-label" for="new-status">New Status</label>
                        <div class="form-control-wrap">
                            <select class="form-select" id="new-status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <div class="d-flex justify-content-between w-100">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning submit-btn" id="confirmStatusOrderBtn">
                        <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                        <span class="btn-text">Change Status</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>