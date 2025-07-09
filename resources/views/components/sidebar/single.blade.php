@props(['title', 'link', 'icon' => 'ni-dashboard-fill', 'iconStatus' => true])
<li class="nk-menu-item">
    <a href="{{ $link }}" class="nk-menu-link">
        @if ($iconStatus)
            <span class="nk-menu-icon"><em class="icon ni {{ $icon }}"></em></span>
        @endif
        <span class="nk-menu-text">{{ $title }}</span>
    </a>
</li>
