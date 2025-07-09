
<?php if(Auth::guard('seller')->check() && Auth::guard('seller')->user()->status === 'pending'): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <div class="alert-icon me-3">
                <em class="icon ni ni-alert-circle" style="font-size: 1.5rem;"></em>
            </div>
            <div class="flex-grow-1">
                <h6 class="alert-heading mb-2">Application Under Review</h6>
                <p class="mb-1">Your seller application is still under review and you can't create any actions until
                    you get accepted.</p>
                <p class="mb-0 text-muted">
                    <strong>Important:</strong> This verification process typically takes 2-4 days to be completed.
                    We will notify you via email once your application has been approved.
                </p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/includes/seller-pending-alert.blade.php ENDPATH**/ ?>