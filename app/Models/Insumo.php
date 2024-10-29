<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $table = 'insumos';
    protected $primaryKey = 'id_insumo';

    protected $fillable = ['insumo', 'cantidad_stock', 'precio_unitario'];
    public $timestamps = false;

    public function detalleServicios()
    {
        return $this->hasMany(DetalleServicio::class, 'id_insumo');
    }
}
