<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
            <div class="mobile-logo"><a class="d-flex" href="{{ route('buyer.home') }}"><img alt="DjibMarket"
                        src="{{ asset('assets/imgs/template/mini_logo2.png') }}"></a></div>
            <div class="perfect-scroll">

                <div class="box-header-search">
                    <form class="form-search" method="get" action="{{ route('search.results') }}"
                        id="mobile-search-form">
                        <div class="box-keysearch">
                            <input class="form-control font-xs" type="text" value=""
                                placeholder="Search for items" id="mobile_search_input" name="query"
                                autocomplete="off">
                        </div>
                    </form>
                </div>

                <div class="mobile-menu-wrap mobile-header-border">
                    <nav class="mt-15">
                        <ul class="mobile-menu font-heading">
                            <li><a class="active" href="{{ route('buyer.home') }}">Home</a></li>
                            @foreach ($megaMenuCategories as $category)
                                <li @if ($category->children && $category->children->isNotEmpty()) class="has-children" @endif>
                                    <a
                                        href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    @if ($category->children && $category->children->isNotEmpty())
                                        <ul class="sub-menu">
                                            @foreach ($category->children as $child)
                                                <li @if ($child->children && $child->children->isNotEmpty()) class="has-children" @endif>
                                                    <a
                                                        href="{{ route('categories.show', ['category' => $child->slug]) }}">{{ $child->name }}</a>
                                                    @if ($child->children && $child->children->isNotEmpty())
                                                        <ul class="sub-menu">
                                                            @foreach ($child->children as $grandChild)
                                                                <li><a
                                                                        href="{{ route('categories.show', ['category' => $grandChild->slug]) }}">{{ $grandChild->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="mobile-account">
                    @auth
                        <div class="mobile-header-top">
                            <div class="user-account">
                                <a href="{{ route('buyer.dashboard.profile') }}">
                                    <div class="user-avatar"
                                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                        @if (Auth::user()->avatar ?? false)
                                            <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span
                                                style="font-size: 16px; font-weight: bold; color: #333;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        @endif
                                    </div>
                                </a>
                                <div class="content">
                                    <h6 class="user-name">Hello<span class="text-brand">
                                            {{ explode(' ', Auth::user()->name)[0] }} !</span></h6>
                                    <p class="font-xs text-muted">Welcome Back</p>
                                </div>
                            </div>
                        </div>
                        <ul class="mobile-menu">
                            <li><a href="{{ route('buyer.dashboard.index') }}">My Account</a></li>
                            <li><a href="{{ route('buyer.dashboard.orders') }}">Order Tracking</a></li>
                            <li><a href="{{ route('buyer.dashboard.my_orders') }}">My Orders</a></li>
                            <li><a href="{{ route('buyer.dashboard.wishlist') }}">My Wishlist</a></li>
                            <li><a href="{{ route('buyer.dashboard.profile') }}">Setting</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Sign out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="mobile-menu">
                            <li><a href="{{ route('login') }}">Log In</a></li>
                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                        </ul>
                    @endguest
                </div>

                <div class="site-copyright color-gray-400 mt-30">Copyright 2024 &copy; DjibMarket.
                </div>
            </div>
        </div>
    </div>
</div>
