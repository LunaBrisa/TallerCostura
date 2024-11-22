<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleInsumo extends Model
{
    protected $table = 'DETALLE_INSUMO';
    protected $fillable = ['detalle_confeccion_id', 'insumo_id', 'cantidad_insumo'];

    public function detalleConfeccion()
    {
        return $this->belongsTo(DetalleConfeccion::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
