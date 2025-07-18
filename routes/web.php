<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/fazerPedido', 'fazerPedido@index')->name('site.fazerPedido')->middleware('auth');

Route::get('/teste-auth', function () {
    return response()->json([
        'logado' => auth()->check(),
        'id' => auth()->id(),
        'user' => auth()->user(),
    ]);
});

Route::group(['prefix' => 'pesquisa'], function () {
    Route::get('/pesquisa', 'ShopController@index')->name('site.shop');
    Route::post('/pesquisa/filtrar', 'ShopController@filtrar')->name('site.pesquisa.filtrar');
});

// Rotas relacionadas ao perfil
Route::group(['prefix' => 'perfil'], function () {
    Route::get('/', 'User@index')->name('site.perfil');
    Route::get('/{id}', 'AddressController@enviaParaformEnderecos')->name('site.perfil.enviaParaformEnderecos');
    Route::get('/exibirEndereco', 'PerfilController@exibirEndereco')->name('site.perfil.exibirEndereco');
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
        Route::post('/carrinho/itensCarrinho/atualizar-quantidade', [App\Http\Controllers\ItemCarrinhoController::class, 'atualizarQuantidade'])->name('carrinho.atualizar-quantidade');
        Route::post('/carrinho/itensCarrinho/remover-item', [App\Http\Controllers\ItemCarrinhoController::class, 'removerItem'])->name('carrinho.remover-item');
        Route::get('/carrinho/itensCarrinho/quantidade', [App\Http\Controllers\ItemCarrinhoController::class, 'quantidadeItensCarrinho'])->name('site.carrinho.quantidadeItensCarrinho');
    });
});

// rotas produto
Route::group(['prefix' => 'produto'], function () {
    Route::get('/{id}', 'ProdutoController@index')->name('site.produto');
});

// Rotas do administrador
Route::group(['prefix' => 'administrativo'], function () {
    Route::get('/', [App\Http\Controllers\Administrativo\PrincipalController::class, 'index'])->name('administrativo.principal');

    Route::get('/vendas', 'RelatorioController@produtosMaisVendidos')
    ->name('relatorios.produtos-mais-vendidos')
    ->middleware('auth');

    Route::get('/tabelas', 'TabelasControllers@index')->name('administrativo.tabelas');
    
    //rotas de permissoes
    Route::group(['prefix' => 'permissoes'], function () {
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


    Route::group(['prefix' => 'marca'], function () {
        Route::get('/', [App\Http\Controllers\Administrativo\MarcaController::class, 'index'])->name('administrativo.marca');
        Route::post('/alterar', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaAlterar'])->name('administrativo.marca.alterar');
        Route::post('/enviarForm', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaEnviarForm'])->name('administrativo.marca.enviarForm');
        Route::post('/salvar', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaSalvar'])->name('administrativo.marca.salvar');
        Route::post('/excluir', [App\Http\Controllers\Administrativo\MarcaController::class, 'marcaExcluir'])->name('administrativo.marca.excluir');
    });

});

// Autenticação
Auth::routes(['reset' => true]);

// Rota de fallback
Route::fallback(function () {
    echo "A rota acessada não existe. Clique <a href='/'>aqui</a> para retornar para a página inicial.";
});
