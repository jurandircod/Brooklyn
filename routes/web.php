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

Route::prefix('administrativo')->middleware(['auth'])->group(function () {
    // Rota principal com suporte a paginação
    Route::get('/produtos', [ProdutosController::class, 'index'])
        ->name('administrativo.produtos');

    // API para DataTables (AJAX)
    Route::get('/produtos/api', [ProdutosController::class, 'filterProducts'])
        ->name('administrativo.produtos.api');

    // Busca rápida (autocomplete)
    Route::get('/produtos/buscar', [ProdutosController::class, 'searchProducts'])
        ->name('administrativo.produtos.buscar');

    // Exportação
    Route::get('/produtos/exportar', [ProdutosController::class, 'export'])
        ->name('administrativo.produtos.exportar');

    // Rotas existentes mantidas
    Route::post('/produto/salvar', [ProdutosController::class, 'create'])
        ->name('administrativo.produto.salvar');

    Route::post('/produto/atualizar', [ProdutosController::class, 'edit'])
        ->name('administrativo.produto.atualizar');

    Route::delete('/produto/excluir/{id}', [ProdutosController::class, 'destroy'])
        ->name('administrativo.produto.excluir');
});

// Exemplo de rotas RESTful alternativas (opcional)
Route::prefix('admin')->middleware(['auth'])->group(function () {
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
    Route::get('produtos/{id}/duplicate', [ProdutosController::class, 'duplicate'])
        ->name('admin.produtos.duplicate');

    Route::patch('produtos/{id}/toggle-status', [ProdutosController::class, 'toggleStatus'])
        ->name('admin.produtos.toggle-status');
});

// Rotas públicas
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register/salvar', [RegisterController::class, 'register'])->name('registerSalvar');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::get('/principal', 'PrincipalController@principal')->name('site.principal');
Route::middleware('auth')->get('/', 'PrincipalController@principal')->name('site.principal');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::get('/sobre', 'SobreNosController@sobre')->name('site.sobre');
Route::get('/cep/{cep}', 'AddressController@getCityByCep');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato.salvar');
Route::get('/fazerPedido', 'fazerPedidoController@index')->name('site.fazerPedido')->middleware('auth');

// Rotas de redefinição de senha
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

Route::group(['prefix' => 'pesquisa'], function () {
    Route::get('/pesquisa', 'ShopController@index')->name('site.shop');
    Route::post('/filter', 'ShopController@filtrar')->name('site.pesquisa.filtrar');
    Route::post('/pesquisa', 'ShopController@index')->name('site.shop');
});

// Rotas relacionadas ao produto
Route::post('/produto/avaliacao', [AvaliacaoController::class, 'avaliar'])->name('site.produto.avaliacao');
// Rotas relacionadas ao perfil
Route::get('/exibirEndereco', [PerfilController::class, 'exibirEndereco'])->name('site.perfil.exibirEndereco');
Route::group(['prefix' => 'perfil'], function () {
    Route::get('/', 'perfilController@index')->name('site.perfil');
    Route::get('/{id}', 'PerfilController@index')->name('site.perfil.enviaParaformEnderecos');
    Route::post('/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
    Route::get('/remover/{id}', 'AddressController@remover')->name('site.perfil.removerEndereco');
    Route::post('/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
});

Route::post('/payments/pix', [PaymentController::class, 'createPixPayment']);
//rotas carrinho
Route::group(['prefix' => 'carrinho'], function () {
    Route::get('/principal', 'CarrinhoController@index')->name('site.carrinho');
    Route::group(['prefix' => 'itemCarrinho'], function () {
        Route::post('/adicionar', [ItemCarrinhoController::class, 'adicionar'])->name('site.carrinho.itemCarrinho.adicionar');
        Route::post('/remover/{id}', 'CarrinhoController@remover')->name('site.carrinho.remover');
        Route::post('/atualizar-quantidade', [ItemCarrinhoController::class, 'atualizarQuantidade'])->name('carrinho.atualizar-quantidade');
        Route::post('/remover-item', [ItemCarrinhoController::class, 'removerItem'])->name('carrinho.remover-item');
        Route::get('/quantidade', [ItemCarrinhoController::class, 'quantidadeItensCarrinho'])->name('site.carrinho.quantidadeItensCarrinho');
        Route::get('limpaCarrinho', [ItemCarrinhoController::class, 'limpaCarrinho'])->name('site.carrinho.limpaCarrinho');
    });
    Route::post('/finalizarCarrinho', [FazerPedidoController::class, 'finalizarCarrinho'])->name('site.carrinho.finalizarCarrinho');
});

// rotas produto
Route::group(['prefix' => 'produto'], function () {
    Route::get('/{id}', 'ProdutoController@index')->name('site.produto');
    Route::post('/avaliacao', 'AvaliacaoController@CreateAvaliacao')->name('site.produto.avaliacao');
});

// Rotas do administrador
Route::group(['prefix' => 'administrativo', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [PrincipalController::class, 'index'])->name('administrativo.principal');

    // Rotas de vendas
    Route::get('/vendas', [VendasController::class, 'index'])->name('administrativo.vendas');
    Route::get('/tabelas', 'TabelasControllers@index')->name('administrativo.tabelas');

    //rotas de permissoes
    Route::group(['prefix' => 'permissoes', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/', [PermissoesController::class, 'index'])->name('administrativo.permissoes');
        Route::get('/usuario', [PermissoesController::class, 'permissoesUsuarios'])->name('administrativo.permissoes.usuarios');
        Route::post('/salvarPermissao', [PermissoesController::class, 'salvar'])->name('administrativo.permissao.salvar');
        Route::post('/removerPermissao', [PermissoesController::class, 'remover'])->name('administrativo.permissao.remover');
        Route::post('/enviarPermissao', [PermissoesController::class, 'editar'])->name('administrativo.permissao.editar');
        Route::post('/enviarPermissao/usuario', [User::class, 'enviarPermissao'])->name('administrativo.enviarPermissao.usuario');
        Route::post('/editarPermissao/usuario', [PermissoesController::class, 'editarUsuarioPermissao'])->name('administrativo.permissao.editar.usuario');
    });

    // Rotas de produtos
    Route::group(['prefix' => 'produtos'], function () {
        Route::get('/', [ProdutosController::class, 'index'])->name('administrativo.produtos');

        // NOVA ROTA: Para buscar dados do produto via AJAX
        Route::get('/{id}/dados', [ProdutosController::class, 'obterDadosProduto'])->name('administrativo.produto.dados');

        // Rotas existentes mantidas
        Route::get('/categoria', [CategoriaController::class, 'index'])->name('administrativo.produto.categoria');
        Route::post('/salvar/categoria', [CategoriaController::class, 'salvarCategoria'])->name('administrativo.produto.categoria.salvar');
        Route::post('/enviaFormAlterar/categoria', [CategoriaController::class, 'enviaFormAlterar'])->name('administrativo.produto.categoria.enviaFormAlterar');
        Route::post('/alterar/categoria', [CategoriaController::class, 'alterarCategoria'])->name('administrativo.produto.categoria.alterar');
        Route::post('/excluir/categoria', [CategoriaController::class, 'excluirCategoria'])->name('administrativo.produto.categoria.excluir');
        Route::post('/salvar', [ProdutosController::class, 'salvarProduto'])->name('administrativo.produto.salvar');
        Route::post('/enviaFormAlterar', [ProdutosController::class, 'atualizar'])->name('administrativo.produto.atualizar');
        Route::get('/administrativo/produtos/{id}/dados', [ProdutosController::class, 'obterDadosProduto'])
            ->name('administrativo.produto.dados')->middleware(['auth', 'admin']);
    });

    // Rotas de marcas
    Route::group(['prefix' => 'marca'], function () {
        Route::get('/', [MarcaController::class, 'index'])->name('administrativo.marca');
        Route::post('/alterar', [MarcaController::class, 'marcaAlterar'])->name('administrativo.marca.alterar');
        Route::post('/enviarForm', [MarcaController::class, 'marcaEnviarForm'])->name('administrativo.marca.enviarForm');
        Route::post('/salvar', [MarcaController::class, 'marcaSalvar'])->name('administrativo.marca.salvar');
        Route::post('/excluir', [MarcaController::class, 'marcaExcluir'])->name('administrativo.marca.excluir');
    });

    // Rotas de suporte
    // Grupo de rotas administrativas com middleware de autenticação
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

        // Rota para exibir a view do dashboard de suporte
        Route::get('/suporte/contatos', [SuporteContato::class, 'viewContato'])
            ->name('admin.suporte.contatos');

        // API Routes para AJAX (mantendo os nomes originais para compatibilidade)
        Route::group(['prefix' => 'suporte/api'], function () {

            // Rota principal para buscar contatos (agora com paginação)
            Route::get('/contatos', [SuporteContato::class, 'getContatos'])
                ->name('admin.suporte.api.contatos');

            // Rota para buscar contatos (mantida para compatibilidade - redireciona para getContatos)
            Route::get('/buscar', [SuporteContato::class, 'buscarContatos'])
                ->name('admin.suporte.api.buscar');

            // Rota para enviar resposta
            Route::post('/resposta', [SuporteContato::class, 'enviarResposta'])
                ->name('admin.suporte.api.resposta');

            // Rota para atualizar status
            Route::post('/status', [SuporteContato::class, 'atualizarStatus'])
                ->name('admin.suporte.api.status');

            // Rota para estatísticas
            Route::get('/estatisticas', [SuporteContato::class, 'getEstatisticas'])
                ->name('admin.suporte.api.estatisticas');

            // NOVAS ROTAS OPCIONAIS (podem ser implementadas conforme necessidade)

            // Rota para exportar contatos
            Route::get('/exportar', [SuporteContato::class, 'exportarContatos'])
                ->name('admin.suporte.api.exportar');

            // Rota para atualizar múltiplos contatos
            Route::post('/status-multiplos', [SuporteContato::class, 'marcarMultiplosStatus'])
                ->name('admin.suporte.api.status-multiplos');

            // Rota para obter detalhes de um contato específico
            Route::get('/contato/{id}', [SuporteContato::class, 'getContato'])
                ->name('admin.suporte.api.contato');
        });
    });
});





// Autenticação
Auth::routes(['reset' => true]);
Auth::routes(['verify' => true]);

// Rota de fallback
Route::fallback(function () {
    return view('errors.404');
});
