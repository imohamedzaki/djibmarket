<div class="topbar">
    <div class="container-topbar">
        <div class="menu-topbar-left">
            <ul class="nav-small">
                <li><a class="font-xs" href="{{ route('buyer.about') }}">About Us</a></li>
                <li><a class="font-xs" href="{{ route('buyer.join') }}">Join US</a></li>
                <li><a class="font-xs" href="{{ route('seller.register') }}">Become a seller</a></li>
                <li><a class="font-xs" href="{{ route('vendors.index') }}">List of vendors</a></li>
                <li><a class="font-xs" href="{{ route('buyer.contact') }}">Contact Us</a></li>
            </ul>
        </div>
        <div class="info-topbar text-center"><span class="font-xs color-brand-3">Free shipping for all
                orders over</span><span class="font-sm-bold color-success"> 5,000.00 Fdj</span></div>
        <div class="menu-topbar-right"><span class="font-xs color-brand-3">Need help? Call Us:</span><span
                class="font-sm-bold color-success"> 77 60 8558</span>
            <div class="dropdown dropdown-language">
                <button class="btn dropdown-toggle" id="dropdownPage" type="button" data-bs-toggle="dropdown"
                    aria-expanded="true" data-bs-display="static"><span
                        class="dropdown-right font-xs color-brand-3"><img
                            src="{{ asset('assets/imgs/template/en.svg') }}" alt="Ecom"> English</span></button>
                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownPage" data-bs-popper="static">
                    <li><a class="dropdown-item" href="#"><img
                                src="{{ asset('assets/imgs/template/flag-en.svg') }}" alt="English"> English</a></li>
                    <li><a class="dropdown-item" href="#"><img
                                src="{{ asset('assets/imgs/template/flag-fr.svg') }}" alt="Français"> Français</a></li>
                    <li><a class="dropdown-item" href="#"><img
                                src="{{ asset('assets/imgs/template/flag-ar.svg') }}" style="width:18.3px;"
                                alt="Arabic"> Arabic</a></li>
                </ul>
            </div>
            <div class="dropdown dropdown-language">
                <button class="btn dropdown-toggle" id="dropdownPage2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="true" data-bs-display="static"><span
                        class="dropdown-right font-xs color-brand-3">DJF</span></button>
                <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="dropdownPage2"
                    data-bs-popper="static">
                    <li><a class="dropdown-item active" href="#">DJF</a></li>
                    <li><a class="dropdown-item" href="#">USD</a></li>
                    <li><a class="dropdown-item" href="#">EUR</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
