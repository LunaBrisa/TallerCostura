@extends('layouts.dashboard')

@section('title', 'Dashboard de Clientes')
@section('dashboard_name', 'Dashboard de Clientes')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clientes con más pedidos</h5>
                    <ul>
                        @foreach ($pedidosPorCliente as $cliente)
                            <li>{{ $cliente->cliente->persona->nombre }} - {{ $cliente->cantidad_pedidos }} pedidos</li>
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
    
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
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
                    <td>{{ $cliente->persona->telefono }}</td>
                    <td>{{ $cliente->persona->correo }}</td>
                    <td>{{ $cliente->compania }}</td>
                    <td>{{ $cliente->cargo }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarClienteModal{{ $cliente->id }}">Editar</button>
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
                                <!-- Formulario para editar cliente -->
                                
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                                    <!-- Campos del formulario -->
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->persona->nombre }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ $cliente->persona->apellido_p }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ $cliente->persona->apellido_m }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->persona->telefono }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->persona->correo }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="compania" class="form-label">Compañía</label>
                                        <input type="text" class="form-control" id="compania" name="compania" value="{{ $cliente->compania }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-labelledby="agregarClienteLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #F5C6C6;">
                <h5 class="modal-title" id="agregarClienteLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #F5C6C6;">
                <form action="{{ route('Registro.RegistrarCliente') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="name" id="name" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('nombre_usuario') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email" id="email" style="border: #B5C5D7 2px solid; font-size: larger;">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
        
        
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('contrasena') }}">
                            @error('contrasena')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" style="border: #B5C5D7 2px solid; font-size: larger;">
                            @error('contrasena')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('nombre') }}">
                                @error('nombre')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
            
                            <div class="col-md-6">
                                <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name="apellido_p" id="apellido_p" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('apellido_p') }}">
                                @error('apellido_p')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="apellido_m" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" name="apellido_m" id="apellido_m" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old('apellido_m')}}">
                                @error('apellido_m')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
            
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" style="border: #B5C5D7 2px solid; font-size: larger;" value=" {{ old ('telefono') }}">
                                @error('telefono')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
            
                            <div class="col-md-6">
                                <label for="compania" class="form-label">Compañía</label>
                                <input type="text" class="form-control" name="compania" id="compania" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old ('compania')}}">
                                @error('compania')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
            
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" name="cargo" id="cargo" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old ('cargo')}}">
                                @error('cargo')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn" style="background-color:#B5C5D7; width: 200px; font-size: larger; border-radius: 8px;">Registrar</button>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar el modal automáticamente si hay errores -->
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var agregarClienteModal = new bootstrap.Modal(document.getElementById('agregarClienteModal'));
            agregarClienteModal.show();
        });
    </script>
@endif
@endsection
