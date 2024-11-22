<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReparacion extends Model
{
    protected $table = 'DETALLES_REPARACIONES';
    protected $fillable = ['pedido_id', 'prenda_reparacion_id', 'cantidad_prenda', 'subtotal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    public function prendaReparacion()
    {
        return $this->belongsTo(PrendaReparacion::class);
    }
}
