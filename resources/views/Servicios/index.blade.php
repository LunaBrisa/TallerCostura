<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicios Disponibles</title>

    <link rel="stylesheet" href="{{ asset('estilos.css') }}">
</head>
<body>
    <div class="tabla">
        <div class="header">
            <h2>Servicios Disponibles</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Costura básica</td>
                    <td>Costura simple para reparación</td>
                    <td>$15.00</td>
                    <td class="acciones">
                        <button class="editar"></button>
                        <button class="eliminar"></button>
                    </td>
                </tr>
                <tr>
                    <td>Corte y ajuste</td>
                    <td>Corte de prenda y ajuste de largo</td>
                    <td>$30.00</td>
                    <td class="acciones">
                        <button class="editar"></button>
                        <button class="eliminar"></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
