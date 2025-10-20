{{-- Seção do Carrossel --}}
<section id='carousel' class="relative w-full h-[70vh] min-h-[600px] overflow-hidden bg-gray-50">
    <div class="carousel-container relative w-full h-full">
        
        {{-- Slide 1 --}}
        <div class="slide active absolute inset-0 opacity-0 transition-opacity duration-700" 
             style="background-image: url('https://wallpapers.com/images/hd/skateboarding-2560-x-1440-picture-4d9oqpgsac0sntqw.jpg');">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            
            <div class="relative h-full max-w-7xl mx-auto px-8 md:px-16 flex items-center">
                <div class="max-w-xl space-y-6">
                    <span class="inline-block text-xs font-medium tracking-widest uppercase text-white">
                        Coleção Premium
                    </span>
                    
                    <h2 class="text-5xl md:text-6xl text-white leading-tight">
                        Marfim & Maple
                    </h2>
                    
                    <p class="text-lg text-white leading-relaxed">
                        Materiais nobres cuidadosamente selecionados para criar peças atemporais e sofisticadas.
                    </p>
                    
                    <button onclick="openProductModal()" 
                            class="inline-flex items-center gap-2 px-8 py-3 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300">
                        Explorar Coleção
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700" 
             style="background-image: url('https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=1600');">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            
            <div class="relative h-full max-w-7xl mx-auto px-8 md:px-16 flex items-center">
                <div class="max-w-xl space-y-6">
                    <span class="inline-block text-xs font-medium tracking-widest uppercase text-white/90">
                        Novidades
                    </span>
                    
                    <h2 class="text-5xl md:text-6xl text-white leading-tight">
                        Design Atemporal
                    </h2>
                    
                    <p class="text-lg text-white/80 leading-relaxed">
                        Cada peça é pensada para durar gerações, combinando beleza e funcionalidade.
                    </p>
                    
                    <button onclick="openProductModal()" 
                            class="inline-flex items-center gap-2 px-8 py-3 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300">
                        Ver Produtos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700" 
             style="background-image: url('https://i0.wp.com/www.hawaiisurfpoint.com.br/wp-content/uploads/2017/05/5-dicas-para-come%C3%A7ar-a-andar-de-skate.jpg?fit=960%2C600&ssl=1');">
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
            
            <div class="relative h-full max-w-7xl mx-auto px-8 md:px-16 flex items-center">
                <div class="max-w-xl space-y-6">
                    <span class="inline-block text-xs font-medium tracking-widest uppercase text-white">
                        Craftsmanship
                    </span>
                    
                    <h2 class="text-white text-5xl md:text-6xl leading-tight">
                        Feito à Mão
                    </h2>
                    
                    <p class="text-lg text-white leading-relaxed">
                        Artesanato tradicional encontra técnicas modernas em cada detalhe cuidadosamente executado.
                    </p>
                    
                    <button onclick="openProductModal()" 
                            class="inline-flex items-center gap-2 px-8 py-3 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300">
                        Descobrir Mais
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Controles de Navegação Minimalistas --}}
        <button onclick="changeSlide(-1)" 
                class="nav-prev absolute left-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center hover:bg-white/20 transition-all duration-300 z-10">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button onclick="changeSlide(1)" 
                class="nav-next absolute right-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center hover:bg-white/20 transition-all duration-300 z-10">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Indicadores (Dots) --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-10">
            <button onclick="goToSlide(0)" class="dot w-8 h-0.5 bg-white/30 hover:bg-white/50 transition-all duration-300"></button>
            <button onclick="goToSlide(1)" class="dot w-8 h-0.5 bg-white/30 hover:bg-white/50 transition-all duration-300"></button>
            <button onclick="goToSlide(2)" class="dot w-8 h-0.5 bg-white/30 hover:bg-white/50 transition-all duration-300"></button>
        </div>

        {{-- Contador Minimalista --}}
        <div class="absolute top-8 right-8 text-white/80 text-sm font-light tracking-wider z-10">
            <span class="slide-counter">1 / 3</span>
        </div>
    </div>
</section>

<style>
    /* Slide transitions */
    .slide.active {
        opacity: 1;
    }

    .slide {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* Dot active state */
    .dot.active {
        background-color: #5A1F2D !important;
        width: 2rem;
    }

    /* Smooth font rendering */
    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
 
    #carousel{
        padding-top: 0px !important;
    }
    /* Focus states */
    button:focus-visible {
        outline: 2px solid white;
        outline-offset: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        section {
            height: 60vh;
            min-height: 500px;
        }

        h2 {
            font-size: 2.5rem;
        }

        .nav-prev,
        .nav-next {
            width: 40px;
            height: 40px;
        }

        .nav-prev {
            left: 1rem;
        }

        .nav-next {
            right: 1rem;
        }
    }
</style>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        const totalSlides = slides.length;
        let autoplayInterval;

        function updateSlide() {
            // Update slides
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === currentSlide) {
                    slide.classList.add('active');
                }
            });

            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.remove('active');
                if (index === currentSlide) {
                    dot.classList.add('active');
                }
            });

            // Update counter
            document.querySelector('.slide-counter').textContent = `${currentSlide + 1} / ${totalSlides}`;
        }

        window.changeSlide = function(direction) {
            currentSlide += direction;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            updateSlide();
            resetAutoplay();
        };

        window.goToSlide = function(slideIndex) {
            currentSlide = slideIndex;
            updateSlide();
            resetAutoplay();
        };

        function startAutoplay() {
            autoplayInterval = setInterval(() => {
                changeSlide(1);
            }, 5000);
        }

        function resetAutoplay() {
            clearInterval(autoplayInterval);
            startAutoplay();
        }

        window.openProductModal = function() {
            // Integração com Laravel
            console.log('Abrindo produtos...');
            // Swal.fire ou redirecionamento
        };

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') changeSlide(-1);
            if (e.key === 'ArrowRight') changeSlide(1);
        });

        // Touch/swipe support
        let startX = 0;
        let endX = 0;

        document.querySelector('.carousel-container').addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        document.querySelector('.carousel-container').addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            const diff = startX - endX;

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    changeSlide(1);
                } else {
                    changeSlide(-1);
                }
            }
        });

        // Initialize
        updateSlide();
        startAutoplay();

        // Pause on hover
        const container = document.querySelector('.carousel-container');
        container.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
        container.addEventListener('mouseleave', () => startAutoplay());
    });
</script>