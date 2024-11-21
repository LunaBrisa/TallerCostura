<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QTgOOc3+5o6/o5EW0iWMGQLsimTVtHaM8YR2xHqz9z9Z6nSYtHqr6FHZkxesjfAk" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .c {
            width: 100%;
            height: 100vh;
            background-image: url('/images/F2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            margin-left: 60px;
            margin-top: 50px;
        }

        h2 {
            font-size: 2rem;
        }

        label {
            font-size: 1rem;
        }

        button {
            width: 100%;
            font-size: 1rem;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .login-container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            label, button {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            label, button {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
@extends('layouts.nav')
@section('content')
<div class="c">
    <div class="login-container">
        <div class="row">
            <h2 class="p-2 text-black text-center" style="font-size: 50px; text-shadow: 2px 2px 0px #B5C5D7, -2px -2px 0px #B5C5D7, -2px 2px 0px #B5C5D7;">
               Iniciar Sesión
            </h2> 
            <div class="row mt-4">
                <label class="form-label" style="font-size: 20px; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #F4D9EC;">
                    Usuario:
                </label>
                <input type="text" class="form-control" aria-describedby="basic-addon1">    
            </div>
      
            <div class="row mt-4">
                <label for="inputPassword5"  class="form-label" style="font-size: 20px; font-family: 'Junigarden Swash'; text-shadow: 2px 2px 0px #F4D9EC;">Contraseña:</label>
                <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">    
            </div>
            <div class="row mt-4">
                <button type="submit" class="btn btn-primary" style="background-color: #BE5A8C; border-color: #F99AAA">Iniciar Sesión</button>
            </div>

        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-PJaaA1dGx+KCWfIqydG9YuJGR82OypL8/l3rlhmsOULUvq3MD6RfrFiOGxSUVz5C" crossorigin="anonymous"></script>
</body>
</html>
