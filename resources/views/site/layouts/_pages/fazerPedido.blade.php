
< <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px; position: relative;">
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
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-12">
                <h3>Checkout</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/" style="color: white;">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: white;">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    </section>

    <section class="section-b-space">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <form class="needs-validation" method="POST"
                        action="{{ route('site.carrinho.finalizarCarrinho') }}">
                        @csrf
                        <div class="save-details-box">
                            <h3 class="mb-4 text-center" style="color: #333; font-weight: 600;">
                                <i class="fas fa-map-marker-alt" style="color: #667eea; margin-right: 10px;"></i>
                                Escolha um endereço para receber seu pedido
                            </h3>
                            <div class="row g-3" id="enderecos-container">
                                <!-- Simulando endereços do backend -->
                                @foreach ($enderecos as $endereco)
                                    <div class="col-xl-4 col-md-6">
                                        <div class="save-details" data-endereco="{{ $endereco->id }}">
                                            <div class="save-name">
                                                <h5>{{ $endereco->cidade }}</h5>
                                            </div>
                                            <div class="save-address">
                                                <p><b>Bairro: </b>{{ $endereco->bairro }}</p>
                                                <p><b>Número da casa: </b>{{ $endereco->numero }}</p>
                                                <p><b>Cidade: </b>{{ $endereco->cidade }}</p>
                                                <p><b>Estado: </b>{{ $endereco->estado }}</p>
                                                <p><b>CEP: </b>{{ $endereco->cep }}</p>
                                            </div>
                                            <div class="mobile">
                                                <p class="font-light"><b>Telefone: </b>{{ $endereco->telefone }}</p>
                                            </div>
                                            <div class="button mt-3">
                                                <div class="address-checkbox">
                                                    <input type="radio" id="endereco{{ $endereco->id }}"
                                                        name="endereco_id" value="{{ $endereco->id }}">
                                                    <label for="endereco{{ $endereco->id }}" class="checkbox-custom">
                                                        Selecionar endereço
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @error('endereco_id')
                                    <div class="alert alert-danger">
                                        <strong>Erro!</strong> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('site.perfil.exibirEndereco') }}" class="btn btn-solid-default">
                                    <i class="fas fa-plus me-2"></i>
                                    Adicionar novo endereço
                                </a>
                            </div>
                        </div>

                        <hr class="my-5" style="border-color: #e9ecef; border-width: 2px;">

                        <div class="payment-section">
                            <h3 class="mb-4" style="color: #333; font-weight: 600;">
                                <i class="fas fa-credit-card" style="color: #667eea; margin-right: 10px;"></i>
                                Tipo de pagamento
                            </h3>

                            <div class="d-block my-3">
                                <div class="form-check custome-radio-box" data-payment="pix">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento"
                                        value="pix" id="pix">
                                    <label class="form-check-label" for="pix">
                                        <i class="fab fa-pix payment-icon" style="color: #32BCAD;"></i>
                                        PIX - Pagamento instantâneo
                                    </label>
                                </div>

                                <div class="form-check custome-radio-box" data-payment="credit">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento"
                                        value="credit" id="credit">
                                    <label class="form-check-label" for="credit">
                                        <i class="fas fa-credit-card payment-icon" style="color: #4A90E2;"></i>
                                        Cartão de Crédito
                                    </label>
                                </div>

                                <div class="form-check custome-radio-box" data-payment="debit">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento"
                                        value="debit" id="debit">
                                    <label class="form-check-label" for="debit">
                                        <i class="fas fa-credit-card payment-icon" style="color: #E94B3C;"></i>
                                        Cartão de Débito
                                    </label>
                                </div>
                            </div>

                            <div class="card-fields fade-in" id="card-fields" style="display: none;">
                                <h5 class="mb-3" style="color: #333;">
                                    <i class="fas fa-lock me-2" style="color: #667eea;"></i>
                                    Dados do Cartão
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="cc-name" class="form-label">Nome no cartão</label>
                                        <input type="text" class="form-control" id="cc-name"
                                            placeholder="Nome completo como está no cartão">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="cc-number" class="form-label">Número do cartão</label>
                                        <input type="text" class="form-control" id="cc-number"
                                            placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="expiration" class="form-label">Validade</label>
                                        <input type="text" class="form-control" id="expiration"
                                            placeholder="MM/AA">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cc-cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="123">
                                    </div>
                                </div>

                                <div class="parcelas-select" id="parcelas-section" style="display: none;">
                                    <label for="parcelas" class="form-label">
                                        <i class="fas fa-calendar-alt me-2" style="color: #667eea;"></i>
                                        Número de parcelas
                                    </label>
                                    <select class="form-select" id="parcelas" name="parcelas">
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
                            <div class="alert alert-danger">
                                <strong>Erro!</strong> {{ $message }}
                            </div>
                        @enderror

                        <div class="text-center mt-4">
                            <button class="btn btn-solid-default btn-lg" type="submit" style="padding: 15px 40px;">
                                <i class="fas fa-lock me-2"></i>
                                Processar pagamento
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="your-cart-box">
                        <h3 class="mb-3 d-flex text-capitalize">
                            <i class="fas fa-shopping-cart me-2" style="color: #667eea;"></i>
                            Seu carrinho
                            <span class="badge new-badge rounded-pill ms-auto">3</span>
                        </h3>

                        <ul class="list-group mb-3">
                            @foreach ($itens as $item)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="text-dark">
                                        <h6 class="my-0">{{ $item->produto_nome }}</h6>
                                        <small class="text-muted">Quantidade: {{ $item->quantidade }} | Preço
                                            unitário:
                                            R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</small>
                                    </div>
                                    <span class="text-dark">R$
                                        {{ number_format($item->preco_total, 2, ',', '.') }}</span>
                                </li>
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                <div class="text-white">
                                    <h6 class="my-0">Preço total</h6>
                                </div>
                                <span class="text-black">{{ number_format($preco_total, 2, ',', '.') }}</span>
                            </li>
                        </ul>

                        <form class="card border-0 d-none">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Código promocional">
                                <button type="submit" class="btn btn-solid-default">Aplicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    </script>
