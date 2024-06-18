@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">Editar Cliente</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $cliente->dni) }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="membresia_id" class="form-label">Membresía</label>
                            <select class="form-control" id="membresia_id" name="membresia_id" required autocomplete="off">
                                @foreach($membresias as $membresia)
                                    <option value="{{ $membresia->id }}" {{ old('membresia_id', $cliente->membresia_id) == $membresia->id ? 'selected' : '' }}>
                                        {{ $membresia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="clases" class="form-label">Clases</label>
                            <select class="form-control" id="clases" name="clases[]" multiple autocomplete="off">
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}" {{ $cliente->clases->contains($clase->id) ? 'selected' : '' }}>
                                        {{ $clase->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" autocomplete="off">
                            @if ($cliente->foto_perfil)
                                <img src="{{ asset('storage/' . $cliente->foto_perfil) }}" alt="Foto de perfil" class="img-fluid mt-2" style="max-width: 150px;">
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection