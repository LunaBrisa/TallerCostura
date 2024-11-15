@extends('layouts.dashboard')

@section('title', 'Dashboard de Insumos')
@section('dashboard_name', 'Dashboard de Insumos')
@section('content')
        <div class="row">
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
        <form method="GET" action="{{ route('inventario.index') }}" class="mt-2">
            <div class="d-flex">
                <input type="text" class="form-control" name="insumo" placeholder="Buscar por Nombre..." value="{{ request()->input('insumo') }}">
                <button type="submit" class="btn btn-primary ml-2">Buscar</button>
            </div>
        </form>
        <form action="{{ route('inventario.index') }}" method="GET" class="d-flex">
            <button type="submit" class="btn btn-primary mx-1" name="estado" value="">Ver todos</button>
        </form>
    <div class="table-responsive my-4">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th id="header-id" class="sortable" data-column="id" style="cursor: pointer;">ID Insumo</th>
                    <th id="header-nombre" class="sortable" data-column="nombre" style="cursor: pointer;">Nombre</th>
                    <th id="header-stock" class="sortable" data-column="cantidad_stock" style="cursor: pointer;">Stock</th>
                    <th id="header-precio" class="sortable" data-column="precio_unitario" style="cursor: pointer;">Precio Unitario</th>
                </tr>
            </thead>
            <tbody id="insumo-body">
                @foreach ($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->id }}</td>
                        <td>{{ $insumo->insumo }}</td>
                        <td>{{ $insumo->cantidad_stock }}</td>
                        <td>${{ number_format($insumo->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentSort = { column: null, order: 'asc' };
        
            document.querySelectorAll('.sortable').forEach(header => {
                header.addEventListener('click', function () {
                    const column = header.getAttribute('data-column');
                    const order = currentSort.column === column && currentSort.order === 'asc' ? 'desc' : 'asc';
                    
                    currentSort = { column, order };
                    sortTable(column, order);
                });
            });
        
            function sortTable(column, order) {
                const tbody = document.getElementById('insumo-body');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                
                rows.sort((a, b) => {
                    const cellA = a.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();
                    const cellB = b.querySelector(`td:nth-child(${getColumnIndex(column)})`).textContent.trim();
        
                    const valueA = column === 'precio_unitario' || column === 'cantidad_stock' || column === 'id' ? parseFloat(cellA.replace('$', '').replace(',', '')) : cellA.toLowerCase();
                    const valueB = column === 'precio_unitario' || column === 'cantidad_stock' || column === 'id' ? parseFloat(cellB.replace('$', '').replace(',', '')) : cellB.toLowerCase();
        
                    if (valueA < valueB) return order === 'asc' ? -1 : 1;
                    if (valueA > valueB) return order === 'asc' ? 1 : -1;
                    return 0;
                });
        
                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));
            }
        
            function getColumnIndex(column) {
                switch (column) {
                    case 'id': return 1;
                    case 'nombre': return 2;
                    case 'cantidad_stock': return 3;
                    case 'precio_unitario': return 4;
                    default: return 1;
                }
            }
        });
        </script>
@endsection