@extends('layouts.dashboard')
@section('title', 'Dashboard de Pedidos')
@section('dashboard_name', 'Dashboard de Pedidos')
@section('content')

<style>
    /* Estilo general */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5; /* Fondo claro y neutro */
    margin: 0;
    padding: 0;
    color: #333;
}

/* Tarjetas */
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff; /* Fondo blanco para destacar contenido */
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px); /* Efecto de elevación al pasar el cursor */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15); /* Sombra más fuerte en hover */
}

/* Encabezados de tarjeta */
.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #4c4c4c;
    margin-bottom: 10px;
}

/* Botones */
.btn-primary {
    background-color: #a3d2ca;
    border-color: #a3d2ca;
    color: #fff;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-primary:hover {
    background-color: #80cbc4;
    border-color: #80cbc4;
    transform: translateY(-2px); /* Efecto sutil de elevación */
}

.btn-success {
    background-color: #ffb6b9;
    border-color: #ffb6b9;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-success:hover {
    background-color: #ff9295;
    border-color: #ff9295;
    transform: translateY(-2px);
}

.btn-warning {
    background-color: #fce2b2;
    border-color: #fce2b2;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: bold;
    transition: 0.3s ease-in-out;
}

.btn-warning:hover {
    background-color: #f1d18b;
    border-color: #f1d18b;
    transform: translateY(-2px);
}

/* Tabla */
.table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden; /* Para bordes redondeados */
}

.table thead {
    background-color: #ffe2e2;
    color: #333;
}

.table-striped tbody tr:nth-child(odd) {
    background-color: #fceae8;
}

.table-hover tbody tr:hover {
    background-color: #fceae8;
    transition: background-color 0.3s ease;
}

/* Inputs */
input.form-control {
    border-radius: 10px;
    border: 1px solid #ced4da;
    padding: 12px 15px;
    transition: 0.3s ease;
    background-color: #fff;
}

input.form-control:focus {
    border-color: #a3d2ca;
    box-shadow: 0 0 5px rgba(163, 210, 202, 0.4);
}

/* Modales */
.modal-content {
    border-radius: 15px;
    background: linear-gradient(to bottom, #fceff1, #fdfbfb);
    padding: 20px;
}

.modal-header {
    background-color: #a3d2ca;
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 10px 20px;
}

/* Ajustes generales de la vista */
.d-flex .btn {
    margin-right: 15px;
    margin-left: 5px;
}

.form-control, .btn {
    margin-bottom: 15px;
}

/* Ajustes en la vista de dispositivos pequeños */
@media (max-width: 768px) {
    .d-flex {
        flex-direction: column;
        align-items: flex-start;
    }

    .table-responsive {
        overflow-x: scroll;
    }
}

/* Títulos y texto en general */
h5.card-title {
    color: #6c757d;
    font-weight: bold;
}

/* Encabezado y pies de tabla */
th {
    text-align: center;
    font-weight: bold;
}

/* Fondo de página */
body {
    background-color: #f5f5f5;
    color: #333;
}
    </style>
</style>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Número de Pedidos</h5>
                        <p>Pendientes: {{ $estadisticas['pedidosEnProceso'] }}</p>
                        <p>Completados: {{ $estadisticas['pedidosCompletados'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos Generados</h5>
                        <p>Total: ${{ number_format($estadisticas['totalIngresos'], 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('pedidos.index') }}">
            <div class="d-flex">
                <input type="text" class="form-control" name="orden" placeholder="Buscar por Orden" value="{{ request()->input('orden') }}">
                <input type="text" class="form-control ml-2" name="cliente" placeholder="Buscar por Cliente" value="{{ request()->input('cliente') }}">
                <button type="submit" class="btn btn-primary ml-2">Buscar</button>
            </div>
        </form>
        <div class="d-flex mb-4">
            <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#createOrderModal" onclick="setOrderType('lote')">
                Crear Pedido de Lotes
            </button>
            <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#createOrderModal" onclick="setOrderType('reparacion')">
                Crear Pedido de Reparaciones
            </button>
            <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#createOrderModal" onclick="setOrderType('confeccion')">
                Crear Pedido de Confecciones
            </button>
        </div>
        <form action="{{ route('pedidos.index') }}" method="GET" class="d-flex">
            <button type="submit" class="btn btn-primary mx-1" name="estado" value="">Ver todos</button>
            <button type="submit" class="btn btn-secondary mx-1" name="estado" value="Completado">Pedidos Completados</button>
            <button type="submit" class="btn btn-warning mx-1" name="estado" value="Pendiente">Pedidos Pendientes</button>
        </form>
        <!-- Pedidos Table -->
        <div class="table-responsive my-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th id="header-id" class="sortable" style="cursor: pointer;">#Orden</th>
                        <th id="header-usuario" class="sortable" style="cursor: pointer;">Cliente</th>
                        <th id="header-empleado" class="sortable" style="cursor: pointer;">Empleado</th>
                        <th id="header-fecha-pedido" class="sortable" style="cursor: pointer;">Fecha de Orden</th>
                        <th id="header-fecha-entrega" class="sortable" style="cursor: pointer;">Fecha de Entrega</th>
                        <th>Descripción</th>
                        <th id="header-estado" class="sortable" style="cursor: pointer;">Estado</th>
                        <th id="header-total" class="sortable" style="cursor: pointer;">Total</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente->persona->nombre }}</td>
                            <td>{{ $pedido->empleado->persona->nombre }}</td>
                            <td>{{ $pedido->fecha_pedido }}</td>
                            <td>{{ $pedido->fecha_entrega }}</td>
                            <td>{{ $pedido->descripcion }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>${{ number_format($pedido->total, 2) }}</td>
                            <td><a href="{{ route('pedidos.show', ['id' => $pedido->id]) }}" class="text-decoration-none"><i class="bi bi-eye"></i> Ver Pedido</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
<!-- Modal Crear Pedido -->
<div class="modal fade" id="createOrderModal" tabindex="-1" aria-labelledby="createOrderModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOrderModalLabel">Crear Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Información del Pedido -->
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select name="cliente" id="cliente" class="form-control select2" required>
                            <option value="">Seleccione un Cliente</option>
                            @foreach($estadisticas['clientes'] as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->persona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <select name="empleado" id="empleado" class="form-control select2" required>
                            <option value="">Seleccione un Empleado</option>
                            @foreach($estadisticas['empleados'] as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_pedido" class="form-label">Fecha de Pedido</label>
                        <input type="date" class="form-control" id="fecha_pedido" name="fecha_pedido" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    
                    <!-- Detalles de Lotes -->
<div id="lotesSection">
    <h5>Detalles de Lotes</h5>
    <table class="table table-bordered" id="lotesDetailsTable">
        <thead>
            <tr>
                <th>Prenda</th>
                <th>Precio por prenda</th>
                <th>Cantidad</th>
                <th>Anticipo</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="detalles_lote[0][prenda]" class="form-control"></td>
                <td><input type="number" name="detalles_lote[0][precio_por_prenda]" class="form-control" step="0.01" oninput="updateLoteTotal(this)"></td>
                <td><input type="number" name="detalles_lote[0][cantidad]" class="form-control" oninput="updateLoteTotal(this)"></td>
                <td><input type="number" name="detalles_lote[0][anticipo]" class="form-control" step="0.01" oninput="updateLoteTotal(this)"></td>
                <td><input type="number" name="detalles_lote[0][subtotal]" class="form-control" readonly></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'lotesDetailsTable')">Eliminar</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary" onclick="addRow('lotesDetailsTable')">Agregar Lote</button>
</div>

<!-- Sección Detalles de Reparaciones -->
<div id="reparacionesSection" style="display: none;">
    <h5>Detalles de Reparaciones</h5>
    <table class="table table-bordered" id="reparacionesDetailsTable">
        <thead>
            <tr>
                <th>Prenda</th>
                <th>Descripción Problema</th>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="reparacion_prendas[]" class="form-control"></td>
                <td><input type="text" name="reparacion_descripciones[]" class="form-control"></td>
                <td><input type="text" name="reparacion_servicios[]" class="form-control"></td>
                <td><input type="number" name="reparacion_cantidades[]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'reparacionesDetailsTable')">Eliminar</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary" onclick="addRow('reparacionesDetailsTable')">Agregar Reparación</button>
</div>

<!-- Sección Detalles de Confecciones -->
<div id="confeccionesSection" style="display: none;">
    <h5>Detalles de Confecciones</h5>
    <table class="table table-bordered" id="confeccionesDetailsTable">
        <thead>
            <tr>
                <th>Prenda</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="confeccion_prendas[]" class="form-control"></td>
                <td><input type="number" name="confeccion_cantidades[]" class="form-control" oninput="updateConfeccionTotal(this)"></td>
                <td><input type="number" name="confeccion_subtotales[]" class="form-control" readonly></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
            </tr>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary" onclick="addRow('confeccionesDetailsTable')">Agregar Confección</button>
</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar Pedido</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Función para añadir una nueva fila en una tabla específica
    function addRow(tableId) {
    const table = document.getElementById(tableId);
    const newRow = table.rows[1].cloneNode(true); // Clona la segunda fila (primera fila de datos)
    const rowIndex = table.rows.length - 1; // Índice de la nueva fila basado en el número total de filas

    // Actualiza los nombres de los inputs para reflejar el nuevo índice
    newRow.querySelectorAll('input').forEach(input => {
        if (input.name) {
            input.name = input.name.replace(/\[\d+\]/, `[${rowIndex}]`); // Sustituye el índice con el nuevo
        }
        input.value = ''; // Limpia los valores de los inputs
    });

    // Agrega la nueva fila al tbody
    table.querySelector('tbody').appendChild(newRow);
}



    // Función para eliminar una fila específica
    function removeRow(button, tableId) {
        const table = document.getElementById(tableId);
        if (table.rows.length > 2) { // Asegúrate de que no quede solo el encabezado
            const row = button.closest('tr');
            row.remove();
        }
    }

    // Funciones para actualizar los totales en las filas de lotes y confecciones
    function updateLoteTotal(input) {
        const row = input.closest('tr');
        const cantidad = parseFloat(row.querySelector('input[name$="[cantidad]"]').value) || 0;
        const precio = parseFloat(row.querySelector('input[name$="[precio_por_prenda]"]').value) || 0;
        const anticipo = parseFloat(row.querySelector('input[name$="[anticipo]"]').value) || 0;
        const subtotal = row.querySelector('input[name$="[subtotal]"]');
        subtotal.value = ((cantidad * precio) - anticipo).toFixed(2);
    }

    function updateConfeccionTotal(input) {
        const row = input.closest('tr');
        const cantidad = parseFloat(row.querySelector('input[name$="[cantidad]"]').value) || 0;
        const subtotal = row.querySelector('input[name$="[subtotal]"]');
        subtotal.value = (cantidad * 1).toFixed(2); // Suponiendo que el precio por unidad es 1
    }
</script>

<script>
    // Función para mostrar u ocultar secciones según el tipo de pedido
    function setOrderType(type) {
        document.getElementById('lotesSection').style.display = type === 'lote' ? 'block' : 'none';
        document.getElementById('reparacionesSection').style.display = type === 'reparacion' ? 'block' : 'none';
        document.getElementById('confeccionesSection').style.display = type === 'confeccion' ? 'block' : 'none';
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const headers = document.querySelectorAll('.sortable'); // Obtener todos los encabezados con la clase "sortable"
        const table = document.querySelector('table');
        const tbody = table.querySelector('tbody');
    
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const index = Array.from(header.parentNode.children).indexOf(header); // Obtener el índice de la columna
                ordenarTabla(index);
            });
        });
    
        let ordenAscendente = true; // Variable de estado para alternar entre mayor y menor
    
        function ordenarTabla(indice) {
            const filas = Array.from(tbody.rows);
            const esNumerico = indice === 0 || indice === 7; // Índices de las columnas numéricas: ID (0) y Total (7)
    
            filas.sort(function(a, b) {
                const celdaA = a.cells[indice].textContent.trim();
                const celdaB = b.cells[indice].textContent.trim();
    
                if (esNumerico) {
                    // Ordenar numéricamente (de mayor a menor o de menor a mayor)
                    return ordenAscendente ? parseFloat(celdaA.replace('$', '').replace(',', '')) - parseFloat(celdaB.replace('$', '').replace(',', '')) : parseFloat(celdaB.replace('$', '').replace(',', '')) - parseFloat(celdaA.replace('$', '').replace(',', ''));
                } else {
                    // Ordenar alfabéticamente
                    return ordenAscendente ? celdaA.localeCompare(celdaB) : celdaB.localeCompare(celdaA);
                }
            });
    
            // Alternar el estado de ordenación
            ordenAscendente = !ordenAscendente;
    
            // Añadir las filas ordenadas nuevamente al tbody
            filas.forEach(function(fila) {
                tbody.appendChild(fila);
            });
        }
    });
    </script>
    
<script>
    // Función para añadir una nueva fila en una tabla específica
    function addRow(tableId) {
        const table = document.getElementById(tableId);
        const newRow = table.rows[0].cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        table.appendChild(newRow);
    }

    // Función para eliminar una fila específica
    function removeRow(button, tableId) {
        const table = document.getElementById(tableId);
        if (table.rows.length > 1) {
            const row = button.closest('tr');
            row.remove();
        }
    }

    // Funciones para actualizar los totales en las filas de lotes y confecciones
    function updateLoteTotal(input) {
        const row = input.closest('tr');
        const cantidad = row.querySelector('input[name="detalles_lote[0][cantidad]"]').value;
        const precio = row.querySelector('input[name="detalles_lote[0][precio_por_prenda]"]').value;
        const anticipo = row.querySelector('input[name="detalles_lote[0][anticipo]"]').value;
        const subtotal = row.querySelector('input[name="detalles_lote[0][subtotal]"]');
        subtotal.value = ((cantidad * precio)-anticipo).toFixed(2);
    }

    function updateConfeccionTotal(input) {
        const row = input.closest('tr');
        const cantidad = row.querySelector('input[name="confeccion_cantidades[]"]').value;
        const subtotal = row.querySelector('input[name="confeccion_subtotales[]"]');
        subtotal.value = (cantidad * 1).toFixed(2);
    }
@endsection 
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle con Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
