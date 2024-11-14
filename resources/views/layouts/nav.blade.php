<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Taller Costura</title> 
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" width="155" height="85">
            <a class="navbar-brand">Taller Costura</a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" onclick="toggleNavbar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/welcome">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gestion/catalogo">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servicios.index') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    <div class="footer">
        <p>Taller Costura 2022</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function toggleNavbar() {
            const navbarContent = document.getElementById('navbarSupportedContent');
            navbarContent.classList.toggle('show');
        }
    </script>
</body>
</html>

<style>
   .navbar {
       background-color: black;
       font-family: 'Bodoni Moda';
   }

   .navbar a {
       color: white;
   }

   .navbar a:hover {
       color: lightgray;
   }

   .navbar-toggler-icon {
       filter: invert(1);
   }

   .footer {
       bottom: 0;
       left: 0;
       width: 100%;
       height: 50px;
       background-color: black;
       color: white;
       text-align: center;
       font-size: 20px;
       font-family: 'Bodoni Moda';
   } 
</style>
