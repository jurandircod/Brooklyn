<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Administrativo\SuporteContato;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Controllers\{AvaliacaoController, PerfilController, User, ItemCarrinhoController, FazerPedidoController};
use App\Http\Controllers\Administrativo\{PrincipalController, VendasController, TabelasControllers, PermissoesController, ProdutosController, CategoriaController, MarcaController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ==========================================
// ROTAS PÚBLICAS (SEM AUTENTICAÇÃO)
// ==========================================
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register/salvar', [RegisterController::class, 'register'])->name('registerSalvar');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

// Autenticação
Auth::routes(['reset' => true]);
Auth::routes(['verify' => true]);

// ==========================================
// ROTAS COM AUTENTICAÇÃO E VERIFICAÇÃO
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // ==========================================
    // ROTAS GERAIS DO SITE
    // ==========================================
    Route::get('/principal', 'PrincipalController@principal')->name('site.principal');
    Route::get('/', 'PrincipalController@principal')->name('site.principal');
    Route::get('/contato', 'ContatoController@contato')->name('site.contato');
    Route::get('/sobre', 'SobreNosController@sobre')->name('site.sobre');
    Route::get('/cep/{cep}', 'AddressController@getCityByCep');
    Route::post('/contato', 'ContatoController@salvar')->name('site.contato.salvar');
    Route::get('/fazerPedido', 'fazerPedidoController@index')->name('site.fazerPedido');

    // ==========================================
    // ROTAS DE REDEFINIÇÃO DE SENHA
    // ==========================================
    Route::prefix('site')->group(function () {
        // Verificar email
        Route::get('/email/verificar', [User::class, 'verificarEmail'])->name('site.email.verificar');
        // Mostrar formulário de reset (quando chega pelo email)
        Route::get('resetar-senha/{token}', 'PasswordResetController@showResetForm')
            ->name('site.password.reset');
        // Processar o reset
        Route::post('resetar-senha', 'PasswordResetController@reset')
            ->name('site.password.update');
    });

    // ==========================================
    // ROTAS DE PESQUISA
    // ==========================================
    Route::prefix('pesquisa')->group(function () {
        Route::get('/pesquisa', 'ShopController@index')->name('site.shop');
        Route::post('/filter', 'ShopController@filtrar')->name('site.pesquisa.filtrar');
        Route::post('/pesquisa', 'ShopController@index')->name('site.shop');
    });

    // ==========================================
    // ROTAS DE PRODUTO
    // ==========================================
    Route::prefix('produto')->group(function () {
        Route::get('/{id}', 'ProdutoController@index')->name('site.produto');
        Route::post('/avaliacao', 'AvaliacaoController@CreateAvaliacao')->name('site.produto.avaliacao');
    });

    // ==========================================
    // ROTAS DE PERFIL
    // ==========================================
    Route::get('/exibirEndereco', [PerfilController::class, 'exibirEndereco'])->name('site.perfil.exibirEndereco');
    Route::prefix('perfil')->group(function () {
        Route::get('/', 'perfilController@index')->name('site.perfil');
        Route::get('/{id}', 'PerfilController@index')->name('site.perfil.enviaParaformEnderecos');
        Route::post('/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
        Route::get('/remover/{id}', 'AddressController@remover')->name('site.perfil.removerEndereco');
        Route::post('/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
    });

    // ==========================================
    // ROTAS DE PAGAMENTO
    // ==========================================
    Route::post('/payments/pix', [PaymentController::class, 'createPixPayment']);

    // ==========================================
    // ROTAS DO CARRINHO
    // ==========================================
    Route::prefix('carrinho')->group(function () {
        Route::get('/principal', 'CarrinhoController@index')->name('site.carrinho');
        
        Route::prefix('itemCarrinho')->group(function () {
            Route::post('/adicionar', [ItemCarrinhoController::class, 'adicionar'])->name('site.carrinho.itemCarrinho.adicionar');
            Route::post('/remover/{id}', 'CarrinhoController@remover')->name('site.carrinho.remover');
            Route::post('/atualizar-quantidade', [ItemCarrinhoController::class, 'atualizarQuantidade'])->name('carrinho.atualizar-quantidade');
            Route::post('/remover-item', [ItemCarrinhoController::class, 'removerItem'])->name('carrinho.remover-item');
            Route::get('/quantidade', [ItemCarrinhoController::class, 'quantidadeItensCarrinho'])->name('site.carrinho.quantidadeItensCarrinho');
            Route::get('limpaCarrinho', [ItemCarrinhoController::class, 'limpaCarrinho'])->name('site.carrinho.limpaCarrinho');
        });
        
        Route::post('/finalizarCarrinho', [FazerPedidoController::class, 'finalizarCarrinho'])->name('site.carrinho.finalizarCarrinho');
    });

    // ==========================================
    // ÁREA ADMINISTRATIVA
    // ==========================================
    Route::prefix('administrativo')->middleware(['admin'])->group(function () {
        
        // Dashboard Principal
        Route::get('/', [PrincipalController::class, 'index'])->name('administrativo.principal');
        
        // ==========================================
        // VENDAS
        // ==========================================
        Route::get('/vendas', [VendasController::class, 'index'])->name('administrativo.vendas');
        Route::get('/tabelas', 'TabelasControllers@index')->name('administrativo.tabelas');

        // ==========================================
        // PERMISSÕES
        // ==========================================
        Route::prefix('permissoes')->group(function () {
            Route::get('/', [PermissoesController::class, 'index'])->name('administrativo.permissoes');
            Route::get('/usuario', [PermissoesController::class, 'permissoesUsuarios'])->name('administrativo.permissoes.usuarios');
            Route::post('/salvarPermissao', [PermissoesController::class, 'salvar'])->name('administrativo.permissao.salvar');
            Route::post('/removerPermissao', [PermissoesController::class, 'remover'])->name('administrativo.permissao.remover');
            Route::post('/enviarPermissao', [PermissoesController::class, 'editar'])->name('administrativo.permissao.editar');
            Route::post('/enviarPermissao/usuario', [User::class, 'enviarPermissao'])->name('administrativo.enviarPermissao.usuario');
            Route::post('/editarPermissao/usuario', [PermissoesController::class, 'editarUsuarioPermissao'])->name('administrativo.permissao.editar.usuario');
        });

        // ==========================================
        // PRODUTOS (Primeira Estrutura)
        // ==========================================
        // Rota principal com suporte a paginação
        Route::get('/produtos', [ProdutosController::class, 'index'])->name('administrativo.produtos');
        
        // API para DataTables (AJAX)
        Route::get('/produtos/api', [ProdutosController::class, 'filterProducts'])->name('administrativo.produtos.api');
        
        // Busca rápida (autocomplete)
        Route::get('/produtos/buscar', [ProdutosController::class, 'searchProducts'])->name('administrativo.produtos.buscar');
        
        // Exportação
        Route::get('/produtos/exportar', [ProdutosController::class, 'export'])->name('administrativo.produtos.exportar');
        
        // CRUD Básico
        Route::post('/produto/salvar', [ProdutosController::class, 'create'])->name('administrativo.produto.salvar');
        Route::post('/produto/atualizar', [ProdutosController::class, 'edit'])->name('administrativo.produto.atualizar');
        Route::delete('/produto/excluir/{id}', [ProdutosController::class, 'destroy'])->name('administrativo.produto.excluir');

        // ==========================================
        // PRODUTOS (Estrutura Detalhada)
        // ==========================================
        Route::prefix('produtos')->group(function () {
            Route::get('/', [ProdutosController::class, 'index'])->name('administrativo.produtos');
            
            // AJAX - Buscar dados do produto
            Route::get('/{id}/dados', [ProdutosController::class, 'obterDadosProduto'])->name('administrativo.produto.dados');
            
            // Categorias
            Route::get('/categoria', [CategoriaController::class, 'index'])->name('administrativo.produto.categoria');
            Route::post('/salvar/categoria', [CategoriaController::class, 'salvarCategoria'])->name('administrativo.produto.categoria.salvar');
            Route::post('/enviaFormAlterar/categoria', [CategoriaController::class, 'enviaFormAlterar'])->name('administrativo.produto.categoria.enviaFormAlterar');
            Route::post('/alterar/categoria', [CategoriaController::class, 'alterarCategoria'])->name('administrativo.produto.categoria.alterar');
            Route::post('/excluir/categoria', [CategoriaController::class, 'excluirCategoria'])->name('administrativo.produto.categoria.excluir');
            
            // Rota duplicada (mantida conforme solicitado)
            Route::get('/administrativo/produtos/{id}/dados', [ProdutosController::class, 'obterDadosProduto'])
                ->name('administrativo.produto.dados');
        });

        // ==========================================
        // MARCAS
        // ==========================================
        Route::prefix('marca')->group(function () {
            Route::get('/', [MarcaController::class, 'index'])->name('administrativo.marca');
            Route::post('/alterar', [MarcaController::class, 'marcaAlterar'])->name('administrativo.marca.alterar');
            Route::post('/enviarForm', [MarcaController::class, 'marcaEnviarForm'])->name('administrativo.marca.enviarForm');
            Route::post('/salvar', [MarcaController::class, 'marcaSalvar'])->name('administrativo.marca.salvar');
            Route::post('/excluir', [MarcaController::class, 'marcaExcluir'])->name('administrativo.marca.excluir');
        });
    });

    // ==========================================
    // PRODUTOS RESTFUL (Estrutura Alternativa)
    // ==========================================
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::resource('produtos', ProdutosController::class, [
            'names' => [
                'index' => 'admin.produtos.index',
                'create' => 'admin.produtos.create',
                'store' => 'admin.produtos.store',
                'show' => 'admin.produtos.show',
                'edit' => 'admin.produtos.edit',
                'update' => 'admin.produtos.update',
                'destroy' => 'admin.produtos.destroy'
            ]
        ]);

        // Rotas customizadas adicionais
        Route::get('produtos/{id}/duplicate', [ProdutosController::class, 'duplicate'])->name('admin.produtos.duplicate');
        Route::patch('produtos/{id}/toggle-status', [ProdutosController::class, 'toggleStatus'])->name('admin.produtos.toggle-status');

        // ==========================================
        // SUPORTE/CONTATOS
        // ==========================================
        // Rota para exibir a view do dashboard de suporte
        Route::get('/suporte/contatos', [SuporteContato::class, 'viewContato'])->name('admin.suporte.contatos');

        // API Routes para AJAX
        Route::prefix('suporte/api')->group(function () {
            // Rota principal para buscar contatos (agora com paginação)
            Route::get('/contatos', [SuporteContato::class, 'getContatos'])->name('admin.suporte.api.contatos');
            
            // Rota para buscar contatos (mantida para compatibilidade)
            Route::get('/buscar', [SuporteContato::class, 'buscarContatos'])->name('admin.suporte.api.buscar');
            
            // Rota para enviar resposta
            Route::post('/resposta', [SuporteContato::class, 'enviarResposta'])->name('admin.suporte.api.resposta');
            
            // Rota para atualizar status
            Route::post('/status', [SuporteContato::class, 'atualizarStatus'])->name('admin.suporte.api.status');
            
            // Rota para estatísticas
            Route::get('/estatisticas', [SuporteContato::class, 'getEstatisticas'])->name('admin.suporte.api.estatisticas');
            
            // Rotas opcionais
            Route::get('/exportar', [SuporteContato::class, 'exportarContatos'])->name('admin.suporte.api.exportar');
            Route::post('/status-multiplos', [SuporteContato::class, 'marcarMultiplosStatus'])->name('admin.suporte.api.status-multiplos');
            Route::get('/contato/{id}', [SuporteContato::class, 'getContato'])->name('admin.suporte.api.contato');
        });
    });
});

// ==========================================
// ROTA DE FALLBACK
// ==========================================
Route::fallback(function () {
    return view('errors.404');
});