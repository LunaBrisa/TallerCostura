<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@extends('layouts.nav')

@section('content')
    <div>
        @include('auth.register') <!-- Primer formulario o contenido -->
    </div>
    
    <div>
        @include('auth.register2') <!-- Segundo formulario o contenido -->
    </div>
@endsection
</body>
</html>
