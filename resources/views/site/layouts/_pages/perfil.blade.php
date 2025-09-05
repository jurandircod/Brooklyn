<link rel="stylesheet" href="{{ asset('css/site/perfil/customize.css') }}">
<!-- user dashboard section start -->
<section class="section-b-space">
    <div class="container">
        <div class="main-container">
            <div class="row g-0">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                            <li class="nav-item">
                                <button
                                    class="nav-link font-light @if (empty($activeTab) && empty($_GET['activeTab'])) active 
            @elseif ((isset($activeTab) && $activeTab == 'dash') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'dash')) active @endif"
                                    id="dash-tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"
                                    onclick="showTabContent(event, 'dash')">
                                    <i class="fas fa-tachometer-alt"></i> <b>Painel de Controle</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 'profile') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'profile')) active @endif"
                                    id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                    onclick="showTabContent(event, 'profile')">
                                    <i class="fas fa-user"></i> <b>Perfil</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 'endereco') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'endereco')) active @endif"
                                    id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button"
                                    onclick="showTabContent(event, 'endereco')">
                                    <i class="fas fa-plus-circle"></i> <b>Cadastrar Endereço</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 'order') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'order')) active @endif"
                                    id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"
                                    onclick="showTabContent(event, 'order')">
                                    <i class="fas fa-shopping-bag"></i> <b>Pedidos</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 'save') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'save')) active @endif"
                                    id="save-tab" data-bs-toggle="tab" data-bs-target="#save" type="button"
                                    onclick="showTabContent(event, 'save')">
                                    <i class="fas fa-map-marker-alt"></i> <b>Endereços salvos</b>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 'security') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'security')) active @endif"
                                    id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                                    onclick="showTabContent(event, 'security')">
                                    <i class="fas fa-shield-alt"></i> <b>Segurança</b>
                                </button>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="content-area">
                        <div class="filter-button dash-filter dashboard">
                            <button class="btn btn-solid-default btn-sm fw-bold filter-btn">
                                <i class="fas fa-bars"></i> Show Menu
                            </button>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show @if (empty($activeTab) && empty($_GET['activeTab'])) active @endif"
                                id="dash">
                                <div class="dashboard-right">
                                    <div class="dashboard">
                                        <div class="page-title title title1 title-effect">
                                            <h2>Informações Pessoais</h2>
                                        </div>
                                        <div class="welcome-msg">
                                            <h6 class="font-light">Olá, <span>{{ Auth::user()->name }}</span></h6>
                                            <p class="font-light">Veja no painel de controle a informação que você
                                                deseja editar.</p>
                                        </div>

                                        <div class="dashboard-cards">
                                            <div class="stats-card">
                                                <div class="stats-card-icon">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                                <div class="stats-card-content">
                                                    <h5 class="font-black">Total de Pedidos</h5>
                                                    <h3>{{ $pedidos->count() }}</h3>
                                                </div>
                                            </div>

                                            <div class="stats-card">
                                                <div class="stats-card-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <div class="stats-card-content">
                                                    <h5 class="font-black">Pedidos Pendentes</h5>
                                                    <h3>{{ $pedidos->where('status', 'aguardando')->count() }}</h3>
                                                </div>
                                            </div>

                                            <div class="stats-card">
                                                <div class="stats-card-icon">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </div>
                                                <div class="stats-card-content">
                                                    <h5 class="font-black">Carrinhos</h5>
                                                    <h3>63,874</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="account-info">
                                            <div class="info-card">
                                                <div class="info-card-header">
                                                    <h4>Contato</h4>
                                                    <a href="{{ route('site.perfil.exibirEndereco') }}">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </a>
                                                </div>
                                                <div class="box-content">
                                                    <h6 class="font-light">{{ Auth::user()->name }}</h6>
                                                    <h6 class="font-light">{{ Auth::user()->email }}</h6>
                                                    <a href="#" class="text-primary">Alterar Senha</a>
                                                </div>
                                            </div>

                                            <div class="info-card">
                                                <div class="info-card-header">
                                                    <h4>Notícias</h4>
                                                    <a href="#">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </a>
                                                </div>
                                                <div class="box-content">
                                                    <h6 class="font-light">Você não está inscrito em nenhuma
                                                        newsletter.</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="order">
                                <div id="pedidos-table-container">
                                    @include('site.layouts._pages.perfil.partials.pedidos-table', [
                                        'pedidos' => $pedidos,
                                    ])
                                </div>

                                <div id="pedidos-pagination-container">
                                    @include('site.layouts._pages.perfil.partials.pedidos-pagination', [
                                        'pedidos' => $pedidos,
                                    ])
                                </div>
                            </div>

                            <div class="tab-pane fade @isset($activeTab) @if ($activeTab == 6) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 6) show active @endif @endisset"
                                id="save">

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3>Endereços Salvos</h3>
                                    <a href="{{ route('site.perfil.exibirEndereco') }}" class="btn btn-solid-default">
                                        <i class="fas fa-plus"></i> Adicionar novo endereço
                                    </a>
                                </div>

                                <div class="address-grid">
                                    @isset($enderecosMostrar)
                                        @if ($enderecosMostrar->isEmpty())
                                            <div class="col-12 text-center py-5">
                                                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                                                <h6 class="font-light">Você ainda não salvou nenhum endereço.</h6>
                                            </div>
                                        @else
                                            @foreach ($enderecosMostrar as $endereco)
                                                <div class="address-card">
                                                    <div class="address-header">
                                                        <h5>{{ $endereco->cidade }}</h5>
                                                        <span class="address-tag">Casa</span>
                                                    </div>

                                                    <div class="address-details">
                                                        <p><b>Endereço:</b> {{ $endereco->bairro }}</p>
                                                        <p><b>Número:</b> {{ $endereco->numero }}</p>
                                                        <p><b>Estado:</b> {{ $endereco->estado }}</p>
                                                        <p><b>CEP:</b> {{ $endereco->cep }}</p>
                                                        <p><b>Telefone:</b> {{ $endereco->telefone }}</p>
                                                    </div>

                                                    <div class="address-actions">
                                                        <a href="{{ route('site.perfil.enviaParaformEnderecos', ['id' => $endereco->id]) }}"
                                                            class="btn btn-outline">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        <a href="{{ route('site.perfil.removerEndereco', ['id' => $endereco->id]) }}"
                                                            class="btn btn-outline text-danger border-danger">
                                                            <i class="fas fa-trash"></i> Remover
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endisset
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3>Perfil</h3>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail"
                                        class="btn btn-solid-default">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </div>

                                <div class="info-card">
                                    <h5 class="mb-3">Informações da Empresa</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nome da Empresa</label>
                                            <p class="form-control-plaintext">Surfside Media Fashion</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">País / Região</label>
                                            <p class="form-control-plaintext">Downers Grove, IL</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Ano de Fundação</label>
                                            <p class="form-control-plaintext">2018</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Total de Funcionários</label>
                                            <p class="form-control-plaintext">101 - 200 Pessoas</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card mt-4">
                                    <h5 class="mb-3">Detalhes de Login</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <p class="form-control-plaintext">mark.jugal@gmail.com</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Telefone</label>
                                            <p class="form-control-plaintext">+1-202-555-0198</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="security">
                                <div class="info-card">
                                    <h3 class="text-danger mb-4">Deletar Conta</h3>
                                    <div class="security-details">
                                        <h5 class="font-light mt-3">Olá <span class="fw-bold">Mark Enderess,</span>
                                        </h5>
                                        <p class="font-light mt-1">Lamentamos saber que você gostaria de deletar sua
                                            conta.</p>
                                    </div>

                                    <div class="alert alert-warning mt-4">
                                        <h6 class="fw-bold mb-2">
                                            <i class="fas fa-exclamation-triangle"></i> Nota Importante
                                        </h6>
                                        <p class="font-light mb-3">Deletar sua conta removerá permanentemente seu
                                            perfil, configurações pessoais e todas as outras informações associadas. Uma
                                            vez que sua conta for deletada, você será desconectado e não poderá fazer
                                            login novamente.</p>
                                        <p class="font-light mb-0">Se você entende e concorda com a declaração acima, e
                                            ainda gostaria de deletar sua conta, clique no botão abaixo.</p>
                                    </div>

                                    <button id="btn-delete-account" class="btn btn-danger mt-3"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt"></i> Deletar Sua Conta
                                    </button>

                                </div>
                            </div>

                            <div class="tab-pane fade @isset($activeTab) @if ($activeTab == 3) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 3) show active @endif @endisset"
                                id="endereco">
                                <div class="info-card">
                                    <h3 class="mb-4">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                        @isset($enderecoEditar)
                                            Editar Endereço
                                        @else
                                            Cadastrar Endereço
                                        @endisset
                                    </h3>
                                    <form
                                        action="{{ isset($enderecoEditar) ? route('site.perfil.editarEndereco', ['id' => $enderecoEditar->id]) : route('site.perfil.salvarEndereco') }}"
                                        method="POST">
                                        @csrf
                                        @isset($enderecoEditar)
                                            <input type="hidden" name="id" value="{{ $enderecoEditar->id }}">
                                        @endisset
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-phone">
                                                        <i class="fas fa-phone text-primary"></i> Telefone
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="tel" class="form-control"
                                                        @isset($enderecoEditar) value="{{ $enderecoEditar->telefone }}" @endisset
                                                        name="telefone" id="input-phone"
                                                        placeholder="(11) 99999-9999">
                                                    @if ($errors->has('telefone'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('telefone') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-cep">
                                                        <i class="fas fa-mail-bulk text-primary"></i> CEP
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->cep : old('cep') }}"
                                                        name="cep" id="input-cep" placeholder="00000-000">
                                                    @if ($errors->has('cep'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('cep') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-city">
                                                        <i class="fas fa-city text-primary"></i> Cidade
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->cidade : old('cidade') }}"
                                                        name="cidade" id="input-city" placeholder="Nome da cidade">
                                                    @if ($errors->has('cidade'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('cidade') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-uf">
                                                        <i class="fas fa-flag text-primary"></i> Estado
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->estado : old('estado') }}"
                                                        name="estado" id="input-uf" placeholder="SP">
                                                    @if ($errors->has('estado'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('estado') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-complemento">
                                                        <i class="fas fa-info-circle text-primary"></i> Complemento
                                                    </label>
                                                    <input type="text" name="complemento" class="form-control"
                                                        value="{{ isset($enderecoEditar->complemento) ? $enderecoEditar->complemento : old('complemento') }}"
                                                        id="input-complemento" placeholder="Apartamento, bloco, etc.">
                                                    @if ($errors->has('complemento'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('complemento') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-logradouro">
                                                        <i class="fas fa-road text-primary"></i> Logradouro
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" name="logradouro" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->logradouro : old('logradouro') }}"
                                                        id="input-logradouro" placeholder="Rua, Avenida, etc.">
                                                    @if ($errors->has('logradouro'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('logradouro') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-numero">
                                                        <i class="fas fa-hashtag text-primary"></i> Número
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" name="numero" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->numero : old('numero') }}"
                                                        id="input-numero" placeholder="123">
                                                    @if ($errors->has('numero'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('numero') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="input-bairro">
                                                        <i class="fas fa-map text-primary"></i> Bairro
                                                        <span class="required"
                                                            style="color: red; font-size:15px;">*</span>
                                                    </label>
                                                    <input type="text" name="bairro" class="form-control"
                                                        value="{{ isset($enderecoEditar) ? $enderecoEditar->bairro : old('bairro') }}"
                                                        id="input-bairro" placeholder="Nome do bairro">
                                                    @if ($errors->has('bairro'))
                                                        <div class="text-danger mt-1">
                                                            <small>{{ $errors->first('bairro') }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 mt-4">
                                            <button type="submit" class="btn btn-solid-default">
                                                <i class="fas fa-save"></i>
                                                @isset($enderecoEditar)
                                                    Atualizar Endereço
                                                @else
                                                    Salvar Endereço
                                                @endisset
                                            </button>
                                            <a href="/perfil?activeTab=3" class="btn btn-solid-default">
                                                <i class="fas fa-times"></i> Cancelar
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- user dashboard section end -->

<!-- Subscribe Section Start -->
<section class="subscribe-section section-b-space" style="background: white; padding: 4rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6">
                <div class="subscribe-details">
                    <h2 class="mb-3" style="color: var(--text-primary);">Assine Nossa Newsletter</h2>
                    <h6 class="font-light" style="color: var(--text-secondary);">Assine e receba nossas newsletters
                        para acompanhar as novidades sobre nossos produtos incríveis.</h6>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                <div class="subsribe-input">
                    <div class="input-group">
                        <input type="text" class="form-control subscribe-input"
                            placeholder="Seu endereço de email">
                        <button class="btn btn-solid-default" type="button">
                            <i class="fas fa-paper-plane"></i> Assinar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Mobile menu toggle
        $('.filter-btn').click(function() {
            $('.sidebar').toggleClass('show');
        });

        // CEP lookup functionality
        $('#input-cep').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, '');

            if (cep.length === 8) {
                $.ajax({
                    url: '/cep/' + cep,
                    method: 'GET',
                    success: function(response) {
                        if (response.city && response.uf) {
                            $('#input-uf').val(response.uf);
                            $('#input-city').val(response.city);
                            $('#input-uf').attr('readonly', true);
                            $('#input-city').attr('readonly', true);
                        } else {
                            alert('CEP não encontrado!');
                        }
                    },
                    error: function() {
                        alert('Erro ao buscar o CEP.');
                    }
                });
            } else {
                alert('Digite um CEP válido!');
            }
        });

        // Form animations
        $('.form-control').focus(function() {
            $(this).parent().addClass('focused');
        });

        $('.form-control').blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('focused');
            }
        });

        // Smooth scroll for anchor links
        $('a[href^="#"]').click(function(e) {
            e.preventDefault();
            var target = $($(this).attr('href'));
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });
    });
</script>

<script>
    function showTabContent(event, tabId) {
        // esconde todas as abas
        const elementosConteudo = document.querySelectorAll('#myTabContent .tab-pane');
        elementosConteudo.forEach(elemento => {
            elemento.classList.remove('active', 'show');
        });

        // desmarca todos os botões
        const botoesSidebar = document.querySelectorAll('#myTab .nav-link');
        botoesSidebar.forEach(botao => {
            botao.classList.remove('active');
        });

        // ativa só o botão clicado
        event.currentTarget.classList.add('active');

        // mostra o conteúdo correspondente
        const tabAtiva = document.getElementById(tabId);
        if (tabAtiva) {
            tabAtiva.classList.add('active', 'show');
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paginationContainer = document.getElementById('pedidos-pagination-container');

        // Delegation for pagination clicks
        paginationContainer.addEventListener('click', function(e) {
            const link = e.target.closest('a.page-link');
            if (!link) return;

            e.preventDefault();
            loadPage(link.href);
        });

        // Function to load pages via AJAX
        function loadPage(url) {
            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    document.getElementById('pedidos-table-container').innerHTML = data.table;
                    document.getElementById('pedidos-pagination-container').innerHTML = data.pagination;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
