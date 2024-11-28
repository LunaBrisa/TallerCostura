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
    @extends('layouts.nav') <br>
    @section('content')
        <div class="container">
            <div class="card">
              <h3>Gestion de Prendas</h3>
              <p>Descripción breve para la tarjeta 1.</p>
              <button>Acción 1</button>
            </div>
            <div class="card">
              <h3>Gestion de Tipos de Prendas</h3>
              <p>Descripción breve para la tarjeta 2.</p>
              <button>Acción 2</button>
            </div>
            <div class="card">
              <h3>Gestion de Telas</h3>
              <p>Descripción breve para la tarjeta 3.</p>
              <button>Acción 3</button>
            </div>
            <div class="card">
              <h3>Gestion de Materiales de Tela</h3>
              <p>Descripción breve para la tarjeta 4.</p>
              <button>Acción 4</button>
            </div>
        </div>
        <br>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<style>
    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
      height: 100vh;
    }

    .card {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
      padding: 20px;
      text-align: center;
      width: 280px; /* Ancho fijo para las tarjetas */
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
      font-size: 1.5rem;
      margin: 10px 0;
      color: #333;
    }

    .card p {
      font-size: 1rem;
      color: #666;
      margin: 15px 0;
    }

    .card button {
      padding: 10px 20px;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      background-color: #007bff;
      color: #ffffff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .card button:hover {
      background-color: #0056b3;
    }
</style>

</html>
