<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaColor extends Model
{

    use HasFactory;

    protected $table = 'PRENDAS_COLORES';
    protected $fillable = ['prenda_id', 'color_id', 'ruta_imagen'];

    public function prenda()
    {
        return $this->belongsTo(PrendaConfeccion::class);
    }

    public function color()
{
    return $this->belongsTo(Color::class, 'color_id');
}

}
