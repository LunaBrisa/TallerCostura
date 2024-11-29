<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>

        .card {
            background-color: #ffffff; /* Fondo blanco */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-10px); /* Efecto flotante */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Sombra más pronunciada */
        }

        .card-title {
            color:  #d6336c;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color:  #BE5A8C; /* Rosa más intenso */
            color: white;
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
    @extends('layouts.nav')
    @section('content')
    <div class="d-flex flex-column min-vh-100" style="background-color: #f9f7f6; font-family: 'Arial', sans-serif;">
    <!-- Contenido Principal -->
    <div class="container my-5">
        <div class="row text-center">
            <h1 class="mb-5" style="color:  #BE5A8C; font-weight: bold;">Selecciona el Módulo que deseas gestionar</h1>
        </div>
        <div class="row">
            <!-- Card para Pedidos -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-box-seam" style="font-size: 3rem; color:  #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Pedidos</h5>
                        <p class="card-text">Gestiona los pedidos y detalles de producción.</p>
                        <a href="/pedidos" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Pedidos</a>
                    </div>
                </div>
            </div>

            <!-- Card para Clientes -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-people" style="font-size: 3rem; color:  #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Clientes</h5>
                        <p class="card-text">Administra la información de tus clientes.</p>
                        <a href="/clientes" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Clientes</a>
                    </div>
                </div>
            </div>

            <!-- Card para Empleados -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge" style="font-size: 3rem; color:  #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Empleados</h5>
                        <p class="card-text">Gestiona los datos y roles de tus empleados.</p>
                        <a href="/empleados" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Empleados</a>
                    </div>
                </div>
            </div>

            <!-- Card para Insumos -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-boxes" style="font-size: 3rem; color: #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Insumos</h5>
                        <p class="card-text">Administra los insumos.</p>
                        <a href="/inventario" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Insumos</a>
                    </div>
                </div>
            </div>

            <!-- Card para Servicios -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-scissors" style="font-size: 3rem; color: #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Servicios</h5>
                        <p class="card-text">Administra los servicios.</p>
                        <a href="{{ route('servicios.index') }}" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Servicios</a>
                    </div>
                </div>
            </div>

            
            <!-- Card para Catálogo -->
            <div class="col-md-4 mt-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-collection" style="font-size: 3rem; color:  #BE5A8C;"></i>
                        <h5 class="card-title mt-3" style=" color:  #d6336c; font-weight: bold;">Catálogo</h5>
                        <p class="card-text">Gestiona los productos del catálogo.</p>
                        <a href="/gestion/catalogo" class="btn btn-primary" style=" background-color:  #BE5A8C; border: none; border-radius: 12px;  padding: 10px 20px;">Catálogo</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
