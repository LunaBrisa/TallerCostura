<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    protected $table = 'roles_usuarios';
    protected $fillable = ['usuario_id', 'rol_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
}
