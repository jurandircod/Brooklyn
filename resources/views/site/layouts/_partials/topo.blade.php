<header class="header-style-2" id="home">
    <div class="main-header navbar-searchbar" data-bs-theme="dark">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-menu">
                        <div class="menu-left">
                            <div class="brand-logo">
                                <a href="{{ route('site.principal') }}">
                                    <img src="{{asset('images/logo.png')}}" class="h-logo img-fluid blur-up lazyload"
                                        alt="logo">
                                </a>
                            </div>

                        </div>
                        <nav>
                            <div class="main-navbar " >
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
                                        <li><a href="{{ route('site.principal') }}" class="nav-link menu-title">Inicio</a></li>
                                        <li><a href="{{ route('site.shop') }}" class="nav-link menu-title">Produtos</a></li>
                                        <li><a href="{{route('site.carrinho')}}" class="nav-link menu-title">Carrinho</a></li>
                                        <li><a href="{{route('site.sobre')}}" class="nav-link menu-title">Sobre Nós</a></li>
                                        <li><a href="{{ route('site.contato') }}" class="nav-link menu-title">Contato</a>
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
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="wishlist/list.html">
                                            <i data-feather="heart"></i>
                                            <span id="wishlist-count" class="label label-theme rounded-pill">
                                                0
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="onhover-dropdown wislist-dropdown">
                                    <div class="cart-media">
                                        <a href="{{route('site.carrinho')}}">
                                            <i data-feather="shopping-cart"></i>
                                            <span id="contador" class="label label-theme rounded-pill">
                                                0
                                            </span>
                                        </a>
                                    </div>
                                </li>
                                <li class="onhover-dropdown">
                                    @auth
                                    <div class="cart-media ">
                                        <i>Jurandir Aparecido </i>
                                    </div>

                                    <div class="onhover-div profile-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{route('site.perfil')}}" class="d-block">Meu Perfil</a>
                                            </li>
                                            <li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form> 
                                                <a class="d-block" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('register') }}" class="d-block">Registrar</a>
                                            </li>

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
                                                <a href="{{route('login')}}" class="d-block">Entrar</a>
                                            </li>
                                            <li>
                                                <a href="{{route('register')}}" class="d-block">Registrar</a>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@auth
<script>
$(document).ready(function () {
    function atualizarContadorCarrinho() {
        $.ajax({
            url: "{{ route('site.carrinho.quantidadeItensCarrinho') }}",
            method: 'GET',
            success: function(response) {
                console.log("Quantidade de itens:", response.quantidade);
                $('#contador').text(response.quantidade);
            },
            error: function(xhr, status, error) {
                console.error("Erro no AJAX:", error);
                console.log("Resposta completa:", xhr.responseText);
            }
        });
    }

    // Atualiza imediatamente ao carregar a página
    atualizarContadorCarrinho();

    // Atualiza a cada 5 segundos (5000 milissegundos)
    setInterval(atualizarContadorCarrinho, 1000);
});
</script>
@endauth

