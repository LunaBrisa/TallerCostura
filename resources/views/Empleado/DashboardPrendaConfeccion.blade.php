<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">     <title>Gestion Catalogo</title> 
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
                <form action="/agg/prenda-confeccion" method="post" enctype="multipart/form-data">
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
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="generito" id="Infantil" value="Infantil">
                            <label class="form-check-label" for="Infantil"><h2 class="radio-text">Infantl</h2></label>
                          </div>
                        <br><br>

                        <label for="tipoprendita"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                        <select name="tipoprendita" class="form-select" aria-label="Default select example">
                          <option selected>Seleccionar el Tipo de Prenda</option>
                          @foreach ($misTiposPrendas as $tipoPrenda)
                            <option value="{{$tipoPrenda->id}}">{{$tipoPrenda->tipo_prenda}}</option>
                          @endforeach
                        </select><br>

                        <div class="form-group">
                          <label for="imagencita" class="form-label"><h3 class="h3-modal">Imagen de la Prenda</h3></label>
                          <input class="form-control" type="file" name="ruta_imagen" id="imagencita" accept="image/*" required>
                        </div><br>

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

<div class="row">
  <div class="col">
    @if ($errors->any())                         
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endforeach
    @endif
      
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}                     <!-- AL REGISTRAR UNA PRENDA -->
        </div>
    @endif

    @if (session('successmodif'))
        <div class="alert alert-success" role="alert">
            {{ session('successmodif') }}                <!-- AL MODIFICAR UNA PRENDA -->
        </div>
    @endif

    @if (session('successPrendaTela'))
        <div class="alert alert-success" role="alert">
            {{ session('successPrendaTela') }}           <!-- AL AGREGAR UNA TELA A UNA PRENDA -->
        </div>
    @endif

    @if (session('successCantidadTela'))
        <div class="alert alert-success" role="alert">
            {{ session('successCantidadTela') }}         <!-- AL MODIFICAR LA CANTIDAD DE TELA DE LA PRENDA -->
        </div>
    @endif

    @if (session('successEliminarTela'))
        <div class="alert alert-success" role="alert">
            {{ session('successEliminarTela') }}         <!-- AL ELIMINAR UNA TELA DE LA PRENDA -->
        </div>
    @endif

    @if (session('successColor'))
      <div class="alert alert-success" role="alert">
          {{ session('successColor') }}         <!-- AL AGREGAR COLOR A UNA PRENDA -->
      </div>
    @endif

    @if (session('errorColor'))
        <div class="alert alert-danger" role="alert">
            {{ session('errorColor') }}         <!-- AL AGREGAR COLOR A UNA PRENDA -->
        </div>
    @endif

    @if (session('successEliminarColor'))
      <div class="alert alert-success" role="alert">
          {{ session('successEliminarColor') }}         <!-- AL ELIMINAR COLOR DE UNA PRENDA -->
      </div>
    @endif

    @if (session('successImgColor'))
      <div class="alert alert-success" role="alert">
          {{ session('successImgColor') }}         <!-- AL MODIFICAR COLOR DE UNA PRENDA -->
      </div>
    @endif

    @if (session('errorImgColor'))
    <div class="alert alert-danger" role="alert">
        {{ session('errorImgColor') }}             <!-- AL AGREGAR COLOR A UNA PRENDA -->
    </div>
  @endif

  @if (session('successImgPrenda'))
  <div class="alert alert-success" role="alert">
      {{ session('successImgPrenda') }}         <!-- AL MODIFICAR IMAGEN DE UNA PRENDA -->
    </div>    
  @endif

  @if (session('errorImgPrenda'))
    <div class="alert alert-danger" role="alert">
        {{ session('errorImgPrenda') }}             <!-- AL MODIFICAR IMAGEN A UNA PRENDA -->
    </div>
  @endif
  </div>
</div>

  <div class="row" style="padding-top: 25px;">
      <ul class="nav nav-tabs mb-2 interactive-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="visibles-tab" data-bs-toggle="tab" href="#visibles" role="tab" aria-controls="visibles" aria-selected="true">
            Visibles
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ocultos-tab" data-bs-toggle="tab" href="#ocultos" role="tab" aria-controls="ocultos" aria-selected="false">
            Ocultos
          </a>
        </li>
      </ul>
    </div>
      
    
    <div class="tab-content">
      <div class="tab-pane fade show active" id="visibles" role="tabpanel" aria-labelledby="visibles-tab">
        {{-- PRENDAS VISIBLES --}}
        <div class="row">
          @foreach ($misPrendas as $prenda)
          <div class="card cardsing card-hover mb-4 mx-2" style="width: 18rem;">
              <div class="img-div">
                  <img src="{{ asset($prenda->ruta_imagen) }}" class="card-img-top" alt="...">
              </div>
              <div class="card-body">
                  <h5 class="card-title">{{ $prenda->nombre_prenda }}</h5>
                  <p class="card-text p-card">{{ $prenda->descripcion }}</p>
                  <div class="btn-div2">
                      <button type="button" class="btn btn-intemodal" data-bs-toggle="modal" data-bs-target="#exampleModalvermas{{ $prenda->id }}">Ver Más</button>
                      <a href="/ocultar/prenda/{{ $prenda->id }}"><button class="btn btn-intemodal">Ocultar</button></a>
                  </div>
                  <div class="btn-div2">
                    <button type="button" class="btn btn-intemodal" data-bs-toggle="modal" data-bs-target="#exampleModalIMG{{$prenda -> id}}" style="width: 150px !important">
                      Cambiar Imagen
                    </button>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      
      <div class="row">
        <div class="col">
          <div class="d-flex justify-content-center mt-4">
            {{ $misPrendas->links() }}
          </div>
        </div>
    </div>
    

  </div>

      {{-- PRENDAS OCULTAS --}}
      <div class="tab-pane fade" id="ocultos" role="tabpanel" aria-labelledby="ocultos-tab">
        <div class="row">
          @foreach ($misPrendasOcultas as $prenda)
          <div class="card cardsing card-hover mb-4 mx-2" style="width: 18rem;">
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
      
                <a href="/mostrar/prenda/{{$prenda -> id}}"><button class="btn btn-intemodal">Mostrar</button></a>
              </div>
              <div class="btn-div2">
                <button type="button" class="btn btn-intemodal" data-bs-toggle="modal" data-bs-target="#exampleModalIMG{{$prenda -> id}}" style="width: 150px !important">
                  Cambiar Imagen
                </button>
              </div>
            </div>
          </div>
          @endforeach    
          <div>
            <div class="d-flex justify-content-center mt-4">
             {{ $misPrendasOcultas->links() }}
            </div>
          </div>
 </div>
@endsection

@foreach ($misPrendas as $prenda)
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
                              <input type="number" class="form-control" name="precio" placeholder="${{$prenda -> precio_obra}}" readonly><br>
                            </div>
                            <div class="col">
                              <label for="precio_telillas"><h3 class="h3-modal">Precio de las Telas</h3></label>
                              <input type="number" class="form-control" name="precio_telillas" placeholder="${{$prenda -> precio_telas}}" readonly><br>
                            </div>
                          </div>
  
                          <label for="genero"><h3 class="h3-modal">Genero de la Prenda</h3></label>
                          <input type="text" class="form-control" name="genero" placeholder="{{$prenda -> genero}}" readonly><br>
      
                          <label for="tipoprenda"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                          <input type="text" class="form-control" name="tipoprenda" placeholder="{{$prenda -> tipoPrenda->tipo_prenda}}" readonly><br>
      
                          <label for="colorprenda"><h3 class="h3-modal">Colores Disponibles de la Prenda</h3></label>
                          @foreach ($prenda -> prendasColor as $color)
                          <input class='form-control' style="background-color: {{ $color -> color -> color }}; margin: auto; width: 70%; text-align: center;" title="{{ $color -> color -> color }}" readonly><br>
                          @endforeach
      
                          <div class="row">
                            <div class="col">
                              <label for="telotas"><h3 class="h3-modal">Telas de la Prenda</h3></label>
                              @foreach ($prenda -> prendasTelas as $tela)

                              @php
                              $nombreTela = $tela->tela->nombre_tela ?? 'Sin tela';
                              @endphp
                              <input type="text" class="form-control" name="telotas" placeholder="{{ $nombreTela }}" readonly><br>
                          
                              @endforeach
                            </div>
      
                            <div class="col">
                              <label for="cantidadsota"><h3 class="h3-modal">Metros de la Tela</h3></label>
                              @foreach ($prenda -> prendasTelas as $tela)
                                @php
                                  $cantidadTela = $tela->cantidad_tela ?? 'Sin tela';
                                @endphp
                                <input type="number" class="form-control" name="cantidadsota" placeholder="{{$cantidadTela}}" readonly><br>
                              @endforeach
                            </div> 
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="row mb-1" style="text-align: center; margin: auto">
                        <div class="col mb-3">
                          <a href="/modificar/prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Prenda</button></a>
                        </div>
                        <div class="col mb-3">
                          <a href="/modificar/telas-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Telas</button></a>
                        </div>
                      </div><br>
                      <div class="row" style="margin: auto">
                        <div class="col mb-3">
                          <a href="/modificar/colores-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Colores</button></a>
                        </div>
                        <div class="col mb-3">
                          <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal" style="width: 150px !important">Cerrar</button>
                        </div>
                      </div><br>
                    </div>
                  </div>
                </div>
              </div>
@endforeach


@foreach ($misPrendasOcultas as $prenda)
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
                                <input type="number" class="form-control" name="precio" placeholder="${{$prenda -> precio_obra}}" readonly><br>
                              </div>
                              <div class="col">
                                <label for="precio_telas"><h3 class="h3-modal">Precio de las Telas</h3></label>
                                <input type="number" class="form-control" name="precio_telas" placeholder="${{$prenda -> precio_telas}}" readonly><br>
                              </div>
                            </div>
  
                            <label for="genero"><h3 class="h3-modal">Genero de la Prenda</h3></label>
                            <input type="text" class="form-control" name="genero" placeholder="{{$prenda -> genero}}" readonly><br>
        
                            <label for="tipoprenda"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                            <input type="text" class="form-control" name="tipoprenda" placeholder="{{$prenda -> tipoPrenda->tipo_prenda}}" readonly><br>
        
                            <label for="colorprenda"><h3 class="h3-modal">Colores Disponibles de la Prenda</h3></label>
                            @foreach ($prenda -> prendasColor as $color)
                              <input class="form-control" style="background-color: {{ $color -> color -> color}}; margin: auto; width: 70%; text-align: center;" title="{{ $color -> color -> color }}" readonly><br>
                            @endforeach
        
                            <div class="row">
                             <div class="col">
                                <label for="telotas"><h3 class="h3-modal">Telas de la Prenda</h3></label>
                                @foreach ($prenda -> prendasTelas as $tela)
                                @php
                                  $nombreTela = $tela->tela->nombre_tela ?? 'Sin tela';
                                  @endphp
                                  <input type="text" class="form-control" name="telotas" placeholder="{{ $nombreTela }}" readonly><br>
                                @endforeach
                              </div>
        
                              <div class="col">
                                <label for="cantidadsota"><h3 class="h3-modal">Metros de la Tela</h3></label>
                                @foreach ($prenda -> prendasTelas as $tela)
                                  @php
                                      $cantidadTela = $tela->cantidad_tela ?? 'Sin tela';
                                  @endphp
                                  <input type="number" class="form-control" name="cantidadsota" placeholder="{{$cantidadTela}}" readonly><br>
                                @endforeach
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="row mb-1" style="text-align: center; margin: auto">
                          <div class="col mb-3">
                            <a href="/modificar/prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Prenda</button></a>
                          </div>
                          <div class="col mb-3">
                            <a href="/modificar/telas-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Telas</button></a>
                          </div>
                        </div><br>
                        <div class="row" style="margin: auto">
                          <div class="col mb-3">
                            <a href="/modificar/colores-prenda/{{$prenda -> id}}"><button type="button" class="btn btn-intemodal" style="width: 150px !important">Gestionar Colores</button></a>
                          </div>
                          <div class="col mb-3">
                            <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal" style="width: 150px !important">Cerrar</button>
                          </div>
                        </div><br>
                    </div>
                    </div>
                  </div>
                </div>
@endforeach

@foreach ($misPrendas as $prenda)
              <!-- Modal -->
              <div class="modal fade modal-prendas" id="exampleModalIMG{{$prenda -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Datos de la Prenda</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="conteform">
                        <form action="/cambiar/img-prenda" method="post" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="idprenda" value="{{$prenda -> id}}">

                          <label for="imagensonaprenda" style="text-align: center;"><h3 class="h3-modal">Cambiar Imagen de la Prenda</h3></label>
                          <input class="form-control" type="file" name="imagensonaprenda" id="imagensonaprenda" accept="image/*" required><br>

                          <input type="submit" class="btn btn-modal-sub" value="Guardar">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
@endforeach

</body>
<style>


.h3-modal {
  text-align: center;
}

.interactive-tabs {
  display: flex;
  justify-content: left;
  gap: 15px;
}

.interactive-tabs .nav-link {
  font-weight: 500;
  font-size: 1rem;
  color: #6c757d; /* Gris neutro inicial */
  background: none;
  border: none;
  position: relative;
  padding: 5px 10px;
  transition: color 0.3s ease-in-out;
}

.interactive-tabs .nav-link::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 50%;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #ff9cee, #a64db6); /* Rosa-morado interactivo */
  transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
}

.interactive-tabs .nav-link:hover {
  color: #a64db6; /* Morado más intenso */
}

.interactive-tabs .nav-link:hover::after {
  width: 100%;
  left: 0;
}

.interactive-tabs .nav-link.active {
  color: #720d85; /* Morado oscuro */
}

.interactive-tabs .nav-link.active::after {
  width: 100%;
  left: 0;
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

.card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px); /* Desplazamiento hacia arriba */
        box-shadow: 10px 10px 20px rgba(0, 0.2, 0.2, 0.2); /* Sombra más intensa */
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
