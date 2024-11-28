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
            <h1 class="Titulo1">Gestion de Telas</h1>
        </div>

        <div class="col" style="padding-top: 14px;">
            <div class="btn-div">
                <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <p class="p-btn-agg">Agregar Nueva Tela</p>
                </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <!-- HEADER -->
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Tela</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- BODY -->
                  <div class="modal-body">
                    <div class="conteform">
                    <form action="/agg/tela" method="post">
                            @csrf
                            <label for="telita"><h3 class="h3-modal">Nombre de la Tela</h3></label>
                            <input type="text" name="telita" class="form-control"><br>

                            <label for="tipotelita"><h3 class="h3-modal">Tipo de Tela</h3></label>
                            <select name="tipotelita" class="form-select" aria-label="Default select example">
                                <option selected>Seleccionar Tipo de Tela</option>
                                @foreach ($misMaterialTela as $matetela)
                                    <option value="{{$matetela->id}}">{{$matetela->material_tela}}</option>
                                @endforeach
                            </select><br>

                            <label for="preciotelita"><h3 class="h3-modal">Precio de la Tela</h3></label>
                            <input type="number" class="form-control" name="preciotelita" placeholder="$""><br>
                            
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
    </div><br>

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
                {{ session('success') }}
            </div>
        @endif

        @if (session('successmodif'))
            <div class="alert alert-success" role="alert">
                {{ session('successmodif') }}
            </div>
        @endif
      </div>
  </div>

    <div class="row" style="padding-top: 25px">
        @foreach ($misTelas as $tela)
        <div class="card mb-4 cardsing">
            <div class="card-body">
              <h1 class="list-title">{{$tela->nombre_tela}}</h1>

              <h1 class="card-det">{{$tela->materialTela->material_tela}}</h1>

                          <!-- Button trigger modal -->
            <button type="button" class="btn btn-elim" data-bs-toggle="modal" data-bs-target="#ModalModif{{$tela->id}}">
                Modificar
              </button>
    
              <!-- Modal -->
              <div class="modal fade" id="ModalModif{{$tela->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Modificacion de Tela</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="/modif/tela" method="post">
                        @csrf
    
                        <input type="hidden" name="idtela" value="{{$tela->id}}">
    
                        <label for="telilla"><h3 class="h3-modal">Nombre de la Tela</h3></label>
                        <input type="text" name="telilla" class="form-control" placeholder="Ingresar el nombre nuevo"><br>

                        <label for="tipotelilla"><h3 class="h3-modal">Tipo de Tela</h3></label>
                        <select class="form-select" name="tipotelilla" aria-label="Default select example">
                            <option selected>Seleccionar el Tipo de Tela Nuevo</option>
                                @foreach ($misMaterialTela as $matetela)
                                    <option value="{{$matetela->id}}">{{$matetela->material_tela}}</option>
                                @endforeach
                        </select><br>

                        <label for="preciotelilla"><h3 class="h3-modal">Precio de la Tela</h3></label>
                        <input type="number" name="preciotelilla" class="form-control" placeholder="Ingresar el precio nuevo (Formato 0.00)"><br> 
                        
                        <div class="btn-div">
                          <input type="submit" class="btn btn-intemodal" value="Guardar">
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
@endsection
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

