@extends('layouts.dashboard')
@section('title', 'Dashboard de Pedidos')
@section('dashboard_name', 'Dashboard de Pedidos')
@section('content')


<form action="{{ route('pedidos.CrearPedido') }}" method="POST">
    @csrf
    <div class="modal-body">
        <!-- Información del Pedido -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <select name="cliente" id="cliente" class="form-control select2" required>
                <option value="">Seleccione un Cliente</option>
                @foreach($estadisticas['clientes'] as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->persona->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="empleado" class="form-label">Empleado</label>
            <select name="empleado" id="empleado" class="form-control select2" required>
                <option value="">Seleccione un Empleado</option>
                @foreach($estadisticas['empleados'] as $empleado)
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
                        <th>Tela</th>
                        <th>Medidas</th>
                        <th>Insumos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="prenda_confeccion[]" class="form-control select2" required>
                                <option value="">Seleccione una prenda</option>
                                @foreach($prendas as $prenda)
                                    <option value="{{ $prenda->id }}">{{ $prenda->nombre_prenda }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="cantidad_prenda[]" class="form-control" required></td>
                        <td><input type="number" name="confeccion_subtotales[]" class="form-control" readonly></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#telasModal">
                               Agregar
                              </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medidasModal"> Agregar </button>                                    </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insumoModal"> Agregar </button>
                        </td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this, 'confeccionesDetailsTable')">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>          
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary" onclick="addRow('confeccionesDetailsTable')">Agregar Confección</button>
    </div>
</form>


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
                <input type="number" name="cantidad_tela" id="cantidad_tela" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal para Telas -->

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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
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
                    <input type="text" name="pecho" id="pecho" class="form-control" placeholder="Pecho" required>
                </div>
                <div class="mb-3">
                    <label for="cintura" class="form-label">Cintura</label>
                    <input type="text" name="cintura" id="cintura" class="form-control" placeholder="Cintura" required>
                </div>
                <div class="mb-3">
                    <label for="mangas" class="form-label">Mangas</label>
                    <input type="text" name="mangas" id="mangas" class="form-control" placeholder="Mangas" required>
                </div>
                <div class="mb-3">
                    <label for="largo" class="form-label">Largo</label>
                    <input type="text" name="largo" id="largo" class="form-control" placeholder="Largo" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>