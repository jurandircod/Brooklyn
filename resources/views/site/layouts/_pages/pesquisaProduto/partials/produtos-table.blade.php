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

