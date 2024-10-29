<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleServicio extends Model
{
    use HasFactory;

    protected $table = 'detalle_servicios';
    protected $primaryKey = 'id_detalle_servicio';

    protected $fillable = ['id_detalle_pedido', 'id_servicio', 'id_insumo'];
    public $timestamps = false;

    public function detallePedido()
    {
        return $this->belongsTo(DetallePedido::class, 'id_detalle_pedido');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }
}
