@extends('layouts.app')


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

<div class="mobile-menu d-sm-none">
    <ul>
        <li>
            <a href="demo3.php" class="active">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="align-justify"></i>
                <span>Category</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="shopping-bag"></i>
                <span>Cart</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li>
            <a href="user-dashboard.php">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </li>
    </ul>
</div>
<style>
    input [type="text"]:focus,
    [type="email"]:focus,
    [type="url"]:focus,
    [type="password"]:focus,
    [type="number"]:focus,
    [type="date"]:focus,
    [type="datetime-local"]:focus,
    [type="month"]:focus,
    [type="search"]:focus,
    [type="tel"]:focus,
    [type="time"]:focus,
    [type="week"]:focus,
    [multiple]:focus,
    textarea:focus,
    select:focus {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input [type="text"]:hover,
    [type="email"]:hover,
    [type="url"]:hover,
    [type="password"]:hover,
    [type="number"]:hover,
    [type="date"]:hover,
    [type="datetime-local"]:hover,
    [type="month"]:hover,
    [type="search"]:hover,
    [type="tel"]:hover,
    [type="time"]:hover,
    [type="week"]:hover,
    [multiple]:hover,
    textarea:hover,
    select:hover {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input [type="text"]:active,
    [type="email"]:active,
    [type="url"]:active,
    [type="password"]:active,
    [type="number"]:active,
    [type="date"]:active,
    [type="datetime-local"]:active,
    [type="month"]:active,
    [type="search"]:active,
    [type="tel"]:active,
    [type="time"]:active,
    [type="week"]:active,
    [multiple]:active,
    textarea:active,
    select:active {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }
</style>
<!-- Log In Section Start -->
<div class="login-section">
    <div class="materialContainer">
        <div class="box">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="login-title">
                    <h2>Entrar com sua conta</h2>
                </div>
                <div class="input">
                    <label for="name">Nome</label>
                    <input type="email" id="name" name="email" :value="old('email')" required=""
                        autofocus="" autocomplete="name">

                </div>
                @if ($errors->has('email'))
                    <span style="color: red">{{ $errors->first('email') }}</span>
                    <span class="invalid-feedback" style="color: red" role="alert">
                        {{ $errors->first('email') }}
                    </span>
                @endif

                <div class="input">
                    <label for="pass">Senha</label>
                    <input type="password" id="pass" class="block mt-1 w-full" name="password" required=""
                        autocomplete="current-password">

                </div>
                @if ($errors->has('password'))
                    <span style="color: red">{{ $errors->first('password') }}</span>
                    <span class="invalid-feedback" style="color: red" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <a href="{{ route('password.request') }}" class="pass-forgot">Esqueceu sua senha?</a>

                <div class="button login">
                    <button type="submit">
                        <span>Logar</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>

                <p>Não lembra? <a href="{{route('register')}}" class="theme-color">Se inscrever</a></p>
            </form>
        </div>
    </div>
</div>
<!-- Log In Section End -->


<div class="tap-to-top">
    <a href="#home">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>
<div class="bg-overlay"></div>
