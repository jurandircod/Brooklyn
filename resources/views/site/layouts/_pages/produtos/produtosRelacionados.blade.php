@section('produto-relacionados')
<section class="ratio_asos section-b-space">
    <div class="container">
        <h2 class="mb-lg-4 mb-3 text-center color-white">Novos Produtos</h2>
        <div class="row">
            @foreach ($produtosDaMesmaCategoria as $index => $produto)
                @if ($produto->estoque && $produto->estoque->quantidade > 0)
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
                                            <ul class="rating mb-1 mt-0 ms-0">
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
                                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}"
                                        class="font-default">
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
                                            <a href="javascript:void(0)" class="disabled"
                                                title="Produto sem estoque">
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
                                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}"
                                        class="font-default">
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
    </div>
</section>
@endsection