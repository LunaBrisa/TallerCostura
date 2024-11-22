<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'INSUMOS';
    protected $fillable = ['insumo', 'cantidad_stock', 'precio_unitario'];

    public function detallesInsumo()
    {
        return $this->hasMany(DetalleInsumo::class);
    }

    public function prendasReparaciones()
    {
        return $this->hasMany(PrendaReparacion::class);
    }
}
