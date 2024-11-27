@extends('layouts.dashboard')

@section('title', 'Dashboard de Pedidos')
@section('dashboard_name', 'Dashboard de Pedidos')
@section('content')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Número de Pedidos</h5>
                        <p>Total: {{ $estadisticas['totalPedidos'] }}</p>
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
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createOrderModal">Crear Pedido</button>
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
                        <select name="cliente" id="cliente" class="form-control" required>
                            <option value="">Seleccione un Cliente</option>
                            @foreach($estadisticas['clientes'] as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->persona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="empleado" class="form-label">Empleado</label>
                        <select name="empleado" id="empleado" class="form-control" required>
                            <option value="">Seleccione un Empleado</option>
                            @foreach($estadisticas['empleados'] as $empleado)
                                <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre  }}</option>
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
                    
                    <!-- Sección Detalles de Lotes -->
                    <h5>Detalles de Lotes</h5>
                    <table class="table table-bordered">
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
                        <tbody id="lotesDetailsTable">
                            <tr>
                                <td><input type="text" name="detalles_lote[0][prenda]" class="form-control" ></td>
                                <td><input type="number" name="detalles_lote[0][precio_por_prenda]" class="form-control" step="0.01"  oninput="updateLoteTotal(this)"></td>
                                <td><input type="number" name="detalles_lote[0][cantidad]" class="form-control" oninput="updateLoteTotal(this)"></td>
                                <td><input type="number" name="detalles_lote[0][anticipo]" class="form-control" step="0.01"  oninput="updateLoteTotal(this)"></td>
                                <td><input type="number" name="detalles_lote[0][subtotal]" class="form-control" readonly></td>
                                <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'lotesDetailsTable')">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary" onclick="addRow('lotesDetailsTable')">Agregar Lote</button>

                    <!-- Sección Detalles de Reparaciones -->
                    <h5>Detalles de Reparaciones</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Prenda</th>
                                <th>Descripción Problema</th>
                                <th>Servicio</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="reparacionesDetailsTable">
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

                    <!-- Sección Detalles de Confecciones -->
                    <h5>Detalles de Confecciones</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Prenda</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="confeccionesDetailsTable">
                            <tr>
                                <td><input type="text" name="confeccion_prendas[]" class="form-control" ></td>
                                <td><input type="number" name="confeccion_cantidades[]" class="form-control"oninput="updateConfeccionTotal(this)"></td>
                                <td><input type="number" name="confeccion_subtotales[]" class="form-control" readonly></td>
                                <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-secondary" onclick="addRow('confeccionesDetailsTable')">Agregar Confección</button>
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