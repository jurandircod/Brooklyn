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
                            <div class="cloth-details-size">
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
                                                    <a href="javascript:void(0)">P</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeP }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">M :</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeM }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">G</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeG }}</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">GG</a>
                                                    <a href="javascript:void(0)">{{ $estoque->quantidadeGG }}</a>
                                                </li>
                                        </ul>
                                    @else
                                        <h6 class="product-title size-text">Quantidade em estoque
                                        </h6>
                                        <li>

                                            <a href="javascript:void(0)">{{ $estoque->quantidade }}</a>
                                        </li>
                                        @endif
                                    </div>

                                    <h6 class="product-title product-title-2 d-block">Quantidade</h6>

                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus"
                                                    onclick="updateQuantity()" data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="text" name="quantity" id="quantity"
                                                class="form-control input-number" value="1">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus"
                                                    onclick="updateQuantity()" data-type="plus" data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buttons">
                                    
                                        <a href="javascript:void(0)" class="addtocart-btn btn btn-solid"
                                        data-id="{{ $produto->id }}">
                                        <i class="fa fa-shopping-cart"></i>

                                            <i data-feather="shopping-cart"></i>
                                        </a>
                                   
                                </div>

                                <ul class="product-count shipping-order">
                                    <li>
                                        <img src="../assets/images/gif/truck.png" class="img-fluid blur-up lazyload"
                                            alt="image">
                                        <span class="lang">Free shipping for orders above $500 USD</span>
                                    </li>
                                </ul>

                                <div class="mt-2 mt-md-3 border-product">
                                    <h6 class="product-title hurry-title d-block">Hurry Up! Left <span>10</span> in
                                        stock</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                    </div>
                                    <div class="font-light timer-5">
                                        <h5>Order in the next to get</h5>
                                        <ul class="timer1">
                                            <li class="counter">
                                                <h5 id="days">&#9251;</h5> Days :
                                            </li>
                                            <li class="counter">
                                                <h5 id="hours">&#9251;</h5> Hour :
                                            </li>
                                            <li class="counter">
                                                <h5 id="minutes">&#9251;</h5> Min :
                                            </li>
                                            <li class="counter">
                                                <h5 id="seconds">&#9251;</h5> Sec
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="border-product">
                                    <h6 class="product-title d-block">share it</h6>
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
                                data-bs-target="#desc" type="button">Description</button>

                            <button class="nav-link" id="nav-speci-tab" data-bs-toggle="tab" data-bs-target="#speci"
                                type="button">Specifications</button>

                            <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-guide" type="button">Sizing Guide</button>

                            <button class="nav-link" id="nav-question-tab" data-bs-toggle="tab"
                                data-bs-target="#question" type="button">Q & A</button>

                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#review" type="button">Review</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <div class="shipping-chart">
                                <div class="part">
                                    <h4 class="inner-title mb-2">Give you a complete account of the system</h4>
                                    <p class="font-light">Nor again is there anyone who loves or pursues or desires
                                        to
                                        obtain pain of itself, because it is pain, but because occasionally
                                        circumstances occur in which toil and pain can procure him some great
                                        pleasure.
                                        To take a trivial example, which of us ever undertakes laborious physical
                                        exercise, except to obtain some advantage from it? But who has any right to
                                        find
                                        fault with a man who chooses to enjoy a pleasure that has no annoying
                                        consequences, or one who avoids a pain that produces no resultant pleasure.
                                    </p>
                                </div>

                                <div class="row g-3 align-items-center">
                                    <div class="col-lg-8">
                                        <p class="font-light">Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit.
                                            Ab, autem nemo? Tempora vitae assumenda laudantium unde magni, soluta
                                            repudiandae quam, neque voluptate deleniti consequatur laboriosam
                                            veritatis?
                                            Tempore dolor molestias voluptatum! Minima possimus, pariatur sed, quasi
                                            provident dolorum unde molestias, assumenda consequuntur odit magni
                                            blanditiis obcaecati? Ea corporis odit dolorem fuga, fugiat soluta
                                            consequuntur magni.</p>

                                        <div class="part mt-3">
                                            <h5 class="inner-title mb-2">fabric:</h5>
                                            <p class="font-light">Art silk is manufactured by synthetic fibres like
                                                rayon. It's light in weight and is soft on the skin for comfort in
                                                summers.Art silk is manufactured by synthetic fibres like rayon.
                                                It's
                                                light in weight and is soft on the skin for comfort in summers.</p>
                                            <p class="font-light">Lorem Ipsum is simply dummy text of the printing
                                                and typesetting industry. Lorem Ipsum has been the industry's
                                                standard dummy text ever since the 1500s</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <img src="../assets/images/fashion/slider/1.jpg"
                                            class="img-fluid rounded blur-up lazyload" alt="">
                                    </div>

                                    <div class="col-lg-8 order-lg-2 mt-4">
                                        <p class="font-light">Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit.
                                            Ab, autem nemo? Tempora vitae assumenda laudantium unde magni, soluta
                                            repudiandae quam, neque voluptate deleniti consequatur laboriosam
                                            veritatis?
                                            Tempore dolor molestias voluptatum! Minima possimus, pariatur sed, quasi
                                            provident dolorum unde molestias, assumenda consequuntur odit magni
                                            blanditiis obcaecati? Ea corporis odit dolorem fuga, fugiat soluta
                                            consequuntur magni.</p>
                                        <div class="part mt-3">
                                            <p class="font-light">Lorem ipsum, dolor sit amet consectetur
                                                adipisicing
                                                elit. Odio repellat numquam perspiciatis eum quis ab, sed dicta
                                                tenetur
                                                fugit culpa, aut distinctio deserunt quisquam ipsam reprehenderit
                                                iure?
                                                Adipisci, optio enim? Voluptates voluptatum neque id ad commodi
                                                quisquam
                                                dolorem vitae inventore quasi! Officiis facere, iusto tempore atque
                                                magnam voluptas. Architecto laboriosam deleniti hic veritatis
                                                nesciunt.
                                                Aut officia quasi inventore et. Debitis.</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 order-lg-0 mt-4">
                                        <img src="../assets/images/fashion/slider/2.jpg"
                                            class="img-fluid rounded blur-up lazyload" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="speci">
                            <div class="pro mb-4">
                                <p class="font-light">The Model is wearing a white blouse from our stylist's
                                    collection, see the image for a mock-up of what the actual blouse would look
                                    like.it has text written on it in a black cursive language which looks great
                                    on a white color.</p>
                                <div class="table-responsive">
                                    <table class="table table-part">
                                        <tr>
                                            <th>Product Dimensions</th>
                                            <td>15 x 15 x 3 cm; 250 Grams</td>
                                        </tr>
                                        <tr>
                                            <th>Date First Available</th>
                                            <td>5 April 2021</td>
                                        </tr>
                                        <tr>
                                            <th>Manufacturer‏</th>
                                            <td>Aditya Birla Fashion and Retail Limited</td>
                                        </tr>
                                        <tr>
                                            <th>ASIN</th>
                                            <td>B06Y28LCDN</td>
                                        </tr>
                                        <tr>
                                            <th>Item model number</th>
                                            <td>AMKP317G04244</td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>Men</td>
                                        </tr>
                                        <tr>
                                            <th>Item Weight</th>
                                            <td>250 G</td>
                                        </tr>
                                        <tr>
                                            <th>Item Dimensions LxWxH</th>
                                            <td>15 x 15 x 3 Centimeters</td>
                                        </tr>
                                        <tr>
                                            <th>Net Quantity</th>
                                            <td>1 U</td>
                                        </tr>
                                        <tr>
                                            <th>Included Components‏</th>
                                            <td>1-T-shirt</td>
                                        </tr>
                                        <tr>
                                            <th>Generic Name</th>
                                            <td>T-shirt</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade overflow-auto" id="nav-guide">
                            <div class="table-responsive">
                                <table class="table table-pane mb-0">
                                    <tbody>
                                        <tr class="bg-color">
                                            <th class="my-2">US Sizes</th>
                                            <td>6</td>
                                            <td>6.5</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>8.5</td>
                                            <td>9</td>
                                            <td>9.5</td>
                                            <td>10</td>
                                            <td>10.5</td>
                                            <td>11</td>
                                        </tr>

                                        <tr>
                                            <th>Euro Sizes</th>
                                            <td>39</td>
                                            <td>39</td>
                                            <td>40</td>
                                            <td>40-41</td>
                                            <td>41</td>
                                            <td>41-42</td>
                                            <td>42</td>
                                            <td>42-43</td>
                                            <td>43</td>
                                            <td>43-44</td>
                                        </tr>

                                        <tr class="bg-color">
                                            <th>UK Sizes</th>
                                            <td>5.5</td>
                                            <td>6</td>
                                            <td>6.5</td>
                                            <td>7</td>
                                            <td>7.5</td>
                                            <td>8</td>
                                            <td>8.5</td>
                                            <td>9</td>
                                            <td>10.5</td>
                                            <td>11</td>
                                        </tr>

                                        <tr>
                                            <th>Inches</th>
                                            <td>9.25"</td>
                                            <td>9.5"</td>
                                            <td>9.625"</td>
                                            <td>9.75"</td>
                                            <td>9.9735"</td>
                                            <td>10.125"</td>
                                            <td>10.25"</td>
                                            <td>10.5"</td>
                                            <td>10.765"</td>
                                            <td>10.85</td>
                                        </tr>

                                        <tr class="bg-color">
                                            <th>CM</th>
                                            <td>23.5</td>
                                            <td>24.1</td>
                                            <td>24.4</td>
                                            <td>25.4</td>
                                            <td>25.7</td>
                                            <td>26</td>
                                            <td>26.7</td>
                                            <td>27</td>
                                            <td>27.3</td>
                                            <td>27.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="question">
                            <div class="question-answer">
                                <ul>
                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>Is it compatible with all WordPress themes?</h6>
                                                <p class="font-light">If you want to see a demonstration version of
                                                    the premium plugin, you can see that in this page. If you want
                                                    to see a demonstration version of the premium plugin, you can
                                                    see that in this page. If you want to see a demonstration
                                                    version of the premium plugin, you can see that in this page.
                                                </p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>How can I try the full-featured plugin? </h6>
                                                <p class="font-light">Compatibility with all themes is impossible,
                                                    because they are too many, but generally if themes are developed
                                                    according to WordPress and WooCommerce guidelines, YITH plugins
                                                    are compatible with them. Compatibility with all themes is
                                                    impossible, because they are too many, but generally if themes
                                                    are developed according to WordPress and WooCommerce guidelines,
                                                    YITH plugins are compatible with them.</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>Is it compatible with all WordPress themes?</h6>
                                                <p class="font-light">If you want to see a demonstration version of
                                                    the premium plugin, you can see that in this page. If you want
                                                    to see a demonstration version of the premium plugin, you can
                                                    see that in this page. If you want to see a demonstration
                                                    version of the premium plugin, you can see that in this page.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
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
    document.addEventListener("DOMContentLoaded", function() {
        const botoes = document.querySelectorAll(".addtocart-btn");

        botoes.forEach(botao => {
            botao.addEventListener("click", function() {
                const produtoId = this.getAttribute("data-id");
                const produtoElement = this.closest('.product-box');
                const produtoNome = produtoElement.querySelector('h5').textContent;
                const produtoPreco = produtoElement.querySelector('.theme-color').textContent;
                const produtoImagem = produtoElement.querySelector('img').src;

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
                            quantidade: 1
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
                            text: `${produtoNome} adicionado ao carrinho!`,
                            duration: 3000,
                            gravity: "bottom",
                            position: "right",
                            backgroundColor: "#4CAF50",
                            stopOnFocus: true
                        }).showToast();
                    })
                    .catch(err => {
                        loadingToast.hideToast();
                        Toastify({
                            text: "Erro ao adicionar ao carrinho",
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
