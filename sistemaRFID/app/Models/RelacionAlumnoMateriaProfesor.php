<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionAlumnoMateriaProfesor extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Relacion',
        'ID_Alumno',
        'ID_Materia',
        'ID_Profesor',
    ];

    //agregamos la relacion muchos a uno con la tabla materias
    public function materias(){
        return $this->belongsTo(Materia::class);
    }

    //agregamos la relacion muchos a uno con la tabla profesores
    public function profesores(){
        return $this->belongsTo(Profesor::class);
    }

    //agregamos la relacion muchos a uno con la tabla alumnos
    public function alumnos(){
        return $this->belongsTo(Alumno::class);
    }
}
