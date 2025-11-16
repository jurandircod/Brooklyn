<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Manifest e Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('images/newletter-icon.png') }}" type="image/x-icon">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicon.ico') }}">
    <meta name="theme-color" content="#e87316">

    <!-- Libera uso de recursos de terceiros -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- SEO -->
    <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- CSS Vendors -->
    <link rel="stylesheet" href="{{ asset('css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demo4.css') }}">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="{{ asset('css/site/basico.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- CSS Externos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Inline CSS -->
    <style>
        .h-logo {
            max-width: 185px !important;
        }

        .f-logo {
            max-width: 220px !important;
        }

        @media only screen and (max-width: 600px) {
            .h-logo {
                max-width: 110px !important;
            }
        }
    </style>

    <title>Brooklyn SkateShop - @yield('titulo')</title>
</head>

<body class="theme-color2 light ltr">
    <style>
        header .profile-dropdown ul li {
            display: block;
            padding: 5px 20px;
            border-bottom: 1px solid #ddd;
            line-height: 35px;
        }

        header .profile-dropdown ul li:last-child {
            border-color: #fff;
        }

        header .profile-dropdown ul {
            padding: 10px 0;
            min-width: 250px;
        }

        .name-usr {
            background: #e87316;
            padding: 8px 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 24px;
        }

        .name-usr span {
            margin-right: 10px;
        }

        @media (max-width:600px) {
            .h-logo {
                max-width: 150px !important;
            }

            i.sidebar-bar {
                font-size: 22px;
            }

            .mobile-menu ul li a svg {
                width: 20px;
                height: 20px;
            }

            .mobile-menu ul li a span {
                margin-top: 0px;
                font-size: 12px;
            }

            .name-usr {
                padding: 5px 12px;
            }
        }
    </style>

        @include('site.layouts._components.perfil.mobileMenu')
        @include('site.layouts._partials.topo')
        @yield('conteudo')
        @include('site.layouts._partials.footer')
</body>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/feather/feather.min.js') }}"></script>
<script src="{{ asset('js/lazysizes.min.js') }}"></script>
<script src="{{ asset('js/slick/slick.js') }}"></script>
<script src="{{ asset('js/slick/slick-animation.min.js') }}"></script>
<script src="{{ asset('js/slick/custom_slick.js') }}"></script>
<script src="{{ asset('js/price-filter.js') }}"></script>
<script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('js/filter.js') }}"></script>
<script src="{{ asset('js/newsletter.js') }}"></script>
<script src="{{ asset('js/cart_modal_resize.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('js/theme-setting.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script>
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip()
    });
</script>

</html>
