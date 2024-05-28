@extends('layouts.app')

@section('content')
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ¡Bienvenido al Dashboard!

                    <div class="mt-4">
                        <a href="{{ route('clientes.index') }}" class="btn btn-primary">Gestionar Clientes</a>
                        <a href="{{ route('clases.index') }}" class="btn btn-primary">Gestionar Clases</a>
                        <a href="{{ route('entrenadores.index') }}" class="btn btn-primary">Gestionar Entrenadores</a>
                    </div>

                    <div class="mt-4">
                        <select id="claseSelect" class="form-control">
                            <option value="" disabled selected>Seleccionar Clase</option>
                            @foreach($clases as $clase)
                                <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <canvas id="claseChart" class="mt-4"></canvas>
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
});
</script>