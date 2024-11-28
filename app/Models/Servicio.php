<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'SERVICIOS';

    protected $fillable = [
        'servicio',
        'descripcion',
        'precio',
        'visible'
    ];

    public function prendasReparaciones()
    {
        return $this->hasMany(PrendaReparacion::class);
    }

    public function detalleReparaciones()
    {
        return $this->belongsToMany(DetalleReparacion::class, 'REPARACIONES_SERVICIOS', 'servicio_id', 'detalle_reparacion_id');
    }
}
