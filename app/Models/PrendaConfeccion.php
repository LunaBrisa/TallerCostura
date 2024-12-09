<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaConfeccion extends Model
{
    use HasFactory;
    protected $table = 'PRENDAS_CONFECCIONES';
    protected $fillable = ['nombre_prenda', 'descripcion', 'precio_obra', 'precio_telas', 'genero', 'tp_id', 'ruta_imagen', 'visible'];

    public function tipoPrenda()
    {
        return $this->belongsTo(TipoPrenda::class, 'tp_id');
    }

    public function prendasTelas()
{
    return $this->hasMany(PrendaTela::class, 'prenda_confeccion_id');
}
    public function prendasColor()
{
    return $this->hasMany(PrendaColor::class, 'prenda_id');
}

    public function telas()
{
    return $this->hasManyThrough(
        Tela::class,
        PrendaTela::class,
        'prenda_confeccion_id', // Foreign key on `prendas_telas` table
        'id',                   // Foreign key on `telas` table
        'id',                   // Local key on `prendas_confecciones` table
        'tela_id'               // Local key on `prendas_telas` table
    );
}
}
