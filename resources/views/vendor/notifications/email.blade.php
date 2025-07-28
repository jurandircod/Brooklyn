@component('mail::message')
{{-- Header com Logo --}}
<div style="text-align: center; margin-bottom: 30px;">
    <img src="https://via.placeholder.com/200x80/000000/FFFFFF?text=BROOKLYN+SKATESHOP" alt="Brooklyn Skateshop" style="max-width: 200px; height: auto;">
</div>

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# 🛹 Ops! Algo deu errado...
@else
# 🛹 E aí, skater!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'success';
            break;
        case 'error':
            $color = 'error';
            break;
        default:
            $color = 'primary';
    }
?>
<div style="text-align: center; margin: 25px 0;">
    @component('mail::button', ['url' => $actionUrl, 'color' => $color])
    🔥 {{ $actionText }}
    @endcomponent
</div>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Divider Style --}}
<hr style="border: none; border-top: 2px solid #333; margin: 30px 0;">

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
**Keep skating!** 🛹<br>
**Equipe Brooklyn Skateshop**<br>
<small style="color: #666;">Sua loja de skate de confiança</small>
@endif

{{-- Footer com informações da loja --}}
<div style="text-align: center; margin-top: 40px; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
    <p style="margin: 5px 0; color: #666; font-size: 14px;">
        <strong>Brooklyn Skateshop</strong><br>
        📍 Endereço da loja • 📞 (XX) XXXX-XXXX<br>
        🌐 www.brooklynskateshop.com • 📧 contato@brooklynskateshop.com
    </p>
    <p style="margin: 10px 0 0 0; color: #888; font-size: 12px;">
        Siga-nos nas redes sociais: @brooklynskateshop
    </p>
</div>

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
<div style="background-color: #f1f1f1; padding: 15px; border-radius: 5px; margin-top: 20px;">
    <p style="font-size: 12px; color: #666; margin: 0;">
        Se você está tendo problemas para clicar no botão "{{ $actionText }}", copie e cole o link abaixo no seu navegador:
    </p>
    <p style="font-size: 12px; margin: 10px 0 0 0;">
        <span class="break-all" style="color: #007bff;">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
    </p>
</div>
@endslot
@endisset
@endcomponent