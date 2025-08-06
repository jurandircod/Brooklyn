<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Administrativo\SuporteContato;


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

// Rotas públicas
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register/salvar', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('registerSalvar');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
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
    Route::get('/email/verificar', [App\Http\Controllers\User::class, 'verificarEmail'])->name('site.email.verificar');
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
Route::post('/produto/avaliacao', [App\Http\Controllers\AvaliacaoController::class, 'avaliar'])->name('site.produto.avaliacao');
// Rotas relacionadas ao perfil
Route::get('/exibirEndereco', [App\Http\Controllers\PerfilController::class, 'exibirEndereco'])->name('site.perfil.exibirEndereco');
Route::group(['prefix' => 'perfil'], function () {
    Route::get('/', 'perfilController@index')->name('site.perfil');
    Route::get('/{id}', 'AddressController@enviaParaformEnderecos')->name('site.perfil.enviaParaformEnderecos');
    Route::post('/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
    Route::get('/remover/{id}', 'AddressController@remover')->name('site.perfil.removerEndereco');
    Route::post('/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
});

//rotas carrinho
Route::group(['prefix' => 'carrinho'], function () {
    Route::get('/principal', 'CarrinhoController@index')->name('site.carrinho');
    Route::group(['prefix' => 'itemCarrinho'], function () {
        Route::post('/adicionar', [App\Http\Controllers\ItemCarrinhoController::class, 'adicionar'])->name('site.carrinho.itemCarrinho.adicionar');
        Route::post('/remover/{id}', 'CarrinhoController@remover')->name('site.carrinho.remover');
        Route::post('/atualizar-quantidade', [App\Http\Controllers\ItemCarrinhoController::class, 'atualizarQuantidade'])->name('carrinho.atualizar-quantidade');
        Route::post('/remover-item', [App\Http\Controllers\ItemCarrinhoController::class, 'removerItem'])->name('carrinho.remover-item');
        Route::get('/quantidade', [App\Http\Controllers\ItemCarrinhoController::class, 'quantidadeItensCarrinho'])->name('site.carrinho.quantidadeItensCarrinho');
    });
    Route::post('/finalizarCarrinho', [App\Http\Controllers\fazerPedidoController::class, 'finalizarCarrinho'])->name('site.carrinho.finalizarCarrinho');
});

// rotas produto
Route::group(['prefix' => 'produto'], function () {
    Route::get('/{id}', 'ProdutoController@index')->name('site.produto');
    Route::post('/avaliacao', 'AvaliacaoController@CreateAvaliacao')->name('site.produto.avaliacao');
});

// Rotas do administrador
Route::group(['prefix' => 'administrativo', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\Administrativo\PrincipalController::class, 'index'])->name('administrativo.principal');

    // Rotas de vendas
    Route::get('/vendas', [App\Http\Controllers\Administrativo\VendasController::class, 'index'])->name('administrativo.vendas');
    Route::get('/tabelas', 'TabelasControllers@index')->name('administrativo.tabelas');

    //rotas de permissoes
    Route::group(['prefix' => 'permissoes', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/', [App\Http\Controllers\Administrativo\PermissoesController::class, 'permissoes'])->name('administrativo.permissoes');
        Route::get('/usuario', [App\Http\Controllers\Administrativo\PermissoesController::class, 'permissoesUsuarios'])->name('administrativo.permissoes.usuarios');
        Route::post('/salvarPermissao', [App\Http\Controllers\Administrativo\PermissoesController::class, 'salvarPermissao'])->name('administrativo.salvarPermissao');
        Route::post('/removerPermissao', [App\Http\Controllers\Administrativo\PermissoesController::class, 'removerPermissao'])->name('administrativo.removerPermissao');
        Route::post('/enviarPermissao', [App\Http\Controllers\Administrativo\PermissoesController::class, 'enviarPermissao'])->name('administrativo.enviarPermissao');
        Route::post('/editarPermissao', [App\Http\Controllers\Administrativo\PermissoesController::class, 'editarPermissao'])->name('administrativo.editarPermissao');
        Route::post('/enviarPermissao/usuario', [App\Http\Controllers\user::class, 'enviarPermissao'])->name('administrativo.enviarPermissao.usuario');
        Route::post('/editarPermissao/usuario', [App\Http\Controllers\Administrativo\PermissoesController::class, 'editarUsuarioPermissao'])->name('administrativo.editarPermissao.usuario');
    });

    // Rotas de produtos
    Route::group(['prefix' => 'produtos'], function () {
        Route::get('/', [App\Http\Controllers\Administrativo\ProdutosController::class, 'index'])->name('administrativo.produtos');
        Route::get('/categoria', [App\Http\Controllers\Administrativo\CategoriaController::class, 'index'])->name('administrativo.produto.categoria');
        Route::post('/salvar/categoria', [App\Http\Controllers\Administrativo\CategoriaController::class, 'salvarCategoria'])->name('administrativo.produto.categoria.salvar');
        Route::post('/enviaFormAlterar/categoria', [App\Http\Controllers\Administrativo\CategoriaController::class, 'enviaFormAlterar'])->name('administrativo.produto.categoria.enviaFormAlterar');
        Route::post('/alterar/categoria', [App\Http\Controllers\Administrativo\CategoriaController::class, 'alterarCategoria'])->name('administrativo.produto.categoria.alterar');
        Route::post('/excluir/categoria', [App\Http\Controllers\Administrativo\CategoriaController::class, 'excluirCategoria'])->name('administrativo.produto.categoria.excluir');
        Route::post('/salvar', [App\Http\Controllers\Administrativo\ProdutosController::class, 'salvarProduto'])->name('administrativo.produto.salvar');
        Route::post('/enviaFormAlterar', [App\Http\Controllers\Administrativo\ProdutosController::class, 'atualizar'])->name('administrativo.produto.atualizar');
        Route::post('/excluir', [App\Http\Controllers\Administrativo\ProdutosController::class, 'excluir'])->name('administrativo.produto.excluir');
    });

    // Rotas de marcas
    Route::group(['prefix' => 'marca'], function () {
        Route::get('/', [App\Http\Controllers\Administrativo\MarcaController::class, 'index'])->name('administrativo.marca');
        Route::post('/alterar', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaAlterar'])->name('administrativo.marca.alterar');
        Route::post('/enviarForm', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaEnviarForm'])->name('administrativo.marca.enviarForm');
        Route::post('/salvar', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaSalvar'])->name('administrativo.marca.salvar');
        Route::post('/excluir', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaExcluir'])->name('administrativo.marca.excluir');
    });

    // Rotas de suporte
    // Grupo de rotas administrativas com middleware de autenticação
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

        // Rota para exibir a view do dashboard de suporte
        Route::get('/suporte/contatos', [App\Http\Controllers\Administrativo\SuporteContato::class, 'viewContato'])
            ->name('admin.suporte.contatos');

        // API Routes para AJAX (mantendo os nomes originais para compatibilidade)
        Route::group(['prefix' => 'suporte/api'], function () {

            // Rota principal para buscar contatos (agora com paginação)
            Route::get('/contatos', [App\Http\Controllers\Administrativo\SuporteContato::class, 'getContatos'])
                ->name('admin.suporte.api.contatos');

            // Rota para buscar contatos (mantida para compatibilidade - redireciona para getContatos)
            Route::get('/buscar', [App\Http\Controllers\Administrativo\SuporteContato::class, 'buscarContatos'])
                ->name('admin.suporte.api.buscar');

            // Rota para enviar resposta
            Route::post('/resposta', [App\Http\Controllers\Administrativo\SuporteContato::class, 'enviarResposta'])
                ->name('admin.suporte.api.resposta');

            // Rota para atualizar status
            Route::post('/status', [App\Http\Controllers\Administrativo\SuporteContato::class, 'atualizarStatus'])
                ->name('admin.suporte.api.status');

            // Rota para estatísticas
            Route::get('/estatisticas', [App\Http\Controllers\Administrativo\SuporteContato::class, 'getEstatisticas'])
                ->name('admin.suporte.api.estatisticas');

            // NOVAS ROTAS OPCIONAIS (podem ser implementadas conforme necessidade)

            // Rota para exportar contatos
            Route::get('/exportar', [App\Http\Controllers\Administrativo\SuporteContato::class, 'exportarContatos'])
                ->name('admin.suporte.api.exportar');

            // Rota para atualizar múltiplos contatos
            Route::post('/status-multiplos', [App\Http\Controllers\Administrativo\SuporteContato::class, 'marcarMultiplosStatus'])
                ->name('admin.suporte.api.status-multiplos');

            // Rota para obter detalhes de um contato específico
            Route::get('/contato/{id}', [App\Http\Controllers\Administrativo\SuporteContato::class, 'getContato'])
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
