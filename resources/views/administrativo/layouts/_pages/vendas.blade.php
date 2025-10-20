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
            <h2 class="text-2xl font-bold text-green-600">R$ {{ number_format($totais['total_faturado'], 2, ',', '.') }}
            </h2>
        </div>
        <div class="bg-white rounded-xl shadow p-4 text-center hover:shadow-md transition-shadow">
            <p class="text-gray-500 text-sm">Ticket Médio</p>
            <h2 class="text-2xl font-bold text-blue-600">R$ {{ number_format($totais['ticket_medio'], 2, ',', '.') }}
            </h2>
        </div>
    </div>

    {{-- 🔹 Filtro por período e status --}}
    <div class="mb-6 bg-white rounded-xl shadow p-4">
        <form method="GET" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="text-gray-600 text-sm font-medium">Filtrar por tempo:</label>
                <select name="periodo" onchange="this.form.submit()"
                    class="border-gray-300 rounded-lg text-sm p-2 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
                    <option value="all" {{ $periodo == 'all' ? 'selected' : '' }}>Todos</option>
                    <option value="month" {{ $periodo == 'month' ? 'selected' : '' }}>Último mês</option>
                    <option value="year" {{ $periodo == 'year' ? 'selected' : '' }}>Último ano</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-gray-600 text-sm font-medium">Filtrar por status:</label>
                <select name="status" onchange="this.form.submit()"
                    class="border-gray-300 rounded-lg text-sm p-2 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Todos os Status</option>
                    @foreach ($status as $key => $value)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $value }}</option>
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
                    <th class="px-6 py-4 text-left font-semibold">Metodo de pagamento</th>
                    <th class="px-6 py-4 text-left font-semibold">Vendido</th>
                    <th class="px-6 py-4 text-left font-semibold">Faturado</th>
                    <th class="px-6 py-4 text-left font-semibold">Comprador</th>
                    <th class="px-6 py-4 text-left font-semibold">Status</th>
                    <th class="px-6 py-4 text-left font-semibold">Endereço</th>
                    <th class="px-6 py-4 text-left font-semibold">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                    <tr class="border-t hover:bg-indigo-50 transition-all duration-200">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $pedido->metodo_pagamento }}</td>
                        <td class="px-6 py-4">{{ $pedido->preco_total }}</td>
                        <td class="px-6 py-4 font-semibold">R$
                            {{ number_format($pedido->preco_total, 2, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $pedido->user->name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1.5 rounded-full text-xs font-semibold 
                                @if ($pedido->status == 'pago') bg-green-100 text-green-800 border border-green-200
                                @elseif($pedido->status == 'aguardando') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($pedido->status == 'cancelado') bg-red-100 text-red-800 border border-red-200
                                @elseif($pedido->status == 'enviado') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($pedido->status == 'entregue') bg-purple-100 text-purple-800 border border-purple-200
                                @else bg-gray-100 text-gray-600 border border-gray-200 @endif">
                                {{ $pedido->status }}
                            </span>
                        </td>
                    <td class="px-6 py-4 text-sm text-gray-600"> @if ($pedido->endereco_id != null)
                        {{ $pedido->endereco->rua }} -
                        {{ $pedido->endereco->numero }} -
                        {{ $pedido->endereco->bairro }} -
                        {{ $pedido->endereco->cidade }} -
                        {{ $pedido->endereco->estado }} -
                        {{ $pedido->endereco->cep }} 
                    @endif </td>
                        <form method="GET">
                            <td class="px-6 py-4">
                                <select name="statusPedido" onchange="this.form.submit()"
                                    class="border-gray-300 rounded-lg text-sm p-2 shadow-sm focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400">
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Todos os
                                        Status</option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="idPedido" value="{{ $pedido->id }}">
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-gray-500">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
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
    {{ $pedidos->appends(request()->query())->links() }}
    </div>
</div>
