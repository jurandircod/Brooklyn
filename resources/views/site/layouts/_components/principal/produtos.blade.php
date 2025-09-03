<section class="ratio_asos overflow-hidden produtos-grid">
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
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <article class="product-card @if (!$produto->estoque) out-of-stock @endif"
                        aria-label="{{ $produto->nome }}">
                        <div class="img-wrapper">
                            <a href="{{ route('site.produto', ['id' => $produto->id]) }}" class="img-link"
                                tabindex="-1">
                                <img src="{{ $produto->imagem_url }}" alt="{{ $produto->nome }}"
                                    class="product-img blur-up lazyload" loading="lazy" width="600" height="600">
                            </a>

                            {{-- background decor --}}
                            <div class="card-deco"></div>

                            {{-- badge (dinâmico) --}}
                            <div class="label-block">
                                <span class="label label-theme">30% Off</span>
                            </div>

                            {{-- quick actions (aparecem no hover) --}}
                            <div class="card-actions" role="group" aria-hidden="true">
                                <button class="action-btn add-cart" data-id="{{ $produto->id }}"
                                    title="Adicionar ao carrinho"
                                    @if (!$produto->estoque) disabled aria-disabled="true" @endif>
                                    <i data-feather="shopping-cart"></i>
                                </button>

                                <a href="{{ route('site.produto', ['id' => $produto->id]) }}" class="action-btn view"
                                    title="Ver produto">
                                    <i data-feather="eye"></i>
                                </a>
                            </div>

                            @if (!$produto->estoque)
                                <div class="stock-overlay" aria-hidden="true">
                                    <span>Sem estoque</span>
                                </div>
                            @endif
                        </div>

                        <div class="product-info">
                            <div class="price-row">
                                <div class="price">R$ {{ number_format($produto->valor, 2, ',', '.') }}</div>
                                <div class="rating">
                                    <ul class="rating-list" aria-hidden="true">
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

                            <p class="material text-muted mb-1">{{ $produto->material }}</p>

                            <a href="{{ route('site.produto', ['id' => $produto->id]) }}" class="product-name">
                                <h5>{{ $produto->nome }}</h5>
                            </a>

                            @if (!$produto->estoque)
                                <div class="alert alert-warning mt-2 d-flex align-items-center stock-note"
                                    role="alert">
                                    <i data-feather="alert-circle" class="me-2"></i>
                                    <span>Produto sem estoque</span>
                                </div>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

    </div>
</section>

<style>
    :root {
        --brand: #5A1F2D;
        --accent: #667eea;
        --muted: #6c757d;
        --card-radius: 12px;
        --soft-shadow: 0 10px 30px rgba(11, 15, 30, 0.12);
    }

    /* Product grid container */
    .produtos-grid .product-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(0, 0, 0, 0.01));
        border-radius: var(--card-radius);
        overflow: hidden;
        transition: transform .22s ease, box-shadow .22s ease;
        border: 1px solid rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
    }

    /* hover elevation */
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--soft-shadow);
    }

    /* Image area with fixed aspect ratio */
    .product-card .img-wrapper {
        position: relative;
        width: 100%;
        padding-top: 100%;
        /* 1:1 square — mantém grid alinhado */
        overflow: hidden;
        background: #f6f6f6;
    }

    /* Actual image positioned absolutely for perfect crop */
    .product-card .img-wrapper .product-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .6s cubic-bezier(.2, .9, .2, 1), filter .25s ease;
        will-change: transform;
    }

    /* subtle zoom on hover */
    .product-card:hover .product-img {
        transform: scale(1.06);
        filter: saturate(1.02);
    }

    /* decorative circle / shape */
    .product-card .card-deco {
        position: absolute;
        right: -20%;
        bottom: -20%;
        width: 70%;
        height: 70%;
        background: radial-gradient(circle at 30% 30%, rgba(102, 126, 234, 0.12), rgba(90, 31, 45, 0.06));
        transform: rotate(-15deg);
        z-index: 0;
    }

    /* label (badge) */
    .product-card .label-block {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 4;
    }

    .product-card .label {
        background: linear-gradient(90deg, #ffb86b, #ff6b6b);
        color: #111;
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.82rem;
    }

    /* quick actions (appear on hover) */
    .product-card .card-actions {
        position: absolute;
        right: 10px;
        top: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        z-index: 5;
        opacity: 0;
        transform: translateY(-6px);
        transition: opacity .18s ease, transform .18s ease;
    }

    .product-card:hover .card-actions {
        opacity: 1;
        transform: translateY(0);
    }

    /* action buttons style */
    .action-btn {
        background: rgba(255, 255, 255, 0.92);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(11, 15, 30, 0.08);
        cursor: pointer;
        transition: transform .12s ease, background .12s ease;
    }

    .action-btn:hover {
        transform: translateY(-3px);
    }

    .action-btn:disabled,
    .action-btn[aria-disabled="true"] {
        opacity: .5;
        cursor: not-allowed;
    }

    /* Out of stock overlay */
    .product-card.out-of-stock .product-img {
        filter: grayscale(.35) contrast(.95) brightness(.85);
    }

    .product-card .stock-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 6;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.45));
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
    }

    /* product info area */
    .product-card .product-info {
        padding: 12px 10px 16px 10px;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .price {
        color: var(--brand);
        font-weight: 800;
        font-size: 1rem;
    }

    .rating-list {
        display: flex;
        gap: 4px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .rating-list li i {
        color: #f59e0b;
        font-size: 0.85rem;
    }

    /* material text */
    .product-info .material {
        font-size: 0.85rem;
        color: var(--muted);
    }

    /* product name */
    .product-name h5 {
        margin: 0;
        font-size: 0.95rem;
        color: #111;
        font-weight: 700;
    }

    /* small stock note styling (kept for semantic) */
    .stock-note {
        margin: 8px 0 0 0;
        font-size: 0.85rem;
    }

    /* Responsive tweaks */
    @media (max-width: 1200px) {
        .produtos-grid .col-xl-2 {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }

    @media (max-width: 992px) {
        .produtos-grid .col-lg-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }
    }

    @media (max-width: 768px) {
        .produtos-grid .col-md-4 {
            flex: 0 0 33.333%;
            max-width: 33.333%;
        }

        .product-card .card-actions {
            right: 8px;
            top: 8px;
        }
    }

    @media (max-width: 576px) {
        .produtos-grid .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .product-card .img-wrapper {
            padding-top: 100%;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // -- melhorias UX para produtos (colar dentro do DOMContentLoaded existente) --
        (function() {
            // substituir ícones feather (se estiver usando feather)
            if (window.feather) {
                feather.replace({
                    'aria-hidden': 'true'
                });
            }

            // colocar feedback visual ao clicar em adicionar ao carrinho
            document.querySelectorAll('.product-card .add-cart').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (this.disabled) return;
                    const produtoId = this.getAttribute('data-id');

                    // micro-feedback: anima o botão e troca ícone por check temporário
                    const origHtml = this.innerHTML;
                    this.classList.add('added');
                    this.style.transform = 'scale(0.96)';
                    this.innerHTML =
                        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';

                    // reverter e disparar evento custom (pode ser capturado para adicionar AJAX)
                    setTimeout(() => {
                        this.style.transform = '';
                        this.innerHTML = origHtml;
                        this.classList.remove('added');

                        // Dispara evento custom para integrar com seu JS de carrinho
                        const event = new CustomEvent('produto:addCarrinho', {
                            detail: {
                                produtoId
                            }
                        });
                        document.dispatchEvent(event);
                    }, 900);
                });
            });

            // permite abrir produto com Enter quando o cartão estiver com foco
            document.querySelectorAll('.product-card').forEach(card => {
                card.setAttribute('tabindex', '0');
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        const link = this.querySelector('.img-link') || this.querySelector(
                            '.product-name a');
                        if (link) link.click();
                    }
                });
            });

            // Exemplo: ouvir evento para integrar com seu fluxo de adicionar ao carrinho
            // document.addEventListener('produto:addCarrinho', function(e){
            //   // e.detail.produtoId -> aqui você pode chamar seu AJAX ou lógica
            //   console.log('Adicionar produto ao carrinho:', e.detail.produtoId);
            // });

        })();

    });
</script>
