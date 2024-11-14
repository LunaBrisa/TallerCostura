<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
            --main-bg-color: #3490dc;
            --navbar-bg-color: black;
            --navbar-text-color: white;
            --hover-color: lightgray;
        }
        .navbar {
            background-color: var(--navbar-bg-color);
        }
        .navbar a {
            color: var(--navbar-text-color);
        }
        .navbar a:hover {
            color: var(--hover-color);
        }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="155" height="85">
            <a class="navbar-brand" href="#">Taller Costura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/produccion') }}">Producción</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Insumos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Finanzas</a></li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-5">
    <h1 class="text-primary">Gestión de Clientes</h1>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">Agregar Cliente</button>
    </div>
    
    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Compañía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->persona->nombre }}</td>
                    <td>{{ $cliente->persona->apellido_p }}</td>
                    <td>{{ $cliente->persona->apellido_m }}</td>
                    <td>{{ $cliente->persona->telefono }}</td>
                    <td>{{ $cliente->persona->correo }}</td>
                    <td>{{ $cliente->compania }}</td>
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
                                <form action="/clientes/editar/{{ $cliente->id }}" method="POST">
                                    @csrf
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
</div>

<!-- Modal para Agregar Cliente -->
<div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-labelledby="agregarClienteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarClienteLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/clientes/agregar" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellido_p" name="apellido_p" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellido_m" name="apellido_m">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="compania" class="form-label">Compañía</label>
                        <input type="text" class="form-control" id="compania" name="compania">
                    </div>
                    <button type="submit" class="btn btn-success">Agregar Cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
