<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Detalles del Pedido #{{ $pedido->id }}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5>Información del Pedido</h5>
            <p><strong>Fecha de Pedido:</strong> {{ $pedido->fecha_pedido }}</p>
            <p><strong>Fecha de Entrega:</strong> {{ $pedido->fecha_entrega }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->cliente->persona->nombre }}</p>
            <p><strong>Compañia:</strong> {{ $pedido->cliente->compania }}</p>
            <p><strong>Empleado:</strong> {{ $pedido->empleado->persona->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $pedido->descripcion }}</p>
            <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
        </div>
    </div>

    <h5>Detalles del Pedido</h5>
            @if($pedido->detallesConfeccion && $pedido->detallesConfeccion->isNotEmpty())
            <h6>Detalles de Confección</h6>
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Prenda</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
    @foreach($pedido->detallesConfeccion as $detalle)
        <tr>
            <td>{{ $detalle->prendaConfeccion->nombre_prenda}}</td>
            <td>{{ $detalle->cantidad_prenda }}</td>
        </tr>
    @endforeach
</tbody>
</table>
@endif

@if($pedido->detallesReparacion && $pedido->detallesReparacion->isNotEmpty())
<h6>Detalles de Reparación</h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Prenda</th>
            <th>Cantidad</th>
            <th>Servicio</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedido->detallesReparacion as $detalle)
    @if ($detalle->prendaReparacion && $detalle->prendaReparacion->servicio)
        <tr>
            <td>{{ $detalle->prendaReparacion->nombre_prenda }}</td>
            <td>{{ $detalle->cantidad_prenda }}</td>
            <td>{{ $detalle->prendaReparacion->servicio->servicio }}</td>
            <td>{{ $detalle->prendaReparacion->servicio->descripcion }}</td>
        </tr>
    @endif
@endforeach

    </tbody>
</table>
@endif

@if($pedido->detallesLote && $pedido->detallesLote->isNotEmpty())
<h6>Detalles de Lote</h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Prenda</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedido->detallesLote as $detalleLote)
                        <tr>
                            <td>{{ $detalleLote->prenda }}</td>
                            <td>{{ $detalleLote->cantidad }}</td>
                        </tr>
            @endforeach
    </tbody>
</table>
@endif
        

    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary mt-4">Volver a la lista de pedidos</a>
</div>

</body>
</html>