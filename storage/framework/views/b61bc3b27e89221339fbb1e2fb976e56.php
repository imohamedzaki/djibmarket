<!-- JavaScript -->
<script src="<?php echo e(asset('assets/shared/js/bundle.js')); ?>"></script>
<script src="<?php echo e(asset('assets/shared/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/shared/js/charts/chart-lms.js')); ?>"></script>

<script>
    // Prevent dropdown user from closing when clicking links inside
    $(document).ready(function() {
        $('.user-dropdown .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

<?php echo $__env->yieldContent('js'); ?>
<?php echo $__env->yieldContent('scripts'); ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/includes/admin/scripts.blade.php ENDPATH**/ ?>