<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> 
    <title>Taller Costura</title> 
</head>
<body>
    <nav class="navbar">
    <div class="container" >
        <img src="{{ asset('images/logo.png') }}" width="155" height="85">
        <a class="navbar-brand">Taller Costura</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/gestion/catalogo">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<div class="principal">
    <h1>¡Bienvenido a Taller Costura!</h1>
    <h1>Luna Cast.</h1>
    <h1>Ven y hecha un vistazo a nuestro catálogo</h1>

    <a href="Cliente/PcatalogoView" class="btn btn-outline-light btn-hover" style="width: 250px; height:60px;">Ver Catálogo</a>
</div>
    <div class="container d-flex justify-content-center align-items-center vh-100 position-relative p-5">
        <div class="historia position-relative">
            <h1 class="text-black text-center p-2" style="font-size: 20px;">
             " Nuestra Historia "<br>
              Nuestro Taller comenzó desde que yo era muy pequeña 
              ya que siempre me llamo la atención las máquinas y
              el poder hacer que las demás personas luzcan unos conjuntos muy bonitos
              y hechos por mí.!Nuestro propósito es que no solo las personas 
              puedan lucir ropa hecha, sino que también podamos reparar la ropa favorita
              que esta dañada para que así las personas las puedan volver a lucirla.</h1>
            <div class="overlay"></div>
        </div>
    </div>
    <div class="servicio d-flex justify-content-center align-items-center vh-100 position-relative p-5">
        <div class="contenido">
            sdsbvdbskvn
        </div>

        <div class="overlay"></div>
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

      </div>


         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1463.6995365253426!2d-103.42184426333861!3d25.50248785713555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdc71e733911b%3A0x527c06e10d583e86!2sJos%C3%A9%20Carrillo%20Machado%20388%2C%20Amp%20Santiago%20Ram%C3%ADrez%20II%2C%2027390%20Torre%C3%B3n%2C%20Coah.!5e0!3m2!1ses-419!2smx!4v1730126331717!5m2!1ses-419!2smx" 
        width="100%" 
        height="500"
         referrerpolicy="no-referrer-when-downgrade">
        </iframe>

      <div class="footer">
        <p>Taller Costura 2022</p>
      </div>

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

    .principal {
        background-image: url('/images/Fondo1.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        height: 90vh;
        display: flex;
        flex-direction: column; 
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .servicio {
        background-image: url('/images/Fondo2.png');
        width: 100%;
        height: 100vh;
        background-repeat: no-repeat; 
        background-size: cover;
        background-position: center;
        position: relative;
        
    }

    .principal h1 {
        margin-bottom: 20px;
        color: black;
        text-shadow: 2px 2px 4px #E4BCD4;
    }
    .historia {
        width: 100%;
        max-width: 100vw;
        height: 450px;
        background-image: url('/images/FondoH.png');
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    .historia h1 {
        color: white;
        z-index: 2;
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ECDFCB;
        z-index: 1;
        opacity: 50%;
    }
    .carousel-inner img {
    width: 70%; 
    height: 400px; 
    object-fit: cover; 
    margin: 0 auto; 
}

.carousel {
    margin: 0 auto; 
}

.footer {
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background-color: black;
    color: white;
    text-align: center;
    font-size: 20px;
}
.btn-hover:hover {
    color: white; 
    background-color: #ff69b4; 
    border-color: #ff69b4;
}
.border{
    width: 450px;
    height: 400px;
    padding-block-end: 29px;

}
</style>
