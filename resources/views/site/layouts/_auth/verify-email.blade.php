<div class="min-h-screen flex items-center justify-center bg-[#f6f1eb] px-4">
    <div class="w-full max-w-md bg-[#fffaf5] rounded-2xl shadow-xl border border-[#e2d6c7] p-8">

        <h1 class="text-2xl font-semibold text-center text-[#4b3621] mb-3">
            Verifique seu e-mail
        </h1>

        <p class="text-center text-sm text-[#6b4f3a] mb-6">
            Enviamos um link de verificação para o seu e-mail.
            Caso não tenha recebido, você pode solicitar novamente abaixo.
        </p>

        @if (session('resent'))
            <div class="mb-5 rounded-lg px-4 py-3 text-sm text-green-900 bg-[#d9cfc2] border border-[#b59f87] text-center">
                Uma nova verificação foi enviada para seu endereço de e-mail.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="flex justify-center">
            @csrf
            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-[#8b5e3c] text-white font-medium 
                       hover:bg-[#70482d] transition duration-300 shadow-md"
            >
                Enviar novamente
            </button>
        </form>

        <p class="text-center text-xs text-[#8b6a4f] mt-6">
            Após clicar, confira também sua caixa de spam ou promoções.
        </p>

    </div>
</div>
