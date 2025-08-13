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



        <div class="row g-sm-4 g-3">
            @foreach ($produtos as $index => $produto)
                @if ($produto->estoque)
                    <div class="col-xl-2 col-lg-2 col-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <a href="{{ route('site.produto', ['id' => $produto->id]) }}">
                                    <img src="{{ $produto->imagem_url }}" class="w-100 blur-up lazyload"
                                        alt="{{ $produto->nome }}">
                                </a>
                                <div class="circle-shape"></div>
                                <span class="background-text">Furniture</span>
                                <div class="label-block">
                                    <span class="label label-theme">30% Off</span>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            @if ($produto->categoria_id != 2 && $produto->categoria_id != 1)
                                                <a href="javascript:void(0)" class="addtocart-btn"
                                                    data-id="{{ $produto->id }}">
                                                    <i data-feather="shopping-cart"></i>
                                                </a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{ route('site.produto', ['id' => $produto->id]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-style-3 product-style-chair">
                                <div class="product-title d-block mb-0">
                                    <div class="r-price">
                                        <div class="theme-color">R${{ number_format($produto->valor, 2, ',', '.') }}
                                        </div>
                                        <div class="main-price">
                                            <ul class="rating mb-1 mt-0">
                                                @if ($produto->avaliacao->count() > 0)
                                                    @for ($i = 1; $i <= $produto->avaliacao->first()->estrela; $i++)
                                                        <li><i class="fas fa-star theme-color"></i></li>
                                                    @endfor
                                                @else
                                                    <li><i class="fas fa-star theme-color"></i></li>
                                                    <li><i class="fas fa-star theme-color"></i></li>
                                                    <li><i class="fas fa-star theme-color"></i></li>
                                                    <li><i class="fas fa-star theme-color"></i></li>
                                                    <li><i class="fas fa-star theme-color"></i></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="font-light mb-sm-2 mb-0">{{ $produto->material }}</p>
                                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}" class="font-default">
                                        <h5>{{ $produto->nome }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xl-2 col-lg-2 col-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <a href="{{ route('site.produto', ['id' => $produto->id]) }}">
                                    <img src="{{ $produto->imagem_url }}" class="w-100 blur-up lazyload opacity-50"
                                        alt="{{ $produto->nome }}">
                                </a>
                                <div class="circle-shape"></div>
                                <span class="background-text">Furniture</span>
                                <div class="label-block">
                                    <span class="label label-theme">30% Off</span>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="disabled" title="Produto sem estoque">
                                                <i data-feather="shopping-cart" class="text-muted"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('site.produto', ['id' => $produto->id]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-style-3 product-style-chair">
                                <div class="product-title d-block mb-0">
                                    <div class="r-price">
                                        <div class="theme-color">R${{ number_format($produto->valor, 2, ',', '.') }}
                                        </div>
                                        <div class="main-price">
                                            <ul class="rating mb-1 mt-0">
                                                <li><i class="fas fa-star theme-color"></i></li>
                                                <li><i class="fas fa-star theme-color"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="font-light mb-sm-2 mb-0">{{ $produto->material }}</p>
                                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}" class="font-default">
                                        <h5>{{ $produto->nome }}</h5>
                                    </a>
                                    <div class="alert alert-warning mt-2 d-flex align-items-center" role="alert">
                                        <i data-feather="alert-circle" class="me-2"></i>
                                        <span>Sem estoque</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row mt-5">
            {{ $produtos->links() }}
        </div>

    </div>
</section>
<!-- Adicione no head ou antes do fechamento do body -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const botoes = document.querySelectorAll(".addtocart-btn");

        botoes.forEach(botao => {
            botao.addEventListener("click", function() {
                const produtoId = this.getAttribute("data-id");
                const produtoElement = this.closest('.product-box');
                const produtoNome = produtoElement.querySelector('h5').textContent;
                const produtoPreco = produtoElement.querySelector('.theme-color').textContent;
                const produtoImagem = produtoElement.querySelector('img').src;
                const tamanho = "quantidade";

                // Mostrar toast de carregamento
                const loadingToast = Toastify({
                    text: "Adicionando ao carrinho...",
                    duration: -1,
                    gravity: "bottom",
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
                            quantidade: 1,
                            tamanho: tamanho
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

                        if (data.status === 'sucess' || data.status === 'success') {
                            loadingToast.hideToast();

                            // Mostrar SweetAlert para confirmação
                            Swal.fire({
                                title: 'Adicionado ao carrinho!',
                                html: `
                                <div style="display: flex; align-items: center; gap: 15px; margin: 10px 0;">
                                    <img src="${produtoImagem}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    <div>
                                        <h6 style="margin: 0 0 5px 0;">${produtoNome}</h6>
                                        <p style="margin: 0; color: #4CAF50; font-weight: bold;">${produtoPreco}</p>
                                    </div>
                                </div>
                            `,
                                icon: 'success',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                timer: 3000,
                                timerProgressBar: true
                            });

                            // Mostrar toast de confirmação
                            Toastify({
                                text: `${data.message} adicionado ao carrinho!`,
                                duration: 3000,
                                gravity: "bottom",
                                position: "right",
                                backgroundColor: "#4CAF50",
                                stopOnFocus: true
                            }).showToast();
                        } else {
                            loadingToast.hideToast();
                            Toastify({
                                text: "Erro ao adicionar ao carrinho",
                                duration: 3000,
                                gravity: "bottom",
                                position: "right",
                                backgroundColor: "#f44336",
                                stopOnFocus: true
                            }).showToast();
                        }
                    })
                    .catch(err => {
                        loadingToast.hideToast();
                        Toastify({
                            text: "estoque insuficiente",
                            duration: 3000,
                            gravity: "bottom",
                            position: "right",
                            backgroundColor: "#f44336",
                            stopOnFocus: true
                        }).showToast();
                        console.error("Erro na requisição:", err);
                    });
            });
        });
    });
</script>
