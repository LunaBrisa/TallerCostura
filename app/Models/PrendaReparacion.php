<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaReparacion extends Model
{
    use HasFactory;

    protected $table = 'prendas_reparaciones';

    protected $fillable = [
        'nombre_prenda',
        'descripcion_problema',
        'servicio_id',
        'insumo_id',
        'cantidad_insumo'
    ];

    // Relación con Servicios (pertenece a)
    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    // Relación con Insumos (pertenece a)
    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }

    // Relación con DetallesReparaciones (uno a muchos)
    public function detallesReparaciones()
    {
        return $this->hasMany(DetalleReparacion::class);
    }
}
