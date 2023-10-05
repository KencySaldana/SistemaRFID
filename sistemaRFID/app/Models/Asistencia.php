<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'fecha',
        'hora',
        'asistencia',
    ];

    //Relacion con la tabla de alumnos con su tabla de intersección
    public function alumnos() {
        return $this->belongsToMany(Alumno::class, 'asistencia_alumno', 'asistencia_id', 'alumno_id');
    }

    public function materias() {
        return $this->belongsToMany(Materia::class, 'asistencia_materia', 'asistencia_id', 'materia_id');
    }
}
