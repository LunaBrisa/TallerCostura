<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrendaReparacion extends Model
{
    protected $table = 'prendas_reparaciones';
    protected $fillable = ['nombre_prenda', 'descripcion_problema'];

    public function detallesReparacion()
    {
        return $this->hasMany(DetalleReparacion::class);
    }
}
