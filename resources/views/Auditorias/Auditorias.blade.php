@extends('layouts.nav')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditorías</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            background-color: #ffffff;
        }
        .card-header {
            background-color: #f5b8b8;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 10px 10px 0 0;
            padding: 15px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 1.2rem; /* Tamaño de fuente más grande */
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 20px; /* Más espacio dentro de las celdas */
            min-width: 150px; /* Ancho mínimo de las columnas */
            height: 70px; /* Aumenta el alto de las filas */
            word-wrap: break-word; /* Permite que el texto se ajuste al ancho de la celda */
            white-space: normal; /* Asegura que el texto se divida en varias líneas si es necesario */
        }
        .table th {
            background-color: #f3d0d0;
            color: #5f5f5f;
            font-weight: bold;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .search-bar input {
            border-radius: 30px;
            padding: 12px;
            border: 1px solid #e6e6e6;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .page-link {
            color: #b09275;
        }
        .page-item.active .page-link {
            background-color: #b09275;
            border-color: #b09275;
        }
        .page-item:hover .page-link {
            background-color: #f2e8d5;
            border-color: #f2e8d5;
        }
    </style>
    
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <strong>Auditorías</strong>
            </div>
            <div class="card-body">
                
                <!-- Barra de búsqueda -->
                <div class="search-bar mb-4">
                    <input type="text" class="form-control" placeholder="Buscar auditorías..." aria-label="Buscar auditorías...">
                </div>
                
                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Usuario</th>
                                <th>Registro Afectado</th>
                                <th>Registro Anterior</th>
                                <th>Última Actualización</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($auditorias as $auditoria)
                                <tr>
                                    <td>{{ $auditoria->accion }}</td>
                                    <td>{{ $auditoria->usuario }}</td>
                                    <td>{{ $auditoria->registro_afectado }}</td>
                                    <td>{{ $auditoria->registro_anterior }}</td>
                                    <td>{{ $auditoria->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection