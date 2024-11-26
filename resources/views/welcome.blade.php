<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}"> 
    <title>Taller Costura</title> 
</head>
<body>
@extends('layouts.nav')

@section('content')
<div class="servicio d-flex position-relative p-5">
    <div class="overlay"></div>  
    <div class="contenido d-flex justify-content-center align-items-center w-100 h-100">
        <div class="texto1 col-lg-8 col-md-10 col-sm-12 text-center mx-auto">
            <h1 class="p-2 display-3 text-black">
                ¡Bienvenido al Taller Costura!
            </h1> 
            <h1 class="p-2 display-4 text-black">
                Luna Cast.! 
            </h1>
            <h2 class="p-2 text-black" style="font-size: 30px;">
                Ven y échale un vistazo a nuestro catálogo de ropa que te podemos confeccionar!!
            </h2>
            <a href="Cliente/PcatalogoView" class="btn btn-outline-light btn-hover mt-4" 
               style="width: 250px; height:60px;">
               Ver Catálogo
            </a>
        </div>
    </div>
</div>
  
<div class="container d-flex justify-content-center align-items-center position-relative p-5">
    <div class="historia position-relative">
        <div class="overlay"></div>
        <h1 class="text-white text-center p-2" style="font-size: 20px; position: relative; z-index: 2;">
         " Nuestra Historia "<br>
          Nuestro Taller comenzó desde que yo era muy pequeña 
          ya que siempre me llamo la atención las máquinas y
          el poder hacer que las demás personas luzcan unos conjuntos muy bonitos
          y hechos por mí.
        </h1>
    </div>
</div>
<div class="container">
    <div class="row g-4 justify-content-center" style="height: auto; background-color: #F4D9EC; padding:20px;">
        <h2 class="p-2 text-white text-center" style="font-size: 50px; text-shadow: 2px 2px 0px black, -2px -2px 0px black, 2px -2px 0px black, -2px 2px 0px black;">
            Servicios  
        </h2> 

        <div class="col-md-6 mt-4">
            <h1 class="servicios-texto">Confección, reparación y modificación de:</h1>
            <hr style="border-top: 2px solid black; margin: 5px 0;">  
            <ul>
                <li>Ropa en general</li>
                <li>Uniformes empresariales</li>
                <li>Vestidos de coctel</li>
                <li>Vestidos de novia</li>
                <li>Trajes de sastre</li>
                <li>...y más</li>
            </ul>
        </div>
        <div class="col-md-6 mt-4">
            <h1 class="servicios-texto">Otros servicios</h1>
            <hr style="border-top: 2px solid black; margin: 5px 0;">  
            <ul>
                <li>Bastillas</li>
                <li>Botones para todo tipo de ropa</li>
                <li>Cierres para todo tipo de ropa</li>
                <li>Reparaciones</li>
            </ul>
            <h1 class="servicios-texto">Producción por lotes:</h1>
            <hr style="border-top: 2px solid black; margin: 5px 0;">  
            <ul>
                <li>Playeras</li>
                <li>Pantalones</li>
                <li>Uniformes</li>
                <li>etc.</li>
            </ul>
        </div>
    </div>
</div>

<div class="container coleccion mt-4">
    <h1 class="text-black text-center p-2" style="font-size: 60px; position: relative; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #F4D9EC;">
        Colección de ropa
    </h1>
    <hr style="border-top: 2px solid black; margin: 5px 0; width: 40%; margin-left: 30%;">
    <div class="row g-4"> 
        <div class="col-md-4"> 
            <div class="card h-100">
                <img src="{{ asset('images/PantalonC1.jpg') }}" class="card-img-top" style="height: 500px;">
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="card h-100">
                <img src="{{ asset('images/VestidoGala.png') }}" class="card-img-top" style="height: 500px;">
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="card h-100">
                <img src="{{ asset('images/PlayeraNike.jpg') }}" class="card-img-top" style="height: 500px;">
            </div>
        </div>
    </div>
</div>
    
<div style="margin-top: 50px;">
    <h1 class="text-black text-center p-2" style="font-size: 60px; position: relative; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #F4D9EC;">
        ¡Ven y Visitanos!
    <br> Para darte una mejor atención.
    </h1>
</div>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1463.6995365253426!2d-103.42184426333861!3d25.50248785713555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdc71e733911b%3A0x527c06e10d583e86!2sJos%C3%A9%20Carrillo%20Machado%20388%2C%20Amp%20Santiago%20Ram%C3%ADrez%20II%2C%2027390%20Torre%C3%B3n%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1730126331717!5m2!1ses-419!2smx" 
    width="100%" 
    height="300"
    referrerpolicy="no-referrer-when-downgrade">
</iframe>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<style>
.card {
    border: 2px solid black;
}
.texto1 {
    background-color:blanchedalmond;
    z-index: 1;
    opacity: 50%;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 30px;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    box-sizing: border-box;
    overflow-wrap: break-word;
    word-wrap: break-word;
    hyphens: auto;
}


.servicio {
    background-image: url('/images/Fondo2.png');
    height: 88vh;
    background-size: cover;
    background-position: center;
}

.texto-box1, .texto-box {
    background-color: #E4BCD4;
    padding: 20px;
    margin-left: 20px;
    border-radius: 10px;
    color: black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.historia {
    background-image: url('/images/FondoH.png');
    height: 300px;
    background-repeat: no-repeat; 
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 40%;
}
.btn-outline-light {
    font-size: 1rem;
    padding: 10px 20px;
    max-width: 80%;
}


@media (max-width: 768px) {
    .texto1 h1, .texto1 h2 {
        font-size: 20px;
    }
    .texto1 h1 {
        font-size: 30px;
    }
}

</style>
