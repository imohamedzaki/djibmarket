<head>
    <meta charset="utf-8">
    <meta name="author" content="Mohamed Zaki">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="An educational platform personalized for the students">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/imgs/template') }}/favicon.png" sizes="32x26"> <!-- Page Title  -->
    <title>Admin @yield('title', 'DjibMarket')</title>
    @include('layouts.app.includes.admin.styles')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/shared/js/jquery.min.js') }}"></script>
    @yield('css')
</head>
