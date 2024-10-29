<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard de Pedidos</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }
    th {
        background-color: #f8f8f8;
    }
    .text-blue-500 {
        color: #3490dc;
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
    </style>
</head>
<body class="bg-gray-100">
        <nav class="navbar">
            <div class="container" >
                <img src="{{ asset('images/logo.png') }}" width="155" height="85">
                <a class="navbar-brand" href="#">Taller Costura</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li>
                            <a href="#" class="text-pink-600">Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="text-pink-600">Producción</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="text-pink-600">Insumos</a>
                        </li>
                        <li>
                            <a href="" class="text-pink-600">Servicios</a>
                        </li>
                        <li>
                            <a href="" class="text-pink-600">Clientes</a>
                        </li>
                        <li>
                            <a href="" class="text-pink-600">Finanzas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
    
    <div class="container mx-auto p-4">
        <table class="w-full bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">#Orden</th>
                    <th class="p-2">Usuario</th>
                    <th class="p-2">Empleado</th>
                    <th class="p-2">Fecha de Orden</th>
                    <th class="p-2">Fecha de Entrega</th>
                    <th class="p-2">Anticipo</th>
                    <th class="p-2">Subtotal</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="border-b">
                        <td class="p-2 text-center">{{ $pedido->id_pedido }}</td>
                        <td class="p-2 text-center">{{ $pedido->id_usuario }}</td>
                        <td class="p-2 text-center">{{ $pedido->id_empleado }}</td>
                        <td class="p-2 text-center">{{ $pedido->fecha_pedido }}</td>
                        <td class="p-2 text-center">{{ $pedido->fecha_entrega }}</td>
                        <td class="p-2 text-center">{{ $pedido->anticipo }}</td>
                        <td class="p-2 text-center">{{ $pedido->subtotal }}</td>
                        <td class="p-2 text-center">{{ $pedido->total }}</td>
                        <td class="p-2 text-center">
                            <!--<a href="{ route('pedido.show', $pedido->id) }}" class="text-blue-500">-->Ver</a>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
