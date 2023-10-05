<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'user_id',
    ];

    //Relacion de usuarios a alumnos
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relacion de alumnos con asistencias
    public function asistencias() {
        return $this->belongsToMany(Asistencia::class, 'asistencia_alumno', 'alumno_id', 'asistencia_id');
    }

    public function materias() {
        return $this->belongsToMany(Materia::class, 'materia_alumno', 'alumno_id', 'materia_id');
    }
}


