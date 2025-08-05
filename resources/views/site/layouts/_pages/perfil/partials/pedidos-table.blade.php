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
                <th scope="col">Ver</th>
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
                    <td><span class="status-btn">{{ $pedido->status }}</span>
                    </td>
                    <td>
                        <p class="theme-color fs-6 fw-bold">
                            R${{ number_format($pedido->preco_total, 2, ',', '.') }}
                        </p>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
