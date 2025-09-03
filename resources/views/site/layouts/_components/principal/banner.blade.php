<section class="ratio2_1 banner-style-2">
  <div class="container">
    <div class="row gy-4">
      @foreach ($categorias as $index => $categoria)
        <div class="col-lg-4 col-md-6">
          <article class="collection-banner card-banner" role="button" tabindex="0" aria-label="Categoria {{ $categoria->nome }}">
            <a href="shop-left-sidebar.html" class="banner-img" aria-hidden="true">
              <img
                src="{{ asset('images/fashion/banner/1.jpg') }}"
                data-src="{{ asset('images/fashion/banner/1.jpg') }}"
                alt="{{ $categoria->nome }} - Banner"
                class="bg-img blur-up lazyload"
                loading="lazy"
                width="1200" height="600"
                style="object-fit:cover;">
            </a>

            <div class="overlay"></div>

            <div class="banner-detail">
              <span class="discount-badge">26% <small>OFF</small></span>
              <button class="wishlist" aria-label="Adicionar {{ $categoria->nome }} aos favoritos" title="Favoritar">
                <i class="far fa-heart"></i>
              </button>
            </div>

            <a href="shop-left-sidebar.html" class="contain-banner" aria-label="Ver produtos de {{ $categoria->nome }}">
              <div class="banner-content with-big">
                <h2 class="mb-2">{{ $categoria->nome }}</h2>
                <p class="desc text-truncate-2">{{ $categoria->descricao }}</p>
                <div class="cta-row">
                  <span class="cta-text">Ver coleção</span>
                  <i class="fas fa-arrow-right"></i>
                </div>
              </div>
            </a>
          </article>
        </div>
      @endforeach
    </div>
  </div>
</section>
