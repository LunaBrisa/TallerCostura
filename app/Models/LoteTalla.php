<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoteTalla extends Model
{
    protected $table = 'lotes_tallas';
    protected $fillable = ['lote_id', 'talla_id', 'cantidad_prendas'];

    public function detalleLote()
    {
        return $this->belongsTo(DetalleLote::class, 'lote_id');
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }
}
