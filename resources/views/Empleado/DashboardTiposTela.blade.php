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
    <div class="row" style="padding-top: 20px;">
        <div class="col">
            <h1 class="Titulo1">Gestion de Tipos de Tela</h1>
        </div>

        <div class="col" style="padding-top: 43px;">
            <div class="btn-div">
                <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <p class="p-btn-agg">Agregar Nuevo Material de Tela</p>
                </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <!-- HEADER -->
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Material de Tela</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- BODY -->
                  <div class="modal-body">
                    <div class="conteform">
                    <form action="/agg/tipotela" method="post">
                            @csrf
                            <label for="tipotelita"><h3 class="h3-modal">Material de Tela</h3></label>
                            <input type="text" name="tipotelita" class="form-control"><br>
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

    <div class="row" style="padding-top: 25px;">
        @foreach ($MisMaterialesTela as $MaterialTelilla)
            <div class="card mb-4 cardsing">
              <div class="card-body">
                <h1 class="list-title">{{$MaterialTelilla->material_tela}}</h1>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-elim" data-bs-toggle="modal" data-bs-target="#ModalElim{{$MaterialTelilla->id_material_tela}}">
                  Eliminar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="ModalElim{{$MaterialTelilla->id_material_tela}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Eliminacion de Tipo de Tela</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h5 class="h3-modal">Esta seguro de que quiere eliminar este tipo de tela? <br> Esta accion
                          eliminara tambien las telas asociadas a este tipo de tela.
                        </h5>
                        <img src="{{ asset('images/warning-sign-icon-transparent-background-free-png.webp') }}" alt="">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                        <a href="/elim/material-tela/{{$MaterialTelilla->id_material_tela}}"><button class="btn btn-intemodal">Eliminar</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
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
