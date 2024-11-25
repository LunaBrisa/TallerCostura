@extends('layouts.dashboard')

@section('title', 'Dashboard de Empleados')
@section('dashboard_name', 'Dashboard de Empleados')
@section('content')
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
                    <h5 class="card-title">Empleados con más pedidos</h5>
                    <ul>
                        @foreach ($pedidosPorEmpleado as $empleado)
                            <li>{{ $empleado->empleado->persona->nombre }} - {{ $empleado->cantidad_pedidos }} pedidos</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ route('empleados.index') }}" class="mt-2">
        <div class="d-flex">
            <input type="text" class="form-control" name="empleado" placeholder="Buscar por Nombre..." value="{{ request()->input('empleado') }}">
            <button type="submit" class="btn btn-primary ml-2">Buscar</button>
        </div>
    </form>
    <form action="{{ route('empleados.index') }}" method="GET" class="d-flex">
        <button type="submit" class="btn btn-primary mx-1" name="estado" value="">Ver todos</button>
    </form>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal">Agregar Empleado</button>
    </div>
    
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->persona->nombre }} {{ $empleado->persona->apellido_p }} {{ $empleado->persona->apellido_m }}</td>
                    <td>{{ $empleado->persona->user->name }}</td>
                    <td>{{ $empleado->persona->telefono }}</td>
                    <td>{{ $empleado->persona->correo }}</td>
                    <td>{{ $empleado->persona->user->roles->first()->nombre_rol }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarEmpleadoModal{{ $empleado->id }}">Editar</button>
                    </td>
                </tr>

                <!-- Modal para Editar Empleado -->
                <div class="modal fade" id="editarEmpleadoModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editarEmpleadoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarClienteLabel">Editar Empleado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->persona->nombre }}" required>
                                        @error('nombre')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ $empleado->persona->apellido_p }}" required>
                                        @error('apellido_p')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ $empleado->persona->apellido_m }}">
                                        @error('apellido_m')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $empleado->persona->telefono }}" required>
                                        @error('telefono')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo" value="{{ $empleado->persona->correo }}" required>
                                        @error('correo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $empleado->fecha_nacimiento }}" required>
                                        @error('fecha_nacimiento')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="rfc" class="form-label">RFC</label>
                                        <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $empleado->rfc }}" required>
                                        @error('rfc')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="nss" class="form-label">NSS</label>
                                        <input type="text" class="form-control" id="nss" name="nss" value="{{ $empleado->nss }}" required>
                                        @error('nss')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre de Usuario</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $empleado->persona->user->name }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="contrasena" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                                        <small class="text-muted">Deja este campo vacío si no deseas cambiar la contraseña.</small>
                                        @error('contrasena')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="rol" class="form-label">Rol</label>
                                        <select class="form-control" id="rol" name="rol_id" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}" 
                                                    {{ $empleado->persona->user->roles->first()->id == $rol->id ? 'selected' : '' }}>
                                                    {{ $rol->nombre_rol }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('rol_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    
                                    <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

<!-- Modal para Agregar Empleado -->
<div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" aria-labelledby="agregarEmpleadoLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #F5C6C6;">
                <h5 class="modal-title" id="agregarEmpleadoLabel">Agregar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: #F5C6C6;">

                <form action="{{ route('empleados.store') }}" method="POST">
                    @csrf

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
                        <label for="password_confirmation" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        @error('contrasena')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
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
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                        @error('fecha_nacimiento')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control" id="rfc" name="rfc" value="{{ old('rfc') }}" required>
                        @error('rfc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nss" class="form-label">NSS</label>
                        <input type="text" class="form-control" id="nss" name="nss" value="{{ old('nss') }}" required>
                        @error('nss')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="empleado_id" value="nuevo">
                    <button type="submit" class="btn btn-success">Agregar Empleado</button>
                </form>
           
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Verifica si el error pertenece a un cliente específico
            var empleadoId = '{{ old("empleado_id") }}';
            if (empleadoId && empleadoId !== 'nuevo') {
                // Muestra el modal de edición correspondiente
                var editarEmpleadoModal = new bootstrap.Modal(document.getElementById('editarEmpleadoModal' + empleadoId));
                editarEmpleadoModal.show();
            } else {
                // Muestra el modal de agregar
                var agregarEmpleadoModal = new bootstrap.Modal(document.getElementById('agregarEmpleadoModal'));
                agregarEmpleadoModal.show();
            }
        });
    </script>
@endif
@endsection