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
<<<<<<< HEAD
=======
    public function prendasTelas()
    {
        return $this->hasMany(PrendaTela::class);
        return $this->hasMany(PrendaConfeccion::class);
    }
    public function prendasConfeccion()
    {
        return $this->hasMany(PrendaConfeccion::class);
    }
>>>>>>> 5a2c41d9cc609174b7a2ee018257c717026d2b38
}
