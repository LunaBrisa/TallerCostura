<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Telas de Prenda</title>
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
    <div class="row">
        <div class="col">
            <h1 class="Titulo1">Telas de Prenda</h1>
        </div>
        <div class="col" style="padding-top: 14px;">
            {{-- AGREGAR TELA A PRENDA --}}
            <div class="btn-div">
                <button class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Nueva Tela</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Tela</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/agreg/tela-prenda" method="post">
                        @csrf
                        <input type="hidden" name="idprenda" value="{{$miPrenda->id}}">

                        <label for="telitaprendita"><h3 class="h3-modal">Seleccion de Tela</h3></label>
                        <select name="telitaprendita" class="form-select" aria-label="Default select example">
                          <option selected>Seleccionar Tela</option>
                          @foreach ($misTelas as $tela)
                            <option value="{{$tela->id}}">{{$tela->nombre_tela}}</option>
                          @endforeach
                        </select><br>

                        <label for="cantidadtelitaprenda"><h3 class="h3-modal">Cantidad de Tela</h3></label>
                        <input type="number" class="form-control" name="cantidadtelitaprenda" placeholder="0"><br>

                        <div class="btn-div">
                            <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-intemodal" value="Guardar">
                        </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div><br>
    <div class="row">
            @foreach ($misPrendasTelas as $tela)                                                                                                                   
                <div class="card cardsing mb-4">
                    <div class="card-body">
                        <h1 class="list-title">{{$tela-> tela->nombre_tela}}</h1>
                        <h1 class="card-det">Metros: {{$tela->cantidad_tela}}</h1><br>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-modal-sub" data-bs-toggle="modal" data-bs-target="#exampleModalElim{{$tela->id}}">
                            Eliminar
                          </button><br>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModalElim{{$tela->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Eliminacion de Tela</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <img src="{{ asset('images/warning-sign-icon-transparent-background-free-png.webp') }}">
                                  <p class="advert">Advertencia! ¿Estás seguro de que quieres eliminar esta tela de la prenda?</p>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                                  <a href="/elim/tela/prenda/{{$tela->id}}" class="btn btn-intemodal">Eliminar</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                        <!-- Button trigger modal CAMBIAR CANTIDAD -->
                        <button type="button" class="btn btn-modal-sub" data-bs-toggle="modal" data-bs-target="#exampleModalModif{{$tela->id}}">
                            Cambiar Metros
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModalModif{{$tela->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Modificacion de Metros de la Tela</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/modif/cantidad-tela" method="post">
                                        @csrf
                                        <input type="hidden" name="idtela" value="{{$tela->id}}">

                                        <label for="cantidadsota"><h3 class="h3-modal">Metros de la Tela</h3></label>
                                        <input type="number" class="form-control" name="cantidadsota" placeholder="{{$tela -> cantidad_tela}}"><br>
                                        <div class="btn-div">
                                          <input type="submit" class="btn btn-intemodal" value="Guardar">
                                          <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
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

     .btn-modal-sub {
    margin: 10px auto; /* Centra los botones en todos los tamaños */
    display: block; /* Asegura que el botón sea un bloque */
    height: 50px;
    max-width: 300px; /* Tamaño máximo del botón */
    width: 100%; /* Ocupa todo el espacio posible */
    background-color: #BE5A8C;
    border: solid 2px;
    border-color: #F99AAA;
    color: #FFCDD4;
    text-align: center;
    font-size: 16px; /* Texto visible en todos los tamaños */
    padding: 0;
}

.btn-modal-sub:hover {
    background-color: #F99AAA;
    color: #BE5A8C;
}

@media (max-width: 576px) {
    .btn-modal-sub {
        height: 45px; /* Ajusta el alto del botón en pantallas pequeñas */
        font-size: 14px; /* Tamaño de fuente menor */
        width: 170px !important;
    }
}
 </style>
 