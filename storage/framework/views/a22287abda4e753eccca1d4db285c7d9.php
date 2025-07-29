<style>
    /* Modern Buyer Breadcrumb Styles */
    .buyer-breadcrumb-section {
        background-color: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 0;
        margin-bottom: 0.5rem;
    }

    .buyer-breadcrumb {
        display: flex;
        align-items: center;
    }

    .buyer-breadcrumb-list {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 0.5rem;
    }

    .buyer-breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .buyer-breadcrumb-link {
        color: #64748b;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        transition: all 0.2s ease-in-out;
    }

    .buyer-breadcrumb-link:hover {
        color: #3b82f6;
        background-color: #e1f2fe;
        text-decoration: none;
    }

    .buyer-breadcrumb-current {
        color: #1e293b;
        font-size: 0.875rem;
        font-weight: 600;
        padding: 0.25rem 0.5rem;
    }

    .buyer-breadcrumb-separator {
        width: 1rem;
        height: 1rem;
        color: #94a3b8;
        flex-shrink: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .buyer-breadcrumb-section {
            padding: 0.75rem 0;
        }

        .buyer-breadcrumb-link,
        .buyer-breadcrumb-current {
            font-size: 0.8125rem;
            padding: 0.1875rem 0.375rem;
        }

        .buyer-breadcrumb-separator {
            width: 0.875rem;
            height: 0.875rem;
        }
    }
</style>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items']));

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

foreach (array_filter((['items']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="buyer-breadcrumb-section">
    <div class="container">
        <nav class="buyer-breadcrumb" aria-label="Breadcrumb">
            <ol class="buyer-breadcrumb-list">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="buyer-breadcrumb-item">
                        <?php if($loop->last): ?>
                            <span class="buyer-breadcrumb-current" aria-current="page"><?php echo e($item['text']); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($item['url']); ?>" class="buyer-breadcrumb-link"><?php echo e($item['text']); ?></a>
                            <svg class="buyer-breadcrumb-separator" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9.293 6.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11 9.293 7.707a1 1 0 010-1.414z" />
                            </svg>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav>
    </div>
</div>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/components/buyer/breadcrumb.blade.php ENDPATH**/ ?>