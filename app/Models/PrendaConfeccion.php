<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrendaConfeccion extends Model
{
    use HasFactory;
    protected $table = 'prendas_confecciones';
    protected $fillable = ['nombre_prenda', 'descripcion', 'precio', 'genero', 'tp_id', 'ruta_imagen'];
<<<<<<< HEAD

=======
>>>>>>> fdb26156aee5f4e6d331dafe09d0835057a34a4a
    public function tipoPrenda()
    {
        return $this->belongsTo(TipoPrenda::class, 'tp_id');
    }
<<<<<<< HEAD

=======
>>>>>>> fdb26156aee5f4e6d331dafe09d0835057a34a4a
    public function detallesConfeccion()
    {
        return $this->hasMany(DetalleConfeccion::class);
    }
<<<<<<< HEAD

=======
>>>>>>> fdb26156aee5f4e6d331dafe09d0835057a34a4a
    public function prendasTelas()
    {
        return $this->hasMany(PrendaTela::class);
    }
}
