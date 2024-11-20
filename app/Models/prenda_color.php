<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prenda_color extends Model
{
    use HasFactory;
    protected $table = 'prendas_colores';
    protected $fillable = ['prenda_id', 'color_id'];
    public function prenda()
    {
        return $this->belongsTo(PrendaConfeccion::class, 'prenda_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
