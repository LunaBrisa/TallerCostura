<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleLote extends Model
{
    protected $table = 'detalles_lotes';
    protected $fillable = ['pedido_id', 'prenda', 'precio_por_prenda','cantidad', 'anticipo', 'subtotal'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
