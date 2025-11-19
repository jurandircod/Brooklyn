<section>
    <div class="container">
        <div class="row gx-4 gy-5">
            <div class="col-lg-12 col-12">
                <div class="details-items">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="details-image-vertical black-slide rounded">
                                        <div>
                                            <img src="{{ $produto->imagem_url }}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagem_url2 }}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagemUrl3 }}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagemUrl4 }}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="details-image-1 ratio_asos">
                                        <div>
                                            <img src="{{ $produto->imagem_url }}" id="zoom_01"
                                                data-zoom-image="assets/images/fashion/1.jpg"
                                                class="img-fluid w-100 image_zoom_cls-0 blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagem_url2 }}" id="zoom_02"
                                                data-zoom-image="assets/images/fashion/2.jpg"
                                                class="img-fluid w-100 image_zoom_cls-1 blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagem_url3 }}" id="zoom_03"
                                                data-zoom-image="assets/images/fashion/3.jpg"
                                                class="img-fluid w-100 image_zoom_cls-2 blur-up lazyload"
                                                alt="">
                                        </div>
                                        <div>
                                            <img src="{{ $produto->imagem_url4 }}" id="zoom_04"
                                                data-zoom-image="assets/images/fashion/4.jpg"
                                                class="img-fluid w-100 image_zoom_cls-3 blur-up lazyload"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="">

                                <div class="details-image-concept">
                                    <h2>{{ $produto->nome }}</h2>
                                </div>

                                <div class="label-section">
                                    <span class="badge badge-grey-color">Entre os melhores produtos</span>
                                    <span class="label-text">Em {{ $produto->categoria->nome ?? 'fashion' }}</span>
                                </div>

                                <h3 class="price-detail">${{ $produto->valor }}
                                    <del>{{ $produto->valor * 2 }}</del><span>{{ $produto->valor / 2 }} % off</span>
                                </h3>



                                <div id="selectSize" class="addeffect-section product-description border-product">
                                    @if ($produto->categoria_id == 1)
                                        <h6 class="product-title size-text">Especificação
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#sizemodal">size chart</a>
                                        </h6>
                                    @endif

                                    <h6 class="error-message"
                                        style="{{ in_array($produto->categoria_id, [1, 2]) ? '' : 'display: none;' }}">
                                        please select size</h6>

                                    <div class="size-box">
                                        <h6 class="product-title size-text mb-3">Tamanhos e Estoque</h6>

                                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3" role="list"
                                            aria-label="Tamanhos disponíveis">
                                            @foreach ($tamanhosComQuantidade as $tamanho => $estoque)
                                                @php
                                                    $qtd = (int) $estoque['quantidade'];
                                                    $stockClass =
                                                        $qtd === 0
                                                            ? 'out-of-stock'
                                                            : ($qtd <= 5
                                                                ? 'low-stock'
                                                                : 'in-stock');
                                                @endphp

                                                <a href="javascript:void(0)"
                                                    class="size-option flex flex-col items-center justify-center gap-1 p-3 rounded-lg border transition select-none text-center shadow-sm
                hover:shadow-md hover:scale-[1.02] hover:text-white {{ $stockClass }}"
                                                    data-size="{{ $estoque['tamanho'] }}" aria-pressed="false"
                                                    role="button"
                                                    title="Tamanho {{ $estoque['tamanho'] }} - {{ $qtd }} em estoque">

                                                    <span
                                                        class="text-sm font-semibold text-gray-800">{{ $estoque['tamanho'] }}</span>

                                                    <span class="text-xs tracking-tight">
                                                        <span
                                                            class="stock-pill inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium">
                                                            <svg class="w-3 h-3 shrink-0" viewBox="0 0 8 8"
                                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="4" cy="4" r="4"></circle>
                                                            </svg>
                                                            <span class="stock-count">{{ $qtd }}</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>

                                        <div class="mt-4 flex items-center gap-4">
                                            <div>
                                                <label for="quantidade"
                                                    class="block text-sm font-medium text-gray-700">Quantidade</label>
                                                <input type="number" id="quantidade" name="quantidade"
                                                    class="form-control rounded-md border border-gray-300 px-3 py-2 w-28"
                                                    min="1" value="1" />
                                                <small id="quantidade-error" class="block mt-1 text-sm text-red-600"
                                                    style="display: none;">Quantidade indisponível para o estoque
                                                    selecionado</small>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="selected-size" name="selected_size">
                                </div>

                                <!-- Script para informar se o produto tem tamanho -->
                                <script>
                                    const temTamanho = {{ in_array($produto->categoria_id, [1, 2, 3]) ? 'true' : 'false' }};
                                </script>



                                @if(Auth::check())
                                <div class="product-buttons">
                                    <a href="javascript:void(0)" data-id="{{ $produto->id }}" id="cartEffect"
                                        class="addtocart-btn btn btn-solid hover-solid btn-animation">
                                        <i class="fa fa-shopping-cart"></i>

                                        <span>Adicionar ao carrinho</span>

                                    </a>
                                </div>
                                @else
                                <div class="product-buttons">
                                    <a href="{{ route('login') }}" class="addtocart-btn btn btn-solid hover-solid btn-animation">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Adicionar ao carrinho</span>
                                    </a>
                                </div>
                                @endif
                            </div>


                            <ul class="product-count shipping-order">
                                <li>
                                    <img src="{{ asset('images/gif/truck.png') }}" class="img-fluid blur-up lazyload"
                                        alt="image">
                                    <span class="lang">Frete gratis em produtos acima de R$ 500,00</span>
                                </li>
                            </ul>

                            <div class="mt-2 mt-md-3 border-product">
                                <h6 class="product-title hurry-title d-block">Corra ainda temos
                                    <span></span> em estoque
                                </h6>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                </div>
                            </div>

                            <div class="border-product">
                                <h6 class="product-title d-block">Compartilhe em</h6>
                                <div class="product-icon">
                                    <ul class="product-social">
                                        <li>
                                            <a href="https://www.facebook.com/">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.google.com/">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li class="pe-0">
                                            <a href="https://www.google.com/">
                                                <i class="fas fa-rss"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('produto-descricao')
    </div>
    </div>
</section>
<!-- Shop Section end -->

<!-- product section start -->
@yield('produto-relacionados')
<!-- product section end -->
<style>
    .rating li {
        cursor: pointer;
        /* Muda o cursor para indicar que é clicável */
    }

    .rating li:hover {
        color: gold;
        /* Muda a cor ao passar o mouse */
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let selectedSize = null;
        const temTamanho =
            {{ isset($produto->categoria_id) && in_array($produto->categoria_id, [1, 2]) ? 'true' : 'false' }};

        // Inicializa estoque
        let estoqueDisponivel = {};
        @foreach ($tamanhosComQuantidade as $item)
            estoqueDisponivel["{{ $item['tamanho'] }}"] = {{ $item['quantidade'] }};
        @endforeach

        console.log(estoqueDisponivel); // Corrigido de 'consoloe.log' para 'console.log'

        // Valida estoque
        if (!Object.keys(estoqueDisponivel).length) {
            console.error("Erro: estoqueDisponivel não foi inicializado corretamente.");
            estoqueDisponivel = {
                quantidade: 0
            };
        }

        const sizeOptions = document.querySelectorAll(".size-option");
        const inputQuantidade = document.getElementById("quantidade");
        const errorMessage = document.querySelector(".error-message");
        const errorQuantidade = document.getElementById("quantidade-error");

        // Configura eventos para os tamanhos
        sizeOptions.forEach(option => {
            option.addEventListener("click", function() {
                sizeOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedSize = this.getAttribute('data-size');
                document.getElementById('selected-size').value = selectedSize;

                errorMessage.style.display = 'none';
                errorQuantidade.style.display = 'none';

                const estoque = estoqueDisponivel[selectedSize] || 0;
                inputQuantidade.max = estoque;
                inputQuantidade.value = estoque > 0 ? 1 : 0;

                if (estoque === 0) {
                    errorQuantidade.textContent = "Produto esgotado para este tamanho";
                    errorQuantidade.style.display = 'block';
                } else {
                    errorQuantidade.style.display = 'none';
                }
            });
        });

        // Configura evento para o botão de adicionar ao carrinho
        const botoes = document.querySelectorAll(".addtocart-btn");
        botoes.forEach(botao => {
            botao.addEventListener("click", function() {
                if (temTamanho && !selectedSize) {
                    errorMessage.style.display = 'block';
                    return;
                }

                const quantidade = parseInt(inputQuantidade.value);
                const estoqueKey = selectedSize || 'quantidade';
                const estoqueMaximo = estoqueDisponivel[estoqueKey] || 0;

                // Verificação de quantidade
                if (isNaN(quantidade) || quantidade <= 0) {
                    errorQuantidade.textContent = "Quantidade inválida";
                    errorQuantidade.style.display = 'block';
                    return;
                }

                if (quantidade > estoqueMaximo) {
                    errorQuantidade.textContent = estoqueMaximo > 0 ?
                        `Quantidade máxima disponível: ${estoqueMaximo}` :
                        "Produto esgotado para este tamanho";
                    errorQuantidade.style.display = 'block';
                    return;
                }

                const produtoId = this.getAttribute("data-id");

                const loadingToast = Toastify({
                    text: "Adicionando ao carrinho...",
                    duration: -1,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4CAF50",
                    stopOnFocus: true
                }).showToast();

                fetch("{{ route('site.carrinho.itemCarrinho.adicionar') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            produto_id: produtoId,
                            quantidade: quantidade,
                            tamanho: estoqueKey,
                        })
                    })
                    .then(async (res) => {
                        const contentType = res.headers.get("content-type");
                        if (contentType && contentType.includes("application/json")) {
                            return res.json();
                        } else {
                            const text = await res.text();
                            throw new Error(text);
                        }
                    })
                    .then(data => {
                        loadingToast.hideToast();

                        if (data.status === 'sucess' || data.status === 'success') {
                            Swal.fire({
                                title: data.message,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true
                            });

                            Toastify({
                                text: `Adicionado ao carrinho!`,
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4CAF50",
                                stopOnFocus: true
                            }).showToast();
                        } else {
                            Swal.fire({
                                title: 'Erro!',
                                text: data.message ||
                                    'Erro ao adicionar ao carrinho.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });

                            Toastify({
                                text: data.message ||
                                    "Erro ao adicionar ao carrinho.",
                                duration: 3000,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#f44336",
                                stopOnFocus: true
                            }).showToast();
                        }
                    })
                    .catch(error => {
                        loadingToast.hideToast();
                        console.error("Erro na requisição:", error);
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Falha na comunicação com o servidor.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    });
</script>
<style>
    /* Visual básico para estados de estoque */
    .size-option.in-stock {
        border-color: rgba(74, 28, 29, 0.12);
    }

    .size-option.in-stock .stock-pill {
        color: #065f46;
        /* verde-700 */
        background-color: rgba(6, 95, 70, 0.08);
    }

    .size-option.low-stock {
        border-color: rgba(234, 88, 12, 0.12);
    }

    .size-option.low-stock .stock-pill {
        color: #92400e;
        /* amber-800 */
        background-color: rgba(146, 64, 14, 0.06);
    }

    .size-option.out-of-stock {
        opacity: 0.55;
        pointer-events: auto;
        /* mantém clique (JS mostra mensagem), mas visual indica indisponível */
        border-color: rgba(220, 38, 38, 0.12);
    }

    .size-option.out-of-stock .stock-pill {
        color: #b91c1c;
        /* red-700 */
        background-color: rgba(185, 28, 28, 0.06);
    }

    /* estado selecionado — seu JS faz `classList.add('selected')` */
    .size-option.selected {
        background: linear-gradient(180deg, rgba(74, 28, 29, 1) 0%, rgba(111, 46, 47, 1) 100%);
        color: #fff !important;
        border-color: rgba(74, 28, 29, 0.9) !important;
        box-shadow: 0 6px 20px rgba(74, 28, 29, 0.12);
        transform: translateY(-2px);
    }

    .size-option.selected .stock-pill {
        background-color: rgba(255, 255, 255, 0.12) !important;
        color: #fff !important;
    }

    /* acessibilidade (focus) */
    .size-option:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(74, 28, 29, 0.12);
    }

    /* pequenas correções para o .stock-pill */
    .stock-pill svg {
        color: inherit;
    }

    .stock-pill .stock-count {
        display: inline-block;
        min-width: 18px;
        text-align: center;
    }

    /* responsividade: em telas muito pequenas, diminuímos padding */
    @media (max-width: 420px) {
        .size-option {
            padding: 10px 8px;
        }

        .stock-pill {
            padding: 2px 6px;
        }
    }
</style>
