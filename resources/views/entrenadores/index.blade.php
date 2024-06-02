@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Lista de Entrenadores</h1>
    <a href="{{ route('entrenadores.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Agregar Entrenador</a>
    <button id="toggleView" class="btn btn-secondary">Cambiar Vista</button>
</div>

<div id="cardView" class="row">
    @foreach($entrenadores as $entrenador)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 card-container">
            <div class="card h-100">
                <img src="{{ $entrenador->foto_perfil ? asset($entrenador->foto_perfil) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
                <div class="card-body">
                    <h5 class="card-title">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $entrenador->email }}</p>
                    <p class="card-text"><strong>Teléfono:</strong> {{ $entrenador->telefono }}</p>
                    <p class="card-text"><strong>Dirección:</strong> {{ $entrenador->direccion }}</p>
                    <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($entrenador->fecha_nacimiento)->format('d/m/Y') }}</p>
                    <p class="card-text"><strong>DNI:</strong> {{ $entrenador->dni }}</p>
                    <a href="{{ route('entrenadores.show', $entrenador->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('entrenadores.edit', $entrenador->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('entrenadores.destroy', $entrenador->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este entrenador?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="tableView" class="card shadow mb-4" style="display:none;">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Entrenadores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>DNI</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entrenadores as $entrenador)
                        <tr>
                            <td>{{ $entrenador->id }}</td>
                            <td>{{ $entrenador->nombre }}</td>
                            <td>{{ $entrenador->apellido }}</td>
                            <td>{{ $entrenador->email }}</td>
                            <td>{{ $entrenador->telefono }}</td>
                            <td>{{ $entrenador->direccion }}</td>
                            <td>{{ \Carbon\Carbon::parse($entrenador->fecha_nacimiento)->format('d/m/Y') }}</td>
                            <td>{{ $entrenador->dni }}</td>
                            <td>
                                <a href="{{ route('entrenadores.show', $entrenador->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('entrenadores.edit', $entrenador->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('entrenadores.destroy', $entrenador->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este entrenador?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toggleView').addEventListener('click', function() {
        var tableView = document.getElementById('tableView');
        var cardView = document.getElementById('cardView');
        if (tableView.style.display === 'none') {
            tableView.style.display = 'block';
            cardView.style.display = 'none';
        } else {
            tableView.style.display = 'none';
            cardView.style.display = 'flex';
            cardView.style.flexWrap = 'wrap';
        }
    });
});
</script>
@endsection