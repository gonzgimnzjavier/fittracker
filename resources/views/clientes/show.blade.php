@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Cliente</h1>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="fas fa-user"></i> {{ $cliente->nombre }} {{ $cliente->apellidos }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $cliente->foto_perfil ? asset($cliente->foto_perfil) : 'https://via.placeholder.com/150'}}" class="img-fluid rounded mb-3 shadow-sm" alt="Foto de perfil">
                </div>
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $cliente->email }}</li>
                        <li class="list-group-item"><i class="fas fa-phone"></i> <strong>Teléfono:</strong> {{ $cliente->telefono }}</li>
                        <li class="list-group-item"><i class="fas fa-home"></i> <strong>Dirección:</strong> {{ $cliente->direccion }}</li>
                        <li class="list-group-item"><i class="fas fa-birthday-cake"></i> <strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</li>
                        <li class="list-group-item"><i class="fas fa-id-card"></i> <strong>DNI:</strong> {{ $cliente->dni }}</li>
                        <li class="list-group-item"><i class="fas fa-medal"></i> <strong>Membresía:</strong> {{ $cliente->membresia->nombre }}</li>
                        <li class="list-group-item"><i class="fas fa-dumbbell"></i> <strong>Clases:</strong>
                            <ul class="mb-0">
                                @foreach($cliente->clases as $clase)
                                    <li>{{ $clase->nombre }} ({{ $clase->horario }})</li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('clientes.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Volver a la lista de clientes</a>
        </div>
    </div>
</div>
@endsection