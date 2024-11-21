<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'DETALLE_PEDIDOS';
    protected $primaryKey = 'id_detalle_pedido';

    protected $fillable = ['id_pedido', 'id_prenda', 'cantidad_prendas', 'talla', 'color'];
    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function prenda()
    {
        return $this->belongsTo(Prenda::class, 'id_prenda');
    }
}
