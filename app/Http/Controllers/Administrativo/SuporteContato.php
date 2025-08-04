<?php
// Controller: App\Http\Controllers\Administrativo\SuporteContato.php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contato;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SuporteContato extends Controller
{
    /**
     * Exibe a view do dashboard de suporte
     */
    public function viewContato(Request $request)
    {
        return view('administrativo.suporteContato');
    }

    /**
     * Retorna todos os contatos via AJAX
     */
    public function getContatos(Request $request)
    {
        try {
            $contatos = Contato::orderBy('created_at', 'desc')->get();
            
            // Formatar dados para o frontend
            $contatosFormatados = $contatos->map(function ($contato) {
                return [
                    'id' => $contato->id,
                    'name' => $contato->nome . ' ' . $contato->sobrenome,
                    'email' => $contato->email,
                    'phone' => $contato->telefone,
                    'message' => $contato->mensagem,
                    'status' => $contato->status,
                    'date' => $contato->created_at->format('Y-m-d'),
                    'time' => $contato->created_at->format('H:i'),
                    'created_at' => $contato->created_at->toISOString()
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $contatosFormatados
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Envia resposta por email e marca como resolvido
     */
    public function enviarResposta(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contato_id' => 'required|exists:contatos,id',
            'assunto' => 'required|string|max:255',
            'mensagem' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $contato = Contato::findOrFail($request->contato_id);
            
            // Dados do email
            $dadosEmail = [
                'assunto' => $request->assunto,
                'mensagem' => $request->mensagem,
                'nome_cliente' => $contato->nome . ' ' . $contato->sobrenome,
                'email_cliente' => $contato->email
            ];

            // Enviar email (você pode personalizar o template)
            Mail::send('emails.resposta-contato', $dadosEmail, function ($message) use ($contato, $request) {
                $message->to($contato->email, $contato->nome . ' ' . $contato->sobrenome)
                        ->subject($request->assunto)
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            // Marcar como resolvido
            $contato->update(['status' => 'resolvido']);

            return response()->json([
                'success' => true,
                'message' => 'Resposta enviada com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao enviar resposta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualiza o status de um contato
     */
    public function atualizarStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contato_id' => 'required|exists:contatos,id',
            'status' => 'required|in:pendente,resolvido,urgente'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $contato = Contato::findOrFail($request->contato_id);
            $contato->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status atualizado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Busca contatos por termo
     */
    public function buscarContatos(Request $request)
    {
        try {
            $termo = $request->get('termo', '');
            $status = $request->get('status', 'all');

            $query = Contato::query();

            // Filtro por termo de busca
            if (!empty($termo)) {
                $query->where(function ($q) use ($termo) {
                    $q->where('nome', 'like', "%{$termo}%")
                      ->orWhere('sobrenome', 'like', "%{$termo}%")
                      ->orWhere('email', 'like', "%{$termo}%")
                      ->orWhere('telefone', 'like', "%{$termo}%");
                });
            }

            // Filtro por status
            if ($status !== 'all') {
                $query->where('status', $status);
            }

            $contatos = $query->orderBy('created_at', 'desc')->get();
            
            // Formatar dados para o frontend
            $contatosFormatados = $contatos->map(function ($contato) {
                return [
                    'id' => $contato->id,
                    'name' => $contato->nome . ' ' . $contato->sobrenome,
                    'email' => $contato->email,
                    'phone' => $contato->telefone,
                    'message' => $contato->mensagem,
                    'status' => $contato->status,
                    'date' => $contato->created_at->format('Y-m-d'),
                    'time' => $contato->created_at->format('H:i'),
                    'created_at' => $contato->created_at->toISOString()
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $contatosFormatados
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retorna estatísticas dos contatos
     */
    public function getEstatisticas()
    {
        try {
            $total = Contato::count();
            $pendentes = Contato::where('status', 'pendente')->count();
            $resolvidos = Contato::where('status', 'resolvido')->count();
            $urgentes = Contato::where('status', 'urgente')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'total' => $total,
                    'pendentes' => $pendentes,
                    'resolvidos' => $resolvidos,
                    'urgentes' => $urgentes
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar estatísticas: ' . $e->getMessage()
            ], 500);
        }
    }
}

// =============================================================================
// ROTAS - Adicionar no routes/web.php
// =============================================================================

/*
Route::prefix('admin/suporte')->group(function () {
    Route::get('/contatos', [App\Http\Controllers\Administrativo\SuporteContato::class, 'viewContato'])->name('admin.suporte.contatos');
    
    // Rotas AJAX
    Route::get('/api/contatos', [App\Http\Controllers\Administrativo\SuporteContato::class, 'getContatos'])->name('admin.suporte.api.contatos');
    Route::post('/api/resposta', [App\Http\Controllers\Administrativo\SuporteContato::class, 'enviarResposta'])->name('admin.suporte.api.resposta');
    Route::post('/api/status', [App\Http\Controllers\Administrativo\SuporteContato::class, 'atualizarStatus'])->name('admin.suporte.api.status');
    Route::get('/api/buscar', [App\Http\Controllers\Administrativo\SuporteContato::class, 'buscarContatos'])->name('admin.suporte.api.buscar');
    Route::get('/api/estatisticas', [App\Http\Controllers\Administrativo\SuporteContato::class, 'getEstatisticas'])->name('admin.suporte.api.estatisticas');
});
*/

// =============================================================================
// TEMPLATE DE EMAIL - resources/views/emails/resposta-contato.blade.php
// =============================================================================

/*
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resposta do Suporte</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #667eea; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .footer { padding: 20px; text-align: center; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Resposta do Suporte</h1>
        </div>
        <div class="content">
            <p>Olá {{ $nome_cliente }},</p>
            <p>{{ $mensagem }}</p>
            <p>Atenciosamente,<br>Equipe de Suporte</p>
        </div>
        <div class="footer">
            <p>Este é um email automático, não responda a esta mensagem.</p>
        </div>
    </div>
</body>
</html>
*/