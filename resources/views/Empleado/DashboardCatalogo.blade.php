<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestión Catálogo</title>
</head>
<body>
    @extends('layouts.nav')
    @section('content')
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <h1 class="Titulo1">Gestión del Catálogo</h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h2 class="Subtitulo">
                        Selecciona el modulo que deseas gestionar
                    </h2>
                </div>
            </div><br>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100 card-hover">
                        <div class="card-body text-center">
                            <h3 class="card-title Titulo3">Gestión de Prendas</h3>
                            <p class="card-text">Agregar, modificar y ocultar prendas</p>
                            <a href="/gestion/prenda-confeccion"><button class="btn btn-gest2">Gestionar</button></a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100 card-hover">
                        <div class="card-body text-center">
                            <h3 class="card-title Titulo3">Gestión de Tipos de Prendas</h3>
                            <p class="card-text">Agregar y modificar tipos de prendas</p>
                            <a href="/gestion/tipos-prendas"><button class="btn btn-gest2">Gestionar</button></a>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100 card-hover">
                        <div class="card-body text-center">
                            <h3 class="card-title Titulo3">Gestión de Telas</h3>
                            <p class="card-text">Agregar y modificar telas</p>
                            <a href="/gestion/tela"><button class="btn btn-gest2">Gestionar</button></a>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100 card-hover">
                        <div class="card-body text-center">
                            <h3 class="card-title Titulo3">Gestión de Materiales de Tela</h3>
                            <p class="card-text">Agregar y modificar materiales de tela</p>
                            <a href="/gestion/tipos-telas"><button class="btn btn-gest2">Gestionar</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<style>
    body{
        background-color: #fff3ed;
    }

    .container {
        height: 100vh;
    }

    h1.Titulo1 {
        color: #E57D90;
        font-size: 50px;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .card-title {
        color: black;
    }

    .Subtitulo {
        color: #ff90a4;
        font-size: 36px;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .Titulo3 {
        color: #ff90a4 !important;
        font-size: 30px;
    }

    .btn-gest2{
        background-color: #FFCDD4 !important; /* Cambiar el color del botón */
        color: #8A226F !important;
        border: solid #8A226F !important;
        font-weight: 200;
    }

    .btn-gest2:hover{
        background-color: #8A226F !important;
        border: solid #FFCDD4 !important;
        color: #FFCDD4 !important;
    }

    /* Estilo base de las tarjetas */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Efecto hover */
    .card-hover:hover {
        transform: translateY(-10px); /* Desplazamiento hacia arriba */
        box-shadow: 10px 10px 20px rgba(0, 0.2, 0.2, 0.2); /* Sombra más intensa */
    }

    .card-hover:hover .btn {
        background-color: #8A226F !important;
        border: solid #FFCDD4 !important;
        color: #FFCDD4 !important;
    }
</style>
</html>
