<?php
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Administrativo\SuporteContato;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Controllers\{AvaliacaoController, PerfilController, User, ItemCarrinhoController, FazerPedidoController};
use App\Http\Controllers\Administrativo\{PrincipalControllerAdministrativo, VendasController, TabelasControllers, PermissoesController, ProdutosController, CategoriaController, MarcaController};
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FreteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest; // ADICIONE ESTA LINHA


/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

// Em routes/web.php
// Em routes/web.php - TESTE ESTA ROTA PRIMEIRO
// Em routes/web.php
// ==========================================
// ROTAS PÚBLICAS (SEM AUTENTICAÇÃO)
// ==========================================
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/register/salvar', [RegisterController::class, 'register'])->name('registerSalvar');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/webhook/mercadopago', [WebhookController::class, 'handle']);
Route::get('/login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// routes/web.php
Route::middleware('auth')->get('/pedido/{id}/status', [\App\Http\Controllers\PedidoStatusController::class, 'show']);
// Coloque isso ANTES do grupo 'auth' e 'verified'
// Por exemplo, logo após as rotas públicas:

// ==========================================
// ROTAS DE VERIFICAÇÃO DE EMAIL
// ==========================================
Route::get('/email/verify', function () {
    return view('site.verify');
})->middleware(['auth'])->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/perfil')->with('status', 'Email verificado com sucesso!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/perfil')->with('status', 'Email verificado com sucesso!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Autenticação

// ==========================================
// ROTAS DE REDEFINIÇÃO DE SENHA
// ==========================================
Route::prefix('site')->group(function () {
    // Verificar email
    Route::get('/email/verificar', [User::class, 'verificarEmail'])->name('site.email.verificar');
    
    // Mostrar formulário de reset (quando chega pelo email)
    Route::get('resetar-senha/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('site.password.reset');
    
    // Processar o reset
    Route::post('resetar-senha', [PasswordResetController::class, 'reset'])
        ->name('site.password.update');
});

// ==========================================
// ROTAS COM AUTENTICAÇÃO E VERIFICAÇÃO
// ==========================================
Route::get('/principal', [PrincipalController::class, 'principal'])->name('site.principal');
Route::get('/', [PrincipalController::class, 'principal'])->name('site.principal');

// ==========================================
// ROTAS DE PRODUTO
// ==========================================
Route::prefix('produto')->group(function () {
    Route::get('/{id}', [ProdutoController::class, 'index'])->name('site.produto');
    Route::post('/avaliacao', [AvaliacaoController::class, 'CreateAvaliacao'])->name('site.produto.avaliacao');
});

// ==========================================
// ROTAS DE FRETE
// ==========================================
Route::prefix('frete')->group(function () {
    Route::post('/calcular', [FreteController::class, 'calcular'])->name('site.frete.calcular');
});

// ==========================================
// ROTAS DE PESQUISA
// ==========================================
Route::prefix('pesquisa')->group(function () {
    Route::get('/pesquisa/{id}', [ShopController::class, 'index'])->name('site.shop')->where('id', '[0-9]+');
    Route::post('/pesquisa/{id}', [ShopController::class, 'index'])->name('site.shop')->where('id', '[0-9]+');
    Route::post('/produtos', [ShopController::class, 'index'])->name('site.shop.produto');
    Route::get('/produtos', [ShopController::class, 'index'])->name('site.shop.produto');
    Route::post('/filter', [ShopController::class, 'index'])->name('site.pesquisa.filtrar');
    Route::post('/pesquisa', [ShopController::class, 'index'])->name('site.shop');
    Route::get('/produtos/categoria/{id}', [ShopController::class, 'index'])->name('site.shop.categoria')->where('id', '[0-9]+');
    Route::post('/produtos/categoria/{id}', [ShopController::class, 'index'])->name('site.shop.categoria')->where('id', '[0-9]+');
});

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato.salvar');
Route::get('/sobre', [SobreNosController::class, 'sobre'])->name('site.sobre');

Route::middleware(['auth', 'verified'])->group(function () {
    // ==========================================
    // ROTAS GERAIS DO SITE
    // ==========================================
    Route::get('/cep/{cep}', [AddressController::class, 'getCityByCep']);
    Route::get('/fazerPedido', [FazerPedidoController::class, 'index'])->name('site.fazerPedido');

    // ==========================================
    // ROTAS DE PERFIL
    // ==========================================
    Route::get('/exibirEndereco', [PerfilController::class, 'exibirEndereco'])->name('site.perfil.exibirEndereco');
    
    Route::prefix('perfil')->group(function () {
        Route::get('/', [PerfilController::class, 'index'])->name('site.perfil');
        Route::get('/{id}', [PerfilController::class, 'index'])->name('site.perfil.enviaParaformEnderecos');
        Route::post('/salvar', [AddressController::class, 'salvar'])->name('site.perfil.salvarEndereco');
        Route::get('/remover/{id}', [AddressController::class, 'disableAddress'])->name('site.perfil.removerEndereco');
        Route::post('/editar/{id}', [AddressController::class, 'updateAddress'])->name('site.perfil.editarEndereco');
        Route::get('/cancelar/pedido/{id}', [PerfilController::class, 'cancelarPedido'])->name('site.perfil.cancelarPedido');
        Route::get('/confirmar/pedido/{id}', [PerfilController::class, 'confirmarPedido'])->name('site.perfil.confirmarPedido');
        Route::get('/pedidos/api', [PerfilController::class, 'pedidosApi'])->name('site.pedidos.api');
    });

    // ==========================================
    // ROTAS DE PAGAMENTO
    // ==========================================
    Route::post('/payments/pix', [PaymentController::class, 'createPixPayment']);

    // ==========================================
    // ROTAS DO CARRINHO
    // ==========================================
    Route::prefix('carrinho')->group(function () {
        Route::get('/principal', [CarrinhoController::class, 'index'])->name('site.carrinho');
        
        Route::prefix('itemCarrinho')->group(function () {
            Route::post('/adicionar', [ItemCarrinhoController::class, 'adicionar'])->name('site.carrinho.itemCarrinho.adicionar');
            Route::post('/remover/{id}', [CarrinhoController::class, 'remover'])->name('site.carrinho.remover');
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
        Route::get('/', [PrincipalControllerAdministrativo::class, 'index'])->name('administrativo.principal');

        // ==========================================
        // VENDAS
        // ==========================================
        Route::get('/vendas', [VendasController::class, 'index'])->name('administrativo.vendas');

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
        Route::post('/produto/excluir/{id}', [ProdutosController::class, 'destroy'])->name('administrativo.produto.excluir');

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
            Route::post('/salvar', [MarcaController::class, 'marcaSalvar'])->name('administrativo.marca.salvar');
            Route::post('/excluir', [MarcaController::class, 'marcaExcluir'])->name('administrativo.marca.excluir');
        });
    });

    // ==========================================
    // PRODUTOS RESTFUL (Estrutura Alternativa)
    // ==========================================
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        // Produtos (RESTFUL) - CRUD Básico (com paginação)
        Route::resource('produtos', ProdutosController::class, [
            'names' => [
                'index' => 'admin.produtos.index',
                'create' => 'admin.produtos.create',
                'store' => 'admin.produtos.store',
                'show' => 'admin.produtos.show',
                'edit' => 'admin.produtos.edit',
                'update' => 'admin.produtos.update',
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