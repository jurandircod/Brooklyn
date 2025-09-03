<style>
    header .profile-dropdown ul li {
        display: block;
        padding: 5px 20px;
        border-bottom: 1px solid #ddd;
        line-height: 35px;
    }

    header .profile-dropdown ul li:last-child {
        border-color: #fff;
    }

    header .profile-dropdown ul {
        padding: 10px 0;
        min-width: 250px;
    }

    .name-usr {
        background: #e87316;
        padding: 8px 12px;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 24px;
    }

    .name-usr span {
        margin-right: 10px;
    }

    @media (max-width:600px) {
        .h-logo {
            max-width: 150px !important;
        }

        i.sidebar-bar {
            font-size: 22px;
        }

        .mobile-menu ul li a svg {
            width: 20px;
            height: 20px;
        }

        .mobile-menu ul li a span {
            margin-top: 0px;
            font-size: 12px;
        }

        .name-usr {
            padding: 5px 12px;
        }
    }
</style>


<div class="mobile-menu d-sm-none">
    <ul>
        <li>
            <a href="demo3.php" class="active">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="align-justify"></i>
                <span>Category</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="shopping-bag"></i>
                <span>Cart</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li>
            <a href="user-dashboard.php">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </li>
    </ul>
</div>

<header class="header-style-2" id="home">
    <div class="main-header navbar-searchbar" data-bs-theme="dark">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{ route('site.principal') }}">
                                    <img src="{{ asset('images/1.png') }}" class="h-logo img-fluid blur-up lazyload"
                                        alt="logo" style="height:100px; width:auto;">
                                </a>
                            </div>

                        </div>
                        <nav>
                            <div class="main-navbar ">
                                <div id="mainnav">
                                    <div class="toggle-nav">
                                        <i class="fa fa-bars sidebar-bar"></i>
                                    </div>
                                    <ul class="nav-menu">
                                        <li class="back-btn d-xl-none">
                                            <div class="close-btn">
                                                Menu
                                                <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                </span>
                                            </div>
                                        </li>
                                        <li><a href="{{ route('site.principal') }}"
                                                class="nav-link menu-title">Inicio</a></li>
                                        <li><a href="{{ route('site.shop') }}" class="nav-link menu-title">Produtos</a>
                                        </li>
                                        <li><a href="{{ route('site.carrinho') }}"
                                                class="nav-link menu-title">Carrinho</a></li>
                                        <li><a href="{{ route('site.sobre') }}" class="nav-link menu-title">Sobre
                                                Nós</a></li>
                                        <li><a href="{{ route('site.contato') }}"
                                                class="nav-link menu-title">Contato</a>
                                        </li>
                                        <li><a href="blog.html" class="nav-link menu-title">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                        <div class="menu-right">
                            <ul>
                                <li>
                                    <div class="search-box theme-bg-color">
                                        <i data-feather="search"></i>
                                    </div>
                                </li>
                                @auth
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="cart-media">
                                            <a href="{{ route('site.carrinho') }}">
                                                <i data-feather="shopping-cart"></i>
                                                <span id="contador" class="label label-theme rounded-pill">
                                                    0
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                @endauth
                                <li class="onhover-dropdown">
                                    @auth
                                        <div class="cart-media ">
                                            <i>Jurandir Aparecido </i>
                                        </div>

                                        <div class="onhover-div profile-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('site.perfil') }}" class="d-block">Meu Perfil</a>
                                                </li>

                                                @can('access-admin', 'access-fornecedor')
                                                    <li>
                                                        <a href="{{ route('administrativo.principal') }}"
                                                            class="d-block">Administração</a>
                                                    </li>
                                                @endcan
                                                <li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <a class="d-block" href="#"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                                                </li>
                                                @if (!auth()->id())
                                                    <li>
                                                        <a href="{{ route('register') }}" class="d-block">Registrar</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endauth

                                    @guest
                                        <div class="cart-media name-usr">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="onhover-div profile-dropdown">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('login') }}" class="d-block">Entrar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('register') }}" class="d-block">Registrar</a>
                                                </li>

                                            </ul>
                                        </div>
                                    @endguest
                                </li>
                            </ul>
                        </div>
                        <div class="search-full">
                            <form method="GET" class="search-full" action="http://localhost:8000/search">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control search-type"
                                        placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            let ultimaModificacaoConhecida = null;

            function atualizarContadorCarrinho() {
                $.ajax({
                    url: "{{ route('site.carrinho.quantidadeItensCarrinho') }}",
                    method: 'GET',
                    data: {
                        ultima_modificacao_conhecida: ultimaModificacaoConhecida
                    },
                    success: function(response) {
                        // Verifica se houve mudança na última modificação ou se é a primeira carga
                        if (!ultimaModificacaoConhecida || ultimaModificacaoConhecida !==
                            response.ultima_modificacao) {
                            console.log("Quantidade de itens atualizada:", response
                                .quantidade);
                            $('#contador').text(response.quantidade);
                            ultimaModificacaoConhecida = response.ultima_modificacao;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro no AJAX:", error);
                    }
                });
            }

            // Atualiza imediatamente ao carregar a página
            atualizarContadorCarrinho();

            // Verifica a cada 5 segundos (mais eficiente que 1 segundo)
            setInterval(atualizarContadorCarrinho, 5000);

            // Opcional: Atualizar quando ocorrem eventos relevantes
            $(document).on('click', '.adicionar-ao-carrinho, .remover-do-carrinho', function() {
                setTimeout(atualizarContadorCarrinho,
                1000); // Espera 1s para dar tempo do backend processar
            });
        });
    });
</script>
