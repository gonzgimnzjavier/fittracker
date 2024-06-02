@extends('layouts.app')

@section('content')
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="h3" style="color: #e74a3b;">¡Bienvenido a FitTracker!</h1>
                    <p class="lead">Gestiona tus clientes, clases y entrenadores de manera eficiente.</p>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="card mb-3 bg-dark-gray">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <p class="card-text">Administra todos tus clientes desde aquí.</p>
                                    <a href="{{ route('clientes.index') }}" class="btn btn-danger">Gestionar Clientes</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 bg-dark-gray">
                                <div class="card-body text-center">
                                    <i class="fas fa-dumbbell fa-2x mb-2"></i>
                                    <p class="card-text">Organiza y controla todas tus clases.</p>
                                    <a href="{{ route('clases.index') }}" class="btn btn-danger">Gestionar Clases</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3 bg-dark-gray">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-tie fa-2x mb-2"></i>
                                    <p class="card-text">Gestiona la información de los entrenadores.</p>
                                    <a href="{{ route('entrenadores.index') }}" class="btn btn-danger">Gestionar Entrenadores</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card bg-dark-gray">
                                <div class="card-body">
                                    <select id="claseSelect" class="form-control form-control-sm mb-3">
                                        <option value="" disabled selected>Seleccionar Clase</option>
                                        @foreach($clases as $clase)
                                            <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <canvas id="claseChart" style="max-height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-dark-gray">
                                <div class="card-body">
                                    <canvas id="membresiaChart" style="max-height: 200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('claseChart').getContext('2d');
    let chart;

    document.getElementById('claseSelect').addEventListener('change', function() {
        const claseId = this.value;

        fetch(`/dashboard/chart-data/${claseId}`)
            .then(response => response.json())
            .then(data => {
                const { totalClientes, clientesMatriculados } = data;

                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Matriculados', 'No Matriculados'],
                        datasets: [{
                            data: [clientesMatriculados, totalClientes - clientesMatriculados],
                            backgroundColor: ['#4e73df', '#e74a3b'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Interés en la Clase'
                            }
                        }
                    }
                });
            });
    });

    // Membresía chart
    const membresiaCtx = document.getElementById('membresiaChart').getContext('2d');
    let membresiaChart;

    fetch('/dashboard/membresia-data')
        .then(response => response.json())
        .then(data => {
            const nombres = data.map(membresia => membresia.nombre);
            const clientesCounts = data.map(membresia => membresia.clientes_count);

            membresiaChart = new Chart(membresiaCtx, {
                type: 'doughnut',
                data: {
                    labels: nombres,
                    datasets: [{
                        data: clientesCounts,
                        backgroundColor: ['#4e73df', '#e74a3b', '#36b9cc', '#1cc88a'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Distribución de Membresías'
                        }
                    }
                }
            });
        });
});
</script>