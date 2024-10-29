<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicios';
    protected $primaryKey = 'id_servicio';

    protected $fillable = ['nombre_servicio', 'precio_servicio'];
    public $timestamps = false;

    public function detalleServicios()
    {
        return $this->hasMany(DetalleServicio::class, 'id_servicio');
    }
}
