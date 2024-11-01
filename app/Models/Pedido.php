<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['empleado_id', 'usuario_id', 'fecha_pedido', 'fecha_entrega', 'servicio', 'subtotal', 'total'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function detallesConfeccion()
    {
        return $this->hasMany(DetalleConfeccion::class);
    }

    public function detallesReparacion()
    {
        return $this->hasMany(DetalleReparacion::class);
    }

    public function detallesLote()
    {
        return $this->hasMany(DetalleLote::class);
    }
}
