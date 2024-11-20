<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['empleado_id', 'user_id', 'fecha_pedido', 'fecha_entrega', 'servicio', 'total'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
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
