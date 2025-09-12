{{-- Seção do Carrossel --}}
<section class="carousel-section">
    <div class="carousel-container">
        <div class="progress-container">
            <span class="slide-counter">1 / 6</span>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>

        {{-- Slides do Carrossel --}}
        @for ($i = 1; $i <= 6; $i++)
            <div class="slide active" style="background-image: url('');">
                <div class="slide-overlay"></div>
                <div class="slide-content">
                    <div class="slide-badge">Melhores Materias</div>
                    <h2 class="slide-title">Marfim, Maple e outros materiais</h2>
                    <p class="slide-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quia.</p>
                    <button class="slide-cta" onclick="openProductModal()">Confira nossos Produtos →</button>
                </div>
                <div class="slide-info">
                    <div class="info-price">R$ 100</div>
                    <ul class="info-features">
                        <li>Produtos de todas as categorias</li>
                        <li>Todos os produtos em uma única página</li>
                        <li>Uma experiência de compra única</li>
                    </ul>
                </div>
            </div>
        @endfor


        {{-- Navegação --}}
        <button class="navigation nav-prev" onclick="changeSlide(-1)">‹</button>
        <button class="navigation nav-next" onclick="changeSlide(1)">›</button>

        {{-- Dots --}}
        <div class="dots-container">
            <span class="dot active" onclick="goToSlide(0)"></span>
            <span class="dot" onclick="goToSlide(1)"></span>
            <span class="dot" onclick="goToSlide(2)"></span>
            <span class="dot" onclick="goToSlide(3)"></span>
            <span class="dot" onclick="goToSlide(4)"></span>
            <span class="dot" onclick="goToSlide(5)"></span>
        </div>

        {{-- Elementos Flutuantes --}}
        <div class="floating-elements">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
        </div>
    </div>
</section>
{{-- CSS Styles --}}
<style>
    .carousel-section {
        position: relative;
        width: 100%;
        height: 40vh;
        min-height: 500px;
        overflow: hidden;
        margin: 0;
        margin-top: 0px !important;
        padding-top: 0 !important;
    }

    .carousel-container {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out, transform 1s ease-in-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .slide.active {
        opacity: 1;
    }

    .slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg,
                rgba(0, 0, 0, 0.7) 0%,
                rgba(0, 0, 0, 0.4) 30%,
                rgba(0, 0, 0, 0.1) 60%,
                rgba(0, 0, 0, 0.6) 100%);
    }

    .slide-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 60px;
        color: white;
        z-index: 1;
    }

    .slide-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .slide-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 0.9;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff, #ccc);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.1);
        font-family: 'Inter', sans-serif;
    }

    .slide-description {
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 600px;
        line-height: 1.6;
    }

    .slide-info {
        opacity: 0.8;
        box-shadow: var(--shadow-md);
    }

    .slide-cta {
        background: linear-gradient(135deg, #a84c3d, #8c3a2d);
        border: none;
        color: white;
        padding: 18px 40px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 15px 35px rgba(168, 76, 61, 0.4);
    }

    .slide-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 50px rgba(168, 76, 61, 0.6);
    }

    .navigation {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
        font-size: 24px;
    }

    .navigation:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-50%) scale(1.1);
    }

    .nav-prev {
        left: 40px;
    }

    .nav-next {
        right: 40px;
    }

    .progress-container {
        position: absolute;
        top: 40px;
        right: 60px;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .slide-counter {
        font-size: 18px;
        font-weight: 600;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    .progress-bar {
        width: 120px;
        height: 4px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #a84c3d, #8c3a2d);
        border-radius: 2px;
        transition: width 0.3s ease;
    }

    .dots-container {
        position: absolute;
        bottom: 40px;
        right: 60px;
        display: flex;
        gap: 10px;
        z-index: 1;
    }

    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dot.active {
        background: linear-gradient(135deg, #a84c3d, #8c3a2d);
        transform: scale(1.2);
    }

    .floating-elements {
        position: absolute;
        inset: 0;
        pointer-events: none;
        z-index: 1
    }

    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(168, 76, 61, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-circle:nth-child(1) {
        width: 100px;
        height: 100px;
        top: 20%;
        right: 10%;
        animation-delay: 0s;
    }

    .floating-circle:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 60%;
        right: 30%;
        animation-delay: 2s;
    }

    .floating-circle:nth-child(3) {
        width: 80px;
        height: 80px;
        top: 80%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(180deg);
        }
    }

    .slide-info {
        position: absolute;
        top: 50%;
        right: 60px;
        transform: translateY(-50%);
        background: var(--surface);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 30px;
        max-width: 300px;
        color: white;
        z-index: 1;
    }

    .info-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .info-features {
        list-style: none;
        margin-bottom: 20px;
        padding: 0;
    }

    .info-features li {
        padding: 5px 0;
        opacity: 0.8;
        font-size: 14px;
    }

    .info-features li::before {
        content: "✓ ";
        color: var(--primary-color);
        font-weight: bold;
    }

    /* Info Section */
    .info-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        font-family: 'Inter', sans-serif;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: #666;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .info-card {
        background: white;
        padding: 40px 30px;
        border-radius: 20px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .info-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .info-card h3 {
        color: #a84c3d;
        margin-bottom: 15px;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .info-card p {
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 768px) {
        .carousel-section {
            height: 50vh;
            min-height: 400px;
        }

        .slide-content {
            padding: 30px;
        }

        .slide-title {
            font-size: 2.5rem;
        }

        .brand-logo {
            top: 20px;
            left: 30px;
            width: 60px;
            height: 60px;
            font-size: 20px;
        }

        .progress-container {
            top: 20px;
            right: 30px;
        }

        .navigation {
            width: 50px;
            height: 50px;
        }

        .nav-prev {
            left: 20px;
        }

        .nav-next {
            right: 20px;
        }

        .slide-info {
            display: none;
        }

        .info-section {
            padding: 60px 0;
        }

        .section-title {
            font-size: 2rem;
        }
    }
</style>

{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const totalSlides = 6;
        let autoplayInterval;

        function updateSlide() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');

            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === currentSlide) {
                    slide.classList.add('active');
                }
            });

            dots.forEach((dot, index) => {
                dot.classList.remove('active');
                if (index === currentSlide) {
                    dot.classList.add('active');
                }
            });

            // Update counter and progress
            document.querySelector('.slide-counter').textContent = `${currentSlide + 1} / ${totalSlides}`;
            const progressFill = document.querySelector('.progress-fill');
            const percentage = ((currentSlide + 1) / totalSlides) * 100;
            progressFill.style.width = `${percentage}%`;
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
            // Aqui você pode integrar com seu sistema de produtos Laravel
            Swal.fire({
                title: 'Produto em Destaque',
                text: 'Redirecionando para a página do produto...',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        };

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') changeSlide(-1);
            if (e.key === 'ArrowRight') changeSlide(1);
        });

        // Touch/swipe support
        let startX = 0;
        let endX = 0;

        document.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        document.addEventListener('touchend', (e) => {
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

        // Pause autoplay on hover
        document.querySelector('.carousel-container').addEventListener('mouseenter', () => {
            clearInterval(autoplayInterval);
        });

        document.querySelector('.carousel-container').addEventListener('mouseleave', () => {
            startAutoplay();
        });
    });
</script>
