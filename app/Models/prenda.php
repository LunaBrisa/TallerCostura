<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class prenda extends Model
{
    use HasFactory;

    protected $table = 'prendas';
    protected $fillable = [
        'nombre_prenda', 'descripcion', 'precio', 'genero', 'tp_id',  'ruta_imagen'
    ];


    public $timestamps = false;

    public function tipoPrenda()
    {
        return $this->belongsTo(TipoPrenda::class, 'id_tp');
    }

    public function prendaTelas()
    {
        return $this->hasMany(PrendaTela::class, 'id_prenda');
    }

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'id_prenda');
    }
}
