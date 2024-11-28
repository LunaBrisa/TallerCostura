<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
</head>
<body>
    <h1>Detalles del Pedido #{{ $pedido->id }}</h1>
    <p><strong>Empleado:</strong> {{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</p>
    <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>

    @if($pedido->detallesConfecciones->isNotEmpty())
        <h3>Detalles de Confecciones</h3>
        @foreach($pedido->detallesConfecciones as $detalle)
            <p><strong>Prenda:</strong> {{ $detalle->prendaConfeccion->nombre_prenda }}</p>
            <p><strong>Descripción:</strong> {{ $detalle->prendaConfeccion->descripcion }}</p>
            <p><strong>Cantidad:</strong> {{ $detalle->cantidad_prenda }}</p>
            <hr>
        @endforeach
    @endif

    @if($pedido->detallesReparaciones->isNotEmpty())
        <h3>Detalles de Reparaciones</h3>
        @foreach($pedido->detallesReparaciones as $detalle)
            <p><strong>Prenda:</strong> {{ $detalle->prenda }}</p>
            <p><strong>Descripción del Problema:</strong> {{ $detalle->descripcion_problema }}</p>
            <hr>
        @endforeach
    @endif

    <a href="{{ url()->previous() }}">Volver a Mis Pedidos</a>
</body>
</html>
