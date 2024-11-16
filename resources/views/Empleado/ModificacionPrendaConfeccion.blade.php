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
                  <option selected>Seleccionar el Tipo de Prenda</option>
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
                  </div><br><br>

                  <div class="row">
                    <div class="col">
                      <input type="submit" class="btn btn-modal-sub" value="Guardar">
                    </div>
                  </div>
            </form><br>
            <a href="/gestion/prenda-confeccion"><button class="btn btn-modal-sub">Cancelar</button></a><br>
        </div>
    </div>
  </div>
</div><br>

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
