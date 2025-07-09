<!-- main header @s -->
<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                        srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                        srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo-dark">
                </a>
            </div>
            <div class="nk-header-text d-none d-xl-block">
                <h4 class="text-muted">Interface Administrateur</h4>
            </div>
            <!-- .nk-header-brand -->
            {{-- <div class="nk-header-search ms-3 ms-xl-0">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none"
                    placeholder="Search anything">
            </div><!-- .nk-header-news --> --}}

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    @include('layouts.app.includes.admin.dropdownLanguage')
                    @include('layouts.app.includes.admin.dropdownChats')
                    @include('layouts.app.includes.admin.dropdownNotification')
                    @include('layouts.app.includes.admin.dropdownUser')
                </ul>
            </div>
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->
