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
                        <h4 class="nk-block-title">Forgot Password</h4>
                        <div class="nk-block-des">
                            <p>If you forgot your password, don't worry. We'll email you instructions to reset your
                                password.</p>
                        </div>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                value="{{ old('email') }}" required autofocus placeholder="Enter your email address">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <button id="submitButton"
                            class="submitButton btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center">
                            <span class="button-text">Email Password Reset Link</span>
                            <div id="loadingSpinner"
                                class="loadingSpinner spinner-border spinner-border-sm text-light ms-2 d-none"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4">
                    <a href="{{ route('admin.login') }}"><strong>Return to login</strong></a>
                </div>
            </div>
        </div>
    </div>
@endsection
