<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PrendaConfeccion as prenda;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;


class ClienteCatalogoController extends Controller
{
  public function MostrarCatalogo(){
    $prenda = prenda::all();
    return view('Cliente.PcatalogoView',compact('prenda'));
  }
  public function MostrarMujeres(){
    $prenda = prenda::where('genero','=','Mujer')->get();
    return view('Cliente.ClienteMujeresView',compact('prenda'));
  }
  public function MostrarHombres(){
    $prenda = prenda::where('genero','=','Hombre')->get();
    return view('Cliente.ClienteHombresView',compact('prenda'));
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
}
