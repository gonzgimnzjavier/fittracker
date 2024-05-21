@extends('layouts.app')

@section('content')
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    ¡Bienvenido al Dashboard!

                    <div class="mt-4">
                        <a href="{{ route('clientes.index') }}" class="btn btn-primary">Gestionar Clientes</a>
                        <a href="{{ route('clases.index') }}" class="btn btn-primary">Gestionar Clases</a>
                        <a href="{{ route('entrenadores.index') }}" class="btn btn-primary">Gestionar Entrenadores</a>
                        <a href="{{ route('asistencias.index') }}" class="btn btn-primary">Gestionar Asistencias</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection