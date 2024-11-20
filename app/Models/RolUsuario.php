<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    protected $table = 'roles_usuarios';
    protected $fillable = ['user_id', 'rol_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
