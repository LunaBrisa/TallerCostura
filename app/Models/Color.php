<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';
    protected $fillable = ['color'];

    public function Color()
    {
        return $this->hasMany(PrendaColor::class);
    }
    public function prendasTelas()
    {
        return $this->hasMany(PrendaTela::class);
        return $this->hasMany(PrendaConfeccion::class);
    }
    public function prendasConfeccion()
    {
        return $this->hasMany(PrendaConfeccion::class);
    }
}
