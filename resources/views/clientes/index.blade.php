@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-white-800">Lista de Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Agregar Cliente
    </a>
    <button id="toggleView" class="btn btn-secondary">Cambiar Vista</button>
</div>

<div id="cardView" class="row">
    @foreach($clientes as $cliente)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 card-container">
            <div class="card h-100">
                <img src="{{ $cliente->foto_perfil ? asset($cliente->foto_perfil) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Foto de perfil">
                <div class="card-body">
                    <h5 class="card-title">{{ $cliente->nombre }} {{ $cliente->apellidos }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $cliente->email }}</p>
                    <p class="card-text"><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                    <p class="card-text"><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                    <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</p>
                    <p class="card-text"><strong>DNI:</strong> {{ $cliente->dni }}</p>
                    <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form id="deleteForm-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $cliente->id }}')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div id="tableView" class="table-responsive" style="display:none;">
    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $cliente->dni }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form id="deleteForm-{{ $cliente->id }}" action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $cliente->id }}')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(clienteId) {
        Swal.fire({
            title: '¿Estás seguro de que deseas eliminar a este cliente?',
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
                    'El cliente ha sido eliminado.',
                    'success'
                ).then(() => {
                    document.getElementById(`deleteForm-${clienteId}`).submit();
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