<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📦 Painel de Vendas</h1>

    {{-- 🔹 Cards de resumo --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow p-4 text-center hover:shadow-md transition-shadow">
            <p class="text-gray-500 text-sm">Total de Vendas</p>
            <h2 class="text-2xl font-bold text-indigo-600">{{ $totais['total_vendas'] }}</h2>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center hover:shadow-md transition-shadow">
            <p class="text-gray-500 text-sm">Faturamento</p>
            <h2 class="text-2xl font-bold text-green-600">R$ {{ number_format($totais['total_faturado'], 2, ',', '.') }}</h2>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center hover:shadow-md transition-shadow">
            <p class="text-gray-500 text-sm">Ticket Médio</p>
            <h2 class="text-2xl font-bold text-blue-600">R$ {{ number_format($totais['ticket_medio'], 2, ',', '.') }}</h2>
        </div>
    </div>

    {{-- 🔹 Filtro por período e status --}}
    <div class="mb-6 bg-white rounded-xl shadow p-4">
        <form method="GET" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="text-gray-600 text-sm font-medium">Filtrar por tempo:</label>
                <select name="periodo" onchange="this.form.submit()" class="border-gray-300 rounded-lg text-sm p-2 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
                    <option value="all" {{ $periodo == 'all' ? 'selected' : '' }}>Todos</option>
                    <option value="month" {{ $periodo == 'month' ? 'selected' : '' }}>Último mês</option>
                    <option value="year" {{ $periodo == 'year' ? 'selected' : '' }}>Último ano</option>
                </select>
            </div>
            
            <div class="flex items-center gap-2">
                <label class="text-gray-600 text-sm font-medium">Filtrar por status:</label>
                <select name="status" onchange="this.form.submit()" class="border-gray-300 rounded-lg text-sm p-2 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Todos os Status</option>
                    @foreach ($status as $key => $value)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    {{-- 🔹 Tabela de vendas --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold">Produto</th>
                    <th class="px-6 py-4 text-left font-semibold">Vendido</th>
                    <th class="px-6 py-4 text-left font-semibold">Faturado</th>
                    <th class="px-6 py-4 text-left font-semibold">Comprador</th>
                    <th class="px-6 py-4 text-left font-semibold">Status</th>
                    <th class="px-6 py-4 text-left font-semibold">Endereço</th>
                    <th class="px-6 py-4 text-left font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produtos as $produto)
                    <tr class="border-t hover:bg-indigo-50 transition-all duration-200">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $produto->produto->nome }}</td>
                        <td class="px-6 py-4">{{ $produto->total_vendido }}</td>
                        <td class="px-6 py-4 font-semibold">R$ {{ number_format($produto->total_faturado, 2, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $produto->comprador }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold 
                                @if ($produto->status_venda == 'Pago') bg-green-100 text-green-800 border border-green-200
                                @elseif($produto->status_venda == 'Aguardando') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($produto->status_venda == 'Cancelado') bg-red-100 text-red-800 border border-red-200
                                @elseif($produto->status_venda == 'Enviado') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($produto->status_venda == 'Entregue') bg-purple-100 text-purple-800 border border-purple-200
                                @else bg-gray-100 text-gray-600 border border-gray-200 @endif">
                                {{ $produto->status_venda }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $produto->endereco_entrega }}</td>
                        <td class="px-6 py-4">
                            @if($produto->status_venda == 'Aguardando')
                                <div class="flex gap-2">
                                    <form method="POST" action="" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Entregue">
                                        <button type="submit" 
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                                                onclick="return confirm('Marcar pedido como ENTREGUE?')">
                                            ✅ Entregue
                                        </button>
                                    </form>
                                    <form method="POST" action="" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Cancelado">
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                                                onclick="return confirm('Cancelar este pedido?')">
                                            ❌ Cancelar
                                        </button>
                                    </form>
                                </div>
                            @elseif($produto->status_venda == 'pago')
                                <form method="POST" action="" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Enviado">
                                    <button type="submit" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition-colors duration-200 shadow-sm hover:shadow-md"
                                            onclick="return confirm('Marcar pedido como ENVIADO?')">
                                        🚚 Enviar
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs">Nenhuma ação</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Nenhuma venda encontrada.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div class="mt-6">
        {{ $produtos->links() }}
    </div>
</div>