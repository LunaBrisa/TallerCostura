@extends('layouts.dashboard')

@section('title', 'Detalle del Cliente')
@section('dashboard_name', 'Detalle del Cliente')

@section('content')
<style>
    /* Estilo general para el fondo y los contenedores */
    body {
        background-color: #f8f9fa;
        color: #495057;
    }

    

    h3 {
        color: #6c757d;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    /* Estilo para las listas de información */
    .list-group-item {
        background-color: #f4d9d573;
        border: 1px solid #e2e6ea;
        color: #574949;
    }

    .list-group-item strong {
        color: #6c757d;
    }

    /* Estilo para la tabla de pedidos */
    .table {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table-dark {
        background-color: #e3f2fd;
        color: #333;
    }

    .table th,
    .table td {
        padding: 15px;
        vertical-align: middle;
    }

    .table td a {
        text-decoration: none;
    }

    .table td a:hover {
        color: #28a745;
    }

    /* Estilo para los botones */
    .btn {
        border-radius: 5px;
        padding: 8px 16px;
        font-size: 14px;
        margin-right: 10px;
        margin-top: 10px;
    }

    .btn-primary {
        background-color: #ef6f9c;
        border-color: #ef6f7e;
    }

    .btn-primary:hover {
        background-color: #e65c96;
        border-color: #e65c7f;
    }

    .btn-secondary {
        background-color: #f7b5b5;
        border-color: #f7c9b5;
    }

    .btn-secondary:hover {
        background-color: #e7a0a0;
        border-color: #e7a0a0;
    }

    .btn-sm {
        font-size: 13px;
    }

    /* Estilo para los márgenes de las secciones */
    .mb-4 {
        margin-bottom: 30px;
    }

    .row.mb-4 {
        margin-bottom: 20px;
    }
    .table-responsive {
    margin: 20px 0;
    border: 1px solid #dee2e6;
}

</style>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3>Información Personal</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $cliente->persona->nombre }} {{ $cliente->persona->apellido_p }} {{ $cliente->persona->apellido_m }}</li>
                <li class="list-group-item"><strong>Usuario:</strong> {{ $cliente->persona->user->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $cliente->persona->user->email }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $cliente->persona->telefono }}</li>
                <li class="list-group-item"><strong>Compañía:</strong> {{ $cliente->compania }}</li>
                <li class="list-group-item"><strong>Cargo:</strong> {{ $cliente->cargo }}</li>
            </ul>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Historial de Pedidos</h3>
            @if ($cliente->pedidos->isEmpty())
                <p>Este cliente no tiene pedidos registrados.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Pedido</th>
                            <th>Fecha de Pedido</th>
                            <th>Fecha de Entrega</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cliente->pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->fecha_pedido }}</td>
                                <td>{{ $pedido->fecha_entrega }}</td>
                                <td>{{ $pedido->descripcion }}</td>
                                <td>{{ $pedido->estado }}</td>
                                <td>{{ number_format($pedido->total, 2) }} {{ $pedido->moneda ?? 'MXN' }}</td>
                                <td>
                                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary btn-sm">Ver Detalle</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver a la lista de clientes</a>
        </div>
    </div>
</div>
@endsection
