<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'ROLES';
    protected $fillable = ['nombre_rol'];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'roles_usuarios', 'rol_id', 'usuario_id');
    }
}
