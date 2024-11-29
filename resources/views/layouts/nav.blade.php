<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Taller Costura</title> 
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a href="/"> <img src="{{ asset('images/logo.png') }}" width="155" height="85"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: black; opacity: 90%;">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color:antiquewhite">BIENVENID@!!!!!!!</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="order-1 order-lg-3 mb-3 mb-lg-0 d-flex align-items-center" style="color: aliceblue">
                  <a href="{{ route('informacion.consultarUsuario') }}" class="d-flex align-items-center text-decoration-none" style="color: inherit;">
                    <img src="{{ asset('images/usuario.png') }}" width="30" height="30" class="rounded-circle" alt="Usuario">
                      @if(auth()->check())
                        {{ auth()->user()->name }}                  
                      @endif
                  </a> 
                </div>
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                    @endif
                </ul>

            </div>
          </div>
        </div>
      </nav>

    <div>
        @yield('content')
    </div>
    
    <div class="footer">
       <div style="margin-left: 50px"> 
        <img src="{{ asset('images/telefono.jpg') }}" width="30px" height="30px">
        Telefono: +528 715 627 999
        <img src="{{ asset('images/email.jpg') }}" width="30px" height="30px">
        Correo: fatimacastcanelo756@gmail.com
      <p style="font-size: 20px; font-family: 'Bodoni Moda'; text-align:end; margin-right: 50px;">
        Taller Costura 2022</p></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<style>
       body {
        padding-top: 100px;
    }
   .navbar {
       background-color: black;
       font-family: 'Bodoni Moda';
       
   }

   .navbar a {
       color: white;
   }

   .navbar a:hover {
    color:antiquewhite
   }

   .navbar-toggler-icon {
       filter: invert(1);
   }
   .nav-link{
    color: #000;
    position: relative;
    font-weight: 500;
   }
   .nav-link::before {
       content: "";
       position: absolute;
       width: 0;
       height: 2px;
       bottom: 0;
       left: 50%;
       background-color: #BE5A8C;
       visibility: hidden;
       transform: translateX(-50%);
       transition: 0.3s ease-in-out ;
   }
   .nav-link:hover::before{
       visibility: visible;
       width: 100%;
   }
    .btn-close {
        filter: invert(1)
        background-color: transparent; 
    }

    .btn-close:hover {
        filter: invert(0.8); 
    }
   .footer {
       height: 90px;
       background-color: black;
       color: white;
       font-size: 20px;
       font-family: 'Bodoni Moda';
   } 
   .order-1 img {
    margin-right: 10px;
    cursor: pointer;
}

</style>
