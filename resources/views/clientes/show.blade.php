@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Cliente</h1>
    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ $cliente->nombre }} {{ $cliente->apellidos }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $cliente->foto_perfil ? asset($cliente->foto_perfil) : 'https://via.placeholder.com/150' }}" class="img-fluid rounded mb-3" alt="Foto de perfil">
                </div>
                <div class="col-md-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Email:</strong> {{ $cliente->email }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $cliente->telefono }}</li>
                        <li class="list-group-item"><strong>Dirección:</strong> {{ $cliente->direccion }}</li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</li>
                        <li class="list-group-item"><strong>DNI:</strong> {{ $cliente->dni }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('clientes.index') }}" class="btn btn-primary">Volver a la lista de clientes</a>
        </div>
    </div>
</div>
@endsection