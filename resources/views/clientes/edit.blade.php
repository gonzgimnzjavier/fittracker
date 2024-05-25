@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Cliente</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $cliente->dni) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="membresia_id">Membresía</label>
                            <select class="form-control" id="membresia_id" name="membresia_id" required>
                                @foreach($membresias as $membresia)
                                    <option value="{{ $membresia->id }}" {{ old('membresia_id', $cliente->membresia_id) == $membresia->id ? 'selected' : '' }}>
                                        {{ $membresia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clases">Clases</label>
                            <select class="form-control" id="clases" name="clases[]" multiple>
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}" {{ $cliente->clases->contains($clase->id) ? 'selected' : '' }}>
                                        {{ $clase->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto_perfil">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                            @if ($cliente->foto_perfil)
                                <img src="{{ asset('storage/' . $cliente->foto_perfil) }}" alt="Foto de perfil" class="img-fluid mt-2" style="max-width: 150px;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection