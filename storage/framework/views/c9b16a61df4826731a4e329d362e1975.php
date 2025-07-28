<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('layouts.app.partials.admin.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
    // Immediately apply dark mode from cookie to HTML element to prevent FOUC
    (function() {
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        var savedDarkMode = getCookie('darkMode');
        if (savedDarkMode === 'true') {
            document.documentElement.classList.add('dark-mode');
        } else {
            // Optional: Explicitly remove if necessary, though absence should suffice
            // document.documentElement.classList.remove('dark-mode');
        }
    })();
</script>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php echo $__env->make('layouts.app.partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <?php echo $__env->make('layouts.app.partials.admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <?php echo $__env->yieldContent('content'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <?php echo $__env->make('layouts.app.partials.admin.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <?php echo $__env->make('layouts.app.includes.admin.regionModal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- JavaScript -->
    <?php echo $__env->make('layouts.app.includes.admin.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/layouts/app/admin.blade.php ENDPATH**/ ?>