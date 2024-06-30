<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Esa Gallery menyediakan solusi desain interior, furniture, dan kontraktor yang andal dan efisien untuk kebutuhan proyek Anda." />
    <meta name="author" content="Esa Gallery" />
    <meta name="keywords" content="desain interior, furniture, kontraktor, manajemen proyek, distribusi, Esa Gallery" />    
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet" />
    @stack('style')
</head>

<body id="#">
    <div id="arrowButton" class="me-lg-5 visible">
        <div class="d-flex flex-column gap-2">
            <a
                href="https://api.whatsapp.com/send?phone=6282126056028&text=Salam%20PT.%20esa%20Logistik%2C%20saya%20ingin%20berkonsultasi%20mengenai%20pengiriman%20barang.%20Terima%20kasih.">
                <img src="{{ asset('frontend/assets/whatsapp.svg') }}" width="50px"
                    alt="icon whatsapp">
            </a>
            <div class="text-center">
                <a href="#" class="btn btn-light bg-white shadow-none border-esa-secondary">
                    <i class="bi bi-arrow-up text-esa-secondary fw-bold"></i>
                </a>
            </div>
        </div>
    </div>
    <main class="flex-shrink-0">
        @include('components.header-frontend')
        @yield('main')
    </main>
    @include('components.footer-frontend')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/extensions/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/static/js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>
