<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Bem-vindo ao Painel Administrativo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalVendas }}</h3>
                        <p>Vendas Realizadas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalProdutos }}</h3>
                        <p>Produtos Cadastrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalUsuarios }}</h3>
                        <p>Usuários Ativos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $pedidosPendentes }}</h3>
                        <p>Pedidos Pendentes</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Sales Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line mr-1"></i>
                            Vendas Mensais
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right col -->
            <section class="col-lg-5 connectedSortable">
                <!-- Products Pie Chart -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Categorias de Produtos
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="productsPieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </section>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Atividades Recentes</h3>
                    </div>
                    <div class="card-body">
                        <ul class="timeline timeline-inverse">
                            @foreach($atividadesRecentes as $atividade)
                            <li>
                                <i class="{{ $atividade['icon'] }}"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> {{ $atividade['time'] }}</span>
                                    <h3 class="timeline-header"><a href="#">{{ $atividade['title'] }}</a></h3>
                                    <div class="timeline-body">
                                        {{ $atividade['content'] }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ChartJS Scripts -->
@section('scripts')
<script>
    $(function () {
        /* Sales Chart */
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        var salesChartData = {
            labels: @json($vendasMensais['labels']),
            datasets: [
                {
                    label: 'Vendas',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: @json($vendasMensais['data'])
                }
            ]
        };
        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: { display: false },
            scales: {
                xAxes: [{ gridLines: { display: false } }],
                yAxes: [{ gridLines: { display: false } }]
            }
        };
        new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        });

        /* Products Pie Chart */
        var pieChartCanvas = $('#productsPieChart').get(0).getContext('2d');
        var pieData = {
            labels: @json($categoriasProdutos['labels']),
            datasets: [
                {
                    data: @json($categoriasProdutos['data']),
                    backgroundColor: @json($categoriasProdutos['colors'])
                }
            ]
        };
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });
    });
</script>
@endsection