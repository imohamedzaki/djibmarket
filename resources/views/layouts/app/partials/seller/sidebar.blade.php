<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('seller.dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/imgs/template/mini_logo.png') }}"
                    srcset="{{ asset('assets/imgs/template/mini_logo.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/imgs/template/mini_logo.png') }}"
                    srcset="{{ asset('assets/imgs/template/mini_logo.png') }}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/imgs/template/mini_logo.png') }}"
                    srcset="{{ asset('assets/imgs/template/mini_logo.png') }}" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <x-sidebar.single title="Dashboard" link="{{ route('seller.dashboard') }}"
                        icon="ni-dashboard-fill" />
                    <x-sidebar.single title="Profile" link="{{ route('seller.profile') }}" icon="ni-user-fill" />
                    <x-sidebar.single title="Products" link="{{ route('seller.products.index') }}"
                        icon="ni-package-fill" />
                    <x-sidebar.single title="Coupons" link="{{ route('seller.coupons.index') }}"
                        icon="ni-ticket-fill" />
                    <x-sidebar.single title="Categories" link="{{ route('seller.categories.index') }}"
                        icon="ni-list-fill" />
                    <x-sidebar.single title="Order Management" link="{{ route('seller.orders.index') }}" icon="ni-cart-fill" />
                    {{-- <x-sidebar.single title="Orders" link="{{ route('seller.coming-soon') }}" icon="ni-cart-fill" /> --}}
                    {{-- <x-sidebar.single title="Return Requests" link="{{ route('seller.coming-soon') }}"
                        icon="ni-reload" /> --}}
                    {{-- <x-sidebar.single title="Order Deliveries" link="{{ route('seller.coming-soon') }}"
                        icon="ni-truck" /> --}}
                    <x-sidebar.single title="Campaigns" link="{{ route('seller.campaigns.index') }}" icon="ni-flag" />
                    <x-sidebar.single title="Promotions" link="{{ route('seller.promotions.index') }}"
                        icon="ni-percent" />
                    <x-sidebar.single title="Flash Sales" link="{{ route('seller.flash-sales.index') }}"
                        icon="ni-hot-fill" />
                    <x-sidebar.single title="Advertisements" link="{{ route('seller.ads.index') }}"
                        icon="ni-card-view" />
                    <x-sidebar.single title="Reviews" link="{{ route('seller.coming-soon') }}" icon="ni-star-fill" />

                    <x-sidebar.single title="Analytics" link="{{ route('seller.coming-soon') }}"
                        icon="ni-growth-fill" />
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
