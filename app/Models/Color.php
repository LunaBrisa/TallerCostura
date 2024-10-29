<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colores';
    protected $primaryKey = 'id_color';

    protected $fillable = ['color'];

    public $timestamps = false;

    public function prendaTelas()
    {
        return $this->hasMany(PrendaTela::class, 'id_color');
    }
}
