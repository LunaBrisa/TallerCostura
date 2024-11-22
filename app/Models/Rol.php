<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'ROLES';
    protected $fillable = ['nombre_rol'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_usuarios', 'rol_id', 'user_id');
    }
}
