<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
        <p><strong>Empleado:</strong> {{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</p>
        <p><strong>Estado:</strong> {{ $pedido->estado }}</p>
        <p><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>

        <h4>Confecciones</h4>
        @foreach($pedido->detallesConfecciones as $detalle)
            <p><strong>Prenda:</strong> {{ $detalle->prendaConfeccion->nombre_prenda }}</p>
            <p><strong>Descripción:</strong> {{ $detalle->prendaConfeccion->descripcion }}</p>
        @endforeach

        <h4>Reparaciones</h4>
        @foreach($pedido->detallesReparaciones as $detalle)
            <p><strong>Prenda:</strong> {{ $detalle->prenda }}</p>
            <p><strong>Descripción del Problema:</strong> {{ $detalle->descripcion_problema }}</p>
        @endforeach

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">Volver</a>
    </div>
</body>
</html>
