@extends('layouts.dashboard')

@section('title', 'Detalle del Pedido')
@section('dashboard_name', 'Detalle del Pedido')

@section('content')
<style>
   /* Header styling */
   h3 {
        color: #5d6d7e; /* Texto pastel */
        font-weight: bold;
        margin-bottom: 15px;
        border-left: 5px solid #ffb6b9; /* Línea decorativa */
        padding-left: 10px;
    }

    /* List group customization */
    .list-group-item {
        font-size: 16px;
        color: #6c757d;
        background-color: #fff4e6a9; /* Fondo pastel suave */
        border: none;
        border-radius: 8px;
        margin-bottom: 8px;
        padding: 12px 15px;
    }

    .list-group-item strong {
        color: #ff6f61;
    }

    /* Table styling */
    .table {
        background-color: #fef6e4;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #ffdab9; /* Bordes suaves */
    }

    .table th {
        background-color: #ffdab9; /* Encabezado pastel */
        color: #5d6d7e;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        padding: 12px;
    }

    .table td {
        text-align: center;
        font-size: 14px;
        color: #555;
        padding: 10px;
        border-bottom: 1px solid #f8e8dc; /* Divisiones suaves */
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .table-hover tbody tr:hover {
        background-color: #fce9e3; /* Fondo de hover */
    }

    /* Button styling */
    .btn-secondary {
        background-color: #ffb6b9;
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 25px;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: #ff857a;
        transform: translateY(-2px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h3 {
            font-size: 18px;
        }

        .list-group-item {
            font-size: 14px;
        }

        .table th, .table td {
            font-size: 12px;
        }

        .btn-secondary {
            font-size: 14px;
            padding: 8px 15px;
        }
    }
    </style>
<div class="container">
    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

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
            <form action="{{ route('pedidos.cambiarEstado', $pedido->id) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-secondary">Cambiar Estado</button>
            </form>
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
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesLotes as $detalle)
                            <tr>
                                <td>{{ $detalle->prenda }}</td>
                                <td>{{ number_format($detalle->precio_por_prenda, 2) }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ number_format($detalle->anticipo, 2) }}</td>
                                <td>{{ number_format($detalle->subtotal, 2) }}</td>
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
                            <th>Subtotal</th>
                            <th>Servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesReparaciones as $detalle)
    <tr>
        <td>{{ $detalle->prenda }}</td>
        <td>{{ $detalle->descripcion_problema }}</td>
        <td>{{ $detalle->cantidad_prenda }}</td>
        <td>{{ number_format($detalle->subtotal, 2) }}</td>
        <td>
            @foreach ($detalle->servicios as $reparacion)
                {{ $reparacion->servicio ?? 'N/A' }}
            @endforeach
        </td>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->detallesConfecciones as $detalle)
                        <tr>
                            <td>{{ $detalle->prendaConfeccion->nombre_prenda ?? 'N/A' }}</td>
                            <td>{{ $detalle->cantidad_prenda }}</td>
                            <td>{{ number_format($detalle->subtotal, 2) }}</td>
                            <td>
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#detalleConfeccionModal{{ $detalle->id }}">
                                    Ver Detalles
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($pedido->detallesConfecciones as $detalle)
                    <div class="modal fade" id="detalleConfeccionModal{{ $detalle->id }}" tabindex="-1" aria-labelledby="detalleConfeccionLabel{{ $detalle->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detalleConfeccionLabel{{ $detalle->id }}">Detalles de la Prenda: {{ $detalle->prendaConfeccion->nombre_prenda ?? 'N/A' }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Descripción:</strong> {{ $detalle->prendaConfeccion->descripcion ?? 'No disponible' }}</li>
                                        <li class="list-group-item"><strong>Tipo de Prenda:</strong> {{ $detalle->prendaConfeccion->nombre_prenda }}</li>
                                         {{--   <li class="list-group-item"><strong>Color:</strong> {{ $detalle->prendaConfeccion ->prendasColor ->color-> color ?? 'No especificado' }}</li>>
                                      <li class="list-group-item"><strong>Tela:</strong> {{ $detalle->prendaConfeccion->prendasTelas->tela->nombre_tela ?? 'No especificado' }}</li>
                                        <li class="list-group-item"><strong>Material:</strong> {{ $detalle->prendaConfeccion->prendasTelas->tela->materialTela->material_tela ?? 'No especificado' }}</li>
                                        <li class="list-group-item"><strong>Medidas:</strong> --}}
                                            <ul>
                                                <li>Pecho: {{ $detalle->medidas->pecho ?? 'N/A' }} cm</li>
                                                <li>Cintura: {{ $detalle->medidas->cintura ?? 'N/A' }} cm</li>
                                                <li>Mangas: {{ $detalle->medidas->mangas ?? 'N/A' }} cm</li>
                                                <li>Largo: {{ $detalle->medidas->largo ?? 'N/A' }} cm</li>
                                            </ul>
                                        </li>
                                    </ul>
                                    
                                    <div class="text-center mt-4">
                                        @if ($detalle->prendaConfeccion->ruta_imagen)
                                            <img src="{{ asset($detalle->prendaConfeccion->ruta_imagen) }}" alt="Imagen de la prenda" class="img-fluid rounded" style="max-width: 300px;">
                                        @else
                                            <p><em>No hay imagen disponible</em></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    

                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ session('backUrl', route('pedidos.index')) }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
    
</div>
@endsection
