@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalles del Entrenador</div>

                <div class="card-body">
                    <p><strong>ID:</strong> {{ $entrenador->id }}</p>
                    <p><strong>Nombre:</strong> {{ $entrenador->nombre }}</p>
                    <p><strong>Apellido:</strong> {{ $entrenador->apellido }}</p>
                    <p><strong>Email:</strong> {{ $entrenador->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $entrenador->telefono }}</p>
                    <p><strong>Dirección:</strong> {{ $entrenador->direccion }}</p>
                    <p><strong>Fecha de Nacimiento:</strong> {{ $entrenador->fecha_nacimiento }}</p>
                    <p><strong>DNI:</strong> {{ $entrenador->dni }}</p>
                    <a href="{{ route('entrenadores.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection