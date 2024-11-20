<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table = 'MEDIDAS';
    protected $fillable = ['detalle_confeccion_id', 'pecho', 'cintura', 'mangas', 'largo'];

    public function detalleConfeccion()
    {
        return $this->belongsTo(DetalleConfeccion::class);
    }
}
