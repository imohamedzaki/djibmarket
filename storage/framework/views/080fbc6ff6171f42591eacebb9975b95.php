<?php
    $categories = \App\Models\Category::query();
    // Fetch mega menu data with featured sellers for global use
    $megaMenuCategories = \App\Models\Category::whereNull('parent_id')
        ->with([
            'children.children.children',
            'products' => function ($query) {
                $query->where('status', 'published')->with('seller')->take(50);
            },
        ])
        ->get()
        ->map(function ($category) {
            // Get featured sellers for this category
            $categoryIds = collect([$category->id]);
            if ($category->children) {
                foreach ($category->children as $child) {
                    $categoryIds->push($child->id);
                    if ($child->children) {
                        foreach ($child->children as $grandChild) {
                            $categoryIds->push($grandChild->id);
                        }
                    }
                }
            }

            $featuredSellers = \App\Models\Seller::select([
                'sellers.*',
                \Illuminate\Support\Facades\DB::raw('COUNT(products.id) as product_count'),
            ])
                ->join('products', 'sellers.id', '=', 'products.seller_id')
                ->whereIn('products.category_id', $categoryIds->toArray())
                ->where('products.status', 'active')
                ->where('sellers.status', 'active')
                ->whereNotNull('sellers.avatar')
                ->groupBy('sellers.id')
                ->orderByDesc('product_count')
                ->take(6)
                ->get();

            $category->featured_sellers = $featuredSellers;
            return $category;
        });
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="DjibMarket" />
    <meta name="author" content="" />
    <meta name="keywords" content="DjibMarket djibdev Mohamed Zaki" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/imgs/template/favicon.png')); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'DjibMarket'); ?></title>
    <?php echo $__env->make('layouts.app.includes.buyer.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/lucide.min.css">


</head>

<body>
    <?php echo $__env->make('includes.z_alert.contentHTML', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <?php echo $__env->make('layouts.app.partials.buyer.preloader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.app.partials.buyer.boxNotify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.app.partials.buyer.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.app.partials.buyer.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <?php echo $__env->make('layouts.app.partials.buyer.mobile-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    
    <?php echo $__env->make('layouts.app.partials.buyer.mega_menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main class="main">
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.app.partials.buyer.ModalQuickview', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
    </main>
    
    <?php echo $__env->make('layouts.app.partials.buyer.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.app.includes.buyer.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/buyer.blade.php ENDPATH**/ ?>