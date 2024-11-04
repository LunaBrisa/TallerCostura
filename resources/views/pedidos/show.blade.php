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
            <p><strong>Anticipo:</strong> {{ $pedido->anticipo }}</p>
            <p><strong>Subtotal:</strong> ${{ number_format($pedido->subtotal, 2) }}</p>
            <p><strong>Cliente:</strong> {{ $pedido->usuario->persona->nombre }}</p>
            <p><strong>Compañia:</strong> {{ $pedido->usuario->persona->cliente->compania }}</p>
            <p><strong>Empleado:</strong> {{ $pedido->empleado->persona->nombre }}</p>
            <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
        </div>
    </div>

    <h5>Detalles del Pedido</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prenda</th>
                <th>Cantidad</th>
                <th>Talla</th>
                <th>Color</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalleConfeccion as $detalle)
            <tr>
                <td>{{ $detalle->prenda->nombre_prenda ?? 'N/A' }}</td>
                <td>{{ $detalle->cantidad_prendas }}</td>
                <td>{{ $detalle->talla }}</td>
                <td>{{ $detalle->color }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary mt-4">Volver a la lista de pedidos</a>
</div>

</body>
</html>