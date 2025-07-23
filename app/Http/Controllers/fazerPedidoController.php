<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;
use App\Marca;
use App\Endereco;
use App\ItemCarrinho;
use App\Pedido;
use App\Carrinho;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class fazerPedidoController extends Controller
{
    private $produtos;
    private $categorias;
    private $marcas;
    private $enderecos;
    private $preco_total = 0;
    private $itens;
    private $user_id;

    public function __construct()
    {
        $this->produtos = Produto::all();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
    }
    public function index()
    {
        $this->enderecos = Endereco::where('user_id', auth()->id())->get();
        $enderecos = $this->enderecos;
        $itens = $this->queryBuilderItensCarrinho();
        $preco_total = $this->preco_total;
        foreach ($itens as $item) {
            $preco_total += $item->preco_total;
        }
        $contador = 0;
        foreach ($itens as $item) {
            $contador += 1;
        }
        return view('site.fazerPedido', compact('enderecos', 'itens', 'preco_total', 'contador'));
    }

    public function queryBuilderItensCarrinho()
    {
        $itens = DB::table('item_carrinhos')->join('carrinhos', 'item_carrinhos.carrinho_id', '=', 'carrinhos.id')->join('produtos', 'item_carrinhos.produto_id', '=', 'produtos.id')->leftJoin('fotos', 'produtos.id', '=', 'fotos.produto_id')->where('carrinhos.user_id', auth()->id())->where('carrinhos.status', 'ativo')->select('item_carrinhos.*', 'produtos.nome as produto_nome', 'produtos.valor as produto_valor', 'fotos.url_imagem as produto_imagem')->get();
        // Agrupa para evitar duplicatas
        return $itens;
    }

    public function finalizarCarrinho(Request $request)
    {

        try {
            $user_id = auth()->id();
            if (!$user_id) {
                throw new \Exception('Usuário não autenticado.');
                exit;
            }

            $data = $request->all();
            $validator = $this->validateInput($data);
            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $preco_total = 0;
            $itens = $this->queryBuilderItensCarrinho();
            foreach ($itens as $item) {
                $preco_total += $item->preco_total;
            }
            // Pega o primeiro item do carrinho 
            $carrinho_id = 0;
            for ($i = 0; $i < 1; $i++){
                if(isset($item->carrinho_id)){
                    $carrinho_id = $item->carrinho_id;
                }
            }

            // Atualiza o status do carrinho
            $verifica = Carrinho::where('id', $carrinho_id)->update(['status' => 'finalizado']);
            $carrinho = Carrinho::where('id', $carrinho_id)->first();
            if (!$verifica) {
                Alert::error('Erro', 'Erro ao finalizar carrinho');
                return back()->withErrors('Erro ao finalizar carrinho');
            }

            // verifica se o produto existe
            Pedido::create([
                'user_id' => $user_id,
                'total' => $preco_total,
                'endereco_id' => $data['endereco_id'],
                'status' => 'aguardando'
            ]);

            Alert::success('Pedido', 'Pedido realizado com Sucesso');
            return redirect()->route('site.principal');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function validateInput($request)
    {
        $validator = Validator::make($request, [
            'endereco_id' => 'required|numeric|exists:enderecos,id',
        ], [
            'endereco_id.required' => 'Selecione pelo menos um endereço',
            'endereco_id.numeric' => 'O campo endereco deve ser numérico',
            'endereco_id.exists' => 'O campo endereco não existe',
        ]);

        return $validator;
    }
}
