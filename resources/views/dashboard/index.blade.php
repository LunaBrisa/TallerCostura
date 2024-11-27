<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

<!-- Contenido Principal -->
<div class="container my-5">
    <div class="row text-center">
        <h1 class="mb-5">Selecciona el Módulo que deseas gestionar</h1>
    </div>
    <div class="row">
        <!-- Card para Pedidos -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Pedidos</h5>
                    <p class="card-text">Gestiona los pedidos y detalles de producción.</p>
                    <a href="/pedidos" class="btn btn-primary">Pedidos</a>
                </div>
            </div>
        </div>

        <!-- Card para Clientes -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Clientes</h5>
                    <p class="card-text">Administra la información de tus clientes.</p>
                    <a href="/clientes" class="btn btn-primary">Clientes</a>
                </div>
            </div>
        </div>

        <!-- Card para Empleados -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-badge" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Empleados</h5>
                    <p class="card-text">Gestiona los datos y roles de tus empleados.</p>
                    <a href="/empleados" class="btn btn-primary">Empleados</a>
                </div>
            </div>
        </div>
        <!-- Card para Productos -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-boxes" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Insumos</h5>
                    <p class="card-text">Administra los insumos.</p>
                    <a href="/inventario" class="btn btn-primary">Insumos</a>
                </div>
            </div>
        </div>
        <!-- Card para Servicios -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-boxes" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Servicios</h5>
                    <p class="card-text">Administra los productos en servicios.</p>
                    <a href="{{ route('servicios.index') }}" class="btn btn-primary">Servicios</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.js"></script>
</body>
</html>
