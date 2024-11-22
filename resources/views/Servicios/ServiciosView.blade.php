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
        .navbar {
      background-color: black;
    }
    .navbar a {
      color: white;
    }
    .navbar a:hover {
      color: lightgray;
    }
    .navbar-toggler-icon {
      filter: invert(1);
    }
    .footer {
      bottom: 0;
      left: 0;
      width: 100%;
      height: 50px;
      background-color: black;
      color: white;
      text-align: center;
      font-size: 20px;
    }
    .containern {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
        
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
          <img src="{{ asset('images/logo.png') }}" width="155" height="85">
          <a class="navbar-brand" href="/">Taller Costura</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/gestion/catalogo">Catalogo</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Servicios</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
          </div>
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
                                <!-- Mostrar u ocultar servicio -->
                                <form action="{{ route('servicios.ocultar', $servicio->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-warning btn-sm btn-toggle" type="submit">
                                        Ocultar
                                    </button>
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
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="servicio" name="servicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        </div>
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
                        <div class="mb-3">
                            <label for="servicio" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="servicio" name="servicio" value="{{ $servicio->servicio }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $servicio->descripcion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" value="{{ $servicio->precio }}" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="visible" class="form-label">Visible</label>
                            <select class="form-control" id="visible" name="visible" required>
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
