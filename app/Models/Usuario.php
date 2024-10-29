<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario'; // Asegúrate de que este sea el nombre correcto

    protected $fillable = ['nombre_usuario', 'contrasena'];
    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_usuario', 'id_usuario'); // Define correctamente la relación
    }

    public function personas()
    {
        return $this->hasOne(Persona::class, 'id_usuario', 'id_usuario'); // Define correctamente la relación
    }
}
