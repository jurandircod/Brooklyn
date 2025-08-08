<style>
    :root {
        --primary-color: #6A70D6;
        --primary-hover: #ffffff;
        --secondary-color: #9bb0c5;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --dark-color: #E22454;
        --light-gray: #f1f5f9;
        --border-color: #e2e8f0;
        --text-primary: #334155;
        --text-secondary: #64748b;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }



    .h-logo {
        max-width: 185px !important;
    }

    .f-logo {
        max-width: 220px !important;
    }

    @media only screen and (max-width: 600px) {
        .h-logo {
            max-width: 110px !important;
        }
    }

    @keyframes animate {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
            border-radius: 0;
        }

        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
            border-radius: 50%;
        }
    }

    /* Breadcrumb */


    /* Main container */
    .section-b-space {
        padding: 2rem 0;
    }

    .main-container {
        background: white;
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        overflow: hidden;
        margin-top: 2rem;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Sidebar */
    .sidebar {
        background: linear-gradient(180deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 2rem 0;
        border-right: 1px solid var(--border-color);
        min-height: 600px;
    }

    .nav-tabs {
        border: none;
        flex-direction: column;
    }

    .nav-item {
        margin-bottom: 0.5rem;
    }

    .nav-link {
        background: transparent;
        border: none;
        color: var(--text-secondary);
        padding: 1rem 1.5rem;

        margin: 0 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;

        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .nav-link b {
        margin-left: 0.5rem;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: linear-gradient(135deg, var(white), var(--primary-hover));
        transition: width 0.3s ease;
        z-index: -1;
    }

    .nav-link:hover,
    .nav-link.active {
        color: white;
        transform: translateX(8px);
        box-shadow: var(--shadow-md);
    }

    .nav-link:hover::before,
    .nav-link.active::before {
        width: 100%;
    }

    .nav-link i {
        font-size: 1.1rem;
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .nav-link:hover i {
        transform: rotate(90deg);
    }

    /* Content area */
    .content-area {
        padding: 2rem;
        background: white;
    }

    .filter-button {
        display: none;
    }

    /* Dashboard cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stats-card:hover::before {
        transform: scale(1.5);
    }

    .stats-card:nth-child(2) {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }

    .stats-card:nth-child(3) {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }

    .stats-card-content {
        position: relative;
        z-index: 2;
    }

    .stats-card h5 {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .stats-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .stats-card-icon {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        opacity: 0.3;
    }

    /* Account info cards */
    .account-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .info-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .info-card-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .info-card-header h4 {
        color: var(--text-primary);
        font-weight: 600;
        margin: 0;
    }

    .info-card-header a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .info-card-header a:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Tables */
    .table-container {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        margin-top: 1rem;
    }

    .table {
        margin: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 1rem;
        border: none;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background: var(--light-gray);
    }

    /* Status buttons */
    .status-btn {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        border: none;
    }

    .success-button {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success-color);
    }

    .danger-button {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
    }

    /* Forms */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Buttons */
    .btn {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-solid-default {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        color: white;
    }

    .btn-solid-default:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    /* Address cards */
    .address-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }

    .address-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 2px solid var(--border-color);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .address-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
    }

    .address-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-color);
    }

    .address-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .address-header h5 {
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .address-tag {
        background: rgba(99, 102, 241, 0.1);
        color: var(--primary-color);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .address-details p {
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
    }

    .address-details b {
        color: var(--text-primary);
    }

    .address-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .address-actions .btn {
        flex: 1;
        justify-content: center;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .filter-button {
            display: block;
            margin-bottom: 1rem;
        }

        .sidebar {
            display: none;
        }

        .sidebar.show {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1050;
            background: white;
        }

        .main-container {
            margin-top: 1rem;
        }

        .content-area {
            padding: 1rem;
        }

        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .account-info {
            grid-template-columns: 1fr;
        }

        .address-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .breadcrumb-section h3 {
            font-size: 1.8rem;
        }

        .stats-card {
            padding: 1.5rem;
        }

        .stats-card h3 {
            font-size: 2rem;
        }
    }

    /* Page title */
    .page-title {
        margin-bottom: 2rem;
    }

    .page-title h2 {
        color: var(--text-primary);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .welcome-msg h6 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-msg p {
        color: var(--text-secondary);
    }

    .welcome-msg span {
        color: var(--primary-color);
        font-weight: 600;
    }
</style>

<!-- Breadcrumb section start -->
<!-- Breadcrumb section end -->

<!-- user dashboard section start -->
<section class="section-b-space">
    <div class="container">
        <div class="main-container">
            <div class="row g-0">
                <div class="col-lg-3">
                    <div class="sidebar">
                        <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                            <li class="nav-item">
                                <button class="nav-link font-light @if (empty($activeTab) && empty($_GET['activeTab'])) active @endif"
                                    id="tab" data-bs-toggle="tab" data-bs-target="#dash" type="button">
                                    <i class="fas fa-tachometer-alt"></i> <b>Painel de Controle</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button">
                                    <i class="fas fa-user"></i> <b>Perfil</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 3) || (isset($_GET['activeTab']) && $_GET['activeTab'] == 3)) active @endif"
                                    id="6-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button">
                                    <i class="fas fa-plus-circle"></i> <b>Cadastrar Endereço</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab"
                                    data-bs-target="#order" type="button">
                                    <i class="fas fa-shopping-bag"></i> <b>Pedidos</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light" id="2-tab" data-bs-toggle="tab"
                                    data-bs-target="#wishlist" type="button">
                                    <i class="fas fa-heart"></i> <b>Wishlist</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light @if ((isset($activeTab) && $activeTab == 6) || (isset($_GET['activeTab']) && $_GET['activeTab'] == 6)) active @endif"
                                    id="3-tab" data-bs-toggle="tab" data-bs-target="#save" type="button">
                                    <i class="fas fa-map-marker-alt"></i> <b>Endereços salvos</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light" id="4-tab" data-bs-toggle="tab"
                                    data-bs-target="#pay" type="button">
                                    <i class="fas fa-credit-card"></i> <b>Pagamento</b>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab"
                                    data-bs-target="#security" type="button">
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

                            <div class="tab-pane fade" id="wishlist">
                                <div class="box-head mb-3">
                                    <h3>Minha Lista de Desejos</h3>
                                </div>
                                <div class="table-container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Imagem</th>
                                                <th scope="col">ID do Pedido</th>
                                                <th scope="col">Detalhes do Produto</th>
                                                <th scope="col">Preço</th>
                                                <th scope="col">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="details.php">
                                                        <img src="assets/images/fashion/product/front/1.jpg"
                                                            class="img-fluid rounded"
                                                            style="width: 60px; height: 60px; object-fit: cover;"
                                                            alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="m-0 fw-bold">#125021</p>
                                                </td>
                                                <td>
                                                    <p class="fs-6 m-0">Outwear & Coats</p>
                                                </td>
                                                <td>
                                                    <p class="theme-color fs-6 fw-bold">$49.54</p>
                                                </td>
                                                <td>
                                                    <a href="cart.php" class="btn btn-solid-default btn-sm fw-bold">
                                                        <i class="fas fa-shopping-cart"></i> Mover para Carrinho
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="details.php">
                                                        <img src="assets/images/fashion/product/front/2.jpg"
                                                            class="img-fluid rounded"
                                                            style="width: 60px; height: 60px; object-fit: cover;"
                                                            alt="">
                                                    </a>
                                                </td>
                                                <td>
                                                    <p class="m-0 fw-bold">#125367</p>
                                                </td>
                                                <td>
                                                    <p class="fs-6 m-0">Outwear & Coats</p>
                                                </td>
                                                <td>
                                                    <p class="theme-color fs-6 fw-bold">$49.54</p>
                                                </td>
                                                <td>
                                                    <a href="cart.php" class="btn btn-solid-default btn-sm fw-bold">
                                                        <i class="fas fa-shopping-cart"></i> Mover para Carrinho
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 6) show active @endif @endisset"
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

                            <div class="tab-pane fade" id="pay">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3>Cartões & Pagamento</h3>
                                    <button class="btn btn-solid-default" data-bs-toggle="modal"
                                        data-bs-target="#addPayment">
                                        <i class="fas fa-plus"></i> Adicionar Novo Cartão
                                    </button>
                                </div>

                                <div class="address-grid">
                                    <div class="info-card">
                                        <div class="card-details"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1.5rem; border-radius: 12px; margin-bottom: 1rem;">
                                            <div class="card-number mb-3">
                                                <h4>XXXX - XXXX - XXXX - 2548</h4>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <small>VÁLIDO ATÉ</small>
                                                    <h5>12/23</h5>
                                                </div>
                                                <div>
                                                    <h6>mark jecno</h6>
                                                    <span class="badge bg-light text-dark">Primário</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline flex-fill">
                                                <i class="far fa-edit"></i> Editar
                                            </button>
                                            <button class="btn btn-outline text-danger border-danger">
                                                <i class="far fa-trash-alt"></i> Deletar
                                            </button>
                                        </div>
                                    </div>
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

                                    <button class="btn btn-danger mt-3" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">
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
                                            <a href="" class="btn btn-outline">
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
