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
Route::post('/register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register');
Route::get('/register', [App\Http\Controllers\Auth\LoginController::class, 'showRegisterForm'])->name('register');

Route::get('/principal', 'PrincipalController@principal')->name('site.principal');
Route::get('/', 'PrincipalController@principal')->name('site.principal');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::get('/sobre', 'SobreNosController@sobre')->name('site.sobre');
Route::get('/produtos', 'ShopController@shop')->name('site.shop');
Route::get('/carrinho', 'CarrinhoController@index')->name('site.carrinho');
Route::get('/cep/{cep}', 'AddressController@getCityByCep');

// Rotas relacionadas ao perfil
Route::get('/perfil', 'User@index')->name('site.perfil');
Route::get('/perfil/{id}', 'AddressController@enviaParaformEnderecos')->name('site.perfil.enviaParaformEnderecos');
Route::get('/perfil/exibirEndereco', 'PerfilController@exibirEndereco')->name('site.perfil.exibirEndereco');

// Agrupando rotas de criação, edição e salvamento de endereços
Route::group(['prefix' => 'perfil'], function () {
    Route::post('/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
    Route::get('/remover/{id}', 'AddressController@remover')->name('site.perfil.removerEndereco');
    Route::post('/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
});

// Rotas de contato (salvar)
Route::post('/contato', 'ContatoController@salvar')->name('site.contato.salvar');

// Autenticação
Auth::routes(['reset' => true]);

// Home
Route::get('/home', 'HomeController@index')->name('home');

