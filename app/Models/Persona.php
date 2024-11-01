<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $fillable = ['nombre', 'apellido_p', 'apellido_m', 'telefono', 'correo', 'usuario_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class);
    }
}
