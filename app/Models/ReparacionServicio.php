<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReparacionServicio extends Model
{
    protected $table = 'REPARACIONES_SERVICIOS';
    protected $fillable = ['detalle_reparacion_id', 'servicio_id', 'insumo_id', 'cantidad_insumo'];

    public function detalleReparacion()
{
    return $this->belongsTo(DetalleReparacion::class, 'detalle_reparacion_id');
}

public function servicio()
{
    return $this->belongsTo(Servicio::class, 'servicio_id');
}

}