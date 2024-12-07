@extends('layouts.dashboard')

@section('title', 'Dashboard de Clientes')
@section('dashboard_name', 'Dashboard de Clientes')
@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Fondo suave */
    }

    .card {
        border-radius: 12px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .card-title {
        font-size: 1.5rem;
        color: #6c757d;
    }

    .btn {
        border-radius: 8px;
        font-size: 1rem;
    }

    .btn-primary {
        background-color: #d5889f; /* Azul pastel */
        border: none;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #b14560;
    }

    .btn-success {
        background-color: #d4a36e; /* Verde pastel */
        border: none;
        color: #ffffff;
    }

    .btn-success:hover {
        background-color: #cb7051;
    }

    .btn-close {
        background-color: transparent;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #57153a;
        border-radius: 8px;
    }

    .table {
        margin-top: 20px;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-hover tbody tr:hover {
        background-color: #F9F9F9;
    }

    .table-dark {
        background-color: #79a3d3;
        color: #ffffff;
    }

    .modal-header {
        background-color: #F5C6C6; /* Rojo pastel */
        color: #6c757d;
    }

    .modal-body {
        background-color: #FDF5E6; /* Fondo claro */
    }

    .d-flex .btn {
        margin-right: 10px; /* Espaciado entre botones */
    }

    form {
        margin-bottom: 1.5rem; /* Espaciado entre formularios */
    }
    .table-responsive {
    margin: 20px 0;
    border: 1px solid #dee2e6;
}

    </style>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clientes con más pedidos en el mes</h5>
                    <ul>
                        @foreach ($pedidosPorCliente as $cliente)
                            <li>{{ $cliente->cliente }} - {{ $cliente->cantidad_pedidos }} pedidos</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ route('clientes.index') }}" class="mt-2">
        <div class="d-flex">
            <input type="text" class="form-control" name="cliente" placeholder="Buscar por Nombre..." value="{{ request()->input('cliente') }}">
            <button type="submit" class="btn btn-primary ml-2">Buscar</button>
        </div>
    </form>
    <form action="{{ route('clientes.index') }}" method="GET" class="d-flex">
        <button type="submit" class="btn btn-primary mx-1" name="estado" value="">Ver todos</button>
    </form>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">Agregar Cliente</button>
    </div>
    <div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Compañía</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->persona->nombre }} {{ $cliente->persona->apellido_p }} {{ $cliente->persona->apellido_m }}</td>
                    <td>{{ $cliente->persona->user->name }}</td>
                    <td>{{ $cliente->persona->telefono }}</td>
                    <td>{{ $cliente->persona->user->email }}</td>
                    <td>{{ $cliente->compania }}</td>
                    <td>{{ $cliente->cargo }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarClienteModal{{ $cliente->id }}">Editar</button>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="text-decoration-none"><i class="bi bi-eye"></i>Ver</a>                        
                    </td>
                    
                </tr>

                <!-- Modal para Editar Cliente -->
<div class="modal fade" id="editarClienteModal{{ $cliente->id }}" tabindex="-1" aria-labelledby="editarClienteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarClienteLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                
                    <div class="form-group">
                        <label for="name">Nombre de Usuario</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $cliente->persona->user->name) }}" class="form-control" required>
                        @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $cliente->persona->nombre) }}" class="form-control" required>
                        @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="apellido_p">Apellido Paterno</label>
                        <input type="text" name="apellido_p" id="apellido_p" value="{{ old('apellido_p', $cliente->persona->apellido_p) }}" class="form-control" required>
                        @error('apellido_p')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="apellido_m">Apellido Materno</label>
                        <input type="text" name="apellido_m" id="apellido_m" value="{{ old('apellido_m', $cliente->persona->apellido_m) }}" class="form-control">
                        @error('apellido_m')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $cliente->persona->telefono) }}" class="form-control" required>
                        @error('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="compania">Compañía</label>
                        <input type="text" name="compania" id="compania" value="{{ old('compania', $cliente->compania) }}" class="form-control">
                        @error('compania')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="cargo">Cargo</label>
                        <input type="text" name="cargo" id="cargo" value="{{ old('cargo', $cliente->cargo) }}" class="form-control">
                        @error('cargo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $cliente->persona->user->email) }}" class="form-control" required>
                        @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="password">Nueva Contraseña (Opcional)</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Dejar vacío si no desea cambiarla">
                        @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña (Opcional)</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        @error('password_confirmation')
                                 <small class="text-danger">{{ $message }}</small>
                               @enderror
                    </div>
                    <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">

                    <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

            @endforeach
        </tbody>
    </table>
    </div>

<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-labelledby="agregarClienteLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #F5C6C6;">
                <h5 class="modal-title" id="agregarClienteLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #F5C6C6;">
                <form action="{{ route('clientes.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                              <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                               <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" style="border: #B5C5D7 2px solid; font-size: larger;">
                               @error('password_confirmation')
                                 <small class="text-danger">{{ $message }}</small>
                               @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                                <div class="mb-3">
                                    <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ old('apellido_p') }}" required>
                                    @error('apellido_p')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
            
                                <div class="mb-3">
                                    <label for="apellido_m" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ old('apellido_m') }}">
                                    @error('apellido_m')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
            
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                                    @error('telefono')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="compania" class="form-label">Compañía</label>
                                    <input type="text" class="form-control" id="compania" name="compania" value="{{ old('compania') }}">
                                    @error('compania')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
            
                                <div class="mb-3">
                                    <label for="cargo" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}">
                                    @error('cargo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <input type="hidden" name="cliente_id" value="nuevo">
            
                                <button type="submit" class="btn btn-success" style="background-color: #7fa9d8">Agregar Cliente</button>
                            </form>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar el modal automáticamente si hay errores -->
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var clienteId = '{{ old("cliente_id") }}';
        if (clienteId && clienteId !== 'nuevo') {
            // Muestra el modal de edición correspondiente
            var editarClienteModal = new bootstrap.Modal(document.getElementById('editarClienteModal' + clienteId));
            editarClienteModal.show();
        } else {
            // Muestra el modal de agregar
            var agregarClienteModal = new bootstrap.Modal(document.getElementById('agregarClienteModal'));
            agregarClienteModal.show();
        }
    });
</script>


@endif

@endsection
