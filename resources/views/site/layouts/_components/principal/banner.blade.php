<section class="hidden lg:block py-12 bg-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-[#5A1F2D] to-transparent rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-gradient-to-tl from-[#5A1F2D] to-transparent rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <span class="text-[#5A1F2D] font-mono text-xs tracking-[0.3em] uppercase mb-1 block">// New Season</span>
                <h2 class="text-3xl font-black text-[#5A1F2D] tracking-tight">EXPLORE<span class="text-neutral-400">.</span></h2>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-neutral-400 text-xs font-mono">SCROLL →</span>
                <div class="w-16 h-[2px] bg-gradient-to-r from-[#5A1F2D] to-transparent"></div>
            </div>
        </div>

        <!-- Banners Grid -->
        <div class="grid grid-cols-3 gap-4">

            @foreach ($categorias as $index => $categoria)
                @php $i++; @endphp

                <div class="group relative">
                    <article class="relative overflow-hidden rounded-2xl cursor-pointer h-[380px] 
                        bg-neutral-900 border border-neutral-200
                        transition-all duration-700 ease-out
                        hover:border-[#5A1F2D]/50 hover:shadow-[0_0_40px_-15px_rgba(90,31,45,0.5)]"
                        role="button" 
                        tabindex="0"
                        aria-label="Categoria {{ $categoria->nome }}">

                        <!-- Número do Card -->
                        <div class="absolute top-4 left-4 z-30">
                            <span class="text-[80px] font-black text-white/[0.03] leading-none select-none
                                group-hover:text-[#5A1F2D]/10 transition-colors duration-500">
                                0{{ $i }}
                            </span>
                        </div>

                        <!-- Banner Image -->
                        <a href="{{ route('site.shop.categoria', $categoria->id) }}" 
                           class="block h-full w-full absolute inset-0"
                           aria-hidden="true">
                            <img src="{{ asset('images/fashion/banner/' . $i . '.webp') }}"
                                alt="{{ $categoria->nome }} - Banner" 
                                class="w-full h-full object-cover blur-up lazyload 
                                    transition-all duration-700 ease-out
                                    grayscale group-hover:grayscale-0
                                    scale-105 group-hover:scale-100" 
                                loading="lazy">
                        </a>

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t 
                            from-black via-black/60 to-transparent
                            opacity-90 group-hover:opacity-70 transition-opacity duration-500">
                        </div>

                        <!-- Glitch Line Effect -->
                        <div class="absolute top-1/3 left-0 w-full h-[1px] bg-[#5A1F2D]/0 
                            group-hover:bg-[#5A1F2D]/30 transition-all duration-300
                            group-hover:shadow-[0_0_15px_rgba(90,31,45,0.6)]"></div>

                        <!-- Tag Badge -->
                        <div class="absolute top-4 right-4 z-20">
                            <div class="bg-[#5A1F2D] text-white px-3 py-1.5 rounded-full
                                font-bold text-[10px] uppercase tracking-wider
                                transform -rotate-3 group-hover:rotate-0
                                transition-transform duration-300
                                shadow-[3px_3px_0_0_rgba(0,0,0,0.8)]">
                                NEW
                            </div>
                        </div>

                        <!-- Favorite Button -->
                        <div class="absolute top-14 right-4 z-20 
                            opacity-0 group-hover:opacity-100 
                            transform translate-x-4 group-hover:translate-x-0
                            transition-all duration-500 delay-100">
                            <button class="bg-white/10 backdrop-blur-md hover:bg-[#5A1F2D] 
                                text-white p-2.5 rounded-lg border border-white/20
                                transition-all duration-300 hover:scale-110"
                                aria-label="Adicionar {{ $categoria->nome }} aos favoritos">
                                <i class="far fa-heart text-sm"></i>
                            </button>
                        </div>

                        <!-- Content -->
                        <a href="{{ route('site.shop.categoria', $categoria->id) }}" 
                           class="absolute inset-0 flex items-end z-10">
                            <div class="p-6 w-full">

                                <!-- Category Label -->
                                <div class="flex items-center gap-2 mb-3
                                    transform translate-y-4 group-hover:translate-y-0
                                    opacity-0 group-hover:opacity-100
                                    transition-all duration-500">
                                    <div class="w-6 h-[2px] bg-[#5A1F2D]"></div>
                                    <span class="text-[#5A1F2D] text-[10px] font-mono uppercase tracking-widest">
                                        Categoria
                                    </span>
                                </div>

                                <!-- Title -->
                                <h2 class="text-2xl xl:text-3xl font-black text-white mb-2 
                                    tracking-tight leading-none
                                    transform translate-y-2 group-hover:translate-y-0
                                    transition-transform duration-500">
                                    {{ strtoupper($categoria->nome) }}
                                </h2>

                                <!-- Description -->
                                <p class="text-neutral-400 text-xs mb-4 line-clamp-2 max-w-[240px]
                                    transform translate-y-4 group-hover:translate-y-0
                                    opacity-0 group-hover:opacity-100
                                    transition-all duration-500 delay-75">
                                    {{ $categoria->descricao }}
                                </p>

                                <!-- CTA Button -->
                                <div class="flex items-center gap-3
                                    transform translate-y-4 group-hover:translate-y-0
                                    transition-all duration-500 delay-100">
                                    <span class="bg-white text-black px-4 py-2 rounded-lg
                                        font-bold text-xs uppercase tracking-wider
                                        inline-flex items-center gap-2
                                        group-hover:bg-[#5A1F2D] group-hover:text-white 
                                        transition-colors duration-300
                                        shadow-[3px_3px_0_0_rgba(90,31,45,0.5)]
                                        hover:shadow-[5px_5px_0_0_rgba(90,31,45,0.8)]">
                                        Explorar
                                        <i class="fas fa-arrow-up-right text-[10px] transform 
                                            group-hover:translate-x-0.5 group-hover:-translate-y-0.5
                                            transition-transform duration-300"></i>
                                    </span>
                                </div>

                            </div>
                        </a>

                        <!-- Corner Accent -->
                        <div class="absolute bottom-0 right-0 w-16 h-16
                            opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute bottom-3 right-3 w-10 h-10 
                                border-r-2 border-b-2 border-[#5A1F2D]/50 rounded-br-xl"></div>
                        </div>

                    </article>
                </div>
            @endforeach

        </div>

        <!-- Bottom Accent -->
        <div class="flex items-center justify-center mt-8 gap-3">
            <div class="w-1.5 h-1.5 bg-[#5A1F2D] rounded-full animate-pulse"></div>
            <div class="w-1.5 h-1.5 bg-neutral-700 rounded-full"></div>
            <div class="w-1.5 h-1.5 bg-neutral-700 rounded-full"></div>
        </div>

    </div>
</section>