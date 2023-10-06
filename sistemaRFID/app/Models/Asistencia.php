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
        return $this->belongsToMany(Alumno::class, 'alumno_id');
    }

    public function materias() {
        return $this->belongsToMany(Materia::class, 'materia_id');
    }
}
