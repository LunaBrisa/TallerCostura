<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReparacion extends Model
{
    protected $table = 'detalles_reparaciones';
    protected $fillable = ['pedido_id', 'prenda_reparacion_id', 'cantidad_prenda'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function prendaReparacion()
    {
        return $this->belongsTo(PrendaReparacion::class);
    }

    public function detallesServicio()
    {
        return $this->hasMany(DetalleServicio::class);
    }
}
