<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesores';

    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'user_id',
    ];

    //Relacion con la tabla de usuarios
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'profesor_id');
    }

    // Relacion para que un profesor puede tener muchas materias
    public function profesor_materia()
    {
        return $this->belongsToMany(Materia::class, 'profesor_materia', 'profesor_id', 'materia_id');
    }
}
