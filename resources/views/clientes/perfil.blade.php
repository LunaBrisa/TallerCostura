<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* Fondo gris claro */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .container-fluid {
            height: 100%;
            display: flex;
        }

        .profile-sidebar {
            background-color: #ffffff; /* Rosado claro */
            width: 20%; /* 20% del ancho total */
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: start;
            height: 100%;
        }

        .profile-sidebar a {
            text-decoration: none;
            color: #e91e63; /* Rosado oscuro */
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .profile-sidebar a:hover {
            background-color: #f8bbd0;
        }

        .profile-sidebar a.active {
            background-color: #f8bbd0;
            color: #ffffff;
        }

        .profile-content {
            flex-grow: 1;
            padding: 40px;
            background-color: #ffffff;
        }

        .profile-header {
            background-color: #f8bbd0; /* Rosado claro */
            color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            font-weight: bold;
            color: #e91e63;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #f8bbd0;
            box-shadow: 0 0 5px rgba(248, 187, 208, 0.5);
        }

        .btn-primary {
            background-color: #f8bbd0;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background-color: #e91e63;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column;
            }

            .profile-sidebar {
                width: 100%;
                height: auto;
                border-right: none;
                border-bottom: 2px solid #ddd;
            }

            .profile-content {
                padding: 20px;
            }
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
                        <a class="nav-link" href="/gestion/catalogo">Catálogo</a>
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

    <div class="container-fluid">
        <!-- Barra lateral -->
        <div class="profile-sidebar">
            <h4>Opciones</h4>
            <a href="#" class="active">Mi cuenta</a>
            <a href="#">Notificaciones</a>
            <a href="#">Historial de pedidos</a>
            <a href="#">Cerrar sesión</a>
        </div>

        <!-- Contenido del perfil -->
        <div class="profile-content">
            <div class="profile-header">
                <h2>Perfil de Usuario</h2>
                <p>Bienvenido, {{ $persona->nombre }} {{ $persona->apellido_p }} {{ $persona->apellido_m }}</p>
            </div>
            <form>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo:</label>
                    <input type="text" class="form-control" id="nombre" value="{{ $persona->nombre }} {{ $persona->apellido_p }} {{ $persona->apellido_m }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" value="{{ $persona->correo }}">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" value="{{ $persona->telefono }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" value="**********">
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
