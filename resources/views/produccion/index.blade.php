<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producción</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Dashboard de Producción y Reparaciones</h1>

    <!-- Estado de Producción -->
    <h3>Estado de Producción</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Prenda</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Progreso</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se deben renderizar los pedidos en proceso -->
            <tr>
                <td>3</td>
                <td>Pantalón</td>
                <td>Reparación de cierre</td>
                <td>En proceso</td>
                <td>50%</td>
            </tr>
            <!-- Más filas de ejemplo -->
        </tbody>
    </table>

    <!-- Prendas en Reparación -->
    <h3 class="mt-5">Prendas en Reparación</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Prenda</th>
                <th>Descripción Problema</th>
                <th>Servicio</th>
                <th>Insumos Usados</th>
            </tr>
        </thead>
        <tbody>
            <!-- Aquí se deben renderizar las prendas en reparación -->
            <tr>
                <td>4</td>
                <td>Rasgado en costura</td>
                <td>Costura y ajuste</td>
                <td>Hilo, aguja</td>
            </tr>
            <!-- Más filas de ejemplo -->
        </tbody>
    </table>
</div>
</body>
</html>