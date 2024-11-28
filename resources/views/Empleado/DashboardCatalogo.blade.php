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

        <div class="d-flex justify-content-between flex-wrap row-gap-4"> 
            <div class="gestion-div">
                <h1 class="Titulo2">Gestionar las prendas existentes</h1>
            </div>
            <div class="gestion-div">

            </div>
            <div class="gestion-div">

            </div>
            <div class="gestion-div">

            </div>
        </div><br>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>

    h1.Titulo1 {
        color: #E57D90;
        font-size: 50px;
    }

    h1.Titulo2{
    color: #E57D90;
    font-style: italic;
    font-size: 35px;
    padding-top: 15px;
    }   

    .container2 {
        margin: auto;
        width: 100%;
    }

    .gestion-div {
        height: 30vh;
        width: 22%; /* Ajusta el ancho de cada div */
        background-color: #FFCDD4;
        margin: auto;
        border-radius: 20%;
        border: solid 2px;
        border-color: #BE5A8C;
    }

</style>

</html>
