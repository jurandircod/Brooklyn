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

    <style>
        .breadcrumb-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            list-style: none;
            padding: 0;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }

            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        .save-details {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .save-details:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .save-details.selected {
            border-color: #667eea;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8eeff 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .save-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.5s;
        }

        .save-details:hover::before {
            left: 100%;
        }

        .save-name h5 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .save-name h5::before {
            content: '\f3c5';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #667eea;
            margin-right: 10px;
        }

        .address-checkbox {
            position: relative;
            display: inline-block;
        }

        .address-checkbox input[type="radio"] {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkbox-custom {
            display: inline-flex;
            align-items: center;
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .checkbox-custom:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .checkbox-custom::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .address-checkbox input[type="radio"]:checked+.checkbox-custom::before {
            opacity: 1;
        }

        .payment-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .custome-radio-box {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .custome-radio-box:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .custome-radio-box.active {
            border-color: #667eea;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8eeff 100%);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            font-weight: 500;
            margin-left: 10px;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .payment-icon {
            margin-right: 10px;
            width: 24px;
            text-align: center;
        }

        .card-fields {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 20px;
            margin-top: 15px;
            border-left: 4px solid #667eea;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-solid-default {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-solid-default:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .your-cart-box {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }

        .new-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .list-group-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .parcelas-select {
            margin-top: 15px;
            padding: 15px;
            background: #e8eeff;
            border-radius: 10px;
        }

        .section-b-space {
            padding: 60px 0;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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
        border-bottom: 1px solid rgba(117, 32, 221, 0.1);
        line-height: 40px;
        transition: background 0.3s ease;
    }

    header .profile-dropdown ul li:hover {
        background: rgba(117, 32, 221, 0.05);
    }

    header .profile-dropdown ul li:last-child {
        border-color: transparent;
    }

    header .profile-dropdown ul {
        padding: 12px 0;
        min-width: 280px;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    }

    .name-usr {

        padding: 12px 16px;
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 24px;
        border-radius: 8px;
        letter-spacing: 0.5px;
    }

    .name-usr span {
        margin-right: 12px;
    }

    /* Mobile Menu */
    .mobile-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px 20px 0 0;
        box-shadow: 0 -5px 25px rgba(0, 0, 0, 0.1);
    }

    .mobile-menu ul {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 15px 0;
        margin: 0;
        list-style: none;
    }

    .mobile-menu ul li a {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #666;
        transition: all 0.3s ease;
        padding: 10px;
        border-radius: 12px;
    }

    .mobile-menu ul li a.active,
    .mobile-menu ul li a:hover {
        color: #7520DD;
        background: rgba(117, 32, 221, 0.1);
        transform: translateY(-2px);
    }

    .mobile-menu ul li a svg,
    .mobile-menu ul li a i {
        width: 24px;
        height: 24px;
        margin-bottom: 4px;
        stroke: currentColor;
    }

    .mobile-menu ul li a span {
        font-size: 12px;
        font-weight: 500;
        margin-top: 2px;
    }

    /* Login Section */
    .login-section {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .materialContainer {
        width: 100%;
        max-width: 420px;
    }

    .box {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-title {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-title h2 {
        color: #2d3748;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .input {
        position: relative;
        margin-bottom: 24px;
    }

    .input label {
        display: block;
        color: #4a5568;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .input input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 16px;
        background: #f8fafc;
        transition: all 0.3s ease;
        outline: none;
    }

    .input input:focus {
        border-color: #7520DD !important;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(117, 32, 221, 0.1);
        transform: translateY(-1px);
    }

    .input input:hover {
        border-color: #cbd5e0;
        background: #fff;
    }

    /* Error Messages */
    .invalid-feedback {
        display: block;
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        font-weight: 500;
    }

    /* Forgot Password Link */
    .pass-forgot {
        display: inline-block;
        color: #7520DD;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .pass-forgot:hover {
        color: #5a1a9b;
        text-decoration: underline;
    }

    /* Checkbox */
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 12px;
        accent-color: #7520DD;
    }

    .form-check-label {
        color: #4a5568;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
    }

    /* Login Button */
    .button.login {
        margin-bottom: 24px;
    }

    .button.login button {
        width: 100%;
        background: linear-gradient(135deg, #7520DD, #9333ea);
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
        letter-spacing: 0.3px;
    }

    .button.login button:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(117, 32, 221, 0.4);
        background: linear-gradient(135deg, #5a1a9b, #7c3aed);
    }

    .button.login button:active {
        transform: translateY(0);
    }

    .button.login button i {
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .button.login button:hover i {
        transform: translateX(2px);
    }

    /* Register Link */
    .box p {
        text-align: center;
        color: #718096;
        font-size: 14px;
        margin: 0;
    }

    .box p a.theme-color {
        color: #7520DD;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .box p a.theme-color:hover {
        color: #5a1a9b;
        text-decoration: underline;
    }

    /* Tap to Top */
    .tap-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #7520DD, #9333ea);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(117, 32, 221, 0.3);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .tap-to-top:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(117, 32, 221, 0.4);
    }

    .tap-to-top a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .h-logo {
            max-width: 150px !important;
        }

        i.sidebar-bar {
            font-size: 22px;
        }

        .name-usr {
            padding: 8px 12px;
            font-size: 13px;
        }

        .box {
            padding: 32px 24px;
            margin: 10px;
        }

        .login-title h2 {
            font-size: 24px;
        }

        .input input {
            padding: 14px 16px;
            font-size: 16px;
        }

        .button.login button {
            padding: 14px 20px;
            font-size: 15px;
        }

        .tap-to-top {
            bottom: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
        }
    }

    @media (max-width: 480px) {
        .login-section {
            padding: 15px;
        }

        .box {
            padding: 28px 20px;
        }

        .mobile-menu ul li a span {
            font-size: 11px;
        }

        .mobile-menu ul li a svg,
        .mobile-menu ul li a i {
            width: 20px;
            height: 20px;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .box {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Input focus effects */
    .input input::placeholder {
        color: #a0aec0;
        transition: all 0.3s ease;
    }

    .input input:focus::placeholder {
        opacity: 0;
        transform: translateX(10px);
    }
</style>

<body class="theme-color3 light ltr">
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
