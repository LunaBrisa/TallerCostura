<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Gestion Tipos de Prenda</title>
</head>
<body>
@extends('layouts.nav')
@section('content')
<div class="container2">
    <div class="row" style="padding-top: 20px;">
        <div class="col">
            <h1 class="Titulo1 shadow-sm">Gestion de Tipos de Prenda</h1>
        </div>

        <div class="col" style="padding-top: 43px;">
            <div class="btn-div">
                <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <p class="p-btn-agg">Agregar Nuevo Tipo de Prenda</p>
                </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <!-- HEADER -->
                  <div class="modal-header">
                    <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Tipo de Prenda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!-- BODY -->
                  <div class="modal-body">
                    <div class="conteform">
                    <form action="/agg/tipoprenda" method="post">
                            @csrf
                            <label for="tipoprendita"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                            <input type="text" name="tipoprendita" class="form-control"><br>
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
                <p class="p-success">{{ session('successmodif') }}</p>
            </div>
        @endif
      </div>
  </div>
    
    <div class="row">
      @foreach ($MisTiposPrenda AS $TipoPrendita)
      <div class="card mb-4 cardsing shadow-md card-hover">
        <div class="card-body">
          <h1 class="list-title">{{$TipoPrendita->tipo_prenda}}</h1>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-elim" data-bs-toggle="modal" data-bs-target="#ModalModif{{$TipoPrendita->id}}">
            Modificar
          </button>

          <!-- Modal -->
          <div class="modal" id="ModalModif{{$TipoPrendita->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Modificacion de Tipo de Prenda</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="/modif/tipo-prenda" method="post">
                    @csrf

                    <input type="hidden" name="idtp" value="{{$TipoPrendita->id}}">

                    <label for="tipoprendilla"><h3 class="h3-modal">Tipo de Prenda</h3></label>
                    <input type="text" name="tipoprendilla" class="form-control"><br>
                    
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