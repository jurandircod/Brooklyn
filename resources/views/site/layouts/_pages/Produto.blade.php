<style>
    header .profile-dropdown ul li {
        display: block;
        padding: 5px 20px;
        border-bottom: 1px solid #ddd;
        line-height: 35px;
    }

    header .profile-dropdown ul li:last-child {
        border-color: #fff;
    }

    header .profile-dropdown ul {
        padding: 10px 0;
        min-width: 250px;
    }

    .name-usr {
        background: #e87316;
        padding: 8px 12px;
        color: #fff;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 24px;
    }

    .name-usr span {
        margin-right: 10px;
    }

    @media (max-width:600px) {
        .h-logo {
            max-width: 150px !important;
        }

        i.sidebar-bar {
            font-size: 22px;
        }

        .mobile-menu ul li a svg {
            width: 20px;
            height: 20px;
        }

        .mobile-menu ul li a span {
            margin-top: 0px;
            font-size: 12px;
        }

        .name-usr {
            padding: 5px 12px;
        }
    }
</style>


<div class="mobile-menu d-sm-none">
    <ul>
        <li>
            <a href="demo3.php" class="active">
                <i data-feather="home"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="align-justify"></i>
                <span>Category</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="shopping-bag"></i>
                <span>Cart</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <i data-feather="heart"></i>
                <span>Wishlist</span>
            </a>
        </li>
        <li>
            <a href="user-dashboard.php">
                <i data-feather="user"></i>
                <span>Account</span>
            </a>
        </li>
    </ul>
</div>
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
                <h3>Pagina Principal do Produto</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.htm">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Brooklyn SkateShop</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> <!-- Shop Section start -->

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

                                    <h6 class="error-message">please select size</h6>

                                    <div class="size-box">
                                        <ul>
                                            @if ($produto->categoria_id == 1)
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="P">P</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeP }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="M">M</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeM }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="G">G</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeG }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="GG">GG</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeGG }}</a>
                                                </li>
                                            @else
                                                <h6 class="product-title size-text">Tamanhos</h6>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="775">7.75</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidade775 }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="8">8</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidade8 }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="825">8.25</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidade825 }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="size-option"
                                                        data-size="85">8.5</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidade85 }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <input type="hidden" id="selected-size" name="selected_size">

                                </div>

                                <input type="number" id="quantidade" name="quantidade" class="form-control"
                                    min="1" value="1" style="width: 100px;" />
                                <small id="quantidade-error" style="color: red; display: none;">Quantidade
                                    indisponível para o estoque selecionado</small>

                            </div>

                            <div class="product-buttons">
                                <a href="javascript:void(0)" data-id="{{ $produto->id }}" id="cartEffect"
                                    class="addtocart-btn btn btn-solid hover-solid btn-animation">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Adicionar ao carrinho</span>
                                </a>
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

        <div class="col-12">
            <div class="cloth-review">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#desc" type="button">Descrição</button>

                        <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab" data-bs-target="#nav-guide"
                            type="button">Tamanhos</button>

                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#review"
                            type="button">Avaliação</button>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="desc">
                        <div class="shipping-chart">
                            <div class="part">
                                <h4 class="inner-title mb-2">{{ $produto->nome }}</h4>
                                <p class="font-light">{{ $produto->descricao }}</p>
                            </div>
                        </div>
                    </div>



                    <div class="tab-pane fade overflow-auto" id="nav-guide">
                        <div class="table-responsive">
                            <table class="table table-pane mb-0">
                                <tbody>
                                    <tr class="bg-color">
                                        <th class="my-2">Tamanhos dos skates</th>
                                        <td></td>
                                        <td>6.5</td>
                                        <td>7.5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="tab-pane fade" id="review">
                        <div class="row g-4">
                            <div class="col-lg-4">
                                <div class="customer-rating">
                                    <h2>Customer reviews</h2>
                                    <ul class="rating my-2 d-inline-block">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
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
                                    </ul>

                                    <div class="global-rating">
                                        <h5 class="font-light">82 Ratings</h5>
                                    </div>

                                    <ul class="rating-progess">
                                        <li>
                                            <h5 class="me-3">5 Star</h5>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 78%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <h5 class="ms-3">78%</h5>
                                        </li>
                                        <li>
                                            <h5 class="me-3">4 Star</h5>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 62%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <h5 class="ms-3">62%</h5>
                                        </li>
                                        <li>
                                            <h5 class="me-3">3 Star</h5>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 44%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <h5 class="ms-3">44%</h5>
                                        </li>
                                        <li>
                                            <h5 class="me-3">2 Star</h5>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 30%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <h5 class="ms-3">30%</h5>
                                        </li>
                                        <li>
                                            <h5 class="me-3">1 Star</h5>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 18%"
                                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <h5 class="ms-3">18%</h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <p class="d-inline-block me-2">Rating</p>
                                <ul class="rating mb-3 d-inline-block">
                                    <li>
                                        <i class="fas fa-star theme-color"></i>
                                    </li>
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
                                </ul>
                                <div class="review-box">
                                    <form class="row g-4">
                                        <div class="col-12 col-md-6">
                                            <label class="mb-1" for="name">Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter your name" required="">
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="mb-1" for="id">Email Address</label>
                                            <input type="email" class="form-control" id="id"
                                                placeholder="Email Address" required="">
                                        </div>

                                        <div class="col-12">
                                            <label class="mb-1" for="comments">Comments</label>
                                            <textarea class="form-control" placeholder="Leave a comment here" id="comments" style="height: 100px"
                                                required=""></textarea>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn default-light-theme default-theme default-theme-2">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="customer-review-box">
                                    <h4>Customer Reviews</h4>

                                    <div class="customer-section">
                                        <div class="customer-profile">
                                            <img src="../assets/images/inner-page/review-image/1.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>

                                        <div class="customer-details">
                                            <h5>Mike K</h5>
                                            <ul class="rating my-2 d-inline-block">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
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
                                            </ul>
                                            <p class="font-light">I purchased my Tab S2 at Best Buy but I wanted
                                                to
                                                share my thoughts on Amazon. I'm not going to go over specs and
                                                such
                                                since you can read those in a hundred other places. Though I
                                                will
                                                say that the "new" version is preloaded with Marshmallow and now
                                                uses a Qualcomm octacore processor in place of the Exynos that
                                                shipped with the first gen.</p>

                                            <p class="date-custo font-light">- Sep 08, 2021</p>
                                        </div>
                                    </div>

                                    <div class="customer-section">
                                        <div class="customer-profile">
                                            <img src="../assets/images/inner-page/review-image/2.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>

                                        <div class="customer-details">
                                            <h5>Norwalker</h5>
                                            <ul class="rating my-2 d-inline-block">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
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
                                            </ul>
                                            <p class="font-light">Pros: Nice large(9.7") screen. Bright colors.
                                                Easy
                                                to setup and get started. Arrived on time. Cons: a bit slow on
                                                response, but expected as tablet is 2 generations old. But works
                                                fine and good value for the money.</p>

                                            <p class="date-custo font-light">- Sep 08, 2021</p>
                                        </div>
                                    </div>

                                    <div class="customer-section">
                                        <div class="customer-profile">
                                            <img src="../assets/images/inner-page/review-image/3.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>

                                        <div class="customer-details">
                                            <h5>B. Perdue</h5>
                                            <ul class="rating my-2 d-inline-block">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
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
                                            </ul>
                                            <p class="font-light">Love the processor speed and the sensitivity
                                                of
                                                the touch screen.</p>

                                            <p class="date-custo font-light">- Sep 08, 2021</p>
                                        </div>
                                    </div>

                                    <div class="customer-section">
                                        <div class="customer-profile">
                                            <img src="../assets/images/inner-page/review-image/4.jpg"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>

                                        <div class="customer-details">
                                            <h5>MSL</h5>
                                            <ul class="rating my-2 d-inline-block">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
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
                                            </ul>
                                            <p class="font-light">I purchased the Tablet May 2017 and now April
                                                2019
                                                I have to charge it everyday. I don't watch movies on it..just
                                                play
                                                a game or two while on lunch. I guess now I need to power it
                                                down
                                                for future use.</p>

                                            <p class="date-custo font-light">- Sep 08, 2021</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Shop Section end -->

<!-- product section start -->
<section class="ratio_asos section-b-space overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-lg-4 mb-3">Customers Also Bought These</h2>
                <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/23.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/23.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Cupiditate Minus</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Qui Laboriosam Quas Beatae</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Dolorem nihil quia qui laudantium expedita aut dolor.
                                            Qui eligendi voluptatem autem ullam et. Voluptas nemo eum nihil aliquam
                                            eos aperiam. Numquam dolorum veniam non magnam illum odit deleniti.</p>
                                    </div>
                                    <h3 class="theme-color">$1</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/6.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/6.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Id Expedita Dolorem Sit</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Rerum consequatur sunt placeat qui vero quod.
                                            Voluptatem doloremque commodi quaerat autem fugiat iste. Voluptatem
                                            repudiandae suscipit aut aspernatur maiores repellat corrupti.</p>
                                    </div>
                                    <h3 class="theme-color">$19</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/12.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/12.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Blanditiis Error</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Laborum Debitis Necessitatibus Architecto</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Ullam iure distinctio quaerat nam quasi rerum
                                            nesciunt. Eius ut porro tempore error. Quo quibusdam est praesentium
                                            quam reprehenderit officia vero. Commodi perspiciatis totam rerum
                                            voluptatem.</p>
                                    </div>
                                    <h3 class="theme-color">$4</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/11.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/11.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Cupiditate Minus</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Quidem Architecto Deleniti Hic</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Sit repellat fugit recusandae voluptates et est.
                                            Similique et consequuntur alias officia eos. Quos sed temporibus magnam
                                            est quo aut. Totam at ducimus occaecati sequi sint sed enim.</p>
                                    </div>
                                    <h3 class="theme-color">$7</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/20.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/20.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Error Itaque Debitis Commodi</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Quos voluptates aut dolorum. Velit delectus eligendi
                                            quia est. Explicabo sit dolores laboriosam ullam voluptas.</p>
                                    </div>
                                    <h3 class="theme-color">$5</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/8.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/8.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Blanditiis Error</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Odit Corporis Ut Pariatur</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Corrupti et assumenda saepe natus voluptatem deserunt
                                            aliquam. Non esse nemo exercitationem. Expedita libero quos quibusdam.
                                        </p>
                                    </div>
                                    <h3 class="theme-color">$18</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/2.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/2.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Dolores Et</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Doloremque Quibusdam Maxime Natus</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Hic fugiat molestiae sed. Impedit iusto nihil odio
                                            eos. Nisi et est aperiam ut non culpa amet. Nemo aut et ipsa pariatur
                                            cumque. Totam eveniet voluptatibus nostrum.</p>
                                    </div>
                                    <h3 class="theme-color">$11</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/14.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/14.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
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
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
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
                                    <a href="details.php" class="font-default">
                                        <h5>Pariatur Qui Mollitia Et</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Vero asperiores error sint soluta. Quia ut corrupti
                                            perferendis quo vero. Recusandae quae et possimus. Aut voluptatem sunt
                                            sit aliquid corporis aliquam.</p>
                                    </div>
                                    <h3 class="theme-color">$8</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedSize = null;
        let estoqueDisponivel = {
            @if ($produto->categoria_id == 1)
                P: {{ $estoque->quantidadeP }},
                M: {{ $estoque->quantidadeM }},
                G: {{ $estoque->quantidadeG }},
                GG: {{ $estoque->quantidadeGG }},
            @else
                775: {{ $estoque->quantidade775 }},
                8: {{ $estoque->quantidade8 }},
                825: {{ $estoque->quantidade825 }},
                85: {{ $estoque->quantidade85 }},
            @endif
        };

        const sizeOptions = document.querySelectorAll(".size-option");
        const inputQuantidade = document.getElementById("quantidade");
        const errorMessage = document.querySelector(".error-message");
        const errorQuantidade = document.getElementById("quantidade-error");

        // Seleção de tamanho
        sizeOptions.forEach(option => {
            option.addEventListener("click", function () {
                sizeOptions.forEach(opt => opt.classList.remove('selected'));
                this.classList.add('selected');
                selectedSize = this.getAttribute('data-size');
                document.getElementById('selected-size').value = selectedSize;

                errorMessage.style.display = 'none';
                errorQuantidade.style.display = 'none';

                // Atualiza o valor máximo permitido com base no estoque
                const estoque = estoqueDisponivel[selectedSize] || 1;
                inputQuantidade.max = estoque;
                inputQuantidade.value = 1;
            });
        });

        const botoes = document.querySelectorAll(".addtocart-btn");

        botoes.forEach(botao => {
            botao.addEventListener("click", function () {
                if (!selectedSize) {
                    errorMessage.style.display = 'block';
                    return;
                }

                const quantidade = parseInt(inputQuantidade.value);
                const estoqueMaximo = estoqueDisponivel[selectedSize] || 0;

                if (quantidade > estoqueMaximo) {
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
                        tamanho: selectedSize
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
                            title: 'Adicionado ao carrinho!',
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
                            text: data.message || 'Erro ao adicionar ao carrinho.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        Toastify({
                            text: data.message || "Erro ao adicionar ao carrinho.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f44336",
                            stopOnFocus: true
                        }).showToast();
                    }
                });
            });
        });
    });
</script>

