<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    use HasFactory;

    protected $table = 'rol_usuarios';
    protected $primaryKey = 'id_ru';

    protected $fillable = ['id_usuario', 'id_rol'];
    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');  // Asegúrate de tener una tabla y modelo `Roles` si existe en tu base de datos.
    }
}
