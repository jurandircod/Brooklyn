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
                <h3>Shop</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.htm">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 category-side col-md-4">
                <div class="category-option">
                    <div class="button-close mb-3">
                        <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                    </div>
                    <form id="filterForm" action="/filter" method="POST">
                        <div class="accordion category-name" id="accordionExample">
                            <input type="hidden" name="filtrar" value="1">
                            <div class="accordion-item category-price">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour">Preço</button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="range-slider category-list">
                                            <input type="text" class="js-range-slider" id="js-range-price"
                                                name="price_range" value="">
                                            <input type="hidden" name="min_price" id="min_price">
                                            <input type="hidden" name="max_price" id="max_price">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-price">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFive">Tamanhos</button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="category-list">
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_p"
                                                        name="sizes[]" type="checkbox" value="P">
                                                    <label class="form-check-label" for="size_p">P</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_m"
                                                        name="sizes[]" type="checkbox" value="M">
                                                    <label class="form-check-label" for="size_m">M</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_g"
                                                        name="sizes[]" type="checkbox" value="G">
                                                    <label class="form-check-label" for="size_g">G</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_gg"
                                                        name="sizes[]" type="checkbox" value="GG">
                                                    <label class="form-check-label" for="size_gg">GG</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_775"
                                                        name="sizes[]" type="checkbox" value="7.75">
                                                    <label class="form-check-label" for="size_775">7.75</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_8"
                                                        name="sizes[]" type="checkbox" value="8">
                                                    <label class="form-check-label" for="size_8">8</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_825"
                                                        name="sizes[]" type="checkbox" value="8.25">
                                                    <label class="form-check-label" for="size_825">8.25</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_85"
                                                        name="sizes[]" type="checkbox" value="8.5">
                                                    <label class="form-check-label" for="size_85">8.5</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-rating">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix">Categoria</button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body category-scroll">
                                        <ul class="category-list">
                                            @foreach ($categorias as $categoria)
                                                <li>
                                                    <div class="form-check ps-0 custome-form-check">
                                                        <input class="checkbox_animated check-it"
                                                            id="ct{{ $categoria->id }}" name="categorias[]"
                                                            type="checkbox" value="{{ $categoria->id }}">
                                                        <label class="form-check-label"
                                                            for="ct{{ $categoria->id }}">{{ $categoria->nome }}</label>
                                                        <p class="font-light">
                                                            ({{ $categoria->contarProdutosCategoria() }})
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-rating">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven">Marcas</button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body category-scroll">
                                        <ul class="category-list">
                                            @foreach ($marcas as $marca)
                                                <li>
                                                    <div class="form-check ps-0 custome-form-check">
                                                        <input class="checkbox_animated check-it"
                                                            id="ct{{ $marca->id }}" name="marcas[]"
                                                            type="checkbox" value="{{ $marca->id }}">
                                                        <label class="form-check-label"
                                                            for="ct{{ $marca->id }}">{{ $marca->nome }}</label>
                                                        <p class="font-light">({{ $marca->contarProdutosMarca() }})</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                    </form>
                </div>
            </div>


            <div class="category-product col-lg-9 col-12 ratio_30">

                <div class="row g-4">
                    <!-- label and featured section -->
                    <div class="col-md-12">
                        <ul class="short-name">


                        </ul>
                    </div>

                    <div class="col-12">
                        <div class="filter-options">
                            <div class="select-options">
                                <div class="page-view-filter">
                                    <div class="dropdown select-featured">
                                        <select class="form-select" name="orderby" id="orderby">
                                            <option value="-1" selected="">Default</option>
                                            <option value="1">Date, New To Old</option>
                                            <option value="2">Date, Old To New</option>
                                            <option value="3">Price, Low To High</option>
                                            <option value="4">Price, High To Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="dropdown select-featured">
                                    <select class="form-select" name="size" id="pagesize">
                                        <option value="12" selected="">12 Products Per Page</option>
                                        <option value="24">24 Products Per Page</option>
                                        <option value="52">52 Products Per Page</option>
                                        <option value="100">100 Products Per Page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-options d-sm-inline-block d-none">
                                <ul class="d-flex">
                                    <li class="two-grid">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('images/svg/grid-2.svg') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="three-grid d-md-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('images/svg/grid-3.svg') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn active d-lg-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('images/svg/grid.svg') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('images/svg/list.svg') }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- label and featured section -->

                <!-- Prodcut setion -->
                <div
                    class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                    @foreach ($produtos as $produto)
                        <div>
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="product/nihil-beatae-sit-sed.html">
                                            <a href="{{ route('site.produto', ['id' => $produto->id]) }}">
                                                <img src="{{ $produto->imagem_url }}" class="w-100 blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </a>
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
                                <div class="product-details">
                                    <div class="rating-details">
                                        <span class="font-light grid-content">{{ $produto->categoria->nome }}</span>
                                        <ul class="rating mt-0">
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
                                    <div class="main-price">
                                        <a href="product/nihil-beatae-sit-sed.html" class="font-default">
                                            <h5 class="ms-0">{{ $produto->nome }}</h5>
                                        </a>
                                        <div class="listing-content">
                                            <span class="font-light">{{ $produto->marca->nome }}</span>
                                            <p class="font-light">{{ $produto->descricao }}</p>
                                        </div>
                                        <h3 class="theme-color">${{ $produto->valor }}</h3>
                                        <button class="btn listing-content">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row mt-5">
                    <div class="col-12">
                        {{ $produtos->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Shop Section end -->
<!-- Subscribe Section Start -->
<section class="subscribe-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <div class="subscribe-details">
                    <h2 class="mb-3">Subscribe Our News</h2>
                    <h6 class="font-light">Subscribe and receive our newsletters to follow the news about our fresh
                        and fantastic Products.</h6>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                <div class="subsribe-input">
                    <div class="input-group">
                        <input type="text" class="form-control subscribe-input" placeholder="Your Email Address">
                        <button class="btn btn-solid-default" type="button">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Subscribe Section End -->
<div id="qvmodal"></div>

<form id="frmFilter" method="GET">
    <input type="hidden" id="page" name="page" value="1">
    <input type="hidden" id="size" name="size" value="12">
    <input type="hidden" id="prange" name="prange" value="">
    <input type="hidden" id="order" name="order" value="-1">
    <input type="hidden" id="brands" name="brands" value="">
    <input type="hidden" id="categorias" name="categorias" value="">
</form>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    const productGrid = document.querySelector('.product-list-section');

    // Inicializar ionRangeSlider
    $("#js-range-price").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: 0,
        to: 500,
        grid: true,
        onChange: function(data) {
            document.getElementById('min_price').value = data.from;
            document.getElementById('max_price').value = data.to;
        }
    });

    // Função para lidar com o clique em "Adicionar ao Carrinho"
    function handleAddToCart(event) {
        const botao = event.target.closest('.addtocart-btn');
        if (!botao) return;

        const produtoId = botao.getAttribute('data-id');
        const produtoElement = botao.closest('.product-box');
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

        fetch("/carrinho/adicionar", { // Corrigir a rota aqui
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
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
                loadingToast.hideToast();

                if (data.status === "error") {
                    Toastify({
                        text: data.message,
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                    return;
                }

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
            })
            .catch(err => {
                loadingToast.hideToast();
                Toastify({
                    text: "Erro inesperado. Tente novamente.",
                    duration: 4000,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#f44336",
                    stopOnFocus: true
                }).showToast();
                console.error("Erro na requisição:", err);
            });
    }

    // Delegação de eventos para .addtocart-btn
    productGrid.addEventListener('click', handleAddToCart);

    // Manipulação do formulário de filtro
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        
        // Certificar que os dados estão sendo coletados corretamente
        const data = {
            filtrar: 1, // Adicionar este campo
            sizes: formData.getAll('sizes[]'),
            categorias: formData.getAll('categorias[]').map(id => parseInt(id)).filter(id => !isNaN(id)),
            marcas: formData.getAll('marcas[]').map(id => parseInt(id)).filter(id => !isNaN(id)),
            min_price: formData.get('min_price') || null,
            max_price: formData.get('max_price') || null
        };

        console.log('Dados enviados:', data);

        // Mostrar loading
        productGrid.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Carregando...</span></div></div>';

        fetch(window.location.href, { // Usar a URL atual da página
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                console.log('Status da resposta:', response.status);
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Erro da API:', err);
                        throw err;
                    });
                }
                return response.json();
            })
            .then(responseData => {
                console.log('Resposta recebida:', responseData);
                
                if (responseData.status === 'error') {
                    throw new Error(responseData.message || 'Erro no filtro');
                }
                
                // Limpar grid de produtos
                productGrid.innerHTML = '';
                
                if (!responseData.data || responseData.data.length === 0) {
                    productGrid.innerHTML = '<div class="col-12"><p class="text-center">Nenhum produto encontrado com os filtros selecionados.</p></div>';
                    return;
                }

                // Adicionar produtos filtrados
                responseData.data.forEach(product => {
                    const showAddToCart = product.categoria_id != 2 && product.categoria_id != 1;
                    
                    const productHtml = `
                        <div>
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="/produto/${product.id}">
                                            <img src="${product.imagem_url || '/images/placeholder.jpg'}" class="w-100 blur-up lazyload" alt="${product.nome}">
                                        </a>
                                    </div>
                                    <div class="cart-wrap">
                                        <ul>
                                            ${showAddToCart ? `
                                                <li>
                                                    <a href="javascript:void(0)" class="addtocart-btn" data-id="${product.id}">
                                                        <i data-feather="shopping-cart"></i>
                                                    </a>
                                                </li>
                                            ` : ''}
                                            <li>
                                                <a href="/produto/${product.id}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="rating-details">
                                        <span class="font-light grid-content">${product.categoria?.nome || 'N/A'}</span>
                                        <ul class="rating mt-0">
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                        </ul>
                                    </div>
                                    <div class="main-price">
                                        <a href="/produto/${product.id}" class="font-default">
                                            <h5 class="ms-0">${product.nome}</h5>
                                        </a>
                                        <div class="listing-content">
                                            <span class="font-light">${product.marca?.nome || 'N/A'}</span>
                                            <p class="font-light">${product.descricao || ''}</p>
                                        </div>
                                        <h3 class="theme-color">$${product.valor}</h3>
                                        <button class="btn listing-content">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });
                
                // Reativar os ícones do Feather
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            })
            .catch(error => {
                console.error('Erro completo:', error);
                productGrid.innerHTML = '<div class="col-12"><p class="text-center text-danger">Erro ao carregar produtos. Tente novamente.</p></div>';
                
                // Mostrar toast de erro
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: "Erro ao filtrar produtos. Tente novamente.",
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                }
            });
    });
});
</script>
