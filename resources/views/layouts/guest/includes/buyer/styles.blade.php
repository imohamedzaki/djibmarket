<link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
{{-- import vendors --}}
<link rel="stylesheet" href="{{ asset('assets/vendors/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/uicons-regular-rounded.css') }}">

{{-- import plugins --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.min.css') }}">

{{-- Reset file --}}
<link href="{{ asset('assets/css/v1/reset.css') }}" rel="stylesheet">

{{-- Main css file --}}
<link href="{{ asset('assets/css/app.css?v=3.0.0') }}" rel="stylesheet">
@include('includes.slickSlider.slickslider_css')
@include('includes.z_alert.contentCSS')
<link href="{{ asset('assets/css/tabler-icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/tabler-icons-filled.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/tabler-icons-outline.min.css') }}" rel="stylesheet">
@yield('css')
