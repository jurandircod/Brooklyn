<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique Seu Endereço de Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Uma nova verificação foi enviada para seu endereço de email.') }}
                        </div>
                    @endif

                    {{ __('Depois do processo, verifique seu endereço de email, caso não tenha recebido nada.') }}
                    {{ __('Clique no botão abaixo para verificar seu endereço de email.') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para verificar seu endereço de email') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
