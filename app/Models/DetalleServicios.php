<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleServicios extends Model
{
    use HasFactory;

    protected $table = 'detalle_servicios';
    protected $primaryKey = 'id_detalle_servicio';

    protected $fillable = ['id_detalle_pedido', 'id_servicio', 'id_insumo'];
    public $timestamps = false;

    public function detallePedido()
    {
        return $this->belongsTo(DetallePedidos::class, 'id_detalle_pedido');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'id_servicio');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumos::class, 'id_insumo');
    }
}
