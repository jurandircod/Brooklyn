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
                                                        name="sizes[]" type="checkbox" value="p">
                                                    <label class="form-check-label" for="size_p">P</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_m"
                                                        name="sizes[]" type="checkbox" value="m">
                                                    <label class="form-check-label" for="size_m">M</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_g"
                                                        name="sizes[]" type="checkbox" value="g">
                                                    <label class="form-check-label" for="size_g">G</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_gg"
                                                        name="sizes[]" type="checkbox" value="gg">
                                                    <label class="form-check-label" for="size_gg">GG</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_775"
                                                        name="sizes[]" type="checkbox" value="775">
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
                                                        name="sizes[]" type="checkbox" value="825">
                                                    <label class="form-check-label" for="size_825">8.25</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_85"
                                                        name="sizes[]" type="checkbox" value="85">
                                                    <label class="form-check-label" for="size_85">8.5</label>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_38"
                                                        name="sizes[]" type="checkbox" value="38">
                                                    <label class="form-check-label" for="size_38">38</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_39"
                                                        name="sizes[]" type="checkbox" value="39">
                                                    <label class="form-check-label" for="size_39">39</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_40"
                                                        name="sizes[]" type="checkbox" value="40">
                                                    <label class="form-check-label" for="size_40">40</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_41"
                                                        name="sizes[]" type="checkbox" value="41">
                                                    <label class="form-check-label" for="size_41">41</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_42"
                                                        name="sizes[]" type="checkbox" value="42">
                                                    <label class="form-check-label" for="size_42">42</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check ps-0 custome-form-check">
                                                    <input class="checkbox_animated check-it" id="size_43"
                                                        name="sizes[]" type="checkbox" value="43">
                                                    <label class="form-check-label" for="size_43">43</label>
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
                <div class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section"
                    id="produtos-table-container">
                    @include('site.layouts._pages.pesquisaProduto.partials.produtos-table', [
                        'produtos' => $produtos,
                    ])
                </div>

                <div class="row mt-5" id="produtos-pagination-container">
                    @include('site.layouts._pages.pesquisaProduto.partials.produtos-pagination')
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

<script src="{{ asset('js/site/pesquisaProduto/pesquisa.js') }}"></script>
