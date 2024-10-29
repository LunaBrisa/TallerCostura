<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tela extends Model
{
    use HasFactory;

    protected $table = 'telas';
    protected $primaryKey = 'id_tela';

    protected $fillable = ['nombre_tela', 'id_material_tela'];

    public $timestamps = false;

    public function materialTela()
    {
        return $this->belongsTo(MaterialTela::class, 'id_material_tela');
    }
}
