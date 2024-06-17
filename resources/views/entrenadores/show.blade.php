@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Entrenador</h1>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-user"></i> {{ $entrenador->nombre }} {{ $entrenador->apellido }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $entrenador->foto_perfil ? asset($entrenador->foto_perfil) : 'https://via.placeholder.com/150' }}" class="img-fluid rounded mb-3 shadow-sm" alt="Foto de perfil">
                </div>
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-user"></i> <strong>Nombre:</strong> {{ $entrenador->nombre }}</li>
                        <li class="list-group-item"><i class="fas fa-user-tag"></i> <strong>Apellido:</strong> {{ $entrenador->apellido }}</li>
                        <li class="list-group-item"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $entrenador->email }}</li>
                        <li class="list-group-item"><i class="fas fa-phone"></i> <strong>Teléfono:</strong> {{ $entrenador->telefono }}</li>
                        <li class="list-group-item"><i class="fas fa-home"></i> <strong>Dirección:</strong> {{ $entrenador->direccion }}</li>
                        <li class="list-group-item"><i class="fas fa-birthday-cake"></i> <strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($entrenador->fecha_nacimiento)->format('d/m/Y') }}</li>
                        <li class="list-group-item"><i class="fas fa-id-card"></i> <strong>DNI:</strong> {{ $entrenador->dni }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('entrenadores.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>
</div>
@endsection