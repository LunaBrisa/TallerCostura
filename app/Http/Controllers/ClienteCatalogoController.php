<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\PrendaConfeccion as prenda;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
USE App\Models\TipoPrenda;
use App\Models\Servicio;
use App\Models\DetalleLote;

class ClienteCatalogoController extends Controller
{
  public function MostrarCatalogo(){
    $prenda = prenda::where('visible', true)->get();
    return view('Cliente.PcatalogoView',compact('prenda'));
  }

  public function MostrarMujeres(Request $request){
    $tiposPrenda = TipoPrenda::whereHas('prendasConfeccion', function ($query) {
      $query->where('genero', 'Mujer');
        })->get();

    $tipoSeleccionado = $request->input('tipo_prenda'); 
    $prenda = Prenda::where('genero', 'Mujer')
        ->where('visible', true)
        ->when($tipoSeleccionado, function ($query) use ($tipoSeleccionado) {
            $query->whereHas('tipoPrenda', function ($q) use ($tipoSeleccionado) {
                $q->where('tipo_prenda', $tipoSeleccionado);
            });
        })
        ->get();

    return view('Cliente.ClienteMujeresView', compact('tiposPrenda', 'prenda', 'tipoSeleccionado'));
}
  
  public function MostrarHombres(Request $request){
    $tiposPrenda = TipoPrenda::whereHas('prendasConfeccion', function ($query) {
      $query->where('genero', 'Hombre');
    })->get();

    $tipoSeleccionado = $request->input('tipo_prenda'); 
    $prenda = Prenda::where('genero', 'Hombre')
        ->where('visible', true)
        ->when($tipoSeleccionado, function ($query) use ($tipoSeleccionado) {
            $query->whereHas('tipoPrenda', function ($q) use ($tipoSeleccionado) {
                $q->where('tipo_prenda', $tipoSeleccionado);
            });
        })
        ->get();
    return view('Cliente.ClienteHombresView',compact('tiposPrenda', 'prenda', 'tipoSeleccionado'));
  }

  public function DetallePrenda(Request $request){
    $prenda = prenda::find($request->id);
    return view('Cliente.ClienteDetallesView',compact('prenda'));
  }
  public function mostrarPrendasConColores()
  {
      $prenda = PrendaConfeccion::with('colores')->get();
      return view('Cliente.ClienteDetallesView', compact('prenda'));
  }
  public function mostrarTelasYTipos(){
    $prenda = PrendaConfeccion::with(['telas.materialTela'])->get();
    return view('Cliente.ClienteDetallesView', compact('prenda'));
  }
  public function MostrarPedidosClinte(){
    $user = Auth::user();
    $pedidos = collect($user->persona->cliente->pedidos ?? []); 
      return view('Cliente.MisPedidos', compact('pedidos'));
  }
  public function MostrarDetallesPedido($id)
  {  
 $pedido = Pedido::with([
          'cliente.persona',
          'empleado.persona',
          'detallesConfecciones.prendaConfeccion',
          'detallesConfecciones.medidas',
          'detallesConfecciones.insumos',
          'detallesReparaciones.servicios',
          'detallesReparaciones.insumos',
          'detallesLotes'
      ])->findOrFail($id); 

      return view('Cliente.Index', compact('pedidos'));

  }

  public function MostrarPrendasMasVendidas()
  {
      $prendasMasVendidas = DB::table('PrendasMasVendidas')->get();

      $tiposPrenda = TipoPrenda::all();
      $Servicios = Servicio::all();
      $DetalleLote = DetalleLote::all();
      return view('welcome', compact('prendasMasVendidas','tiposPrenda','Servicios', 'DetalleLote'));

  }

}
