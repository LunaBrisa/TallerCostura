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
<div class="container-pedidoconfeccion">
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
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Medidas</th>
                        <th>Insumos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="prenda_confeccion" class="form-control select2" required>
                                <option value="">Seleccione una prenda</option>
                                @foreach($prendas as $prenda)
                                    <option value="{{ $prenda->id }}">{{ $prenda->nombre_prenda }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="cantidad_prenda" class="form-control" required></td>
                        <td><input type="number" name="confeccion_subtotales" class="form-control" readonly></td>
                     
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medidasModal"> Agregar </button>  
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insumoModal"> Agregar </button>
                        </td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>    
            <table>
                <thead>
                    <tr>
                        <th>Tela</th>
                        <th>Cantidad de telas</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <tr>
               <td> <div class="mb-3">
                    <select name="tela" id="tela" class="form-control select2" required>
                        <option value="">Seleccione una tela</option>
                        @foreach($telas as $tela)
                            <option value="{{ $tela->id }}">{{ $tela->nombre_tela }}</option>
                        @endforeach
                    </select>
                </div></td>

               <td> <div class="mb-3">
                    <input type="number" name="cantidad_tela" id="cantidad_tela" class="form-control">
                </div></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" onclick="prepararEnvio(event)">Crear Pedido</button>
        </div>
    </div>
    
</div>
<!-- Modal para Telas -->
<div class="modal fade" id="telasModal" tabindex="-1" aria-labelledby="telasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="telasModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="tela" class="form-label">Tela</label>
                <select name="tela" id="tela" class="form-control select2" required>
                    <option value="">Seleccione una tela</option>
                    @foreach($telas as $tela)
                        <option value="{{ $tela->id }}">{{ $tela->nombre_tela }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="cantidad_tela" class="form-label">Cantidad en metros</label>
                <input type="number" name="cantidad_tela" id="cantidad_tela" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="guardarTela()">Guardar</button>

        </div>
      </div>
    </div>
  </div>

</form>
<!-- Bootstrap Bundle con Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>