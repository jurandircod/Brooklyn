@yield('breadcrumb')

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
                                <div class="product-count">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('images/gif/fire.gif') }}"
                                                class="img-fluid blur-up lazyload" alt="image">
                                            <span class="p-counter">37</span>
                                            <span class="lang">orders in last 24 hours</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('images/gif/person.gif') }}"
                                                class="img-fluid user_img blur-up lazyload" alt="image">
                                            <span class="p-counter">44</span>
                                            <span class="lang">active view this</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="details-image-concept">
                                    <h2>{{ $produto->nome }}</h2>
                                </div>

                                <div class="label-section">
                                    <span class="badge badge-grey-color">#1 Best seller</span>
                                    <span class="label-text">in fashion</span>
                                </div>

                                <h3 class="price-detail">${{ $produto->valor }}
                                    <del>{{ $produto->valor * 2 }}</del><span>{{ $produto->valor * 0.5 }} % off</span>
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
                                        <ul>
                                            @if ($produto->categoria_id == 1)
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="P">P</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidadeP }}</a></li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="M">M</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidadeM }}</a></li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="G">G</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidadeG }}</a></li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="GG">GG</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidadeGG }}</a>
                                                </li>
                                            @elseif ($produto->categoria_id == 2)
                                                <h6 class="product-title size-text">Tamanhos</h6>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="775">7.75</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidade775 }}</a>
                                                </li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="8">8</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidade8 }}</a></li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="825">8.25</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidade825 }}</a>
                                                </li>
                                                <li><a href="javascript:void(0)" class="size-option"
                                                        data-size="85">8.5</a> <a
                                                        href="javascript:void(0)">{{ $estoque->quantidade85 }}</a>
                                                </li>
                                            @else
                                                <h6 class="product-title size-text">Quantidade</h6>
                                            @endif

                                            <input type="number" id="quantidade" name="quantidade"
                                                class="form-control" min="1" value="1"
                                                style="width: 100px;" />
                                            <small id="quantidade-error" style="color: red; display: none;">Quantidade
                                                indisponível para o estoque selecionado</small>
                                        </ul>
                                    </div>

                                    <input type="hidden" id="selected-size" name="selected_size">
                                </div>

                                <!-- Script para informar se o produto tem tamanho -->
                                <script>
                                    const temTamanho = {{ in_array($produto->categoria_id, [1, 2]) ? 'true' : 'false' }};
                                </script>



                                <div class="product-buttons">
                                    <a href="javascript:void(0)" data-id="{{ $produto->id }}" id="cartEffect"
                                        class="addtocart-btn btn btn-solid hover-solid btn-animation">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Adicionar ao carrinho</span>
                                    </a>
                                </div>
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
                                    <span>{{ $produto->estoque->quantidade }}</span> em estoque
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

        let estoqueDisponivel = {};
        @if (isset($produto->categoria_id) && $produto->categoria_id == 1)
            estoqueDisponivel = {
                P: {{ isset($estoque->quantidadeP) ? $estoque->quantidadeP : 0 }},
                M: {{ isset($estoque->quantidadeM) ? $estoque->quantidadeM : 0 }},
                G: {{ isset($estoque->quantidadeG) ? $estoque->quantidadeG : 0 }},
                GG: {{ isset($estoque->quantidadeGG) ? $estoque->quantidadeGG : 0 }},
            };
        @elseif (isset($produto->categoria_id) && $produto->categoria_id == 2)
            estoqueDisponivel = {
                "775": {{ isset($estoque->quantidade775) ? $estoque->quantidade775 : 0 }},
                "8": {{ isset($estoque->quantidade8) ? $estoque->quantidade8 : 0 }},
                "825": {{ isset($estoque->quantidade825) ? $estoque->quantidade825 : 0 }},
                "85": {{ isset($estoque->quantidade85) ? $estoque->quantidade85 : 0 }},
            };
        @else
            estoqueDisponivel = {
                quantidade: {{ isset($estoque->quantidade) ? $estoque->quantidade : 0 }},
                tamanho: 'quantidade',
            };
        @endif

        // Validate estoqueDisponivel to prevent runtime errors
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

        sizeOptions.forEach(option => {
            option.addEventListener("click", function() {
                sizeOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedSize = this.getAttribute('data-size');
                document.getElementById('selected-size').value = selectedSize;

                errorMessage.style.display = 'none';
                errorQuantidade.style.display = 'none';

                const estoque = estoqueDisponivel[selectedSize] || 1;
                inputQuantidade.max = estoque;
                inputQuantidade.value = 1;
            });
        });

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

                if (isNaN(quantidade) || quantidade <= 0 || quantidade > estoqueMaximo) {
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

                console.log(quantidade);

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#rating li');
        const avaliacaoInput = document.getElementById('avaliacaoInput');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                avaliacaoInput.value = value;

                // Atualiza a aparência visual das estrelas
                stars.forEach((s, index) => {
                    if (index < value) {
                        s.querySelector('i').classList.add(
                            'theme-color'
                        ); // Adicione uma classe 'active' para estrelas selecionadas
                    } else {
                        s.querySelector('i').classList.remove(
                            'theme-color'
                        ); // Remove a classe 'active' das estrelas não selecionadas
                    }
                });
            });
        });
    });
</script>
