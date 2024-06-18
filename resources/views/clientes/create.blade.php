@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">Crear Cliente</div>
                <div class="card-body">
                    <form id="clientForm" method="POST" action="{{ route('clientes.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}" required autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <label for="membresia_id" class="form-label">Membresía</label>
                            <select class="form-control" id="membresia_id" name="membresia_id" required autocomplete="off">
                                @foreach($membresias as $membresia)
                                    <option value="{{ $membresia->id }}" data-max-clases="{{ $membresia->max_clases }}" {{ old('membresia_id') == $membresia->id ? 'selected' : '' }}>
                                        {{ $membresia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="clases" class="form-label">Clases</label>
                            <select class="form-control" id="clases" name="clases[]" multiple autocomplete="off">
                                @foreach($clases as $clase)
                                    <option value="{{ $clase->id }}" {{ old('clases') && in_array($clase->id, old('clases')) ? 'selected' : '' }}>
                                        {{ $clase->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" autocomplete="off">
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('clientForm').addEventListener('submit', function(event) {
    var selectedMembership = document.getElementById('membresia_id').selectedOptions[0];
    var maxClases = selectedMembership.getAttribute('data-max-clases');
    var selectedClasses = document.getElementById('clases').selectedOptions;

    if (selectedClasses.length > maxClases) {
        event.preventDefault();
        Swal.fire({
            title: 'Error',
            text: 'Has seleccionado más clases de las permitidas para esta membresía.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
    }
});
</script>
@endsection