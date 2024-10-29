<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialTela extends Model
{
    use HasFactory;

    protected $table = 'material_telas';
    protected $primaryKey = 'id_material_tela';

    protected $fillable = ['material_tela'];

    public $timestamps = false;

    public function telas()
    {
        return $this->hasMany(Tela::class, 'id_material_tela');
    }
}
