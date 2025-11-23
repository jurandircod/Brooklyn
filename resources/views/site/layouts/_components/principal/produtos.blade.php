<section class="py-20 px-4 bg-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16 space-y-2">
            <p class="text-sm font-medium text-[#5A1F2D] tracking-wide uppercase">Nossa Coleção</p>
            <h2 class="text-4xl md:text-5xl font-light text-gray-900 tracking-tight">
                Novos Produtos
            </h2>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 md:gap-8">
            @foreach ($produtos as $index => $produto)
            <article class="group relative bg-white flex flex-col {{ !$produto->estoque ? 'opacity-60' : '' }}">
                
                <!-- Image Container -->
                <div class="relative aspect-square overflow-hidden bg-gray-50 mb-4">
                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}" 
                       class="block w-full h-full">
                        <img src="{{ $produto->imagem_url }}" 
                             alt="{{ $produto->nome }}"
                             class="w-full h-full object-cover transition-opacity duration-500 group-hover:opacity-90"
                             loading="lazy">
                    </a>

                    <!-- Badge Minimalista -->
                    @if ($produto->estoque)
                    <div class="absolute top-3 left-3 z-10">
                        <span class="inline-block px-2.5 py-1 bg-[#5A1F2D] text-white text-xs font-medium">
                            -30%
                        </span>
                    </div>
                    @endif

                    <!-- Quick Actions - Clean -->
                    <div class="top-3 right-3 z-10 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <button class="w-9 h-9 bg-white border border-gray-200 flex items-center justify-center hover:border-[#5A1F2D] hover:bg-[#5A1F2D] hover:text-white transition-all duration-300 {{ !$produto->estoque ? 'opacity-50 cursor-not-allowed' : '' }}"
                                data-id="{{ $produto->id }}"
                                title="Adicionar ao carrinho"
                                {{ !$produto->estoque ? 'disabled' : '' }}>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </button>
                        
                        <a href="{{ route('site.produto', ['id' => $produto->id]) }}" 
                           class="w-9 h-9 bg-white border border-gray-200 flex items-center justify-center hover:border-[#5A1F2D] hover:bg-[#5A1F2D] hover:text-white transition-all duration-300"
                           title="Ver detalhes">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Out of Stock Overlay -->
                    @if (!$produto->estoque)
                    <div class="absolute inset-0 bg-white/80 flex items-center justify-center z-20">
                        <span class="text-xs font-medium text-gray-900 tracking-wider uppercase">
                            Esgotado
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="flex-1 flex flex-col space-y-2">
                    <!-- Category/Material -->
                    <span class="text-xs text-gray-500 tracking-wide uppercase">
                        {{ $produto->material }}
                    </span>

                    <!-- Product Name -->
                    <a href="{{ route('site.produto', ['id' => $produto->id]) }}" 
                       class="block">
                        <h3 class="text-sm font-normal text-gray-900 line-clamp-2 group-hover:text-[#5A1F2D] transition-colors duration-200">
                            {{ $produto->nome }}
                        </h3>
                    </a>

                    <!-- Spacer -->
                    <div class="flex-1"></div>

                    <!-- Price & Rating -->
                    <div class="pt-2 space-y-2">
                        <!-- Price -->
                        <div class="flex items-baseline gap-2">
                            <span class="text-lg font-medium text-gray-900">
                                R$ {{ number_format($produto->valor, 2, ',', '.') }}
                            </span>
                            <span class="text-xs text-gray-400 line-through">
                                R$ {{ number_format($produto->valor * 1.3, 2, ',', '.') }}
                            </span>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            @php
                                $rating = $produto->avaliacao->count() > 0 ? $produto->avaliacao->first()->estrela : 5;
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg class="w-3 h-3 text-gray-200 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <!-- Add to Cart Button - Clean -->
                    @if ($produto->estoque)
                    <button class="mt-3 w-full py-2.5 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300 flex items-center justify-center gap-2"
                            data-id="{{ $produto->id }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Adicionar
                    </button>
                    @else
                    <button class="mt-3 w-full py-2.5 bg-gray-100 text-gray-400 text-sm font-medium cursor-not-allowed flex items-center justify-center gap-2"
                            disabled>
                        Indisponível
                    </button>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-16">
            <a href="#" class="inline-flex items-center gap-3 px-8 py-3 border-2 border-[#5A1F2D] text-[#5A1F2D] font-medium hover:bg-[#5A1F2D] hover:text-white transition-all duration-300">
                Ver Toda Coleção
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<style>
    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth transitions */
    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Focus states for accessibility */
    button:focus-visible,
    a:focus-visible {
        outline: 2px solid #5A1F2D;
        outline-offset: 2px;
    }

    /* Prevent layout shift */
    img {
        content-visibility: auto;
    }

    /* Hover effect refinement */
    @media (hover: hover) {
        .group:hover img {
            transform: scale(1.02);
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
    }
</style>