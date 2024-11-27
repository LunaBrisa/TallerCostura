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

    <div class="row">
        <div class="col">
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger" role="alert">
                    {{$error}}
                  </div>
                  @endforeach
              </ul>
          </div>

          @else

          <div class="alert alert-danger">
              <div class="alert alert-success" role="alert">
                Se agrego el material de tela correctamente!
              </div>
         </div>

          @endif
        </div>
    </div>

    <div class="row" style="padding-top: 25px;">
        @foreach ($MisMaterialesTela as $MaterialTelilla)
        <div class="card mb-4 cardsing">
          <div class="card-body">
            <h1 class="list-title">{{$MaterialTelilla->material_tela}}</h1>
  
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-elim" data-bs-toggle="modal" data-bs-target="#ModalModif{{$MaterialTelilla->id}}">
              Modificar
            </button>
  
            <!-- Modal -->
            <div class="modal fade" id="ModalModif{{$MaterialTelilla->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Modificacion de Material de Tela</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="/modif/material-tela" method="post">
                      @csrf
  
                      <input type="hidden" name="idmate" value="{{$MaterialTelilla->id}}">
  
                      <label for="materialtelilla"><h3 class="h3-modal">Material de Tela</h3></label>
                      <input type="text" name="materialtelilla" class="form-control"><br>
                      
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
<style>
  @media (max-width: 576px) {
    .p-btn-agg{
      font-size: 14px !important;
    }
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>

