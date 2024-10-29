<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    use HasFactory;

    protected $table = 'medidas';
    protected $primaryKey = 'id_medida';

    protected $fillable = ['pecho', 'cintura', 'mangas', 'largo', 'detalle_pedido_id'];
    public $timestamps = false;

    public function detallePedido()
    {
        return $this->belongsTo(DetallePedidos::class, 'detalle_pedido_id');
    }
}
