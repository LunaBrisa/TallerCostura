
<h2>Servicios Disponibles</h2>


<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($servicios as $servicio)
        <tr>
            <td>{{ $servicio->nombre }}</td>
            <td>{{ $servicio->descripcion }}</td>
            <td>${{ number_format($servicio->precio, 2) }}</td>
            <td>

                <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">🗑️</button>
                </form>
                <button onclick="editarServicio({{ $servicio }})">✏️</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button onclick="mostrarFormularioAgregar()">Agregar Servicio</button>

<form action="{{ route('servicios.store') }}" method="POST" id="formularioAgregar" style="display:none;">
    @csrf
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="text" name="descripcion" placeholder="Descripción">
    <input type="number" name="precio" placeholder="Precio">
    <button type="submit">Guardar</button>
</form>
