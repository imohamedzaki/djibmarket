@props(['title', 'icon' => 'ni-dashboard-fill'])
<li class="nk-menu-item has-sub">
    <a href="#" class="nk-menu-link nk-menu-toggle">
        <span class="nk-menu-icon"><em class="icon ni {{ $icon }}"></em></span>
        <span class="nk-menu-text">{{ $title }}</span>
    </a>
    <ul class="nk-menu-sub">
        {{ $slot }}
    </ul>
</li><!-- .nk-menu-item -->
