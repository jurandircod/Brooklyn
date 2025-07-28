<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Redefinição de Senha')
            ->line('Você está recebendo este email porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Redefinir Senha', url(config('app.url').route('site.password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Este link expirará em '.config('auth.passwords.users.expire').' minutos.')
            ->line('Se você não solicitou uma redefinição de senha, ignore este email.');
    }
}