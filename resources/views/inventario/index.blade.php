@extends('layouts.dashboard')

@section('title', 'Dashboard de Insumos')
@section('dashboard_name', 'Dashboard de Insumos')

@section('content')
<style>
 /* Tarjetas */
.card {
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #f9f4f4;
}

/* Botones */
.btn-primary {
    background-color: #a3d2ca;
    border-color: #a3d2ca;
    color: #fff;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #80cbc4;
    border-color: #80cbc4;
}

.btn-success {
    background-color: #ffb6b9;
    border-color: #ffb6b9;
    transition: 0.3s;
}

.btn-success:hover {
    background-color: #ff9295;
    border-color: #ff9295;
}

.btn-warning {
    background-color: #fce2b2;
    border-color: #fce2b2;
    transition: 0.3s;
}

.btn-warning:hover {
    background-color: #f1d18b;
    border-color: #f1d18b;
}

/* Tabla */
.table thead {
    background-color: #ffe2e2;
    color: #333;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #fceae8;
}

.table-hover tbody tr:hover {
    background-color: #fceae8;
}

/* Modales */
.modal-content {
    border-radius: 15px;
    background: linear-gradient(to bottom, #fceff1, #fdfbfb);
}

/* Encabezados */
h5.card-title {
    color: #6c757d;
    font-weight: bold;
}

/* Inputs */
input.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
}

input.form-control:focus {
    border-color: #a3d2ca;
    box-shadow: 0 0 0 0.2rem rgba(163, 210, 202, 0.25);
}

/* General */
body {
    background-color: #f7f6f6;
    font-family: 'Roboto', sans-serif;
}

/* Ajustes generales para los botones */
.d-flex .btn {
    margin-right: 15px;
    margin-left: 5px;
}

/* Espaciado para los formularios y tablas */
.form-control, .btn {
    margin-bottom: 10px;
}

/* Modificación de los modales */
.modal-header {
    background-color: #a3d2ca;
    color: #fff;
}

/* Ajustes en el formulario de búsqueda */
form .form-control {
    border-radius: 8px;
    padding: 12px;
}

form .btn-outline-primary {
    padding: 12px;
}

/* Estilo para los encabezados de la tabla */
th {
    text-align: center;
}

/* Ajustes en la vista de dispositivos pequeños */
@media (max-width: 768px) {
    .d-flex {
        flex-direction: column;
    }

    .table-responsive {
        overflow-x: scroll;
    }
}
</style>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Columna de insumos con menos stock -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Insumos con menos stock</h5>
                    <ul>
                        @foreach ($insumosMenosStock as $insumo)
                            <li>{{ $insumo->insumo }} - Stock: {{ $insumo->cantidad_stock }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Columna de insumos más utilizados -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Insumos más utilizados</h5>
                    <ul>
                        @foreach ($insumosMasUtilizados as $insumo)
                            <li>{{ $insumo->insumo }} - Total Usado: {{ $insumo->total_usado }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('inventario.index') }}" class="mt-2">
        <div class="d-flex">
            <input type="text" class="form-control" name="insumo" placeholder="Buscar por Nombre..." value="{{ request()->input('insumo') }}">
            <button type="submit" class="btn btn-outline-primary ms-2">Buscar</button>
        </div>
    </form>

    <!-- Tabla de insumos -->
    <div class="table-responsive my-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th id="header-id" class="sortable" data-column="id" style="cursor: pointer;">ID Insumo</th>
                    <th id="header-nombre" class="sortable" data-column="nombre" style="cursor: pointer;">Nombre</th>
                    <th id="header-stock" class="sortable" data-column="cantidad_stock" style="cursor: pointer;">Stock</th>
                    <th id="header-precio" class="sortable" data-column="precio_unitario" style="cursor: pointer;">Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="insumo-body">
                @foreach ($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->id }}</td>
                        <td>{{ $insumo->insumo }}</td>
                        <td>{{ $insumo->cantidad_stock }}</td>
                        <td>${{ number_format($insumo->precio_unitario, 2) }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarInsumoModal{{ $insumo->id }}">Editar</button>
                        </td>
                    </tr>
                    <!-- Modal de editar insumo -->
                    <div class="modal fade" id="editarInsumoModal{{ $insumo->id }}" tabindex="-1" aria-labelledby="editarInsumoLabel{{ $insumo->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarInsumoLabel{{ $insumo->id }}">Editar Insumo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('inventario.update', $insumo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="insumo" class="form-label">Insumo</label>
                                            <input type="text" class="form-control" id="insumo" name="insumo" value="{{ old('insumo', $insumo->insumo) }}" required>
                                        </div>
                                        <!-- Otros campos del formulario -->
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar insumo -->
    <div class="modal fade" id="agregarInsumoModal" tabindex="-1" aria-labelledby="agregarInsumoLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarInsumoLabel">Agregar Insumo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventario.store') }}" method="POST">
                        @csrf
                        <!-- Campos del formulario para agregar insumo -->
                        <button type="submit" class="btn btn-success">Agregar Insumo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
