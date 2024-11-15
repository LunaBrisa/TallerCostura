<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <title>Catalogo</title>
</head>
<body>
  @extends('layouts.nav')
  @section('content')
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Cliente/PcatalogoView">Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Cliente/ClienteMujeresView">Mujeres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Cliente/ClienteHombresView">Hombres</a>
        </li>
      </ul>

 <div class="container mt-4">
   <div class="row"> 
    @foreach($prenda as $prenda)
     <div class="col-md-4 mb-4"> 
       <div class="card h-100">
         <img src="{{ asset($prenda->ruta_imagen) }}" class="card-img-top" style="height: 500px">
        <div class="card-body">
          <h5 class="card-title">{{$prenda->nombre_prenda}}</h5>
          <p class="card-text">{{$prenda->descripcion}}</p>
          <p>Precio: {{$prenda->precio}}</p>
          <p>Genero: {{$prenda->genero}}</p>
          <form action="/Cliente/DetallePrenda/{{$prenda->id}}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: #BE5A8C; border-color: #F99AAA">Ver detalles</button>
          </form>
        </div>
       </div>
     </div>  
    @endforeach
  </div>
 </div>
 @endsection
<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<style>
.navbar {
    
    background-color: black;
}

.navbar a {
    color: white;
}

.navbar a:hover {
    color: lightgray;
}

.navbar-toggler-icon {
    filter: invert(1);
}
</style>
