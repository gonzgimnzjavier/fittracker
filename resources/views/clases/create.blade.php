@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">Crear Clase</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clases.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required autocomplete="off"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <input type="text" class="form-control" id="horario" name="horario" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="entrenador_id" class="form-label">Entrenador</label>
                            <select class="form-control" id="entrenador_id" name="entrenador_id" required autocomplete="off">
                                @foreach($entrenadores as $entrenador)
                                    <option value="{{ $entrenador->id }}">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <a href="{{ route('clases.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection