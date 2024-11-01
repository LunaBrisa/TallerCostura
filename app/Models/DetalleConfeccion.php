<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleConfeccion extends Model
{
    protected $table = 'detalles_confecciones';
    protected $fillable = ['pedido_id', 'prenda_confeccion_id', 'cantidad_prenda'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function prendaConfeccion()
    {
        return $this->belongsTo(PrendaConfeccion::class);
    }

    public function medidas()
    {
        return $this->hasMany(Medida::class);
    }

    public function detallesInsumo()
    {
        return $this->hasMany(DetalleInsumo::class);
    }
}
