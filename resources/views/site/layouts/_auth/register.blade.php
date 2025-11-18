<!-- Sign Up Section Start -->
<div class="login-section">
    <div class="materialContainer">
        <div class="box">
            <form method="POST" action="{{ route('registerSalvar') }}">
                @csrf
                <div class="login-title">
                    <h2>Registrar</h2>
                </div>

                <div class="input">
                    <label for="name">Nome</label>
                    <input type="text" id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required="" autofocus="" autocomplete="name">
                </div>
                @if ($errors->has('name'))
                    <span style="color: red">{{ $errors->first('name') }}</span>
                    <span class="invalid-feedback" style="color: red" role="alert">
                        {{ $errors->first('name') }}
                    </span>
                @endif

                <div class="input">
                    <label for="emailname">Email</label>
                    <input type="email" id="emailname" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required="" autocomplete="username">
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
                        autocomplete="new-password">
                </div>
                @if ($errors->has('password'))
                    <span style="color: red">{{ $errors->first('password') }}</span>
                    <span class="invalid-feedback" style="color: red" role="alert">
                        {{ $errors->first('password') }}
                    </span>
                @endif

                <div class="input">
                    <label for="compass">Confirmar senha</label>
                    <input type="password" id="compass" class="block mt-1 w-full" name="password_confirmation"
                        required="" autocomplete="new-password">
                </div>
                @if ($errors->has('password_confirmation'))
                    <span style="color: red">{{ $errors->first('password_confirmation') }}</span>
                    <span class="invalid-feedback" style="color: red" role="alert">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif

                <div class="button login">
                    <button type="submit">
                        <span>Enviar</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
        <p><a href="{{ route('login') }}" class="text-white">Já tem uma conta?</a></p>
    </div>
</div>
