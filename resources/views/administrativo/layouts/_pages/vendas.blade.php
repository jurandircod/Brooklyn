
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <style>
        .ranking-badge {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 14px;
        }
        .ranking-1 { background: linear-gradient(135deg, #FFD700, #FFA500); }
        .ranking-2 { background: linear-gradient(135deg, #C0C0C0, #A9A9A9); }
        .ranking-3 { background: linear-gradient(135deg, #CD7F32, #8B4513); }
        .ranking-default { background: linear-gradient(135deg, #6c757d, #495057); }
        
        .produto-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .produto-avatar {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        
        .produto-nome {
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
            font-size: 14px;
        }
        
        .quantidade-badge {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .valor-faturado {
            font-weight: 700;
            font-size: 15px;
            color: #27ae60;
        }
        
        .card-header-enhanced {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
        
        .card-enhanced {
            border: none;
            box-shadow: 0 4px 25px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table-enhanced {
            margin: 0;
        }
        
        .table-enhanced thead th {
            background-color: #f8f9fa;
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 15px 12px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-enhanced tbody tr {
            border: none;
            transition: all 0.3s ease;
        }
        
        .table-enhanced tbody tr:hover {
            background-color: #f8f9fc;
            transform: translateY(-1px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .table-enhanced tbody td {
            border: none;
            padding: 18px 12px;
            vertical-align: middle;
        }
        
        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 8px 12px;
            background: white;
            color: #495057;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-view {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        
        .empty-icon {
            font-size: 64px;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        .stats-summary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .period-info {
            background: rgba(255,255,255,0.1);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-left: 10px;
        }
        
        .trophy-icon {
            color: #FFD700;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <div class="card card-enhanced">
        <div class="card-header card-header-enhanced d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-trophy trophy-icon"></i>
                <h3 class="card-title mb-0 font-weight-bold">Produtos Mais Vendidos</h3>
                <div class="period-info">
                    @if($periodo === 'month')
                        <i class="fas fa-calendar-alt"></i> Último mês
                    @elseif($periodo === 'year')
                        <i class="fas fa-calendar-alt"></i> Último ano
                    @else
                        <i class="fas fa-infinity"></i> Todos os períodos
                    @endif
                </div>
            </div>
            
            <div class="card-tools">
                <form action="" method="GET" class="d-flex align-items-center">
                    <label for="periodo" class="text-white mr-2 mb-0 font-weight-500" style="font-size: 13px;">
                        <i class="fas fa-filter"></i> Filtrar por:
                    </label>
                    <select name="periodo" id="periodo" class="filter-select" onchange="this.form.submit()">
                        <option value="all" {{ $periodo === 'all' ? 'selected' : '' }}>
                            <i class="fas fa-infinity"></i> Todos os períodos
                        </option>
                        <option value="month" {{ $periodo === 'month' ? 'selected' : '' }}>
                            <i class="fas fa-calendar-alt"></i> Último mês
                        </option>
                        <option value="year" {{ $periodo === 'year' ? 'selected' : '' }}>
                            <i class="fas fa-calendar-alt"></i> Último ano
                        </option>
                    </select>
                </form>
            </div>
        </div>
        
        @if($produtos->count() > 0)
            <!-- Resumo das estatísticas -->
            <div class="card-body pb-0">
                <div class="stats-summary">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-boxes mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $produtos->sum('total_vendido') }}</div>
                                    <small>Total de Itens Vendidos</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-dollar-sign mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">R$ {{ number_format($produtos->sum('total_faturado'), 2, ',', '.') }}</div>
                                    <small>Total Faturado</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center justify-content-center">
                                <i class="fas fa-chart-line mr-2"></i>
                                <div>
                                    <div class="font-weight-bold">{{ $produtos->count() }}</div>
                                    <small>Produtos no Ranking</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-enhanced">
                    <thead>
                        <tr>
                            <th style="width: 80px;">
                                <i class="fas fa-medal"></i> Posição
                            </th>
                            <th>
                                <i class="fas fa-box"></i> Produto
                            </th>
                            <th style="width: 180px;">
                                <i class="fas fa-chart-bar"></i> Qtd. Vendida
                            </th>
                            <th style="width: 150px;">
                                <i class="fas fa-money-bill-wave"></i> Faturamento
                            </th>
                            <th style="width: 120px;">
                                <i class="fas fa-cogs"></i> Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $index => $item)
                        <tr>
                            <td>
                                <div class="ranking-badge {{ $index + 1 <= 3 ? 'ranking-' . ($index + 1) : 'ranking-default' }}">
                                    @if($index + 1 <= 3)
                                        <i class="fas fa-trophy"></i>
                                    @else
                                        {{ $index + 1 }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="produto-info">
                                    <div class="produto-avatar">
                                        {{ strtoupper(substr($item->produto->nome, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="produto-nome">{{ $item->produto->nome }}</p>
                                        <small class="text-muted">
                                            <i class="fas fa-tag"></i> ID: {{ $item->produto_id }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="quantidade-badge">
                                    <i class="fas fa-cube"></i>
                                    {{ number_format($item->total_vendido, 0, ',', '.') }} unidades
                                </span>
                            </td>
                            <td>
                                <div class="valor-faturado">
                                    R$ {{ number_format($item->total_faturado, 2, ',', '.') }}
                                </div>
                                <small class="text-muted">
                                    Média: R$ {{ number_format($item->total_faturado / $item->total_vendido, 2, ',', '.') }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="" 
                                       class="btn-action btn-view"
                                       title="Visualizar produto">
                                        <i class="fas fa-eye"></i>
                                        Ver
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($produtos->hasPages())
            <div class="card-footer bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Mostrando {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }} 
                        de {{ $produtos->total() }} resultados
                    </div>
                    <div>
                        {{ $produtos->appends(['periodo' => $periodo])->links() }}
                    </div>
                </div>
            </div>
            @endif
            
        @else
            <div class="card-body">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4>Nenhum dado encontrado</h4>
                    <p class="mb-3">
                        @if($periodo === 'month')
                            Não há vendas registradas no último mês.
                        @elseif($periodo === 'year')
                            Não há vendas registradas no último ano.
                        @else
                            Ainda não há vendas registradas no sistema.
                        @endif
                    </p>
                    <a href="?periodo=all" class="btn btn-primary">
                        <i class="fas fa-refresh"></i> Ver todos os períodos
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

<script>
    // Adicionar loading no select
    document.getElementById('periodo').addEventListener('change', function() {
        this.style.opacity = '0.6';
        this.disabled = true;
        
        // Criar elemento de loading
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Carregando...';
        loadingDiv.className = 'text-white ml-2';
        this.parentNode.appendChild(loadingDiv);
    });

    // Animação suave para as linhas da tabela
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.table-enhanced tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Tooltip para botões de ação
    document.addEventListener('DOMContentLoaded', function() {
        const tooltips = document.querySelectorAll('[title]');
        tooltips.forEach(element => {
            element.addEventListener('mouseenter', function() {
                // Implementar tooltip customizado se necessário
            });
        });
    });
</script>

