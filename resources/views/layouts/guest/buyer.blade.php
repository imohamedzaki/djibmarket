<!DOCTYPE html>
<html lang="en" class="light-mode">

@include('layouts.guest.partials.buyer.head')

<body class="nk-body bg-white npc-default pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content">
                    @yield('content')
                </div>
                <!-- content @e -->
                @include('layouts.guest.partials.buyer.footer')
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <!-- JavaScript -->
    @include('layouts.guest.partials.buyer.scripts')
    @include('layouts.guest.partials.buyer.regionModal')

    <!-- Page Specific Scripts -->
    @yield('page_scripts')
</body>

</html>
