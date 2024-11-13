<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = ['compania', 'cargo', 'persona_id'];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
