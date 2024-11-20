<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Taller Costura</title>
</head>
<body style="background-image: url('/images/F.jpg'); background-size: cover;">
    @extends('layouts.nav')

    @section('content')
    <div class="container mt-4 mb-5 p-4" style="max-width: 900px; background-color: #ECDFDB; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="p-2 mb-3" style="border: 2px solid white; background-color: #F4D9EC;">
            <h1 class="text-center">Registro</h1>
        </div>
        <form action="{{ route('Registro.RegistrarCliente') }}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" name="name" id="name" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('nombre_usuario') }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" name="email" id="email" style="border: #B5C5D7 2px solid; font-size: larger;">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-6">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('contrasena') }}">
                    @error('contrasena')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" style="border: #B5C5D7 2px solid; font-size: larger;">
                    @error('contrasena')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="apellido_p" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" name="apellido_p" id="apellido_p" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{ old('apellido_p') }}">
                        @error('apellido_p')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="apellido_m" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" name="apellido_m" id="apellido_m" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old('apellido_m')}}">
                        @error('apellido_m')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" style="border: #B5C5D7 2px solid; font-size: larger;" value=" {{ old ('telefono') }}">
                        @error('telefono')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-6">
                        <label for="Rol" class="form-label">Rol</label>
                        <select class="form-control" name="roles" id="roles" style="border: #B5C5D7 2px solid; font-size: larger;">
                            <option value="0">Seleccione un rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                            <option value="3">Cliente</option>
                        </select>
                    </div>
    
                    <div class="col-md-6">
                        <label for="compania" class="form-label">Compañía</label>
                        <input type="text" class="form-control" name="compania" id="compania" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old ('compania')}}">
                        @error('compania')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" name="cargo" id="cargo" style="border: #B5C5D7 2px solid; font-size: larger;" value="{{old ('cargo')}}">
                        @error('cargo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn" style="background-color:#B5C5D7; width: 200px; font-size: larger; border-radius: 8px;">Registrar</button>
                </div>
            </div>
    </form>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>