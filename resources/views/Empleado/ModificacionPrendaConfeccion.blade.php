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
@extends('layouts.nav')
@section('content')
{{-- MODIFCACION --}}
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="Titulo1">Modificacion de Prenda</h1>
    </div>
  </div>
</div><br>

<div class="containerModif">
  <div class="row">
    <div class="col">
      <h1 class="h1-modif">Ingrese los Datos a Modificar</h1>
    </div>
  </div>

  <div class="row">
    <div class="col">
        <div class="conteform">
            <form action="/modifi/prenda" method="post">
                @csrf
                <input type="hidden" name="idesote" value="{{$misPrendas -> id}}">

                <label for="nombreprendota"><h3 class="h3-modal">Nombre de la Prenda</h3></label>
                <input type="text" class="form-control" name="nombreprendota" placeholder="{{$misPrendas -> nombre_prenda}}"><br>
        
                <label for="descripcionprendota"><h3 class="h3-modal">Descripcion de la Prenda</h3></label>
                <textarea class="form-control" name="descripcionprendota" rows="3" placeholder="{{$misPrendas -> descripcion}}"></textarea><br>

                <label for="precioprendota"><h3 class="h3-modal">Precio de la Prenda</h3></label>
                <input type="number" class="form-control" name="precioprendota" placeholder="${{$misPrendas -> precio}}"><br>

                <label for="tipoprendota"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                <select name="tipoprendota" class="form-select" aria-label="Default select example">
                  <option selected value="{{$misPrendas -> tp_id}}">Seleccionar el Tipo de Prenda</option>
                  @foreach ($misTiposPrendas as $tipoPrenda)
                    <option value="{{$tipoPrenda->id}}">{{$tipoPrenda->tipo_prenda}}</option>
                  @endforeach
                </select><br>
        
                <label for="generote"><h3 class="h3-modal">Genero de la Prenda</h3></label><br>
        
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="generote" id="Hombre" value="Hombre">
                    <label class="form-check-label" for="Hombre"><h2 class="radio-text">Hombre</h2></label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="generote" id="Mujer" value="Mujer">
                    <label class="form-check-label" for="Mujer"><h2 class="radio-text">Mujer</h2></label>
                  </div><br>
                  
                  <label for="imagensotaprenda"><h3 class="h3-modal">Imagen de la Prenda</h3></label>
                  <input class="form-control" type="file" name="imagensotaprenda">

                  <div class="row text-center">
                    <div class="col-12 col-md-6 mb-3">
                      <input type="submit" class="btn btn-modal-sub" value="Guardar">
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                      <a href="/gestion/prenda-confeccion" class="btn btn-modal-sub">Cancelar</a>
                    </div>
                  </div>
                                 
            </form><br>
        </div>
    </div>
  </div>
</div><br>
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
        width: 70% !important ;
    }
}

</style>
