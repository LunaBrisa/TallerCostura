<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-container {
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
        }
        .table-header {
            background-color: #ef9ee3;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
        .btn-edit, .btn-delete, .btn-toggle {
            margin: 0 5px;
        }
        .btn-add {
            background-color: #c1a3f6;
            color: white;
            font-weight: bold;
            border-radius: 20px;
        }
        .btn-add:hover {
            background-color: #ed9df6;
        }
        <style>
        .table-container {
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
        }
        .table-header {
            background-color: #ef9ee3;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
        .btn-edit, .btn-delete, .btn-toggle {
            margin: 0 5px;
        }
        .btn-add {
            background-color: #c1a3f6;
            color: white;
            font-weight: bold;
            border-radius: 20px;
        }
        .btn-add:hover {
            background-color: #ed9df6;
        }
        
        :root {
            --navbar-bg-color: black;
            --navbar-text-color: white;
            --btn-bg-color: pink; 
            --btn-text-color: black;
            --btn-hover-bg-color: lightpink;
        }

        .navbar {
            background-color: var(--navbar-bg-color);
        }

        .navbar .navbar-brand {
            color: var(--navbar-text-color);
            font-size: 1.5rem;
            font-weight: bold;
        }

        .dashboard-btn {
            background-color: var(--btn-bg-color);
            color: var(--btn-text-color);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .dashboard-btn:hover {
            background-color: var(--btn-hover-bg-color);
        }

        .dashboard-btn .icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-text {
            color: var(--navbar-text-color);
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            flex-grow: 1; 
        }

        .navbar-collapse {
            display: flex;
            justify-content: flex-end;
        }
    
    </style>
        
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
             <img src="{{ asset('images/logo.png') }}" width="155" height="85" alt="Logo">

            <div class="navbar-text">
                Dashboard de Pedidos 
            </div>

            <div class="navbar-collapse">
                <a class="dashboard-btn" href="http://127.0.0.1:8000/dashboard">
                    <span class="icon">←</span>
                    Regresar al Dashboard
                </a>
            </div>
        </div>
    </nav>

        </div>
      </nav><br>
    <div class="container">
        <!-- Encabezado -->
        <h1 class="text-center mt-4">Gestión de Servicios</h1>
        
        <!-- Tabla de servicios -->
        <div class="table-container">
            <div class="table-header">Listado de Servicios</div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                    @if ($servicio->visible)
                        <tr>
                            <td>{{ $servicio->servicio }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>${{ number_format($servicio->precio, 2) }}</td>
                                <td>
                                    <!-- Botón para abrir el modal de editar servicio -->
                                    <button class="btn btn-primary btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editModal-{{ $servicio->id }}">
                                        Editar
                                    </button>
                                
                                    <!-- Mostrar u ocultar servicio -->
                                    <form action="{{ $servicio->visible ? route('servicios.ocultar', $servicio->id) : route('servicios.mostrar', $servicio->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-{{ $servicio->visible ? 'warning' : 'success' }} btn-sm btn-toggle" type="submit">
                                            {{ $servicio->visible ? 'Ocultar' : 'Mostrar' }}
                                        </button>
                                    </form>
                                </td>
                                
                                </form>
                            </td>
                        </tr>
                    @else
                        <!-- Si el servicio no es visible, no mostrar la fila -->
                        <tr style="display:none;">
                            <td>{{ $servicio->servicio }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>${{ number_format($servicio->precio, 2) }}</td>
                            <td>
                                <form action="{{ route('servicios.mostrar', $servicio->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm btn-toggle" type="submit">
                                        Mostrar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
                
                </tbody>
            </table>

            <!-- Botón para agregar un nuevo servicio -->
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Servicio</button>
        </div>
    </div>

    <!-- Modal para agregar servicio -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('servicios.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Nombre del Servicio: Solo letras y espacios -->
                    <div class="mb-3">
                        <label for="servicio" class="form-label">Nombre del Servicio</label>
                        <input type="text" 
                               class="form-control" 
                               id="servicio" 
                               name="servicio" 
                               pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" 
                               title="El nombre solo puede contener letras y espacios" 
                               required>
                    </div>
                    <!-- Descripción: Permitir cualquier texto, mínimo 10 caracteres -->
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" 
                                  id="descripcion" 
                                  name="descripcion" 
                                  minlength="10" 
                                  title="La descripción debe tener al menos 10 caracteres" 
                                  required></textarea>
                    </div>
                    <!-- Precio: Solo números mayores a 0 -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" 
                               class="form-control" 
                               id="precio" 
                               name="precio" 
                               step="0.01" 
                               min="0.01" 
                               title="El precio debe ser un número mayor a 0" 
                               required>
                    </div>
                    <!-- Visible: Opciones sí o no -->
                    <div class="mb-3">
                        <label for="visible" class="form-label">Visible</label>
                        <select class="form-control" id="visible" name="visible" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


   <!-- Modales para editar servicios -->
@foreach ($servicios as $servicio)
<div class="modal fade" id="editModal-{{ $servicio->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $servicio->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{ $servicio->id }}">Editar Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('servicios.update', $servicio->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Nombre del Servicio: Solo letras y espacios -->
                    <div class="mb-3">
                        <label for="servicio-{{ $servicio->id }}" class="form-label">Nombre del Servicio</label>
                        <input type="text" 
                               class="form-control" 
                               id="servicio-{{ $servicio->id }}" 
                               name="servicio" 
                               value="{{ $servicio->servicio }}" 
                               pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" 
                               title="El nombre solo puede contener letras y espacios" 
                               required>
                    </div>
                    <!-- Descripción: Mínimo 10 caracteres -->
                    <div class="mb-3">
                        <label for="descripcion-{{ $servicio->id }}" class="form-label">Descripción</label>
                        <textarea class="form-control" 
                                  id="descripcion-{{ $servicio->id }}" 
                                  name="descripcion" 
                                  minlength="10" 
                                  title="La descripción debe tener al menos 10 caracteres" 
                                  required>{{ $servicio->descripcion }}</textarea>
                    </div>
                    <!-- Precio: Solo números mayores a 0 -->
                    <div class="mb-3">
                        <label for="precio-{{ $servicio->id }}" class="form-label">Precio</label>
                        <input type="number" 
                               class="form-control" 
                               id="precio-{{ $servicio->id }}" 
                               name="precio" 
                               value="{{ $servicio->precio }}" 
                               step="0.01" 
                               min="0.01" 
                               title="El precio debe ser un número mayor a 0" 
                               required>
                    </div>
                    <!-- Visible: Opciones Sí o No -->
                    <div class="mb-3">
                        <label for="visible-{{ $servicio->id }}" class="form-label">Visible</label>
                        <select class="form-control" id="visible-{{ $servicio->id }}" name="visible" required>
                            <option value="1" {{ $servicio->visible ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$servicio->visible ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
