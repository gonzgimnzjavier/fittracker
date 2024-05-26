@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Detalle de la Clase</div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $clase->nombre }}</p>
                    <p><strong>Descripción:</strong> {{ $clase->descripcion }}</p>
                    <p><strong>Horario:</strong> {{ $clase->horario }}</p>
                    <p><strong>Entrenadores:</strong> 
                        @foreach($clase->entrenadores as $entrenador)
                            {{ $entrenador->nombre }} {{ $entrenador->apellido }}<br>
                        @endforeach
                    </p>
                    <a href="{{ route('clases.index') }}" class="btn btn-secondary">Volver</a>
                    <!-- Botón para abrir el modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#asignarAlumnoModal">
                        Asignar Alumno
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <h3>Alumnos Matriculados</h3>
        </div>
        @foreach($clase->clientes as $cliente)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="{{ $cliente->foto_perfil ? asset($cliente->foto_perfil) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
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
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este cliente?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="asignarAlumnoModal" tabindex="-1" role="dialog" aria-labelledby="asignarAlumnoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="asignarAlumnoModalLabel">Asignar Alumno a la Clase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('clases.asignarAlumno', $clase->id) }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="cliente_id">Seleccione Alumno</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellidos }}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Asignar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection