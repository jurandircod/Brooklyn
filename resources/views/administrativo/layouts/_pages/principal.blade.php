<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        color: #333;
    }

    .content-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }

    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .welcome-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        margin: 0;
    }

    .breadcrumb {
        display: flex;
        list-style: none;
        gap: 0.5rem;
        align-items: center;
        color: rgba(255, 255, 255, 0.8);
    }

    .breadcrumb a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
        border-radius: 20px 20px 0 0;
    }

    .stat-card.info {
        --gradient: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-card.success {
        --gradient: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .stat-card.warning {
        --gradient: linear-gradient(135deg, #ff9a9e, #fecfef);
    }

    .stat-card.danger {
        --gradient: linear-gradient(135deg, #fa709a, #fee140);
    }

    .stat-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-info h3 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: var(--gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-info p {
        color: #6b7280;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        background: var(--gradient);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .stat-footer {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .stat-footer a {
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stat-footer a:hover {
        color: #374151;
        gap: 1rem;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: 7fr 5fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .chart-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .chart-card:hover {
        transform: translateY(-5px);
    }

    .chart-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .chart-header i {
        color: #667eea;
        font-size: 1.5rem;
    }

    .chart-header h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #374151;
        margin: 0;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .activity-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .activity-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .activity-header h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #374151;
        margin: 0;
    }

    .timeline {
        list-style: none;
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 1px;
    }

    .timeline li {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 80px;
    }

    .timeline li:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: 15px;
        top: 5px;
        width: 30px;
        height: 30px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .timeline-item {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .timeline-item:hover {
        background: rgba(255, 255, 255, 0.9);
        transform: translateX(5px);
    }

    .timeline-time {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .timeline-header {
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .timeline-header a {
        color: #667eea;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .timeline-header a:hover {
        color: #764ba2;
    }

    .timeline-body {
        color: #6b7280;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .container-fluid {
            padding: 0 1rem;
        }

        .welcome-title {
            font-size: 2rem;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    .fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
</head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="header-content">
            <h1 class="welcome-title">Bem-vindo ao Painel Administrativo</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                <li><i class="fas fa-chevron-right"></i></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="stats-grid fade-in">
            <div class="stat-card info">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="vendas-counter">{{ $totalVendas }}</h3>
                        <p>Vendas Realizadas</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="#"><span>Mais informações</span> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="produtos-counter">{{ $totalProdutos }}</h3>
                        <p>Produtos Cadastrados</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="#"><span>Mais informações</span> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="stat-card warning">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="usuarios-counter">{{ $totalUsuarios }}</h3>
                        <p>Usuários Ativos</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="#"><span>Mais informações</span> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="stat-card danger">
                <div class="stat-content">
                    <div class="stat-info">
                        <h3 id="pedidos-counter">{{ $pedidosPendentes }}</h3>
                        <p>Pedidos Pendentes</p>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <a href="#"><span>Mais informações</span> <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid fade-in">
            <!-- Sales Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <i class="fas fa-chart-line"></i>
                    <h3>Vendas Mensais</h3>
                </div>
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Products Pie Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <i class="fas fa-chart-pie"></i>
                    <h3>Categorias de Produtos</h3>
                </div>
                <div class="chart-container">
                    <canvas id="productsPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="activity-card fade-in">
            <div class="activity-header">
                <i class="fas fa-history" style="color: #667eea; font-size: 1.5rem;"></i>
                <h3>Atividades Recentes</h3>
            </div>
            <ul class="timeline">
                @foreach ($atividadesRecentes as $atividade)
                    <li>
                        <div class="timeline-icon">
                            <i class="{{ str_replace('bg-', '', $atividade['icon']) }}"></i>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">
                                <i class="fas fa-clock"></i>
                                <span>{{ $atividade['created_at']->diffForHumans() }}</span>
                            </div>
                            <h3 class="timeline-header">
                                <a href="#">{{ $atividade['title'] }}</a>
                            </h3>
                            <div class="timeline-body">
                                {{ $atividade['content'] }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<script>
    // Counter animation for statistics
    function animateCounter(elementId, target) {
        const element = document.getElementById(elementId);
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 30);
    }

    // Initialize counters on page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            animateCounter('vendas-counter', {{ $totalVendas }});
            animateCounter('produtos-counter', {{ $totalProdutos }});
            animateCounter('usuarios-counter', {{ $totalUsuarios }});
            animateCounter('pedidos-counter', {{ $pedidosPendentes }});
        }, 500);
    });

    // Chart.js implementation
    $(function() {
        /* Sales Chart with modern styling */
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

        var salesChartData = {
            labels: @json($vendasMensais['labels']),
            datasets: [{
                label: 'Vendas',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                data: @json($vendasMensais['data'])
            }]
        };

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280'
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: 'rgba(118, 75, 162, 1)'
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        };

        new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        });

        /* Products Pie Chart with modern styling */
        var pieChartCanvas = $('#productsPieChart').get(0).getContext('2d');

        var pieData = {
            labels: @json($categoriasProdutos['labels']),
            datasets: [{
                data: @json($categoriasProdutos['data']),
                backgroundColor: @json($categoriasProdutos['colors']),
                borderColor: @json($categoriasProdutos['colors']),
                borderWidth: 2,
                hoverOffset: 10
            }]
        };

        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        color: '#6b7280'
                    }
                }
            }
        };

        new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        });
    });

    // Add smooth scrolling and intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0.2s';
                entry.target.classList.add('fade-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
</script>
