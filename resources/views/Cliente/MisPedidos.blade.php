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
                <table class="tabla-flex" style="width:70vw; ">
                    <thead class="table-header" style="height: 8vh;">
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
                    <tbody class="table-group-divider" >
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->descripcion }}</td>
                            <td>{{ $pedido->fecha_pedido }}</td>
                            <td>{{ $pedido->fecha_entrega }}</td>
                            <td>{{ $pedido->total }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>
                            <button class="btn btn-gest" data-bs-toggle="modal" data-bs-target="#modalPedido{{ $pedido->id }}">Ver</button>
                            </td>
                        </tr>
                        <!-- Modal para cada pedido -->
                        <div class="modal fade" id="modalPedido{{ $pedido->id }}" tabindex="-1" aria-labelledby="modalPedidoLabel{{ $pedido->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 Titulomodal" id="modalPedidoLabel{{ $pedido->id }}">Detalles del pedido</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card mb-4">
                                            <div class="card-header">Información del Pedido</div>
                                            <div class="card-body">
                                                <p><strong>#Orden:</strong> {{ $pedido->id }}</p>
                                                <p><strong>Empleado:</strong> {{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</p>
                                                <p><strong>Total:</strong> {{ $pedido->total }}</p>
                                            </div>
                                        </div>
                                        <!-- Detalles de Confecciones -->
                                        @if($pedido->detallesConfecciones->isNotEmpty())
                                        <div class="card mb-4">
                                            <div class="card-header">Detalles de Confecciones</div>
                                            <div class="card-body">
                                                @foreach($pedido->detallesConfecciones as $detalle)
                                                <div class="mb-3">
                                                    <p><strong>Prenda:</strong> {{ $detalle->prendaConfeccion->nombre_prenda }}</p>
                                                    <p><strong>Descripción:</strong> {{ $detalle->prendaConfeccion->descripcion }}</p>
                                                    <p><strong>Cantidad:</strong> {{ $detalle->cantidad_prenda }}</p>
                                                    <p><strong>Subtotal:</strong> ${{ number_format($detalle->subtotal, 2) }}</p>
                                                </div>
                                                <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Detalles de Reparaciones -->
                                        @if($pedido->detallesReparaciones->isNotEmpty())
                                        <div class="card mb-4">
                                            <div class="card-header">Detalles de Reparaciones</div>
                                            <div class="card-body">
                                                @foreach($pedido->detallesReparaciones as $detalle)
                                                <div class="mb-3">
                                                    <p><strong>Prenda:</strong> {{ $detalle->prenda }}</p>
                                                    <p><strong>Descripción del Problema:</strong> {{ $detalle->descripcion_problema }}</p>
                                                    <p><strong>Cantidad:</strong> {{ $detalle->cantidad_prenda }}</p>
                                                </div>
                                                <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Detalles de Lotes -->
                                        @if($pedido->detallesLotes->isNotEmpty())
                                        <div class="card mb-4">
                                            <div class="card-header">Detalles de Lotes</div>
                                            <div class="card-body">
                                                @foreach($pedido->detallesLotes as $detalle)
                                                <div class="mb-3">
                                                    <p><strong>Prenda:</strong> {{ $detalle->prenda }}</p>
                                                    <p><strong>Precio por Prenda:</strong> ${{ number_format($detalle->precio_por_prenda, 2) }}</p>
                                                    <p><strong>Cantidad:</strong> {{ $detalle->cantidad }}</p>
                                                    <p><strong>Anticipo:</strong> ${{ number_format($detalle->anticipo, 2) }}</p>
                                                </div>
                                                <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<style>
    html, body {
        height: 100%;
        margin: 0;
    }

    .container_pedidos {
        background-color: #F4D9EC;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .table-header {
        background-color: black;
        color: white;
    }

    .table-header th {
        font-family: 'Junigarden Swash';
    }
</style>
