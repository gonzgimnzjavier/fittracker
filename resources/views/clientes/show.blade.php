@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perfil del Cliente</h1>
    <div class="card">
        <div class="card-header">
            {{ $cliente->nombre }} {{ $cliente->apellidos }}
        </div>
        <div class="card-body">
            @if ($cliente->foto_perfil)
                <div class="mb-3">
                    <img src="{{ asset($cliente->foto_perfil) }}" alt="Foto de perfil" class="img-thumbnail" width="150">
                </div>
            @endif
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</p>
            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver a la lista</a>
        </div>
    </div>
</div>
@endsection
