@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">Editar Clase</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clases.update', $clase->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $clase->nombre) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', $clase->descripcion) }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <input type="text" class="form-control" id="horario" name="horario" value="{{ old('horario', $clase->horario) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="entrenador_id" class="form-label">Entrenador</label>
                            <select class="form-control" id="entrenador_id" name="entrenador_id" required>
                                @foreach($entrenadores as $entrenador)
                                    <option value="{{ $entrenador->id }}" {{ $clase->entrenador_id == $entrenador->id ? 'selected' : '' }}>{{ $entrenador->nombre }} {{ $entrenador->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Actualizar Clase</button>
                            <a href="{{ route('clases.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection