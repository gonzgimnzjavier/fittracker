@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Lista de Entrenadores</h1>
    <a href="{{ route('entrenadores.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Agregar Entrenador
    </a>
    <button id="toggleView" class="btn btn-secondary">Cambiar Vista</button>
</div>

<div id="cardView" class="row">
    @foreach($entrenadores as $entrenador)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 card-container">
            <div class="card h-100">
                <img src="{{ $entrenador->foto_perfil ? asset($entrenador->foto_perfil) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
                <div class="card-body">
                    <h5 class="card-title">{{ $entrenador->nombre }} {{ $entrenador->apellido }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $entrenador->email }}</p>
                    <p class="card-text"><strong>Teléfono:</strong> {{ $entrenador->telefono }}</p>
                    <p class="card-text"><strong>Dirección:</strong> {{ $entrenador->direccion }}</p>
                    <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($entrenador->fecha_nacimiento)->format('d/m/Y') }}</p>
                    <p class="card-text"><strong>DNI:</strong> {{ $entrenador->dni }}</p>
                    <a href="{{ route('entrenadores.show', $entrenador->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('entrenadores.edit', $entrenador->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form id="deleteForm-{{ $entrenador->id }}" action="{{ route('entrenadores.destroy', $entrenador->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $entrenador->id }}')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="tableView" class="table-responsive" style="display:none;">
    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entrenadores as $entrenador)
                <tr>
                    <td>{{ $entrenador->id }}</td>
                    <td>{{ $entrenador->nombre }}</td>
                    <td>{{ $entrenador->apellido }}</td>
                    <td>{{ $entrenador->email }}</td>
                    <td>{{ $entrenador->telefono }}</td>
                    <td>{{ $entrenador->direccion }}</td>
                    <td>{{ \Carbon\Carbon::parse($entrenador->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $entrenador->dni }}</td>
                    <td>
                        <a href="{{ route('entrenadores.show', $entrenador->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('entrenadores.edit', $entrenador->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form id="deleteForm-{{ $entrenador->id }}" action="{{ route('entrenadores.destroy', $entrenador->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $entrenador->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(entrenadorId) {
        Swal.fire({
            title: '¿Estás seguro de que deseas eliminar a este entrenador?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar',
            focusCancel: true,
            customClass: {
                confirmButton: 'swal-confirm-btn',
                cancelButton: 'swal-cancel-btn'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    '¡Eliminado!',
                    'El entrenador ha sido eliminado.',
                    'success'
                ).then(() => {
                    document.getElementById(`deleteForm-${entrenadorId}`).submit();
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('toggleView').addEventListener('click', function() {
            var tableView = document.getElementById('tableView');
            var cardView = document.getElementById('cardView');
            if (tableView.style.display === 'none') {
                tableView.style.display = 'block';
                cardView.style.display = 'none';
            } else {
                tableView.style.display = 'none';
                cardView.style.display = 'flex';
                cardView.style.flexWrap = 'wrap';
            }
        });
    });
</script>
@endsection