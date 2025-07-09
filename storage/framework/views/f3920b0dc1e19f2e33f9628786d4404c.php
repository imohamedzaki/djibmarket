<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'link', 'icon' => 'ni-dashboard-fill', 'iconStatus' => true]));

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

foreach (array_filter((['title', 'link', 'icon' => 'ni-dashboard-fill', 'iconStatus' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<li class="nk-menu-item">
    <a href="<?php echo e($link); ?>" class="nk-menu-link">
        <?php if($iconStatus): ?>
            <span class="nk-menu-icon"><em class="icon ni <?php echo e($icon); ?>"></em></span>
        <?php endif; ?>
        <span class="nk-menu-text"><?php echo e($title); ?></span>
    </a>
</li>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/components/sidebar/single.blade.php ENDPATH**/ ?>