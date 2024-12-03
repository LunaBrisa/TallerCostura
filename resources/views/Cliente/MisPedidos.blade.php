<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mis pedidos</title>
</head>
<body>
    @extends('layouts.nav')
    @section('content')
    <div class="container_pedidos">
        <h2 class="text-center mb-4" style="font-family; margin-top: 10vh;">Mis Pedidos</h2>
        @if($pedidos->isEmpty())
            <p>No tienes pedidos registrados.</p>
        @else
        <table class="table table-striped">
            <thead class="table-header">
                <tr>
                    <th scope="col">#Orden</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de Pedido</th>
                    <th scope="col">Fecha de Entrega</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->descripcion }}</td>
                    <td>{{ $pedido->fecha_pedido }}</td>
                    <td>{{ $pedido->fecha_entrega }}</td>
                    <td>${{ number_format($pedido->total, 2) }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>
                        <a href="{{ route('Cliente.MostrarDetallesPedido', $pedido->id) }}" 
                           class="btn btn-info">
                            Ver Detalles
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endsection
</body>
</html>
