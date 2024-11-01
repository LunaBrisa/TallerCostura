<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'tallas';
    protected $fillable = ['talla'];

    public function lotesTallas()
    {
        return $this->hasMany(LoteTalla::class);
    }
}
