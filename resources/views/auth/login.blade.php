<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #f8e9f0;
        }

        .background {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('/images/F2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-container {
            width: 350px; 
            padding: 20px;
            text-align: center;
        }

        .login-container h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
            margin-left: 30px;
        }

        .login-container label {
            font-size: 1rem;
            color: #555;
            display: block;
            margin-left: 30px;
            text-align: left;
            margin-bottom: 5px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            margin-left: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #be5a8c;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-left: 30px;
        }

        .login-container button:hover {
            background-color: #a54c76;
        }
    </style>
</head>
<body>
    @extends('layouts.nav')
    @section('content')
<div class="background">
    <div class="login-container">
        <h2  style="font-size: 40px; text-shadow: 2px 2px 0px #B5C5D7, -2px -2px 0px #B5C5D7, -2px 2px 0px #B5C5D7;">Iniciar Sesión</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" placeholder="Correo" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('error') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn " data-bs-dismiss="modal" style="background-color: #83a6cd; border-color: #557ead">Aceptar</button>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('error'))
            let errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
