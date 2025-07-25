<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailCommand extends Command
{
    protected $signature = 'test:email {--debug : Mostrar informações de debug}';
    protected $description = 'Testar configuração de e-mail com debug detalhado';

    public function handle()
    {
        $this->info('🚀 Iniciando teste de e-mail...');
        
        // Mostrar configurações se --debug for usado
        if ($this->option('debug')) {
            $this->showMailConfig();
        }

        try {
            $startTime = microtime(true);
            
            Mail::raw('Teste de email simples', function ($message) {
                $message->to('jurandiraparecido19651965@gmail.com')
                    ->subject('TESTE SIMPLES ' . now()->format('H:i:s'))
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });

            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            $this->info("✅ E-mail enviado com sucesso em {$duration}ms!");
            
            // Log para debug
            Log::info('Email teste enviado', [
                'to' => 'jurandiraparecido19651965@gmail.com',
                'duration' => $duration . 'ms',
                'timestamp' => now()
            ]);

        } catch (\Exception $e) {
            $this->error('❌ Erro ao enviar e-mail:');
            $this->error($e->getMessage());
            
            if ($this->option('debug')) {
                $this->error('Stack trace:');
                $this->error($e->getTraceAsString());
            }
            
            Log::error('Erro no teste de email', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
        }
    }

    private function showMailConfig()
    {
        $this->info('📧 Configurações de e-mail:');
        $this->table(['Configuração', 'Valor'], [
            ['MAIL_MAILER', config('mail.default')],
            ['MAIL_HOST', config('mail.mailers.smtp.host')],
            ['MAIL_PORT', config('mail.mailers.smtp.port')],
            ['MAIL_USERNAME', config('mail.mailers.smtp.username')],
            ['MAIL_ENCRYPTION', config('mail.mailers.smtp.encryption')],
            ['MAIL_FROM_ADDRESS', config('mail.from.address')],
            ['MAIL_FROM_NAME', config('mail.from.name')],
        ]);
    }
}