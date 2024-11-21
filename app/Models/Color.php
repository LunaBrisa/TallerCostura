<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'COLORES';
    protected $fillable = ['color'];

    public function Color()
    {
        return $this->hasMany(PrendaColor::class);
    }
}
