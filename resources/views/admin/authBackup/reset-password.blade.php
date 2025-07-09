@extends('layouts.guest.admin')

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="{{ route('admin.login') }}" class="logo-link">
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
                        <h4 class="nk-block-title">Reset Password</h4>
                        <div class="nk-block-des">
                            <p>Create a new password for your account</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

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
                                required autocomplete="new-password" placeholder="Enter your new password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                data-target="password_confirmation">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password_confirmation"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm your new password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <button id="submitButton"
                            class="submitButton btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center">
                            <span class="button-text">Reset Password</span>
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
