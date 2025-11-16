<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        function removeParam(param) {
            const url = new URL(window.location.href);
            url.searchParams.delete(param);
            window.history.replaceState({}, '', url);
        }

        // Uso:
        removeParam('alterado');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrativo - @yield('titulo')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Logo após <meta name="csrf-token" ... > -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('dist/img/favicon.ico') }}">
    <script>
        window.defaultImage = "{{ asset('uploads/produtos/padrao/1.gif') }}";
    </script>
    <link rel="stylesheet" href="{{ asset('css/site/produtos/customize.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
<link rel="shortcut icon" href="{{asset('images/loading.gif')}}" type="image/x-icon">


    <!-- Bootstrap 5 (mantenha ou remova dependendo da necessidade de compatibilidade) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/administrativo/basico.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('administrativo.layouts._partials.topo')
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            @if (Auth::check())
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
                            <img src="{{ asset('dist/img/avatar5.png') }}"
                                class="img-circle elevation-2 img-user-profile"
                                class="img-circle elevation-2 img-user-profile" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                <span class="text-white">{{ Auth::user()->name }}</span>
                                <small class="d-block text-white">{{ Auth::user()->email }}</small>
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
                        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent"
                            data-widget="treeview" role="menu" data-accordion="false">

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
                                            <p>Gerenciar Produtos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('administrativo.produto.categoria') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon text-xs"></i>
                                            <p>Gerenciar Categorias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('administrativo.marca') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon text-xs"></i>
                                            <p>Gerenciar Marcas</p>
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

                            @can('access-admin')
                                <li class="nav-header text-uppercase text-xs text-gray mt-3">SUPORTE CONTATOS</li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link bg-gradient-dark">
                                        <i class="nav-icon fas fa-wrench"></i>
                                        <p>
                                            Suporte
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.suporte.contatos') }}" class="nav-link">
                                                <i class="far fa-dot-circle nav-icon text-xs"></i>
                                                <p>Gerenciar Contatos</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </nav>
                </div>
            @endif
        </aside>
        <div class="content-wrapper">
            @yield('conteudo')
        </div>
    </div>

    <!-- SCRIPTS - ORDEM CORRIGIDA -->

    <!-- 1. jQuery (PRIMEIRO - obrigatório para todos os plugins) -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- 2. jQuery UI (necessário para sortable e outros componentes) -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- 3. Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- 4. Moment.js (para daterangepicker) -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

    <!-- 5. Plugins diversos (que dependem de jQuery) -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- 6. DataTables & Plugins (dependem de jQuery) -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <!-- 6. DataTables & Plugins (dependem de jQuery) -->
    <!-- 7. AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <!-- 8. Bootstrap 5 (se realmente necessário - pode conflitar com Bootstrap 4) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- 9. Seus scripts personalizados (POR ÚLTIMO) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

</body>

</html>
