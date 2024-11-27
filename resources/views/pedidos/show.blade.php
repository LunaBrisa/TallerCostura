@extends('layouts.dashboard')

@section('title', 'Detalle del Pedido')
@section('dashboard_name', 'Detalle del Pedido')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Información del Pedido</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>ID Pedido:</strong> {{ $pedido->id }}</li>
                <li class="list-group-item"><strong>Fecha del Pedido:</strong> {{ $pedido->fecha_pedido }}</li>
                <li class="list-group-item"><strong>Fecha de Entrega:</strong> {{ $pedido->fecha_entrega }}</li>
                <li class="list-group-item"><strong>Descripción:</strong> {{ $pedido->descripcion }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $pedido->estado }}</li>
                <li class="list-group-item"><strong>Total:</strong> {{ number_format($pedido->total, 2) }} {{ $pedido->moneda ?? 'MXN' }}</li>
            </ul>
        </div>
    </div>

    {{-- Detalles de Lotes --}}
    @if ($pedido->detallesLotes->isNotEmpty())
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Detalles de Lotes</h3>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Prenda</th>
                            <th>Precio por Prenda</th>
                            <th>Cantidad</th>
                            <th>Anticipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesLotes as $detalle)
                            <tr>
                                <td>{{ $detalle->prenda }}</td>
                                <td>{{ number_format($detalle->precio_por_prenda, 2) }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ number_format($detalle->anticipo, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- Detalles de Reparaciones --}}
    @if ($pedido->detallesReparaciones->isNotEmpty())
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Detalles de Reparaciones</h3>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Prenda</th>
                            <th>Descripción del Problema</th>
                            <th>Cantidad</th>
                            <th>Precio por Prenda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesReparaciones as $detalle)
                            <tr>
                                <td>{{ $detalle->prenda }}</td>
                                <td>{{ $detalle->descripcion_problema }}</td>
                                <td>{{ $detalle->cantidad_prenda }}</td>
                                <td>{{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- Detalles de Confecciones --}}
    @if ($pedido->detallesConfecciones->isNotEmpty())
        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Detalles de Confecciones</h3>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Prenda</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesConfecciones as $detalle)
                            <tr>
                                <td>{{ $detalle->prendaConfeccion->nombre_prenda ?? 'N/A' }}</td>
                                <td>{{ $detalle->cantidad_prenda }}</td>
                                <td>{{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
    
</div>
@endsection
