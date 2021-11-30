<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $hidden = ['contraseña','created_at','updated_at'];

    public function curso()
    {
        return $this->belongsToMany(Curso::class, 'cursos_usuarios', 'cursos_id', 'usuarios_id');
    }
}