<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prendas extends Model
{
    use HasFactory;
    protected $table = 'prendas';
    protected $fillable = [
    'id_prenda',
    'nombre_prenda',
    'descripcion',
    'precio'
    ];
}
