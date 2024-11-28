<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gestion Catálogo</title>
    </head>
<body>
    @extends('layouts.nav')
    @section('content')
    <div class="container2"><br>
        <h1 class="Titulo1">Gestión del Catálogo</h1><br>
        <div class="row gy-4">

            <!-- GESTION DE PRENDAS -->
            <div class="col">
                <div class="gestion-div">

                </div>
            </div>

            <div class="col">
                <div class="gestion-div">
                    
                </div>
            </div>

            <div class="col">
                <div class="gestion-div">
                    
                </div>
            </div>

            <div class="col">
                <div class="gestion-div">
                    
                </div>
            </div>

        </div><br>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>

    h1.Titulo1{
        color: #E57D90;
        font-size: 50px;
    }

    .gestion-div{
        height: 30vh;
        width: 100%;
        background-color: #FFCDD4;
        margin: auto;
        border-radius: 20%;
        border: solid 2px;
        border-color: #BE5A8C;
    }
</style>

</html>
