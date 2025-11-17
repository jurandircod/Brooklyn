<link rel="stylesheet" href="{{ asset('css/site/fazerPedido/customize.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<section class="py-10 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      <!-- FORM (esquerda) -->
      <div class="lg:col-span-8">
        <form class="needs-validation space-y-6" method="POST" action="{{ route('site.carrinho.finalizarCarrinho') }}">
          @csrf

          <div class="bg-white border border-[#4A1C1D]/10 rounded-2xl p-5 shadow-sm">
            <h3 class="text-center text-xl font-semibold text-[#4A1C1D] mb-4 flex items-center justify-center gap-3">
              <i class="fas fa-map-marker-alt text-[#6f2e2f]"></i>
              Escolha um endereço para receber seu pedido
            </h3>

            <div id="enderecos-container" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
              <!-- Simulando endereços -->
              @foreach ($enderecos as $endereco)
                <div class="col">
                  <div class="save-details rounded-lg p-4 border border-gray-200 hover:shadow-md transition cursor-pointer h-full flex flex-col justify-between"
                       data-endereco="{{ $endereco->id }}">
                    <div>
                      <div class="save-name mb-2">
                        <h5 class="text-lg font-semibold text-gray-800">{{ $endereco->cidade }}</h5>
                      </div>
                      <div class="save-address text-sm text-gray-600 space-y-1">
                        <p><span class="font-medium text-gray-700">Bairro:</span> {{ $endereco->bairro }}</p>
                        <p><span class="font-medium text-gray-700">Número:</span> {{ $endereco->numero }}</p>
                        <p><span class="font-medium text-gray-700">Cidade:</span> {{ $endereco->cidade }}</p>
                        <p><span class="font-medium text-gray-700">Estado:</span> {{ $endereco->estado }}</p>
                        <p><span class="font-medium text-gray-700">CEP:</span> {{ $endereco->cep }}</p>
                      </div>
                      <div class="mobile mt-2 text-sm text-gray-600">
                        <p><span class="font-medium text-gray-700">Telefone:</span> {{ $endereco->telefone }}</p>
                      </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                      <div class="address-checkbox flex items-center gap-2">
                        <input type="radio" id="endereco{{ $endereco->id }}" name="endereco_id" value="{{ $endereco->id }}" class="h-4 w-4 text-[#4A1C1D]">
                        <label for="endereco{{ $endereco->id }}" class="checkbox-custom text-sm text-gray-700 select-none">
                          Selecionar endereço
                        </label>
                      </div>

                      <!-- visual indicator quando a save-details tiver .selected (JS adiciona) -->
                      <span class="text-xs font-semibold px-2 py-1 rounded-full border border-[#4A1C1D]/20 text-[#4A1C1D]">Enviar</span>
                    </div>
                  </div>
                </div>
              @endforeach

              @error('endereco_id')
                <div class="col-span-full">
                  <div class="rounded-md bg-red-50 p-3 text-red-700">
                    <strong>Erro!</strong> {{ $message }}
                  </div>
                </div>
              @enderror
            </div>

            <div class="text-center mt-6">
              <a href="{{ route('site.perfil.exibirEndereco') }}" target="_blank"
                 class="inline-flex items-center gap-2 bg-[#4A1C1D] text-white px-4 py-2 rounded-md shadow hover:bg-[#6f2e2f] transition">
                <i class="fas fa-plus"></i> Adicionar novo endereço
              </a>
            </div>
          </div>

          <hr class="border-t my-6 border-gray-200">

          <!-- Payment -->
          <div class="bg-white border border-[#4A1C1D]/10 rounded-2xl p-5 shadow-sm">
            <h3 class="text-xl font-semibold text-[#4A1C1D] mb-4 flex items-center gap-3">
              <i class="fas fa-credit-card text-[#6f2e2f]"></i>
              Tipo de pagamento
            </h3>

            <div class="space-y-3">
              <div class="custome-radio-box flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:shadow-sm transition" data-payment="pix">
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="pix" id="pix">
                <label class="flex items-center gap-2 cursor-pointer text-gray-700" for="pix">
                  <i class="fab fa-pix text-[#32BCAD] text-xl"></i>
                  <span class="text-sm">PIX - Pagamento instantâneo</span>
                </label>
              </div>

              <div class="custome-radio-box flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:shadow-sm transition" data-payment="credit">
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="credit" id="credit">
                <label class="flex items-center gap-2 cursor-pointer text-gray-700" for="credit">
                  <i class="fas fa-credit-card text-[#4A90E2] text-xl"></i>
                  <span class="text-sm">Cartão de Crédito</span>
                </label>
              </div>

              <div class="custome-radio-box flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:shadow-sm transition" data-payment="debit">
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="debit" id="debit">
                <label class="flex items-center gap-2 cursor-pointer text-gray-700" for="debit">
                  <i class="fas fa-credit-card text-[#E94B3C] text-xl"></i>
                  <span class="text-sm">Cartão de Débito</span>
                </label>
              </div>
            </div>

            <!-- Campos do cartão (visibilidade controlada pelo seu JS) -->
            <div id="card-fields" class="fade-in mt-4" style="display: none;">
              <h5 class="mb-3 text-gray-800 flex items-center gap-2">
                <i class="fas fa-lock text-[#6f2e2f]"></i> Dados do Cartão
              </h5>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="md:col-span-2">
                  <label for="cc-name" class="block mb-1 text-sm text-gray-700">Nome no cartão</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-name" placeholder="Nome completo como está no cartão">
                </div>

                <div class="md:col-span-2">
                  <label for="cc-number" class="block mb-1 text-sm text-gray-700">Número do cartão</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-number" placeholder="1234 5678 9012 3456">
                </div>

                <div>
                  <label for="expiration" class="block mb-1 text-sm text-gray-700">Validade</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="expiration" placeholder="MM/AA">
                </div>

                <div>
                  <label for="cc-cvv" class="block mb-1 text-sm text-gray-700">CVV</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-cvv" placeholder="123">
                </div>
              </div>

              <div id="parcelas-section" class="parcelas-select mt-4" style="display: none;">
                <label for="parcelas" class="block mb-2 text-sm text-gray-700 flex items-center gap-2">
                  <i class="fas fa-calendar-alt text-[#6f2e2f]"></i> Número de parcelas
                </label>
                <select class="form-select w-full rounded-md border border-gray-300 px-3 py-2" id="parcelas" name="parcelas">
                  <option value="1">1x de R$ 150,00 (à vista)</option>
                  <option value="2">2x de R$ 75,00</option>
                  <option value="3">3x de R$ 50,00</option>
                  <option value="4">4x de R$ 37,50</option>
                  <option value="5">5x de R$ 30,00</option>
                  <option value="6">6x de R$ 25,00</option>
                  <option value="10">10x de R$ 15,00</option>
                  <option value="12">12x de R$ 12,50</option>
                </select>
              </div>
            </div>
          </div>

          @error('metodo_pagamento')
            <div class="rounded-md bg-red-50 p-3 text-red-700">
              <strong>Erro!</strong> {{ $message }}
            </div>
          @enderror

          <input type="hidden" name="valor" value="{{ $preco_total }}">

          <div class="text-center">
            <button class="inline-flex items-center gap-2 bg-[#4A1C1D] text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-[#6f2e2f] transition" type="submit" style="padding: 15px 40px;">
              <i class="fas fa-lock"></i> Processar pagamento
            </button>
          </div>
        </form>
      </div>

      <!-- SIDEBAR (direita) -->
      <div class="lg:col-span-4">
        <div class="your-cart-box bg-white border border-[#4A1C1D]/10 rounded-2xl p-5 shadow-sm">
          <h3 class="mb-3 flex items-center gap-3 text-lg font-semibold text-[#4A1C1D]">
            <i class="fas fa-shopping-cart text-[#6f2e2f]"></i>
            Seu carrinho
            <span class="ml-auto inline-flex items-center px-2 py-1 rounded-full bg-[#4A1C1D]/10 text-[#4A1C1D] text-sm">3</span>
          </h3>

          <ul class="divide-y divide-gray-200 mb-3">
            @foreach ($itens as $item)
              <li class="py-3 flex justify-between items-start">
                <div class="text-gray-800">
                  <h6 class="font-medium">{{ $item->produto_nome }}</h6>
                  <small class="text-gray-500">Quantidade: {{ $item->quantidade }} | Preço unitário: R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</small>
                </div>
                <div class="text-gray-800 font-semibold">
                  R$ {{ number_format($item->preco_total, 2, ',', '.') }}
                </div>
              </li>
            @endforeach

            <li class="py-3 flex justify-between items-center bg-[#4A1C1D] text-white rounded-md px-3 mt-3">
              <div>
                <h6 class="text-white font-medium">Preço total</h6>
              </div>
              <div class="font-semibold">R$ {{ number_format($preco_total, 2, ',', '.') }}</div>
            </li>
          </ul>

          <form class="card border-0 hidden">
            <div class="input-group">
              <input type="text" class="form-control rounded-l-md px-3 py-2 border border-gray-300" placeholder="Código promocional">
              <button type="submit" class="bg-[#4A1C1D] text-white px-4 py-2 rounded-r-md">Aplicar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mantive os scripts que controlam o comportamento (sem alterações de lógica) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lógica para seleção única de endereços
    const enderecoRadios = document.querySelectorAll('input[name="endereco_id"]');
    const enderecoBoxes = document.querySelectorAll('.save-details');

    enderecoRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove seleção anterior de todos os boxes
            enderecoBoxes.forEach(box => box.classList.remove('selected'));

            // Adiciona seleção ao endereço atual usando o value do radio
            if (this.checked) {
                const enderecoId = this.value;
                const selectedBox = document.querySelector(
                    `.save-details[data-endereco="${enderecoId}"]`);
                if (selectedBox) {
                    selectedBox.classList.add('selected');
                }
            }
        });
    });

    // Lógica para métodos de pagamento
    const paymentRadios = document.querySelectorAll('input[name="metodo_pagamento"]');
    const paymentBoxes = document.querySelectorAll('.custome-radio-box');
    const cardFields = document.getElementById('card-fields');
    const parcelasSection = document.getElementById('parcelas-section');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove classe active de todos os boxes
            paymentBoxes.forEach(box => box.classList.remove('active'));

            // Adiciona classe active ao box selecionado
            const selectedBox = this.closest('.custome-radio-box');
            if (selectedBox) {
                selectedBox.classList.add('active');
            }

            // Controla exibição dos campos de cartão
            if (this.value === 'pix') {
                if (cardFields) cardFields.style.display = 'none';
                if (parcelasSection) parcelasSection.style.display = 'none';
            } else if (this.value === 'credit') {
                if (cardFields) {
                    cardFields.style.display = 'block';
                    cardFields.classList.add('fade-in');
                }
                if (parcelasSection) parcelasSection.style.display = 'block';
            } else if (this.value === 'debit') {
                if (cardFields) {
                    cardFields.style.display = 'block';
                    cardFields.classList.add('fade-in');
                }
                if (parcelasSection) parcelasSection.style.display = 'none';
            }
        });
    });

    // Máscara para número do cartão
    const cardNumberInput = document.getElementById('cc-number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function() {
            let value = this.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            this.value = formattedValue;
        });
    }

    // Máscara para data de validade
    const expirationInput = document.getElementById('expiration');
    if (expirationInput) {
        expirationInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            this.value = value;
        });
    }

    // Máscara para CVV
    const cvvInput = document.getElementById('cc-cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').substring(0, 4);
        });
    }
});

(function() {
    // Animação suave do card-fields via classes
    const cardFields = document.getElementById('card-fields');
    const parcelasSection = document.getElementById('parcelas-section');

    function openCardFields(open) {
        if (!cardFields) return;
        if (open) {
            cardFields.classList.add('open');
            cardFields.style.display = 'block';
        } else {
            cardFields.classList.remove('open');
            // mantemos display block por animação; esconder após transição
            setTimeout(() => {
                if (!cardFields.classList.contains('open')) cardFields.style.display = 'none';
            }, 360);
        }
    }

    // aplica estado inicial se algum radio já estiver marcado (útil quando volta com validação)
    const paymentRadios = document.querySelectorAll('input[name="metodo_pagamento"]');
    paymentRadios.forEach(radio => {
        if (radio.checked) {
            const box = radio.closest('.custome-radio-box');
            if (box) box.classList.add('active');
            if (radio.value === 'credit') {
                openCardFields(true);
                if (parcelasSection) parcelasSection.style.display = 'block';
            } else if (radio.value === 'debit') {
                openCardFields(true);
                if (parcelasSection) parcelasSection.style.display = 'none';
            } else {
                openCardFields(false);
                if (parcelasSection) parcelasSection.style.display = 'none';
            }
        }
    });

    // Quando alterar (comportamento já implementado por você), apenas chamamos openCardFields para animação
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'pix') {
                openCardFields(false);
                if (parcelasSection) parcelasSection.style.display = 'none';
            } else if (this.value === 'credit') {
                openCardFields(true);
                if (parcelasSection) parcelasSection.style.display = 'block';
            } else if (this.value === 'debit') {
                openCardFields(true);
                if (parcelasSection) parcelasSection.style.display = 'none';
            }
        });
    });

    // Permitir selecionar um endereço clicando no cartão inteiro (acessibilidade)
    document.querySelectorAll('.save-details').forEach(box => {
        box.setAttribute('tabindex', '0');
        box.style.cursor = 'pointer';
        box.addEventListener('click', function(e) {
            // evita marcar quando clicar no próprio input por duplicidade
            const enderecoId = this.getAttribute('data-endereco');
            if (!enderecoId) return;
            const radio = document.querySelector(
                `input[name="endereco_id"][value="${enderecoId}"]`);
            if (radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }
        });
        // suporte teclado (Enter/Space)
        box.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
})();
</script>
