<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Asistencia',
        'ID_Relacion',
        'fecha',
        'asistencia',
    ];

    //agregamos la relacion muchos a uno con la tabla relacion_alumno_materia_profesor
    public function relacion_alumno_materia_profesor(){
        return $this->belongsTo(RelacionAlumnoMateriaProfesor::class);
    }

    //agregamos la relacion muchos a uno con la tabla alumnos
    public function alumnos(){
        return $this->belongsTo(Alumno::class);
    }

    //agregamos la relacion muchos a uno con la tabla materias
    public function materias(){
        return $this->belongsTo(Materia::class);
    }

    //agregamos la relacion muchos a uno con la tabla profesores
    public function profesores(){
        return $this->belongsTo(Profesor::class);
    }
}
