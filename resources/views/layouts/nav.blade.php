<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">  
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Taller Costura</title> 
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/"> <img src="{{ asset('images/logo.png') }}" width="155" height="85"></a>
            <a class="navbar-brand">Taller Costura</a>
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation" onclick="toggleNavbar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/Cliente/PcatalogoView">Catálogo</a>
                    </li>
                    @if(auth()->check())
                    @if(auth()->user()->hasRole('Cliente'))
                        <li class="nav-item">
                            <a class="nav-link" href="/Cliente/MisPedidos">Mis Pedidos</a>
                        </li>
                    @elseif(auth()->user()->hasRole('Empleado'))
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                    @elseif(auth()->user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="/gestion/catalogo">Gestion del Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                    @endif

                    <!-- Enlace para cerrar sesión -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Cerrar sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <!-- Si el usuario no está autenticado -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
         @endif
                </ul>
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    <div class="footer">
 
       <div style="margin-left: 50px"> <img src="{{ asset('images/llamada.png') }}" width="30px" height="30px">Telefono: +528 715 627 999</div>
       <hr style="border-top: 2px solid rgb(203, 185, 185); margin: 5px 0; width: 40%; margin-left: 30%;">
       <div style="margin-left: 50px"> <img src="{{ asset('images/email.png') }}" width="30px" height="30px">Correo: fatimacastcanelo756@gmail.com</div>
       <div><p style="font-size: 20px; font-family: 'Bodoni Moda'; align-content:flex-start; text-align: center;">
        Taller Costura 2022</p></div>
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
       width: 100%;
       height: 100px;
       background-color: black;
       color: white;
       font-size: 20px;
       font-family: 'Bodoni Moda';
   } 
</style>
