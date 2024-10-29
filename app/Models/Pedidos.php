<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_usuario', 'id_empleado', 'fecha_pedido', 'fecha_entrega', 
        'anticipo', 'subtotal', 'total'
    ];

    public $timestamps = false;

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedidos::class, 'id_pedido');
    }
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario', 'id_usuario'); // Asegúrate de que estás usando 'id_usuario' como clave foránea y como clave primaria
    }
    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'id_empleado', 'id_empleado'); // Asegúrate de que estás usando 'id_usuario' como clave foránea y como clave primaria
    }

}
