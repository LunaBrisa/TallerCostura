<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';
    protected $fillable = ['color'];

    public function prendasTelas()
    {
        return $this->hasMany(PrendaConfeccion::class);
    }
}
