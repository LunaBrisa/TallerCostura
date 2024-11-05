<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Gestion Catalogo</title> 
</head>
<body>
    <nav class="navbar">
    <div class="container" >
        <img src="{{ asset('images/logo.png') }}" width="155" height="85">
        <a class="navbar-brand" href="#">Taller Costura</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav><br>

<div class="container2">
<h1 class="Titulo1">Gestion del Catalogo</h1>
    <div class="row" style="padding-top: 20px;">
        <!-- GESTION DE PRENDAS -->
        <div class="col">
            <div class="cuadradito">
                <h1 class="Titulo2">Prendas</h1>

                <div class="btn-div">
                <a href="/gestion/prenda-confeccion"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                </div>

            </div>
        </div>

        <!-- GESTION DE TELAS -->
        <div class="col">
            <div class="cuadradito">
                <h1 class="Titulo2">Telas</h1>

                <div class="btn-div">
                <a href="/gestion/tela"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding-top: 20px;">
        <!-- GESTION DE TIPOS DE PRENDA -->
        <div class="col">
            <div class="cuadradito">
            <h1 class="Titulo2">Tipos de Prenda</h1>

                <div class="btn-div">
                    <a href="/gestion/tipos-prendas"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="cuadradito">
            <h1 class="Titulo2">Tipos de Tela</h1>

            <div class="btn-div">
                <a href="/gestion/tipos-telas"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="padding-top: 20px;">
        <div class="col">
            <div class="cuadradito-solo">
            <h1 class="Titulo2">Colores</h1>

            <div class="btn-div">
                <button class="btn btn-gest" data-bs-toggle="modal" data-bs-target="#exampleModal"> <p class="p-btn">Agregar Nuevo</p> </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form action="/agg/color" method="post">
                            @csrf
                            <label for="colorsito"><h3 class="h3-modal">Color</h3></label>
                            <input type="text" name="colorsito" class="form-control"><br>
                            <div class="btn-div">
                                <input type="submit" class="btn btn-modal-sub" value="Guardar">
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            </div>
        </div>

    </div>
</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
<style>
   .navbar {
        background-color: black;
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
</style>
