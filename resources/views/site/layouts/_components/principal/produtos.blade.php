<section class="ratio_asos overflow-hidden">
    <div class="container p-sm-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="title-3 text-center">
                    <h2>Novos Produtos</h2>
                    <h5 class="theme-color">Nossa coleção</h5>
                </div>
            </div>
        </div>
        <style>
            .r-price {
                display: flex;
                flex-direction: row;
                gap: 20px;
            }

            .r-price .main-price {
                width: 100%;
            }

            .r-price .rating {
                padding-left: auto;
            }

            .product-style-3.product-style-chair .product-title {
                text-align: left;
                width: 100%;
            }

            @media (max-width:600px) {

                .product-box p,
                .product-box a {
                    text-align: left;
                }

                .product-style-3.product-style-chair .main-price {
                    text-align: right !important;
                }
            }
        </style>


        <div class="row g-sm-4 g-3">
            @foreach ($produtos as $index => $produto)
                <div class="col-xl-2 col-lg-2 col-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <a href="product/details.html">
                                <img src="{{ $produto->imagem_url }}" class="w-100 blur-up lazyload" alt="">
                            </a>
                            <div class="circle-shape"></div>
                            <span class="background-text">Furniture</span>
                            <div class="label-block">
                                <span class="label label-theme">30% Off</span>
                            </div>
                            <div class="cart-wrap">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)" class="addtocart-btn"
                                            data-id="{{ $produto->id }}">
                                            <i data-feather="shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i data-feather="eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-style-3 product-style-chair">
                            <div class="product-title d-block mb-0">
                                <div class="r-price">
                                    <div class="theme-color">R${{ $produto->valor }}</div>
                                    <div class="main-price">
                                        <ul class="rating mb-1 mt-0">
                                            <li>
                                                <i class="fas fa-star theme-color"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star theme-color"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="font-light mb-sm-2 mb-0">{{ $produto->material }}</p>
                                <a href="product/details.html" class="font-default">
                                    <h5>{{ $produto->nome }}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const botoes = document.querySelectorAll(".addtocart-btn");

        botoes.forEach(botao => {
            botao.addEventListener("click", function() {
                const produtoId = this.getAttribute("data-id");

                fetch("{{ route('site.carrinho.itemCarrinho.adicionar') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                            "Accept": "application/json" // Garante que o back-end saiba que esperamos JSON
                        },
                        body: JSON.stringify({
                            produto_id: produtoId,
                            quantidade: 1
                        })
                    })
                    .then(async (res) => {
                        // Verifica se a resposta é JSON válido
                        const contentType = res.headers.get("content-type");
                        if (contentType && contentType.includes("application/json")) {
                            return res.json();
                        } else {
                            // Se não for JSON, pega o texto (pode ser HTML de erro)
                            const text = await res.text();
                            throw new Error(text);
                        }
                    })
                    .then(data => {
                        // Exibe a mensagem do back-end (assumindo que `data.message` existe)
                        if (data.message) {
                            console.log("Mensagem do back-end:", data.message);
                            alert(data.message);
                        } else {
                            alert("teste");
                        }
                    })
                    .catch(err => {
                        // Se o back-end retornar um erro (500, 404, etc.)
                        console.error("Erro na requisição:", err);
                        alert("Ocorreu um erro ao adicionar o produto ao carrinho.");
                    });
            });
        });
    });
</script>
