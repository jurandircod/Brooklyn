<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/site/cart/customize.css') }}">
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



                                            <span class="size-badge"
                                                data-size-selected="{{ $item->tamanho }}">{{ $item->tamanho }}</span>



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
                                        <input type="hidden" data-categoria-id="{{ $item->produto->categoria->id }}" name="categoria_id" id="categoria_id" value="{{ $item->produto->categoria->id }}">

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
                                <a href="{{route('site.carrinho.limpaCarrinho')}}" class="btn-clear-all">
                                    <i class="fas fa-trash-alt me-2"></i>
                                    Limpar todos os itens
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 order-md-1">
                            <a href="/" class="btn-continue">
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
                                        <h6>Subtotal <span id="subtotal">R$
                                                {{ number_format($preco_total, 2, ',', '.') }}</span></h6>
                                        <h6>Taxa de Entrega <span id="taxaFrete">R$ 0,00</span></h6>
                                        <h6>Total <span id="preco_total">R$
                                                {{ number_format($preco_total, 2, ',', '.') }}</span></h6>
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
                const input = row.querySelector('[name="categoria_id"]');
                const categoriaId = input.value;
                console.log(categoriaId);
                // Validação básica
                if (newQuantity < 1) {
                    this.value = 1;
                    return;
                }

                // Mostra loading
                row.classList.add('updating');

                // Chama a função de atualização
                updateQuantity(itemId, newQuantity, row, this, categoriaId);
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
        function updateQuantity(itemId, quantity, row, inputElement, categoriaId) {
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
                        tamanho: sizeSelected,
                        categoria_id: categoriaId
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
            const taxaFrete = document.querySelector('#taxaFrete');
            taxaFrete.textContent = formatCurrency(data.taxa);
        }
    });
</script>
