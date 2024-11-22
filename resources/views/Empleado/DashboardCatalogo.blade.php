<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/estoloCatalogoGeneral.css')}}">
    <title>Gestion Catálogo</title>
    <style>
        /* Estilo general */
        .btn-gest {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }
    
        .btn-gest:hover {
            background-color: #0056b3;
        }
    
        .btn-div {
            text-align: center;
        }
    
        /* Ajustes específicos para pantallas pequeñas */
        @media (max-width: 576px) {
            .btn-gest {
                font-size: 0.9rem; /* Reduce el tamaño de la fuente */
                padding: 8px 15px; /* Reduce el padding */
            }
    
            .cuadradito, .cuadradito-solo {
                padding: 15px;
                width: 20vw /* Reduce el espacio interior del contenedor */
            }
    
            .btn-div button {
                width: 100%; /* Botón ocupa todo el ancho del contenedor */
            }
    
            .p-btn {
                font-size: 0.9rem; /* Ajusta el tamaño del texto */
            }
        }
    </style>
    </head>
<body>
    @extends('layouts.navemp')
    @section('content')
    <div class="container2"><br>
        <h1 class="Titulo1">Gestión del Catálogo</h1><br>
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
                        <a href="#"><button class="btn btn-gest" data-bs-toggle="modal" data-bs-target="#exampleModal"> <p class="p-btn">Agregar Nuevo</p> </button></a>
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
