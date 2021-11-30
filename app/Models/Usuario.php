<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    public function curso()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuarios', 'cursos_id', 'usuarios_id');
    }
}
