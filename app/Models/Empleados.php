<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';

    protected $fillable = ['fecha_nacimiento', 'rfc', 'nss', 'id_persona'];
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }
    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'id_empleado', 'id_empleado'); // Define correctamente la relación
    }
}
