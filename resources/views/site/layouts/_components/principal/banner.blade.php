<section class="py-12 md:py-16 bg-gradient-to-b from-amber-50 to-stone-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach ($categorias as $index => $categoria)
                @php $i++; @endphp
                <div class="group">
                    <article class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer h-[400px]"
                        role="button" 
                        tabindex="0"
                        aria-label="Categoria {{ $categoria->nome }}">
                        
                        <!-- Banner Image -->
                        <a href="{{ route('site.shop.categoria', $categoria->id) }}" 
                           class="block h-full w-full"
                           aria-hidden="true">
                            <img src="{{ asset('images/fashion/banner/' . $i . '.webp') }}"
                                data-src="{{ asset('images/fashion/banner/' . $i . '.webp') }}"
                                alt="{{ $categoria->nome }} - Banner" 
                                class="w-full h-full object-cover blur-up lazyload transition-transform duration-700 group-hover:scale-110" 
                                loading="lazy"
                                width="1200" 
                                height="600">
                        </a>
                        
                        <!-- Overlay com gradiente terroso -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#7A2F3D] via-[#7A2F3D]/70 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                        
                        <!-- Wishlist Button -->
                        <div class="absolute top-4 right-4 z-20">
                            <button class="bg-amber-100/90 hover:bg-[#7A2F3D] text-[#7A2F3D] hover:text-white p-3 rounded-full shadow-lg backdrop-blur-sm transition-all duration-300 transform hover:scale-110 hover:rotate-12" 
                                aria-label="Adicionar {{ $categoria->nome }} aos favoritos"
                                title="Favoritar">
                                <i class="far fa-star text-lg"></i>
                            </button>
                        </div>
                        
                        <!-- Banner Content -->
                        <a href="{{ route('site.shop.categoria', $categoria->id) }}" 
                           class="absolute inset-0 flex items-end z-10"
                           aria-label="Ver produtos de {{ $categoria->nome }}">
                            <div class="p-6 md:p-8 w-full transform transition-transform duration-500 group-hover:translate-y-0 translate-y-2">
                                <!-- Categoria Nome -->
                                <h2 class="text-3xl md:text-4xl font-bold text-white mb-3 tracking-tight leading-tight">
                                    {{ $categoria->nome }}
                                </h2>
                                
                                <!-- Descrição -->
                                <p class="text-amber-50 text-sm md:text-base mb-4 line-clamp-2 leading-relaxed opacity-90">
                                    {{ $categoria->descricao }}
                                </p>
                                
                                <!-- CTA -->
                                <div class="flex items-center gap-3 text-amber-100 group-hover:text-white transition-colors duration-300">
                                    <span class="text-sm md:text-base font-semibold tracking-wide uppercase border-b-2 border-amber-100 group-hover:border-white transition-colors duration-300">
                                        Ver coleção
                                    </span>
                                    <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                                </div>
                                
                                <!-- Decorative Element -->
                                <div class="absolute bottom-0 left-0 w-20 h-1 bg-gradient-to-r from-amber-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                        </a>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>