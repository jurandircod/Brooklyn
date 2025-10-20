document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('filterForm');
    const productGrid = document.getElementById('produtos-table-container') || document.querySelector('.product-list-section');
    const paginationContainer = document.getElementById('produtos-pagination-container');
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';

    function showLoading(container) {
        if (!container) return;
        container.innerHTML = '<div class="text-center w-full py-8"><div class="spinner-border" role="status"><span class="sr-only">Carregando...</span></div></div>';
    }

    // Inicializar ionRangeSlider (se existir)
    if (typeof $ !== 'undefined' && $("#js-range-price").length) {
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
    }

    // Variável global para armazenar filtros ativos
    let activeFilters = null;

    function clearFilters() {
        activeFilters = null;
        if (!form) return window.location.href = window.location.pathname;
        form.reset();
        if (typeof $ !== 'undefined' && $("#js-range-price").length) {
            const slider = $("#js-range-price").data("ionRangeSlider");
            if (slider && typeof slider.reset === 'function') slider.reset();
        }
        // Recarregar sem filtros
        window.location.href = window.location.pathname;
    }

    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    if (clearFiltersBtn) clearFiltersBtn.addEventListener('click', clearFilters);

    if (!form) return console.warn('Filtro: form #filterForm não encontrado.');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        const data = {
            filtrar: 1,
            sizes: formData.getAll('sizes[]'),
            categorias: formData.getAll('categorias[]').map(id => parseInt(id)).filter(id => !isNaN(id)),
            marcas: formData.getAll('marcas[]').map(id => parseInt(id)).filter(id => !isNaN(id)),
            min_price: formData.get('min_price') || null,
            max_price: formData.get('max_price') || null,
        };

        activeFilters = data;
        console.log('Filtros enviados:', data);

        showLoading(productGrid);
        applyFilters(data, 1);
    });

    // Função que aplica filtros via POST para a action do form (ou para a URL atual como fallback)
    function applyFilters(data, page = 1) {
        const postUrl = form.getAttribute('action') || window.location.href;
        const payload = Object.assign({}, data);
        if (page && page > 1) payload.page = page;

        fetch(postUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
            },
            body: JSON.stringify(payload)
        })
            .then(async (response) => {
                const ct = response.headers.get('content-type') || '';
                let parsed;
                if (ct.includes('application/json')) {
                    parsed = await response.json();
                } else {
                    // tenta ler como texto (útil para debug)
                    const text = await response.text();
                    try {
                        parsed = JSON.parse(text);
                    } catch (err) {
                        throw new Error('Resposta do servidor não é JSON: ' + text);
                    }
                }

                if (!response.ok) {
                    // se o backend devolveu status != 200, tenta pegar mensagem
                    const msg = parsed && parsed.message ? parsed.message : `Erro ${response.status}`;
                    const err = new Error(msg);
                    err.payload = parsed;
                    throw err;
                }
                return parsed;
            })
            .then(responseData => {
                console.log('Resposta do filtro:', responseData);

                // Caso o backend já envie HTML pronto (table + pagination)
                if (responseData.table || responseData.pagination) {
                    if (responseData.table) {
                        if (productGrid) productGrid.innerHTML = responseData.table;
                    }
                    if (paginationContainer) paginationContainer.innerHTML = responseData.pagination || '';
                    // Reativar feather
                    if (typeof feather !== 'undefined') feather.replace();
                    return;
                }

                // Caso padrão: responseData.data === array de produtos
                if (!responseData.data || responseData.data.length === 0) {
                    if (productGrid) productGrid.innerHTML = '<div class="col-12"><p class="text-center">Nenhum produto encontrado com os filtros selecionados.</p></div>';
                    if (paginationContainer) paginationContainer.innerHTML = '';
                    return;
                }

                if (productGrid) productGrid.innerHTML = '';
                responseData.data.forEach(product => {
                    const showAddToCart = product.categoria_id != 2 && product.categoria_id != 1;
const productHtml = `
    <article class="group relative bg-white flex flex-col">
        <div class="relative aspect-square overflow-hidden bg-gray-50 mb-4">
            <a href="/produto/${product.id}" class="block w-full h-full">
                <img src="${product.imagem_url || '/images/placeholder.jpg'}" alt="${product.nome || ''}"
                    class="w-full h-full object-cover transition-opacity duration-500 group-hover:opacity-90" loading="lazy">
            </a>

            <div class="absolute top-3 left-3 z-10">
                <span class="inline-block px-2.5 py-1 bg-[#5A1F2D] text-white text-xs font-medium">-30%</span>
            </div>

            <div class="absolute top-3 right-3 z-10 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <button
                    class="w-9 h-9 bg-white border border-gray-200 flex items-center justify-center hover:border-[#5A1F2D] hover:bg-[#5A1F2D] hover:text-white transition-all duration-300"
                    data-id="${product.id}" title="Adicionar ao carrinho">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </button>

                <a href="/produto/${product.id}"
                    class="w-9 h-9 bg-white border border-gray-200 flex items-center justify-center hover:border-[#5A1F2D] hover:bg-[#5A1F2D] hover:text-white transition-all duration-300"
                    title="Ver detalhes">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="flex-1 flex flex-col space-y-2">
            <span class="text-xs text-gray-500 tracking-wide uppercase">${product.material || ''}</span>

            <a href="/produto/${product.id}" class="block">
                <h3 class="text-sm font-normal text-gray-900 line-clamp-2 group-hover:text-[#5A1F2D] transition-colors duration-200">
                    ${product.nome || ''}
                </h3>
            </a>

            <div class="flex-1"></div>

            <div class="pt-2 space-y-2">
                <div class="flex items-baseline gap-2">
                    <span class="text-lg font-medium text-gray-900">
                        R$ ${product.valor !== undefined && product.valor !== null ? product.valor : ''}
                    </span>
                    <span class="text-xs text-gray-400 line-through"></span>
                </div>

                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <svg class="w-3 h-3 text-[#5A1F2D] fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                </div>
            </div>

            <button class="mt-3 w-full py-2.5 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300 flex items-center justify-center gap-2"
                data-id="${product.id}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Adicionar
            </button>
        </div>
    </article>
`;

                    productGrid.insertAdjacentHTML('beforeend', productHtml);
                });

                // Paginação: aceita campo pagination_html ou pagination
                if (responseData.pagination_html && paginationContainer) {
                    paginationContainer.innerHTML = responseData.pagination_html;
                } else if (responseData.pagination && paginationContainer) {
                    paginationContainer.innerHTML = responseData.pagination;
                } else if (paginationContainer) {
                    // caso não venha paginação, limpa
                    paginationContainer.innerHTML = '';
                }

                if (typeof feather !== 'undefined') feather.replace();
            })
            .catch(error => {
                console.error('Erro ao aplicar filtros:', error);
                if (productGrid) productGrid.innerHTML = '<div class="col-12"><p class="text-center text-danger">Erro ao carregar produtos. Tente novamente.</p></div>';
                if (typeof Toastify !== 'undefined') {
                    Toastify({
                        text: error.message || "Erro ao filtrar produtos.",
                        duration: 4000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                }
            });
    }

    // Paginação delegada — aceita links com href ou data-page
    if (paginationContainer) {
        paginationContainer.addEventListener('click', function (e) {
            const anchor = e.target.closest('a');
            if (!anchor) return;
            e.preventDefault();

            // tenta extrair page de data-page ou do href
            let page = anchor.dataset.page;
            if (!page && anchor.href) {
                try {
                    const url = new URL(anchor.href, location.origin);
                    page = url.searchParams.get('page');
                } catch (err) {
                    page = null;
                }
            }
            page = parseInt(page) || 1;

            showLoading(productGrid);

            if (activeFilters) {
                applyFilters(activeFilters, page);
            } else {
                // se não há filtros ativos, faz GET simples para o href (padrão do seu loadPage)
                loadPage(anchor.href);
            }
        });
    }

    // Carrega página normal via GET (backend pode retornar JSON com table + pagination)
    function loadPage(url) {
        if (!url) return;
        showLoading(productGrid);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
            .then(async response => {
                const ct = response.headers.get('content-type') || '';
                if (!response.ok) throw new Error('Network response was not ok: ' + response.status);
                if (ct.includes('application/json')) return response.json();
                // caso venha HTML simples (não JSON), retornar como texto
                return response.text().then(txt => ({ table: txt, pagination: '' }));
            })
            .then(data => {
                if (data.table) {
                    if (productGrid) productGrid.innerHTML = data.table;
                }
                if (data.pagination && paginationContainer) paginationContainer.innerHTML = data.pagination;
                if (typeof feather !== 'undefined') feather.replace();
            })
            .catch(err => {
                console.error('Erro ao carregar página:', err);
                if (productGrid) productGrid.innerHTML = '<div class="col-12"><p class="text-center text-danger">Erro ao carregar página. Tente novamente.</p></div>';
            });
    }

    // ----- Compatibilidade UI: tabs e grid view (se já presentes em sua view) -----
    document.querySelectorAll('.size-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.size-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.size-tab-content').forEach(c => c.classList.add('hidden'));
            this.classList.add('active');
            const target = this.getAttribute('data-target');
            if (target && document.getElementById(target)) document.getElementById(target).classList.remove('hidden');
        });
    });

    document.querySelectorAll('.grid-view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.grid-view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const cols = this.getAttribute('data-cols');
            const container = document.getElementById('produtos-table-container');
            if (!container) return;
            // limpar classes grid-cols-*
            container.className = container.className.replace(/\bgrid-cols-\d+\b/g, '');
            container.className = container.className.replace(/\bmd:grid-cols-\d+\b/g, '');
            if (cols === '2') container.classList.add('grid-cols-1', 'md:grid-cols-2');
            else if (cols === '3') container.classList.add('grid-cols-2', 'md:grid-cols-3');
            else if (cols === '4') container.classList.add('grid-cols-2', 'md:grid-cols-4');
        });
    });

    // keeps compatibility with hidden frmFilter inputs (order/size)
    const orderSelect = document.getElementById('orderby');
    if (orderSelect) orderSelect.addEventListener('change', function () {
        const orderInput = document.getElementById('order');
        if (orderInput) orderInput.value = this.value;
    });

    const pageSizeSelect = document.getElementById('pagesize');
    if (pageSizeSelect) pageSizeSelect.addEventListener('change', function () {
        const sizeInput = document.getElementById('size');
        if (sizeInput) sizeInput.value = this.value;
    });
});
