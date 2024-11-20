<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre_usuario', 'contrasena'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'roles_usuarios', 'user_id', 'rol_id');
    }

    public function persona()
    {
        return $this->hasOne(Persona::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
