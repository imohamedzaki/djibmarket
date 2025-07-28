<!-- sidebar @s -->
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo-small">
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
                    <x-sidebar.single title="Dashboard" link="{{ route('admin.dashboard') }}"
                        icon="ni-dashboard-fill" />

                    <x-sidebar.single title="Business Activities" link="{{ route('admin.business_activities.index') }}"
                        icon="ni-building" />
                    <x-sidebar.single title="Categories" link="{{ route('admin.categories.index') }}"
                        icon="ni-list-fill" />
                    <x-sidebar.single title="Brand Management" link="{{ route('admin.brands.index') }}"
                        icon="ni-img-fill" />
                    <x-sidebar.single title="Category Ads" link="{{ route('admin.category-ads.index') }}"
                        icon="ni-img-fill" />

                    <x-sidebar.single title="Profile" link="{{ route('admin.profile.show') }}"
                        icon="ni-user-alt-fill" />
                    <x-sidebar.single title="Sellers management" link="{{ route('admin.sellers.index') }}"
                        icon="ni-briefcase" />
                    <x-sidebar.single title="Buyers" link="{{ route('admin.buyers.index') }}" icon="ni-users-fill" />
                    <x-sidebar.single title="Order Management" link="{{ route('admin.coming-soon') }}"
                        icon="ni-cart-fill" />
                    <x-sidebar.single title="Pending orders" link="{{ route('admin.coming-soon') }}"
                        icon="ni-list-check" />
                    <x-sidebar.single title="Delivered orders" link="{{ route('admin.coming-soon') }}"
                        icon="ni-check-circle-fill" />
                    <x-sidebar.single title="Order Deliveries" link="{{ route('admin.coming-soon') }}"
                        icon="ni-truck" />
                    <x-sidebar.single title="Return requests" link="{{ route('admin.coming-soon') }}"
                        icon="ni-reload" />
                    <x-sidebar.single title="Campaigns Management" link="{{ route('admin.campaigns.index') }}"
                        icon="ni-flag" />
                    <x-sidebar.single title="Promotions Management" link="{{ route('admin.promotions.index') }}"
                        icon="ni-tag-fill" />
                    <x-sidebar.single title="Coupons Management" link="#" icon="ni-ticket-fill" />
                    <x-sidebar.single title="Flash Sales" link="{{ route('admin.flash-sales.index') }}"
                        icon="ni-hot-fill" />
                    <x-sidebar.single title="Ads Companies Management" link="{{ route('admin.ads-companies.index') }}"
                        icon="ni-card-view" />
                    <x-sidebar.single title="Seller Advertisements" link="{{ route('admin.ads.index') }}"
                        icon="ni-monitor" />
                    <x-sidebar.single title="Notification Bars" link="{{ route('admin.notification-bars.index') }}"
                        icon="ni-bell" />
                    <x-sidebar.single title="Drivers Management" link="{{ route('admin.coming-soon') }}"
                        icon="ni-users" />
                    <x-sidebar.single title="Product Reviews Management" link="{{ route('admin.coming-soon') }}"
                        icon="ni-star-fill" />
                    <x-sidebar.single title="Payment Methods Management" link="{{ route('admin.coming-soon') }}"
                        icon="ni-wallet-fill" />
                    <x-sidebar.single title="Email Management" link="{{ route('admin.emails.dashboard') }}"
                        icon="ni-emails" />
                    <x-sidebar.single title="Analytics" link="{{ route('admin.coming-soon') }}"
                        icon="ni-growth-fill" />
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
