@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection