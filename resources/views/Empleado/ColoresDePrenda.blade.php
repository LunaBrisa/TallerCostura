<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/estiloOz.css') }}">
    <title>Colores de Prenda</title>
</head>
<body>

@extends('layouts.nav')
@section('content')

<div class="container" style="height: 100vh; padding-top: 20px;">
    <div class="row mb-4 text-center">
        <div class="col">
            <h1 class="Titulo1">Colores de la Prenda</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col text-center">
            <button type="button" class="btn btn-agregprenda" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Nuevo Color
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger text-center">
                {{ $error }}
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        @foreach ($misPrendasColores as $prendaColor)
        <div class="col-md-4 mb-4">
            <div class="card shadow-md card-hover cardsing mx-auto" style="max-width: 300px;">
                <div class="img-div">
                    <img src="{{ asset($prendaColor->ruta_imagen) }}" class="card-img-top" alt="Imagen del color">
                </div>
                <div class="card-body text-center">
                    <h5 class="list-title">{{ $prendaColor->color }}</h5>
                    <div class="color-circle mx-auto" style="background-color: {{ $prendaColor->color }};"></div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-modal-sub" data-bs-toggle="modal" data-bs-target="#exampleModalElim{{ $prendaColor->id }}">
                            Eliminar
                        </button>
                        <button type="button" class="btn btn-modal-sub mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalImg{{ $prendaColor->id }}">
                            Cambiar Imagen
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@foreach ($misPrendasColores as $prendaColor)
<!-- Modal para eliminar -->
<div class="modal fade" id="exampleModalElim{{ $prendaColor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title Titulomodal">Eliminar Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('images/warning-sign-icon-transparent-background-free-png.webp') }}" class="img-cent" alt="Advertencia">
                <p class="advert">¿Estás seguro de eliminar este color?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                <a href="/elim/color/prenda/{{ $prendaColor->id }}" class="btn btn-intemodal">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar imagen -->
<div class="modal fade" id="exampleModalImg{{ $prendaColor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title Titulomodal">Cambiar Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/modif/img-color-prenda" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="idprenda" value="{{ $prendaColor->id }}">
                    <label for="imagencolorsillo" class="form-label h3-modal">Nueva Imagen</label>
                    <input type="file" class="form-control" name="imagencolorsillo" accept="image/*" required>
                    <div class="mt-3 text-center">
                        <button type="button" class="btn btn-intemodal" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-modal-sub" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
