<?php if(session()->has('status')): ?>
    <?php if(session()->get('type') == 'success'): ?>
        <div class="z_alert_wrapper z_alert_wrapper_success" data-trigger="trigger">
            <div class="z_alert_icon">
                <i class="ti ti-checkbox"></i>
            </div>
            <div class="z_alert_content">
                <h2><?php echo e(ucfirst(session()->get('type'))); ?></h2>
                <span><?php echo e(session()->get('status')); ?></span>
            </div>
        </div>
    <?php else: ?>
        <div class="z_alert_wrapper z_alert_wrapper_danger" data-trigger="trigger">
            <div class="z_alert_icon">
                <i class="ti ti-exclamation-circle"></i>
            </div>
            <div class="z_alert_content">
                <h2><?php echo e(ucfirst(session()->get('type'))); ?></h2>
                <span><?php echo e(session()->get('status')); ?></span>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/includes/z_alert/contentHTML.blade.php ENDPATH**/ ?>