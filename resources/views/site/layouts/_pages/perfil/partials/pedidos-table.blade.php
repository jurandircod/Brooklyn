

<!-- Tailwind CDN + paleta terrosa -->
<script>
    tailwind = window.tailwind || {};
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'earth-1': '#5B3A29',
                    'earth-2': '#A67B5B',
                    'earth-3': '#DCC7A1',
                    'earth-4': '#F8F3EA',
                    'earth-green': '#7A8F66'
                }
            }
        }
    }
</script>

<style>
    .card-shadow { box-shadow: 0 6px 18px rgba(91,58,41,0.12); }
    .thumb { object-fit: cover; }
</style>
</head>
<body class="bg-earth-4 min-h-screen font-sans text-earth-1">

<header class="bg-gradient-to-r from-earth-3 to-earth-4 border-b border-earth-2">
    <div class="max-w-6xl mx-auto px-4 py-6 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-earth-1 flex items-center justify-center text-earth-4 font-bold text-lg">SS</div>
            <div>
                <h1 class="text-2xl font-semibold">SkateShop — Pedidos</h1>
                <p class="text-sm text-earth-1/70">Visualize pedidos anteriores e os itens comprados</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <input id="searchInput" type="search" placeholder="Buscar por produto, pedido ou cliente"
                   class="px-4 py-2 rounded-lg border border-earth-2 bg-white/60 focus:outline-none focus:ring-2 focus:ring-earth-2" />
            <select id="statusFilter" class="px-3 py-2 rounded-lg border border-earth-2 bg-white/60">
                <option value="all">Todos os status</option>
                <option value="aguardando">Aguardando</option>
                <option value="finalizado">Finalizado</option>
                <option value="enviado">Enviado</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>
    </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-8">
    <!-- Area onde tanto o server quanto o JS irão renderizar -->
    <section id="ordersList" class="grid gap-6">
        {{-- Server-side render inicial (progressive enhancement) --}}
        @forelse ($pedidos as $pedido)
            <article class="bg-white rounded-2xl p-4 md:p-6 card-shadow border border-earth-2">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="bg-earth-3 rounded-lg px-3 py-2 text-earth-1 font-medium">PED-{{ $pedido->id }}</div>
                        <div>
                            <div class="font-semibold text-lg">{{ optional($pedido->user)->name ?? 'Cliente' }}</div>
                            <div class="text-sm text-earth-1/70">{{ optional($pedido->created_at)->format('Y-m-d') }} • {{ optional($pedido->carrinho->itens)->count() ?? 0 }} items</div>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-sm text-earth-1/60">Total</div>
                        <div class="font-semibold text-xl">R${{ number_format($pedido->preco_total, 2, ',', '.') }}</div>
                        <div class="mt-2">
                            <span class="inline-block px-3 py-1 rounded-full text-sm {{ 
                                $pedido->status === 'finalizado' ? 'bg-earth-green/10 text-earth-green border border-earth-green/30' :
                                ($pedido->status === 'enviado' ? 'bg-earth-3 text-earth-1 border border-earth-2' : 'bg-earth-3 text-earth-1')
                            }}">{{ ucfirst($pedido->status) }}</span>
                            <a href="{{ route('site.perfil.confirmarPedido', ['id' => $pedido->id]) }}" class="ml-2 px-3 py-1 rounded-full text-sm bg-earth-green text-white border border-earth-green/30 hover:bg-earth-green/50 confirm-delivery">Confirmar entrega</a>
                            <a href="{{ route('site.perfil.cancelarPedido', ['id' =>$pedido->id])}}" class="px-3 py-1 rounded-full text-sm bg-red-500 text-white border border-red-500/30 hover:bg-red-500/50 cancel-order">Cancelar pedido</a>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-t pt-4">
                    <div class="grid md:grid-cols-3 gap-4">
                        @php
                            $itens = optional($pedido->carrinho)->itens ?? collect([]);
                        @endphp

                        @forelse ($itens as $item)
                            @php
                                $produto = $item->produto ?? null;
                                $img = $produto->imagem_url ?? ($produto->fotos[0]->url_imagem ?? null);
                                $img = $img ? url($img) : "https://picsum.photos/seed/prod{$item->id}/400/300";
                            @endphp

                            <div class="flex items-center gap-3 bg-earth-4 rounded-lg p-3">
                                <img src="{{ $img }}" alt="{{ $produto->nome ?? 'Produto' }}" class="w-20 h-14 rounded-md thumb border border-earth-2" loading="lazy" />
                                <div class="flex-1">
                                    <div class="font-medium">{{ $produto->nome ?? 'Produto' }}</div>
                                    <div class="text-sm text-earth-1/70">Tamanho: {{ $item->tamanho }} • Qtd: {{ $item->quantidade }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-semibold">R${{ number_format($item->preco_unitario ?? $item->preco_total ?? 0, 2, ',', '.') }}</div>
                                    <button data-img="{{ $img }}" class="open-img mt-2 text-sm underline">Ver foto</button>
                                </div>
                            </div>
                        @empty
                            <div class="text-earth-1/60">Sem itens neste pedido.</div>
                        @endforelse
                    </div>
                </div>
            </article>
        @empty
            <p id="emptyStateServer" class="text-center text-earth-1/60 mt-12">Nenhum pedido encontrado.</p>
        @endforelse
    </section>
</main>

<!-- Modal de imagem -->
<div id="imageModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-lg overflow-hidden max-w-3xl w-full card-shadow">
        <div class="p-4 flex items-start justify-between">
            <div class="text-earth-1 font-semibold">Visualizar imagem do produto</div>
            <button id="closeModal" class="text-earth-1/70 hover:text-earth-1">Fechar ✕</button>
        </div>
        <div class="p-4 bg-earth-4 flex items-center justify-center">
            <img id="modalImage" src="" alt="Imagem do produto" class="max-h-[70vh] w-auto" />
        </div>
    </div>
</div>

{{-- Preparar variável JS com formato amigável para os scripts (sem gambiarra) --}}
@php
    $ordersForJs = $pedidos->getCollection()->map(function($p) {
        $items = [];
        $carrinho = $p->carrinho ?? null;
        $itens = $carrinho && isset($carrinho->itens) ? $carrinho->itens : [];
        foreach ($itens as $it) {
            $produto = $it->produto ?? null;
            $img = $produto->imagem_url ?? ($produto->fotos[0]->url_imagem ?? null);
            $img = $img ? url($img) : "https://picsum.photos/seed/prod{$it->id}/400/300";
            $items[] = [
                'id' => $it->id,
                'name' => $produto->nome ?? 'Produto',
                'qty' => (int) ($it->quantidade ?? 0),
                'size' => $it->tamanho ?? '',
                'price' => (float) ($it->preco_unitario ?? $it->preco_total ?? 0),
                'img' => $img,
            ];
        }
        return [
            'id' => 'PED-'.$p->id,
            'raw_id' => $p->id,
            'date' => optional($p->created_at)->format('Y-m-d'),
            'customer' => optional($p->user)->name ?? 'Cliente',
            'status' => $p->status,
            'total' => (float) $p->preco_total,
            'items' => $items,
        ];
    })->values();
@endphp

<script>
    // Orders já prontos para uso no JS (vêm do Blade / servidor de forma natural)



    // DOM refs
    const ordersListEl = document.getElementById('ordersList');
    const emptyStateEl = document.getElementById('emptyStateServer') || document.getElementById('emptyState');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');

    // Formatador BRL
    function currencyBRL(v) {
        return Number(v).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    // Escape simples
    function escapeHtml(text) {
        return String(text || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
    }

    // Mapeia status para classes/labels
    function statusBadgeClass(status) {
        switch((status || '').toLowerCase()) {
            case 'finalizado': return 'bg-earth-green/10 text-earth-green border border-earth-green/30';
            case 'enviado': return 'bg-earth-3 text-earth-1 border border-earth-2';
            case 'aguardando': return 'bg-yellow-100 text-yellow-800 border border-yellow-200';
            case 'cancelado': return 'bg-red-100 text-red-700 border border-red-200';
            default: return 'bg-earth-3 text-earth-1';
        }
    }
    function statusLabel(status) {
        switch((status || '').toLowerCase()) {
            case 'finalizado': return 'Finalizado';
            case 'enviado': return 'Enviado';
            case 'aguardando': return 'Aguardando';
            case 'cancelado': return 'Cancelado';
            default: return status || '';
        }
    }

    // Render (substitui o conteúdo existente por versão gerada via JS)
    function renderOrders(list) {
        // se preferir manter o HTML server-side, comente a linha abaixo
        ordersListEl.innerHTML = '';

        if (!list || !list.length) {
            if (emptyStateEl) emptyStateEl.classList.remove('hidden');
            return;
        }
        if (emptyStateEl) emptyStateEl.classList.add('hidden');

        list.forEach(order => {
            const card = document.createElement('article');
            card.className = 'bg-white rounded-2xl p-4 md:p-6 card-shadow border border-earth-2';
            card.innerHTML = `
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="bg-earth-3 rounded-lg px-3 py-2 text-earth-1 font-medium">${escapeHtml(order.id)}</div>
                        <div>
                            <div class="font-semibold text-lg">${escapeHtml(order.customer)}</div>
                            <div class="text-sm text-earth-1/70">${escapeHtml(order.date)} • ${order.items.length} items</div>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-sm text-earth-1/60">Total</div>
                        <div class="font-semibold text-xl">${currencyBRL(order.total)}</div>
                        <div class="mt-2">
                            <span class="inline-block px-3 py-1 rounded-full text-sm ${statusBadgeClass(order.status)}">${statusLabel(order.status)}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-t pt-4">
                    <div class="grid md:grid-cols-3 gap-4" id="items-${order.raw_id}">
                        ${order.items.map(item => `
                            <div class="flex items-center gap-3 bg-earth-4 rounded-lg p-3">
                              <img src="${item.img}" alt="${escapeHtml(item.name)}" class="w-20 h-14 rounded-md thumb border border-earth-2" loading="lazy" />
                              <div class="flex-1">
                                <div class="font-medium">${escapeHtml(item.name)}</div>
                                <div class="text-sm text-earth-1/70">Tamanho: ${escapeHtml(item.size)} • Qtd: ${item.qty}</div>
                              </div>
                              <div class="text-right">
                                <div class="font-semibold">${currencyBRL(item.price)}</div>
                                <button data-img="${item.img}" class="open-img mt-2 text-sm underline">Ver foto</button>
                              </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
            ordersListEl.appendChild(card);
        });

        // listeners para modal de imagem
        document.querySelectorAll('.open-img').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const url = e.currentTarget.getAttribute('data-img');
                openImage(url);
            });
        });
    }

    // filtros
    function applyFilters() {
        const q = searchInput.value.trim().toLowerCase();
        const status = statusFilter.value;

        const filtered = orders.filter(o => {
            const matchesStatus = status === 'all' ? true : (o.status === status);
            const matchesQuery = q === '' ? true : (
                (o.id || '').toLowerCase().includes(q) ||
                (o.customer || '').toLowerCase().includes(q) ||
                o.items.some(i => (i.name || '').toLowerCase().includes(q))
            );
            return matchesStatus && matchesQuery;
        });

        renderOrders(filtered);
    }

    // modal
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    document.getElementById('closeModal').addEventListener('click', closeModal);
    imageModal.addEventListener('click', (e) => { if (e.target === imageModal) closeModal(); });

    function openImage(url) {
        modalImage.src = url;
        imageModal.classList.remove('hidden');
        imageModal.classList.add('flex');
    }
    function closeModal() {
        modalImage.src = '';
        imageModal.classList.add('hidden');
        imageModal.classList.remove('flex');
    }

    // debounce
    function debounce(fn, wait) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn.apply(this, args), wait);
        }
    }

    // event listeners
    searchInput.addEventListener('input', debounce(applyFilters, 250));
    statusFilter.addEventListener('change', applyFilters);

    // Se quiser que o JS substitua a renderização server-side, descomente:
    // renderOrders(orders);

    // Por padrão deixo a renderização server-side visível (melhor pra SEO).
    // Caso queira que o JS controle a UI desde o início, ative a linha acima.
</script>


