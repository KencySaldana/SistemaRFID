<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Alumno',
    ];

    //agregamos la relacion uno a muchos con la tabla relacion_alumno_materia_profesor
    public function relacion_alumno_materia_profesor(){
        return $this->hasMany(RelacionAlumnoMateriaProfesor::class);
    }
}


