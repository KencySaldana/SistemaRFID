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

}
