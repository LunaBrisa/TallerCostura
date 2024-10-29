<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_rol';

    protected $fillable = ['nombre_rol'];
    public $timestamps = false;

    public function rolUsuarios()
    {
        return $this->hasMany(RolUsuarios::class, 'id_rol');
    }
}
