<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrenda extends Model
{

    use HasFactory;

    protected $table = 'tipo_prendas';
    protected $fillable = ['tipo_prenda'];
    protected $primarikey = 'id_tp';
}
