<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrendaConfeccion extends Model
{
    protected $table = 'prendas_confecciones';
    protected $fillable = ['nombre_prenda', 'descripcion', 'precio', 'genero', 'tp_id', 'ruta_imagen', 'visible'];

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
    public function prendasColor()
    {
        return $this->hasMany(PrendaColor::class);
    }
}
