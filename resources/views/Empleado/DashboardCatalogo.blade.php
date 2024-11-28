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
    @extends('layouts.nav') <br>
    @section('content')
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <h1 class="Titulo1">Gestión del Catálogo</h1>
                </div>
            </div>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h1 class="Titulo2">Gestión de Prendas</h1>
                            <p class="card-text">Descripción breve para la tarjeta 1.</p>
                            <button class="btn btn-primary">Acción 1</button>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h1 class="Titulo2">Gestión de Tipos de Prendas</h1>
                            <p class="card-text">Descripción breve para la tarjeta 2.</p>
                            <button class="btn btn-primary">Acción 2</button>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h1 class="Titulo2">Gestión de Telas</h1>
                            <p class="card-text">Descripción breve para la tarjeta 3.</p>
                            <button class="btn btn-primary">Acción 3</button>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <h1 class="Titulo2">Gestión de Materiales de Tela</h1>
                            <p class="card-text">Descripción breve para la tarjeta 4.</p>
                            <button class="btn btn-primary">Acción 4</button>
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
    .container {
        height: 100vh;
    }

    h1.Titulo1 {
    color: #E57D90;
    font-size: 50px;
    }

    h1.Titulo2 {
    color: #e56980;
    font-size: 9px !important;
    }

</style>
</html>
