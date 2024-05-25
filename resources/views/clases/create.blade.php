@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Clase</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('clases.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="horario">Horario</label>
                            <input type="text" class="form-control" id="horario" name="horario" required>
                        </div>
                        <div class="form-group">
                            <label for="entrenador_id">Entrenador</label>
                            <select class="form-control" id="entrenador_id" name="entrenador_id" required>
                                @foreach($entrenadores as $entrenador)
                                    <option value="{{ $entrenador->id }}">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection