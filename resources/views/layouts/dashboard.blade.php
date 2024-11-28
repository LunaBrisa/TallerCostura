<!-- resources/views/layouts/nav.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Gestión de Clientes')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <style>
        :root {
            --navbar-bg-color: black;
            --navbar-text-color: white;
            --btn-bg-color: pink; 
            --btn-text-color: black;
            --btn-hover-bg-color: lightpink;
        }

        .navbar {
            background-color: var(--navbar-bg-color);
        }

        .navbar .navbar-brand {
            color: var(--navbar-text-color);
            font-size: 1.5rem;
            font-weight: bold;
        }

        .dashboard-btn {
            background-color: var(--btn-bg-color);
            color: var(--btn-text-color);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .dashboard-btn:hover {
            background-color: var(--btn-hover-bg-color);
        }

        .dashboard-btn .icon {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-text {
            color: var(--navbar-text-color);
            font-weight: 600;
            font-size: 1.2rem;
            text-align: center;
            flex-grow: 1; 
        }

        .navbar-collapse {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="155" height="85" alt="Logo">

            <div class="navbar-text">
                @yield('dashboard_name', 'Dashboard') 
            </div>

            <div class="navbar-collapse">
                <a class="dashboard-btn" href="{{ url('/dashboard') }}">
                    <span class="icon">&#x2190;</span>
                    Regresar al Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
