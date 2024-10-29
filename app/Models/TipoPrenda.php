<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrenda extends Model
{
    use HasFactory;

    protected $table = 'tipo_prendas';
    protected $primaryKey = 'id_tp';

    protected $fillable = ['tipo_prenda'];

    public $timestamps = false;

    public function prendas()
    {
        return $this->hasMany(Prenda::class, 'id_tp');
    }
}
