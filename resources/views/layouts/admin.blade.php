<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/compiled/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/static/css/style.css') }}">
    @stack('style')
</head>

<body>
    <script src="{{ asset('admin/static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('components.sidebar-admin')
        <div id="main" class='layout-navbar navbar-fixed'>
            @include('components.header-admin')
            <div id="main-content">
                @yield('main')
                @include('components.footer-admin')
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/extensions/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/compiled/js/app.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('admin/static/js/custom.js') }}"></script>
</body>

</html>
