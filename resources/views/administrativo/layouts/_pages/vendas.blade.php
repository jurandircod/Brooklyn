<div class="card">
    <div class="card-header">
        <h3 class="card-title">Produtos Mais Vendidos</h3>
        
        <div class="card-tools">
            <form action="" method="GET">
                <div class="input-group input-group-sm">
                    <select name="periodo" class="form-control" onchange="this.form.submit()">
                        <option value="all" {{ $periodo === 'all' ? 'selected' : '' }}>Todos</option>
                        <option value="month" {{ $periodo === 'month' ? 'selected' : '' }}>Último mês</option>
                        <option value="year" {{ $periodo === 'year' ? 'selected' : '' }}>Último ano</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Posição</th>
                    <th>Produto</th>
                    <th>Quantidade Vendida</th>
                    <th>Total Faturado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->produto->nome }}</td>
                    <td>{{ $item->total_vendido }}</td>
                    <td>R$ {{ number_format($item->total_faturado, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('produtos.show', $item->produto_id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="card-footer clearfix">
        {{ $produtos->appends(['periodo' => $periodo])->links() }}
    </div>
</div>