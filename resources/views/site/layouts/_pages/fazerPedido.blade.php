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

            <!-- ===========================
                 Estilos específicos para os cards de endereço
                 =========================== -->
            <style>
              /* botão/card */
              .save-details {
                transition: box-shadow .18s ease, transform .12s ease, border-color .18s ease;
                border-radius: 12px;
                background: #fff;
                border: 1px solid rgba(128,128,128,0.06);
                padding: 1rem;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
              }

              .save-details:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 30px rgba(0,0,0,0.06);
                border-color: rgba(74,28,29,0.12);
              }

              .save-details.selected {
                border-color: rgba(74,28,29,0.92);
                box-shadow: 0 14px 40px rgba(74,28,29,0.08);
                background: linear-gradient(180deg, rgba(250,250,250,1) 0%, rgba(255,255,255,1) 100%);
              }

              .save-details .select-badge {
                font-weight: 600;
                font-size: 0.72rem;
                padding: 6px 10px;
                border-radius: 999px;
                border: 1px solid rgba(74,28,29,0.12);
                color: rgba(74,28,29,0.9);
                background: rgba(74,28,29,0.03);
              }

              .save-details.selected .select-badge {
                background: rgba(74,28,29,0.92);
                color: #fff;
                border-color: rgba(74,28,29,0.92);
              }

              /* esconder o radio visualmente mas manter acessível */
              .sr-only {
                position: absolute !important;
                width: 1px !important;
                height: 1px !important;
                padding: 0 !important;
                margin: -1px !important;
                overflow: hidden !important;
                clip: rect(0,0,0,0) !important;
                white-space: nowrap !important;
                border: 0 !important;
              }

              /* foco do cartão para acessibilidade */
              .save-details:focus {
                outline: none;
                box-shadow: 0 0 0 4px rgba(111,46,47,0.12);
              }

              /* ajustes pequenos de texto */
              .save-address p { margin: 0; }
            </style>

            <!-- Container com role radiogroup -->
            <div id="enderecos-container" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4" role="radiogroup" aria-label="Endereços salvos">
              @foreach ($enderecos as $endereco)
                <div class="col">
                  <div
                    class="save-details rounded-lg cursor-pointer"
                    role="radio"
                    tabindex="0"
                    aria-checked="false"
                    data-endereco="{{ $endereco->id }}"
                  >
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
                      <div class="flex items-center gap-3">
                        <!-- radio permanece no DOM para submissão -->
                        <input type="radio" id="endereco{{ $endereco->id }}" name="endereco_id" value="{{ $endereco->id }}" class="sr-only" @if(old('endereco_id') == $endereco->id) checked @endif>
                        <label for="endereco{{ $endereco->id }}" class="text-sm text-gray-700 select-none">
                          Selecionar endereço
                        </label>
                      </div>

                      <!-- badge de confirmação visual; texto muda via JS -->
                      <span class="select-badge" aria-hidden="true">Enviar</span>
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
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="pix" id="pix" @if(old('metodo_pagamento')=='pix') checked @endif>
                <label class="flex items-center gap-2 cursor-pointer text-gray-700" for="pix">
                  <i class="fab fa-pix text-[#32BCAD] text-xl"></i>
                  <span class="text-sm">PIX - Pagamento instantâneo</span>
                </label>
              </div>

              <div class="custome-radio-box flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:shadow-sm transition" data-payment="credit">
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="credit" id="credit" @if(old('metodo_pagamento')=='credit') checked @endif>
                <label class="flex items-center gap-2 cursor-pointer text-gray-700" for="credit">
                  <i class="fas fa-credit-card text-[#4A90E2] text-xl"></i>
                  <span class="text-sm">Cartão de Crédito</span>
                </label>
              </div>

              <div class="custome-radio-box flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:shadow-sm transition" data-payment="debit">
                <input class="form-check-input h-4 w-4 text-[#4A1C1D]" type="radio" name="metodo_pagamento" value="debit" id="debit" @if(old('metodo_pagamento')=='debit') checked @endif>
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
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-name" placeholder="Nome completo como está no cartão" name="cc_name" value="{{ old('cc_name') }}">
                </div>

                <div class="md:col-span-2">
                  <label for="cc-number" class="block mb-1 text-sm text-gray-700">Número do cartão</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-number" placeholder="1234 5678 9012 3456" name="cc_number" value="{{ old('cc_number') }}">
                </div>

                <div>
                  <label for="expiration" class="block mb-1 text-sm text-gray-700">Validade</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="expiration" placeholder="MM/AA" name="cc_expiration" value="{{ old('cc_expiration') }}">
                </div>

                <div>
                  <label for="cc-cvv" class="block mb-1 text-sm text-gray-700">CVV</label>
                  <input type="text" class="form-control w-full rounded-md border border-gray-300 px-3 py-2" id="cc-cvv" placeholder="123" name="cc_cvv">
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
            <span class="ml-auto inline-flex items-center px-2 py-1 rounded-full bg-[#4A1C1D]/10 text-[#4A1C1D] text-sm">{{ count($itens) }}</span>
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
    /* ============================
       ENDEREÇOS - comportamento de botão/card
       ============================ */
    (function() {
      const container = document.getElementById('enderecos-container');
      if (!container) return;

      const cards = Array.from(container.querySelectorAll('.save-details'));
      const radios = Array.from(container.querySelectorAll('input[name="endereco_id"]'));

      function clearSelection() {
        cards.forEach(c => {
          c.classList.remove('selected');
          c.setAttribute('aria-checked', 'false');
          const badge = c.querySelector('.select-badge');
          if (badge) badge.textContent = 'Enviar';
        });
      }

      function selectCard(card) {
        if (!card) return;
        const enderecoId = card.getAttribute('data-endereco');
        const radio = document.querySelector(`input[name="endereco_id"][value="${enderecoId}"]`);

        if (radio) {
          radio.checked = true;
          // disparamos change para qualquer listener existente
          radio.dispatchEvent(new Event('change', { bubbles: true }));
        }

        clearSelection();
        card.classList.add('selected');
        card.setAttribute('aria-checked', 'true');

        const badge = card.querySelector('.select-badge');
        if (badge) badge.textContent = 'Selecionado';
      }

      // clique no cartão seleciona
      cards.forEach(card => {
        card.addEventListener('click', function (e) {
          selectCard(this);
        });

        // suporte teclado (Enter/Space)
        card.addEventListener('keydown', function (e) {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            this.click();
          }
        });
      });

      // quando o radio mudar, sincroniza o cartão correspondente
      radios.forEach(radio => {
        radio.addEventListener('change', function () {
          if (this.checked) {
            const card = container.querySelector(`.save-details[data-endereco="${this.value}"]`);
            if (card) selectCard(card);
          }
        });

        // aplica estado inicial caso o formulário volte com um radio marcado (old / server repopulate)
        if (radio.checked) {
          const card = container.querySelector(`.save-details[data-endereco="${radio.value}"]`);
          if (card) selectCard(card);
        }
      });

      // se nenhum radio estiver marcado e houver cards, podemos opcionalmente deixar nenhum selecionado.
      // (mantive comportamento de não selecionar automaticamente para evitar surpresa ao usuário)
    })();

    /* ============================
       MÉTODOS DE PAGAMENTO / EXIBIÇÃO DE CAMPOS DE CARTÃO
       ============================ */
    const paymentRadios = document.querySelectorAll('input[name="metodo_pagamento"]');
    const paymentBoxes = document.querySelectorAll('.custome-radio-box');
    const cardFields = document.getElementById('card-fields');
    const parcelasSection = document.getElementById('parcelas-section');

    function openCardFields(open) {
        if (!cardFields) return;
        if (open) {
            cardFields.classList.add('open');
            cardFields.style.display = 'block';
        } else {
            cardFields.classList.remove('open');
            setTimeout(() => {
                if (!cardFields.classList.contains('open')) cardFields.style.display = 'none';
            }, 360);
        }
    }

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            paymentBoxes.forEach(box => box.classList.remove('active'));

            const selectedBox = this.closest('.custome-radio-box');
            if (selectedBox) {
                selectedBox.classList.add('active');
            }

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

    // estado inicial (útil para repopulação com old())
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

    // também mantemos reatividade para casos onde o usuário muda a seleção
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

    /* ============================
       MÁSCARAS: número, validade, cvv
       ============================ */
    const cardNumberInput = document.getElementById('cc-number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function() {
            let value = this.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            this.value = formattedValue;
        });
    }

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

    const cvvInput = document.getElementById('cc-cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').substring(0, 4);
        });
    }
});
</script>
