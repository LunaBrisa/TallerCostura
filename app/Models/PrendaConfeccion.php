<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaConfeccion extends Model
{
    use HasFactory;
    protected $table = 'prendas_confecciones';
    protected $fillable = ['nombre_prenda', 'descripcion', 'precio', 'genero', 'tp_id', 'ruta_imagen'];
    public function tipoPrenda()
    {
        return $this->belongsTo(TipoPrenda::class, 'tp_id');
    }
    public function detallesConfeccion()
    {
        return $this->hasMany(DetalleConfeccion::class);
    }
    public function prendasTelas()
    {
        return $this->hasMany(PrendaTela::class);
    }
}
