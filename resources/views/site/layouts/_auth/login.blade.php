@extends('layouts.app')

<!-- Log In Section Start -->
<div class="login-section">
    <div class="materialContainer">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-title">
                <h2>Entrar com sua conta</h2>
            </div>

            <div class="input">
                <label for="name">Nome</label>
                <input type="email" id="name" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="name" placeholder="Digite seu email">
            </div>
            @if ($errors->has('email'))
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
            @endif

            <div class="input">
                <label for="pass">Senha</label>
                <input type="password" id="pass" class="block mt-1 w-full" name="password" required
                    autocomplete="current-password" placeholder="Digite sua senha">
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
            @endif

            <a href="{{ route('site.email.verificar') }}" class="pass-forgot">Esqueceu sua senha?</a>

            <div class="button login">
                <button type="submit">
                    <span>Logar</span>
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>

            
            <!-- Example social buttons (configure routes if needed) -->
            <div class="mt-4">
                <a href="{{ url('login/google') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl border border-gray-200 hover:shadow-sm transition">
                <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-4 h-4">
                <span class="text-sm text-gray-700">Entrar com o Google</span>
            </a>
        </div>
        <p>Não lembra? <a href="{{ route('register') }}" class="theme-color">Se inscrever</a></p>
        </form>

    </div>
</div>
<!-- Log In Section End -->
