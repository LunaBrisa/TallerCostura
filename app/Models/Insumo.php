<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $table = 'insumos';
    protected $fillable = ['insumo', 'cantidad_stock', 'precio_unitario'];

    public function detallesInsumo()
    {
        return $this->hasMany(DetalleInsumo::class);
    }

    public function detallesServicios()
    {
        return $this->hasMany(DetalleServicio::class);
    }
}
