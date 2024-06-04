@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Lista de Clases</h1>
    <a href="{{ route('clases.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Agregar Clase</a>
</div>

<div class="row">
    @foreach($clases as $clase)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white text-center">
                    <h5 class="card-title mb-0 font-weight-bold">{{ $clase->nombre }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $clase->descripcion }}</p>
                    <p class="card-text"><strong>Horario:</strong> {{ $clase->horario }}</p>
                    <p class="card-text"><strong>Entrenadores:</strong> 
                        @foreach($clase->entrenadores as $entrenador)
                            {{ $entrenador->nombre }} {{ $entrenador->apellido }}<br>
                        @endforeach
                    </p>
                    <a href="{{ route('clases.show', $clase->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('clases.edit', $clase->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('clases.destroy', $clase->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta clase?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection