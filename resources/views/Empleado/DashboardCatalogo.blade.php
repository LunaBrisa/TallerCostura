<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/estiloOz.css')}}">
    <title>Gestion Catálogo</title>
    <style>
        /* Personaliza el diseño con tu propio estilo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container2 {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .Titulo1 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .cuadradito, .cuadradito-solo {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .Titulo2 {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 15px;
        }
        .btn-div {
            margin-top: 10px;
        }
        .btn-gest {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-gest:hover {
            background-color: #0056b3;
        }
        .p-btn {
            margin: 0;
            font-size: 1rem;
        }
        @media (max-width: 768px) {
            .cuadradito, .cuadradito-solo {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.navemp')
    @section('content')
    <div class="container2">
        <h1 class="Titulo1">Gestión del Catálogo</h1>
        <div class="row gy-4">
            <!-- GESTION DE PRENDAS -->
            <div class="col-md-6 col-lg-4">
                <div class="cuadradito">
                    <h1 class="Titulo2">Prendas</h1>
                    <div class="btn-div">
                        <a href="/gestion/prenda-confeccion"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                    </div>
                </div>
            </div>

            <!-- GESTION DE TELAS -->
            <div class="col-md-6 col-lg-4">
                <div class="cuadradito">
                    <h1 class="Titulo2">Telas</h1>
                    <div class="btn-div">
                        <a href="/gestion/tela"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                    </div>
                </div>
            </div>

            <!-- GESTION DE TIPOS DE PRENDA -->
            <div class="col-md-6 col-lg-4">
                <div class="cuadradito">
                    <h1 class="Titulo2">Tipos de Prenda</h1>
                    <div class="btn-div">
                        <a href="/gestion/tipos-prendas"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                    </div>
                </div>
            </div>

            <!-- GESTION DE TIPOS DE TELA -->
            <div class="col-md-6 col-lg-4">
                <div class="cuadradito">
                    <h1 class="Titulo2">Tipos de Tela</h1>
                    <div class="btn-div">
                        <a href="/gestion/tipos-telas"><button class="btn btn-gest"> <p class="p-btn">Ver Existentes</p> </button></a>
                    </div>
                </div>
            </div>

            <!-- GESTION DE COLORES -->
            <div class="col-md-6 col-lg-4">
                <div class="cuadradito">
                    <h1 class="Titulo2">Colores</h1>
                    <div class="btn-div">
                        <button class="btn btn-gest" data-bs-toggle="modal" data-bs-target="#exampleModal"> <p class="p-btn">Agregar Nuevo</p> </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 Titulomodal" id="exampleModalLabel">Agregar Nuevo Color</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/agg/color" method="post">
                                        @csrf
                                        <label for="colorsito"><h3 class="h3-modal">Color</h3></label>
                                        <input type="text" name="colorsito" class="form-control" placeholder="Ejemplo: Azul"><br>
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
        </div><br>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
