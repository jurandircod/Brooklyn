
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const productGrid = document.querySelector('.product-list-section');
    const paginationContainer = document.getElementById('produtos-pagination-container');

    // Inicializar ionRangeSlider
    $("#js-range-price").ionRangeSlider({
        type: "double",
        min: 0,
        max: 1000,
        from: 0,
        to: 500,
        grid: true,
        onChange: function (data) {
            document.getElementById('min_price').value = data.from;
            document.getElementById('max_price').value = data.to;
        }
    });

    // Função para lidar com o clique em "Adicionar ao Carrinho"
    function handleAddToCart(event) {
        const botao = event.target.closest('.addtocart-btn');
        if (!botao) return;

        const produtoId = botao.getAttribute('data-id');
        const produtoElement = botao.closest('.product-box');
        const produtoNome = produtoElement.querySelector('h5').textContent;
        const produtoPreco = produtoElement.querySelector('.theme-color').textContent;
        const produtoImagem = produtoElement.querySelector('img').src;
        const tamanho = "quantidade";

        // Mostrar toast de carregamento
        const loadingToast = Toastify({
            text: "Adicionando ao carrinho...",
            duration: -1,
            gravity: "bottom",
            position: "right",
            backgroundColor: "#4CAF50",
            stopOnFocus: true
        }).showToast();

        fetch("/carrinho/adicionar", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json"
            },
            body: JSON.stringify({
                produto_id: produtoId,
                quantidade: 1,
                tamanho: tamanho
            })
        })
            .then(async (res) => {
                const contentType = res.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    return res.json();
                } else {
                    const text = await res.text();
                    throw new Error(text);
                }
            })
            .then(data => {
                loadingToast.hideToast();

                if (data.status === "error") {
                    Toastify({
                        text: data.message,
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                    return;
                }

                Swal.fire({
                    title: 'Adicionado ao carrinho!',
                    html: `
                        <div style="display: flex; align-items: center; gap: 15px; margin: 10px 0;">
                            <img src="${produtoImagem}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <h6 style="margin: 0 0 5px 0;">${produtoNome}</h6>
                                <p style="margin: 0; color: #4CAF50; font-weight: bold;">${produtoPreco}</p>
                            </div>
                        </div>
                    `,
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                });
            })
            .catch(err => {
                loadingToast.hideToast();
                Toastify({
                    text: "Erro inesperado. Tente novamente.",
                    duration: 4000,
                    gravity: "bottom",
                    position: "right",
                    backgroundColor: "#f44336",
                    stopOnFocus: true
                }).showToast();
                console.error("Erro na requisição:", err);
            });
    }

    // Delegação de eventos para .addtocart-btn
    productGrid.addEventListener('click', handleAddToCart);

    // Variável global para armazenar filtros ativos
    let activeFilters = null;

    // Função para limpar filtros
    function clearFilters() {
        activeFilters = null;

        // Limpar formulário
        form.reset();

        // Resetar slider de preço se existir
        if ($("#js-range-price").length) {
            $("#js-range-price").data("ionRangeSlider").reset();
        }

        // Recarregar página sem filtros
        window.location.href = window.location.pathname;
    }

    // Se existir um botão de limpar filtros, adicionar event listener
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', clearFilters);
    }

    // Manipulação do formulário de filtro
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        const data = {
            filtrar: 1,
            sizes: formData.getAll('sizes[]'),
            categorias: formData.getAll('categorias[]').map(id => parseInt(id)).filter(id => !
                isNaN(id)),
            marcas: formData.getAll('marcas[]').map(id => parseInt(id)).filter(id => !isNaN(
                id)),
            min_price: formData.get('min_price') || null,
            max_price: formData.get('max_price') || null
        };
    

        // Armazenar filtros ativos
        activeFilters = data;

        console.log('Dados enviados:', data);

        // Mostrar loading
        productGrid.innerHTML =
            '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Carregando...</span></div></div>';

        applyFilters(data);
    });

    // Função para aplicar filtros
    function applyFilters(data, page = 1) {
        let url = window.location.href;
        if (page > 1) {
            url += (url.includes('?') ? '&' : '?') + 'page=' + page;
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                console.log('Status da resposta:', response.status);
                if (!response.ok) {
                    return response.json().then(err => {
                        console.error('Erro da API:', err);
                        throw err;
                    });
                }
                return response.json();
            })
            .then(responseData => {
                console.log('Resposta recebida:', responseData);

                if (responseData.status === 'error') {
                    throw new Error(responseData.message || 'Erro no filtro');
                }

                // Limpar grid de produtos
                productGrid.innerHTML = '';

                if (!responseData.data || responseData.data.length === 0) {
                    productGrid.innerHTML =
                        '<div class="col-12"><p class="text-center">Nenhum produto encontrado com os filtros selecionados.</p></div>';
                    paginationContainer.innerHTML = '';
                    return;
                }

                // Adicionar produtos filtrados
                responseData.data.forEach(product => {
                    const showAddToCart = product.categoria_id != 2 && product.categoria_id !=
                        1;

                    const productHtml = `
                        <div>
                            <div class="product-box">
                                <div class="img-wrapper">
                                    <div class="front">
                                        <a href="/produto/${product.id}">
                                            <img src="${product.imagem_url || '/images/placeholder.jpg'}" class="w-100 blur-up lazyload" alt="${product.nome}">
                                        </a>
                                    </div>
                                    <div class="cart-wrap">
                                        <ul>
                                            ${showAddToCart ? `
                                                                <li>
                                                                    <a href="javascript:void(0)" class="addtocart-btn" data-id="${product.id}">
                                                                        <i data-feather="shopping-cart"></i>
                                                                    </a>
                                                                </li>
                                                            ` : ''}
                                            <li>
                                                <a href="/produto/${product.id}">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details">
                                    <div class="rating-details">
                                        <span class="font-light grid-content">${product.categoria?.nome || 'N/A'}</span>
                                        <ul class="rating mt-0">
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                            <li><i class="fas fa-star theme-color"></i></li>
                                        </ul>
                                    </div>
                                    <div class="main-price">
                                        <a href="/produto/${product.id}" class="font-default">
                                            <h5 class="ms-0">${product.nome}</h5>
                                        </a>
                                        <div class="listing-content">
                                            <span class="font-light">${product.marca?.nome || 'N/A'}</span>
                                            <p class="font-light">${product.descricao || ''}</p>
                                        </div>
                                        <h3 class="theme-color">${product.valor}</h3>
                                        <button class="btn listing-content">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });

                // Atualizar paginação
                if (responseData.pagination_html && responseData.pagination_info.has_pages) {
                    paginationContainer.innerHTML = responseData.pagination_html;
                } else {
                    paginationContainer.innerHTML = '';
                }

                // Reativar os ícones do Feather
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            })
            .catch(error => {
                console.error('Erro completo:', error);
                productGrid.innerHTML =
                    '<div class="col-12"><p class="text-center text-danger">Erro ao carregar produtos. Tente novamente.</p></div>';

                // Mostrar toast de erro
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: "Erro ao filtrar produtos. Tente novamente.",
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                }
            });
    }

    // Delegação de eventos para paginação
    paginationContainer.addEventListener('click', function (e) {
        const link = e.target.closest('a.page-link');
        if (!link) return;

        e.preventDefault();

        // Se existem filtros ativos, usar paginação com filtros
        if (activeFilters) {
            const url = new URL(link.href);
            const page = url.searchParams.get('page') || 1;

            // Mostrar loading
            productGrid.innerHTML =
                '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Carregando...</span></div></div>';

            applyFilters(activeFilters, page);
        } else {
            // Usar paginação normal
            loadPage(link.href);
        }
    });

    // Função para carregar páginas via AJAX
    function loadPage(url) {
        // Mostrar loading
        productGrid.innerHTML =
            '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Carregando...</span></div></div>';

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                document.getElementById('produtos-table-container').innerHTML = data.table;
                document.getElementById('produtos-pagination-container').innerHTML = data.pagination;

                // Reativar os ícones do Feather
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                productGrid.innerHTML =
                    '<div class="col-12"><p class="text-center text-danger">Erro ao carregar página. Tente novamente.</p></div>';
            });
    }
});
