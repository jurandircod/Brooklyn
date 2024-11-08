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
Route::get('/', 'PrincipalController@principal')->name('site.principal');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::get('/sobre', 'SobreNosController@sobre')->name('site.sobre');
Route::get('/produtos', 'ShopController@shop')->name('site.shop');
Route::get('/carrinho', 'CarrinhoController@index')->name('site.carrinho');
Route::get('/cep/{cep}', 'AddressController@getCityByCep');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato.salvar');

// Rotas relacionadas ao perfil
Route::group(['prefix' => 'perfil'], function () {
    Route::get('/', 'User@index')->name('site.perfil');
    Route::get('/{id}', 'AddressController@enviaParaformEnderecos')->name('site.perfil.enviaParaformEnderecos');
    Route::get('/exibirEndereco', 'PerfilController@exibirEndereco')->name('site.perfil.exibirEndereco');
    Route::post('/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
    Route::get('/remover/{id}', 'AddressController@remover')->name('site.perfil.removerEndereco');
    Route::post('/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
});

// Rotas do administrador
Route::group(['prefix' => 'administrativo'], function () {
    Route::get('/', [App\Http\Controllers\Administrativo\PrincipalController::class, 'index'])->name('administrativo.principal');
    
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
