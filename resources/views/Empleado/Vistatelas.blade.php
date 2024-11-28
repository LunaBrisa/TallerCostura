<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Telas</title>
</head>
<body>
    <h1>Vista de Telas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Color</th>
                <th>Tipo</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($telas as $tela)
                <tr>
                    <td>{{ $tela->nombre }}</td>
                    <td>{{ $tela->color }}</td>
                    <td>{{ $tela->tipo }}</td>
                    <td>{{ $tela->precio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
