<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';
    protected $primaryKey = 'id_detalle_pedido';

    protected $fillable = ['id_pedido', 'id_prenda', 'cantidad_prendas', 'talla', 'color'];
    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'id_pedido');
    }

    public function prenda()
    {
        return $this->belongsTo(Prendas::class, 'id_prenda');
    }
}
