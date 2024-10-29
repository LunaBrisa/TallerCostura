<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaTelas extends Model
{
    use HasFactory;

    protected $table = 'prenda_telas';
    protected $primaryKey = 'id_pt';

    protected $fillable = ['id_prenda', 'id_color', 'cantidad_tela'];

    public $timestamps = false;

    public function prenda()
    {
        return $this->belongsTo(Prendas::class, 'id_prenda');
    }

    public function color()
    {
        return $this->belongsTo(Colores::class, 'id_color');
    }
}
