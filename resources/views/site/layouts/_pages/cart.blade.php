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
            <div class="col-md-12 text-center">
                <table class="table cart-table">
                    <thead>
                        <tr class="table-head">
                            <th scope="col">image</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">total</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itens as $item)
                            <tr>
                                <!-- Imagem do produto -->
                                <td>
                                    <a href="{{ route('site.produto', ['id' => $item->produto->id]) }}">
                                        <img src="{{ $item->produto->imagem_url }}" class="blur-up lazyloaded"
                                            alt="">
                                    </a>
                                </td>
                                <!-- Nome do produto -->
                                <td>
                                    <a href="../product/details.html">{{ $item->produto->nome }}</a>
                                    <div class="mobile-cart-content row">
                                        <div class="col">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="text" name="quantity"
                                                        class="form-control input-number" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2>R$18</h2>
                                        </div>
                                        <div class="col">
                                            <h2 class="td-color">
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <!-- Preço -->
                                <td>
                                    <h2>R${{ $item->preco_unitario }}</h2>
                                </td>
                                <!-- Tamanho -->
                                <td>
                                    <!-- pega o tamnho e envia pro backend-->
                                    @if ($item->tamanho == 'P')
                                        <h2 data-size-selected="P">P</h2>
                                    @elseif ($item->tamanho == 'M')
                                        <h2 data-size-selected="M">M</h2>
                                    @elseif ($item->tamanho == 'G')
                                        <h2 data-size-selected="G">G</h2>
                                    @elseif ($item->tamanho == 'GG')
                                        <h2 data-size-selected="GG">GG</h2>
                                    @elseif ($item->tamanho == '775')
                                        <h2 data-size-selected="775">7.75</h2>
                                    @elseif ($item->tamanho == '8')
                                        <h2 data-size-selected="8">8</h2>
                                    @elseif ($item->tamanho == '825')
                                        <h2 data-size-selected="825">8.25</h2>
                                    @elseif ($item->tamanho == '85')
                                        <h2 data-size-selected="85">8.5</h2>
                                    @else
                                        <h2>Produto Padrão</h2>
                                        <h2 hidden data-size-selected="quantidade">quantidade</h2>
                                    @endif

                                </td>
                                <!-- Quantidade -->
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" name="quantity" data-item-id="{{ $item->id }}"
                                                class="form-control input-number" value="{{ $item->quantidade }}"
                                                min="1">
                                        </div>
                                    </div>
                                </td>
                                <!-- Preço total -->
                                <td>
                                    <h2 class="td-color">{{ $item->preco_total }}</h2>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="remove-item" data-item-id="{{ $item->id }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="col-12 mt-md-5 mt-4">
                <div class="row">
                    <div class="col-sm-7 col-5 order-1">
                        <div class="left-side-button text-end d-flex d-block justify-content-end">
                            <a href="javascript:void(0)"
                                class="text-decoration-underline theme-color d-block text-capitalize">Limpar todos os
                                itens</a>
                        </div>
                    </div>
                    <div class="col-sm-5 col-7">
                        <div class="left-side-button float-start">
                            <a href="../shop.html" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                <i class="fas fa-arrow-left"></i>Continue No shop</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-checkout-section">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        <div class="promo-section">
                            <form class="row g-3">
                                <div class="col-7">
                                    <input type="text" class="form-control" id="number" placeholder="Coupon Code">
                                </div>
                                <div class="col-5">
                                    <button class="btn btn-solid-default rounded btn">Aplicar cupom</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 ">
                        <div class="checkout-button">
                            <a href="checkout" class="btn btn-solid-default btn fw-bold">
                                Checar <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-box">
                            <div class="cart-box-details">
                                <div class="total-details">
                                    <div class="top-details">
                                        <h3>Total</h3>
                                        <h6>Subtotal <span>R$</span></h6>
                                        <h6>Taxa <span>R$</span></h6>
                                        <h6>Total <span>$</span></h6>
                                    </div>
                                    <div class="bottom-details">
                                        <a href="{{ route('site.fazerPedido') }}">Processar pagamento</a>
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
            const subtotalElement = document.querySelector('.top-details h6:nth-child(2) span');
            const taxElement = document.querySelector('.top-details h6:nth-child(3) span');
            const totalElement = document.querySelector('.top-details h6:nth-child(4) span');

            if (subtotalElement) subtotalElement.textContent = formatCurrency(data.subtotal);
            if (taxElement) taxElement.textContent = formatCurrency(data.taxa);
            if (totalElement) totalElement.textContent = formatCurrency(data.total);
        }
    });
</script>

<style>
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
        background: rgba(255, 255, 255, 0.7);
        z-index: 10;
    }

    tr.updating td {
        position: relative;
    }

    tr.updating::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
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

    .remove-item {
        color: #dc3545;
        cursor: pointer;
        transition: color 0.3s;
    }

    .remove-item:hover {
        color: #a71d2a;
    }

    /* Mantém o estilo de loading da implementação anterior */
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
        background: rgba(255, 255, 255, 0.7);
        z-index: 10;
    }
</style>
