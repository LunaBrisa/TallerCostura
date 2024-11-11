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
        <div class="texto1 col-md-8 texto-box1 text-center">
            <h1 class="p-2 display-3 text-white">
                ¡Bienvenido al Taller Costura!
            </h1> 
            <h1 class="p-2 display-4 text-white">
                Luna Cast.!
            </h1>
            <h2 class="p-2 text-white" style="font-size: 30px;">
                Ven y échale un vistazo a nuestro catálogo de ropa que te podemos confeccionar.
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
              y hechos por mí.!Nuestro propósito es que no solo las personas 
              puedan lucir ropa hecha, sino que también podamos reparar la ropa favorita
              que esta dañada para que así las personas las puedan volver a lucirla.</h1>
        </div>
    </div>
        <div class="row g-4 justify-content-center" style="background-color: #F4D9EC; padding:20px;">
            <h2 class="p-2 text-white text-center" style="font-size: 50px; text-shadow: 2px 2px 0px black, -2px -2px 0px black, -2px 2px 0px black, 2px -2px 0px black;">
                Servicios
            </h2>
            <div class="col-md-5 texto-box mt-5">
                <h3>Confección, reparación y alteración de:</h3>
                <ul>
                    <li>Ropa en general</li>
                    <li>Uniformes empresariales</li>
                    <li>Vestidos de coctel</li>
                    <li>Vestidos de novia</li>
                    <li>Trajes de sastre</li>
                    <li>...y más</li>
                </ul>
            </div>
            <div class="col-md-5 texto-box mt-5">
                <h3>Así como:</h3>
                <ul>
                    <li>Bastillas</li>
                    <li>Botones para todo tipo de ropa</li>
                    <li>Cierres para todo tipo de ropa</li>
                    <li>Reparaciones</li>
                </ul>
            </div>
            <div class="col-md-5 texto-box mt-5">
                <h3>Producción por lotes:</h3>
                <ul>
                    <li>Playeras</li>
                    <li>Pantalones</li>
                    <li>Uniformas</li>
                    <li>etc.</li>
                </ul>
            </div>
        </div>
    
    <div id="carouselExampleIndicators" class="carousel slide">      
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('images/c.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/logo.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/logo.png') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div style="margin-top: 50px;">
        <h1 class="text-black text-center p-2" style="font-size: 60px; position: relative; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #F4D9EC ">
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
<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<style>

    .texto1 {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 1;
    opacity: 0.8;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 100%;
    padding: 30px;   
    width: 100%;
    margin: 0 auto;
    box-sizing: border-box;
}

.servicio {
    background-image: url('/images/Fondo2.png');
    width: 100%;
    height: 88vh;
    background-repeat: no-repeat; 
    background-size: cover;
    background-position: center;
    position: relative;
}

.texto-box1 {
    background-color: rgba(7, 2, 2, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.texto-box {
    background-color: black;
    color: white;
    margin-left: 50px;
    margin-right: 50px;
    border-radius: 10px;
    opacity: 90%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.historia {
    width: 100%;
    height: 300px;
    background-image: url('/images/FondoH.png');
    display: flex;
    background-repeat: no-repeat; 
    background-size: cover;
    justify-content: center;
    align-items: center;
    margin-top: 10px; 
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    z-index: 1;
    opacity: 40%;
}

.carousel-inner img {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    margin-top: 50px;
}

.carousel {
    margin: 0 auto;
}

.btn-hover:hover {
    color: white; 
    background-color: #ff69b4; 
    border-color: #ff69b4;
}

@media (max-width: 768px) {
    .texto1 {
        max-width: 90%;
    }

    .historia h1 {
        font-size: 16px;
    }

    .carousel-inner img {
        max-height: 250px;
    }
}

</style>