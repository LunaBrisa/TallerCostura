<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Servicios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>


/* Estilo general del cuerpo */
body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
    
        .dashboard-btn {
            background-color: #ffb6b9;
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
    
        .dashboard-btn:hover {
            background-color: #ff9295;
        }
    
        /* Contenedor general */
        .container {
            margin: 30px auto;
            max-width: 1200px;
        }
    
        /* Card centrada */
        .card-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
    
      

        .card {
       border-radius: 15px;
       box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
       background-color: #f9f4f4;}
    
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
    
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4c4c4c;
        }
    
        /* Tabla centrada */
        .table-container {
            margin: 0 auto;
            width: 100%;
            max-width: 900px;
        }
    
        .table-header {
            background-color: #ff9295;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 1.5rem;
            border-radius: 10px 10px 0 0;
        }
    
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    
        .table th {
            background-color: #ffb6b9;
            color: white;
            text-align: center;
            font-weight: bold;
        }
    
        .table tbody tr:nth-child(odd) {
            background-color: #ffe4e6;
        }
    
        .table tbody tr:nth-child(even) {
            background-color: #fff5f6;
        }
    
        .table-hover tbody tr:hover {
            background-color: #ffd6d9;
            transition: background-color 0.3s ease;
        }
    
        /* Botones */
        .btn-edit, .btn-delete, .btn-toggle {
            margin: 0 5px;
        }
    
        .btn-edit {
            background-color: #c1a3f6;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 5px 10px;
        }
    
        .btn-edit:hover {
            background-color: #a085e0;
        }
    
        .btn-toggle {
            background-color: #ffb6b9;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 5px 10px;
        }
    
        .btn-toggle:hover {
            background-color: #ff9295;
        }
    
        .btn-add {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px 20px;
            display: block;
            margin: 20px auto;
        }
    
        .btn-add:hover {
            background-color: #43a047;
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

        /* Estilos para las pestañas */
.nav-tabs {
    border: none;
    background-color: #f8f9fa;
    margin-bottom: 20px;
    border-radius: 10px;
}

.nav-tabs .nav-link {
    color: #6c757d;
    border: none;
    font-weight: 600;
    padding: 10px 20px;
    font-size: 1.1rem;
    border-radius: 10px 10px 0 0;
}

.nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #ff9295;
    border-color: #ff9295;
    font-weight: bold;
}

.nav-tabs .nav-link:hover {
    color: #ffffff;
    background-color: #ff9295;
    border-color: #ff9295;
}

/* Estilos para las tablas */
.table-container {
    margin-top: 10px;
    border-radius: 15px;
    background-color: white;
    padding: 20px;
   
}

.table-header {
    background-color: #ff9295;
    color: white;
    text-align: center;
    font-size: 1.5rem;
    padding: 10px;
    border-radius: 10px 10px 0 0;
}

.table {
    border-radius: 10px;
    overflow: hidden;
}

.table th {
    background-color: #ffb6b9;
    color: white;
    text-align: center;
    font-weight: bold;
}

.table tbody tr:nth-child(odd) {
    background-color: #ffe4e6;
}

.table tbody tr:nth-child(even) {
    background-color: #fff5f6;
}

.table-hover tbody tr:hover {
    background-color: #ffd6d9;
    transition: background-color 0.3s ease;
}

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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Servicios mas usados</h5>
                        <ul class="list-group">
                            @forelse($serviciosMasUsados as $servicio)
                                <li class="list-group-item">
                                    {{ $servicio['servicio'] }} - Usado {{ $servicio['cantidad_usos'] }} veces
                                </li>
                            @empty
                                <li class="list-group-item">No hay datos disponibles</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        <!-- Encabezado -->
        <h1 class="text-center mt-4">Gestión de Servicios</h1>
        <div class="row" style="padding-top: 25px;">
            <ul class="nav nav-tabs mb-2 interactive-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="visibles-tab" data-bs-toggle="tab" href="#visibles" role="tab" aria-controls="visibles" aria-selected="true">
                        Visibles
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ocultos-tab" data-bs-toggle="tab" href="#ocultos" role="tab" aria-controls="ocultos" aria-selected="false" tabindex="-1">
                        Ocultos
                    </a>
                </li>
            </ul>
        </div>
        
      <div class="tab-content" id="myTabContent">
    <!-- Tab Visibles -->
    <div class="tab-pane fade show active" id="visibles" role="tabpanel" aria-labelledby="visibles-tab">
        <div class="table-container">
            <div class="table-header">Servicios Visibles</div>
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
                                    <button class="btn btn-primary btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editModal-{{ $servicio->id }}">
                                        Editar
                                    </button>
                                    <form action="{{ route('servicios.ocultar', $servicio->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning btn-sm btn-toggle" type="submit">
                                            Ocultar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab Ocultos -->
    <div class="tab-pane fade" id="ocultos" role="tabpanel" aria-labelledby="ocultos-tab">
        <div class="table-container">
            <div class="table-header">Servicios Ocultos</div>
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
                        @if (!$servicio->visible)
                            <tr>
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
        </div>
    </div>
</div>


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
