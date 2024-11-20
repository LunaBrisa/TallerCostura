<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Login</title>
</head>
<body>
@extends('layouts.nav')
 @section('content')
 <div class="container">
    <div class="row">
        <div class="input-group mb-3">
            <label for="inputUsername" class="form-label">Username</label>
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>
    </div>
    <div class="row">
        <label for="inputPassword5" class="form-label">Password</label>
        <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">    
    </div>
 </div>
 @endsection
    
</body>
</html>