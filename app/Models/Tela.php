<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    protected $table = 'TELAS';
    protected $fillable = ['nombre_tela', 'material_tela_id'];

    public function prendasTela()
    {
        return $this->hasMany(PrendaTela::class);
    }
    public function materialTela()
{
    return $this->belongsTo(MaterialTela::class, 'material_tela_id');
}
}
