<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    <title>Inventario</title>
    <style>
    
    :root {
        --main-bg-color: #3490dc;
        --navbar-bg-color: black;
        --navbar-text-color: white;
        --hover-color: lightgray;
    }
    .navbar {
        background-color: var(--navbar-bg-color);
    }
    .navbar a {
        color: var(--navbar-text-color);
    }
    .navbar a:hover {
        color: var(--hover-color);
    }    
</style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="155" height="85">
            <a class="navbar-brand" href="#">Taller Costura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/produccion') }}">Producción</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Insumos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Finanzas</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
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
</body>
</html>