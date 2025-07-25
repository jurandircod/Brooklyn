<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('administrativo.principal') }}" class="brand-link bg-gradient-navy">
        <span class="brand-text font-weight-light ml-2">
            <i class="fas fa-store-alt mr-2"></i>
            Administração
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminLte/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2 img-user-profile" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <span class="text-white">Jurandir</span>
                    <small class="d-block text-white">Admin</small>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline px-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar bg-dark border-0" type="search"
                    placeholder="Pesquisar..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search text-gray"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">

                <!-- Seção de Permissões -->
                @can('access-admin')
                    <li class="nav-header text-uppercase text-xs text-gray mt-2">CONTROLE DE ACESSO</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Permissões
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('administrativo.permissoes') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-xs"></i>
                                    <p>Cadastrar Permissões</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('administrativo.permissoes.usuarios') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-xs"></i>
                                    <p>Gerenciar Usuários</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                <!-- Seção de Produtos -->
                <li class="nav-header text-uppercase text-xs text-gray mt-3">GERENCIAMENTO</li>
                <li class="nav-item">
                    <a href="#" class="nav-link bg-gradient-dark">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            Produtos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('administrativo.produtos') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-xs"></i>
                                <p>Cadastrar Produtos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('administrativo.produto.categoria') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-xs"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('administrativo.marca') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-xs"></i>
                                <p>Marcas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Seção de Relatórios -->
                <li class="nav-header text-uppercase text-xs text-gray mt-3">RELATÓRIOS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link bg-gradient-dark">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Análises
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('administrativo.vendas') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-xs"></i>
                                <p>Vendas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon text-xs"></i>
                                <p>Estoque</p>
                            </a>
                        </li>
                        @can('access-admin')
                            <li>
                                <a href="{{ route('administrativo.tabelas') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon text-xs"></i>
                                    <p>Tabelas</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    .img-user-profile {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .nav-flat .nav-item>.nav-link {
        border-radius: 0;
        margin-bottom: 1px;
    }

    .nav-child-indent .nav-treeview {
        padding-left: 20px;
    }

    .bg-gradient-navy {
        background: linear-gradient(to right, #001f3f, #003366);
    }

    .bg-gradient-dark {
        background: linear-gradient(to right, #343a40, #4a5258);
    }
</style>
