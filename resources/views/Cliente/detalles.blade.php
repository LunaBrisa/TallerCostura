<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-sm {
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .table-bordered th, .table-bordered td {
            text-align: center;
            vertical-align: middle;
        }
        </style>
        

</head>
<body>
    @extends('layouts.nav')
        <!-- Tabla para mostrar pedidos -->
@if($pedidos->isNotEmpty())
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#Orden</th>
            <th>Empleado</th>
            <th>Total</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</td>
            <td>${{ number_format($pedido->total, 2) }}</td>
            <td>
                <!-- Desplegar detalles en una tabla anidada -->
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Detalles de Confecciones -->
                        @foreach($pedido->detallesConfecciones as $detalle)
                        <tr>
                            <td>Confección</td>
                            <td>{{ $detalle->prendaConfeccion->nombre_prenda }}: {{ $detalle->prendaConfeccion->descripcion }}</td>
                            <td>{{ $detalle->cantidad_prenda }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                        @endforeach

                        <!-- Detalles de Reparaciones -->
                        @foreach($pedido->detallesReparaciones as $detalle)
                        <tr>
                            <td>Reparación</td>
                            <td>
                                {{ $detalle->prenda }}<br>
                                <small>{{ $detalle->descripcion_problema }}</small>
                                @if($detalle->servicios)
                                <ul class="mb-0">
                                    @foreach($detalle->servicios as $servicio)
                                    <li>{{ $servicio->servicio }}</li>
                                    @endforeach
                                </ul>
                                @else
                                <span>No hay servicios registrados</span>
                                @endif
                            </td>
                            <td>{{ $detalle->cantidad_prenda }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                        @endforeach

                        <!-- Detalles de Lotes -->
                        @foreach($pedido->detallesLotes as $detalle)
                        <tr>
                            <td>Lote</td>
                            <td>{{ $detalle->prenda }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p class="text-center">No hay pedidos disponibles.</p>
@endif

    @endsection
</body>
</html>
