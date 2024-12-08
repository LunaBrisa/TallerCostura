<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Información del Usuario</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
        }
        .container-info {   
            height: 77vh;
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        tr{
            border-bottom: 1px solid #ccc;
        }

        td {
            padding: 10px;
            text-align: left;
        }
        .user-info {
            padding: 20px;
            height: 400px;
            display: flex;
            opacity: 80%;
            
        }
    </style>
</head>
<body>
    @extends('layouts.nav')
    @section('content')
    <div class="container-info">
        
        @if(isset($datos))
            <h2 class="p-2 text-white text-center" style="font-size: 50px; text-shadow: 2px 2px 0px black, -2px -2px 0px black, 2px -2px 0px black, -2px 2px 0px black;">
               Mi Información
            </h2> 
         <div class="user-info">
                <table class="table table-white table-hover">
                    @foreach($datos as $dato)
                     @if(auth()->check()) 
                        <tr>
                            <td><strong>Nombre de Usuario:</strong></td>
                            <td>{{ $dato->NombreUsuario }}</td>
                            <td><a><img src="{{ asset('images/flecha-bnt.jpg') }}" width="30" height="30"></a></td>
                        </tr>
                        <tr>
                            <td><strong>Correo:</strong></td>
                            <td>{{ $dato->Correo }}</td>
                            <td><a href=""><img src="{{ asset('images/flecha-bnt.jpg') }}" width="30" height="30"></a></td>
                        </tr>
                        <tr>
                            <td><strong>Nombre:</strong></td>
                            <td>{{ $dato->Nombre }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>Teléfono:</strong></td>
                            <td>{{ $dato->Telefono }}</td>
                            <td><a href=""><img src="{{ asset('images/flecha-bnt.jpg') }}" width="30" height="30"></a></td>
                        </tr>
                            @if(auth()->user()->hasRole('Cliente'))
                         <tr>
                            <td><strong>Compañía:</strong></td>
                            <td>{{ $dato->Compañia ?? 'N/A' }}</td>
                            <td></td>
                         </tr>
                         <tr>
                            <td><strong>Cargo:</strong></td>
                            <td>{{ $dato->Cargo ?? 'N/A' }}</td>
                            <td></td>
                        </tr>
                            @elseif(auth()->user()->hasRole('Empleado'))
                        <tr>
                            <td><strong>Fecha de Nacimiento:</strong></td>
                            <td>{{ $dato->FechaNacimiento ?? 'N/A' }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>RFC:</strong></td>
                            <td>{{ $dato->RFC ?? 'N/A' }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><strong>NSS:</strong></td>
                            <td>{{ $dato->NSS ?? 'N/A' }}</td>
                            <td></td>
                        </tr>
                            @endif
                     @endif
                    @endforeach
                </table>
        </div>
        @else
            <div class="user-info">
                <h3>No hay información disponible.</h3>
            </div>
        @endif
    </div>

    @endsection
</body>
</html>
