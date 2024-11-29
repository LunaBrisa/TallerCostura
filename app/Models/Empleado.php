<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'EMPLEADOS';
    protected $fillable = ['fecha_nacimiento', 'rfc', 'nss', 'persona_id'];

    public function persona()
{
    return $this->belongsTo(Persona::class);
}
public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}
