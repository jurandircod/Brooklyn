<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/site/cart/customize.css') }}">
<!-- Cart Section Start -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<section class="py-10 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-[#4A1C1D]/20">

            <!-- Cabeçalho -->
            <div class="bg-[#4A1C1D] text-white py-4 px-6 flex items-center space-x-3">
                <i class="fas fa-shopping-cart text-lg"></i>
                <h2 class="text-xl font-semibold">Seus Produtos</h2>
            </div>

            <!-- Tabela responsiva -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                    <thead class="bg-[#4A1C1D]/90 text-white text-sm uppercase">
                        <tr>
                            <th class="py-3 px-4">Imagem</th>
                            <th class="py-3 px-4">Produto</th>
                            <th class="py-3 px-4">Preço</th>
                            <th class="py-3 px-4">Tamanho</th>
                            <th class="py-3 px-4">Quantidade</th>
                            <th class="py-3 px-4">Total</th>
                            <th class="py-3 px-4 text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($itens as $item)
                            <tr class="hover:bg-gray-100 transition-colors">
                                <td class="py-3 px-4">
                                    <a href="{{ route('site.produto', ['id' => $item->produto->id]) }}">
                                        <img src="{{ $item->produto->imagem_url }}" alt=""
                                            class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    </a>
                                </td>

                                <td class="py-3 px-4">
                                    <a href="../product/details.html"
                                        class="text-[#4A1C1D] font-semibold hover:underline">
                                        {{ $item->produto->nome }}
                                    </a>
                                </td>

                                <td class="py-3 px-4">
                                    <span class="font-semibold text-gray-800">R${{ $item->preco_unitario }}</span>
                                </td>

                                <td class="py-3 px-4">
                                    <span data-size-selected="{{ $item->tamanho }}"
                                        class="inline-block bg-[#4A1C1D]/10 text-[#4A1C1D] text-sm font-medium px-3 py-1 rounded-md">
                                        {{ $item->tamanho }}
                                    </span>
                                </td>

                                <td class="py-3 px-4">
                                    <input type="number" name="quantity" data-item-id="{{ $item->id }}"
                                        value="{{ $item->quantidade }}" min="1"
                                        class="w-20 border border-gray-300 rounded-md text-center focus:ring-2 focus:ring-[#4A1C1D] focus:border-[#4A1C1D]">
                                </td>

                                <input type="hidden" data-categoria-id="{{ $item->produto->categoria->id }}"
                                    name="categoria_id" id="categoria_id" value="{{ $item->produto->categoria->id }}">

                                <td class="preco_total py-3 px-4 font-semibold text-gray-800">

                                    R${{ $item->preco_total }}
                                </td>

                                <td class="py-3 px-4 text-center">
                                    <button class="text-red-600 hover:text-red-800 remove-item"
                                        data-item-id="{{ $item->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row justify-between items-center p-6 gap-4 border-t">
                <a href="/" class="flex items-center text-[#4A1C1D] hover:text-[#6f2e2f] font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Continuar comprando
                </a>

                <a href="{{ route('site.carrinho.limpaCarrinho') }}"
                    class="bg-[#4A1C1D] text-white px-4 py-2 rounded-md shadow hover:bg-[#6f2e2f] transition">
                    <i class="fas fa-trash-alt mr-2"></i> Limpar todos os itens
                </a>
            </div>
        </div>

        <!-- Resumo do pedido -->
        <div class="mt-8 flex justify-end">
            <div class="bg-white shadow-lg rounded-2xl p-6 w-full sm:w-96 border border-[#4A1C1D]/20">
                <h3 class="text-lg font-semibold text-[#4A1C1D] mb-4 flex items-center">
                    <i class="fas fa-calculator mr-2"></i> Resumo do Pedido
                </h3>
                <div class="space-y-2 text-gray-700">
                    <div class="flex justify-between"><span>Subtotal</span><span id="subtotal">R$
                            {{ number_format($preco_total, 2, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span>Taxa de Entrega</span><span id="taxaFrete">R$ 0,00</span>
                    </div>
                    <div class="flex justify-between font-semibold text-[#4A1C1D]"><span>Total</span><span
                            id="preco_total2">R$ {{ number_format($preco_total, 2, ',', '.') }}</span></div>
                </div>
                <div class="mt-6">
                    <a href="{{ route('site.fazerPedido') }}"
                        class="block w-full text-center bg-[#4A1C1D] text-white py-3 rounded-md hover:bg-[#6f2e2f] transition">
                        <i class="fas fa-credit-card mr-2"></i> Processar pagamento
                    </a>
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
                        const totalCell = row.querySelector('.preco_total');
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
            const preco_total2 = document.querySelector('#preco_total2');
            preco_total2.textContent = formatCurrency(data.total);
            const taxaFrete = document.querySelector('#taxaFrete');
            taxaFrete.textContent = formatCurrency(data.taxa);
        }
    });
</script>
