<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'danger', // Default type (e.g., success, danger, warning, info)
    'heading' => null, // Optional heading for the alert
    'messages' => [], // Array or Collection of messages
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'type' => 'danger', // Default type (e.g., success, danger, warning, info)
    'heading' => null, // Optional heading for the alert
    'messages' => [], // Array or Collection of messages
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // Map type string to Bootstrap alert class
    $alertClassMap = [
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        'error' => 'alert-danger', // Alias for danger
    ];
    // Get the class based on type, default to danger if type is unknown
    $alertClass = $alertClassMap[strtolower($type)] ?? 'alert-danger';

    // Ensure messages is a collection for easier handling
    $messageList = collect($messages);
?>


<?php if($messageList->isNotEmpty()): ?>
    <div
        <?php echo e($attributes->merge(['class' => "alert {$alertClass} alert-dismissible fade show mb-4", 'role' => 'alert'])); ?>>
        
        <?php if($heading): ?>
            <h6 class="alert-heading"><?php echo e($heading); ?></h6>
        <?php endif; ?>

        
        <?php if($messageList->count() > 1): ?>
            <ul class="list-unstyled mb-0">
                <?php $__currentLoopData = $messageList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo $message; ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="mb-0"><?php echo $messageList->first(); ?></p>
        <?php endif; ?>

        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/components/alert-summary.blade.php ENDPATH**/ ?>