<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Detalle Prenda</title> 
</head> 
<body>
 @extends('layouts.nav')
  @section('content')
  <div class="container mt-4">
   <div class="row">
    <div class="col-md-6 col-12 d-flex justify-content-center align-items-center">
     <img src="{{ asset($prenda->ruta_imagen) }}" alt="Imagen de {{ $prenda->nombre_prenda }}" class="img-fluid shadow">
    </div>

  <div class="col-md-6 col-12">
     <h2>{{ $prenda->nombre_prenda }}</h2>
     <p>Género: {{ $prenda->genero }}</p>
     <p> @foreach ($prenda->colores as $color)
          <button class="circle" style="background-color: {{ $color->color }}" title="{{ $color->color }}"></button>
         @endforeach </p>
     <p id="precio">Precio: $ {{ $prenda->precio }}</p>

     <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
       <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
          Descripción:</button> </h2>
         <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
           <div class="accordion-body">
            {{ $prenda->descripcion }}
           </div>
         </div>
      </div>

      <div class="accordion-item">
         <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
            Materiales </button> </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
             <div class="accordion-body">
              <ul class="list-group">
                @foreach ($prenda->telas as $tela)
                    <li class="list-group-item">
                        <strong>Tipo de Tela:</strong> {{ $tela->materialTela->material_tela }} <br>
                        <strong>Tela:</strong> {{ $tela->nombre_tela }}
                    </li>
                @endforeach
            </ul>
             </div>
          </div>
      </div>
     </div>
  </div>
</div>
  </div>
  @endsection
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<style>
        .circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 0;
            display: inline-block;
            margin: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        #precio{
            font-family: 'Poppins', sans-serif;
            font-size: 26px;
            color: #573121; 
            font-weight: bold;
    }
    </style>    
 