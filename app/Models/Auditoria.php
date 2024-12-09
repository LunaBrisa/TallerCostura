<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    protected $table = 'AUDITORIAS';

    protected $fillable = [
        'accion',
        'usuario',
        'registro_afectado',
        'registro_anterior',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
