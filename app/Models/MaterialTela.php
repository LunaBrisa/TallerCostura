<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialTela extends Model
{
    protected $table = 'MATERIALES_TELAS';
    protected $fillable = ['material_tela'];

    public function telas()
    {
        return $this->hasMany(Tela::class);
    }
}
