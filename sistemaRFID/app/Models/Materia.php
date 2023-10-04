<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Materia',
        'nombre',
        'horario',
    ];

    //agregamos la relacion uno a muchos con la tabla horarios
    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    //agregamos la relacion uno a muchos con la tabla relacion_alumno_materia_profesor
    public function relacion_alumno_materia_profesor(){
        return $this->hasMany(RelacionAlumnoMateriaProfesor::class);
    }
}
