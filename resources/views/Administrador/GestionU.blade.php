<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Usuarios</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f8ff;
      font-family: Arial, sans-serif;
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
    h1 {
      font-size: 24px;
      color: #333;
    }
    .btn-add-user {
      background-color: #a5d8ff;
      color: #004085;
    }
    .btn-add-user:hover {
      background-color: #74c0fc;
    }
    .table thead {
      background-color: #c5f6fa;
    }
    .table th {
      color: #006d75;
    }
    .edit-btn {
      background-color: #d3f9d8;
      color: #2f9e44;
    }
    .edit-btn:hover {
      background-color: #b2f2bb;
    }
    .delete-btn {
      background-color: #ffe3e3;
      color: #d6336c;
    }
    .delete-btn:hover {
      background-color: #ffa8a8;
    }
    .pagination .page-link {
      color: #4c6ef5;
      background-color: #e7f5ff;
    }
    .pagination .page-link:hover {
      background-color: #c5f6fa;
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
  
  <div class="containern mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Gestión de Usuarios</h1>
      <button class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Agregar Usuario</button>
    </div>

    <!-- Tabla de usuarios -->
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Correo</th> 
          <th>Teléfono</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($personas as $persona)
        <tr>
          <td>{{ $persona->id }}</td>
          <td>{{ $persona->nombre }}</td>
          <td>{{ $persona->apellido_p }}</td>
          <td>{{ $persona->apellido_m }}</td>
          <td>{{ $persona->correo }}</td>
          <td>{{ $persona->telefono }}</td>
          <td>
            <!-- Botón Editar -->
            <button class="btn btn-sm btn-primary" onclick="openEditModal({{ $persona->id }}, '{{ $persona->nombre }}', '{{ $persona->apellido_p }}', '{{ $persona->apellido_m }}', '{{ $persona->telefono }}', '{{ $persona->correo }}')">Editar</button>

            <!-- Botón Eliminar -->
            <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta persona?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  <!-- Modal para Agregar Usuario -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form method="POST" action="{{ route('personas.store') }}">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="apellidoP" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" id="apellidoP" name="apellido_p" required>
            </div>
            <div class="mb-3">
              <label for="apellidoM" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" id="apellidoM" name="apellido_m">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo</label>
              <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
  function openEditModal(id, nombre, apellidoP, apellidoM, telefono, correo) {
    document.getElementById('editNombre').value = nombre;
    document.getElementById('editApellidoP').value = apellidoP;
    document.getElementById('editApellidoM').value = apellidoM;
    document.getElementById('editTelefono').value = telefono;
    document.getElementById('editCorreo').value = correo;
    document.getElementById('editForm').action = '/personas/' + id;
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
  }
</script>
</body>
</html>

    <!-- Modal para Editar Usuario -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Editar Persona</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="mb-3">
                <label for="editNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="editNombre" name="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios" required>
              </div>
              <div class="mb-3">
                <label for="editApellidoP" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="editApellidoP" name="apellido_p" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios" required>
              </div>
              <div class="mb-3">
                <label for="editApellidoM" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="editApellidoM" name="apellido_m" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
              </div>
              <div class="mb-3">
                <label for="editTelefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="editTelefono" name="telefono" pattern="\d{10}" title="Debe contener 10 dígitos numéricos">
              </div>
              <div class="mb-3">
                <label for="editCorreo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="editCorreo" name="correo" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript para abrir el modal y cargar datos en el formulario -->
  <script>
    function openEditModal(id, nombre, apellidoP, apellidoM, telefono, correo) {
      document.getElementById('editNombre').value = nombre;
      document.getElementById('editApellidoP').value = apellidoP;
      document.getElementById('editApellidoM').value = apellidoM;
      document.getElementById('editTelefono').value = telefono;
      document.getElementById('editCorreo').value = correo;
      document.getElementById('editForm').action = '/personas/' + id;
      var editModal = new bootstrap.Modal(document.getElementById('editModal'));
      editModal.show();
    }
  </script>

  <!-- Enlace a Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
