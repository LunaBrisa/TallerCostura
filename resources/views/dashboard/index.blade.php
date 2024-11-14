<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Dashboard Principal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                    <h5 class="card-title mt-3">Productos</h5>
                    <p class="card-text">Administra los productos en inventario.</p>
                    <a href="/inventario" class="btn btn-primary">Inventario</a>
                </div>
            </div>
        </div>

        <!-- Card para Reportes -->
        <div class="col-md-4 mt-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-graph-up" style="font-size: 2rem;"></i>
                    <h5 class="card-title mt-3">Reportes</h5>
                    <p class="card-text">Consulta reportes de actividades.</p>
                    <a href="/reportes" class="btn btn-primary">Reportes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.js"></script>
</body>
</html>
