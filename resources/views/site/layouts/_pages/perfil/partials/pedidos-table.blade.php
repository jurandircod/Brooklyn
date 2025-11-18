<div class="box-head mb-3">
    <h3>Meus Pedidos</h3>
</div>
<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID do Pedido</th>
                <th scope="col">Metodo de Pagamento</th>
                <th scope="col">Status</th>
                <th scope="col">Preço</th>
                <th scope="col">Cancelar</th>
                <th scope="col">Confirmar Entrega</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>
                        <p class="mt-0 fw-bold">{{ $pedido->id }}</p>
                    </td>
                    <td>
                        <p class="fs-6 m-0">{{ $pedido->metodo_pagamento }}</p>
                    </td>
                    <td><p class="status-btn">{{ $pedido->status }}</p>
                    </td>
                    <td>
                        <p class="fs-6 fw-bold">
                            R${{ number_format($pedido->preco_total, 2, ',', '.') }}
                        </p>
                    </td>
                    <td>
                        <p><a href="{{ route('site.perfil.cancelarPedido', ['id' => $pedido->id]) }}" class="hover:text-white">Cancelar Pedido</a></p>
                    </td>
                    <td>
                        <p><a href="{{ route('site.perfil.confirmarPedido', ['id' => $pedido->id]) }}" class="hover:text-white">Confirmar Entrega</a></p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
