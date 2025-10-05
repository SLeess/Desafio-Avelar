@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard de Estatísticas</h1>
    </div>

    @if($stats['total'] > 0)
        {{-- LINHA DE CARDS DE RESUMO --}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total de Cadastros</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['total'] }}</div>
                            </div>
                            <div class="col-auto"><i class="bi bi-people-fill h2 text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Média Salarial</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">R$ {{ number_format($stats['mediaSalarial'], 2, ',', '.') }}</div>
                            </div>
                            <div class="col-auto"><i class="bi bi-cash-coin h2 text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cards para Ensino Médio (Processados do array) --}}
            @php
                $ensinoMedioSim = 0;
                foreach($stats['porEnsinoMedio'] as $item) {
                    if($item->ensino_medio == 1) $ensinoMedioSim = $item->total;
                }
            @endphp
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Com Ensino Médio</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $ensinoMedioSim }}</div>
                            </div>
                            <div class="col-auto"><i class="bi bi-patch-check-fill h2 text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LINHA DOS GRÁFICOS --}}
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3"><h6 class="m-0 fw-bold text-primary">Distribuição por Sexo</h6></div>
                    <div class="card-body"><canvas id="graficoPorSexo" style="height: 250px;"></canvas></div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3"><h6 class="m-0 fw-bold text-info">Nível de Escolaridade</h6></div>
                    <div class="card-body"><canvas id="graficoEnsinoMedio" style="height: 250px;"></canvas></div>
                </div>
            </div>
             <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3"><h6 class="m-0 fw-bold text-warning">Distribuição por Estado</h6></div>
                    <div class="card-body"><canvas id="graficoPorEstado" style="height: 250px;"></canvas></div>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3"><h6 class="m-0 fw-bold text-danger">Top 5 Cidades com Mais Cadastros</h6></div>
                    <div class="card-body"><canvas id="graficoPorCidade" style="height: 300px;"></canvas></div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center">
             <h4 class="alert-heading">Nenhum dado encontrado!</h4>
            <p>Ainda não há cadastros no sistema para gerar estatísticas. Comece cadastrando alguém na <a href="{{ route('home') }}" class="alert-link">página de cadastro</a>.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- GRÁFICO POR SEXO (DOUGHNUT) ---
    const dadosPorSexo = @json($stats['porSexo']);
    if (dadosPorSexo && dadosPorSexo.length > 0) {
        new Chart(document.getElementById('graficoPorSexo'), {
            type: 'doughnut',
            data: {
                labels: dadosPorSexo.map(item => item.sexo.charAt(0).toUpperCase() + item.sexo.slice(1)),
                datasets: [{
                    data: dadosPorSexo.map(item => item.total),
                    backgroundColor: ['#4e73df', '#e74a3b', '#f6c23e'],
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // --- GRÁFICO DE ENSINO MÉDIO (PIE) ---
    const dadosEnsinoMedio = @json($stats['porEnsinoMedio']);
    if (dadosEnsinoMedio && dadosEnsinoMedio.length > 0) {
        new Chart(document.getElementById('graficoEnsinoMedio'), {
            type: 'pie',
            data: {
                labels: dadosEnsinoMedio.map(item => item.ensino_medio == 1 ? 'Sim' : 'Não'),
                datasets: [{
                    data: dadosEnsinoMedio.map(item => item.total),
                    backgroundColor: ['#36b9cc', '#b8b8b8'],
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // --- GRÁFICO POR ESTADO (BARRA VERTICAL) ---
    const dadosPorEstado = @json($stats['porEstado']);
    if (dadosPorEstado && dadosPorEstado.length > 0) {
        new Chart(document.getElementById('graficoPorEstado'), {
            type: 'bar',
            data: {
                labels: dadosPorEstado.map(item => item.estado),
                datasets: [{
                    label: 'Cadastros',
                    data: dadosPorEstado.map(item => item.total),
                    backgroundColor: '#f6c23e',
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }

    // --- GRÁFICO POR CIDADE (BARRA HORIZONTAL) ---
    const dadosPorCidade = @json($stats['porCidadeTop5']);
    if (dadosPorCidade && dadosPorCidade.length > 0) {
        new Chart(document.getElementById('graficoPorCidade'), {
            type: 'bar',
            data: {
                labels: dadosPorCidade.map(item => item.cidade),
                datasets: [{
                    label: 'Cadastros',
                    data: dadosPorCidade.map(item => item.total),
                    backgroundColor: '#e74a3b',
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    }
});
</script>
@endpush
