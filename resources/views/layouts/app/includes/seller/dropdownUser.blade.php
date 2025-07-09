@php
    $nameLetters =
        Str::upper(Str::substr(explode(' ', Auth::guard('seller')->user()->name)[0], 0, 1)) .
        Str::upper(Str::substr(explode(' ', Auth::guard('seller')->user()->name)[1] ?? '', 0, 1));
@endphp

<li class="dropdown user-dropdown">
    <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
        <div class="user-toggle">
            <div class="user-avatar sm">
                <em class="icon ni ni-user-alt"></em>
            </div>
            <div class="user-info d-none d-xl-block">
                <div class="user-status user-status-active">Seller</div>
                <div class="user-name dropdown-indicator">{{ Auth::guard('seller')->user()->name }}</div>
            </div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
            <div class="user-card">
                <div class="user-avatar">
                    <span>{{ $nameLetters }}</span>
                </div>
                <div class="user-info">
                    <span class="lead-text">{{ Auth::guard('seller')->user()->name }}</span>
                    <span class="sub-text">{{ Auth::guard('seller')->user()->email }}</span>
                </div>
            </div>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                <li><a href="{{ route('seller.profile') }}"><em class="icon ni ni-user-alt"></em><span>View
                            Profile</span></a></li>
                <li><a href="{{ route('seller.profile.edit') }}"><em class="icon ni ni-setting-alt"></em><span>Account
                            Setting</span></a>
                </li>
                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                </li>
            </ul>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                <li>
                    <form action="{{ route('seller.logout') }}" method="POST">
                        @csrf
                        <a href="javascript:void(0);" onclick="this.closest('form').submit();return false;"><em
                                class="icon ni ni-signout"></em><span>Sign
                                out</span></a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</li>
