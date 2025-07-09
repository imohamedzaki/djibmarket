<?php
    // Get the currently visible notification bar
    $notificationBar = \App\Models\NotificationBar::currentlyVisible()
        ->with([
            'activeColumns' => function ($query) {
                $query->orderBy('column_order');
            },
        ])
        ->first();
?>

<?php if($notificationBar && $notificationBar->activeColumns->count() > 0): ?>
    <div class="box-notify<?php echo e($notificationBar->css_class ? ' ' . $notificationBar->css_class : ''); ?>">
        <div class="container position-relative">
            <div class="row">
                <?php $__currentLoopData = $notificationBar->activeColumns->take($notificationBar->column_count); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $colClass = 'col-lg-' . 12 / $notificationBar->column_count;
                    ?>
                    <div class="<?php echo e($colClass); ?>">
                        <?php if($column->hasLink()): ?>
                            <a href="<?php echo e($column->link_url); ?>" target="<?php echo e($column->link_target); ?>" class="notify-link">
                        <?php endif; ?>

                        <?php if($column->hasImage()): ?>
                            <img src="<?php echo e($column->image_url); ?>" alt="Notification" class="notify-image me-2"
                                style="height: 20px; width: auto;">
                        <?php endif; ?>

                        <span class="notify-text color-white"><?php echo e($column->text_content); ?></span>

                        <?php if($column->hasLink()): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a class="btn btn-close"></a>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/partials/buyer/boxNotify.blade.php ENDPATH**/ ?>