@extends('layouts.dashboard')
@section('title', 'Dashboard de Pedidos')
@section('dashboard_name', 'Dashboard de Pedidos')
@section('content')
<style>
    /* Estilo general */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        color: #333;
    }

    /* Botones */
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: bold;
        transition: 0.3s ease-in-out;
        color: #fff; /* Texto blanco para contraste */
    }

    /* Botones pastel */
    .btn-primary {
        background-color: #dc6381;
        border-color: #d47b8c;
    }

    .btn-primary:hover {
        background-color: #dc6381;
        border-color: #d47b8c;
        transform: translateY(-2px);
    }

<<<<<<< HEAD
/* Fondo de página */
body {
    background-color: #f5f5f5;
    color: #333;
}
<style>
    /* Tus estilos actuales */

</style>

    </style>
=======
    .btn-success {
        background-color: #dc6381;
        border-color: #d47b8c;
    }

    .btn-success:hover {
        background-color: #dc6381;
        border-color: #d47b8c;
        transform: translateY(-2px);
    }

    .btn-warning {
        background-color: #dc6381;
        border-color: #d47b8c;
       
    }

    .btn-warning:hover {
        background-color: #dc6381;
        border-color: #d47b8c;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #dc6381;
        border-color: #d47b8c;
        transform: translateY(-2px);
    }

    .btn-secondary:hover {
        background-color: #dc6381;
        border-color: #d47b8c;
        transform: translateY(-2px);
    }

    /* Botón centrado */
    button.btn {
        display: block;
        width: 100%; /* Ajustar ancho según lo necesario */
        margin-bottom: 15px;
    }
    .card {
       border-radius: 15px;
       box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
       background-color: #f9f4f4;
    }

    /* Otros elementos visuales */
    .card-title {
        color: #6c757d;
        font-weight: bold;
    }
>>>>>>> 51c56f78b371845e08e503a1345fe618db601af4
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
                        <h5 class="card-title">Pedidos Del Mes</h5>
                        <p>Pendientes: {{ $estadisticas['pedidosEnProceso'] }}</p>
                        <p>Completados: {{ $estadisticas['pedidosCompletados'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos Del Mes</h5>
                        <p>Total: ${{ number_format($estadisticas['totalIngresos'], 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="buscar" style="margin-top: 30px; padding: 20px;">
            <form method="GET" action="{{ route('pedidos.index') }}">
                <div class="form-group">
                    <label for="orden">Buscar por Orden</label>
                    <input type="text" id="orden" class="form-control" name="orden" placeholder="Buscar por Orden" value="{{ request()->input('orden') }}">
                    <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                </div>
                <div class="form-group">
                    <label for="cliente">Buscar por Cliente</label>
                    <input type="text" id="cliente" class="form-control" name="cliente" placeholder="Buscar por Cliente" value="{{ request()->input('cliente') }}">
                    <button type="submit" class="btn btn-primary mt-2">Buscar</button>
                </div>
            </form>
        </div>
        
        <div class="d-flex mb-4">
            <button type="button" class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#loteModal">
                Crear Pedido de Lotes
            </button>
            <button type="button" class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#reparacionModal">
                Crear Pedido de Reparaciones
            </button>
            <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#confeccionModal">
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
        <!-- Modal para Crear Pedido de Lotes -->
<div class="modal fade" id="loteModal" tabindex="-1" aria-labelledby="loteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loteModalLabel">Crear Pedido de Lotes</h5>
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
                                    <td><input type="number" name="detalles_lote[0][anticipo]" class="form-control" oninput="updateLoteTotal(this)" readonly></td>
                                    <td><input type="number" name="detalles_lote[0][subtotal]" class="form-control" readonly></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'lotesDetailsTable')">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary" onclick="addRow('lotesDetailsTable', loteRowTemplate);">Agregar Lote</button>
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
<!-- Modal para Crear Pedido de Reparaciones -->
<div class="modal fade" id="reparacionModal" tabindex="-1" aria-labelledby="reparacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reparacionModalLabel">Crear Pedido de Reparaciones</h5>
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
                    <!-- Detalles de Reparaciones -->
                    <div id="reparacionesSection">
                        <h5>Detalles de Reparaciones</h5>
                        <table class="table table-bordered" id="reparacionesDetailsTable">
                            <thead>
                                <tr>
                                    <th>Prenda</th>
                                    <th>Cantidad</th>
                                    <th>Descripción Problema</th>
                                    <th>Servicio</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="detalles_reparaciones[0][prenda]" class="form-control"></td>
                                    <td><input type="number" name="detalles_reparaciones[0][cantidad]" class="form-control" onchange="updateSubtotal(this)"></td>
                                    <td><input type="text" name="detalles_reparaciones[0][descripcion_problema]" class="form-control"></td>
                                    <td>
                                        <select name="detalles_reparaciones[0][servicio]" class="form-control" onchange="updatePrecio(this)" required>
                                            <option value="" disabled selected>Seleccione un servicio...</option>
                                            @foreach ($servicios as $servicio)
                                                <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                                                    {{ $servicio->servicio }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="detalles_reparaciones[0][precio_prenda]" class="form-control" readonly></td>
                                    <td><input type="number" name="detalles_reparaciones[0][subtotal]" class="form-control" readonly></td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'reparacionesDetailsTable')">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary" onclick="addRow('reparacionesDetailsTable', reparacionRowTemplate);">Agregar Reparación</button>
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

<!-- Modal para Crear Pedido de Confecciones -->
<div class="modal fade" id="confeccionModal" tabindex="-1" aria-labelledby="confeccionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confeccionModalLabel">Crear Pedido de Confecciones</h5>
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
                    <!-- Detalles de Confecciones -->
                    <div id="confeccionesSection">
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
// Función para actualizar el precio y el subtotal
function updatePrecio(selectElement) {
    const row = selectElement.closest('tr');
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const precio = selectedOption.dataset.precio || 0;
    
    // Actualiza solo el campo visual del precio_prenda
    row.querySelector('input[name*="[precio_prenda]"]').value = precio;
    
    // Luego calculamos el subtotal basado en el precio y la cantidad
    updateSubtotal(selectElement);
}

// Función para calcular el subtotal
function updateSubtotal(element) {
    const row = element.closest('tr');
    const cantidad = row.querySelector('input[name*="[cantidad]"]').value || 0;
    const precio = row.querySelector('input[name*="[precio_prenda]"]').value || 0;
    const subtotal = cantidad * precio;
    
    // Actualiza solo el subtotal visualmente
    row.querySelector('input[name*="[subtotal]"]').value = subtotal.toFixed(2);
}



    const loteRowTemplate = `
    <td><input type="text" name="detalles_lote[_rowCount_][prenda]" class="form-control"></td>
    <td><input type="number" name="detalles_lote[_rowCount_][precio_por_prenda]" class="form-control" step="0.01" oninput="updateLoteTotal(this)"></td>
    <td><input type="number" name="detalles_lote[_rowCount_][cantidad]" class="form-control" oninput="updateLoteTotal(this)"></td>
    <td><input type="number" name="detalles_lote[_rowCount_][anticipo]" class="form-control" oninput="updateLoteTotal(this)" readonly></td>
    <td><input type="number" name="detalles_lote[_rowCount_][subtotal]" class="form-control" readonly></td>
    <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'lotesDetailsTable')">Eliminar</button></td>
`;

const reparacionRowTemplate = `
    <td><input type="text" name="detalles_reparaciones[_rowCount_][prenda]" class="form-control"></td>
    <td><input type="number" name="detalles_reparaciones[_rowCount_][cantidad]" class="form-control" onchange="updateSubtotal(this)"></td>
    <td><input type="text" name="detalles_reparaciones[_rowCount_][descripcion_problema]" class="form-control"></td>
    <td>
        <select name="detalles_reparaciones[_rowCount_][servicio]" class="form-control" onchange="updatePrecio(this)" required>
            <option value="" disabled selected>Seleccione un servicio...</option>
            @foreach ($servicios as $servicio)
            <option value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">
                {{ $servicio->servicio }}
            </option>
            @endforeach
        </select>
    </td>
    <td><input type="number" name="detalles_reparaciones[_rowCount_][precio_prenda]" class="form-control" readonly></td>
    <td><input type="number" name="detalles_reparaciones[_rowCount_][subtotal]" class="form-control" readonly></td>
    <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'reparacionesDetailsTable')">Eliminar</button></td>
`;


    // Función para añadir una nueva fila en una tabla específica
    function addRow(tableId, rowTemplate) {
    const table = document.getElementById(tableId);
    const rowCount = table.rows.length; // Número de filas existentes
    const newRow = table.insertRow(); // Crear nueva fila
    newRow.innerHTML = rowTemplate.replace(/_rowCount_/g, rowCount); // Reemplaza el marcador
}

function removeRow(button, tableId) {
    const table = document.getElementById(tableId);
    const row = button.closest('tr');
    table.deleteRow(row.rowIndex); // Eliminar la fila seleccionada

    updateRowIndices(table); // Reindexar después de eliminar
}

function updateRowIndices(table) {
    const rows = table.querySelectorAll('tbody tr'); // Seleccionar todas las filas del cuerpo de la tabla
    rows.forEach((row, index) => {
        const inputs = row.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.name; // Obtener el nombre original
            const newName = name.replace(/\[\d+\]/, [${index}]); // Reemplazar el índice actual por el nuevo
            input.name = newName; // Asignar el nuevo nombre
        });
    });
}

    // Funciones para actualizar los totales en las filas de lotes y confecciones
    function updateLoteTotal(input) {
    const row = input.closest('tr');
    const cantidad = parseFloat(row.querySelector('input[name$="[cantidad]"]').value) || 0;
    const precio = parseFloat(row.querySelector('input[name$="[precio_por_prenda]"]').value) || 0;
    const subtotal = cantidad * precio; // Calcular el subtotal

    // Establecer el anticipo como la mitad del subtotal
    const anticipo = (subtotal / 2).toFixed(2);

    // Asignar el anticipo y el subtotal en sus respectivos campos
    row.querySelector('input[name$="[anticipo]"]').value = anticipo;
    row.querySelector('input[name$="[subtotal]"]').value = subtotal.toFixed(2);
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
    // no hice cambios
    </script>
@endsection 
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Bundle con Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

