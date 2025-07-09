@extends('layouts.guest.admin')

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="{{ route('admin.dashboard') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/imgs/template/logo_only.png') }}"
                    srcset="{{ asset('assets/imgs/template/logo_only.png') }}" alt="logo-dark">
            </a>
        </div>
        <div class="card card-bordered" style="overflow: hidden">
            <p class="custom_guard">
                <span>Admin</span>
            </p>
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">Confirm Password</h4>
                        <div class="nk-block-des">
                            <p>This is a secure area of the application. Please confirm your password before continuing.</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" name="password"
                                required autocomplete="current-password" placeholder="Enter your password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <button id="submitButton"
                            class="submitButton btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center">
                            <span class="button-text">Confirm</span>
                            <div id="loadingSpinner"
                                class="loadingSpinner spinner-border spinner-border-sm text-light ms-2 d-none"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
