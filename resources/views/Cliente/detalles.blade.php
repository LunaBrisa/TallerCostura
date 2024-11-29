<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estiloOz.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
        <table class="table tabla-detalles">
            <tr>
                <th>Empleado</th>
                <td>{{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $pedido->estado }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>${{ number_format($pedido->total, 2) }}</td>
            </tr>
        </table>

        <h4>Confecciones</h4>
        <table class="table tabla-detalles">
            <thead>
                <tr>
                    <th>Prenda</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detallesConfecciones as $detalle)
                <tr>
                    <td>{{ $detalle->prendaConfeccion->nombre_prenda }}</td>
                    <td>{{ $detalle->prendaConfeccion->descripcion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Reparaciones</h4>
        <table class="table tabla-detalles">
            <thead>
                <tr>
                    <th>Prenda</th>
                    <th>Descripción del Problema</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detallesReparaciones as $detalle)
                <tr>
                    <td>{{ $detalle->prenda }}</td>
                    <td>{{ $detalle->descripcion_problema }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Volver</a>
    </div>
</body>
</html>
