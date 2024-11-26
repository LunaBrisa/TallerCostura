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
        <!-- Modal AGREGAR PRENDA -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
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

                        <label for="precio_obra_prendita"><h3 class="h3-modal">Precio de la Prenda</h3></label>
                        <input type="number" class="form-control" name="precio_obra_prendita" placeholder="$"><br>

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

                        <label for="colorprendita"><h3 class="h3-modal">Color de la Prenda</h3></label>
                        <select name="colorprendita" class="form-select" aria-label="Default select example">
                          <option selected>Seleccionar el Color de la Prenda</option>
                          @foreach ($misColores as $color)
                            <option value="{{$color->id}}">{{$color->color}}</option>
                          @endforeach
                        </select><br>

                        <label for="telitas"><h3 class="h3-modal">Tela Base de la Prenda</h3></label>
                        <select name="telitas" class="form-select" aria-label="Default select example">
                          <option selected>Seleccionar la Tela Base de la Prenda</option>
                          @foreach ($misTelas as $tela)
                              <option value="{{$tela -> id}}">{{$tela->nombre_tela}}</option>
                          @endforeach
                        </select><br>

                        <label for="cantidadsitadetela"><h3 class="h3-modal">Metros la Tela</h3></label>
                        <input type="number" class="form-control" name="cantidadsitadetela" placeholder="0"><br>

                        <div class="mb-3">
                          <label for="imagencita" class="form-label"><h3 class="h3-modal">Imagen de la Prenda</h3></label>
                          <input class="form-control" type="file" id="imagencita">
                        </div>

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
    <ul class="nav nav-pills nav-fill mb-2" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="visibles-tab" data-bs-toggle="tab" href="#visibles" role="tab" aria-controls="visibles" aria-selected="true">Visibles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="ocultos-tab" data-bs-toggle="tab" href="#ocultos" role="tab" aria-controls="ocultos" aria-selected="false">Ocultos</a>
      </li>
    </ul>
    
    <div class="tab-content">
      <div class="tab-pane fade show active" id="visibles" role="tabpanel" aria-labelledby="visibles-tab">
        {{-- PRENDAS VISIBLES --}}
        <div class="row">
        @foreach ($misPrendas as $prenda)
        <div class="card cardsing mb-4 mx-2" style="width: 18rem;">
          <div class="img-div">
            <img src="{{ asset($prenda -> ruta_imagen) }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{$prenda -> nombre_prenda}}</h5>
            <p class="card-text p-card">{{$prenda -> descripcion}}</p>
            <!-- Button trigger modal -->
            <div class="btn-div2">
              <button type="button" class="btn btn-intemodal " data-bs-toggle="modal" data-bs-target="#exampleModalvermas{{$prenda -> id}}">
                Ver Mas
              </button>
    
              <a href="/ocultar/prenda/{{$prenda -> id}}"><button class="btn btn-intemodal">Ocultar</button></a>
            </div>
    
            <!-- Modal -->
            <div class="modal fade modal-prendas" id="exampleModalvermas{{$prenda -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
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
    
                        <label for="colorprenda"><h3 class="h3-modal">Colores Disponibles de la Prenda</h3></label>
                        @foreach ($prenda -> prendasColor as $color)
                          <input style="background-color: {{ $color->color }}" title="{{ $color->color }}" readonly><br><br>
                        @endforeach        
    
                        <div class="row">
                          <div class="col">
                            <label for="telotas"><h3 class="h3-modal">Telas de la Prenda</h3></label>
                            @foreach ($prenda -> prendasTelas as $tela)
                              <input type="text" class="form-control" name="telotas" placeholder="{{$tela -> tela->nombre_tela}}" readonly><br>
                            @endforeach
                          </div>
    
                          <div class="col">
                            <label for="cantidadsota"><h3 class="h3-modal">Metros de la Tela</h3></label>
                            @foreach ($prenda -> prendasTelas as $tela)
                              <input type="number" class="form-control" name="cantidadsota" placeholder="{{$tela -> cantidad_tela}}" readonly><br>
                            @endforeach
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row mb-3" style="text-align: center; margin: auto">
                      <div class="col mb-3">
                        <a href="/modificar/prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar datos de Prenda</button></a>
                      </div>
                      <div class="col mb-3">
                        <a href="/modificar/telas-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar Telas</button></a>
                      </div>
                    </div><br>
                    <div class="row" style="margin: auto">
                      <div class="col mb-3">
                        <a href="/modificar/colores-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar Colores</button></a>
                      </div>
                      <div class="col mb-3">
                        <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal" style="width: 200px !important">Cerrar</button>
                      </div>
                    </div><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach    
        </div>
      </div>
      {{-- PRENDAS OCULTAS --}}
      <div class="tab-pane fade" id="ocultos" role="tabpanel" aria-labelledby="ocultos-tab">
        <div class="row">
          @foreach ($misPrendasOcultas as $prenda)
          <div class="card cardsing mb-4 mx-2" style="width: 18rem;">
            <div class="img-div">
              <img src="{{ asset($prenda -> ruta_imagen) }}" class="card-img-top" alt="...">
            </div>
            <div class="card-body">
              <h5 class="card-title">{{$prenda -> nombre_prenda}}</h5>
              <p class="card-text p-card">{{$prenda -> descripcion}}</p>
              <!-- Button trigger modal -->
              <div class="btn-div2">
                <button type="button" class="btn btn-intemodal" data-bs-toggle="modal" data-bs-target="#exampleModalvermas{{$prenda -> id}}">
                  Ver Mas
                </button>
      
                <a href="/ocultar/prenda/{{$prenda -> id}}"><button class="btn btn-intemodal">Ocultar</button></a>
              </div>
      
              <!-- Modal -->
              <div class="modal fade modal-prendas" id="exampleModalvermas{{$prenda -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
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
      
                          <label for="colorprenda"><h3 class="h3-modal">Colores Disponibles de la Prenda</h3></label>
                          @foreach ($prenda -> prendasColor as $color)
                            <input style="background-color: {{ $color->color }}" title="{{ $color->color }}" readonly><br><br>
                          @endforeach        
      
                          <div class="row">
                            <div class="col">
                              <label for="telotas"><h3 class="h3-modal">Telas de la Prenda</h3></label>
                              @foreach ($prenda -> prendasTelas as $tela)
                                <input type="text" class="form-control" name="telotas" placeholder="{{$tela -> tela->nombre_tela}}" readonly><br>
                              @endforeach
                            </div>
      
                            <div class="col">
                              <label for="cantidadsota"><h3 class="h3-modal">Metros de la Tela</h3></label>
                              @foreach ($prenda -> prendasTelas as $tela)
                                <input type="number" class="form-control" name="cantidadsota" placeholder="{{$tela -> cantidad_tela}}" readonly><br>
                              @endforeach
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="row mb-3" style="text-align: center; margin: auto">
                        <div class="col mb-3">
                          <a href="/modificar/prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar datos de Prenda</button></a>
                        </div>
                        <div class="col mb-3">
                          <a href="/modificar/telas-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar Telas</button></a>
                        </div>
                      </div><br>
                      <div class="row" style="margin: auto">
                        <div class="col mb-3">
                          <a href="/modificar/colores-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 200px !important">Gestionar Colores</button></a>
                        </div>
                        <div class="col mb-3">
                          <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal" style="width: 200px !important">Cerrar</button>
                        </div>
                      </div><br>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach    
          </div>  
      </div>
    </div>
    
  </div>

</div>
@endsection
</body>
<style>
.nav-pills .nav-link.active {
  background-color: #8A226F !important;
  color: #F6B2DB !important;
}

.nav-pills .nav-link {
  background-color: #f8f9fa; /* Color de los tabs inactivos */
  color: #8A226F;            /* Color del texto de los tabs inactivos */
}
.nav-pills .nav-link:hover {
  background-color: #bc2e96; /* Color al pasar el mouse por encima */
  color: #F6B2DB;
}

.tamal {
  width: 100px;
}

.btn-intemodal {
    display: inline-block; /* Asegura que se alineen uno al lado del otro */
    width: 100px !important;
    height: 45px !important;
    margin: 5px !important; /* Espaciado uniforme entre botones */
    padding: 5px 10px !important;
    background-color: #8A226F;
    border: 2px solid #FFCDD4;
    color: #FFCDD4;
    text-align: center;
    font-size: 14px;
    border-radius: 5px;
    white-space: nowrap; /* Evita que el texto se corte */
}

.modal-footer .btn-intemodal:hover {
    background-color: #FFCDD4;
    border-color: #8A226F;
    color: #8A226F;
}

/* @media (min-width: 576px) {
  .btn-intemodal {
    width: auto;
    min-width: 150px;
    max-width: 200px;
  }
} */


</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
