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
         
    <div class="container">
      <h1>Registro</h1>
      <form action="/Registro" method="post">
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Apellido Paterno">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Apellido Materno">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Fecha de Nacimiento</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Fecha de Nacimiento">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Telefono</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Telefono">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nombre de Usuario">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Contraseña">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Confirmar Contraseña">
        </div>
        <div class="d-grid gap-2 col-6 mx-auto" style="margin:50px">
          <button class="btn btn-info" type="button">Registrar</button>
        
        </div>
  </div>
  </form>
  

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

</style>
