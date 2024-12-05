<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReparacion extends Model
{
    protected $table = 'DETALLES_REPARACIONES';
    protected $fillable = ['pedido_id', 'prenda', 'descripcion_problema', 'cantidad_prenda', 'precio_prenda', 'subtotal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'REPARACIONES_SERVICIOS', 'detalle_reparacion_id', 'servicio_id');
    }

}
