<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container-pedido">
       <form action="{{ route('pedidos.CrearPedido') }}" method="POST">
        @csrf
        <!-- Información del Pedido -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente" id="cliente" class="form-control select2" required>
                <option value="">Seleccione un Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->persona->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="empleado" class="form-label">Empleado</label>
            <select name="empleado" id="empleado" class="form-control select2" required>
                <option value="">Seleccione un Empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id }}">{{ $empleado->persona->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_pedido" class="form-label">Fecha de Pedido</label>
            <input type="date" class="form-control" id="fecha_pedido" name="fecha_pedido" required>
        </div>
        <div class="mb-3">
            <label for="fecha_entrega" class="form-label">Fecha de Entrega</label>
            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
      
         <!-- Detalles de Confecciones -->
         <div id="confeccionesSection">
            <h5>Detalles de Confecciones</h5>
            <table class="table table-bordered" id="confeccionesDetailsTable">
                <thead>
                    <tr>
                        <th>Prenda</th>
                        <th>Color</th>
                        <th>Cantidad</th>
                        <th>Medidas</th>
                        <th>Insumos</th>
                        <th>Telas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="detalles_confecciones[0][prenda_confeccion]"  class="form-control select2" required>
                                <option value="">Seleccione una prenda</option>
                                @foreach($prendas as $prenda)
                                    <option value="{{ $prenda->id }}">{{ $prenda->nombre_prenda }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>  
                            <select id="color_select" name="color_id" class="form-control select2">
                            <option value="">Seleccione un color</option>
                        </select>
                        </td>
                        <td><input type="number" name="detalles_confecciones[0][cantidad_prenda]" class="form-control" required></td>
                     
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medidasModal"> Agregar </button>  
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insumoModal"> Agregar </button>
                        </td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>  
            </div>
            <button type="button" class="btn btn-secondary" onclick="addConfeccionRow()">Agregar Reparación</button>
            <button type="submit" class="btn btn-primary" >Agregar Pedido</button>
            </div>
         </div>
    </div>

  <!-- Modal para Medidas -->
<div class="modal fade" id="medidasModal" tabindex="-1" aria-labelledby="medidasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medidasModalLabel">Registrar Medidas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    
                    <label for="pecho" class="form-label">Pecho</label>
                    <input type="text" name="detalles_confecciones[0][medidas][pecho]" id="pecho" class="form-control" placeholder="Pecho" required>
                </div>
                <div class="mb-3">
                    <label for="cintura" class="form-label">Cintura</label>
                    <input type="text" name="detalles_confecciones[0][medidas][cintura]" id="cintura" class="form-control" placeholder="Cintura" required>
                </div>
                <div class="mb-3">
                    <label for="mangas" class="form-label">Mangas</label>
                    <input type="text" name="detalles_confecciones[0][medidas][mangas]" id="mangas" class="form-control" placeholder="Mangas" required>
                </div>
                <div class="mb-3">
                    <label for="largo" class="form-label">Largo</label>
                    <input type="text" name="detalles_confecciones[0][medidas][largo]" id="largo" class="form-control" placeholder="Largo" required>
                </div>
            </div>
          
        </div>
    </div>
</div>

<!-- Modal para Insumos -->
<div class="modal fade" id="insumoModal" tabindex="-1" aria-labelledby="insumoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insumoModalLabel">Seleccionar Insumos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="insumo" class="form-label">Insumo</label>
                    <select name="insumo" id="insumo" class="form-control select2" required>
                        <option value="">Seleccione un insumo</option>
                        @foreach($insumos as $insumo)
                         <option value="{{ $insumo->id }}">{{ $insumo->insumo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cantidad_insumo" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad_insumo" id="cantidad_insumo" class="form-control" required>
                </div>
            </div>
           
        </div>
    </div>

</div>
</form>
<!-- Bootstrap Bundle con Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
let confeccionesIndex = 0;
let insumosIndex = 0;
let telasIndex = 0;

// Añadir nueva fila de detalle de confección
function addConfeccionRow() {
    confeccionesIndex++;
    let row = `<tr>
        <td>
            <select name="detalles_confecciones[${confeccionesIndex}][prenda_confeccion]" class="form-control select2" required>
                <option value="">Seleccione una prenda</option>
                @foreach($prendas as $prenda)
                    <option value="{{ $prenda->id }}">{{ $prenda->nombre_prenda }}</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" name="detalles_confecciones[${confeccionesIndex}][cantidad_prenda]" class="form-control" required></td>
        <td><input type="number" name="detalles_confecciones[${confeccionesIndex}][subtotal]" class="form-control" readonly></td>
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medidasModal" onclick="setMedidasIndex(${confeccionesIndex})">Agregar</button>
        </td>
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insumoModal" onclick="setInsumosIndex(${confeccionesIndex})">Agregar</button>
        </td>
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#telasModal" onclick="setTelasIndex(${confeccionesIndex})">Agregar</button>
        </td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
    </tr>`;
    $('#confeccionesDetailsTable tbody').append(row);
}

function setInsumosIndex(index) {
    // Establecer el índice y gestionar los insumos
}


// Eliminar fila de detalle de confección
function removeRow(button, tableId) {
    $(button).closest('tr').remove();
}


</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
</body>
</html>

 