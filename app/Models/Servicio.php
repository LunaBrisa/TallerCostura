<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    protected $fillable = ['servicio', 'descripcion', 'precio'];

    public function detallesServicios()
    {
        return $this->hasMany(DetalleServicio::class);
    }
}
