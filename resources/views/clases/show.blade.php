@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle de la Clase</h1>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-chalkboard-teacher"></i> {{ $clase->nombre }}</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <strong>Descripción:</strong> {{ $clase->descripcion }}</li>
                <li class="list-group-item"> <strong>Horario:</strong> {{ $clase->horario }}</li>
                <li class="list-group-item"> <strong>Entrenadores:</strong>
                    <ul class="mb-0">
                        @foreach($clase->entrenadores as $entrenador)
                            <li>{{ $entrenador->nombre }} {{ $entrenador->apellido }}</li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('clases.index') }}" class="btn btn-primary"></i> Volver</a>
        </div>
    </div>

    <h3 class="mb-4">Alumnos Matriculados</h3>
    <div class="row">
        @foreach($clase->clientes as $cliente)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="{{ $cliente->foto_perfil ? asset($cliente->foto_perfil) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cliente->nombre }} {{ $cliente->apellidos }}</h5>
                        <p class="card-text"> <strong>Email:</strong> {{ $cliente->email }}</p>
                        <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                        <p class="card-text"> <strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                        <p class="card-text"> <strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</p>
                        <p class="card-text"> <strong>DNI:</strong> {{ $cliente->dni }}</p>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este cliente?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection