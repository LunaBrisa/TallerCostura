<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';

    protected $fillable = [
        'servicio',
        'descripcion',
        'precio'
    ];

    // Relación con PrendasReparaciones (uno a muchos)
    public function prendasReparaciones()
    {
        return $this->hasMany(PrendaReparacion::class);
    }
}
