<section class="poster-section" aria-label="Carrossel de produtos skate">
    <div class="poster-header">
        <div class="header-left">
            <div class="logo">BK</div>
            <div class="header-content">
                <div class="title">Skate Drops · Novidades</div>
                <div class="subtitle">Coleção Premium 2024</div>
            </div>
        </div>
        <div class="carousel-progress">
            <span class="slide-counter">1 / 6</span>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>

    <!-- Carrossel -->
    <div class="swiper mainSwiper" aria-roledescription="carousel">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            @foreach ($produtos as $index => $produto)
                <div class="swiper-slide" role="group" aria-label="Slide 1 de 6">
                    <div class="slide-overlay"></div>
                    <img src="{{$produto->imagem_url}}" alt="{{$produto->nome}}">
                    <div class="slide-badge">{{$produto->material}}</div>
                    <button class="slide-cta" onclick="openModal(this)">Ver produto ➜</button>
                </div>
            @endforeach
        </div>

        <!-- Botões -->
        <div class="swiper-button-next" aria-label="Próximo slide" role="button"></div>
        <div class="swiper-button-prev" aria-label="Slide anterior" role="button"></div>

        <!-- Paginação -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Modal fullscreen -->
<div class="image-modal" id="imageModal" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <img src="" alt="" class="modal-image" id="modalImage">
        <button class="modal-close" onclick="closeModal()" aria-label="Fechar modal">×</button>
    </div>
</div>

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const totalSlides = 6;
        const swiper = new Swiper(".mainSwiper", {
            loop: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 24,
            speed: 700,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            on: {
                slideChange: function() {
                    updateCounter(this.realIndex);
                    updateProgress(this.realIndex);
                }
            }
        });

        function updateCounter(activeIndex) {
            document.querySelector(".slide-counter").textContent =
                `${activeIndex + 1} / ${totalSlides}`;
        }

        function updateProgress(activeIndex) {
            const progressFill = document.querySelector(".progress-fill");
            const percentage = ((activeIndex + 1) / totalSlides) * 100;
            progressFill.style.width = `${percentage}%`;
        }

        // Modal
        window.openModal = function(btn) {
            const img = btn.parentElement.querySelector("img").src;
            document.getElementById("modalImage").src = img;
            document.getElementById("imageModal").classList.add("active");
        };

        window.closeModal = function() {
            document.getElementById("imageModal").classList.remove("active");
        };

        // iniciar
        updateCounter(swiper.realIndex);
        updateProgress(swiper.realIndex);
    });
</script>

<style>
    /* Mantive seu estilo base, mas simplifiquei e corrigi */
    .poster-section {
        padding: 40px 20px;
        background: linear-gradient(135deg, #0f0f10, #1a1a1a);
        color: #fff;
    }

    .poster-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .logo {
        width: 60px;
        height: 60px;
        background: #a84c3d;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-weight: bold;
        font-size: 22px;
    }

    .carousel-progress {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .progress-bar {
        width: 100px;
        height: 4px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        width: 0;
        background: linear-gradient(90deg, #a84c3d, #ff784f);
    }

    .swiper {
        max-width: 1200px;
    }

    .swiper-slide {
        width: 320px;
        height: 420px;
        border-radius: 18px;
        overflow: hidden;
        position: relative;
    }

    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.6));
    }

    .slide-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(0, 0, 0, 0.6);
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 12px;
    }

    .slide-cta {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: #a84c3d;
        border: none;
        color: #fff;
        padding: 8px 14px;
        border-radius: 14px;
        cursor: pointer;
    }

    .slide-cta:hover {
        background: #ff784f;
    }

    /* Modal */
    .image-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .image-modal.active {
        display: flex;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }

    .modal-image {
        width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.7);
        border: none;
        color: #fff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
    }
</style>
