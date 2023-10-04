<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    //definimos la tabla a la que hace referencia este modelo
    protected $fillable = [
        'ID_Horario',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    //agregamos la relacion muchos a uno con la tabla materias
    public function materias(){
        return $this->belongsTo(Materia::class);
    }

    //agregamos la relacion muchos a uno con la tabla profesores
    public function profesores(){
        return $this->belongsTo(Profesor::class);
    }
}
