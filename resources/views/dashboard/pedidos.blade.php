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
    header {
        background-color: #D91E7F;
        color: white;
        padding: 10px 0;
        text-align: center;
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
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-pink-500 text-white p-4 text-center">
        <h1 class="text-lg font-bold">Dashboard de Pedidos</h1>
        <nav class="bg-gray-200 p-2 flex justify-center space-x-4">
            <!--<a href=" route('dashboard.pedidos') }}" class="text-pink-600">Pedidos</a>-->
            <a href="" class="text-pink-600">Producción</a>
            <a href="" class="text-pink-600">Insumos</a>
            <a href="" class="text-pink-600">Servicios</a>
            <a href="" class="text-pink-600">Clientes</a>
            <a href="" class="text-pink-600">Finanzas</a>
        </nav>
    </header>
    
    
    <div class="container mx-auto p-4">
        <table class="w-full bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">#Orden</th>
                    <th class="p-2">Fecha de Orden</th>
                    <th class="p-2">Fecha de Entrega</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Detalles</th>
                </tr>
            </thead>
            <tbody>
              <!--  foreach ($pedidos as $pedido)-->
                    <tr class="border-b">
                        <td class="p-2 text-center">1<!--{ $pedido->id }}--></td>
                        <td class="p-2 text-center">22/02/04<!--{ $pedido->fecha_pedido }}--></td>
                        <td class="p-2 text-center">22/02/05<!--{ $pedido->fecha_entrega }}--></td>
                        <td class="p-2 text-center">Entregado<!--{ $pedido->estado }}--></td>
                        <td class="p-2 text-center">
                            <!--<a href="{ route('pedido.show', $pedido->id) }}" class="text-blue-500">-->Ver</a>
                        </td>
                    </tr>
               <!--endforeach-->
            </tbody>
        </table>
    </div>
</body>
</html>
