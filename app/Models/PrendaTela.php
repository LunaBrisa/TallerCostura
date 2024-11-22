<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrendaTela extends Model
{
    protected $table = 'PRENDAS_TELAS';
    protected $fillable = ['tela_id', 'prenda_id', 'cantidad_tela'];

    public function tela()
    {
        return $this->belongsTo(Tela::class);
    }

    public function prenda()
    {
        return $this->belongsTo(PrendaConfeccion::class);
    }
}
