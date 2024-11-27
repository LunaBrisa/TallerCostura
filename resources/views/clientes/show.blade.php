@extends('layouts.dashboard')

@section('title', 'Detalle del Cliente')
@section('dashboard_name', 'Detalle del Cliente')

@section('content')
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
