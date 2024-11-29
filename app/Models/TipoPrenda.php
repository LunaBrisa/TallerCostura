<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPrenda extends Model
{
    protected $table = 'TIPOS_PRENDAS';
    protected $fillable = ['tipo_prenda'];

    public function prendasConfeccion()
    {
        return $this->hasMany(PrendaConfeccion::class, 'tp_id');
    }
}
