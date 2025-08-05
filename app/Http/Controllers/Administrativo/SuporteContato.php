<?php
// Controller: App\Http\Controllers\Administrativo\SuporteContato.php

namespace App\Http\Controllers\Administrativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\model\{Contato};

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
     * Retorna todos os contatos via AJAX com paginação
     */
    public function getContatos(Request $request)
    {
        try {
            // Parâmetros de paginação
            $page = $request->get('page', 1);
            $perPage = $request->get('per_page', 20);
            $search = $request->get('search', '');
            $status = $request->get('status', '');

            $query = Contato::query();

            // Filtro por termo de busca
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('nome', 'like', "%{$search}%")
                      ->orWhere('sobrenome', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('telefone', 'like', "%{$search}%")
                      ->orWhere('mensagem', 'like', "%{$search}%");
                });
            }

            // Filtro por status
            if (!empty($status) && $status !== 'all') {
                $query->where('status', $status);
            }

            // Ordenação e paginação
            $contatos = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
            
            // Formatar dados para o frontend
            $contatosFormatados = $contatos->map(function ($contato) {
                return [
                    'id' => $contato->id,
                    'name' => $contato->nome . ' ' . $contato->sobrenome,
                    'email' => $contato->email,
                    'phone' => $contato->telefone,
                    'message' => $contato->mensagem,
                    'status' => $contato->status,
                    'date' => $contato->created_at->format('d/m/Y'),
                    'time' => $contato->created_at->format('H:i'),
                    'created_at' => $contato->created_at->toISOString()
                ];
            });

            return response()->json([
                'success' => true,
                'data' => [
                    'data' => $contatosFormatados,
                    'current_page' => $contatos->currentPage(),
                    'last_page' => $contatos->lastPage(),
                    'per_page' => $contatos->perPage(),
                    'total' => $contatos->total(),
                    'from' => $contatos->firstItem(),
                    'to' => $contatos->lastItem(),
                    'prev_page_url' => $contatos->previousPageUrl(),
                    'next_page_url' => $contatos->nextPageUrl()
                ]
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
     * Busca contatos por termo (MANTIDO PARA COMPATIBILIDADE)
     * Esta função agora redireciona para getContatos() com os parâmetros adequados
     */
    public function buscarContatos(Request $request)
    {
        // Redirecionar para getContatos() que já tem a funcionalidade de busca
        return $this->getContatos($request);
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

    /**
     * Função auxiliar para exportar contatos (NOVA FUNCIONALIDADE OPCIONAL)
     */
    public function exportarContatos(Request $request)
    {
        try {
            $status = $request->get('status', '');
            $formato = $request->get('formato', 'csv');

            $query = Contato::query();

            // Filtro por status se especificado
            if (!empty($status) && $status !== 'all') {
                $query->where('status', $status);
            }

            $contatos = $query->orderBy('created_at', 'desc')->get();

            if ($formato === 'csv') {
                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="contatos_' . date('Y-m-d_H-i-s') . '.csv"',
                ];

                $callback = function() use ($contatos) {
                    $file = fopen('php://output', 'w');
                    
                    // Cabeçalhos CSV
                    fputcsv($file, ['ID', 'Nome', 'Email', 'Telefone', 'Status', 'Mensagem', 'Data de Criação']);
                    
                    // Dados
                    foreach ($contatos as $contato) {
                        fputcsv($file, [
                            $contato->id,
                            $contato->nome . ' ' . $contato->sobrenome,
                            $contato->email,
                            $contato->telefone,
                            $contato->status,
                            $contato->mensagem,
                            $contato->created_at->format('d/m/Y H:i:s')
                        ]);
                    }
                    
                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
            }

            return response()->json([
                'success' => false,
                'message' => 'Formato de exportação não suportado'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao exportar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Função para marcar múltiplos contatos como lidos (NOVA FUNCIONALIDADE OPCIONAL)
     */
    public function marcarMultiplosStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contato_ids' => 'required|array',
            'contato_ids.*' => 'exists:contatos,id',
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
            $atualizados = Contato::whereIn('id', $request->contato_ids)
                                 ->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => "{$atualizados} contato(s) atualizado(s) com sucesso!"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar contatos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Função para obter detalhes de um contato específico (NOVA FUNCIONALIDADE OPCIONAL)
     */
    public function getContato(Request $request, $id)
    {
        try {
            $contato = Contato::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $contato->id,
                    'name' => $contato->nome . ' ' . $contato->sobrenome,
                    'email' => $contato->email,
                    'phone' => $contato->telefone,
                    'message' => $contato->mensagem,
                    'status' => $contato->status,
                    'date' => $contato->created_at->format('d/m/Y'),
                    'time' => $contato->created_at->format('H:i'),
                    'created_at' => $contato->created_at->toISOString(),
                    'updated_at' => $contato->updated_at->toISOString()
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Contato não encontrado'
            ], 404);
        }
    }
}