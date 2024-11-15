<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaColor extends Model
{

    use HasFactory;

    protected $table = 'prendas_colores';
    protected $fillable = ['prenda_id', 'color_id'];

    public function prenda()
    {
        return $this->belongsTo(PrendaConfeccion::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
