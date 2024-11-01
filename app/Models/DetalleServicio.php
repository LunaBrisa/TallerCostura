<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleServicio extends Model
{
    protected $table = 'detalle_servicios';
    protected $fillable = ['servicio_id', 'detalle_reparacion_id', 'insumo_id'];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function detalleReparacion()
    {
        return $this->belongsTo(DetalleReparacion::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
