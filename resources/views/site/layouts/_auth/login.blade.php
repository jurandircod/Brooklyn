@extends('layouts.app')



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
                    <input type="email" id="name" name="email" value="{{ old('email') }}" required
                        autofocus autocomplete="name" placeholder="Digite seu email">
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

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Manter logado</label>
                </div>

                <div class="button login">
                    <button type="submit">
                        <span>Logar</span>
                        <i class="fa fa-arrow-right"></i>
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