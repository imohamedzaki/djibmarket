<!DOCTYPE html>
<html lang="en">
@include('layouts.app.partials.admin.head')

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
            @include('layouts.app.partials.admin.sidebar')
            <!-- wrap @s -->
            <div class="nk-wrap ">
                @include('layouts.app.partials.admin.header')
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                @include('layouts.app.partials.admin.footer')
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    @include('layouts.app.includes.admin.regionModal')
    <!-- JavaScript -->
    @include('layouts.app.includes.admin.scripts')
</body>

</html>
