<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --primary-color: #6366f1;
        --primary-dark: #4f46e5;
        --secondary-color: #f8fafc;
        --accent-color: #10b981;
        --danger-color: #ef4444;
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --border-color: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        color: var(--text-primary);
    }

    /* Breadcrumb moderna */
    .breadcrumb-section {
        background: white;
        box-shadow: var(--shadow-sm);
        border-bottom: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .circles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        margin: 0;
        padding: 0;
        list-style: none;
        z-index: 1;
    }

    .circles li {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(99, 102, 241, 0.1);
        animation: animate 25s linear infinite;
        bottom: -150px;
        border-radius: 50%;
    }

    .circles li:nth-child(1) {
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
    }

    .circles li:nth-child(2) {
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
    }

    .circles li:nth-child(3) {
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
    }

    .circles li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
    }

    .circles li:nth-child(5) {
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
    }

    .circles li:nth-child(6) {
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
    }

    .circles li:nth-child(7) {
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
    }

    .circles li:nth-child(8) {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
    }

    .circles li:nth-child(9) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
    }

    .circles li:nth-child(10) {
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
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

    .breadcrumb-section h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "→";
        color: var(--primary-color);
        font-weight: 600;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-item.active {
        color: var(--text-secondary);
        font-weight: 500;
    }

    /* Container principal */
    .cart-section {
        padding: 3rem 0;
    }

    /* Card do carrinho */
    .cart-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .cart-header {
        background: var(--gradient-primary);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .cart-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .cart-header .cart-icon {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.75rem;
        border-radius: 50%;
        backdrop-filter: blur(10px);
    }

    /* Tabela responsiva */
    .table-responsive {
        border-radius: 0;
        border: none;
    }

    .cart-table {
        margin: 0;
        border: none;
    }

    .cart-table thead th {
        background: #f8fafc;
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        color: var(--text-primary);
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .cart-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .cart-table tbody tr:hover {
        background: rgba(99, 102, 241, 0.02);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .cart-table tbody td {
        padding: 1.5rem 1rem;
        vertical-align: middle;
        border: none;
    }

    /* Imagem do produto */
    .product-image {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: var(--shadow-md);
        transition: transform 0.3s ease;
        border: 2px solid rgba(99, 102, 241, 0.1);
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    /* Nome do produto */
    .product-name {
        font-weight: 600;
        color: var(--text-primary);
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .product-name:hover {
        color: var(--primary-color);
    }

    /* Preço */
    .price {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--accent-color);
        margin: 0;
    }

    /* Tamanho */
    .size-badge {
        background: var(--gradient-primary);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-block;
        box-shadow: var(--shadow-sm);
    }

    /* Quantidade */
    .qty-box {
        max-width: 120px;
        margin: 0 auto;
    }

    .qty-box .form-control {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        text-align: center;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.75rem;
        transition: all 0.3s ease;
        background: white;
    }

    .qty-box .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Botão remover */
    .remove-item {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        cursor: pointer;
        text-decoration: none;
    }

    .remove-item:hover {
        transform: scale(1.1);
        box-shadow: var(--shadow-md);
        color: white;
    }

    .remove-item:active {
        transform: scale(0.95);
    }

    /* Seção de checkout */
    .cart-checkout-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid var(--border-color);
    }

    .cart-box {
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .cart-box-details {
        padding: 0;
    }

    .total-details {
        padding: 2rem;
    }

    .top-details h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        text-align: center;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--border-color);
    }

    .top-details h6 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-secondary);
        padding: 0.75rem 0;
    }

    .top-details h6:last-of-type {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        border-top: 2px solid var(--border-color);
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .top-details h6 span {
        font-weight: 700;
        color: var(--accent-color);
    }

    .bottom-details {
        margin-top: 2rem;
    }

    .bottom-details a {
        display: block;
        background: var(--gradient-primary);
        color: white;
        text-decoration: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .bottom-details a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .bottom-details a:hover::before {
        left: 100%;
    }

    .bottom-details a:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    /* Botões de ação */
    .action-buttons {
        background: rgba(248, 250, 252, 0.8);
        padding: 2rem;
        border-radius: 20px;
        margin-top: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .btn-clear-all {
        color: var(--danger-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        display: inline-block;
    }

    .btn-clear-all:hover {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        transform: translateY(-1px);
    }

    .btn-continue {
        background: var(--gradient-success);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-continue:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        color: white;
    }

    /* Estados de loading */
    tr.updating {
        opacity: 0.7;
        position: relative;
    }

    tr.updating::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        z-index: 10;
        backdrop-filter: blur(2px);
    }

    tr.updating::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 32px;
        height: 32px;
        margin: -16px 0 0 -16px;
        border: 3px solid #e5e7eb;
        border-top: 3px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        z-index: 11;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .cart-section {
            padding: 1.5rem 0;
        }

        .cart-header {
            padding: 1.5rem 1rem;
        }

        .cart-header h2 {
            font-size: 1.5rem;
        }

        .total-details {
            padding: 1.5rem;
        }

        .action-buttons {
            padding: 1.5rem;
        }

        .mobile-cart-content {
            display: block !important;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .product-image {
            width: 60px;
            height: 60px;
        }

        .cart-table thead {
            display: none;
        }

        .cart-table tbody tr {
            display: block;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            background: white;
            box-shadow: var(--shadow-sm);
        }

        .cart-table tbody td {
            display: block;
            padding: 0.5rem 0;
            border: none;
            text-align: left !important;
        }

        .cart-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--text-secondary);
            display: block;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
    }

    /* Animações suaves */
    * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Efeito de hover na tabela */


    .cart-table tbody tr:hover::before {
        height: 100%;
    }

    .cart-table tbody tr {
        position: relative;
    }

    /* Badge para mobile */
    .mobile-badge {
        background: var(--primary-color);
        color: white;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    /* Empty state (para quando não há itens) */
    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-cart i {
        font-size: 4rem;
        color: var(--border-color);
        margin-bottom: 1rem;
    }

    .empty-cart h3 {
        color: var(--text-primary);
        margin-bottom: 1rem;
    }
</style>
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Carrinho</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cart-card">
                    <div class="cart-header">
                        <h2>
                            <span class="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            Seus Produtos
                        </h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Tamanho</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itens as $item)
                                    <tr>
                                        <!-- Imagem do produto -->
                                        <td data-label="Imagem">
                                            <a href="{{ route('site.produto', ['id' => $item->produto->id]) }}">
                                                <img src="{{ $item->produto->imagem_url }}"
                                                    class="product-image blur-up lazyloaded" alt="">
                                            </a>
                                        </td>
                                        <!-- Nome do produto -->
                                        <td data-label="Produto">
                                            <a href="../product/details.html"
                                                class="product-name">{{ $item->produto->nome }}</a>
                                            <div class="mobile-cart-content row d-md-none">
                                                <div class="col">
                                                    <span class="mobile-badge">Quantidade</span>
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <span class="mobile-badge">Preço</span>
                                                    <h2 class="price">R$18</h2>
                                                </div>
                                                <div class="col">
                                                    <span class="mobile-badge">Remover</span>
                                                    <a href="javascript:void(0)" class="remove-item">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Preço -->
                                        <td data-label="Preço">
                                            <h2 class="price">R${{ $item->preco_unitario }}</h2>
                                        </td>
                                        <!-- Tamanho -->
                                        <td data-label="Tamanho">
                                            <!-- pega o tamnho e envia pro backend-->
                                            @if ($item->tamanho == 'P')
                                                <span class="size-badge" data-size-selected="P">P</span>
                                            @elseif ($item->tamanho == 'M')
                                                <span class="size-badge" data-size-selected="M">M</span>
                                            @elseif ($item->tamanho == 'G')
                                                <span class="size-badge" data-size-selected="G">G</span>
                                            @elseif ($item->tamanho == 'GG')
                                                <span class="size-badge" data-size-selected="GG">GG</span>
                                            @elseif ($item->tamanho == '775')
                                                <span class="size-badge" data-size-selected="775">7.75</span>
                                            @elseif ($item->tamanho == '8')
                                                <span class="size-badge" data-size-selected="8">8</span>
                                            @elseif ($item->tamanho == '825')
                                                <span class="size-badge" data-size-selected="825">8.25</span>
                                            @elseif ($item->tamanho == '85')
                                                <span class="size-badge" data-size-selected="85">8.5</span>
                                            @else
                                                <span class="size-badge">Produto Padrão</span>
                                                <span class="size-badge" hidden
                                                    data-size-selected="quantidade">quantidade</span>
                                            @endif
                                        </td>
                                        <!-- Quantidade -->
                                        <td data-label="Quantidade">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="quantity"
                                                        data-item-id="{{ $item->id }}"
                                                        class="form-control input-number"
                                                        value="{{ $item->quantidade }}" min="1">
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Preço total -->
                                        <td data-label="Total">
                                            <h2 class="price td-color">{{ $item->preco_total }}</h2>
                                        </td>
                                        <td data-label="Ação">
                                            <a href="javascript:void(0)" class="remove-item"
                                                data-item-id="{{ $item->id }}">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="action-buttons">
                    <div class="row align-items-center">
                        <div class="col-md-6 order-md-2 mb-3 mb-md-0">
                            <div class="text-md-end">
                                <a href="javascript:void(0)" class="btn-clear-all">
                                    <i class="fas fa-trash-alt me-2"></i>
                                    Limpar todos os itens
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <a href="../shop.html" class="btn-continue">
                                <i class="fas fa-arrow-left"></i>
                                Continue No shop
                            </a>
                        </div>
                    </div>
                </div>

                <div class="cart-checkout-section">
                    <div class="row justify-content-end">
                        <div class="col-lg-5 col-xl-4">
                            <div class="cart-box">
                                <div class="cart-box-details">
                                    <div class="total-details">
                                        <h3>
                                            <i class="fas fa-calculator me-2"></i>
                                            Resumo do Pedido
                                        </h3>
                                        <h6>Subtotal <span id="subtotal">R$ {{ number_format($preco_total, 2, ',', '.') }}</span></h6>
                                        <h6>Taxa de Entrega <span>R$ 0,00</span></h6>
                                        <h6>Total <span id="preco_total">R$ {{ number_format($preco_total, 2, ',', '.') }}</span></h6>
                                        <div class="bottom-details">
                                            <a href="{{ route('site.fazerPedido') }}">
                                                <i class="fas fa-credit-card me-2"></i>
                                                Processar pagamento
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleciona todos os inputs de quantidade
        const quantityInputs = document.querySelectorAll('input[name="quantity"]');

        // Adiciona evento de change a cada input
        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const row = this.closest('tr');
                const itemId = this.getAttribute('data-item-id');
                const newQuantity = this.value;

                // Validação básica
                if (newQuantity < 1) {
                    this.value = 1;
                    return;
                }

                // Mostra loading
                row.classList.add('updating');

                // Chama a função de atualização
                updateQuantity(itemId, newQuantity, row, this);
            });
        });

        // Adiciona evento de clique para os botões de remover
        document.querySelector('tbody').addEventListener('click', function(e) {
            if (e.target.closest('.remove-item')) {
                const removeBtn = e.target.closest('.remove-item');
                const itemId = removeBtn.getAttribute('data-item-id');
                const row = removeBtn.closest('tr');

                removeItem(itemId, row);
            }
        });

        // Função para atualizar quantidade via AJAX
        function updateQuantity(itemId, quantity, row, inputElement) {
            // Obtém o token CSRF de forma segura
            const csrfToken = getCsrfToken();
            const sizeSelected = row.querySelector('[data-size-selected]').textContent.trim();
            if (!csrfToken) {
                console.error('CSRF token não encontrado');
                row.classList.remove('updating');
                inputElement.value = inputElement.defaultValue;
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Erro de segurança. Por favor, recarregue a página.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            fetch('{{ route('carrinho.atualizar-quantidade') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        quantidade: quantity,
                        tamanho: sizeSelected
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na resposta do servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        // Atualiza a linha (preço total está na coluna 6)
                        const totalCell = row.querySelector('td:nth-child(6) h2');
                        if (totalCell) {
                            totalCell.textContent = formatCurrency(data.item_total);
                        }

                        // Atualiza os totais do carrinho
                        updateCartTotals(data);

                        // Atualiza o valor padrão para futuras reversões
                        inputElement.defaultValue = quantity;

                        // Mostra notificação de sucesso
                        Toastify({
                            text: 'Item atualizado com sucesso!',
                            duration: 3000,
                            gravity: "bottom",
                            position: "right",
                            backgroundColor: "#4CAF50",
                            stopOnFocus: true
                        }).showToast();
                    } else {
                        throw new Error(data.message || 'Erro ao atualizar quantidade');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: error.message,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 5000,
                        timerProgressBar: true
                    });
                    inputElement.value = inputElement.defaultValue;
                })
                .finally(() => {
                    row.classList.remove('updating');
                });
        }

        // Função para remover item do carrinho
        function removeItem(itemId, row) {
            // Mostra loading
            row.classList.add('updating');
            const sizeSelected = row.querySelector('[data-size-selected]').textContent.trim();
            // Obtém o token CSRF
            const csrfToken = getCsrfToken();

            if (!csrfToken) {
                console.error('CSRF token não encontrado');
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Erro de segurança. Por favor, recarregue a página.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return;
            }

            fetch('{{ route('carrinho.remover-item') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        item_id: itemId,
                        tamanho: sizeSelected
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na resposta do servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        // Aplica animação de fade-out antes de remover
                        row.style.transition = 'opacity 0.5s ease';
                        row.style.opacity = '0';
                        setTimeout(() => {
                            row.remove();
                            // Atualiza os totais do carrinho
                            updateCartTotals(data);
                            // Atualiza o contador de itens no cabeçalho (se existir)
                            updateCartCounter(data.quantidade_itens);
                            // Mostra mensagem de sucesso com SweetAlert2
                            Swal.fire({
                                icon: 'success',
                                title: 'Sucesso',
                                text: 'Item removido do carrinho com sucesso!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }, 500);
                    } else {
                        throw new Error(data.message || 'Erro ao remover item');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: error.message,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        timer: 5000,
                        timerProgressBar: true
                    });
                })
                .finally(() => {
                    row.classList.remove('updating');
                });
        }

        // Função auxiliar para atualizar contador de itens
        function updateCartCounter(count) {
            const counterElements = document.querySelectorAll('.cart-count');
            counterElements.forEach(el => {
                el.textContent = count;
            });
        }

        // Função auxiliar para obter o token CSRF
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]')?.value;
        }

        // Função para formatar valores monetários
        function formatCurrency(value) {
            const number = parseFloat(value.replace(/[^0-9,]/g, '').replace(',', '.'));
            if (isNaN(number)) {
                return 'R$ 0,00';
            }
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(number);
        }

        // Função para atualizar os totais do carrinho
        function updateCartTotals(data) {
            console.log('data.total:', data.total);
            const subTotal = document.querySelector('#subtotal');
            subTotal.textContent = formatCurrency(data.subtotal);
            const preco_total = document.querySelector('#preco_total');
            preco_total.textContent = formatCurrency(data.total);
        }
    });
</script>
