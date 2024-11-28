<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiales de Telas</title>
</head>
<body>
    <h1>Vista de Materiales de Telas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $material)
                <tr>
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $material->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
