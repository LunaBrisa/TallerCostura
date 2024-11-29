<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estiloCatalogoGeneral.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="detalle-pedido">
            <h2>Detalles del Pedido #{{ $pedido->id }}</h2>
            <div class="detalle-info">
                <div class="detalle-item">
                    <span class="detalle-label">Empleado:</span>
                    <span class="detalle-value">{{ $pedido->empleado->persona->nombre }} {{ $pedido->empleado->persona->apellido_p }}</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Estado:</span>
                    <span class="detalle-value">{{ $pedido->estado }}</span>
                </div>
                <div class="detalle-item">
                    <span class="detalle-label">Total:</span>
                    <span class="detalle-value">${{ number_format($pedido->total, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="seccion-detalles">
            <h4>Confecciones</h4>
            <div class="tabla-flex">
                <div class="tabla-header">
                    <span class="tabla-col">Prenda</span>
                    <span class="tabla-col">Descripción</span>
                </div>
                @foreach($pedido->detallesConfecciones as $detalle)
                <div class="tabla-row">
                    <span class="tabla-col">{{ $detalle->prendaConfeccion->nombre_prenda }}</span>
                    <span class="tabla-col">{{ $detalle->prendaConfeccion->descripcion }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="seccion-detalles">
            <h4>Reparaciones</h4>
            <div class="tabla-flex">
                <div class="tabla-header">
                    <span class="tabla-col">Prenda</span>
                    <span class="tabla-col">Descripción del Problema</span>
                </div>
                @foreach($pedido->detallesReparaciones as $detalle)
                <div class="tabla-row">
                    <span class="tabla-col">{{ $detalle->prenda }}</span>
                    <span class="tabla-col">{{ $detalle->descripcion_problema }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-volver mt-4">Volver</a>
    </div>
</body>
</html>
