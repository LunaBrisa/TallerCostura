<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReparacionServicio extends Model
{
    protected $table = 'REPARACIONES_SERVICIOS';
    protected $fillable = ['detalle_reparacion_id', 'servicio_id', 'servicio_id', 'cantidad_insumo'];

    public function DetalleReparacion()
    {
        return $this->belongsTo(DetalleReparacion::class);
    }

    public function Servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
