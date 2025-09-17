<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="assets/images/favicon.ico">
    <link rel="icon" href="{{ asset('images/newletter-icon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/newletter-icon.png') }}" type="image/x-icon">
    <meta name="theme-color" content="#e87316">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Surfside Media">
    <meta name="msapplication-TileImage" content="assets/images/favicon.ico">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors/slick/slick-theme.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('css/demo4.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site/basico.css') }}">


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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Brooklyn SkateShop - @yield('titulo')</title>
</head>
<style>
    * {
        box-sizing: border-box;
    }

    /* Header Styles */
    header .profile-dropdown ul li {
        display: block;
        padding: 8px 20px;
        border-bottom: 1px solid rgba(58, 30, 30, 0.2);
        /* vinho queimado suave */
        line-height: 40px;
        transition: background 0.3s ease;
    }

    header .profile-dropdown ul li:hover {
        background: rgba(58, 30, 30, 0.1);
        /* hover discreto */
    }

    header .profile-dropdown ul li:last-child {
        border-color: transparent;
    }

    header .profile-dropdown ul {
        padding: 12px 0;
        min-width: 280px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .name-usr {
        padding: 12px 16px;
        color: #f5f5f5;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 24px;
        border-radius: 8px;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #2a2a2a, #3a1e1e);
        /* preto grafite + vinho queimado */
    }

    .name-usr span {
        margin-right: 12px;
    }

    /* Mobile Menu */
    .mobile-menu {
        background: rgba(26, 26, 26, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px 20px 0 0;
        box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.3);
    }

    .mobile-menu ul li a {
        color: #a1a1a1;
    }

    .mobile-menu ul li a.active,
    .mobile-menu ul li a:hover {
        color: #a84c3d;
        /* cobre queimado */
        background: rgba(168, 76, 61, 0.1);
        transform: translateY(-2px);
    }

    /* Background animado */
    .login-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        background-image: url("https://images.unsplash.com/photo-1520045892732-304bc3ac5d8e?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c2thdGV8ZW58MHx8MHx8fDA%3D");
        background-size: cover;
        position: relative;
        overflow: hidden;
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    /* Partículas */
    .login-section::before {
        content: "";
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: moveDots 40s linear infinite;
        z-index: 0;
    }

    @keyframes moveDots {
        from {
            transform: translate(0, 0);
        }

        to {
            transform: translate(-200px, -200px);
        }
    }

    /* Box estilizado */
    .box {
        background: rgba(30, 30, 30, 0.8);
        backdrop-filter: blur(25px);
        border-radius: 28px;
        padding: 45px;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.08);
        z-index: 2;
        animation: fadeInUp 0.6s ease-out;
    }

    /* Título com gradiente */
    .login-title h2 {
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 20px;
        background: linear-gradient(90deg, #a84c3d, #ff784f);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .breadcrumb-section {
        background: var(--theme-color);
    }

    .breadcrumb-section .circles li:nth-child(odd) {
        background-color: #F2C14E;
        /* amarelo vibrante */
    }

    .breadcrumb-section .circles li:nth-child(even) {
        background-color: #2A9D8F;
        /* verde água */
    }

    /* Botão Social */
    .social-login {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .social-login button {
        flex: 1;
        border: none;
        border-radius: 12px;
        padding: 12px;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .social-login button:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Inputs */
    .input label {
        color: var(--theme-color);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .input input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #3a3a3a;
        border-radius: 16px;
        font-size: 16px;
        background: rgba(255, 255, 255, 0.05);
        color: var(--theme-color);
        transition: all 0.3s ease;
    }

    .input input:focus {
        border-color: #a84c3d;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 0 4px rgba(168, 76, 61, 0.25);
        transform: translateY(-2px);
    }

    /* Placeholder animado */
    .input input::placeholder {
        color: #9a9a9a;
        transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .input input:focus::placeholder {
        opacity: 0;
        transform: translateX(10px);
    }

    /* Login Button */
    .button.login button {
        width: 100%;
        background: linear-gradient(135deg, #a84c3d, #3a1e1e);
        border: none;
        border-radius: 16px;
        padding: 16px 24px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .button.login button:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(168, 76, 61, 0.4);
        background: linear-gradient(135deg, #8c3a2d, #2a1a1a);
    }


    .invalid-feedback {
        color: #c0392b;
        /* vermelho queimado */
    }

    .pass-forgot {
        color: #a84c3d;
    }

    .pass-forgot:hover {
        color: #8c3a2d;
    }

    .form-check-input {
        accent-color: #a84c3d;
    }

    /* Register Link */
    .box p a.theme-color {
        color: #a84c3d;
    }

    .box p a.theme-color:hover {
        color: #8c3a2d;
    }

    /* Tap to Top */
    .tap-to-top {
        background: linear-gradient(135deg, #3a1e1e, #a84c3d);
        box-shadow: 0 10px 25px rgba(168, 76, 61, 0.3);
    }

    .tap-to-top:hover {
        box-shadow: 0 15px 35px rgba(168, 76, 61, 0.5);
    }
</style>

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
