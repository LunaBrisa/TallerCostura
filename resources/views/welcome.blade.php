<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}"> 
    <title>Taller Costura</title> 
</head>
<body style="background-color: #ECDFDB">
@extends('layouts.nav')

@section('content')

<!-- Sección de bienvenida -->
<section class="servicio d-flex position-relative p-5">
    <div class="overlay"></div>  
    <div class="contenido text-center justify-content-center d-flex w-100 h-100 position-relative">
        <h1 class="p-2 display-3" style="z-index: 1; font-size: 7rem; color: white; font-family: 'Junigarden Swash'; text-shadow: 4px 4px 1px #7e065a; margin-top: 10vh;">
            ¡Bienvenido<br> al Taller de Costura! <br> Luna Cast.! 
        </h1> 
    </div>
</section>

<!-- Historia -->
<section class="container d-flex justify-content-center align-items-center position-relative p-5">
    <div class="historia position-relative">
        <div class="overlay"></div>
        <h1 class="text-white text-center p-2" style="font-size: 1.25rem; position: relative; z-index: 2;">
            " Nuestra Historia "<br>
            Nuestro Taller comenzó desde que yo era muy pequeña, 
            ya que siempre me llamó la atención las máquinas y
            el poder hacer que las demás personas luzcan unos conjuntos muy bonitos
            y hechos por mí.
        </h1>
    </div>
</section>

<!-- Servicios -->
<section class="container">
    <div class="row g-4 justify-content-center" style="padding:20px; border-radius: 10px;">
        <h2 class="p-2 text-black text-center" style="font-size: 3rem; text-shadow: 2px 2px 0px #f48ed5;">
            Servicios  
        </h2> 
        <div class="col-12 col-md-6 mt-4">
            <h3 class="servicios-texto">Confección, reparación y modificación de:</h3>
            <hr>  
            <ul>
                <li>Ropa en general</li>
                <li>Uniformes empresariales</li>
                <li>Vestidos de coctel</li>
                <li>Vestidos de novia</li>
                <li>Trajes de sastre</li>
                <li>...y más</li>
            </ul>
        </div>
        <div class="col-12 col-md-6 mt-4">
            <h3 class="servicios-texto">Otros servicios</h3>
            <hr>  
            <ul>
                <li>Bastillas</li>
                <li>Botones para todo tipo de ropa</li>
                <li>Cierres para todo tipo de ropa</li>
                <li>Reparaciones</li>
            </ul>
            <h3 class="servicios-texto">Producción por lotes:</h3>
            <hr>  
            <ul>
                <li>Playeras</li>
                <li>Pantalones</li>
                <li>Uniformes</li>
                <li>etc.</li>
            </ul>
        </div>
    </div>
</section>

<!-- Colección -->
<section class="container coleccion mt-4">
    <h1 class="text-black text-center p-2" style="text-shadow: 2px 2px 0px #f48ed5;">
        Colección de ropa
    </h1>
    <hr class="w-25 mx-auto">

    <div id="coleccionCarrusel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($prendasMasVendidas->chunk(3) as $index => $chunk)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="row justify-content-center gx-4">
                    @foreach ($chunk as $prenda)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch mb-4">
                        <div class="card h-100" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                            <div class="img-div">
                            <a href="/Cliente/PcatalogoView">
                                <img src="{{ asset($prenda->ruta_imagen) }}" class="card-img-top" alt="Imagen de {{ $prenda->nombre_prenda }}" >
                            </a>
                            </div>
                            <div class="card-body text-center">
                                <h5 class="card-title" style="font-size: 1.1rem;">{{ $prenda->nombre_prenda }}</h5>
                                <p class="card-text" style="font-size: 0.9rem;">Género: {{ $prenda->genero }}</p>
                                <p class="card-text" style="font-size: 0.9rem;">Descripción: {{ $prenda->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controles de navegación -->
        <button class="carousel-control-prev" type="button" data-bs-target="#coleccionCarrusel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#coleccionCarrusel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</section>


<!-- Visítanos -->
<section class="text-center mt-5">
    <h1 class="text-black" style="font-size: 3rem; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #f48ed5;">
        ¡Ven y Visítanos!
        <br> Para darte una mejor atención.
    </h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1463.6995365253426!2d-103.42184426333861!3d25.50248785713555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdc71e733911b%3A0x527c06e10d583e86!2sJos%C3%A9%20Carrillo%20Machado%20388%2C%20Amp%20Santiago%20Ram%C3%ADrez%20II%2C%2027390%20Torre%C3%B3n%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1730126331717!5m2!1ses-419!2smx" 
    width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"
    referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<style>
    .texto1 {
        background-color: blanchedalmond;
        z-index: 1;
        opacity: 30%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 30px;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        box-sizing: border-box;
    }

    .servicio {
        background-image: url('/images/Fondo2.png');
        height: 87vh;
        background-size: cover;
        background-position: center;
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
        border-radius: 10px;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: black;
        opacity: 0.6;
        border-radius: 10px;
    }

    .btn-outline-light {
        font-size: 1rem;
        padding: 10px 20px;
    }
    .img-div {
    width: 100%;
    height: 300px;
    overflow: hidden;
    border-radius: 25px;
    border: solid 2px;
    border-color:#8A226F ;
    margin-top: auto;
    }

    .img-div img {
    width: 100%;
    height: 100%;
    object-fit: fill;
    }

    .card {
    border-radius: 15px;
    transition: transform 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
    transform: translateY(-10px); 
    }

    .card-body {
    padding: 15px;
    }

    .card-title {
    font-size: 1.1rem;
    font-weight: bold;
    }

    .card-text {
    font-size: 0.9rem;
    color: #555;
    }

    .card-img-top {
    width: 100%;
    height: 250px;
    object-fit: cover;
    }

    .servicios-texto {
    color: #8A226F;
    }

    @keyframes slideIn {
    0% {
        opacity: 0;
        transform: translateY(-50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .contenido h1 {
    animation: slideIn 1.5s ease-out; /* Aplica la animación */
    animation-delay: 0.3s; /* Opcional: retrasar la animación para que no sea inmediata */
    font-family: 'Junigarden Swash', sans-serif;
    text-shadow: 4px 4px 1px #7e065a;
    font-size: 8rem;
    }

</style>
