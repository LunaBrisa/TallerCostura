@extends('layouts.dashboard')
@section('title', 'Dashboard de Empleados')
@section('dashboard_name', 'Dashboard de Empleados')
@section('content')

<style>
/* Estilo general */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Tarjetas */
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

/* Botones */
.btn-primary {
    background-color: #a3d2ca;
    border-color: #a3d2ca;
    color: #fff;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #80cbc4;
    border-color: #80cbc4;
    transform: translateY(-2px);
}

.btn-success {
    background-color: #ffb6b9;
    border-color: #ffb6b9;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-success:hover {
    background-color: #ff9295;
    border-color: #ff9295;
    transform: translateY(-2px);
}

.btn-warning {
    background-color: #fce2b2;
    border-color: #fce2b2;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-warning:hover {
    background-color: #f1d18b;
    border-color: #f1d18b;
    transform: translateY(-2px);
}

/* Tabla */
.table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

.table thead {
    background-color: #ffe2e2;
    color: #333;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #fceae8;
}

.table-hover tbody tr:hover {
    background-color: #fceae8;
    transition: background-color 0.3s ease;
}

/* Inputs */
input.form-control {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding: 12px 15px;
    transition: 0.3s ease;
    background-color: #fff;
}

input.form-control:focus {
    border-color: #a3d2ca;
    box-shadow: 0 0 5px rgba(163, 210, 202, 0.4);
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
    <!-- Formulario de búsqueda con botones con mejor espaciado -->
    <form method="GET" action="{{ route('empleados.index') }}" class="mt-2 mb-4">
        <div class="d-flex align-items-center">
            <input type="text" class="form-control" name="empleado" placeholder="Buscar por Nombre..." value="{{ request()->input('empleado') }}">
            <button type="submit" class="btn btn-primary ms-2">Buscar</button>
        </div>
    </form>
    <form action="{{ route('empleados.index') }}" method="GET" class="mb-4">
        <button type="submit" class="btn btn-outline-secondary mx-2">Ver todos</button>
    </form>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarEmpleadoModal">Agregar Empleado</button>
    </div>
    <!-- Tabla de empleados -->
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
                    <td>{{ $empleado->persona->user->email}}</td>
                    <td>{{ $empleado->persona->user->roles->first()->nombre_rol }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarEmpleadoModal{{ $empleado->id }}">Editar</button>
                        
                        <a href="{{ route('empleados.show', $empleado->id) }}" class="text-decoration-none"><i class="bi bi-eye"></i>Ver</a>               
                    </td>
                    
                </tr>
                <!-- Modal para Editar Empleado -->
                <div class="modal fade" id="editarEmpleadoModal{{ $empleado->id }}" tabindex="-1" aria-labelledby="editarEmpleadoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="editarEmpleadoLabel">Editar Empleado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $empleado->persona->nombre }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ $empleado->persona->apellido_p }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ $empleado->persona->apellido_m }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $empleado->persona->telefono }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $empleado->persona->user->email }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rol" class="form-label">Rol</label>
                                        <select class="form-control" id="rol" name="rol_id" required>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}" {{ $empleado->persona->user->roles->first()->id == $rol->id ? 'selected' : '' }}>
                                                    {{ $rol->nombre_rol }}
                                                </option>
                                            @endforeach
                                        </select>
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
                           <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
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
        
                        <div class="col-mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value=" {{ old ('fecha_nacimiento') }}">
                            @error('fecha_nacimiento')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
        
                        <div class="col-mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" value="{{old ('rfc')}}">
                            @error('rfc')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                  
                        <div class="col-mb-3">
                            <label for="nss" class="form-label">NSS</label>
                            <input type="text" class="form-control" name="nss" id="nss" value="{{old ('nss')}}">
                            @error('nss')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                   </div>
                    <button type="submit" class="btn btn-success mt-2">Agregar Empleado</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection