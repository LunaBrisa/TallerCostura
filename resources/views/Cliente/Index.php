@extends('Cliente.MisPedidos')


@section('content')
<div class="container">
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
                <p><strong>Servicios:</strong></p>
                <ul>
                    @foreach($detalle->servicios as $servicio)
                    <li>{{ $servicio->servicio }}</li>
                    @endforeach
                </ul>
                <p><strong>Subtotal:</strong> ${{ number_format($detalle->subtotal, 2) }}</p>
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
                <p><strong>Subtotal:</strong> ${{ number_format($detalle->subtotal, 2) }}</p>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
