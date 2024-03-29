<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $hidden = ['id','descripcion','created_at','updated_at'];

    public function video()
    {
        return $this->hasMany(Video::class, 'cursos_id');
    }

    public function usuario()
    {
        return $this->belongsToMany(Usuario::class, 'cursos_usuarios', 'cursos_id', 'usuarios_id');
    }
}