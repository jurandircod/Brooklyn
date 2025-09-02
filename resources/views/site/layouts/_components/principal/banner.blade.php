<section class="ratio2_1 banner-style-2">
    <div class="container">
        <div class="row gy-4">
            @foreach ($categorias as $index => $categoria)
                <div class="col-lg-4 col-md-6">

                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="shop-left-sidebar.html" class="banner-img">
                            <img src="{{ asset('images/fashion/banner/1.jpg') }}" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <div class="banner-detail">
                            <a href="javacript:void(0)" class="heart-wishlist">
                                <i class="far fa-heart"></i>
                            </a>
                            <span class="font-dark-30">26% <span>OFF</span></span>
                        </div>
                        <a href="shop-left-sidebar.html" class="contain-banner">
                            <div class="banner-content with-big">
                                <h2 class="mb-2">{{ $categoria->nome }}</h2>
                                <span>{{ $categoria->descricao }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
