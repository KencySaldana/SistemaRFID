<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $table = 'materias';

    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'nombre',
    ];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'materia_alumno', 'materia_id', 'alumno_id');
    }

    public function asistencias()
    {
        return $this->belongsToMany(Asistencia::class, 'asistencia_materia', 'materia_id', 'asistencia_id');
    }

    public function Profesor()
    {
        return $this->belongsToMany(Alumno::class, 'materia_alumno', 'materia_id', 'alumno_id');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'materia_id');
    }

    // Relacion para que un profesor puede tener muchas materias
    public function profesor_materia()
    {
        return $this->belongsToMany(Profesor::class, 'profesor_materia', 'materia_id', 'profesor_id');
    }
}
