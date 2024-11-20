<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['empleado_id', 'cliente_id', 'fecha_pedido', 'fecha_entrega', 'descripcion','estado', 'total'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detallesConfeccion()
    {
        return $this->hasMany(DetalleConfeccion::class, 'pedido_id');
    }

    public function detallesReparacion()
    {
        return $this->hasMany(DetalleReparacion::class, 'pedido_id');
    }

    public function detallesLote()
    {
        return $this->hasMany(DetalleLote::class, 'pedido_id');
    }
}
