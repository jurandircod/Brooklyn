@component('mail::message')
{{-- Logo (usa embed se disponível, senão asset) --}}
<div style="text-align:center; margin-bottom:18px;">
    <img src="{{ isset($message) ? $message->embed(public_path('images/1.png')) : asset('images/1.png') }}"
         alt="Brooklyn Skateshop" width="160" style="border-radius:14px; display:block; margin: 0 auto;">
</div>

{{-- Título --}}
# E aí, skater! 🛹

{{-- Intro --}}
<p style="font-size:15px; line-height:1.4; margin-top:8px;">
    Valeu por se cadastrar na <strong>Brooklyn Skateshop</strong> — a quebrada dos shapes, tênis e rolês.
    Antes de começar a comprar e tirar onda, confirma seu e-mail pra gente saber que é você mesmo.
</p>

{{-- Botão de ação --}}
@component('mail::button', ['url' => $actionUrl ?? $displayableActionUrl, 'color' => 'primary'])
🔥 CONFIRMAR MEU E-MAIL
@endcomponent

{{-- Mensagem extra / tom jovem --}}
<p style="margin-top:14px; font-size:14px;">
    Se não foi você que pediu, relaxa — ignora esse e-mail. Se tiver problema no clique, usa o link abaixo.
</p>

{{-- Subcopy com link direto --}}
@isset($actionText)
@slot('subcopy')
<div style="background:#f7f7f8; padding:12px; border-radius:6px; margin-top:12px;">
    <small style="color:#555;">
        Não consegue usar o botão? Copia e cola este link no navegador:
        <br>
        <a href="{{ $actionUrl ?? $displayableActionUrl }}" target="_blank" style="word-break:break-all;">
            {{ $actionUrl ?? $displayableActionUrl }}
        </a>
    </small>
</div>
@endslot
@endisset

{{-- Saudações --}}
<p style="margin-top:18px; font-weight:600;">Keep skating! ✌️<br>Equipe Brooklyn Skateshop</p>

{{-- Footer --}}
<div style="text-align:center; margin-top:22px; padding:14px; background:#fafafa; border-radius:8px; font-size:12px; color:#666;">
    📍 Centro, 19 — Cruzeiro do Oeste/PR • 📞 (44) 999747097<br>
    Siga: <strong>@brooklynskateshop</strong>
</div>

@endcomponent
