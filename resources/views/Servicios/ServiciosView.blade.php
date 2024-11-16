<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo de la tabla */
        .table-container {
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #bde0fe;
            color: #023047;
            font-weight: bold;
            font-size: 1.5em;
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .table th {
            background-color: #d8e2dc;
            color: #1d3557;
            text-align: center;
        }

        .table td {
            text-align: center;
            background-color: #e9f5ff;
        }

        /* Botones */
        .btn-edit {
            background-color: #76c893;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn-edit:hover {
            background-color: #52b788;
        }

        .btn-delete {
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn-delete:hover {
            background-color: #d62828;
        }

        .btn-add {
            background-color: #ffb4a2;
            color: #1d3557;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
            text-align: center;
            display: block;
            width: fit-content;
            margin: 20px auto;
        }

        .btn-add:hover {
            background-color: #ff8fa3;
            color: white;
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
      
    <div class="table-container">
        <div class="table-header">Servicios Disponibles</div>
        <table class="table table-bordered table-hover m-0">
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
                <tr>
                    <td>{{ $servicio->servicio }}</td>
                    <td>{{ $servicio->descripcion }}</td>
                    <td>${{ number_format($servicio->precio, 2) }}</td>
                    <td>
                        <!-- Botón Editar -->
                        <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editServiceModal-{{ $servicio->id }}">Editar</button>
                        
                        <!-- Botón Eliminar -->
                        <button class="btn btn-delete btn-sm" data-bs-toggle="modal" data-bs-target="#deleteServiceModal-{{ $servicio->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addServiceModal">Agregar Servicio</button>
    </div>

    <!-- Modal para Editar Servicio -->
    @foreach ($servicios as $servicio)
    <div class="modal fade" id="editServiceModal-{{ $servicio->id }}" tabindex="-1" aria-labelledby="editServiceModalLabel-{{ $servicio->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel-{{ $servicio->id }}">Editar Servicio</h5>
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
                            <input type="number" class="form-control" id="precio" name="precio" value="{{ $servicio->precio }}" required>
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
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Modal para Agregar Servicio -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Agregar Nuevo Servicio</h5>
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
                            <input type="number" class="form-control" id="precio" name="precio" required>
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
                        <button type="submit" class="btn btn-primary">Agregar Servicio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script de Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
