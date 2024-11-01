<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $table = 'telas';
    protected $fillable = ['nombre_tela', 'material_tela_id'];

    public function materialTela()
    {
        return $this->belongsTo(MaterialTela::class);
    }

    public function prendasTela()
    {
        return $this->hasMany(PrendaTela::class);
    }
}
