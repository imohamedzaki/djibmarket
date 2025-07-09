@extends('layouts.app.seller')

@section('title', 'Edit Coupon')

@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Edit Coupon</h3>
            <div class="nk-block-des text-soft">
                <p>Update the details of your coupon.</p>
            </div>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <li class="nk-block-tools-opt">
                            <a href="{{ route('seller.coupons.index') }}" class="btn btn-outline-light">
                                <em class="icon ni ni-arrow-left"></em><span>Back</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- .toggle-wrap -->
        </div><!-- .nk-block-head-content -->
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->

<div class="nk-block">
    <div class="card card-bordered">
        <div class="card-inner">
            <form action="{{ route('seller.coupons.update', $coupon->id) }}" method="POST" class="form-validate" id="editCouponForm">
                @csrf
                @method('PUT')
                
                <div class="row g-gs">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="code">Coupon Code <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control @error('code') error @enderror" id="code" name="code" value="{{ old('code', $coupon->code) }}" required>
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-note">Enter a unique code for this coupon (e.g., SUMMER25).</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="type">Discount Type <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2 @error('type') error @enderror" id="type" name="type" required>
                                    <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                    <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="amount">Discount Amount <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right" id="discount-icon">
                                    <span id="discount-symbol">%</span>
                                </div>
                                <input type="number" class="form-control @error('amount') error @enderror" id="amount" name="amount" value="{{ old('amount', $coupon->amount) }}" min="0" step="0.01" required>
                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-note">For percentage, enter value between 1-100.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="min_purchase">Minimum Purchase Amount</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control @error('min_purchase') error @enderror" id="min_purchase" name="min_purchase" value="{{ old('min_purchase', $coupon->min_purchase) }}" min="0" step="0.01">
                                @error('min_purchase')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-note">Leave empty for no minimum purchase requirement.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="start_date">Start Date <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control date-picker @error('start_date') error @enderror" id="start_date" name="start_date" value="{{ old('start_date', $coupon->start_date->format('Y-m-d')) }}" required>
                                @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="end_date">End Date <span class="text-danger">*</span></label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control date-picker @error('end_date') error @enderror" id="end_date" name="end_date" value="{{ old('end_date', $coupon->end_date->format('Y-m-d')) }}" required>
                                @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="usage_limit">Usage Limit</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control @error('usage_limit') error @enderror" id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1">
                                @error('usage_limit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-note">Maximum number of times this coupon can be used. Leave empty for unlimited.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="is_active">Status</label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control @error('description') error @enderror" id="description" name="description">{{ old('description', $coupon->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-note">Provide details about this coupon for your reference.</div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary submit-btn" id="updateCouponBtn">
                                <span class="spinner d-none"><em class="spinner-border spinner-border-sm"></em>&nbsp;</span>
                                <span class="btn-text">Update Coupon</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Initialize select2 first
        if($.fn.select2) {
            $('.js-select2').select2(); // Initialize Select2 on elements with the class
        }

        // Function to update symbol and related fields based on type
        function updateDiscountFields(selectedType) {
            const amountField = $('#amount');
            const amountNote = amountField.closest('.form-group').find('.form-note');
            const discountSymbol = $('#discount-symbol');

            if (selectedType === 'percentage') {
                discountSymbol.text('%');
                amountField.attr('max', 100);
                amountNote.text('For percentage, enter value between 1-100.');
            } else {
                discountSymbol.text('DJF');
                amountField.removeAttr('max');
                amountNote.text('Enter fixed discount amount.');
            }
        }

        // Set initial state based on the current value AFTER potential Select2 init
        var initialType = $('#type').val();
        updateDiscountFields(initialType);

        // Handle discount type change using Select2's specific event
        $('#type').on('select2:select', function (e) {
            var data = e.params.data;
            var selectedType = data.id; // Get the selected value ('percentage' or 'fixed')
            updateDiscountFields(selectedType);
        });

        // Form submission handling (remains the same)
        $('#editCouponForm').on('submit', function(e) {
            if (this.checkValidity()) {
                var $submitBtn = $(this).find('button[type="submit"]');
                $submitBtn.prop('disabled', true);
                $submitBtn.find('.spinner').removeClass('d-none');
                $submitBtn.find('.btn-text').text('Updating...');
            }
            return true;
        });
    });
</script>
@endsection