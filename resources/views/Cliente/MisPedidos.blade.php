<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mis pedidos</title>
</head>
<body>
    @extends('layouts.nav')
    @section('content')
        <div class="container">
            <h2 class="text-center mb-4">Mis Pedidos</h2>

        @if($pedidos->isEmpty())
        <p>No tienes pedidos registrados.</p>
           @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descripción</th>
                            <th>Fecha de Pedido</th>
                            <th>Fecha de Entrega</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->descripcion }}</td>
                            <td>{{ $pedido->fecha_pedido }}</td>
                            <td>{{ $pedido->fecha_entrega }}</td>
                            <td>{{ $pedido->total }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                                <a class="btn btn-primary">Ver</a>
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