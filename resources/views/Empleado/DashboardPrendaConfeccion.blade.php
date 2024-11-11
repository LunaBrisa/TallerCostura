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
        <h1 class="Titulo1">Gestion de Prendas</h1>
    </div>

    <div class="col" style="padding-top: 14px;">
        <div class="btn-div">
            <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <p class="p-btn-agg">Agregar Nueva Prenda</p>
            </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <!-- HEADER -->
              <div class="modal-header">
                <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Prenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- BODY -->
              <div class="modal-body">
                <div class="conteform">
                <form action="/agg/prenda-confeccion" method="post">
                        @csrf
                        <label for="nombreprendita"><h3 class="h3-modal">Nombre de la Prenda</h3></label>
                        <input type="text" class="form-control" name="nombreprendita"><br>

                        <label for="descripcionprendita"><h3 class="h3-modal">Descripcion de la Prenda</h3></label>
                        <textarea class="form-control" name="descripcionprendita" rows="3"></textarea><br>

                        <label for="precioprendita"><h3 class="h3-modal">Precio de la Prenda</h3></label>
                        <input type="number" class="form-control" name="precioprendita" placeholder="$"><br>

                        <label for=""><h3 class="h3-modal">Genero de la Prenda</h3></label><br>

                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="generito" id="Hombre" value="Hombre">
                            <label class="form-check-label" for="Hombre"><h2 class="radio-text">Hombre</h2></label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="generito" id="Mujer" value="Mujer">
                            <label class="form-check-label" for="Mujer"><h2 class="radio-text">Mujer</h2></label>
                          </div>
                        <br><br>

                        <label for="tipoprendita"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                        <select name="tipoprendita" class="form-select" aria-label="Default select example">
                          <option selected>Seleccionar el Tipo de Prenda</option>
                          @foreach ($misTiposPrendas as $tipoPrenda)
                            <option value="{{$tipoPrenda->id}}">{{$tipoPrenda->tipo_prenda}}</option>
                          @endforeach
                        </select><br>

                        <label for="imagencita"><h3 class="h3-modal">Imagen de la Prenda</h3></label>
                        <input type="file" name="imagencita" class="form-control-file">
                        <br><br>

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
    @foreach ($misPrendas as $prenda)
    <div class="card cardsing mb-4 mx-2" style="width: 18rem;">
      <div class="img-div">
        <img src="{{ asset($prenda->ruta_imagen) }}" class="card-img-top" alt="...">
      </div>
      <div class="card-body">
        <h5 class="card-title">{{$prenda -> nombre_prenda}}</h5>
        <p class="card-text p-card">{{$prenda -> descripcion}}</p>
        <!-- Button trigger modal -->
        <div class="btn-div2">
          <button type="button" class="btn btn-intemodal" data-bs-toggle="modal" data-bs-target="#exampleModalvermas{{$prenda -> id}}">
            Ver Mas
          </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalvermas{{$prenda -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Datos de la Prenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="conteform">
                  <form action="">
                    <label for="prenda"><h3 class="h3-modal">Nombre de la Prenda</h3></label>
                    <input type="text" class="form-control" name="prenda" placeholder="{{$prenda -> nombre_prenda}}" readonly><br>

                    <label for="descripcion"> <h3 class="h3-modal">Descripcion de la Prenda</h3></label>
                    <textarea class="form-control" name="descripcion" rows="3" readonly>{{$prenda -> descripcion}}</textarea><br>

                    <div class="row">
                      <div class="col">
                        <label for="precio"><h3 class="h3-modal">Precio de la Prenda</h3></label>
                        <input type="number" class="form-control" name="precio" placeholder="${{$prenda -> precio}}" readonly><br>
                      </div>
                      <div class="col">
                        <label for="genero"><h3 class="h3-modal">Genero de la Prenda</h3></label>
                        <input type="text" class="form-control" name="genero" placeholder="{{$prenda -> genero}}" readonly><br>
                      </div>
                    </div>

                    <label for="tipoprenda"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                    <input type="text" class="form-control" name="tipoprenda" placeholder="{{$prenda -> tipoPrenda->tipo_prenda}}" readonly><br>

                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cerrar</button>
                <a href="/modificar/prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal">Modificar</button></a>
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
