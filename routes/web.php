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
Route::get('/login', 'LoginController@login')->name('site.login');
Route::get('/principal', 'PrincipalController@principal')->name('site.principal');
Route::get('/', 'PrincipalController@principal')->name('site.principal');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato.salvar');
Route::get('/sobre', 'SobreNosController@sobre')->name('site.sobre');
Route::get('/produtos', 'ShopController@shop')->name('site.shop');
Route::get('/carrinho', 'CarrinhoController@index')->name('site.carrinho');

Route::get('/cep/{cep}', 'AddressController@getCityByCep');
Route::get('/perfil', 'User@index')->name('site.perfil');
Route::get('/perfil/{id}', 'AddressController@enviaParaformEnderecos')->name('site.perfil.enviaParaformEnderecos');
Route::get('/perfil/exibirEndereco', 'PerfilController@exibirEndereco')->name('site.perfil.exibirEndereco');
Route::post('/perfil/salvar', 'AddressController@salvar')->name('site.perfil.salvarEndereco');
Route::post('/perfil/editar/{id}', 'AddressController@editar')->name('site.perfil.editarEndereco');
Auth::routes(['reset' => true]);

Route::get('/home', 'HomeController@index')->name('home');
