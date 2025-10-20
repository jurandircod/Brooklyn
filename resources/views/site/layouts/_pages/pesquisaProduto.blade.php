<!-- Shop Section start -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Sidebar de Filtros -->
            <aside class="lg:w-80 w-full">
                <div class="bg-white border border-gray-200 sticky top-4">

                    <!-- Header dos Filtros -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">Filtros</h3>
                            <button class="lg:hidden text-gray-500 hover:text-gray-900" id="closeFilters">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form id="filterForm" action="{{ route('site.pesquisa.filtrar') }}" method="POST">
                        <input type="hidden" name="filtrar" value="1">

                        <!-- Filtro de Preço -->
                        <div class="p-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-4 tracking-wide uppercase">Preço</h4>
                            <div class="space-y-4">
                                <div class="range-slider row">
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="text-sm font-medium text-gray-900">Preço Minimo</label>
                                            <input class="form-control" type="" placeholder="Min" name="min_price" id="min_price">
                                        </div>
                                        <div class="col">
                                            <label for="" class="text-sm font-medium text-gray-900">Preço Máximo</label>
                                            <input class="form-control" type="" placeholder="Max" name="max_price" id="max_price">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Tamanhos -->
                        <div class="p-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-4 tracking-wide uppercase">Tamanhos</h4>

                            <!-- Tabs de Categoria de Tamanho -->
                            <div class="flex gap-2 mb-4 border-b border-gray-200">
                                <button type="button"
                                    class="size-tab-btn px-4 py-2 text-xs font-medium text-gray-600 border-b-2 border-transparent hover:text-[#5A1F2D] hover:border-[#5A1F2D] transition-colors active"
                                    data-target="sizes-camisas">
                                    Roupas
                                </button>
                                <button type="button"
                                    class="size-tab-btn px-4 py-2 text-xs font-medium text-gray-600 border-b-2 border-transparent hover:text-[#5A1F2D] hover:border-[#5A1F2D] transition-colors"
                                    data-target="sizes-shapes">
                                    Shapes
                                </button>
                                <button type="button"
                                    class="size-tab-btn px-4 py-2 text-xs font-medium text-gray-600 border-b-2 border-transparent hover:text-[#5A1F2D] hover:border-[#5A1F2D] transition-colors"
                                    data-target="sizes-calcados">
                                    Calçados
                                </button>
                            </div>

                            <!-- Conteúdo dos Tamanhos -->
                            <div class="space-y-2">
                                <!-- Camisas -->
                                <div class="size-tab-content" id="sizes-camisas">
                                    <div class="grid grid-cols-4 gap-2">
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="p"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">P</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="m"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">M</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="g"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">G</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="gg"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">GG</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Shapes -->
                                <div class="size-tab-content hidden" id="sizes-shapes">
                                    <div class="grid grid-cols-4 gap-2">
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="775"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-xs text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">7.75</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="8"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-xs text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">8</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="825"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-xs text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">8.25</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="85"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-xs text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">8.5</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Calçados -->
                                <div class="size-tab-content hidden" id="sizes-calcados">
                                    <div class="grid grid-cols-4 gap-2">
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="38"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">38</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="39"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">39</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="40"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">40</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="41"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">41</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="42"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">42</span>
                                        </label>
                                        <label class="size-option">
                                            <input type="checkbox" name="sizes[]" value="43"
                                                class="hidden size-checkbox">
                                            <span
                                                class="block text-center py-2 border border-gray-200 text-sm text-gray-700 cursor-pointer hover:border-[#5A1F2D] transition-colors">43</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Categoria -->
                        <div class="p-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-4 tracking-wide uppercase">Categoria</h4>
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                @foreach ($categorias as $categoria)
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                                                class="w-4 h-4 text-[#5A1F2D] border-gray-300 focus:ring-[#5A1F2D] focus:ring-2">
                                            <span
                                                class="text-sm text-gray-700 group-hover:text-[#5A1F2D] transition-colors">
                                                {{ $categoria->nome }}
                                            </span>
                                        </div>
                                        <span
                                            class="text-xs text-gray-400">({{ $categoria->contarProdutosCategoria() }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filtro de Marcas -->
                        <div class="p-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-4 tracking-wide uppercase">Marcas</h4>
                            <div class="space-y-3 max-h-64 overflow-y-auto custom-scrollbar">
                                @foreach ($marcas as $marca)
                                    <label class="flex items-center justify-between cursor-pointer group">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" name="marcas[]" value="{{ $marca->id }}"
                                                class="w-4 h-4 text-[#5A1F2D] border-gray-300 focus:ring-[#5A1F2D] focus:ring-2">
                                            <span
                                                class="text-sm text-gray-700 group-hover:text-[#5A1F2D] transition-colors">
                                                {{ $marca->nome }}
                                            </span>
                                        </div>
                                        <span
                                            class="text-xs text-gray-400">({{ $marca->contarProdutosMarca() }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Botão de Aplicar Filtros -->
                        <div class="p-6">
                            <button type="submit"
                                class="w-full py-3 bg-[#5A1F2D] text-white text-sm font-medium hover:bg-[#7A2F3D] transition-colors duration-300">
                                Aplicar Filtros
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Área de Produtos -->
            <main class="flex-1">
                <!-- Barra de Controles -->
                <div class="bg-white border border-gray-200 p-4 mb-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <!-- Ordenação -->
                        <div class="flex items-center gap-4">
                            <select name="orderby" id="orderby"
                                class="px-4 py-2 border border-gray-200 text-sm text-gray-700 focus:outline-none focus:border-[#5A1F2D] transition-colors">
                                <option value="-1">Ordenar por</option>
                                <option value="1">Mais Recentes</option>
                                <option value="2">Mais Antigos</option>
                                <option value="3">Menor Preço</option>
                                <option value="4">Maior Preço</option>
                            </select>
                        </div>

                        <!-- Visualização -->
                        <div class="hidden md:flex items-center gap-2">
                            <button
                                class="grid-view-btn p-2 border border-gray-200 hover:border-[#5A1F2D] hover:text-[#5A1F2D] transition-colors"
                                data-cols="2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </button>
                            <button
                                class="grid-view-btn p-2 border border-gray-200 hover:border-[#5A1F2D] hover:text-[#5A1F2D] transition-colors active"
                                data-cols="3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M3 3h6v6H3V3zm8 0h6v6h-6V3zm8 0h6v6h-6V3zM3 11h6v6H3v-6zm8 0h6v6h-6v-6zm8 0h6v6h-6v-6zM3 19h6v6H3v-6zm8 0h6v6h-6v-6zm8 0h6v6h-6v-6z" />
                                </svg>
                            </button>
                            <button
                                class="grid-view-btn p-2 border border-gray-200 hover:border-[#5A1F2D] hover:text-[#5A1F2D] transition-colors"
                                data-cols="4">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M3 3h4v4H3V3zm6 0h4v4H9V3zm6 0h4v4h-4V3zM3 9h4v4H3V9zm6 0h4v4H9V9zm6 0h4v4h-4V9zM3 15h4v4H3v-4zm6 0h4v4H9v-4zm6 0h4v4h-4v-4z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Grid de Produtos -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6" id="produtos-table-container">
                    @include('site.layouts._pages.pesquisaProduto.partials.produtos-table', [
                        'produtos' => $produtos,
                    ])
                </div>

                <!-- Paginação -->
                <div class="mt-8" id="produtos-pagination-container">
                    @include('site.layouts._pages.pesquisaProduto.partials.produtos-pagination')
                </div>
            </main>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-[#5A1F2D]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-light text-white mb-2">Assine Nossa Newsletter</h2>
                <p class="text-white/80">Receba novidades sobre nossos produtos e ofertas exclusivas</p>
            </div>
            <div class="w-full lg:w-auto lg:min-w-[400px]">
                <div class="flex gap-2">
                    <input type="email" placeholder="Seu e-mail"
                        class="flex-1 px-4 py-3 bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:border-white/40 transition-colors">
                    <button class="px-6 py-3 bg-white text-[#5A1F2D] font-medium hover:bg-gray-100 transition-colors">
                        Assinar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Container -->
<div id="qvmodal"></div>

<!-- Form de Filtro Oculto (mantém compatibilidade) -->
<form id="frmFilter" method="GET">
    <input type="hidden" id="page" name="page" value="1">
    <input type="hidden" id="size" name="size" value="12">
    <input type="hidden" id="prange" name="prange" value="">
    <input type="hidden" id="order" name="order" value="-1">
    <input type="hidden" id="brands" name="brands" value="">
    <input type="hidden" id="categorias" name="categorias" value="">
</form>

<style>
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #5A1F2D;
        border-radius: 3px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #7A2F3D;
    }

    /* Size Selection Active State */
    .size-option input:checked+span {
        background-color: #5A1F2D;
        color: white;
        border-color: #5A1F2D;
    }

    /* Tab Active State */
    .size-tab-btn.active {
        color: #5A1F2D;
        border-color: #5A1F2D;
    }

    /* Grid View Active State */
    .grid-view-btn.active {
        background-color: #5A1F2D;
        color: white;
        border-color: #5A1F2D;
    }
</style>

<script>
    // Tabs de Tamanho
    document.querySelectorAll('.size-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active de todos
            document.querySelectorAll('.size-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.size-tab-content').forEach(c => c.classList.add('hidden'));

            // Adiciona active no clicado
            this.classList.add('active');
            const target = this.getAttribute('data-target');
            document.getElementById(target).classList.remove('hidden');
        });
    });

    // Grid View Controls
    document.querySelectorAll('.grid-view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.grid-view-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const cols = this.getAttribute('data-cols');
            const container = document.getElementById('produtos-table-container');

            // Remove todas as classes de grid
            container.className = container.className.replace(/grid-cols-\d+/g, '');
            container.className = container.className.replace(/md:grid-cols-\d+/g, '');

            // Adiciona nova configuração
            if (cols === '2') {
                container.classList.add('grid-cols-1', 'md:grid-cols-2');
            } else if (cols === '3') {
                container.classList.add('grid-cols-2', 'md:grid-cols-3');
            } else if (cols === '4') {
                container.classList.add('grid-cols-2', 'md:grid-cols-4');
            }
        });
    });

    // Select Listeners (mantém compatibilidade com seu JS existente)
    document.getElementById('orderby').addEventListener('change', function() {
        document.getElementById('order').value = this.value;
        // Trigger seu código existente
    });

    document.getElementById('pagesize').addEventListener('change', function() {
        document.getElementById('size').value = this.value;
        // Trigger seu código existente
    });
</script>

<script src="{{ asset('js/site/pesquisaProduto/pesquisa.js') }}"></script>
