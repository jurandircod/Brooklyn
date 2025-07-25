<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class AdvancedEmailDebugCommand extends Command
{
    protected $signature = 'debug:email {--raw : Usar Swift Mailer diretamente}';
    protected $description = 'Debug avançado de configuração de e-mail';

    public function handle()
    {
        $this->info('🔍 Iniciando debug avançado de e-mail...');
        $this->showConfig();

        if ($this->option('raw')) {
            $this->testWithSwiftMailer();
        } else {
            $this->testWithLaravel();
        }
    }

    private function showConfig()
    {
        $this->info('📧 Configurações atuais:');
        $this->table(['Configuração', 'Valor'], [
            ['MAIL_MAILER', config('mail.default')],
            ['MAIL_HOST', config('mail.mailers.smtp.host')],
            ['MAIL_PORT', config('mail.mailers.smtp.port')],
            ['MAIL_USERNAME', config('mail.mailers.smtp.username')],
            ['MAIL_PASSWORD', str_repeat('*', strlen(config('mail.mailers.smtp.password')))],
            ['MAIL_ENCRYPTION', config('mail.mailers.smtp.encryption')],
            ['MAIL_FROM_ADDRESS', config('mail.from.address')],
            ['MAIL_FROM_NAME', config('mail.from.name')],
        ]);
    }

    private function testWithLaravel()
    {
        $this->info('🚀 Testando com Laravel Mail...');
        
        try {
            // Habilitar logs detalhados
            config(['logging.default' => 'single']);
            config(['logging.channels.single.level' => 'debug']);

            $startTime = microtime(true);
            
            Mail::raw('Este é um teste de debug do sistema de e-mail.', function ($message) {
                $message->to('demonido@outlook.com')
                    ->subject('DEBUG TEST - ' . now()->format('Y-m-d H:i:s'))
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo(config('mail.from.address'));
            });

            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            $this->info("✅ Laravel Mail executado em {$duration}ms");
            
            // Verificar se há erros nos logs
            $this->checkRecentLogs();

        } catch (\Exception $e) {
            $this->error('❌ Erro no Laravel Mail:');
            $this->error($e->getMessage());
            $this->line('');
            $this->error('Stack trace:');
            $this->error($e->getTraceAsString());
        }
    }

    private function testWithSwiftMailer()
    {
        $this->info('🔧 Testando com Swift Mailer direto...');

        try {
            // Configurar transporte
            $transport = (new Swift_SmtpTransport(
                config('mail.mailers.smtp.host'),
                config('mail.mailers.smtp.port'),
                config('mail.mailers.smtp.encryption')
            ))
            ->setUsername(config('mail.mailers.smtp.username'))
            ->setPassword(config('mail.mailers.smtp.password'));

            // Habilitar logs do Swift
            $logger = new \Swift_Plugins_Loggers_ArrayLogger();
            $transport->registerPlugin(new \Swift_Plugins_LoggerPlugin($logger));

            $mailer = new Swift_Mailer($transport);

            // Criar mensagem
            $message = (new Swift_Message('SWIFT DEBUG TEST - ' . now()->format('Y-m-d H:i:s')))
                ->setFrom([config('mail.from.address') => config('mail.from.name')])
                ->setTo(['jurandiraparecido19651965@gmail.com'])
                ->setBody('Este é um teste direto com Swift Mailer para debug.');

            $startTime = microtime(true);
            $result = $mailer->send($message);
            $endTime = microtime(true);
            
            $duration = round(($endTime - $startTime) * 1000, 2);

            if ($result) {
                $this->info("✅ Swift Mailer enviado em {$duration}ms");
                $this->info("📊 Emails enviados: {$result}");
            } else {
                $this->error("❌ Swift Mailer falhou");
            }

            // Mostrar logs do Swift
            $this->info('📝 Logs do Swift Mailer:');
            $this->line($logger->dump());

        } catch (\Exception $e) {
            $this->error('❌ Erro no Swift Mailer:');
            $this->error($e->getMessage());
        }
    }

    private function checkRecentLogs()
    {
        $logFile = storage_path('logs/laravel.log');
        
        if (!file_exists($logFile)) {
            $this->warn('⚠️  Arquivo de log não encontrado');
            return;
        }

        $this->info('📋 Últimas linhas do log:');
        $lines = file($logFile);
        $recentLines = array_slice($lines, -20);
        
        foreach ($recentLines as $line) {
            if (stripos($line, 'mail') !== false || 
                stripos($line, 'smtp') !== false || 
                stripos($line, 'error') !== false) {
                $this->line(trim($line));
            }
        }
    }
}