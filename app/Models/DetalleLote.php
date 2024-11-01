<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleLote extends Model
{
    protected $table = 'detalles_lotes';
    protected $fillable = ['pedido_id', 'prenda', 'precio_por_prenda', 'anticipo'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function lotesTallas()
    {
        return $this->hasMany(LoteTalla::class);
    }
}
