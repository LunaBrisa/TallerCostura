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

@extends('layouts.nav')
@section('content')

<div class="container2">
    <div class="row">
      <div class="col">
        <h1 class="Titulo1">Colores de la Prenda</h1>
      </div>
      <div class="col" style="padding-top: 50px;">
        <div class="btn-div">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Agregar Nuevo Color
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Color a la Prenda</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/agreg/color-prenda" method="post">
                    @csrf
                    <input type="hidden" name="idprenda" value="{{$miPrenda->id}}">
                    
                    <label for="colorprenda"><h3 class="h3-modal">Color de la Prenda</h3></label>
                    <select name="colorprenda" class="form-select" aria-label="Default select example">
                      <option selected>Seleccionar el Color de la Prenda</option>
                      @foreach ($misColores as $color)
                        <option value="{{$color->id}}">"{{$color->color}}"</option>
                      @endforeach
                    </select><br>

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

    <div class="row" style="padding-top: 25px">
            @foreach ($misPrendasColores as $prendaColor)
                    <div class="card mb-4 cardsing">
                        <div class="card-body">
                            <h1 class="list-title">{{$prendaColor->color->color}}</h1> 
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-modal-sub" data-bs-toggle="modal" data-bs-target="#exampleModalElim{{$prendaColor->id}}">
                          Eliminar
                        </button><br>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalElim{{$prendaColor->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Eliminacion de Tela</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ asset('images/warning-sign-icon-transparent-background-free-png.webp') }}">
                                <p class="advert">Advertencia! ¿Estás seguro de que quieres eliminar este color de la prenda?</p>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                                <a href="/elim/color/prenda/{{$prendaColor->id}}" class="btn btn-intemodal">Eliminar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
            @endforeach
    </div>
</div>
@endsection
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
    margin: 5px auto; /* Centra los botones en todos los tamaños */
    display: block; /* Asegura que el botón sea un bloque */
    height: 40px;
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
        height: 40px; /* Ajusta el alto del botón en pantallas pequeñas */
        font-size: 14px; /* Tamaño de fuente menor */
    }
}

 </style>
 