@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">Agregar Cliente</a>
    <button id="toggleView" class="btn btn-secondary">Cambiar Vista</button>
    <div id="tableView">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Fecha de Nacimiento</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->apellidos }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</td>
                        <td>{{ $cliente->dni }}</td>
                        <td>
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="cardView" class="row" style="display:none;">
        @foreach($clientes as $cliente)
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ $cliente->foto_perfil ? $cliente->foto_perfil : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cliente->nombre }} {{ $cliente->apellidos }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $cliente->email }}</p>
                        <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                        <p class="card-text"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                        <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</p>
                        <p class="card-text"><strong>DNI:</strong> {{ $cliente->dni }}</p>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
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
            cardView.style.display = 'block';
        }
    });
});
</script>
@endsection
