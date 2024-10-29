<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $fillable = ['compania', 'cargo', 'id_persona'];
    public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'id_persona');
    }
}
