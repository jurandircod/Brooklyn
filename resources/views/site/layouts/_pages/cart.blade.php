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
                                    <a href="{{ asset('product/details.html') }}">
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
                                    <h2 id="selected-size-cart">{{ $item->tamanho }}</h2>
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
                                        <a href="checkout">Processar pagamento</a>
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



        // Função para atualizar quantidade via AJAX
        function updateQuantity(itemId, quantity, row, inputElement) {
            // Obtém o token CSRF de forma segura
            const csrfToken = getCsrfToken();
            const sizeSelected = document.getElementById('selected-size-cart').textContent;
            if (!csrfToken) {
                console.error('CSRF token não encontrado');
                row.classList.remove('updating');
                inputElement.value = inputElement.defaultValue;
                alert('Erro de segurança. Por favor, recarregue a página.');
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


                        // Atualiza a linha
                        const totalCell = row.querySelector('td:nth-child(5) h2');
                        if (totalCell) {
                            totalCell.textContent = 'R$' + data.item_total;
                        }

                        // Atualiza os totais do carrinho
                        updateCartTotals(data);

                        // Atualiza o valor padrão para futuras reversões
                        inputElement.defaultValue = quantity;
                    } else {
                        throw new Error(data.message || 'Erro ao atualizar quantidade');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(error.message);
                    inputElement.value = inputElement.defaultValue;
                })
                .finally(() => {
                    row.classList.remove('updating');
                });
        }



        // Função auxiliar para obter o token CSRF
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]')?.value;
        }

        // Função para atualizar os totais do carrinho
        function updateCartTotals(data) {
            const subtotalElement = document.querySelector('.top-details h6:nth-child(2) span');
            const taxElement = document.querySelector('.top-details h6:nth-child(3) span');
            const totalElement = document.querySelector('.top-details h6:nth-child(4) span');

            if (subtotalElement) subtotalElement.textContent = 'R$' + data.subtotal;
            if (taxElement) taxElement.textContent = 'R$' + data.taxa;
            if (totalElement) totalElement.textContent = 'R$' + data.total;
        }

    });


    // Adiciona evento de clique para os botões de remover
    document.addEventListener('DOMContentLoaded', function() {
        // Delegação de eventos para lidar com elementos dinâmicos
        document.querySelector('tbody').addEventListener('click', function(e) {
            if (e.target.closest('.remove-item')) {
                const removeBtn = e.target.closest('.remove-item');
                const itemId = removeBtn.getAttribute('data-item-id');
                const row = removeBtn.closest('tr');

                removeItem(itemId, row);
            }
        });
    });

    function removeItem(itemId, row) {
        // Mostra loading
        row.classList.add('updating');
        const sizeSelected = document.getElementById('selected-size-cart').textContent;
        // Obtém o token CSRF
        const csrfToken = getCsrfToken();

        if (!csrfToken) {
            console.error('CSRF token não encontrado');
            alert('Erro de segurança. Por favor, recarregue a página.');
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
                    // Remove a linha da tabela
                    row.remove();

                    // Atualiza os totais do carrinho
                    updateCartTotals(data);

                    // Atualiza o contador de itens no cabeçalho (se existir)
                    updateCartCounter(data.quantidade_itens);

                    // Mostra mensagem de sucesso
                    showAlert('Item removido do carrinho', 'success');
                } else {
                    throw new Error(data.message || 'Erro ao remover item');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert(error.message, 'error');
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

    // Função para mostrar alertas
    function showAlert(message, type) {
        // Você pode implementar um sistema de notificação mais sofisticado aqui
        alert(message);
    }

    // Função para atualizar totais (reutilizada da implementação anterior)
    function updateCartTotals(data) {
        const subtotalElement = document.querySelector('.top-details h6:nth-child(2) span');
        const taxElement = document.querySelector('.top-details h6:nth-child(3) span');
        const totalElement = document.querySelector('.top-details h6:nth-child(4) span');

        if (subtotalElement) subtotalElement.textContent = 'R$' + data.subtotal;
        if (taxElement) taxElement.textContent = 'R$' + data.taxa;
        if (totalElement) totalElement.textContent = 'R$' + data.total;
    }

    // Função para obter CSRF token (reutilizada da implementação anterior)
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.content ||
            document.querySelector('input[name="_token"]')?.value;
    }
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
