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
            background-color: #ffffff;
            font-family: 'Arial', sans-serif;
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
            font-size: 1.2rem;
        }
    
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 20px;
            min-width: 150px;
            height: 70px;
            word-wrap: break-word;
            white-space: normal;
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
    
        /* Estilo para el formulario de filtros */
        .filter-bar {
            margin-bottom: 30px;
        }
    
        .filter-bar .form-label {
            font-weight: bold;
        }
    
        .filter-bar .form-control {
            margin-bottom: 10px;
        }
    
        .filter-bar .btn-group {
            margin-top: 10px;
        }
    
        .filter-bar button {
            width: 100%;
            margin-bottom: 10px;
        }
    
        /* Colores para los filtros */
        .filter-bar .form-control {
            background-color: #f7f7f7;
            border: 1px solid #e0e0e0;
        }
    
        .filter-bar .btn-outline-primary {
            color: #ffffff;
            background-color: #f68585;
            border-color: #f5b8b8;
        }
    
        .filter-bar .btn-outline-primary:hover {
            background-color: #f5b8b8;
            border-color: #f5b8b8;
        }
    
        /* Estilo para el botón "Aplicar Filtros" */
        .custom-btn {
            background-color: #f89494;
            border: 1px solid #f5b8b8;
            color: white;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
    
        .custom-btn:hover {
            background-color: #e28e8e;
            border-color: #e28e8e;
            cursor: pointer;
        }
    
        .custom-btn:focus {
            outline: none;
            box-shadow: 0 0 0 0.25rem rgba(255, 105, 105, 0.5);
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
                
                <!-- Barra de filtros -->
                <div class="filter-bar">
                    <form method="GET" action="{{ route('Auditorias.Auditorias') }}" class="d-flex flex-column gap-3">
                        <!-- Filtros por rango de fechas -->
                        <div class="d-flex gap-3">
                            <div class="flex-fill">
                                <label for="start_date" class="form-label">Fecha Inicio:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>
                            <div class="flex-fill">
                                <label for="end_date" class="form-label">Fecha Fin:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>
                        </div>

                        <!-- Filtro por usuario -->
                        <div>
                            <label for="usuario" class="form-label">Usuario Responsable:</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Buscar por usuario..." value="{{ request('usuario') }}">
                        </div>
                
                        <!-- Botones de filtros rápidos -->
                        <div>
                            <label class="form-label">Filtros rápidos:</label>
                            <div class="btn-group d-flex gap-2 flex-wrap">
                                <button type="submit" name="quick_filter" value="today" class="btn btn-outline-primary w-100">Hoy</button>
                                <button type="submit" name="quick_filter" value="last_7_days" class="btn btn-outline-primary w-100">Últimos 7 días</button>
                                <button type="submit" name="quick_filter" value="last_30_days" class="btn btn-outline-primary w-100">Últimos 30 días</button>
                            </div>
                        </div>
                    <!-- Botón de aplicar filtros -->
                            <div>
                              <button type="submit" class="btn custom-btn w-100">Aplicar Filtros</button>
                            </div>
                        </form>
                </div>
                
                <!-- Tabla de auditorías -->
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
